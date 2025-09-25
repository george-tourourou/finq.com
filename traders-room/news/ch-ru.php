<?php 


$file = file_get_contents('http://ru.investing.com/server/server.php?username=Trade&password=X0DbfpqpB5_wJ');

echo (htmlentities($file));

?>
