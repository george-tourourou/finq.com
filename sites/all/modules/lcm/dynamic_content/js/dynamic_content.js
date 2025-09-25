



(function ($, Drupal) {

    Drupal.DynamicContent = (function () {
        const LINK_UPDATED_EVENT_NAME = 'tfxl:link-updated';
        const LIVE_URL_TYPE = 'Live';
        const DEMO_URL_TYPE = 'Demo';

        /**
         * Function for validation bonus data from server
         * @param data - data from server
         * @returns {*} - bonus data if validation was success or false otherwise
         */
        var validateBonusData = function (data) {
            if (!Drupal.Infra.basicResponseValidation(data)) {
                return false;
            }
            if (data.value[0].length != 4) {
                Drupal.Infra.log('Bonus data does not configured by right way on server side');
                return false;
            }
            return data.value;
        };

        /**
         * Get table of bonuses from server
         * @param $element
         */
        var dcBonusTable = function ($element) {
            Drupal.Infra.cachedAjaxRequest(Drupal.settings.basePath +
                Drupal.settings.dynamicContent.requestPath + 'bonus_table', validateBonusData, function (data) {
                var $tbody = $element.find('tbody');
                if (!$tbody.length) {
                    $tbody = $('<tbody>').appendTo($element);
                }
                else {
                    $tbody.html('');
                }
                $.each(data, function (index, bonusData) {
                    if (index === 0) {
                        return true;
                    }
                    $(
                        "<tr><td>" +
                        bonusData[0] +
                        "</td><td><span class='bonus-arrow' /></td><td>" +
                        bonusData[3] +
                        bonusData[2] +
                        "</td></tr>"
                    ).appendTo($tbody);
                });
            });
        };

        /**
         * Get bonus amount & currency from server
         * @param $element
         */
        var dcBonus = function ($element) {
            Drupal.Infra.cachedAjaxRequest(Drupal.settings.basePath +
                Drupal.settings.dynamicContent.requestPath + 'bonus_table', validateBonusData, function (data) {
                $element.html(data[0][3] + data[0][2]);
            });
        };

        /**
         * Calculate required text according to user device and modify passed element
         * @param element
         */
        var dcCallToAction = function (element) {
            var clientInfo = Drupal.Infra.clientAnalyze();
            var vars = Drupal.settings.dynamicContent;

            if (clientInfo.phone || clientInfo.tablet) {
                element.html(vars.dcCallToActionTextMobile);
                return;
            }

            element.html(vars.dcCallToActionTextDesktop);
        };


        /**
         * Calculate actual link to live platform according to current user device & type of link
         * @param linkType - LIVE_URL_TYPE | DEMO_URL_TYPE
         * @returns {*}
         */
        var getLoginToPlatformLink = function (linkType) {
            if (linkType !== LIVE_URL_TYPE && linkType !== DEMO_URL_TYPE) {
                Drupal.Infra.log('Wrong usage of "getLoginToPlatformLink" function!');
                return '';
            }
            var clientInfo = Drupal.Infra.clientAnalyze();
            var vars = Drupal.settings.dynamicContent;

            if (clientInfo.tablet && clientInfo.ios) {
                return vars['dc' + linkType + 'PlatformLinkClientTabletIos'];
            }
            if (clientInfo.tablet && clientInfo.android) {
                return vars['dc' + linkType + 'PlatformLinkClientTabletAndroid'];
            }
            if (clientInfo.phone && clientInfo.ios) {
                return vars['dc' + linkType + 'PlatformLinkClientMobileIos'];
            }
            if (clientInfo.phone && clientInfo.android) {
                return vars['dc' + linkType + 'PlatformLinkClientMobileAndroid'];
            }

            return vars['dc' + linkType + 'PlatformLinkClientDesktop'];
        };

        /**
         * Process current element - add right url according to user device type
         * @param element - link element
         * @param linkType - LIVE_URL_TYPE | DEMO_URL_TYPE
         */
        var processLinkToPlatform = function (element, linkType) {
            var clientInfo = Drupal.Infra.clientAnalyze();
            var vars = Drupal.settings.dynamicContent;
            if (!(clientInfo.mobile && (clientInfo.ios || clientInfo.android))) {
                var url = vars['dc' + linkType + 'PlatformLinkClientDesktop'];
                url = "/" + Drupal.settings.pathPrefix + url;
                element.attr('href', url);
            } else {
                //add lang param for pass it to widgets in cosmos (we want to have the same language as in markets site)
                var params = {
                    'lang': Drupal.settings.dynamicContent.language
                };
                var url = Drupal.Infra.addUrlParameters(
                    getLoginToPlatformLink(linkType),
                    params
                );
                element.attr('href', url);
            }
            $(document).trigger(LINK_UPDATED_EVENT_NAME, element);
        };

        /**
         * Add tracking parameters & current language to live login platform link
         * @param element
         */
        var dcLoginToLivePlatform = function (element) {
            processLinkToPlatform(element, LIVE_URL_TYPE);
        };

        /**
         * Add tracking parameters & current language to demo login platform link
         * @param element
         */
        var dcLoginToDemoPlatform = function (element) {
            processLinkToPlatform(element, DEMO_URL_TYPE);
        };

        /**
         * read all elements with attribute data-dynamic and process them via DC functions
         * @param context
         */
        var processDC = function (context) {
            var self = this;
            $('[data-dynamic="dynamic"]', context).once(function () {
                var $element = $(this);
                var functionToCall = self[$element.data('function')];
                if (typeof  functionToCall === 'function') {
                    functionToCall($element);
                }
                else {
                    Drupal.Infra.log(
                        'Could not find function which process dynamic content: ' + $element.data('function')
                    );
                }
            });
        };


        /**
         * Calculate actual link to Select Account Mode
         * @param context
         */
        var dcRegistrationToLivePlatform = function (element) {
            console.log('dcRegistrationToLivePlatform');
            processLinkToRgistration(element, LIVE_URL_TYPE);
        };

        var dcRegistrationToDemoPlatform = function (element) {
            processLinkToRgistration(element, DEMO_URL_TYPE);
        };

        var processLinkToRgistration = function (element, linkType) {
            var clientInfo = Drupal.Infra.clientAnalyze();
            var vars = Drupal.settings.dynamicContent;
            if (!(clientInfo.mobile && (clientInfo.ios || clientInfo.android))) {
                var url = vars['dc' + linkType + 'RegistrationLinkClientDesktop'];
                url = "/" + Drupal.settings.pathPrefix + url;
                element.attr('href', url);

            } else {
                var params = {
                    'lang': Drupal.settings.dynamicContent.language
                };
                var url = Drupal.Infra.addUrlParameters(
                    getLoginToPlatformLink(linkType),
                    params
                );
                element.attr('href', url);

                console.log(url);
                console.log(params);
            }
            $(document).trigger(LINK_UPDATED_EVENT_NAME, element);
        };

        return {
            dcBonus: dcBonus,
            dcBonusTable: dcBonusTable,
            dcLoginToLivePlatform: dcLoginToLivePlatform,
            dcLoginToDemoPlatform: dcLoginToDemoPlatform,
            dcCallToAction: dcCallToAction,
            processDC: processDC,
            dcRegistrationToLivePlatform: dcRegistrationToLivePlatform,
            dcRegistrationToDemoPlatform: dcRegistrationToDemoPlatform
        }
    }());

    Drupal.behaviors.dynamicContentBehavior = {
        attach: function (context, settings) {
            Drupal.DynamicContent.processDC(context);
        },
        weight: -1
    };

})(jQuery, Drupal);