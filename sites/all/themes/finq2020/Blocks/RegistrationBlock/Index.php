<?php
include 'RegistrationBlockRepository.php';


// $mycountry = getenv(GEOIP2_COUNTRY_CODE);

$RegistrationBlockRepository = new RegistrationBlockRepository();

$clientHasAccess = $RegistrationBlockController->HasAccess();
$isEUClient = $RegistrationBlockController->IsEUClient();

if(!$clientHasAccess) {
    ?>
    <div class="alert alert-danger">[translate_compliance_jurisdiction_warning]</div>
<?php } else if($isEUClient) {
    ?>
    <iframe height="470" src="https://lp.finq.com/campaign/finq-site-plain-landing-page/Index.php?lang=[language:code]<?php echo $RegistrationBlockController->GetParameters(); ?>"></iframe>
<?php } else {
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script>
        setRegistrationBlockTranslation(
            "[translate_kw_password_required]",
            "[translate_kw_password_minimum_length]",
            "[translate_kw_password_maximum_length]",
            "[translate_kw_password_strength]",
            "[translate_kw_password_confirm]",
            "[translate_kw_currency_required]",
            "[translate_kw_email_required]");

        setLanguageCode("[language:code]");
        }
    </script>
    <script src="/sites/all/themes/finqV2020/Content/Scripts/Registration/Controller.js"></script>
    <script src="/sites/all/themes/finqV2020/Content/Scripts/Registration/LeadForm.min.js"></script>

    <form id="registration-form" method="post" name="registration">
     
		<div class="form-group">
            <input type="email" class="form-control" name="email" id="email" placeholder="[translate_kw_email]" required  />
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" id="password" placeholder="[translate_kw_password]" required  />
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="[translate_kw_confirm_password]" required  />
        </div>
        <div class="form-group">
            <select id="currency" class="form-control">
                <?php
                $currencies = $RegistrationBlockController->GetCurrencies();

                foreach ($currencies as $currency) {
                    echo sprintf('<option value="%s">%s</option>', $currency, $currency);
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label id="generic-error"></label>
        </div>
        <div class="form-group">
            <button class="btn btn-gray" type="submit">[translate_kw_create_your_account]</button>
        </div>
    </form>
<?php } ?>