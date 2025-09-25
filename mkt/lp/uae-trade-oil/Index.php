<?php
session_start();

function getAvailableLanguages()
{
    return array("en","ar","es");
}
function getPageName(){
    return "finq.com uae-oil";
}
?>

<?php include_once "../Common/Code/V2/Countries.php"; ?>
<?php include_once "../Common/Code/V2/Library.php"; ?>
<?php
include_once "../Common/Code/V2/Translations.php";
include_once 'php/phpGetBonus.php';
include_once "PageTranslations.php";
include_once "../Common/Code/PopularInstruments/PopularInstruments.php";


//$campaignId = "a993d06e-a931-42a0-af5d-4d66c174ed70"; 
$campaignId = "42875c5b-94c5-426f-b1d4-a62709410e56";

$assetInfo =getAsset('oil');

?>

<!DOCTYPE html>
<html lang="<?php echo GetCleanLanguageCode(); ?>" xmlns="http://www.w3.org/1999/xhtml">
<head>

    <link href="https://www.finq.com/sites/all/themes/finq/images/Favicon/favicon.ico" rel="shortcut icon" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700,800" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo str_replace("<br/>","", GetPageTranslation('title')); ?></title>
	<?php include_once "../Common/Code/V2/CSS-JS/heading.php"; ?>
    <link href="css/styles.css?v=<?php echo generateRandomString(); ?>" rel="stylesheet" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.2/TweenMax.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.2/plugins/ScrollToPlugin.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.2/plugins/CSSPlugin.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.2/easing/EasePack.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.2/TweenLite.min.js"></script>

<!--ScrollMagic-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/ScrollMagic.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/debug.addIndicators.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/animation.gsap.js"></script>
	
	
	    <!--  PIXELS SECTION -->

    <!-- Global site tag (gtag.js) - Google Ads: 826367109 -->
<!--    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-826367109"></script>-->
<!--    <script>-->
<!--        window.dataLayer = window.dataLayer || [];-->
<!--        function gtag(){dataLayer.push(arguments);}-->
<!--        gtag('js', new Date());-->
<!---->
<!---->
<!---->
<!--        gtag('config', 'AW-826367109');-->
<!--    </script>-->

    <!-- END OFF PIXELS SECTION -->

<!--Excluding OP and Alejandro-->
<?php //include_once "../Common/Code/V2/CSS-JS/common-js-pixel-header.php"; ?>
</head>
<body dir="<?php echo GetTextDirection(); ?>" class="<?php echo GetTextDirection(); ?> lang-<?php echo GetCleanLanguageCode(); ?>">
    <?php include_once "../Common/Code/V2/CSS-JS/onPageStart.php"; ?>
	<div id="banner1" class="banner1 col-12">
        <div class="content">
            <div class="col-12 logo-row">
                <img class='logo' src="../Common/images/logos/logo_white_txt.svg" />
                <div class="pull-right available-platforms">
                    <p><?php echo GetTermsTranslation('available_on')?></p>
                    <a class="webtrade" href="https://www.finq.com/en/login">
                        <img class="white-img" src="img/webtrade.png">
                    </a>
                    <a class="" href="#">
                        <img class="white-img" src="img/play-store.png"></a>
<!--                    <a class="" href="https://app.appsflyer.com/id1280873475?pid=Finq_Web">-->
                    <a class="" href="#">
                        <img class="white-img" src="img/app-store.png"></a>
                </div>
            </div>
            <div class="col-12">
                <div class="col-7">
                    <h1 class="phone-version"><?php echo str_replace("<br/>","",  GetPageTranslation('head_title'));?></h1>
                    <h1 class="pc-version"><?php echo GetPageTranslation('head_title')?></h1>
                    <p><?php echo GetPageTranslation('head_subtitle')?></p>
                    <img src="img/icons/arrow.png">
                </div>
                <div class="col-5">
                    <div id="box-white" class="col-12 box-white ">
                        
                        <h4 class="black-clr">
                            <?php echo GetPageTranslation('sign_up_title')?>
                        </h4>
                        <div class="register" id="register-area">
                            <?php include "../Common/Code/V2/Form/Index-v3.php"; ?>
                        </div>
                        <p class="tc"><?php echo GetPageTranslation('tap')?></p>
                    </div>
                </div>
