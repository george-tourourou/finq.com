<?php
//create module
date_default_timezone_set('Europe/Athens');
$regLogger = new RegistrationLogger();

$regLogger->Add();

class RegistrationLogger
{
    function Add()
    {
        $data = $_POST["data"];

        $data = json_encode($data);

        error_log("\n date and time: ".date('D M d, Y G:i')." content: ".$data, 3, "registration.log");
    }
}