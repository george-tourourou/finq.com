<?php 

$file = file_get_contents('http://se.investing.com/server/server.php?username=Trade&password=uXWh2eEsm_Kr');
echo (htmlentities($file));

?>
