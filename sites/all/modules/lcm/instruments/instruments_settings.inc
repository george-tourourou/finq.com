<?php

/**
 * Provide list of groups which should be hidden in instruments list page,
 * but all instruments from this groups should be available via instrument search
 * @return array - list of groups names
 */
function instruments_get_hidden_list_groups() {
  return array(
    'popular',
    'energy',
    'commodity',
    'currency.virtual'
  );
}

/**
 * Provide list of groups which will be shown on instruments list page
 * @return array - list of groups names
 */
function instruments_get_white_list_groups() {
  return array(
    'currency.*',
    'bonds.*',
    'index.*',
    'commodity.*',
    'Shares.*',
    'ETFs'
  );
}

/**
 * Provide information about which instruments with which group (keys of mapping)
 * should be moved to which another group (values of mapping)
 * Merge procedure will be made after remove 'black listed' groups
 * @return array - mapping of groups
 */
function instruments_get_mapping_for_merge_groups() {
  return array(
    'commodity' => 'metal',
    'energy' => 'metal',
  );
}

/**
 * Provide list of groups which should be fully ignored (with their instruments)
 * If instrument has more then one groups, and not all of them are hidden, then
 * this instrument will be visible in group which does not hidden.
 * This array has the highest priority - any others validations will be made after.
 * @return array - list of groups names
 */
function instruments_get_black_list_groups() {
  return array(
    'currency.virtual'
  );
}

/**
 * @return array - array of categories in right order
 * (if category is absent, then it will be not sorted - position stay "as is")
 */
function instruments_get_categories_order() {
  return array(
    'currency',
    'bonds',
    'index',
    'commodity',
    'shares',
    'major',
    'minor',
    'exotic',
    'virtual',
  );
}


/**
 * hook_variable_info implementation
 *
 * @return array
 */
function instruments_variable_info() {
  $variables = array();

  $variables['instruments_dealing_data_path'] = array(
    'title' => t('Path to data provider of dealing data'),
    'default' => 'http://api-v2.finq.com/dealingdata?key=1',
    'type' => 'string',
    'group' => 'Instruments',
    'token' => FALSE,
  );

  $variables['instruments_quotes_data_path'] = array(
    'title' => t('Path to data provider of quotes data'),
    'default' => 'http://api-v2.finq.com/quotesv2?key=1',
    'type' => 'string',
    'group' => 'Instruments',
    'token' => FALSE,
  );

  $variables['instruments_charts_data_path'] = array(
    'title' => t('Path to data provider of charts data'),
    'default' => 'http://api-v2.finq.com/chartsv2?key=1',
    'type' => 'string',
    'group' => 'Instruments',
    'token' => FALSE,
  );

  $variables['instruments_read_external_data_interval'] = array(
    'title' => t('Period of automatic re-read dealing data'),
    'default' => 60 * 60 * 24,   // Default to an daily interval
    'type' => 'number',
    'group' => 'Instruments',
    'token' => FALSE,
  );

  $variables['instruments_read_external_data_next_execution'] = array(
    'title' => t(
      'Next execution of re-read dealing data procedure (Unix timestamp - automatic update)'
    ),
    'default' => 0,
    'type' => 'number',
    'group' => 'Instruments',
    'token' => FALSE,
  );

  $variables['instruments_rollovers_data_path'] = array(
    'title' => t('Path to data provider of rollovers data'),
    'default' => 'http://api-v2.finq.com/api/instruments?pretty&from={from}&to={to}',
    'type' => 'string',
    'group' => 'Instruments',
    'token' => FALSE,
  );

  $variables['instruments_rollovers_last_request_date'] = array(
    'title' => t(
      'Date when was requested rollovers data at last time (Automatic updates by system after each data update)'
    ),
    'default' => 0,
    'type' => 'number',
    'group' => 'Instruments',
    'token' => FALSE,
  );

  return $variables;
}

/**
 * Method return formatted spread per unit
 * according MK-615
 *
 * @param $spread_per_unit
 * @param $symbol
 *
 * @return string
 */
function instruments_get_spread_per_unit_formatted($spread_per_unit, $symbol) {
  $symbols = array();

  $ready_spread_for_country = false;
  $ready_spread_for_default = false;

  if (!empty($symbol)) {
    $symbols = explode('/', $symbol);
  }

  foreach ($symbols as $symbol_country) {
    if (function_exists('instruments_get_formatted_spread_for_' . trim($symbol_country))) {
      $func_name = 'instruments_get_formatted_spread_for_' . trim($symbol_country);
      $ready_spread_for_country = $func_name($spread_per_unit);
    }
    if ( false === $ready_spread_for_country && false === $ready_spread_for_default ) {
      $ready_spread_for_default = instruments_get_formatted_spread_for_default($spread_per_unit);
    }
  }

  $result_spread = ( false !== $ready_spread_for_country) ? $ready_spread_for_country : $ready_spread_for_default;

  return (string)$result_spread;
}

function instruments_get_formatted_spread_categories_groups() {
  return array(
      'currency.major',
      'currency.minor',
      'currency.exotic',
  );
}

/**
 * Function get formatted spread for JPY country
 *
 * @param $spread_per_unit
 *
 * @return int
 */
function instruments_get_formatted_spread_for_JPY($spread_per_unit) {

  return $spread_per_unit;
  
  if (10 > $spread_per_unit) {
    $spread_per_unit *= 10;
  } elseif (10 <= $spread_per_unit && 1000 >= $spread_per_unit) {
    $spread_per_unit /= 10;
  } elseif (1000 < $spread_per_unit) {
    $spread_per_unit /= 100;
  }

  return $spread_per_unit;
}

/**
 * Function get formatted spread for default
 *
 * @param $spread_per_unit
 *
 * @return int
 */
function instruments_get_formatted_spread_for_default($spread_per_unit) {
	
  return $spread_per_unit;
	
  if ( 100 > $spread_per_unit ) {
    $spread_per_unit *= 10;
  } elseif (100 <= $spread_per_unit && 1000 >= $spread_per_unit) {
    $spread_per_unit /= 10;
  } elseif (1000 < $spread_per_unit) {
    $spread_per_unit /= 100;
  }
  return $spread_per_unit;
}










