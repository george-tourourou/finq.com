<?php
	$newToken = generateFormToken('form');  
	$pageName = getPageName();

	function getAff_Id() {
	    if(isset($_GET["aff-id"])) {
            return $_GET["aff-id"];
        }

	    return "";
    }

    function getWeboArr() {
        if(isset($_GET["weboArr"])) {
            return urlencode($_GET["weboArr"]);
        }

        return "";
    }


	$c = $_GET['c'];
	$lname = $_GET['lname'];
	$fname = $_GET['fname'];
	$nemail = $_GET['email'];
	$nphone = $_GET['phone'];
	$ret = $_GET['ret'];
	
	if(IsNullOrEmptyString($ret))
	{		
		$ret = $_GET['postRegistrationRedirectURL'];
	}

	//use for investing.com
	$retForInvesting = $_GET['postRegistrationRedirectUrl']; 
	
	if (!empty($retForInvesting)) { 
		$ret = $retForInvesting;
	}
	
	$optin = $_GET['optin'];
	$sid = $_GET['sid'];
	$clickid = $_GET['clickid'];
	$af_sub1 = $_GET['af_sub1'];
	$af_sub2 = $_GET['af_sub2'];
	$af_sub3 = $_GET['af_sub3'];

	/* UTM Parameters */
	
	$utm_medium = strtolower($_GET['utm_medium']);
	$utm_source = strtolower($_GET['utm_source']);
	$utm_term = $_GET['utm_term'];
	$utm_content = $_GET['utm_content'];
	$utm_category = $_GET['utm_category'];
	//$ad_id = $_GET['ad_id'];
	//$ad_group = $_GET['ad_group'];
	$gclid = $_GET['gclid'];
	
	$context_id = $_GET['context_id'];

  if(isset($_GET['campaignname'])) {
  $utm_campaign = str_replace('%','',$_GET['campaignname']);
     }else{
   
   $utm_campaign = $_GET['utm_campaign'];
	}
	
     if(isset($_GET['adsetid'])) {
        $ad_group = $_GET['adsetid'];
    }else{
		$ad_group = $_GET['ad_group'];
		
	}

    if(isset($_GET['adname'])) {
        $notes = $_GET['adname'];
    }else{
		$notes = $_GET['notes'];
	}
	
	 if(isset($_GET['adid'])) {
        $ad_id  = $_GET['adid'];
    }else{
		$ad_id = $_GET['ad_id'];
		
	}





	/*---- 13/9/2018 ----*/
    $hasDummyContextIOD = false;
    if (strpos($context_id, '%%CONTEXT_ID%%') !== false) {
        $hasDummyContextIOD = true;
    }



    if(!IsNullOrEmptyString($context_id) && !$hasDummyContextIOD)
    {
        $gclid = $context_id;
    }

    if(!IsNullOrEmptyString($clickid))
    {
        $gclid = $clickid;
    }

    if(isset($_GET['afp1'])) {
        $gclid = $_GET['afp1'];
    }

	

	$affiliateID = ((isset($_GET["pid"])) ? htmlspecialchars($_GET["pid"]) : "");

	if($utm_source == "google")
	{
		if($utm_medium == "cpc")
		{
			$affiliateID = "Google Search";
		}
		else if($utm_medium == "gdn" || $utm_medium == "placement")
		{
			$affiliateID = "Google Sites";
		}
		else if($utm_medium == "content")
		{
			$affiliateID = "Google Keyword Sites";
		}
		else if($utm_medium == "kwplacement")
		{
			$affiliateID = "Google Keyword Pages";
		}
	}
?>
    <input type="hidden" name="aff-id" value="<?php echo getAff_Id(); ?>" />
    <input type="hidden" name="weboArr" value="<?php echo getWeboArr(); ?>" />
	<input type="hidden" name="affiliateid" value="<?php echo $affiliateID; ?>" />
	<input type="hidden" name="language" value="<?php echo GetCleanLanguageCode() ?>" />
	<input type="hidden" name="token" value="<?php echo $newToken; ?>">
	<input type="hidden" name="pageName" value="<?php echo $pageName; ?>">
	<input type="hidden" name="ret" value="<?php echo $ret; ?>" />
	<input type="hidden" name="sid" value="<?php echo $sid; ?>" />
	<input type="hidden" name="c" value="<?php echo $c; ?>" />
	<input type="hidden" name="clickid" value="<?php echo $clickid; ?>" />
	<input type="hidden" name="af_sub1" value="<?php echo $af_sub1; ?>" />
	<input type="hidden" name="af_sub2" value="<?php echo $af_sub2; ?>" />
	<input type="hidden" name="af_sub3" value="<?php echo $af_sub3; ?>" />	
	
	<input type="hidden" name="campaignId" value="<?php echo $campaignId ?>" />
	
	<input type="hidden" name="utm_campaign" value="<?php echo $utm_campaign ?>" />
	<input type="hidden" name="utm_medium" value="<?php echo $utm_medium ?>" />
	<input type="hidden" name="utm_source" value="<?php echo $utm_source ?>" />
	<input type="hidden" name="utm_term" value="<?php echo $utm_term ?>" />
	<input type="hidden" name="utm_content" value="<?php echo $utm_content ?>" />
	<input type="hidden" name="utm_category" value="<?php echo $utm_category ?>" />
	
	<input type="hidden" name="ad_id" value="<?php echo $ad_id ?>" />
	<input type="hidden" name="ad_group" value="<?php echo $ad_group ?>" />
	<input type="hidden" name="gclid" value="<?php echo $gclid ?>" />
	
	<input type="hidden" id="notes" name="notes" value="<?php echo $notes ?>" />
		
<?php
	if (isset($_GET["bid"])) {
		echo "<input type=\"hidden\" name=\"bid\" value=\"" . $_GET['bid'] . "\" />";
	} else {
		echo "<input type=\"hidden\" name=\"pid\" value=\"" . $_GET['pid'] . "\" />";
		echo "<input type=\"hidden\" name=\"mid\" value=\"" . $_GET['mid'] . "\" />";
		echo "<input type=\"hidden\" name=\"cid\" value=\"" . $_GET['cid'] . "\" />";
		echo "<input type=\"hidden\" name=\"zid\" value=\"" . $_GET['zid'] . "\" />";
	}

	if (isset($_GET["custom"])) {
		echo "<input type=\"hidden\" name=\"custom\" value=\"" . $_GET['custom'] . "\" />";
	}	
?>