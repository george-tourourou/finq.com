<?php

$allowedOrigins = [
    "https://www.finq.com",
    "https://lp.finq.com",
    "https://www.trade.com",
    "https://lp.trade.com"
];

if (in_array($_SERVER["HTTP_ORIGIN"], $allowedOrigins)) {
    header("Access-Control-Allow-Origin: " . $_SERVER["HTTP_ORIGIN"]);
}

include('/var/www/finq/mkt/lp/Common/mail/class.phpmailer.php');
include('/var/www/finq/mkt/lp/Common/mail/class.smtp.php');
include("LeadSubmitConfiguration.php");


session_start();

$leadSubmit = new LeadSubmit(getenv(GEOIP2_COUNTRY_CODE));

class LeadSubmitModel {
    public $country;
    public $userip;
    public $pageName;
    public $optin;
    public $servicetype;
    public $zone;
    public $firstname;
    public $lastname;
    public $email;
    public $RedirectUrl;
    public $phone;
    public $language;
    public $bid;
    public $notes;
    public $campaignId;
    public $affiliateid;
    public $pid;
    public $mid;
    public $cid;
    public $zid;
    public $custom;

    /* UTM Parameters */
    public $utm_campaign;
    public $utm_medium;
    public $utm_source;
    public $utm_term;
    public $utm_content;
    public $utm_category;
    public $ad_id;
    public $ad_group;
    public $gclid;

    public $utm_parameters;
    public $additional_parameters;
}

class LeadSubmit {
    private $COSMOS_URL = 'https://live-cosmos.%s.com/trading-platform/#login';
    private $REGISTRATION_PAGE_URL = 'https://www.%s.com/%s/live-registration';
    private $LEAD_API_URL = 'https://lead-api-3.extsrv.com/api/lead/v1/submit?';
    private $ACCESS_TOKEN = 'FHf36Ztl5fv9R51oaphj39q3VKMa';
    private $ENV_COUNTRY;
    private $BRAND_NAME;
    private $MOBILE_REDIRECT_URL;
    private $CRM_BRAND_ID;

    /** @var $LEAD_MODEL LeadSubmitModel */
    private $LEAD_MODEL;

    public function __construct($envCountry)
    {
        $this->ENV_COUNTRY = $envCountry;
        $configuration = new LeadSubmitConfiguration();

        $this->BRAND_NAME = $configuration->BRAND_NAME;
        $this->MOBILE_REDIRECT_URL = $configuration->MOBILE_REDIRECT_URL;
        $this->CRM_BRAND_ID = $configuration->CRM_BRAND_ID;

        $this->Main();
    }

    private function setLeadModel($model) {
        $this->LEAD_MODEL = $model;
    }

    /**
     * @return LeadSubmitModel
     */
    private function getLeadModel() {
        return $this->LEAD_MODEL;
    }

    private function getClientLanguageCode() {
        return $this->getLeadModel()->language;
    }

    private function getCosmosUrl() {
        $brand = $this->getBrandName();

        return sprintf($this->COSMOS_URL, $brand);
    }

    private function getRegistrationPageUrl() {
        $brand = $this->getBrandName();
        $lanuageCode = $this->getClientLanguageCode();

        return sprintf($this->REGISTRATION_PAGE_URL, $brand, $lanuageCode);
    }

    private function getBrandName() {
        return $this->BRAND_NAME;
    }

    private function getRedirectUrl() {
        $parameters = $this->getRedirectUrlParameters();
        $model = $this->getModel();

        if($model->RedirectUrl == "")
        {
            if($this->isMobile()) {
                return $this->getMobileRedirectUrl();
            }
            else {
                $model->RedirectUrl = $this->getRegistrationPageUrl();
            }
        }

        $model->RedirectUrl = sprintf("%s?%s", $model->RedirectUrl, $parameters);

        return $model->RedirectUrl;
    }

    private function getMobileRedirectUrl() {

        //Detect special conditions devices
        $iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
        $iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
        $iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");

        if( $iPod || $iPhone|| $iPad ){
            //browser reported as an iPhone/iPod touch -- do something here
            return $this->getCosmosUrl();
        }

        return $this->MOBILE_REDIRECT_URL;
    }

    private function getAccessToken() {
        return $this->ACCESS_TOKEN;
    }

    private function getCRMBrandID() {
        return $this->CRM_BRAND_ID;
    }

    private function getLeadApiUrl() {
        return $this->LEAD_API_URL;
    }

