<?php

/**
 * Processing of AJAX for dynamic content functionality
 */

/**
 * Function which providing data according to $type
 * (get another function with name based on $type and execute it)
 * @param $type - type of data which we want to get
 */
function _dc_load_content($type) {
  drupal_page_is_cacheable(FALSE);
  $result = array();
  if (function_exists('_dc_load_content_' . $type)) {
    try {
      $result = array(
        'value' => call_user_func('_dc_load_content_' . $type),
        'error' => FALSE,
      );
    } catch (Exception $e) {
      $result = array(
        'error' => TRUE,
      );
    }
  }
  else {
    $result['error'] = TRUE;
  }

  drupal_json_output($result);
}

/**
 * Provide bonus data
 * @return mixed
 */
function _dc_load_content_bonus_table() {
  if ($cache = cache_get('dynamic_content_bonus_table')) {
    $cached_data = $cache->data;
  }
  else {
    $data = views_get_view_result('bonus_table');
    $cached_data = array();
    foreach ($data as $countryData) {
      $cached_data[$countryData->node_title] = array();
      foreach ($countryData->{'field_' . DC_BONUS_INFO_FIELD_NAME} as $bonusKey => $bonusInfo) {
        $cached_data[$countryData->node_title][$bonusKey] = explode(
          ';',
          $bonusInfo['raw']['value']
        );
      }
    }
    cache_set('dynamic_content_bonus_table', $cached_data, 'cache');
  }
  $country_code = strtolower($_SERVER["GEOIP2_COUNTRY_CODE"]);
  if (isset($cached_data[$country_code])) {
    return $cached_data[$country_code];
  }
  else {
    return $cached_data['default'];
  }
}