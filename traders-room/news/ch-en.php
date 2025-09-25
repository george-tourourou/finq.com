<?php 

$file = file_get_contents('http://www.investing.com/server/server.php?username=Trade&password=TptEx@p*Ru');

echo (htmlentities($file));
?>
