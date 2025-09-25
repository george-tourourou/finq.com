<?php
class LeadSubmitConfiguration
{
    public $BRAND_NAME = 'finq';
    public $MOBILE_REDIRECT_URL = '';
    public $CRM_BRAND_ID = '';

    public function __construct()
    {
        if($this->BRAND_NAME == "finq") {
            $this->MOBILE_REDIRECT_URL = 'https://go.onelink.me/SNj0';
            $this->CRM_BRAND_ID = '78';
        }
        else {
            $this->MOBILE_REDIRECT_URL = 'https://go.onelink.me/3548726229';
            $this->CRM_BRAND_ID = '5';
        }
    }
}