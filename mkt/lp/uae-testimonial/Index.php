<?php
session_start();

function getAvailableLanguages()
{
    return array("en","ar","es");
}
function getPageName(){
    return "finq.com uae-testimonial";
}
?>

<?php include_once "../Common/Code/V2/Countries.php"; ?>
<?php include_once "../Common/Code/V2/Library.php"; ?>
<?php include_once "../Common/Code/PopularInstruments/PopularInstruments.php"; ?>
<?php
include_once "../Common/Code/V2/Translations.php";
include_once 'php/phpGetBonus.php';
include_once "PageTranslations.php";

$campaignId = "444685b6-53bf-413a-b504-b76416f6c1fb";



getData();


?>

<!DOCTYPE html>
<html lang="<?php echo GetCleanLanguageCode(); ?>" xmlns="http://www.w3.org/1999/xhtml">
<head>

    <link rel="" href="https://www.finq.com/sites/all/themes/finq/images/Favicon/favicon.ico" rel="shortcut icon" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700,800" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo str_replace("<br/>","", GetPageTranslation('head_title')); ?></title>
	<?php include_once "../Common/Code/V2/CSS-JS/heading.php"; ?>
    <link href="css/styles.css?v=<?php echo generateRandomString(); ?>" rel="stylesheet" />
    <link href="css/tabs.css?v=<?php echo generateRandomString(); ?>" rel="stylesheet" />


<!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.2/TweenMax.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.2/plugins/ScrollToPlugin.min.js"></script>
<!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.2/plugins/CSSPlugin.min.js"></script>-->
<!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.2/easing/EasePack.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.2/TweenLite.min.js"></script>

<!--ScrollMagic-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/ScrollMagic.js"></script>
<!--    <script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/debug.addIndicators.js"></script>-->
<!--    <script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/animation.gsap.js"></script>-->


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
	<div class="banner1 col-12">
        <div class="content version1">
            <div class="col-12 logo-row">
                <img class='logo' src="../Common/images/logos/logo_white_txt.svg" />
                <div class="pull-right available-platforms">
                    <p><?php echo GetTermsTranslation('available_on')?></p>
                    <a class="webtrade" href=""><!---https://lp.finq.com/campaign/Common/images/black/platforms/web-trader.png-->
                        <img class="white-img" src="img/webtrade.png"></a>
                    <a class="" href="#">
                        <img class="white-img" src="img/play-store.png"></a>
<!--                    <a class="" href="https://app.appsflyer.com/id1280873475?pid=Finq_Web">-->
                    <a class="" href="#">
                        <img class="white-img" src="img/app-store.png"></a>
                </div>
            </div>
            <div class="col-12">
                <div class="col-7">

                    <h1><?php echo GetPageTranslation('title')?></h1>
                    <div class="col-5"><img src="img/banner1/<?php echo GetCleanLanguageCode(); ?>/man-testimonial-header.png"></div>
                    <div class="col-7">
                        <p class="testimonial-text">
                            <?php echo GetPageTranslation('head_testimonial')?>
                        </p>
                        <p class="testimonial-name">
                            <?php echo GetPageTranslation('head_testimonial_name')?>
                        </p>
                    </div>
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
            </div>
        </div>
    </div>
    <div id="banner2" class="banner2 banner-border col-12 ">
        <div class="content tablet-version">
            <div class="col-12 customer"><img src="img/banner1/<?php echo GetCleanLanguageCode(); ?>/man-testimonial-header.png"></div>
            <div class="col-12">
                <p class="testimonial-text">
                    <?php echo GetPageTranslation('head_testimonial')?>
                </p>
                <p class="testimonial-name">
                    <?php echo GetPageTranslation('head_testimonial_name')?>
                </p>
                <button id="user-agent-btn" onclick="showForm()" class="buttonBanner button_white_green btn">
                    DOWNLOAD APP
                </button>
            </div>
        </div>
        <div class="content">
            <div class="col-12">
                <h2 class="blue-clr reverse"><?php echo GetPageTranslation('banner2_title')?></h2>
            </div>
        </div>
        <div class="col-12" id="tab-slideshow">
            <div class="content">
                <div class="tab">
                    <a class="tablinks" onclick="openCity(event, 'forex')"><?php echo GetPageTranslation('banner2_tap1')?></a>
                    <a class="tablinks" onclick="openCity(event, 'stocks')"><?php echo GetPageTranslation('banner2_tap2')?></a>
                    <a id="defaultOpen" class="tablinks" onclick="openCity(event, 'commodities')"><?php echo GetPageTranslation('banner2_tap3')?></a>
