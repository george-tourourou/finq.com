<?php 
$file = file_get_contents('http://pl.investing.com/server/server.php?username=Trade&password=pHv9WM_kwZ');
echo (htmlentities($file));

?>
