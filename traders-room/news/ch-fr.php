<?php 

$file = file_get_contents('http://fr.investing.com/server/server.php?username=Trade&password=srUCsR_HZ');
echo (htmlentities($file));

?>
