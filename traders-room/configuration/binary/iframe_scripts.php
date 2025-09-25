<?php 
 
function print_iframe_id($url, $style, $height, $width, $settings, $id){

	echo '<iframe ';
	echo ' id="' . $id . '" ';	
	echo ' src="'.$url.'" '; 
	echo ' style="'.$style.'" '; 
	echo ' width='.$width.'" ';
	echo $settings;
	echo ">";
	echo "</iframe>";
}

function print_com_script($iframe_name){

	echo "
	<script type='text/javascript'>

	window.addEventListener('message', widget_comunicator_callback, false);

	function widget_comunicator_callback(event){
		var msg=JSON.parse(event.data);
		switch(msg.type)
		{
			case 'email_duplication':
				// do something like open a login/forgot login widget break; 
			case 'WIDGET_POPUP_SIZE':
				// setting the widget iframe height
				jQuery('#". $iframe_name . "').height((msg.body.height+40) + 'px');
				break;
			case 'accountdetails_success':
				// do something like display auto login or deposit buttons/ links break; 
		}	 
	}

	</script>";
}

?>