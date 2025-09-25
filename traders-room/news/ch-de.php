<?php 

//$file = file_get_contents('http://de.investing.com/server/server.php?username=Trade&password=ewkhunUTJ9_TO');
$file = file_get_contents('https://ms.investing.com/server/server.php?username=Trade&password=YcjSKl_Eu');
echo (htmlentities($file));

?>
