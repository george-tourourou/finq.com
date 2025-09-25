<?php 

$file = file_get_contents('http://es.investing.com/server/server.php?username=Trade&password=TE4BjLz9q1_lI');
echo (htmlentities($file));

?>
