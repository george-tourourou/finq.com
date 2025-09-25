<?php
    /**
     * Created by PhpStorm.
     * User: george.t
     * Date: 4/3/2018
     * Time: 10:56 AM
     */

    //Credentials
    define("DEVELOPE_INGENICO_MERCHANT_ID", "1813");
    define("DEVELOPE_INGENICO_API_KEY_ID", "3eb9ef932d68a7be");
    define("DEVELOPE_INGENICO_SECRET_API_KEY", "UDZawmloxYLUEThGDJg9k+j/YNdI7Ttu6wear0cZnYM=");

    define("LIVE_INGENICO_MERCHANT_ID", "7083");
    define("LIVE_INGENICO_API_KEY_ID", "54e787ebd3150f6d");//-40cfe6f078e90bd6
    define("LIVE_INGENICO_SECRET_API_KEY", "+yqSQ8QhgKeL36vIxs/VaQnncduYaZ0esFbenxvF0IE=");//-mXssA6oXNEuSyEFfz5l55IrAhJAcifHinoW+IS0ug9g=

    //Generic
    define("INGENICO_API_URL", "https://world.api-ingenico.com");
    define("INGENICO_API_URL_CONVERTION", "/v1/{merchant-id}/services/convert/amount?source={source}&target={target}&amount={amount}");
    define("INGENICO_API_URL_PAYMENT", "/v1/{merchant-id}/payments");
    define("CLIENT_SIDE_VERSION", "v=2.12");

    define("BRAND", "FINQ");

    /*
     * Trade
     * */
    define("TRADE_BRAND_ID", 5);
    define("WIRETRANSFER_TRADE_BRAND_ID", 1);
    define("LCM_AVAILABLE_COMPANIES", json_encode(array ("ING", "LCM", "TCM")));
    define("LCM_COMPANY", "LCM");
    define("TRADE_WIDGET_URL", "https://widgets.trade.com");//https://finq.widgetsqa.az-qa.com//https://widgets.trade.com
    define("TRADE_WIDGET_IFRAME_URL", TRADE_WIDGET_URL."/en/myaccount/getuserdata");
    define("TRADE_LOGO_URL", "/sites/default/files/nv-images/logo.png");

    /*
     * Finq
     * */
    define("FINQ_BRAND_ID", 78);
    define("WIRETRANSFER_FINQ_BRAND_ID", 2);
    define("LCC_AVAILABLE_COMPANIES", json_encode(array ("ING", "LCC")));
    define("LCC_COMPANY", "LCC");
    define("FINQ_WIDGET_URL", "https://widgets.finq.com");
    define("FINQ_WIDGET_IFRAME_URL", FINQ_WIDGET_URL."/en/myaccount/getuserdata");
    define("FINQ_LOGO_URL", "/sites/all/themes/finq/images/v2.0/logos/logo.png");

    class AppConfiguration {
        private $brandID, $availableCompanies, $brandCompany, $widgetUrl, $widgetIframeUrl, $logoUrl, $brand;
        private $wireTransferBrandID;
        public function __construct()
        {
            switch (BRAND) {
                case "TRADE":
                    $this->brandID = TRADE_BRAND_ID;
                    $this->availableCompanies = LCM_AVAILABLE_COMPANIES;
                    $this->brandCompany = LCM_COMPANY;
                    $this->widgetUrl = TRADE_WIDGET_URL;
                    $this->widgetIframeUrl = TRADE_WIDGET_IFRAME_URL;
                    $this->logoUrl = TRADE_LOGO_URL;
                    $this->brand = BRAND;
                    $this->wireTransferBrandID = WIRETRANSFER_TRADE_BRAND_ID;

                    break;
                case "FINQ":
                    $this->brandID = FINQ_BRAND_ID;
                    $this->availableCompanies = LCC_AVAILABLE_COMPANIES;
                    $this->brandCompany = LCC_COMPANY;
                    $this->widgetUrl = FINQ_WIDGET_URL;
                    $this->widgetIframeUrl = FINQ_WIDGET_IFRAME_URL;
                    $this->logoUrl = FINQ_LOGO_URL;
                    $this->brand = BRAND;
                    $this->wireTransferBrandID = WIRETRANSFER_FINQ_BRAND_ID;

                    break;
            }
        }

        public function GetClientSideVersion()
        {
            return CLIENT_SIDE_VERSION;
        }

        public function GetWireTransferBrandID()
        {
            return $this->wireTransferBrandID;
        }

        public function GetSupportMail(){
            return "support@".strtolower($this->GetBrand()).".com";
        }

        public function GetBrand() {
            return $this->brand;
        }

        public function GetDomain() {
            return $this->brand . ".com";
        }

        public function GetBrandID() {
            return $this->brandID;
        }

        public function GetLogoUrl() {
            return $this->logoUrl;
        }

        public function GetWidgetUrl() {
            return $this->widgetUrl;
        }

        public function GetWidgetIFrameUrl() {
            return $this->widgetIframeUrl;
        }

        public function GetCompany() {
            return $this->brandCompany;
        }

        public function GetAvailableCompanies() {
            return $this->availableCompanies;
        }

    }

    class IngenicoConfiguration {

        public function GetMerchantID() {
            return LIVE_INGENICO_MERCHANT_ID;
        }

        public function GetApiKeyID() {
            return LIVE_INGENICO_API_KEY_ID;
        }

        public function GetSecretApiKey() {
            return LIVE_INGENICO_SECRET_API_KEY;
        }

        public function GetAPIUrl() {
            return INGENICO_API_URL;
        }

        public function GetConvertionPath($target, $source, $amount) {

            $target = strtoupper($target);
            $source = strtoupper($source);

            $merchantID = $this->GetMerchantID();
            $url = str_replace("{merchant-id}",$merchantID,INGENICO_API_URL_CONVERTION);

            $url = str_replace("{source}", $source, $url);
            $url = str_replace("{target}", $target, $url);
            $url = str_replace("{amount}", $amount, $url);

            return $url;
        }

        public function GetPaymentPath() {
            $merchantID = $this->GetMerchantID();
            $url = str_replace("{merchant-id}",$merchantID,INGENICO_API_URL_PAYMENT);

            return $url;
        }
    }

    class IngenicoURLs {

        public function GetPaymentUrl() {
            $config = new IngenicoConfiguration();

            $url = $config->GetAPIUrl();
            $path = $config->GetPaymentPath();

            return $url.$path;
        }

        public function GetConvertionUrl($target, $source, $amount) {

            $config = new IngenicoConfiguration();

            $url = $config->GetAPIUrl();
            $path = $config->GetConvertionPath($target, $source, $amount);

            return $url.$path;
        }
    }

    class IngenicoCryptographicAlgorithms {

        public function GetUniqueIdentifier() {
            $randomContent = md5(time().'-'.mt_rand());

            $guid = $this->getGUID($randomContent);

            return $guid;
        }

        public function GetMessageIdentifier() {
            $randomContent = md5((time() + 7897).'-'.uniqid(rand()));

            $guid = $this->getGUID($randomContent);

            return $guid;
        }

        private function getGUID($randomContent) {
            $guid =
                substr($randomContent, 0, 8) . '-' .
                substr($randomContent, 8, 4) . '-' .
                substr($randomContent, 12, 4). '-' .
                substr($randomContent, 16, 4). '-' .
                substr($randomContent, 20);

            return $guid;
        }
    }