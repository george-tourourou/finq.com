<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();



//include('SendMail.php');
include('Library.php');
//var_dump($_SESSION['form_token']);
//var_dump($_REQUEST);
//$pageName = $_POST['pageName'];
//$post_token = $_POST['token'];

  



//var_dump($post_token);
function error_notify($errorContent) {
   // SendNotification('campaign error', $errorContent);
//    error_log("\n ".$pageName.' | '." date and time: ".date('D M d, Y G:i')." | ".$errorContent, 3, "error.log");

    error_log("\n  |  date and time: ".date('D M d, Y G:i')." | ".$errorContent, 3, "error.log");
}


//error_log("\n\n ".$pageName." IN - " . $_SERVER['REQUEST_METHOD'], 3, "debug.log");

if ($_SERVER['REQUEST_METHOD'] === 'POST' /* && verifyFormToken() === true */)
 {
//   error_log("\n\n ".$pageName." PROCESS - " . $_SERVER['REQUEST_METHOD'], 3, "debug.log");
   error_log("\n\n PROCESS - " . $_SERVER['REQUEST_METHOD'], 3, "debug.log");
    process();
}
else {

    $errorContent = 'wrong verification token - Requested method: '.$_SERVER['REQUEST_METHOD'].' | Session: ';

    error_notify($errorContent);
}