    private function getPageName() {
        if(isset($_POST['pageName'])) {
            return $_POST['pageName'];
        }

        return "";
    }

    private function logDebug($content) {
        $pageName = $this->getPageName();

        error_log("\n ".$pageName.' | '." date and time: ".date('D M d, Y G:i')." | ".$content, 3, "Logs/Debug.log");
    }

    private function logError($content) {
        $pageName = $this->getPageName();

        error_log("\n ".$pageName.' | '." date and time: ".date('D M d, Y G:i')." | ".$content, 3, "Logs/Error.log");
    }

    private function logSuccess($content) {
        $pageName = $this->getPageName();

        error_log("\n ".$pageName.' | '." date and time: ".date('D M d, Y G:i')." | ".$content, 3, "Logs/Success.log");
    }

    private function sendNotification($content)
    {
        $pageName = $this->getPageName();

        $user1 = "george.t@leadcapitalmarkets.com";
        $user2 = "chrish@leadcapitalmarkets.com";
        $user3 = "loizos.h@leadcapitalmarkets.com";
        $user4 = "andreas.s@tradecapitalmarkets.com";

        $subject = "Landing page error - ".$pageName;

        $this->sendMail($user1, $subject, $content);
        $this->sendMail($user2, $subject, $content);
        $this->sendMail($user3, $subject, $content);
        $this->sendMail($user4, $subject, $content);
    }

    function sendMail($to, $Subject, $Body)
    {
        try {
            $mail = new PHPMailer();

            $mail->IsSMTP(); // enable SMTP
            $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
            $mail->SMTPAuth = true; // authentication enabled
            $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
            $mail->Host = "smtp.mailgun.org";
            $mail->Port = 465; // or 587
            $mail->Username = "contactus@mg.leadcapitalmarkets.com";
            $mail->Password = "1qaz2WSX!@";
            $mail->From = 'contactus@mg.leadcapitalmarkets.com';
            $mail->FromName = 'Landing Pages';
            $mail->AddAddress($to);

            $mail->WordWrap = 50;
            $mail->IsHTML(true);

            $mail->Subject = $Subject;
            $mail->Body    = $Body;

            if(!$mail->Send())
            {
                return $mail->ErrorInfo;
            }
            else {
                return 'ok';
            }
        }
        catch(Exception $e) {
            return $e->getMessage();
        }
    }

    private function getPhone() {
        if(isset($_POST['phone']))
        {
            $ph1 = $_POST['phone'][0];
            $ph2 = $_POST['phone'][1];

            if(substr($ph1, 0, 2) == "00")
            {
                $ph1 = substr($ph1, 2);
            }
            else if(substr($ph1, 0, 1) == "+")
            {
                $ph1 = substr($ph1, 1);
            }

            $phone = $ph1.$ph2;

            $phone = sprintf("%s-%s-%s",
                substr($phone, 0, 3),
                substr($phone, 3, 2),
                substr($phone, 5));


            return trim($phone);
        }


        return "";
    }

