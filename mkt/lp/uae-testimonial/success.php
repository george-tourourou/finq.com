<?php
include_once "../Common/Code/V2/Countries.php";
include_once "../Common/Code/V2/Library.php";
include_once "../Common/Code/V2/Translations.php";

function getAvailableLanguages()
{
    return array("en",);
}
function getPageName(){
    return "UAE-Testimonial";
}

?>
<!DOCTYPE html>

<html lang="<?php echo GetCleanLanguageCode($langCode); ?>" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <link rel="stylesheet" href="css/styles.css">
    <?php include_once "../Common/Code/V2/Common-JS-CSS.php"; ?>
    <?php include_once "../Common/Code/V2/CSS-JS/heading.php"; ?>

    <!--  PIXELS SECTION -->

    <!-- Global site tag (gtag.js) - Google Ads: 826367109 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-826367109"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());



        gtag('config', 'AW-826367109');
    </script>


    <!-- Event snippet for Finq Lead Web conversion page -->
    <script>
        gtag('event', 'conversion', {'send_to': 'AW-826367109/3ikeCPn19JQBEIW5hYoD'});
    </script>
    <!-- END OFF PIXELS SECTION -->



</head>
<body style="float: none;" dir="<?php echo GetTextDirection($langCode); ?>" class="<?php echo GetTextDirection($langCode); ?> lang-<?php echo GetCleanLanguageCode($langCode); ?>">
<?php
include_once "../Common/Code/V2/CSS-JS/onPageStart.php";
?>


<div class='col-12' id="success-page">
    <div class='content success' id="register">
        <div class="col-12 register">
            <img src="../Common/images/logos/black_finq.png" class='logo' />
            <p style="margin-top:15px; margin-bottom: 30px;">Thank you for registering</p>
            <div class="finq-button"><a href="https://www.finq.com/en/live-registration?<?php echo $_SERVER['QUERY_STRING']; ?>">Complete Registration</a></div>
        </div>
    </div>
</div>
<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '1412468758852051');

 
fbq('track', 'Lead');

</script>

<!-- End Facebook Pixel Code -->

</body>
</html>