<!--                <button id="user-agent-btn" onclick="showForm()" class="buttonBanner button_white_green btn">-->
<!--                    --><?php //echo GetPageTranslation('btn')?>
<!--                </button>-->
            </div>
        </div>
    </div>
    <div class="banner1-part2 col-12">
        <div class="content">
            <h2><?php echo GetPageTranslation('banner1_part2_h2')?></h2>
            <div class="col-4 change-oil phone-version">
                <p class="title"><?php echo GetPageTranslation('banner1_part2_change')?></p>
                <p class="price"><?php echo $assetInfo['direction']?> <?php echo number_format($assetInfo['change'], 2, '.',',')?>%</p>
            </div>
            <div class="col-4 buy-oil">
                <p class="title"><?php echo GetPageTranslation('banner1_part2_buy')?></p>
                <p class="price">$<?php //echo $assetInfo['buy']?><?php echo number_format($assetInfo['buy'], 4)?></p>
            </div>
            <div class="col-4 change-oil pc-version">
                <p class="title"><?php echo GetPageTranslation('banner1_part2_change')?></p>
                <p class="price"><?php echo $assetInfo['direction']?> <?php echo number_format($assetInfo['change'], 2, '.',',')?>%</p>
            </div>
            <div class="col-4 sell-oil">
                <p class="title"><?php echo GetPageTranslation('banner1_part2_sell')?></p>
                <p class="price">$<?php //echo $assetInfo['sell']?><?php echo number_format($assetInfo['sell'], 4)?></p>
            </div>
            <div class="col-12">
                <img class="graph" src="img/banners/graph.png">
                <h3><?php echo GetPageTranslation('banner1_part2_h3')?></h3>
                <p><span onclick="goto()" class="btn btn-success buttonBanner"><?php echo GetPageTranslation('btn');?></span><a target="_blank" href="https://www.finq.com/<?php echo GetCleanLanguageCode(); ?>/instruments/oil"> <?php echo GetPageTranslation('btn_text');?></a></p>
<!--                <p><span class="btn btn-success buttonBanner">--><?php //echo GetPageTranslation('btn');?><!--</span>--><?php //echo GetPageTranslation('btn_text');?><!--</p>-->
            </div>
        </div>
    </div>
    <div class="banner1-phone col-12">
        <div class="content">
            <div class="col-12">
                <h3><?php echo GetPageTranslation('banner1_part2_h3')?></h3>
                <p><span onclick="goto()" class="btn btn-success buttonBanner"><?php echo GetPageTranslation('btn');?></span></p>
            </div>
        </div>
    </div>
    <!--banner6-->
    <div id="" class="benefits-list col-12">
        <div class="content">
            <h2><?php echo GetPageTranslation('benefits_title')?></h2>
            <div class="row">
                <div class="col-4 benefits">
                    <div>
                        <img src="img/icons/bonus.png">
                    </div>
                    <p> <?php echo GetPageTranslation('benefits_item1')?></p>
                </div>
                <div class="col-4 benefits">
                    <div>
                        <img src="img/icons/deposit.png">
                    </div>
                    <p> <?php echo GetPageTranslation('benefits_item2')?></p>
                </div>
<!--                <div class="col-4 benefits">-->
<!--                    <div>-->
<!--                        <img src="img/icons/assets.png">-->
<!--                    </div>-->
<!--                    <p> --><?php //echo GetPageTranslation('benefits_item3')?><!--</p>-->
<!--                </div>-->
                <div class="col-4 benefits">
                    <div>
                        <img src="img/icons/analysis.png">
                    </div>
                    <p> <?php echo GetPageTranslation('benefits_item4')?></p>
                </div>
                <div class="col-4 benefits">
                    <div>
                        <img src="img/icons/no-comission.png">
                    </div>
                    <p> <?php echo GetPageTranslation('benefits_item5')?></p>
                </div>
            </div>
        </div>
    </div>
    <div id="testimonials" class="testimonials col-12">
        <div class="testimonials-customer1 testimonial-customer" style="">
            <div class="content">
                <div class="col-6 testimonials-content slider-picture1 ">
                    <h2><?php echo GetPageTranslation('testimonial_h2_1')?></h2>
<!--                    <p class="testimonial-subtitle">--><?php //echo GetPageTranslation('testimonial_subtitle')?><!--</p>-->
                    <p class="testimonial-text"><?php echo GetPageTranslation('testimonial_text_1')?></p>
                    <p class="testimonial-name"><?php echo GetPageTranslation('testimonial_name_1')?></p>
<!--                    <p class="testimonial-trading">--><?php //echo GetPageTranslation('testimonial_trading_1')?><!--</p>-->
                    <a onclick="goto()" id="submitForm" class="btn btn-success buttonBanner "><?php echo GetPageTranslation('testimonial_btn')?></a>
                </div>
            </div>
        </div>
    </div>
    <div id="platform-banner" class="full platform-banner">
        <div class="content">
            <div class="col-6">
                <h2><?php echo GetPageTranslation('platform_title')?></h2>
                <p class="paragraph-1"><?php echo GetPageTranslation('platform_p1')?></p>
                <p class="paragraph-2"><?php echo GetPageTranslation('platform_p2')?></p>
                <a onclick="goto()" id="submitForm" class="btn btn-success buttonBanner "><?php echo GetPageTranslation('platform_btn')?></a>


                <div class="available-platforms">
                    <div class="perform-divider"></div>
                <h3><?php echo GetTermsTranslation('available_on')?></h3>
