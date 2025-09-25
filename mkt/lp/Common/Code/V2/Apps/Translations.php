<?php 

function GetSocialTranslationsArray() { 
	$page_lang_code = 'en_';
	$page_translations[$page_lang_code.'title'] = "Available on all platforms";	
	
	$page_lang_code = 'it_';
	$page_translations[$page_lang_code.'title'] = "Disponibile su tutte le piattaforme";	
	
	$page_lang_code = 'ar_';
	$page_translations[$page_lang_code.'title'] = "تتوفر على كل المنصات";
	
	
	$page_lang_code = 'de_';
	$page_translations[$page_lang_code.'title'] = "Für alle Plattformen verfügbar";
	
	$page_lang_code = 'pl_';
	$page_translations[$page_lang_code.'title'] = "Dostępne na wszystkich platformach";
	
	$page_lang_code = 'es_';
	$page_translations[$page_lang_code.'title'] = "Disponible en todas las plataformas";	
	
	$page_lang_code = 'ms_';
	$page_translations[$page_lang_code.'title'] = "Boleh didapati di semua platform";
	
	$page_lang_code = 'ur_';
	$page_translations[$page_lang_code.'title'] = "تمام پلیٹ فارمز پر دستیاب";
	
	return $page_translations;
}
function GetSocialTranslation($alias) {

	$lang_code = getPageLanguage();
	$page_translations = GetSocialTranslationsArray();
	
	$key = $lang_code.'_'.$alias;
	
	if (array_key_exists($key, $page_translations)) {
		return $page_translations[$key];
	}
	
	$key = 'en_'.$alias;
	
	return $page_translations[$key];;
}
































?>