<!--                    <a class="tablinks" onclick="openCity(event, 'crypto')">--><?php //echo GetPageTranslation('banner2_tap4')?><!--</a>-->
                    <a class="tablinks" onclick="openCity(event, 'indices')"><?php echo GetPageTranslation('banner2_tap5')?></a>
                </div>
            </div>
            <div class="content">
                <div id="forex" class="tabcontent">
                    <div class="col-12">
                        <div class="width-20 forex">
                            <div class="assets-box">
                                <img src="img/forex/eur-usd.png">
                                <p><?php echo GetPageTranslation('banner2_tap1_item1')?></p>
                                <?php $inputs=getPrice('eurusd');?>
                                <p class="<?php echo getTagSize ($inputs[0]);?>">        
                                    <?php echo $inputs[0];?>
                                </p>
                                <p class="<?php echo $inputs[1];?>">
                                    <i class="fa <?php echo ($inputs[1] == 'up') ? 'fa-long-arrow-up' : 'fa-long-arrow-down';?>" aria-hidden="true"></i>
                                    <span> <?php echo $inputs[2];?>% </span>last 6m
                                </p>
                            </div>                        
                        </div>
                        <div class="width-20 forex">
                            <div class="assets-box">
                                <img src="img/forex/usd-jpn.png">
                                <p><?php echo GetPageTranslation('banner2_tap1_item2');$inputs=getPrice('usdjpy');?></p>
                                
                                <p class="<?php echo getTagSize ($inputs[0]);?>"><?php 
                                        
                                        echo $inputs[0];
                                ?></p>
                                <p class="<?php echo $inputs[1];?>">
                                    <i class="fa  <?php echo ($inputs[1] == 'up') ? 'fa-long-arrow-up' : 'fa-long-arrow-down';?>" aria-hidden="true"></i>
                                    <span><?php echo $inputs[2];?>% </span>last 6m
                                </p>
                            </div>
                        </div>
                        <div class="width-20 forex">
                            <div class="assets-box">
                                <img src="img/forex/gbp-usd.png">
                                <p><?php echo GetPageTranslation('banner2_tap1_item3');$inputs=getPrice('gbpusd');?></p>
                                <p class="<?php echo getTagSize ($inputs[0]); ?>"><?php
                                    echo $inputs[0];
                                ?></p>
                                <p class="<?php echo $inputs[1];?>">
                                    <i class="fa  <?php echo ($inputs[1] == 'up') ? 'fa-long-arrow-up' : 'fa-long-arrow-down';?>" aria-hidden="true"></i>
                                    <span> <?php echo $inputs[2];?>% </span>last 6m
                                </p>
                            </div>
                        </div>
                        <div class="width-20 forex">
                            <div class="assets-box">
                                <img src="img/forex/usd-chf.png">
                                <p><?php echo GetPageTranslation('banner2_tap1_item4');$inputs=getPrice('usdchf');?></p>
                                <p class="<?php echo getTagSize ($inputs[0]);?>"><?php echo $inputs[0]; ?></p>
                                <p class="<?php echo $inputs[1];?>">
                                    <i class="fa  <?php echo ($inputs[1] == 'up') ? 'fa-long-arrow-up' : 'fa-long-arrow-down';?>" aria-hidden="true"></i>
                                    <span> <?php echo $inputs[2];?>% </span>last 6m
                                </p>                           
                            </div>

                        </div>
                        <div class="width-20 forex">
                            <div class="assets-box">
                                <img src="img/forex/eur-gbp.png">
                                <p><?php echo GetPageTranslation('banner2_tap1_item5');$inputs=getPrice('eurgbp');?></p>
                                <p class="<?php echo getTagSize ($inputs[0]);?>"><?php echo $inputs[0]; ?></p>
                                <p class="<?php echo $inputs[1];?>">
                                    <i class="fa  <?php echo ($inputs[1] == 'up') ? 'fa-long-arrow-up' : 'fa-long-arrow-down';?>" aria-hidden="true"></i>
                                    <span> <?php echo $inputs[2];?>% </span>last 6m
                                </p>                          
                            </div>

                        </div>
                    </div>
                </div>
                <div id="stocks" class="tabcontent">
                    <div class="col-12">
                        <div class="width-20 stocks">
                            <div class="assets-box">
                                <img src="img/stocks/apple.png">
                                <p><?php echo GetPageTranslation('banner2_tap2_item1');$inputs=getPrice('apple');?></p>
                                <p class="<?php echo getTagSize ($inputs[0]);?>"><?php echo number_format($inputs[0],2); ?></p>
                                <p class="<?php echo $inputs[1];?>">
                                    <i class="fa  <?php echo ($inputs[1] == 'up') ? 'fa-long-arrow-up' : 'fa-long-arrow-down';?>" aria-hidden="true"></i>
                                    <span> <?php echo $inputs[2];?>% </span>last 6m
                                </p>
                            </div>                        
                        </div>
                        <div class="width-20 stocks">
                            <div class="assets-box">
                                <img src="img/stocks/facebook.png">
                                <p><?php echo GetPageTranslation('banner2_tap2_item2');$inputs=getPrice('facebook');?></p>
                                <p class="<?php echo getTagSize ($inputs[0]);?>"><?php echo number_format($inputs[0],2); ?></p>
                                <p class="<?php echo $inputs[1];?>">
                                    <i class="fa  <?php echo ($inputs[1] == 'up') ? 'fa-long-arrow-up' : 'fa-long-arrow-down';?>" aria-hidden="true"></i>
                                    <span> <?php echo $inputs[2];?>% </span>last 6m
                                </p>
                            </div>
                        </div>
                        <div class="width-20 stocks">
                            <div class="assets-box">
                                <img src="img/stocks/hp.png">
                                <p><?php echo GetPageTranslation('banner2_tap2_item3'); $inputs=getPrice('hp');?></p>
                                <p class="<?php echo getTagSize ($inputs[0]);?>"><?php echo number_format($inputs[0],2);?></p>
                                <p class="<?php echo $inputs[1];?>">
                                    <i class="fa  <?php echo ($inputs[1] == 'up') ? 'fa-long-arrow-up' : 'fa-long-arrow-down';?>" aria-hidden="true"></i>
                                    <span> <?php echo $inputs[2];?>% </span>last 6m
                                </p>
                            </div>
                        </div>
                        <div class="width-20 stocks">
                            <div class="assets-box">
                                <img src="img/stocks/nike.png">
                                <p><?php echo GetPageTranslation('banner2_tap2_item4'); $inputs=getPrice('nike');?></p>
                                <p class="<?php echo getTagSize ($inputs[0]);?>"><?php echo number_format($inputs[0],2);?></p>
                                <p class="<?php echo $inputs[1];?>">
                                    <i class="fa  <?php echo ($inputs[1] == 'up') ? 'fa-long-arrow-up' : 'fa-long-arrow-down';?>" aria-hidden="true"></i>
                                    <span> <?php echo $inputs[2];?>% </span>last 6m
                                </p>                     
                            </div>
                        </div>
                        <div class="width-20 stocks">
                            <div class="assets-box">
                                <img src="img/stocks/google.png">
                                <p><?php echo GetPageTranslation('banner2_tap2_item5'); $inputs=getPrice('google');?></p>
                                <p class="<?php echo getTagSize ($inputs[0]);?>"><?php echo number_format($inputs[0],2);?></p>
                                <p class="<?php echo $inputs[1];?>">
                                    <i class="fa  <?php echo ($inputs[1] == 'up') ? 'fa-long-arrow-up' : 'fa-long-arrow-down';?>" aria-hidden="true"></i>
                                    <span> <?php echo $inputs[2];?>% </span>last 6m
                                </p>                           
                            </div>

                        </div>
                    </div>
                </div>
                <div id="commodities" class="tabcontent">
                    <div class="col-12">
                        <div class="width-20 commodities">
                            <div class="assets-box ">
                                <img src="img/commodities/gold.png">
                                <p><?php echo GetPageTranslation('banner2_tap3_item1'); $inputs=getPrice('gold');?></p>
                                <p class="<?php echo getTagSize ($inputs[0]);?>"><?php echo number_format($inputs[0],2);?></p>
                                <p class="<?php echo $inputs[1];?>">
                                    <i class="fa  <?php echo ($inputs[1] == 'up') ? 'fa-long-arrow-up' : 'fa-long-arrow-down';?>" aria-hidden="true"></i>
                                    <span> <?php echo $inputs[2];?>% </span>last 6m
                                </p>
                            </div>                        
                        </div>
                        <div class="width-20 commodities">
                            <div class="assets-box">
                                <img src="img/commodities/wheat.png">
                                <p><?php echo GetPageTranslation('banner2_tap3_item2'); $inputs=getPrice('wheat');?></p>
                                <p class="<?php echo getTagSize ($inputs[0]);?>"><?php echo number_format($inputs[0],2);?></p>
                                <p class="<?php echo $inputs[1];?>">
                                    <i class="fa  <?php echo ($inputs[1] == 'up') ? 'fa-long-arrow-up' : 'fa-long-arrow-down';?>" aria-hidden="true"></i>
                                    <span> <?php echo $inputs[2];?>% </span>last 6m
                                </p>
                            </div>
                        </div>
                        <div class="width-20 commodities">
                            <div class="assets-box">
                                <img src="img/commodities/oil.png">
                                <p><?php echo GetPageTranslation('banner2_tap3_item3'); $inputs=getPrice('oil');?></p>
                                <p class="<?php echo getTagSize ($inputs[0]);?>"><?php echo number_format($inputs[0],2);?></p>
                                <p class="<?php echo $inputs[1];?>">
                                    <i class="fa <?php echo ($inputs[1] == 'up') ? 'fa-long-arrow-up' : 'fa-long-arrow-down';?>" aria-hidden="true"></i>
                                    <span> <?php echo $inputs[2];?>% </span>last 6m
                                </p>
                            </div>
                        </div>
                        <div class="width-20 commodities">
                            <div class="assets-box">
                                <img src="img/commodities/coffee.png">
                                <p><?php echo GetPageTranslation('banner2_tap3_item4'); $inputs=getPrice('coffeec');?></p>
                                <p class="<?php echo getTagSize ($inputs[0]);?>"><?php echo number_format($inputs[0],2);?></p>
                                <p class="<?php echo $inputs[1];?>">
                                    <i class="fa  <?php echo ($inputs[1] == 'up') ? 'fa-long-arrow-up' : 'fa-long-arrow-down';?>" aria-hidden="true"></i>
                                    <span> <?php echo $inputs[2];?>% </span>last 6m
                                </p>                           
                            </div>

                        </div>
                        <div class="width-20 commodities">
                            <div class="assets-box">
                                <img src="img/commodities/cotton.png">
                                <p><?php echo GetPageTranslation('banner2_tap3_item5'); $inputs=getPrice('cotton');?></p>
                                <p class="<?php echo getTagSize ($inputs[0]);?>"><?php echo number_format($inputs[0],2);?></p>
                                <p class="<?php echo $inputs[1];?>">
                                    <i class="fa  <?php echo ($inputs[1] == 'up') ? 'fa-long-arrow-up' : 'fa-long-arrow-down';?>" aria-hidden="true"></i>
                                    <span> <?php echo $inputs[2];?>% </span>last 6m
                                </p>                            
                            </div>

                        </div>
                    </div>
                </div>