<!--                <a href="https://app.appsflyer.com/id1280873475?pid=Finq_Web"><img src="../Common/images/black/platforms/app-store.png"></a>-->
                <a href="#"><img src="../Common/images/black/platforms/app-store.png"></a>
                <a href="#"><img src="../Common/images/black/platforms/play-store.png"></a>
                <a href="#"><img src="../Common/images/black/platforms/web-trader.png"></a>
                </div>
            </div>
            <div class="col-6"></div>
        </div>
    </div>
    <div class="banner5">
        <div class="content">
            <div class="col-12">
                <h2 class="pc-version"><?php echo GetPageTranslation('banner5_title')?></h2>
                <p class="sub-title">
                    <?php echo GetPageTranslation('banner5_subtitle')?>
                </p>
            </div>

            <div class="col-12 ">
                <div class="col-4 width-50">
                    <div class="security-box">
                        <img src="img/icons/tools-gold.png">
                        <p class="p_bold"><?php echo GetPageTranslation('banner5_list_title_item_1')?></p>
                        <p class="p_light"> <?php echo GetPageTranslation('banner5_list_item_1')?></p>
                    </div>
                </div>
                <div id="cysec" class="col-4 width-50">
                    <div class="security-box">
                        <img src="img/icons/lock-gold.png">
                        <p class="p_bold"><?php echo GetPageTranslation('banner5_list_title_item_2')?></p>
                        <p class="p_light"><?php echo GetPageTranslation('banner5_list_item_2')?></p>
                    </div>
                </div>
                <div class="col-4 width-100">
                    <div class="security-box">
                        <img src="img/icons/cur-gold.png">
                        <p class="p_bold"><?php echo GetPageTranslation('banner5_list_title_item_3')?></p>
                        <p class="p_light"> <?php echo GetPageTranslation('banner5_list_item_3')?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php //include_once "../Common/Code/V2/TermsAndConditions/social.php"; ?>
<!--    social  -->
<?php //include_once "../Common/Code/V2/TermsAndConditions/social-v2.php"; ?>
<!--    payments  -->
<?php include_once "../Common/Code/V2/TermsAndConditions/payments.php"; ?>
<!--    terms-conditions  -->
<?php include_once "../Common/Code/V2/TermsAndConditions/terms-conditions-v2-uae.php"; ?>

<?php include_once "../Common/Code/V2/CSS-JS/Common-JS.php"; ?>
<!--<script src="js/tabs.js"></script>-->
<script src="js/others.js"></script>

<!--ScrollMagic-->
<script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/ScrollMagic.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/debug.addIndicators.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/animation.gsap.js"></script>
<script>
    function getUrlParameters(){
        var ret = "zone=" + document.getElementsByName("zone")[0].value +
                "&affiliateid=" + document.getElementsByName("affiliateid")[0].value +
                "&notes=" + document.getElementsByName("notes")[0].value +
            "&campaignId=" + document.getElementsByName("campaignId")[0].value +
            "&pid=" + document.getElementsByName("pid")[0].value +
            "&mid=" + document.getElementsByName("mid")[0].value +
            "&cid=" + document.getElementsByName("cid")[0].value +
            "&zid=" + document.getElementsByName("zid")[0].value +
            "&custom=" + document.getElementsByName("custom")[0].value +
            "&utm_parameters=" + document.getElementsByName("utm_parameters")[0].value +
            "&additional_parameters=" + document.getElementsByName("additional_parameters")[0].value;

        if (document.getElementsByName("bid")[0].value != ""){
            ret = ret + "&bid=" + document.getElementsByName("bid")[0].value;
        }

        return ret;
    }

    $( document ).ready(function() {
        var success_url = 'https://www.finq.com/mkt/lp/uae-trade-oil/success.php';

        document.getElementsByName("ret")[0].value = success_url;
    });

    function showForm() {
            document.getElementById('register').style.display='block';
            document.getElementById('box-white').classList.add("modal");
            document.getElementById('box-white').style.display='block';
            document.getElementById('box-white').style.maxWidth="100%";
            document.getElementById('x-button').style.display='block';
    }
    function hideForm() {
        document.getElementById('register').style.display='none';
        document.getElementById('box-white').classList.remove("modal");
        document.getElementById('box-white').style.display='none';
        document.getElementById('x-button').style.display='none';
    }
	$(document).ready(function() {
        $('#submitForm').html('<?php echo GetPageTranslation('btn')?>');
    });
    function  goto(){
        var scr_width = document.body.clientWidth;
        var go_to = "#banner1";
        TweenLite.to(window, 1, {scrollTo:go_to});
    }

</script>
    <!--Excluding OP and Alejandro-->
    <?php //include_once "../Common/Code/V2/CSS-JS/common-js-pixel-footer.php"; ?>
</body>
</html>