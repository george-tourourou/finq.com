<?php 

$file = file_get_contents('http://gr.investing.com/server/server.php?username=Trade&password=Ht9aDLRKhv_k08');
echo (htmlentities($file));

?>