<!--                <div id="crypto" class="tabcontent">-->
<!--                    <div class="col-12">-->
<!--                        <div class="width-20 crypto">-->
<!--                            <div class="assets-box">-->
<!--                                <img src="img/crypto/bitcoin.png">-->
<!--                                <p>--><?php //echo GetPageTranslation('banner2_tap4_item1'); $inputs=getPrice('bitcoin');?><!--</p>-->
<!--                                <p class="--><?php //echo getTagSize ($inputs[0]);?><!--">--><?php //echo $inputs[0];?><!--</p>-->
<!--                                <p class="--><?php //echo $inputs[1];?><!--">-->
<!--                                    <i class="fa  --><?php //echo ($inputs[1] == 'up') ? 'fa-long-arrow-up' : 'fa-long-arrow-down';?><!--" aria-hidden="true"></i>-->
<!--                                    <span> --><?php //echo $inputs[2];?><!--% </span>last 6m-->
<!--                                </p>-->
<!--                            </div>                        -->
<!--                        </div>-->
<!--                        <div class="width-20 crypto">-->
<!--                            <div class="assets-box">-->
<!--                                <img src="img/crypto/ethereum.png">-->
<!--                                <p>--><?php //echo GetPageTranslation('banner2_tap4_item2'); $inputs=getPrice('ethereum');?><!--</p>-->
<!--                                <p class="--><?php //echo getTagSize ($inputs[0]);?><!--">--><?php //echo $inputs[0];?><!--</p>-->
<!--                                <p class="--><?php //echo $inputs[1];?><!--">-->
<!--                                    <i class="fa  --><?php //echo ($inputs[1] == 'up') ? 'fa-long-arrow-up' : 'fa-long-arrow-down';?><!--" aria-hidden="true"></i>-->
<!--                                    <span> --><?php //echo $inputs[2];?><!--% </span>last 6m-->
<!--                                </p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="width-20 crypto">-->
<!--                            <div class="assets-box">-->
<!--                                <img src="img/crypto/ripple.png">-->
<!--                                <p>--><?php //echo GetPageTranslation('banner2_tap4_item3'); $inputs=getPrice('ripple');?><!--</p>-->
<!--                                <p class="--><?php //echo getTagSize ($inputs[0]);?><!--">--><?php //echo $inputs[0];?><!--</p>-->
<!--                                <p class="--><?php //echo $inputs[1];?><!--">-->
<!--                                    <i class="fa  --><?php //echo ($inputs[1] == 'up') ? 'fa-long-arrow-up' : 'fa-long-arrow-down';?><!--" aria-hidden="true"></i>-->
<!--                                    <span> --><?php //echo $inputs[2];?><!--% </span>last 6m-->
<!--                                </p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="width-20 crypto">-->
<!--                            <div class="assets-box">-->
<!--                                <img src="img/crypto/litecoin.png">-->
<!--                                <p>--><?php //echo GetPageTranslation('banner2_tap4_item4');$inputs=getPrice('litecoin');?><!--</p>-->
<!--                                <p class="--><?php //echo getTagSize ($inputs[0]);?><!--">--><?php //echo $inputs[0];?><!--</p>-->
<!---->
<!--                                <p class="--><?php //echo $inputs[1];?><!--">-->
<!--                                    <i class="fa --><?php //echo ($inputs[1] == 'up') ? 'fa-long-arrow-up' : 'fa-long-arrow-down';?><!--" aria-hidden="true"></i>-->
<!--                                    <span> --><?php //echo $inputs[2];?><!--% </span>last 6m-->
<!--                                </p>                          -->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="width-20 crypto">-->
<!--                            <div class="assets-box">-->
<!--                                <img src="img/crypto/dash.png">-->
<!--                                <p>--><?php //echo GetPageTranslation('banner2_tap4_item5')?><!--</p>-->
<!--                                --><?php //$inputs=getPrice('dash');?>
<!--                                <p class="--><?php //echo getTagSize ($inputs[0]);?><!--">-->
<!--                                    --><?php //echo $inputs[0];?>
<!--                                </p>-->
<!---->
<!--                                <p class="--><?php //echo $inputs[1];?><!--">-->
<!--                                    <i class="fa --><?php //echo ($inputs[1] == 'up') ? 'fa-long-arrow-up' : 'fa-long-arrow-down';?><!--" aria-hidden="true"></i>-->
<!--                                    <span> --><?php //echo $inputs[2];?><!--% </span>last 6m-->
<!--                                </p>                           -->
<!--                            </div>-->
<!---->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
                <div id="indices" class="tabcontent">
                    <div class="col-12">
                        <div class="width-20 indices">
                            <div class="assets-box">
                                <img src="img/indices/cac.png">
                                <p><?php echo GetPageTranslation('banner2_tap5_item1')?></p>
                                <?php $inputs=getPrice('france40');?>
                                <p class="<?php echo getTagSize ($inputs[0]);?>">
                                    <?php echo number_format($inputs[0],2);?>
                                </p>
                                <p class="<?php echo $inputs[1];?>">
                                    <i class="fa <?php echo ($inputs[1] == 'up') ? 'fa-long-arrow-up' : 'fa-long-arrow-down';?>" aria-hidden="true"></i>
                                    <span> <?php echo $inputs[2];?>% </span>last 6m
                                </p>
                            </div>                        
                        </div>
                        <div class="width-20 indices">
                            <div class="assets-box">
                                <img src="img/indices/s-p.png">
                                <p><?php echo GetPageTranslation('banner2_tap5_item2')?></p>
                                <?php $inputs=getPrice('usa500');?>
                                <p class="<?php echo getTagSize ($inputs[0]);?>">
                                    <?php echo number_format($inputs[0],2);?>
                                </p>
                                <p class="<?php echo $inputs[1];?>">
                                    <i class="fa <?php echo ($inputs[1] == 'up') ? 'fa-long-arrow-up' : 'fa-long-arrow-down';?>" aria-hidden="true"></i>
                                    <span><?php echo $inputs[2];?>% </span>last 6m
                                </p>
                            </div>
                        </div>
                        <div class="width-20 indices">
                            <div class="assets-box">
                                <img src="img/indices/nikkei.png">
                                <p><?php echo GetPageTranslation('banner2_tap5_item3')?></p>
                                <?php  $inputs=getPrice('japan225');?>
                                <p class="<?php echo getTagSize ($inputs[0]);?>">
                                    <?php echo number_format($inputs[0],2);?>
                                </p>
                                <p class="<?php echo $inputs[1];?>">
                                    <i class="fa <?php echo ($inputs[1] == 'up') ? 'fa-long-arrow-up' : 'fa-long-arrow-down';?>" aria-hidden="true"></i>
                                    <span> <?php echo $inputs[2];?>% </span>last 6m
                                </p>
                            </div>
                        </div>
                        <div class="width-20 indices">
                            <div class="assets-box">
                                <img src="img/indices/ftse.png">
                                <p><?php echo GetPageTranslation('banner2_tap5_item4')?></p>
                                <?php $inputs=getPrice('uk100');?>
                                <p class="<?php echo getTagSize ($inputs[0]);?>">
                                    <?php  echo number_format($inputs[0],2);?>
                                </p>
                                <p class="<?php echo $inputs[1];?>">
                                    <i class="fa <?php echo ($inputs[1] == 'up') ? 'fa-long-arrow-up' : 'fa-long-arrow-down';?>" aria-hidden="true"></i>
                                    <span><?php echo $inputs[2];?>% </span>last 6m
                                </p>                            
                            </div>
                        </div>
                        <div class="width-20 indices">
                            <div class="assets-box">
                                <img src="img/indices/italy40.png">
                                <p><?php echo GetPageTranslation('banner2_tap5_item5')?></p>
                                <?php $inputs=getPrice('italy40');?>
                                <p class="<?php echo getTagSize ($inputs[0]);?>">
                                    <?php echo number_format($inputs[0],2);?></p>
                                <p class="<?php echo $inputs[1];?>">
                                    <i class="fa <?php echo ($inputs[1] == 'up') ? 'fa-long-arrow-up' : 'fa-long-arrow-down';?>" aria-hidden="true"></i>
                                    <span><?php echo $inputs[2];?>% </span>last 6m
                                </p>                             
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12" >
            <div class="arrows" >
                <a class="prev" onclick="plusSlidesTap(-1)"><span><img src="img/icons/left-arrow.png"></span></a>
                <a class="next" onclick="plusSlidesTap(1)"><span><img src="img/icons/right.png"></span></a>
                
            </div>
        </div>
    </div>
    <div id="" class="banner6 col-12">
        <div class="content">
            <h2><?php echo GetPageTranslation('banner6_title')?></h2>
            <div class="row">
                <div class="col-4 benefits">
                    <div><img src="img/icons/benefits-icon4.png"></div>
                    <div class="benefits-content-line"></div>
                    <p> <?php echo GetPageTranslation('banner6_item4')?></p>
                </div>
                <div class="col-4 benefits">
                    <div><img src="img/icons/benefits-icon1.png"></div>
                    <div class="benefits-content-line"></div>
                    <p> <?php echo GetPageTranslation('banner6_item1')?></p>
                </div>
