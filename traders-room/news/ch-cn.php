<?php 

$file = file_get_contents('https://cn.investing.com/server/server.php?username=trade.com&password=jIY0KUJZ_F2r');

echo (htmlentities($file));

?>
