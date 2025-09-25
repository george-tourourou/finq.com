<?php

//stream_context_get_default(['ssl' =>
//    ['verify_peer'=>false,
//    'verify_peer_name'=>false,]
//
//    ]);
$assetName = 'gold';

$json_string = 'https://api-v2.trade.com/quotesv2?key=1&callback=callbackQuotes&q=gold';

/*
//$url = "https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&playlistId=".$playlistId."&maxResults=".$maxResults."&key=".$api_key;
$data = json_decode(file_get_contents($json_string));
echo $data->buy;

echo "<br>aaaaa<br>";

$jsondata = file_get_contents($json_string);
echo $jsondata;
*/








$ch = curl_init();
// IMPORTANT: the below line is a security risk, read https://paragonie.com/blog/2017/10/certainty-automated-cacert-pem-management-for-php-software
// in most cases, you should set it to true
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $json_string);
$result = curl_exec($ch);
curl_close($ch);
//$obj = str_replace("callbackQuotes(", "", $jsondata);
//$obj = str_replace(");", "", $jsondata);
//$obj = json_decode($result);
//$obj = $result;
//echo $obj['buy'];
//echo $obj;

//$json_string = 'https://api-v2.trade.com/quotesv2?key=1&callback=callbackQuotes&q='.$assetName;
//$jsondata = file_get_contents($json_string);
$result = str_replace("callbackQuotes(", "", $result);
$result = str_replace(");", "", $result);
$obj = json_decode($result, true);

$old_price = 1279;
$assets_buy = $obj[$assetName]['buy'];
$assets_sell = $obj[$assetName]['sell'];
$assets_price = $obj[$assetName]['price'];

echo 'asdasdasdasd';
echo "$assets_buy";
?>