function process(){
    try
    {
        $errorHandlerStep = 'start process';

        //	$url = 'https://leadapi-b2b.extsrv.com/crm-public-api/2.0.0/lead?';
        $mobile_ret = 'https://go.onelink.me/SNj0';

        //Detect special conditions devices
        $iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
        $iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
        $iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");

        if( $iPod || $iPhone|| $iPad ){
            //browser reported as an iPhone/iPod touch -- do something here
            $mobile_ret = 'https://live-cosmos.finq.com/trading-platform/#login';
        }

        //API V3 Changes Start
        $access_token = 'FHf36Ztl5fv9R51oaphj39q3VKMa';
        $crm_brand_id = '78';
        $url= 'https://lead-api-3.extsrv.com/api/lead/v1/submit?';
        //API V3 Changes Finish

        $post_token = $_POST['token'];
        $country = getCountry();

        $userip = getIPAddress();
        $pageName = $_POST['pageName'];

        $optin = "true";
        $servicetype = "";
        $zone = "99999";

       // $campaign = $_POST['campaign'];
        $notes = $_POST['notes'] ;
        $firstname = $_POST['fname'] ;
        $lastname = $_POST['lname'];
        $email = $_POST['email'] ;
        $ret = $_POST['ret'] ;
        $sid = $_POST['sid'] ;

        $c = $_POST['c'];
        $clickid = $_POST['clickid'];
        $af_sub1 = $_POST['af_sub1'];
        $af_sub2 = $_POST['af_sub2'];
        $af_sub3 = $_POST['af_sub3'];

        $ph1 = $_POST['phone'][0];
        $ph2 = $_POST['phone'][1];

        //error_log("\n\n ".$pageName." Phone - " . $phone, 3, "debug.log");

        if(substr($ph1, 0, 2) == "00")
        {
            $ph1 = substr($ph1, 2);
        }
        else if(substr($ph1, 0, 1) == "+")
        {
            $ph1 = substr($ph1, 1);
        }

        $phone = $ph1.$ph2;

        $full_phone = sprintf("%s-%s-%s",
            substr($phone, 0, 3),
            substr($phone, 3, 2),
            substr($phone, 5));


        $full_phone = trim($full_phone);


        //error_log("\n\n ".$pageName." Full Phone - " . $full_phone, 3, "debug.log");



        $language = $_POST['language'];
        // $bid = $_POST['bid'] ;
        $notes = $_POST['notes'] ;
        $campaignId = $_POST['campaignId'] ;
        $affiliateid = $_POST['affiliateid'] ;
        $pid = $_POST['pid'] ;
        $mid = $_POST['mid'] ;
        $cid = $_POST['cid'] ;
        $zid = $_POST['zid'] ;
        // $custom = $_POST['custom'] ;


        /* UTM Parameters */
        $utm_campaign = $_POST['utm_campaign'];
        $utm_medium = $_POST['utm_medium'];
        $utm_source = $_POST['utm_source'];
        $utm_term = $_POST['utm_term'];
        $utm_content = $_POST['utm_content'];
        $utm_category = $_POST['utm_category'];
        $ad_id = $_POST['ad_id'];
        $ad_group = $_POST['ad_group'];
        $gclid = $_POST['gclid'];

        $utm_parameters = "";
        $additional_parameters = "";

        /*	if(IsNullOrEmptyString($phone) || IsNullOrEmptyString($email))
            {
                $ret = 'https://www.finq.com/'.$language.'/live-registration';

                header("Location: ".$ret);
                die();
            }
            */
        if($utm_source != null)
        {
            $utm_parameters = GetUtmParameters($utm_campaign, $utm_medium, $utm_source, $utm_term, $utm_content, $utm_category, $ad_id, $ad_group, $gclid);
        }
        else if(!IsNullOrEmptyString($gclid))
        {
            $additional_parameters = '&gclid='.$gclid;
        }

        // else if($gclid != null) {
        // $utm_campaign = 'dummy_campaign';
        // $utm_medium = 'cpc';
        // $utm_source = 'google';
        // $utm_term = 'dummy_term';
        // $utm_content = 'dummy_content';
        // $utm_category = '';
        // $ad_id = 'dummy_ad_id';
        // $ad_group = 'dummy_ad_group';

        // $utm_parameters = GetUtmParameters($utm_campaign, $utm_medium, $utm_source, $utm_term, $utm_content, $utm_category, $ad_id, $ad_group, $gclid);
        // }

        $postedParameters = 'access_token='. $access_token .'&firstname='. $firstname .'&lastname='. $lastname .'&phone='. $full_phone .'&email='. $email;
        $postedParameters .= '&crm_brand_id='. $crm_brand_id .'&language='. $language .'&userip='. $userip .'&country='. $country.'&optin='. $optin  .'&servicetype='. $servicetype;


        //error_log("\n\n ".$pageName." postedParameters: ".$postedParameters, 3, "debug.log");

      //  $marketingParameters = 'zone='. $zone  .'&affiliate_id='. $affiliateid .'&notes='. $notes  .'&campaignId='. $campaignId .'&pid='. $pid .'&mid='. $mid .'&cid='. $cid .'&zid='. $zid .'&custom='.$custom .''.$utm_parameters.$additional_parameters;


        //error_log("\n\n ".$pageName." marketingParameters: ".$marketingParameters, 3, "debug.log");

     //   $fields_string = $postedParameters.'&'.$marketingParameters;

      //  $redirectUrlParams= 'optin='. $optin  .'&servicetype='. $servicetype  .'&zone='. $zone  .'&affiliate_id='. $affiliateid .'&notes='. $notes  .'&campaignId='. $campaignId .'&pid='. $pid .'&mid='. $mid .'&cid='. $cid .'&zid='. $zid .'&custom='.$custom .''.$utm_parameters.'&notes='. $notes;

    /*    if (isset($_POST["bid"]))
        {
            $marketingParameters .= '&bid='. $bid;
            $redirectUrlParams .= '&bid='. $bid;
        }
*/
    //    $errorHandlerStep = 'lead api error - params:: '. $fields_string .' -|- '. $errorHandlerStep;


     //   $marketingParameters = urlencode($marketingParameters);
      //  $marketingParameters = decodeSpecialCharacters($marketingParameters);
      //  $url .= $marketingParameters;


        //error_log("\n\n ".$pageName. " ".date('D M d, Y G:i') , 3, "debug.log");
        //error_log("\n\n "." postedParameters: ".$postedParameters, 3, "debug.log");
        //error_log("\n\n "." marketingParameters: ".$marketingParameters, 3, "debug.log");


        //API V3 Changes Start

        /*        if (isset($_POST["bid"]))
               {
                   $postedParameters1 = json_encode([
                       'person.firstName' => $firstname ,
                       'person.lastName' => $lastname ,
                       'person.phone1.num' => $full_phone ,
                       'person.email1.emailAddress' => $email,
                       'brand.id' => $crm_brand_id ,
                       'person.language' => $language ,
                       'ip' => $userip ,
                       'person.country' => $country ,
                       'bid' => $bid
                   ]);
           }else{
                   $postedParameters1 = json_encode([
                   'person.firstName' => $firstname ,
                   'person.lastName' => $lastname ,
                   'person.phone1.num' => $full_phone ,
                   'person.email1.emailAddress' => $email,
                   'brand.id' => $crm_brand_id ,
                   'person.language' => $language ,
                   'ip' => $userip ,
                   'person.country' => $country ,
                   'pid' => $pid ,
                   'mid' => $mid ,
                   'cid' => $cid ,
                   'zid' => $zid,
                   'utm_medium' => $utm_medium,
                   'utm_campaign' => $utm_campaign,
                   'utm_source' => $utm_source,
                   'utm_term' => $utm_term,
                   'utm_content' => $utm_category,
                   'ad_id' => $ad_id,
                   'ad_group' => $ad_group,
                   'gclid' => $gclid,
                   'affiliateid' => $affiliateid
               ]);

           } */

        $myposted = [
            'person.firstName' => $firstname ,
            'person.lastName' => $lastname ,
            'person.phone1.num' => $full_phone ,
            'person.email1.emailAddress' => $email,
            'brand.id' => $crm_brand_id ,
            'person.language' => $language ,
            'ip' => $userip ,
            'person.country' => $country ,
            'pid' => $pid ,
            'mid' => $mid ,
            'cid' => $cid ,
            'zid' => $zid,
            'utm_medium' => $utm_medium,
            'utm_campaign' => $utm_campaign,
            'utm_source' => $utm_source,
            'utm_term' => $utm_term,
            'utm_content' => $utm_content,
            'utm_category' => $utm_category,
            'ad_id' => $ad_id,
            'ad_group' => $ad_group,
            'gclid' => $gclid,
            'affiliateid' => $affiliateid
        ];        
		
		
		
		$urlparams = [
            'pid' => $pid ,
            'mid' => $mid ,
            'cid' => $cid ,
            'zid' => $zid,
            'utm_medium' => $utm_medium,
            'utm_campaign' => $utm_campaign,
            'utm_source' => $utm_source,
            'utm_term' => $utm_term,
            'utm_content' => $utm_content,
            'utm_category' => $utm_category,
            'ad_id' => $ad_id,
            'ad_group' => $ad_group,
            'gclid' => $gclid,
            'affiliateid' => $affiliateid
        ];


        $l = (array_filter($myposted));
        $postedParameters1 = json_encode($l);


        error_log("\n  result: ".$postedParameters1, 3, "debug.log");



        //error_log("\n\n "." url: ".$url, 3, "debug.log");

        /* 	$ch = curl_init($url);

            if (!$ch) {
                //die("Couldn't initialize a cURL handle");
            }
             curl_setopt($ch, CURLOPT_VERBOSE, true);

             $header = array('Content-Type: application/x-www-form-urlencoded');
             curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
             curl_setopt($ch, CURLOPT_URL, $url);

             curl_setopt($ch, CURLOPT_POSTFIELDS, $postedParameters);

             curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);

            //execute post
            $result = curl_exec($ch);

            $result = serialize($result); */
        //error_log("\n  result: ".$result, 3, "debug.log");


        $ch = curl_init();

        if (!$ch) {
            //die("Couldn't initialize a cURL handle");
        }


        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postedParameters1);

        curl_setopt($ch, CURLOPT_POST, 1);
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'X-Auth-Token: FHf36Ztl5fv9R51oaphj39q3VKMa';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);



        $data = curl_exec($ch);

        $result = serialize($data);
        $resultJson = json_decode($data);
        //API V3 Changes Finish

     //   error_log("\n ".$pageName.' | ECHO API CALL '." date and time: ".date('D M d, Y G:i')." | ".$fields_string, 3, "success.log");
        $data = '';

        $errorHandlerStep = 'lead api - result:: '.$result;

        $resultLower = strtolower($result);

        $errorMessage = "";
        $isSuccessResponse = IsSuccess($resultLower);

        if(!$isSuccessResponse) {
            if(isset($resultJson->msg)) {
                $errorMessage = $resultJson->msg;
            }
        }

        if(!$isSuccessResponse) {

            $data = [ 'hasError' => 'true', 'error' => $errorMessage, 'redirect' => ''];

            $result = serialize($result);
          //  $result .= ' - Form Data: '.$fields_string;

            error_notify($pageName.' '.$result." utm: ".$utm_parameters);
        }
        else
        {
            setcookie("_email", $email, time() + (86400 * 30), "/", ".finq.com");
            error_log("\n ".$pageName.' | '." date and time: ".date('D M d, Y G:i')." | ".serialize($result)." utm: ".$utm_parameters, 3, "success.log");

           // if($ret == '' && isMobile()) {
            //    $ret = $mobile_ret.'?'.$redirectUrlParams;
           // }else if($pageName == 'Finq Lead') {
//                $ret = 'https://lp.finq.com/campaign/iframe/success.php?'.$fields_string;
              //  $ret = 'https://www.finq.com/traders-room/LP/View/success.php?post_token='.$post_token;
                $ret = 'https://www.finq.com/traders-room/LP/View/success.php?' . http_build_query($urlparams);;
           // }
          



            $data = [ 'hasError' => 'false', 'error' => '', 'redirect' => $ret];
            error_log("\n OK", 3, "success.log");

            if(strpos($resultLower, 'pending') === true)
            {
                error_notify($pageName.' '.$result." utm: ".$utm_parameters);
            }
        }

        $errorHandlerStep = 'ok';

        header('Content-type: application/json');
        echo json_encode( $data );

        //close connection
        curl_close($ch);
    }
    catch(Exception $e)
    {

    }
    finally
    {
        if($errorHandlerStep != 'ok') {
            error_notify($errorHandlerStep);
        }

        die();
    }
}

function IsSuccess($response) {
    if(strpos($response, 'success') === false && strpos($response, 'pending') === false && strpos($response, 'DUPLICATE') === false) {
        return false;
    }

    return true;
}

function GetUtmParameters($utm_campaign, $utm_medium, $utm_source, $utm_term, $utm_content, $utm_category, $ad_id, $ad_group, $gclid) {
    return '&utm_campaign='.$utm_campaign.'&utm_medium='.$utm_medium.'&utm_source='.$utm_source.'&utm_term='.$utm_term.'&utm_content='.$utm_content.'&utm_category='.$utm_category.'&ad_id='.$ad_id.'&ad_group='.$ad_group.'&gclid='.$gclid;

}


function getCountry()
{
    $country = getenv("GEOIP2_COUNTRY_CODE");

    if(strtolower($country) == 'eu' || strtolower($country) == 'uk')
    {
        $country = 'gb';
    }

    return $country;
}

function decodeSpecialCharacters($param){

    $param = str_replace("%3D","=",$param);
    $param = str_replace("%26","&",$param);
    $param = str_replace("%2F","/",$param);

    return $param;
}

?>