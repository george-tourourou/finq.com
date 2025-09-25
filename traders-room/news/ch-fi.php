<?php 

$file = file_get_contents('http://fi.investing.com/server/server.php?username=Trade&password=x4T7Jiu00m_e0v');
echo (htmlentities($file));

?>
