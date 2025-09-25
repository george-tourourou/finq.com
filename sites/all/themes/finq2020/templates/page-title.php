 <?php 
	function getPageTitle($placeholder)
	{
		if (strpos($placeholder, '[') !== false) {
			
			$length = stripos($placeholder, ']') - 1;	
			
			$forTranslation = substr($placeholder, 1, $length);		
			$siteName = substr($placeholder, ($length + 2));
			
			return tt($forTranslation).$siteName; 
		}
		else {
			return $placeholder;
		}		
	}
  ?>