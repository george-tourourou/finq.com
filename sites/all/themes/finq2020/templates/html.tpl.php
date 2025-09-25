<?php
	include 'page-title.php';
 
	function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
	function IsAdmin() {	  
	  if (in_array('administrator', array_values($GLOBALS['user']->roles))) { 
		return true;	 
	  }
	  
	  return false;
	}
	
if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }

	
if (isset($ip)) {
	setcookie("SESSip", $ip, time()+5184000, "/");
}

$queryParams = $_SERVER['QUERY_STRING'];

if(!empty($queryParams))  {
	$cookie_name = "SESSurl_params";
	$cookie_value = str_replace("%3D", "=", $queryParams);
	setcookie($cookie_name, $cookie_value, time()+5184000, "/");
}	
	
	
?>
<!DOCTYPE html>
<html lang="<?php print $language->language; ?>" class="no-js" dir="<?php print $language->dir; ?>"<?php print $rdf_namespaces;?>>
<head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-R67REHWN27"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-R67REHWN27');
</script>

  <meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">  
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="google-play-app" content="app-id=com.finq.android">

		<meta property="og:image" content="http://www.finq.com/sites/all/themes/finq/images/v2.0/social-media/finq-share.jpg" />


	<link href="/sites/all/themes/finq/images/Favicon/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <?php
		if(IsAdmin()) { ?>
    <link rel="stylesheet" href="/sites/all/themes/finq/css/Components/Admin.css" />
    <link rel="stylesheet" href="/sites/all/modules/contrib/admin_menu/admin_menu.css" />
    <link rel="stylesheet" href="/sites/all/modules/contrib/admin_menu/admin_menu_toolbar/admin_menu_toolbar.css" />
    <link rel="stylesheet" href="/modules/contextual/contextual.css" />

    <link rel="stylesheet" href="/sites/all/themes/shiny/css/contrib.css" />
    <link rel="stylesheet" href="/sites/all/themes/shiny/css/jquery.ui.theme.css" />
    <link rel="stylesheet" href="/sites/all/themes/shiny/css/shiny.css" />
    <link rel="stylesheet" href="/sites/all/themes/shiny/css/style.css" />
    <link rel="stylesheet" href="/sites/all/themes/shiny/css/vertical-tabs.css" />
    <link rel="stylesheet" href="/sites/all/themes/shiny/css/views-admin.shiny.css" />
    <?php }
    ?>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
  
	<script src="/sites/all/themes/finq/js/WidgetCommunicator.js?v=2"></script>
	<script src="/sites/all/themes/finq/js/Base64.js"></script>
	<script src="/sites/all/themes/finq/js/Tabs.js"></script>
	<script type="text/javascript" src="/sites/all/themes/finq/js/slick/slick.min.js"></script>

    <link rel="stylesheet" href="/sites/all/themes/finq2020/Content/CSS/Components/Loader.css?v=1" />
  <?php print $head; ?>  

  <title><?php print getPageTitle($head_title); ?></title>

  <?php print $styles; ?>

  <?php
    
	if (isset($_GET['pid'])) {
	$pid = $_GET['pid'];
	
?>
<!-- <script>
window.dataLayer = window.dataLayer || []
dataLayer.push({
    'DatalayerPID': '<?php echo $pid; ?>',
    'event' : 'lead'
});
</script> -->
<script>
window.dataLayer = window.dataLayer || []
dataLayer.push({'DataLayerPID': '<?php echo $pid; ?>','event' : 'lead'});
</script>
<?php

}
	
?>
  

  <?php print $scripts; ?>
  
  <script>(function(w,d,t,r,u){var f,n,i;w[u]=w[u]||[],f=function(){var o={ti:"134605208"};o.q=w[u],w[u]=new UET(o),w[u].push("pageLoad")},n=d.createElement(t),n.src=r,n.async=1,n.onload=n.onreadystatechange=function(){var s=this.readyState;s&&s!=="loaded"&&s!=="complete"||(f(),n.onload=n.onreadystatechange=null)},i=d.getElementsByTagName(t)[0],i.parentNode.insertBefore(n,i)})(window,document,"script","//bat.bing.com/bat.js","uetq");</script>

 

</head>

<body class="<?php print $classes; ?>" <?php print $attributes;?>>

  <?php print $page_top; ?>

  <?php print $page; ?>

  <?php print $page_bottom; ?>





<!-- Twitter single-event website tag code -->
<script src="//platform.twitter.com/oct.js" type="text/javascript"></script>
<script type="text/javascript">twttr.conversion.trackPid('o1eu8', { tw_sale_amount: 0, tw_order_quantity: 0 });</script>
<noscript>
<img height="1" width="1" style="display:none;" alt="" src="https://analytics.twitter.com/i/adsct?txn_id=o1eu8&p_id=Twitter&tw_sale_amount=0&tw_order_quantity=0" />
<img height="1" width="1" style="display:none;" alt="" src="//t.co/i/adsct?txn_id=o1eu8&p_id=Twitter&tw_sale_amount=0&tw_order_quantity=0" />
</noscript>
<!-- End Twitter single-event website tag code --> 



</body>

</html>