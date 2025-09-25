<?php 

$file = file_get_contents('http://pt.investing.com/server/server.php?username=Trade&password=gWYSmK0hHe_M3w');

echo (htmlentities($file));

?>