<!--                <div class="col-4 benefits">-->
<!--                    <div>-->
<!--                        <img src="img/icons/benefits-icon2.png">-->
<!--                    </div>-->
<!--                    <div class="benefits-content-line"></div>-->
<!--                    <p> --><?php //echo GetPageTranslation('banner6_item2')?><!--</p>-->
<!--                </div>-->
                <div class="col-4 benefits">
                    <div><img src="img/icons/benefits-icon3.png"></div>
                    <div class="benefits-content-line"></div>
                    <p> <?php echo GetPageTranslation('banner6_item3')?></p>
                </div>
                <div class="col-4 benefits">
                    <div><img src="img/icons/benefits-icon5.png"></div>
                    <div class="benefits-content-line"></div>
                    <p> <?php echo GetPageTranslation('banner6_item5')?></p>
                </div>
            </div>
        </div>
    </div>
    <div id="testimonials" class="testimonials">
        <div class="testimonials-customer1 testimonial-customer" style="display: none;">
            <div class="content">
                <div class="col-6">
                </div>
                <div class="col-6 testimonials-content slider-picture1 ">
                    <h2><?php echo GetPageTranslation('testimonial_h2_1')?></h2>
                    <p class="testimonial-text"><?php echo GetPageTranslation('testimonial_text_1')?></p>
                    <p class="testimonial-name"><?php echo GetPageTranslation('testimonial_name_1')?></p>