    public function Main() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $this->logDebug($_SERVER['REQUEST_METHOD']);
            $this->process();
        }
        else {

            $content = 'wrong verification token - Requested method: '.$_SERVER['REQUEST_METHOD'].' | Session: '.$_SESSION['form_token'];

            $this->logError($content);
            $this->sendNotification($content);
        }
    }

    function process() {
        $leadApiUrl = $this->getLeadApiUrl();
        //API V3 Changes Finish

        /** @var LeadSubmitModel $model */
        $model = $this->getModel();
        $this->setLeadModel($model);

        if($this->isNullOrEmptyString($model->phone) || $this->isNullOrEmptyString($model->email))
        {
            $ret = $this->getRedirectUrl();

            header("Location: ".$ret);
            die();
        }

        if($model->utm_source != null)
        {
            $model->utm_parameters = $this->GetUtmParameters();
        }
        else if(!$this->isNullOrEmptyString($model->gclid))
        {
            $model->additional_parameters = sprintf('&gclid=%s', $model->gclid);
        }

        $postedParameters = $this->getPostedParameters();

        $postedParametersArr = $this->getPostedParametersArray();

        $this->logDebug("Curl request");
        $data = $this->curlRequest($postedParametersArr);

        //$this->logDebug("Curl response: ".json_encode($data));
        $this->logDebug("Curl response: ".json_encode($model));
        $data = json_decode($data);

        $isSuccess = $this->isSuccess($data);

        if($isSuccess === true)
        {
            $this->logSuccess("lead api response: ".json_encode($data));
            $this->setEmailToCookie();

            $model->RedirectUrl = $this->getRedirectUrl();

            $data = [
                "success" => true,
                "error" => "",
                "redirect" => $model->RedirectUrl
            ];
        }
        else
        {
            $error = '';

            if(isset($data->msg)) {
                $error = $data->msg;
            }

            $this->logError("======================");
            $this->logError("lead api response: ".json_encode($data));
            $this->logError("postedParameters: ".$postedParameters);
            $this->sendNotification(json_encode($data));

            $data = [
                'success' => false,
                'error' => $error,
                'redirect' => ''
            ];
        }

        header("Content-type: application/json");
        echo json_encode($data);
    }

    /**
     * @param LeadSubmitModel $model
     * @return string
     */
    function getUtmParameters() {
        $model = $this->getModel();

        $content = sprintf('&utm_campaign=%s&utm_medium=%s&utm_source=%s&utm_term=%s&utm_content=%s&utm_category=%s&ad_id=%s&ad_group=%s&gclid=%s',
            $model->utm_campaign,
            $model->utm_medium,
            $model->utm_source,
            $model->utm_term,
            $model->utm_content,
            $model->utm_category,
            $model->ad_id,
            $model->ad_group,
            $model->gclid);

        return $content;
    }

    function getCountry()
    {
        $country = "";

        if(isset($_POST['country']))
        {
            $country = $_POST['country'];
        }
        else
        {
            $country = $this->getenvCountry();

            if(strtolower($country) == 'eu' || strtolower($country) == 'uk' )
            {
                $country = 'gb';
            }
        }

        return $country;
    }

    function decodeSpecialCharacters($param) {

        $param = str_replace("%3D","=",$param);
        $param = str_replace("%26","&",$param);
        $param = str_replace("%2F","/",$param);

        return $param;
    }

    function verifyLanguage($language) {
        $languages = array("sq","ar","bg","zh","cs","da","nl","en","fi","fr","de","gr",
            "hu","it","no","pl","pt","ro","ru","sl","sk","es","sv");

        if (!in_array($language, $languages)) {
            return $language = "en";
        }else{
            return $language;
        }

    }

    /**
     * @param LeadSubmitModel $model
     * @return string
     */
    private function getPostedParameters()
    {
        $model = $this->getModel();
        $access_token = $this->getAccessToken();
        $crm_brand_id = $this->getCRMBrandID();

        $postedParameters = sprintf('access_token=%s&firstname=%s&lastname=%s&phone=%s&email=%s&crm_brand_id=%s&language=%s&userip=%s&country=%s&optin=%s&servicetype=%s',
            $access_token,
            $model->firstname,
            $model->lastname,
            $model->phone,
            $model->email,
            $crm_brand_id,
            $model->language,
            $model->userip,
            $model->country,
            $model->optin,
            $model->servicetype
        );

        return $postedParameters;
    }

    private function getenvCountry()
    {
        return $this->ENV_COUNTRY;
    }

    /**
     * @return LeadSubmitModel
     */
    private function getModel()
    {
        $model = new LeadSubmitModel();
        $model->country = $this->getCountry();

        $model->userip = $this->getIPAddress();
        $model->pageName = $this->getPageName();

        $model->optin = "false";
        $model->servicetype = "";
        $model->zone = "99999";

        $model->firstname = $_POST['fname'];
        $model->lastname = $_POST['lname'];
        $model->email = $_POST['email'];
        $model->RedirectUrl = $_POST['ret'];

        $model->phone = $this->getPhone();

        $model->language = $this->verifyLanguage($_POST['language']);

        $model->bid = $_POST['bid'];
        $model->notes = $_POST['notes'];
        $model->campaignId = $_POST['campaignId'];
        $model->affiliateid = $_POST['affiliateid'];
        $model->pid = $_POST['pid'];
        $model->mid = $_POST['mid'];
        $model->cid = $_POST['cid'];
        $model->zid = $_POST['zid'];
        $model->custom = $_POST['custom'];


        /* UTM Parameters */
        $model->utm_campaign = $_POST['utm_campaign'];
        $model->utm_medium = $_POST['utm_medium'];
        $model->utm_source = $_POST['utm_source'];
        $model->utm_term = $_POST['utm_term'];
        $model->utm_content = $_POST['utm_content'];
        $model->utm_category = $_POST['utm_category'];
        $model->ad_id = $_POST['ad_id'];
        $model->ad_group = $_POST['ad_group'];
        $model->gclid = $_POST['gclid'];

        $model->utm_parameters = "";
        $model->additional_parameters = "";

        return $model;
    }

    function isNullOrEmptyString($var){
        return (!isset($var) || trim($var)==='');
    }

    /**
     * @param LeadSubmitModel $model
     * @return string
     */
    private function getRedirectUrlParameters()
    {
        $model = $this->getModel();

        $urlparams = [
            'pid' => $model->pid,
            'mid' => $model->mid,
            'cid' => $model->cid,
            'zid' => $model->zid,
            'bid' => $model->bid,
            'utm_medium' => $model->utm_medium,
            'utm_campaign' => $model->utm_campaign,
            'utm_source' => $model->utm_source,
            'utm_term' => $model->utm_term,
            'utm_content' => $model->utm_content,
            'utm_category' => $model->utm_category,
            'ad_id' => $model->ad_id,
            'ad_group' => $model->ad_group,
            'gclid' => $model->gclid,
            'affiliateId' => $model->affiliateid
        ];

        $urlparams = array_filter($urlparams);
        $urlparams = http_build_query($urlparams);

        $urlparams = str_replace("+","%20",$urlparams);

        return $urlparams;
    }

    /**
     * @param LeadSubmitModel $model
     * @return string
     */
    private function getPostedParametersArray()
    {
        $model = $this->getModel();
        $crm_brand_id = $this->getCRMBrandID();

        $postArr = [
            'person.firstName' => $model->firstname,
            'person.lastName' => $model->lastname,
            'person.phone1.num' => $model->phone,
            'person.email1.emailAddress' => $model->email,
            'brand.id' => $crm_brand_id,
            'person.language' => $model->language,
            'ip' => $model->userip,
            'person.country' => $model->country,
            'campaignId' => $model->campaignId,
            'pid' => $model->pid,
            'mid' => $model->mid,
            'cid' => $model->cid,
            'zid' => $model->zid,
            'utm_medium' => $model->utm_medium,
            'utm_campaign' => $model->utm_campaign,
            'utm_source' => $model->utm_source,
            'utm_term' => $model->utm_term,
            'utm_content' => $model->utm_content,
            'utm_category' => $model->utm_category,
            'bid' => $model->bid,
            'ad_id' => $model->ad_id,
            'ad_group' => $model->ad_group,
            'gclid' => $model->gclid,
            'affiliateId' => $model->affiliateid,
            'custom' => $model->custom
        ];

        $content = json_encode(array_filter($postArr));

        return $content;
    }

    /**
     * @param $postedParameters
     * @param $marketingParameters
     * @return string
     */
    private function curlRequest($postedParameters)
    {
        $authenticationToken = $this->getAccessToken();
        $leadApiUrl = $this->getLeadApiUrl();

        $ch = curl_init();

        if (!$ch) {
            return null;
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postedParameters);

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_URL, $leadApiUrl);
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'X-Auth-Token: '.$authenticationToken;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $data = curl_exec($ch);

        //close connection
        curl_close($ch);

        return $data;
    }

    private function isMobile(){
        $useragent=$_SERVER['HTTP_USER_AGENT'];

        if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
        {
            return true;
        }
        else {
            return false;
        }
    }

    private function getIPAddress()
    {
        $ipaddress = "";

        if (!empty($_SERVER['HTTP_CLIENT_IP']))
        {
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        }

        if($ipaddress != "") {
            $ipaddress = trim(explode(',', $ipaddress)[0]);
        }



        return $ipaddress;
    }

    /**
     * @param $data
     * @return bool
     */
    private function isSuccess($data)
    {
        $isSuccess = false;
        
        if (isset($data)) {
            if (isset($data->statusCode) && isset($data->statusCode)) {
                if ($data->statusCode == 200 || $data->resultStatus == "DUPLICATE") {
                    $isSuccess = true;
                }
            }
        }

        return $isSuccess;
    }

    /**
     * @param LeadSubmitModel $model
     */
    private function setEmailToCookie()
    {
        $model = $this->getModel();
        $brandDomain = sprintf(".%s.com", $this->getBrandName());
        setcookie("_email", $model->email, time() + (86400 * 30), "/", $brandDomain);
    }
}