<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
header("Access-Control-Allow-Origin: *");

error_reporting(E_ALL);
session_start();

    function getAvailableLanguages()
    {
        return array("sq", "ar", "bg", "cn", "cs", "da", "nl", "fi", "fr", "de", "el", "hu", "it", "pl", "no", "pl", "pt", "ro", "ru", "sl", "sk", "es", "en", "sv", "th");
    }

    function getPageName() {
        return "Finq Lead";
    }

    $campaignId = "5699b1f1-5032-4bbc-b8bf-43e8ced8eea0";
    include_once($_SERVER['DOCUMENT_ROOT'].'/traders-room/LP/Code/Countries.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/traders-room/LP/Code/Library.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/traders-room/LP/Translations/Translations.php');
/*
include_once "../Code/Translations.php";

include_once "../Code/Common-JS-CSS.php";
include_once "../Code/CSS-JS/heading.php";

include_once "../Code/CSS-JS/onPageStart.php"; */

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src="https://lp.finq.com/campaign/Common/Code/V2/js/Controller.js?v=<?php echo getRandomString(); ?>"></script>

<link href="https://www.finq.com/traders-room/LP/Content/styles.css" rel="stylesheet" />

<div class='col-12'>
    <div class='content'>
        <div class="col-12 register">
            <?php
            include_once('Form.php');
             ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#RedirectUrl").val("https://www.finq.com/traders-room/LP/View/success.php");
    });
</script>

<?php
//var_dump($_SESSION['form_token']);
    //include_once "../Code/V2/CSS-JS/onPageLoad-investing.php";
?>