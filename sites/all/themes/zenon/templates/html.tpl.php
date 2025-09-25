<?php

/**

 * @file

 * Default theme implementation to display the basic html structure of a single

 * Drupal page.

 *

 * Variables:

 * - $css: An array of CSS files for the current page.

 * - $language: (object) The language the site is being displayed in.

 *   $language->language contains its textual representation.

 *   $language->dir contains the language direction. It will either be 'ltr' or

 *   'rtl'.

 * - $rdf_namespaces: All the RDF namespace prefixes used in the HTML document.

 * - $grddl_profile: A GRDDL profile allowing agents to extract the RDF data.

 * - $head_title: A modified version of the page title, for use in the TITLE

 *   tag.

 * - $head_title_array: (array) An associative array containing the string parts

 *   that were used to generate the $head_title variable, already prepared to be

 *   output as TITLE tag. The key/value pairs may contain one or more of the

 *   following, depending on conditions:

 *   - title: The title of the current page, if any.

 *   - name: The name of the site.

 *   - slogan: The slogan of the site, if any, and if there is no title.

 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and

 *   so on).

 * - $styles: Style tags necessary to import all CSS files for the page.

 * - $scripts: Script tags necessary to load the JavaScript files and settings

 *   for the page.

 * - $page_top: Initial markup from any modules that have altered the

 *   page. This variable should always be output first, before all other dynamic

 *   content.

 * - $page: The rendered page content.

 * - $page_bottom: Final closing markup from any modules that have altered the

 *   page. This variable should always be output last, after all other dynamic

 *   content.

 * - $classes String of classes that can be used to style contextually through

 *   CSS.

 *

 * @see biotic_preprocess_html()

 * @see template_preprocess()

 * @see template_preprocess_html()

 * @see template_process()

 *

 * @ingroup themeable

 */

?>

<!DOCTYPE html>

<?php

//echo "url: " . $_SERVER[REQUEST_URI];

/*foreach($_GET as $key => $value){
	if (strpos($key, 'utm') !== false) {
		setcookie("SESS".$key, $value, time()+5184000 ,"/");
	}	
}*/

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

/*if (isset($_GET['cid'])) {
	setcookie("SESScid", $_GET['cid'], time()+5184000);
}

if (isset($_GET['mid'])) {
	setcookie("SESSmid", $_GET['mid'], time()+5184000);
}

if (isset($_GET['zid'])) {
	setcookie("SESSzid", $_GET['zid'], time()+5184000);
}

if (isset($_GET['pid'])) {
	setcookie("SESSpid", $_GET['pid'], time()+5184000);
}

if (isset($_GET['custom'])) {
	setcookie("SESScustom", $_GET['custom'], time()+5184000);
}*/

/*$url_role = filter_input(INPUT_GET, 'role');
if (isset($url_role)) {
	if ($url_role == 'anonymous') {
	// logout
		setcookie("SESSlog", "", time()-3600,"/");
		setcookie("SESSlog", "", time()-3600);
	} else {
	// login
		setcookie("SESSlog", "true", time()+60*60*24*2, "/"); 
	}
}*/
?>

<?php
	// session_destroy();
	// die('as');
	// session_start();
	// if ( isset($_GET['role']) ) {
	// 	// echo "role set";
	// 	switch ($_GET['role']) {
	// 		case 'anonymous':
	// 			$_SESSION['logged_in'] = false;				
	// 			//header('Location: '.$_SERVER['HTTP_X_PROTO'].$_SERVER['HTTP_HOST']);
	// 			//exit();
	// 			break;
			
	// 		case 'demo':
	// 		case 'real_no_deposits':
	// 		case 'real_with_deposit':
	// 			$_SESSION['logged_in'] = true;				
	// 			break;
	// 	}
	// } else {
	// 	$_SESSION['logged_in'] = false;	
	// }
	// var_dump($_SESSION);
	
?>


<html lang="<?php print $language->language; ?>" class="no-js" dir="<?php print $language->dir; ?>"<?php print $rdf_namespaces;?>>

<head>

  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <?php print $head; ?>
  
<script type="application/ld+json">
{
  "@context" : "http://schema.org",
  "@type" : "Organization",
  "name" : "TRADE.com",
  "url" : "https://www.trade.com",
  "logo": "https://www.trade.com/sites/default/files/Trade-250x50.png",
  "description": "Online Trading",
  "sameAs" : [
    "https://www.facebook.com/Tradecom-585932468226014/?fref=ts",
    "https://twitter.com/TradeComEN",
    "https://www.youtube.com/channel/UCSBYPnXK51BCLwoH0Y1TM-w",
    "https://app.appsflyer.com/id1120178110?uid=31671d66-65c8-ed44-5e63-f6aa7a5de483",
	"https://app.appsflyer.com/com.trade.android?uid=31671d66-65c8-ed44-5e63-f6aa7a5de483"
  ]
}
</script>

	<script type='text/javascript'>

	window.addEventListener('message', widget_comunicator_callback, false);
	
	if (window.location.search){
		var url_params = "SESSurl_params="+window.location.search.replace("?", "")+";";
		var now = new Date();
		var time = now.getTime();
		var expireTime = time + 1000*36000;
		now.setTime(expireTime);
		document.cookie= url_params+"expires="+now.toGMTString()+"path=/;";		
	}
	

	 function widget_comunicator_callback(event){	  
	  try
	  {
		  if(event === undefined || event === null)
		  {
			  return false;
		  }
		  
		  if(event.data !== null)
		  {
			if(event.data.indexOf("{") > -1)
			{
			  var msg=JSON.parse(event.data);
			  
			  switch(msg.type)
			  {
			   case 'email_duplication':
				// do something like open a login/forgot login widget 
				break; 
			   case 'WIDGET_POPUP_SIZE':
				// setting the widget iframe height
				jQuery('#main_iframe').height((msg.body.height+200) + 'px');
				break;
			   case 'accountdetails_success':
				// do something like display auto login or deposit buttons/ links 
				break; 
			  }				
			}  
		  }
	  }
	  catch(err)
	  {
		  
	  }	  
  }



	</script>

  

  <title><?php print $head_title; ?></title>
<!-- sssssss -->
  <?php print $styles; ?>
  <?php 
  // var_dump($styles);

   ?>

  <!-- HTML5 element support for IE6-8 -->

  <!--[if lt IE 9]>

    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>

  <![endif]-->

  <?php print $scripts; ?>
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '862798093850949');
fbq('track', 'PageView');
</script>
<noscript>
<img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=862798093850949&ev=PageView&noscript=1" /></noscript>
<!-- DO NOT MODIFY -->
<!-- End Facebook Pixel Code -->


</head>

<body class="<?php print $classes; ?>" <?php print $attributes;?>>

  <div id="skip-link">

    <a href="#main-content" class="element-invisible element-focusable"><?php print t('Skip to main content'); ?></a>

  </div>

 

  <?php print $page_top; ?>

  <?php print $page; ?>

  <?php print $page_bottom; ?>

</body>

</html>