<!--                    <p class="testimonial-trading">--><?php //echo GetPageTranslation('testimonial_trading_1')?><!--</p>-->
                    <a onclick="goto()" id="submitForm" class="btn btn-success buttonBanner "><?php echo GetPageTranslation('testimonial_btn')?></a>
                </div>
            </div>
        </div>

        <div class="testimonials-customer2 testimonial-customer" style="display: none;">
            <div class="content">
                <div class="col-6 testimonials-content">
                    <h2><?php echo GetPageTranslation('testimonial_h2_2')?></h2>
                    <p class="testimonial-text"><?php echo GetPageTranslation('testimonial_text_2')?></p>
                    <p class="testimonial-name"><?php echo GetPageTranslation('testimonial_name_2')?></p>
<!--                    <p class="testimonial-trading">--><?php //echo GetPageTranslation('testimonial_trading_2')?><!--</p>-->
                    <a onclick="goto()" id="submitForm" class="btn btn-success buttonBanner "><?php echo GetPageTranslation('testimonial_btn')?></a>
                </div>
                <div class="col-6">
                </div>
            </div>
        </div>

        <div class="testimonials-customer3 testimonial-customer">
            <div class="content">
                <div class="testimonials-content slider-picture1 col-6">
                    <h2><?php echo GetPageTranslation('testimonial_h2_3')?></h2>
                    <p class="testimonial-text"><?php echo GetPageTranslation('testimonial_text_3')?></p>
                    <p class="testimonial-name"><?php echo GetPageTranslation('testimonial_name_3')?></p>
