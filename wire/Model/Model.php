<?php
    /**
     * Created by PhpStorm.
     * User: george.t
     * Date: 10/8/2018
     * Time: 10:19 AM
     */
    class GetControllerModel
    {
        public $ClientID;
        public $AccountID;
        public $FirstName;
        public $LastName;

        public $ShowHeader;
        public $UserHasAccesToBarclaysBank;
        public $IsMobileApplication;

        public $AvailableCompanies;
        public $WidgetUrl;
        public $ClientSideVersion;
        public $LogoUrl;
        public $Brand;
        public $Domain;
        public $SupportMail;
        public $WidgetIFrameUrl;

        public $BankAccounts;
        public $Currencies;
        public $Countries;
    }

    class MobileApplication {
        public $IsMobileApplication;
        public $ClientID;
        public $AccountID;
        public $FirstName;
        public $LastName;
    }


    class BankAccount
    {
        public $BankTypeID;
        public $BankAccountID;
        public $BankName;
        public $BankTypeName;
        public $PrimaryCountryName;
        public $CountryName;
        public $CurrencyName;
        //public $CompanyName;
        public $CountryCode;
    }

    class CurrencyMinMaxDeposits
    {
        public $Name;
        public $MinimumDeposit;
        public $MaximumDeposit;
    }