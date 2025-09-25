<?php

class RegistrationBlockRepository {

    public function HasAccess()
    {
        $clientCountryCode = $this->getUserCoutryCode();
        $forbiddenCountries = array("US", "AU", "BR", "CA", "CD", "ER", "IL", "JP", "LY", "NZ", "KP", "SO", "SD", "TR", "RU");

        return !in_array($clientCountryCode, $forbiddenCountries, true );
    }

    public function IsEUClient() {
        $clientCountryCode = $this->getUserCoutryCode();
        $euCountries = array("CY", "BE", "BG", "CZ", "DK", "DE", "EE", "IE", "EL", "ES", "FR", "HR", "IT", "LV", "LT", "LU", "HU", "MT", "NL", "AT", "PL", "PT", "RO", "SI", "SK", "FI", "SE");

        return in_array($clientCountryCode, $euCountries, true );
    }

    public function GetCurrencies() {
        $isSriLankaClient = $this->isSriLankaClient();

        if($isSriLankaClient) {
            return ["LKR"];
        }
        else {
            return["USD","RUB", "ZAR", "EUR","LKR","INR"];
        }
    }

    private function getUserCoutryCode(){
        return getenv("GEOIP2_COUNTRY_CODE");
    }

    /**
     * @return bool
     */
    private function isSriLankaClient()
    {
        $userCountry = $this->getUserCoutryCode();

        $SRI_LANKA_CODE = "LK";

        //sri lanka
        if ($userCountry == $SRI_LANKA_CODE) {
            return true;
        }

        return false;
    }

    public function GetParameters() {
        $params = $_SERVER['REQUEST_URI'];

        if (strpos($params, '?') !== false) {
            $params = explode("?", $params);

            return "&".$params[1];
        }

        return "";
    }
}