<!--                    <p class="testimonial-trading">--><?php //echo GetPageTranslation('testimonial_trading_3')?><!--</p>-->
                    <a onclick="goto()" id="submitForm" class="btn btn-success buttonBanner "><?php echo GetPageTranslation('testimonial_btn')?></a>
                </div>
            </div>
        </div>
        <div class="testimonials-slider">
            <div class="slider-wrapper">
                <div class="slider-elem2">
<!--                    <img src="img/testimonials/--><?php //echo GetCleanLanguageCode(); ?><!--/slider-elem1.png" onclick="showTestimonials(1)" class="slider-elem2-selected">-->
                    <img src="img/testimonials/photographer-small.jpg" onclick="showTestimonials(1)" class="slider-elem2-selected">

                </div>
                <div class="slider-elem2" onclick="showTestimonials(2)">
                    <img src="img/testimonials/accountant-small.jpg">
                </div>
                <div class="slider-elem2 active" onclick="showTestimonials(3)">
                    <img src="img/testimonials/owner-small.jpg">
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
                <div class="perform-divider"></div>
<!--                <h3>--><?php //echo GetTermsTranslation('available_on')?><!--</h3>-->
<!--<!--                <a href="https://app.appsflyer.com/id1280873475?pid=Finq_Web"><img src="../Common/images/black/platforms/app-store.png"></a>-->
<!--                <a class="webtrade" href="#"><img src="../Common/images/black/platforms/app-store.png"></a>-->
<!--                <a href="#"><img src="../Common/images/black/platforms/play-store.png"></a>-->
<!--                <a href="#"><img src="../Common/images/black/platforms/web-trader.png"></a>-->

            </div>
            <div class="col-6"></div>
        </div>
    </div>
    <div class="banner5">
        <div class="content">
            <div class="col-12">
                <h2>
                    <?php echo GetPageTranslation('banner5_title')?>
                </h2>
                <p class="sub-title">
                    <?php echo GetPageTranslation('banner5_subtitle')?>
                </p>
            </div>

            <div class="col-12 ">
                <div class="col-4 width-50">
                    <div class="security-box">
                        <img src="img/icons/tools-gold-2.png">
                        <p class="p_bold"><?php echo GetPageTranslation('banner5_list_title_item_1')?></p>
                        <p class="p_light"> <?php echo GetPageTranslation('banner5_list_item_1')?></p>
                    </div>
                </div>
                <div id="cysec" class="col-4 width-50">
                    <div class="security-box">
                        <img src="img/icons/lock-gold-2.png">
                        <p class="p_bold"><?php echo GetPageTranslation('banner5_list_title_item_2')?></p>
                        <p class="p_light"><?php echo GetPageTranslation('banner5_list_item_2')?></p>
                    </div>
                </div>
                <div class="col-4 width-100">
                    <div class="security-box">
                        <img src="img/icons/cur-gold-2.png">
                        <p class="p_bold"><?php echo GetPageTranslation('banner5_list_title_item_3')?></p>
                        <p class="p_light"> <?php echo GetPageTranslation('banner5_list_item_3')?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php //include_once "../Common/Code/V2/TermsAndConditions/social.php"; ?>
