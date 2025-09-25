<?php 


$file = file_get_contents('http://sa.investing.com/server/server.php?username=Trade&password=B0ocXj3_VI');
echo (htmlentities($file));

?>
