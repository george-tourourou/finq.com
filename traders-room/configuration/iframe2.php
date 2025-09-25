<?php 
 
function print_iframe($url, $style, $height, $width, $settings){

	echo '<iframe ';
	echo ' id="form-lp" ';
	echo ' src="'.$url.'" '; 
	echo ' style="'.$style.'" '; 
	echo ' height="'.$height.'" '; 
	echo ' width='.$width.'" ';
	echo $settings;
	echo ">";
	echo "</iframe>";
}

?>