<?php //include_once "../Common/Code/V2/TermsAndConditions/social-v2.php"; ?>
<?php include_once "../Common/Code/V2/TermsAndConditions/payments.php"; ?>
<?php include_once "../Common/Code/V2/TermsAndConditions/terms-conditions-v2-uae.php"; ?>

<?php include_once "../Common/Code/V2/CSS-JS/Common-JS.php"; ?>
<script src="js/tabs.js"></script>
<script src="js/others.js"></script>

<!--ScrollMagic-->
<script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/ScrollMagic.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/debug.addIndicators.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/animation.gsap.js"></script>
<script>
    $( document ).ready(function() {
        document.getElementsByName("ret")[0].value = "https://www.finq.com/mkt/lp/uae-testimonial/success.php";
    });


    var slideIndex = 1;
    var slide_num = 0;

    document.getElementsByTagName("BODY")[0].onresize = function() {
        var scr_width = document.getElementById("tab-slideshow").offsetWidth;
        if (scr_width > 960){
            slide_num = 5;
        }else if(scr_width < 959 && scr_width > 720){
            slide_num = 3;
        }
        else if(scr_width < 719){
            slide_num = 1;
        }
        showSlidesTap(0);
    };
    document.getElementsByTagName("BODY")[0].onload = function() {
        var scr_width = document.getElementById("tab-slideshow").offsetWidth;
        if (scr_width > 960){
            slide_num = 5;
        }else if(scr_width < 959 && scr_width > 720){
            slide_num = 3;
        }
        else if(scr_width < 719){
            slide_num = 1;
        }
        showSlidesTap(0);
    };

    function plusSlidesTap(n){
        showSlidesTap(slideIndex += n); 
    }

    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlidesTap(n) {
        var i;
        var slidesforex = document.getElementsByClassName("forex");
        var slidesStocks = document.getElementsByClassName("stocks");
        var slidesCommodities = document.getElementsByClassName("commodities");
        //var slidesCrypto = document.getElementsByClassName("crypto");
        var slidesIndices = document.getElementsByClassName("indices");

        if (n > slidesforex.length) {
            slideIndex = 1;
        }

        show_hide(slidesforex,n);
        show_hide(slidesStocks,n);
        show_hide(slidesCommodities,n);
        //show_hide(slidesCrypto,n);
        show_hide(slidesIndices,n);

    }
    
    function show_hide(slidesAssets,n){
        if (n < 1) {slideIndex = slidesAssets.length}
        for (i = 0; i < slidesAssets.length; i++) {
            slidesAssets[i].style.display = "none";
        }
        for (i = 0; i < slide_num; i++) {
            if ((slideIndex-1+i)< slidesAssets.length){
                slidesAssets[slideIndex-1+i].style.display = "block";
            }else {
                showSlidesTap(slidesAssets.length+2);
            }
        }
    }
   
    function showForm() {
            document.getElementById('register').style.display='block';
            document.getElementById('box-white').classList.add("modal");
            document.getElementById('box-white').style.display='block';
            document.getElementById('box-white').style.maxWidth="100%";
            document.getElementById('x-button').style.display='block';
//        }

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

    function  goto()
    {
        var scr_width = document.body.clientWidth;
        var go_to = "#box-white";
        TweenLite.to(window, 1, {scrollTo:go_to});
    }

    var isAndroid = false;
    var isOS = false;
    var isWindows = false;
//    if( navigator.userAgent.match(/Android/i)){
//        isAndroid = true;
//    }
//    else if(navigator.userAgent.match(/webOS/i)
//    || navigator.userAgent.match(/iPhone/i)
//    || navigator.userAgent.match(/iPad/i)
//    || navigator.userAgent.match(/iPod/i)){
//        isOS = true;
//    }else{
//        isWindows =true;
//    }

    $(document).ready(function() {
//        if (isAndroid==true){
//            $('#user-agent-btn').html('<?php //echo GetPageTranslation('download_app')?>//');
//        }else if(isOS==true){
//            $('#user-agent-btn').html('<?php //echo GetPageTranslation('download_app')?>//');
//        }else {
            $('#user-agent-btn').html('<?php echo GetPageTranslation('btn')?>');
//        }
//
    });


    function showTestimonials(n) {
        var i;
        var slides = document.getElementsByClassName("testimonial-customer");

        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }

        slides[n-1].style.display = "block";
        slides[n-1].addClass = "active";

        var slides1 = document.getElementsByClassName("slider-elem2");
        for (i = 0; i < slides.length; i++) {
            slides1[i].classList.remove("active");
        }
        slides1[n-1].classList.add("active");
    }
</script>
    <!--Excluding OP and Alejandro-->
    <?php //include_once "../Common/Code/V2/CSS-JS/common-js-pixel-footer.php"; ?>
</body>
</html>