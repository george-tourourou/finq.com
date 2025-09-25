
    function getURLParameter(param_alias)
    {
        var sPageURL = window.location.search.substring(1);
        var sURLVariables = sPageURL.split('&');

        for (var i = 0; i < sURLVariables.length; i++)
        {
            var sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] == param_alias)
            {
                return sParameterName[1];
            }
        }

        return null;
    }

    function getMarketingParameters()
    {
        var marketingParameters = {};

        if(getURLParameter("utm_campaign") !== null) {
            marketingParameters["utmCampaign"] = getURLParameter("utm_campaign");
        }

        if(getURLParameter("utm_medium") !== null) {
            marketingParameters["utmMedium"] = getURLParameter("utm_medium");
        }

        if(getURLParameter("utm_source") !== null) {

            var utm_source = getURLParameter("utm_source");
            marketingParameters["utmSource"] = getURLParameter("utm_source");

            if(utm_source.toLowerCase() == "google")
            {
                var utm_medium = getURLParameter("utm_medium").toLowerCase();

                if(utm_medium == "cpc")
                {
                    marketingParameters["affiliateId"] = "Google Search";
                }
                else if(utm_medium == "gdn" || utm_medium == "placement")
                {
                    marketingParameters["affiliateId"] = "Google Sites";
                }
                else if(utm_medium == "content")
                {
                    marketingParameters["affiliateId"] = "Google Keyword Sites";
                }
                else if(utm_medium == "kwplacement")
                {
                    marketingParameters["affiliateId"] = "Google Keyword Pages";
                }
            }
        }

        if(getURLParameter("utm_term") !== null) {
            marketingParameters["utmTerm"] = getURLParameter("utm_term");
        }

        if(getURLParameter("utm_content") !== null) {
            marketingParameters["utmContent"] = getURLParameter("utm_content");
        }

        if(getURLParameter("utm_category") !== null) {
            marketingParameters["utmCategory"] = getURLParameter("utm_category");
        }

        if(getURLParameter("ad_id") !== null) {
            marketingParameters["adId"] = getURLParameter("ad_id");
        }

          if(getURLParameter("gclid") !== null) {
            marketingParameters["gclid"] = getURLParameter("gclid");
        }

        if(getURLParameter("notes") !== null) {
            marketingParameters["notes"] = getURLParameter("notes");
        }

        if(getURLParameter("ret") !== null) {
            marketingParameters["ret"] = getURLParameter("ret");
        }

        if(getURLParameter("sid") !== null) {
            marketingParameters["sid"] = getURLParameter("sid");
        }

        if(getURLParameter("c") !== null) {
            marketingParameters["trafficId"] = getURLParameter("c");
        }

        if(getURLParameter("clickid") !== null) {
            marketingParameters["clickId"] = getURLParameter("clickid");
        }
		
     if(getURLParameter("context_id") !== null) {
            marketingParameters["gclid"] = getURLParameter("context_id");
        }

        if(getURLParameter("af_sub1") !== null) {
            marketingParameters["term"] = getURLParameter("af_sub1");
        }

        if(getURLParameter("af_sub2") !== null) {
            marketingParameters["medium"] = getURLParameter("af_sub2");
        }

        if(getURLParameter("af_sub3") !== null) {
            marketingParameters["campaign"] = getURLParameter("af_sub3");
        }

        if(getURLParameter("language") !== null) {
            marketingParameters["language"] = getURLParameter("language");
        }

        if(getURLParameter("bid") !== null) {
            marketingParameters["bId"] = getURLParameter("bid");
        }

        if(getURLParameter("notes") !== null) {
            marketingParameters["notes"] = getURLParameter("notes");
        }

        if(getURLParameter("campaignId") !== null) {
            // console.log(getURLParameter("campaignId"));
            marketingParameters["campaignId"] = getURLParameter("campaignId");
        }

        if(getURLParameter("pageName") !== null) {
            // console.log(getURLParameter("pageName"));
            marketingParameters["pageName"] = getURLParameter("pageName");
        }

        if(getURLParameter("pid") !== null) {
            marketingParameters["affiliateId"] = getURLParameter("pid");
        }    
	/*	if(getURLParameter("pid") !== null) {
            if(getURLParameter("pid").startsWith("100")){
			marketingParameters["network"] = "AdvertPro";
			}
        }*/
		marketingParameters["network"] = "AdvertPro";
		marketingParameters["referrer"] = window.location.href;

        if(getURLParameter("mid") !== null) {
            marketingParameters["media"] = getURLParameter("mid");
        }

        if(getURLParameter("cid") !== null) {
            marketingParameters["trafficId"] = getURLParameter("cid");
        }

        if(getURLParameter("zid") !== null) {
            marketingParameters["zone"] = getURLParameter("zid");
        }

        if(getURLParameter("custom") !== null) {
            marketingParameters["custom"] = getURLParameter("custom");
        }

        if(Object.keys(marketingParameters).length === 0) {
            return null;
        }
        else {
            return marketingParameters;
        }
    }

