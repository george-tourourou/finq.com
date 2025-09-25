<?php 	global $language;	$curr_lang = $language->language;		$news_id = $_GET['nid'];		// $news_url = "http://www.investing.com/server/server.php?username=markets&password=Ma7Ke7sT52d3";	$news_url = "http://www.investing.com/server/server.php?username=Trade&password=TptEx@p*Ru";	//echo $news_url;	
	$xml = file_get_contents($news_url);	
	include_once 'xml_regex.php';
	$news_items = element_set('Item', $xml);
	print $xml;
?>