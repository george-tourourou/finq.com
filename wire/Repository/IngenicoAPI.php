<?php
    /**
     * Created by PhpStorm.
     * User: george.t
     * Date: 4/3/2018
     * Time: 10:58 AM
     */

    include_once($_SERVER['DOCUMENT_ROOT']."/wire2/Configuration/Configuration.php");

    class IngenicoAPI
{
    private function getDateTime() {
        $dateTime = new DateTime();

        $date = $dateTime->format('D, j M Y G:i:s T');

        return $date;
    }

    public function Request($Model) {
        $ingenicoURLs = new IngenicoURLs();
        $ingenicoCrypto = new IngenicoCryptographicAlgorithms();
        $ingenicoConfig = new IngenicoConfiguration();

        $uniqueId = $ingenicoCrypto->GetMessageIdentifier();
        $messageId = $ingenicoCrypto->GetMessageIdentifier();
        $date = $this->getDateTime();
        $paymentUrl = $ingenicoURLs->GetPaymentUrl();
        $paymentUrlPath = $ingenicoConfig->GetPaymentPath();

        $authentication = $this->getAuthentication(false, $messageId, $uniqueId, $date, $paymentUrlPath);
        $headers = $this->getHeaders($date, $uniqueId, $messageId, $authentication);

        $data = $this->execute($paymentUrl, $headers, true, $Model);

        return $data;
    }

    public function Convertion($TargetCurrency, $SourceCurrency, $Amount) {

        $ingenicoURLs = new IngenicoURLs();
        $ingenicoConfig = new IngenicoConfiguration();
        $ingenicoCrypto = new IngenicoCryptographicAlgorithms();


        $uniqueId = $ingenicoCrypto->GetUniqueIdentifier();
        $messageId = $ingenicoCrypto->GetMessageIdentifier();

        $date = $this->getDateTime();
        $paymentUrl = $ingenicoURLs->GetConvertionUrl($TargetCurrency, $SourceCurrency, $Amount);
        $convertionUrlPath = $ingenicoConfig->GetConvertionPath($TargetCurrency, $SourceCurrency, $Amount);

        $authentication = $this->getAuthentication(true, $messageId, $uniqueId, $date, $convertionUrlPath);
        $headers = $this->getHeaders($date, $uniqueId, $messageId, $authentication);

        $data = $this->execute($paymentUrl, $headers, false, null);

        $data = json_encode($data);

        return $data;
    }

    /**
     * @param $date
     * @param $authentication
     * @return array
     */
    public function getHeaders($date, $uniqueId, $messageId, $authentication)
    {
        $ingenicoConfig = new IngenicoConfiguration();
        $apiKeyId = $ingenicoConfig->GetApiKeyID();

        $headers = array();
        $headers[] = 'x-gcs-requestid:' . $uniqueId;
        $headers[] = "x-gcs-applicationidentifier:globalcollect-api-explorer";
        $headers[] = "content-type:application/json";
        $headers[] = 'x-gcs-messageid:' . $messageId;
        $headers[] = "date:" . $date;
        $headers[] = "authorization:GCS v1HMAC:" . $apiKeyId . ":" . $authentication;

        return $headers;
    }

    /**
     * @param $isGet
     * @param $date
     * @param $messageIdentifier
     * @param $uniqueIdentifier
     * @param $urlPath
     * @return string
     */
    private function getAuthentication($isGet, $messageId, $uniqueId, $date, $urlPath) {
        $ingenicoConfig = new IngenicoConfiguration();

        $apiSecretKey = $ingenicoConfig->GetSecretApiKey();

        $data = "";

        if($isGet == true)
        {
            $data = 'GET'. "\n";
        }
        else
        {
            $data = 'POST'. "\n";
        }

        $data .= 'application/json'. "\n";
        $data .= $date. "\n";
        $data .= 'x-gcs-applicationidentifier:globalcollect-api-explorer'. "\n";
        $data .= 'x-gcs-messageid:'.$messageId. "\n";
        $data .= 'x-gcs-requestid:'.$uniqueId. "\n";
        $data .= $urlPath. "\n";

        $authentication = base64_encode(hash_hmac('sha256', $data, $apiSecretKey, true));

        return $authentication;
    }

    /**
     * @param $paymentUrl
     * @param $headers
     * @return mixed
     */
    public function execute($paymentUrl, $headers, $isPostRequest, $model)
    {
        $ch = curl_init();

        if (!$ch) {
            die("Couldn't initialize a cURL handle");
        }

        curl_setopt($ch, CURLOPT_URL, $paymentUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        if($isPostRequest)
        {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $model);
            curl_setopt($ch, CURLOPT_POST, 1);
        }

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }

        curl_close($ch);

        return $result;
    }
}