jQuery(function() {
    jQuery("form#registration-form").validate({
        // Specify validation rules
        rules: {
            email: {
                required: true,
                // Specify that email should be validated
                // by the built-in "email" rule
                email: true
            },
            password: {
                required: true,
                pwcheck: true,
                minlength: 5,
                maxlength: 15
            },
            confirmpassword: {
                required: true,
                equalTo: "#password"
            },
            currency: {
                required: true
            }
        },
        // Specify validation error messages
        messages: {
            password: {
                required: getRegistrationBlockTranslation().PassRequired,
                minlength: getRegistrationBlockTranslation().PassMin,
                maxlength: getRegistrationBlockTranslation().PassMax,
                pwcheck: getRegistrationBlockTranslation().PassCheck
            },
            confirmpassword: {
                required: getRegistrationBlockTranslation().PassConfirm,
                equalTo: getRegistrationBlockTranslation().PassConfirm
            },
            currency: getRegistrationBlockTranslation().Currency,
            email: getRegistrationBlockTranslation().Email
        },
        // Make sure the form is submitted to the destination defined
        // in the "action" attribute of the form when valid
        submitHandler: function(form, e) {
            e.preventDefault();
            jQuery("#registration-form #generic-error").addClass("d-none");
            jQuery("#registration-form button").prop('disabled', true);
            jQuery("#registration-form .loader").removeClass("d-none");
			
			let country = jQuery("#mycountry").val();
            let email = jQuery("#email").val();
            let password = jQuery("#password").val();
            let currency = jQuery("#currency").val();
            let promocode = jQuery("#promocode").val();
            let marketingParams = getMarketingParameters();

            let leadApiParams = {
                email:  email,
                password: password,
                currency: currency,
                promotionName: promocode,
				country: country,
                //currency: 'USD',
                //firstName: 'test',
                //lastName: 'test',
                //phone: '7-918-5581111',
                autoLogin: true
            };

            if(marketingParams !== null) {
                leadApiParams.trackingParams = marketingParams;
            }

            const RegistrationRequest = {
                lang: getLanguageCode(),
                apiUrl: 'https://services-finq.extsrv.com',
                platformUrl: 'https://live-cosmos.finq.com',
                isDebug: false,
                alwaysEligible: false,
                onInitDone: data => {
                    leadForm
                        .submit(leadApiParams)
                        .then(data => {
                            logger(data);
                        })
                        .fail(error => {
                            logger(error);
                            jQuery("#registration-form button").prop('disabled', false);
                            jQuery("#generic-error").text(error.message).show().removeClass("d-none");
                            jQuery("#registration-form .loader").addClass("d-none");
                        })
                },
            };

            let leadForm = new LeadForm(RegistrationRequest);
        }

    });

    jQuery.validator.addMethod("pwcheck",
        function(value, element) {
            return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,15}$/.test(value);
    });

    function logger(data) {
        data = JSON.stringify(data);

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //this.responseText;
            }
        };
        xhttp.open("POST", "/logger/RegistrationLogger.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("data=" + data);
    }
});