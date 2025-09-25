(function ($, Drupal) {
    Drupal.Infra = (function () {
        /**
         * Variables and constants
         */
        var MAX_PHONE_WIDTH = 600;

        var cache = {};

        /**
         * End of Variables and constants
         */


        /**
         * Calculate number of object properties
         * @param obj - object for investigation
         * @returns {number} - number of elements
         */
        var objectSize = function (obj) {
            var size = 0, key;
            for (key in obj) {
                if (obj.hasOwnProperty(key)) size++;
            }
            return size;
        };

        /**
         * Print log message to browser console
         * @param message - message for output
         */
        var log = function (message) {
            ///@TODO add log levels (or start use some external library for logging)
            if (window.console && window.console.log) {
                console.log(message);
                console.log(getStackTrace());
            }
        };

        /**
         * Get current stack trace as array
         * @returns {boolean|*|Array}
         */
        var getStackTrace = function () {
            var obj = {};
            Error.captureStackTrace(obj, getStackTrace);
            return obj.stack;
        };

        /**
         * Wrapper for standard jQuery ajax request with so,me predefined parameters & custom error handler
         * @param requestPath - URL for request
         * @param data - data which should be send
         * @param method - POST|GET method
         * @returns {*} - ajax object
         */
        var ajaxRequest = function (requestPath, data, method) {
            if (typeof data == 'undefined' || data === null) {
                data = {};
            }
            if (typeof method == 'undefined') {
                method = 'POST';
            }
            return $.ajax(
                requestPath,
                {
                    'method': method,
                    'data': {
                        'data': data
                    },
                    'cache': false,
                    'error': function (jqXHR, textStatus, errorThrown) {
                        Drupal.Infra.log('Error during AJAX request: ' + requestPath + ' (' + textStatus + ')');
                    }
                }
            );
        };

        /**
         * Wrapper for ajax functionality which prevent sending of the same requests to the server
         * @param requestPath - URL for request
         * @param validationCallback - custom validation function for response
         * @param callback - function for execute after getting of response
         * @param data - data for sending to server
         * @param method - POST|GET method
         * @returns {*} - ajax promise object
         */
        var cachedAjaxRequest = function (requestPath, validationCallback, callback, data, method) {
            if (typeof cache[requestPath] === 'undefined') {
                cache[requestPath] = ajaxRequest(requestPath, data, method).promise();
            }
            return cache[requestPath].done(function (data) {
                var result = null;
                if (typeof validationCallback === 'function') {
                    result = validationCallback(data);
                }
                else {
                    result = Drupal.Infra.basicResponseValidation(data);
                }
                if (result !== false && typeof callback === 'function') {
                    callback(result);
                }
            });
        };


        /**
         * Basic validation of ajax response
         * @param data - object for validation
         * @returns false|{*} - false if validation was failed and data value if validation was success
         */
        var basicResponseValidation = function (data) {
            if (typeof data.error === 'undefined' || data.error) {
                Drupal.Infra.log('There was some error on server side when dynamic content had been processing (wong format possible)');
                return false;
            }
            if (typeof data.value === 'undefined' || typeof data.value !== 'object') {
                Drupal.Infra.log('Wrong format of response data object from server');
                return false;
            }
            return data.value;
        };

        /**
         * Convert parameters from URL to associative array
         * @param prmstr - string of request parameters
         * @returns {{}} - associative array
         */
        var getParamsToAssocArray = function (prmstr) {
            var params = {};
            var prmarr = prmstr.split("&");
            for (var i = 0; i < prmarr.length; i++) {
                var tmparr = prmarr[i].split("=");
                params[tmparr[0]] = tmparr[1];
            }
            return params;
        };

        /**
         * Get valid shortest valid domain (actual domain) from current URL
         * @param url - URL for processing
         * @returns {*} - actual domain
         */
        var buildWildcardDomainForCookies = function (url) {
            var TLDs = ["ac", "ad", "ae", "aero", "af", "ag", "ai", "al", "am", "an", "ao", "aq", "ar", "arpa", "as", "asia", "at", "au", "aw", "ax", "az", "ba", "bb", "bd", "be", "bf", "bg", "bh", "bi", "biz", "bj", "bm", "bn", "bo", "br", "bs", "bt", "bv", "bw", "by", "bz", "ca", "cat", "cc", "cd", "cf", "cg", "ch", "ci", "ck", "cl", "cm", "cn", "co", "com", "coop", "cr", "cu", "cv", "cx", "cy", "cz", "de", "dj", "dk", "dm", "do", "dz", "ec", "edu", "ee", "eg", "er", "es", "et", "eu", "fi", "fj", "fk", "fm", "fo", "fr", "ga", "gb", "gd", "ge", "gf", "gg", "gh", "gi", "gl", "gm", "gn", "gov", "gp", "gq", "gr", "gs", "gt", "gu", "gw", "gy", "hk", "hm", "hn", "hr", "ht", "hu", "id", "ie", "il", "im", "in", "info", "int", "io", "iq", "ir", "is", "it", "je", "jm", "jo", "jobs", "jp", "ke", "kg", "kh", "ki", "km", "kn", "kp", "kr", "kw", "ky", "kz", "la", "lb", "lc", "li", "lk", "lr", "ls", "lt", "lu", "lv", "ly", "ma", "mc", "md", "me", "mg", "mh", "mil", "ml", "mm", "mn", "mo", "mobi", "mp", "mq", "mr", "ms", "mt", "mu", "museum", "mv", "mw", "mx", "my", "mz", "na", "name", "nc", "ne", "net", "nf", "ng", "ni", "nl", "no", "np", "nr", "nu", "nz", "om", "org", "pa", "pe", "pf", "pg", "ph", "pk", "pl", "pm", "pn", "pr", "pro", "ps", "pt", "pw", "py", "qa", "re", "ro", "rs", "ru", "rw", "sa", "sb", "sc", "sd", "se", "sg", "sh", "si", "sj", "sk", "sl", "sm", "sn", "so", "sr", "st", "su", "sv", "sy", "sz", "tc", "td", "tel", "tf", "tg", "th", "tj", "tk", "tl", "tm", "tn", "to", "tp", "tr", "travel", "tt", "tv", "tw", "tz", "ua", "ug", "uk", "us", "uy", "uz", "va", "vc", "ve", "vg", "vi", "vn", "vu", "wf", "ws", "xn--0zwm56d", "xn--11b5bs3a9aj6g", "xn--3e0b707e", "xn--45brj9c", "xn--80akhbyknj4f", "xn--90a3ac", "xn--9t4b11yi5a", "xn--clchc0ea0b2g2a9gcd", "xn--deba0ad", "xn--fiqs8s", "xn--fiqz9s", "xn--fpcrj9c3d", "xn--fzc2c9e2c", "xn--g6w251d", "xn--gecrj9c", "xn--h2brj9c", "xn--hgbk6aj7f53bba", "xn--hlcj6aya9esc7a", "xn--j6w193g", "xn--jxalpdlp", "xn--kgbechtv", "xn--kprw13d", "xn--kpry57d", "xn--lgbbat1ad8j", "xn--mgbaam7a8h", "xn--mgbayh7gpa", "xn--mgbbh1a71e", "xn--mgbc0a9azcg", "xn--mgberp4a5d4ar", "xn--o3cw4h", "xn--ogbpf8fl", "xn--p1ai", "xn--pgbs0dh", "xn--s9brj9c", "xn--wgbh1c", "xn--wgbl6a", "xn--xkc2al3hye2a", "xn--xkc2dl3a5ee0h", "xn--yfro4i67o", "xn--ygbi2ammx", "xn--zckzah", "xxx", "ye", "yt", "za", "zm", "zw"].join();

            url = url.replace(/.*?:\/\//g, "");
            url = url.replace(/www./g, "");
            var parts = url.split('/');
            url = parts[0];
            parts = url.split('.');
            if (parts[0] === 'www' && parts[1] !== 'com') {
                parts.shift()
            }
            var ln = parts.length
                , i = ln
                , minLength = parts[parts.length - 1].length
                , part;

            // iterate backwards
            while (part = parts[--i]) {
                // stop when we find a non-TLD part
                if (i === 0                    // 'asia.com' (last remaining must be the SLD)
                    || i < ln - 2                // TLDs only span 2 levels
                    || part.length < minLength // 'www.cn.com' (valid TLD as second-level domain)
                    || TLDs.indexOf(part) < 0  // officially not a TLD
                ) {
                    var actual_domain = part;
                    break;
                    //return part
                }
            }
            var tid;
            if (typeof parts[ln - 1] != 'undefined' && TLDs.indexOf(parts[ln - 1]) >= 0) {
                tid = '.' + parts[ln - 1];
            }
            if (typeof parts[ln - 2] != 'undefined' && TLDs.indexOf(parts[ln - 2]) >= 0) {
                tid = '.' + parts[ln - 2] + tid;
            }
            if (typeof tid != 'undefined')
                actual_domain = actual_domain + tid;
            else
                actual_domain = actual_domain + '.com';

            return actual_domain;
        };

        /**
         * Add parameters to URL
         * @param url - current URL
         * @param parameters - associative array with parameters which should be added
         * @returns {*} - string with updated URL
         */
        var addUrlParameters = function (url, parameters) {
            if (!objectSize(parameters)) {
                return url;
            }
            if (url.indexOf('?') !== -1) {
                return url + '&' + decodeURIComponent($.param(parameters));
            }
            else {
                return url + '?' + decodeURIComponent($.param(parameters));
            }
        };

        /**
         * read Get parameters from current URL
         * @returns {{}} - associative array of parameters
         */
        var getSearchParameters = function () {
            var prmstr = window.location.search.substr(1);
            return ((prmstr != null && prmstr != "") ? getParamsToAssocArray(prmstr) : {});
        };

        /**
         * Analyze user agent of current client for detect some clients parameters
         * @returns {*} - associative array with user information
         */
        var clientAnalyze = function () {
            if (typeof MobileDetect === 'undefined') {
                Drupal.Infra.log('MobileDetect library does not available');
                return {};
            }
            if (typeof cache['client-info'] === 'undefined') {
                var md = new MobileDetect(window.navigator.userAgent, MAX_PHONE_WIDTH);
                var os = md.os();
                cache['client-info'] = {
                    'desktop': !md.mobile(),
                    'phone': !!md.phone(),
                    'tablet': !!md.tablet(),
                    'mobile': !!md.mobile(),
                    'android': (os === 'AndroidOS'),
                    'ios': (os === 'iOS')
                };
            }
            return cache['client-info'];
        };

        var attachClientTypeClasses = function ($body) {
            var clientInfo = Drupal.Infra.clientAnalyze();
            for (var clientType in clientInfo) {
                if (clientInfo.hasOwnProperty(clientType) && clientInfo[clientType]) {
                    $body.addClass(clientType)
                }
            }
        };


        return {
            objectSize: objectSize,
            log: log,
            getStackTrace: getStackTrace,
            ajaxRequest: ajaxRequest,
            cachedAjaxRequest: cachedAjaxRequest,
            getParamsToAssocArray: getParamsToAssocArray,
            basicResponseValidation: basicResponseValidation,
            buildWildcardDomainForCookies: buildWildcardDomainForCookies,
            addUrlParameters: addUrlParameters,
            getSearchParameters: getSearchParameters,
            clientAnalyze: clientAnalyze,
            attachClientTypeClasses: attachClientTypeClasses
        }
    }());

    Drupal.behaviors.infraBehavior = {
        attach: function (context, settings) {
            $('body', context).once(function () {
                Drupal.Infra.attachClientTypeClasses($(this));
            });
        }
    };

})(jQuery, Drupal);