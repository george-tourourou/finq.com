<?php
    /**
     * Created by PhpStorm.
     * User: george.t
     * Date: 10/8/2018
     * Time: 10:17 AM
     */

    include_once $_SERVER['DOCUMENT_ROOT'] . "/wire/Model/Model.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/wire/Repository/IP.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/wire/Repository/Database.php";
    include_once $_SERVER['DOCUMENT_ROOT'] . "/wire/Configuration/Configuration.php";

    class GetController {

        /**
         * @return GetControllerModel
         */
        public function Index()
        {
            $ipRepository = new IP();
            $bankRepository = new BankRepository();
            $appConfiguration = new AppConfiguration();

            $MobileApplication = $this->GetMobileApplicationModel();

            $Model = new GetControllerModel();

            $Model->ShowHeader = true;
            $Model->IsMobileApplication = false;

            if ($MobileApplication->IsMobileApplication == true)
            {
                $Model->AccountID = $MobileApplication->AccountID;
                $Model->ClientID = $MobileApplication->ClientID;
                $Model->FirstName = $MobileApplication->FirstName;
                $Model->LastName = $MobileApplication->LastName;
                $Model->IsMobileApplication = true;
                $Model->ShowHeader = false;
            }
            else if(isset($_GET["account"]))
            {
                $Model->AccountID = $_GET["account"];
                $Model->ShowHeader = false;
            }

            $Model->UserHasAccesToBarclaysBank = $ipRepository->UserHasAccesToBarclaysBank();
            $Model->BankAccounts = json_encode($bankRepository->GetBankAccounts());
            $Model->Currencies = json_encode($bankRepository->GetCurrencies());
            $Model->Countries = json_encode($bankRepository->GetCountries());

            $Model->ClientSideVersion = $appConfiguration->GetClientSideVersion();
            $Model->AvailableCompanies = $appConfiguration->GetAvailableCompanies();
            $Model->WidgetUrl = $appConfiguration->GetWidgetUrl();
            $Model->LogoUrl = $appConfiguration->GetLogoUrl();
            $Model->Brand = $appConfiguration->GetBrand();
            $Model->Domain = $appConfiguration->GetDomain();
            $Model->SupportMail = $appConfiguration->GetSupportMail();
            $Model->WidgetIFrameUrl = $appConfiguration->GetWidgetIFrameUrl();

            return $Model;
        }

        /**
         * @return MobileApplication
         */
        private function GetMobileApplicationModel() {
            $Model = new MobileApplication();
            $Model->IsMobileApplication = false;

            //Get parameters from Cosmos mobile application
            if (isset($_GET["client_id"]))
            {
                if ($_GET["client_id"] != "")
                {
                    $Model->IsMobileApplication = true;
                    $Model->ClientID = $_GET["client_id"];
                }
            }

            if(isset($_GET["account_id"])) {
                $Model->AccountID = $_GET["account_id"];
            }

            if(isset($_GET["first_name"])) {
                $Model->FirstName = $_GET["first_name"];
            }

            if(isset($_GET["last_name"])) {
                $Model->LastName = $_GET["last_name"];
            }

            return $Model;
        }
    }
?>