<?php 

$file = file_get_contents('http://nl.investing.com/server/server.php?username=Trade&password=ojt5Nx9H6_k2');
echo (htmlentities($file));

?>
