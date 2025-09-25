<?php 
	include ('get-news.php');

	foreach($news_items as $item) {
		
		
		$in = array("<![CDATA[","]]>","Investing.com – ");
		$out = array("","","");
			
		$id = value_in('NewsID', $item);
		$category = value_in('Category', $item);
		if ($category==""){$category = "Other";}
		
		$NewsDate = value_in('Date', $item);
		$date = date("d/m/Y", strtotime($NewsDate));
		$time = date("G:i:s", strtotime($NewsDate));
		$title = value_in('Title', $item);
		$title = str_replace($in,$out,$title);
		$body = value_in('Body', $item);
		$body_o = value_in('Body', $item);				$image_and_url = value_in('image', $body_o);		$image_url = value_in('url', $image_and_url);				$body_o = str_replace("<image>.*<url>.+?<\/url>.*<\/image>", "", $body_o);		
			
		$start = strpos($body, '<a href="http://www.investing.com"'); 
			
		$body = str_replace($in,$out,$body);
		$body = substr($body, 0,$start);
		$body = str_replace('<a href="http://www.investi','',$body);
		$body = str_replace('Investing.com - ','',$body);
		$body = str_replace('Investing.com -- ','',$body); 
		$body = str_replace('Investing.com','',$body); 
		
		$image = str_replace(' ','_',$category);
		
		$wrapped = wordwrap($body_o, 170);
		$lines = explode("\n", $wrapped);
		$teaser = $lines[0] . '...';
		$teaser = str_replace('\n','',$teaser); 
		$teaser = str_replace('<br>','',$teaser); 		echo '
<style type="text/css">#mainwrapper{  background:url("/sites/all/themes/zenon/assets/images/top_lev_bg.png") no-repeat center top;  background-size:100% 1500px;}</style><header>  <h3 class="key_title_h3  key_margin_bottom_50 custom-h3">'.    $title. '  </h3></header><div class="row">  <div class="col-md-7">    <p class="key_simple_par">'.      $body_o.'  </div>  <div class="col-md-5 hidden-sm key_centered ">    <figure class="key_margin_bottom_50">      <img alt="office" class="img-responsive" src="'.$image_url.'" />    </figure>  </div></div>';			
		
	} 
?>