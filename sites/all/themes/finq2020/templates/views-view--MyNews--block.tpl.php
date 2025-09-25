<div id="hidden-news" class="hide">
<?php print($rows); ?>
</div>
<?php
	/*
	class newsBanner {
		public $title;
		public $href;
		public $description;
		public $dateDescription;
		public $imgSrc;
	}
	
	$news = [];
	
	$dom = new DOMDocument;
	$dom->loadHTML($rows);	
	
	function getElementsByClass(&$parentNode, $tagName, $className) {
		$nodes=array();

		$childNodeList = $parentNode->getElementsByTagName($tagName);
		for ($i = 0; $i < $childNodeList->length; $i++) {
			$temp = $childNodeList->item($i);
			if (stripos($temp->getAttribute('class'), $className) !== false) {
				$nodes[]=$temp;
			}
		}

		return $nodes;
	}
	
	
	$newsDOMElements = getElementsByClass($dom, 'li', 'views-row');
	
	//var_dump($newsDOMElements);
	
	foreach ($newsDOMElements as $newsDOMElement) {
		
		$note = new newsBanner();
		
		
		$anchor = $newsDOMElement->getElementsByTagName('a')[0];
		$paragraph = $newsDOMElement->getElementsByTagName('p')[0];
		$img = $newsDOMElement->getElementsByTagName('img')[0];
		$dateDescription = $newsDOMElement->getElementsByTagName('h6')[0];
		
		$note->title		= $anchor->nodeValue;
		$note->href			= $anchor->getAttribute('href');
		$note->description 	= $paragraph->nodeValue;
		
		if($img != null)
		{
			$note->imgSrc	= $img->getAttribute('src');
		}		
		else 
		{
			$note->imgSrc = '/sites/all/themes/finq/images/v2.0/main-page/news/default.jpg';
		}
		$note->dateDescription = $dateDescription->nodeValue;
		
		$news[] = $note;
		
	}*/
?>
<div class="full assets-news">
    <h2> <?= tt('translate_frontpage_assets_news_title')?> <a href="/[language:code]/news"><span class="video-and-news-btn"><?= tt(translate_frontpage_all_market_news_btn)?></span></a> </h2>
    <div class="full">
        <div class="phone-version col-mg-2_15 left-side">
            <a id="previousSlide">&#10094;</a>
        </div>
        <div id='news-slider-previous' class="col-4_12 news-slider">
            <a class="full" href=''>
                <div class="full">
                    <img src="">
                    <h3>
                    </h3>
<!--                    <p>-->
<!--                    </p>-->

                    <small><?php print($news[0]->dateDescription); ?></small>
                </div>
            </a>
        </div>
        <div id='news-slider-current' class="col-4_12 news-slider">
            <a href=''>
                <div class="full">
                    <img src="<?php echo $news[1]->imgSrc; ?>">
                    <h3>
                    </h3>
<!--                    <p>-->
<!--                    </p>-->
                    <small><?php print($news[1]->dateDescription); ?></small>
                </div>
            </a>
        </div>
        <div id='news-slider-next' class="col-4_12 news-slider">
            <a href=''>
                <div class="full">
                    <img src="">
                    <h3>
                    </h3>
<!--                    <p>-->
<!--                    </p>-->
                    <small><?php print($news[2]->dateDescription); ?></small>
                </div>
            </a>
        </div>
        <div class="phone-version col-mg-2_15 right-side">
            <a id="nextSlide">&#10095;</a>
        </div>

        <div class="pc-version col-12_12">
            <div class="col-mg-2_15">
                <a id="previousSlide">&#10094;</a>
            </div>
            <div class="col-mg-2_15">
                <a id="nextSlide">&#10095;</a>
            </div>
        </div>
    </div>


</div>
<script type="text/javascript" src="/sites/all/themes/finq/js/v2.0/News.js?c=7"></script>