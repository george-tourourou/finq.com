<?php

    function getQueryParam($alias) {
        if(isset($_GET[$alias])) {
            return $_GET[$alias];
        }

        return "";
    }

	$newToken = generateFormToken('form');  
	//$pageName = getPageName();
	$pageName = "Finq Lead";

	$c = getQueryParam('c');
	$lname = getQueryParam('lname');
	$fname = getQueryParam('fname');
	$nemail = getQueryParam('email');
	$nphone = getQueryParam('phone');
	$ret = getQueryParam('ret');
	
	if(IsNullOrEmptyString($ret))
	{		
		$ret = getQueryParam('postRegistrationRedirectURL');
	}

	//use for investing.com
	$retForInvesting = getQueryParam('postRegistrationRedirectUrl');
	
	if (!empty($retForInvesting)) { 
		$ret = $retForInvesting;
	}
	
	$optin = getQueryParam('optin');
	$sid = getQueryParam('sid');
	$clickid = getQueryParam('clickid');
	$af_sub1 = getQueryParam('af_sub1');
	$af_sub2 = getQueryParam('af_sub2');
	$af_sub3 = getQueryParam('af_sub3');

	/* UTM Parameters */
	$utm_campaign = getQueryParam('utm_campaign');
	$utm_medium = strtolower(getQueryParam('utm_medium'));
	$utm_source = strtolower(getQueryParam('utm_source'));
	$utm_term = getQueryParam('utm_term');
	$utm_content = getQueryParam('utm_content');
	$utm_category = getQueryParam('utm_category');
	//$ad_id = getQueryParam('ad_id');
	$ad_id = getQueryParam('Ad_ID');
	//$ad_group = getQueryParam('ad_group');
	$ad_group = getQueryParam('Ad_Set_ID');

	$gclid = getQueryParam('gclid');
	
	$context_id = getQueryParam('context_id');


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

    $gclid = getQueryParam('afp1');

	$notes = getQueryParam('notes');

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
    <input type="hidden" name="aff-id" value="<?php echo getQueryParam("aff-id") ?>" />
    <input type="hidden" name="weboArr" value="<?php echo getQueryParam("weboArr") ?>" />
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
		echo "<input type=\"hidden\" name=\"bid\" value=\"" . getQueryParam('bid') . "\" />";
	} else {
		echo "<input type=\"hidden\" name=\"pid\" value=\"" . getQueryParam('pid') . "\" />";
		echo "<input type=\"hidden\" name=\"mid\" value=\"" . getQueryParam('mid') . "\" />";
		echo "<input type=\"hidden\" name=\"cid\" value=\"" . getQueryParam('cid') . "\" />";
		echo "<input type=\"hidden\" name=\"zid\" value=\"" . getQueryParam('zid') . "\" />";
	}

	if (isset($_GET["custom"])) {
		echo "<input type=\"hidden\" name=\"custom\" value=\"" . getQueryParam('custom') . "\" />";
	}	
?>