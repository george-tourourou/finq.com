<?php
    /**
     * Created by PhpStorm.
     * User: george.t
     * Date: 4/16/2018
     * Time: 4:48 PM
     */

    class IP
    {
        /**
         * @return string
         */
        public function UserHasAccesToBarclaysBank() {
            $countries = $this->getCountries();
            $userCountry = $this->getUserCoutryCode();
            $response = false;

            foreach ($countries as $country) {
                if($country['code'] == $userCountry)
                {
                    $response = $country["AccessToBarclaysBank"];
                }
            }

            return $response ? "true": "false";
        }

        /**
         * @return array|false|string
         */
        private function getUserCoutryCode(){
            return getenv("GEOIP2_COUNTRY_CODE");
        }

        /**
         * @return array
         */
        private function getCountries() {
            $countries = array();
            array_push($countries, array("code"=>"AF","name"=>"Afghanistan","d_code"=>"+93", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"AL","name"=>"Albania","d_code"=>"+355", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"DZ","name"=>"Algeria","d_code"=>"+213", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"AS","name"=>"American Samoa","d_code"=>"+1", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"AD","name"=>"Andorra","d_code"=>"+376", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"AO","name"=>"Angola","d_code"=>"+244", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"AI","name"=>"Anguilla","d_code"=>"+1", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"AG","name"=>"Antigua","d_code"=>"+1", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"AR","name"=>"Argentina","d_code"=>"+54", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"AM","name"=>"Armenia","d_code"=>"+374", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"AW","name"=>"Aruba","d_code"=>"+297", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"AU","name"=>"Australia","d_code"=>"+61", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"AT","name"=>"Austria","d_code"=>"+43", "AccessToBarclaysBank" => true));
            array_push($countries, array("code"=>"AZ","name"=>"Azerbaijan","d_code"=>"+994", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"BH","name"=>"Bahrain","d_code"=>"+973", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"BD","name"=>"Bangladesh","d_code"=>"+880", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"BB","name"=>"Barbados","d_code"=>"+1", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"BY","name"=>"Belarus","d_code"=>"+375", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"BE","name"=>"Belgium","d_code"=>"+32", "AccessToBarclaysBank" => true));
            array_push($countries, array("code"=>"BZ","name"=>"Belize","d_code"=>"+501", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"BJ","name"=>"Benin","d_code"=>"+229", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"BM","name"=>"Bermuda","d_code"=>"+1", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"BT","name"=>"Bhutan","d_code"=>"+975", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"BO","name"=>"Bolivia","d_code"=>"+591", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"BA","name"=>"Bosnia and Herzegovina","d_code"=>"+387", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"BW","name"=>"Botswana","d_code"=>"+267", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"BR","name"=>"Brazil","d_code"=>"+55", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"IO","name"=>"British Indian Ocean Territory","d_code"=>"+246", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"VG","name"=>"British Virgin Islands","d_code"=>"+1", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"BN","name"=>"Brunei","d_code"=>"+673", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"BG","name"=>"Bulgaria","d_code"=>"+359", "AccessToBarclaysBank" => true));
            array_push($countries, array("code"=>"BF","name"=>"Burkina Faso","d_code"=>"+226", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"MM","name"=>"Burma Myanmar" ,"d_code"=>"+95", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"BI","name"=>"Burundi","d_code"=>"+257", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"KH","name"=>"Cambodia","d_code"=>"+855", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"CM","name"=>"Cameroon","d_code"=>"+237", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"CA","name"=>"Canada","d_code"=>"+1", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"CV","name"=>"Cape Verde","d_code"=>"+238", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"KY","name"=>"Cayman Islands","d_code"=>"+1", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"CF","name"=>"Central African Republic","d_code"=>"+236", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"TD","name"=>"Chad","d_code"=>"+235", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"CL","name"=>"Chile","d_code"=>"+56", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"CN","name"=>"China","d_code"=>"+86", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"CO","name"=>"Colombia","d_code"=>"+57", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"KM","name"=>"Comoros","d_code"=>"+269", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"CK","name"=>"Cook Islands","d_code"=>"+682", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"CR","name"=>"Costa Rica","d_code"=>"+506", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"CI","name"=>"Cote d'Ivoire" ,"d_code"=>"+225", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"HR","name"=>"Croatia","d_code"=>"+385", "AccessToBarclaysBank" => true));
            array_push($countries, array("code"=>"CU","name"=>"Cuba","d_code"=>"+53", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"CY","name"=>"Cyprus","d_code"=>"+357", "AccessToBarclaysBank" => true));
            array_push($countries, array("code"=>"CZ","name"=>"Czech Republic","d_code"=>"+420", "AccessToBarclaysBank" => true));
            array_push($countries, array("code"=>"CD","name"=>"Democratic Republic of Congo","d_code"=>"+243", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"DK","name"=>"Denmark","d_code"=>"+45", "AccessToBarclaysBank" => true));
            array_push($countries, array("code"=>"DJ","name"=>"Djibouti","d_code"=>"+253", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"DM","name"=>"Dominica","d_code"=>"+1", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"DO","name"=>"Dominican Republic","d_code"=>"+1", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"EC","name"=>"Ecuador","d_code"=>"+593", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"EG","name"=>"Egypt","d_code"=>"+20", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"SV","name"=>"El Salvador","d_code"=>"+503", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"GQ","name"=>"Equatorial Guinea","d_code"=>"+240", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"ER","name"=>"Eritrea","d_code"=>"+291", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"EE","name"=>"Estonia","d_code"=>"+372", "AccessToBarclaysBank" => true));
            array_push($countries, array("code"=>"ET","name"=>"Ethiopia","d_code"=>"+251", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"FK","name"=>"Falkland Islands","d_code"=>"+500", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"FO","name"=>"Faroe Islands","d_code"=>"+298", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"FM","name"=>"Federated States of Micronesia","d_code"=>"+691", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"FJ","name"=>"Fiji","d_code"=>"+679", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"FI","name"=>"Finland","d_code"=>"+358", "AccessToBarclaysBank" => true));
            array_push($countries, array("code"=>"FR","name"=>"France","d_code"=>"+33", "AccessToBarclaysBank" => true));
            array_push($countries, array("code"=>"GF","name"=>"French Guiana","d_code"=>"+594", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"PF","name"=>"French Polynesia","d_code"=>"+689", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"GA","name"=>"Gabon","d_code"=>"+241", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"GE","name"=>"Georgia","d_code"=>"+995", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"DE","name"=>"Germany","d_code"=>"+49", "AccessToBarclaysBank" => true));
            array_push($countries, array("code"=>"GH","name"=>"Ghana","d_code"=>"+233", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"GI","name"=>"Gibraltar","d_code"=>"+350", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"GR","name"=>"Greece","d_code"=>"+30", "AccessToBarclaysBank" => true));
            array_push($countries, array("code"=>"GL","name"=>"Greenland","d_code"=>"+299", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"GD","name"=>"Grenada","d_code"=>"+1", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"GP","name"=>"Guadeloupe","d_code"=>"+590", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"GU","name"=>"Guam","d_code"=>"+1", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"GT","name"=>"Guatemala","d_code"=>"+502", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"GN","name"=>"Guinea","d_code"=>"+224", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"GW","name"=>"Guinea-Bissau","d_code"=>"+245", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"GY","name"=>"Guyana","d_code"=>"+592", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"HT","name"=>"Haiti","d_code"=>"+509", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"HN","name"=>"Honduras","d_code"=>"+504", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"HK","name"=>"Hong Kong","d_code"=>"+852", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"HU","name"=>"Hungary","d_code"=>"+36", "AccessToBarclaysBank" => true));
            array_push($countries, array("code"=>"IS","name"=>"Iceland","d_code"=>"+354", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"IN","name"=>"India","d_code"=>"+91", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"ID","name"=>"Indonesia","d_code"=>"+62", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"IR","name"=>"Iran","d_code"=>"+98", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"IQ","name"=>"Iraq","d_code"=>"+964", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"IE","name"=>"Ireland","d_code"=>"+353", "AccessToBarclaysBank" => true));
            array_push($countries, array("code"=>"IL","name"=>"Israel","d_code"=>"+972", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"IT","name"=>"Italy","d_code"=>"+39", "AccessToBarclaysBank" => true));
            array_push($countries, array("code"=>"JM","name"=>"Jamaica","d_code"=>"+1", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"JP","name"=>"Japan","d_code"=>"+81", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"JO","name"=>"Jordan","d_code"=>"+962", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"KZ","name"=>"Kazakhstan","d_code"=>"+7", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"KE","name"=>"Kenya","d_code"=>"+254", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"KI","name"=>"Kiribati","d_code"=>"+686", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"XK","name"=>"Kosovo","d_code"=>"+381", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"KW","name"=>"Kuwait","d_code"=>"+965", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"KG","name"=>"Kyrgyzstan","d_code"=>"+996", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"LA","name"=>"Laos","d_code"=>"+856", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"LV","name"=>"Latvia","d_code"=>"+371", "AccessToBarclaysBank" => true));
            array_push($countries, array("code"=>"LB","name"=>"Lebanon","d_code"=>"+961", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"LS","name"=>"Lesotho","d_code"=>"+266", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"LR","name"=>"Liberia","d_code"=>"+231", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"LY","name"=>"Libya","d_code"=>"+218", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"LI","name"=>"Liechtenstein","d_code"=>"+423", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"LT","name"=>"Lithuania","d_code"=>"+370", "AccessToBarclaysBank" => true));

            array_push($countries, array("code"=>"LU","name"=>"Luxembourg","d_code"=>"+352", "AccessToBarclaysBank" => true));
            array_push($countries, array("code"=>"MO","name"=>"Macau","d_code"=>"+853", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"MK","name"=>"Macedonia","d_code"=>"+389", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"MG","name"=>"Madagascar","d_code"=>"+261", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"MW","name"=>"Malawi","d_code"=>"+265", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"MY","name"=>"Malaysia","d_code"=>"+60", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"MV","name"=>"Maldives","d_code"=>"+960", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"ML","name"=>"Mali","d_code"=>"+223", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"MT","name"=>"Malta","d_code"=>"+356", "AccessToBarclaysBank" => true));
            array_push($countries, array("code"=>"MH","name"=>"Marshall Islands","d_code"=>"+692", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"MQ","name"=>"Martinique","d_code"=>"+596", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"MR","name"=>"Mauritania","d_code"=>"+222", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"MU","name"=>"Mauritius","d_code"=>"+230", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"YT","name"=>"Mayotte","d_code"=>"+262", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"MX","name"=>"Mexico","d_code"=>"+52", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"MD","name"=>"Moldova","d_code"=>"+373", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"MC","name"=>"Monaco","d_code"=>"+377", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"MN","name"=>"Mongolia","d_code"=>"+976", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"ME","name"=>"Montenegro","d_code"=>"+382", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"MS","name"=>"Montserrat","d_code"=>"+1", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"MA","name"=>"Morocco","d_code"=>"+212", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"MZ","name"=>"Mozambique","d_code"=>"+258", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"NA","name"=>"Namibia","d_code"=>"+264", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"NR","name"=>"Nauru","d_code"=>"+674", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"NP","name"=>"Nepal","d_code"=>"+977", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"NL","name"=>"Netherlands","d_code"=>"+31", "AccessToBarclaysBank" => true));
            array_push($countries, array("code"=>"AN","name"=>"Netherlands Antilles","d_code"=>"+599", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"NC","name"=>"New Caledonia","d_code"=>"+687", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"NZ","name"=>"New Zealand","d_code"=>"+64", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"NI","name"=>"Nicaragua","d_code"=>"+505", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"NE","name"=>"Niger","d_code"=>"+227", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"NG","name"=>"Nigeria","d_code"=>"+234", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"NU","name"=>"Niue","d_code"=>"+683", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"NF","name"=>"Norfolk Island","d_code"=>"+672", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"KP","name"=>"North Korea","d_code"=>"+850", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"MP","name"=>"Northern Mariana Islands","d_code"=>"+1", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"NO","name"=>"Norway","d_code"=>"+47", "AccessToBarclaysBank" => true));
            array_push($countries, array("code"=>"OM","name"=>"Oman","d_code"=>"+968", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"PK","name"=>"Pakistan","d_code"=>"+92", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"PW","name"=>"Palau","d_code"=>"+680", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"PS","name"=>"Palestine","d_code"=>"+970", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"PA","name"=>"Panama","d_code"=>"+507", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"PG","name"=>"Papua New Guinea","d_code"=>"+675", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"PY","name"=>"Paraguay","d_code"=>"+595", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"PE","name"=>"Peru","d_code"=>"+51", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"PH","name"=>"Philippines","d_code"=>"+63", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"PL","name"=>"Poland","d_code"=>"+48", "AccessToBarclaysBank" => true));
            array_push($countries, array("code"=>"PT","name"=>"Portugal","d_code"=>"+351", "AccessToBarclaysBank" => true));
            array_push($countries, array("code"=>"PR","name"=>"Puerto Rico","d_code"=>"+1", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"QA","name"=>"Qatar","d_code"=>"+974", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"CG","name"=>"Republic of the Congo","d_code"=>"+242", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"RE","name"=>"Reunion" ,"d_code"=>"+262", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"RO","name"=>"Romania","d_code"=>"+40", "AccessToBarclaysBank" => true));
            array_push($countries, array("code"=>"RU","name"=>"Russia","d_code"=>"+7", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"RW","name"=>"Rwanda","d_code"=>"+250", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"BL","name"=>"Saint Barthelemy" ,"d_code"=>"+590", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"SH","name"=>"Saint Helena","d_code"=>"+290", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"KN","name"=>"Saint Kitts and Nevis","d_code"=>"+1", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"MF","name"=>"Saint Martin","d_code"=>"+590", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"PM","name"=>"Saint Pierre and Miquelon","d_code"=>"+508", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"VC","name"=>"Saint Vincent and the Grenadines","d_code"=>"+1", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"WS","name"=>"Samoa","d_code"=>"+685", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"SM","name"=>"San Marino","d_code"=>"+378", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"ST","name"=>"Sao Tome and Principe" ,"d_code"=>"+239", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"SA","name"=>"Saudi Arabia","d_code"=>"+966", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"SN","name"=>"Senegal","d_code"=>"+221", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"RS","name"=>"Serbia","d_code"=>"+381", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"SC","name"=>"Seychelles","d_code"=>"+248", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"SL","name"=>"Sierra Leone","d_code"=>"+232", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"SG","name"=>"Singapore","d_code"=>"+65", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"SK","name"=>"Slovakia","d_code"=>"+421", "AccessToBarclaysBank" => true));
            array_push($countries, array("code"=>"SI","name"=>"Slovenia","d_code"=>"+386", "AccessToBarclaysBank" => true));
            array_push($countries, array("code"=>"SB","name"=>"Solomon Islands","d_code"=>"+677", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"SO","name"=>"Somalia","d_code"=>"+252", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"ZA","name"=>"South Africa","d_code"=>"+27", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"KR","name"=>"South Korea","d_code"=>"+82", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"ES","name"=>"Spain","d_code"=>"+34", "AccessToBarclaysBank" => true));
            array_push($countries, array("code"=>"LK","name"=>"Sri Lanka","d_code"=>"+94", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"LC","name"=>"St. Lucia","d_code"=>"+1", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"SD","name"=>"Sudan","d_code"=>"+249", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"SR","name"=>"Suriname","d_code"=>"+597", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"SZ","name"=>"Swaziland","d_code"=>"+268", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"SE","name"=>"Sweden","d_code"=>"+46", "AccessToBarclaysBank" => true));
            array_push($countries, array("code"=>"CH","name"=>"Switzerland","d_code"=>"+41", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"SY","name"=>"Syria","d_code"=>"+963", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"TW","name"=>"Taiwan","d_code"=>"+886", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"TJ","name"=>"Tajikistan","d_code"=>"+992", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"TZ","name"=>"Tanzania","d_code"=>"+255", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"TH","name"=>"Thailand","d_code"=>"+66", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"BS","name"=>"The Bahamas","d_code"=>"+1", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"GM","name"=>"The Gambia","d_code"=>"+220", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"TL","name"=>"Timor-Leste","d_code"=>"+670", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"TG","name"=>"Togo","d_code"=>"+228", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"TK","name"=>"Tokelau","d_code"=>"+690", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"TO","name"=>"Tonga","d_code"=>"+676", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"TT","name"=>"Trinidad and Tobago","d_code"=>"+1", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"TN","name"=>"Tunisia","d_code"=>"+216", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"TR","name"=>"Turkey","d_code"=>"+90", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"TM","name"=>"Turkmenistan","d_code"=>"+993", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"TC","name"=>"Turks and Caicos Islands","d_code"=>"+1", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"TV","name"=>"Tuvalu","d_code"=>"+688", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"UG","name"=>"Uganda","d_code"=>"+256", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"UA","name"=>"Ukraine","d_code"=>"+380", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"AE","name"=>"United Arab Emirates","d_code"=>"+971", "AccessToBarclaysBank" => true));
            array_push($countries, array("code"=>"GB","name"=>"United Kingdom","d_code"=>"+44", "AccessToBarclaysBank" => true));
            array_push($countries, array("code"=>"US","name"=>"United States","d_code"=>"+1", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"UY","name"=>"Uruguay","d_code"=>"+598", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"VI","name"=>"US Virgin Islands","d_code"=>"+1", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"UZ","name"=>"Uzbekistan","d_code"=>"+998", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"VU","name"=>"Vanuatu","d_code"=>"+678", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"VA","name"=>"Vatican City","d_code"=>"+39", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"VE","name"=>"Venezuela","d_code"=>"+58", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"VN","name"=>"Vietnam","d_code"=>"+84", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"WF","name"=>"Wallis and Futuna","d_code"=>"+681", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"YE","name"=>"Yemen","d_code"=>"+967", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"ZM","name"=>"Zambia","d_code"=>"+260", "AccessToBarclaysBank" => false));
            array_push($countries, array("code"=>"ZW","name"=>"Zimbabwe","d_code"=>"+263", "AccessToBarclaysBank" => false));

            return $countries;
        }
    }