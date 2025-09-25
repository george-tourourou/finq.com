<?php 

$file = file_get_contents('http://it.investing.com/server/server.php?username=Trade&password=8Xhazbo_Bqy');
echo (htmlentities($file));

?>
