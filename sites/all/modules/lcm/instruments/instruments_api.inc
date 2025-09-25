<?php

/**
 * File which contains functions which interact with external APIs & processes received data
 */

/**
 * Dealing data
 */

/**
 * Read dealing data from API and save it to local DB
 */
function _instruments_get_dealing_data_from_api() {
  global $environment_config;
  $ctx = stream_context_create(
    array(
      'http' => array(
        'timeout' => 10,
      ),
    )
  );

  $path = (isset($environment_config['instruments_dealing_data_path'])) ?
    $environment_config['instruments_dealing_data_path'] :
    variable_get_value('instruments_dealing_data_path');
  $response = file_get_contents($path, 0, $ctx);

  if ($response === FALSE) {
    watchdog(
      'instruments',
      'Reading instruments data from API has failed',
      array(),
      WATCHDOG_CRITICAL
    );

    return FALSE;
  }

  $instruments_data = drupal_json_decode($response);

  if ($instruments_data === NULL) {
    watchdog(
      'instruments',
      "Instruments data API service returned not valid JSON ({$response})",
      array(),
      WATCHDOG_CRITICAL
    );

    return FALSE;
  }

  watchdog(
    'instruments',
    'Data from instruments data API service got successfully',
    array(),
    WATCHDOG_INFO
  );

  $transaction = db_transaction();

  try {
    $list_of_old_ids = db_select('instruments', 'i')
      ->fields('i', array('iid'))
      ->execute()
      ->fetchCol();
    $list_of_old_ids = array_flip($list_of_old_ids);
    $list_of_new_ids = array();

    db_truncate('instruments')->execute();

    $query = db_insert('instruments')->fields(
      array('iid', 'symbol', 'category', 'changed', 'data')
    );

    $wrong_format_instruments = array();
    $instruments_language_data = array();
    $skipped_categories = instruments_get_black_list_groups();
    $merge_groups_mapping = instruments_get_mapping_for_merge_groups();
    $formatted_spread_categories = instruments_get_formatted_spread_categories_groups();
    $languages = language_list('enabled');
    $languages = $languages[1];

    foreach ($instruments_data as $instrument_id => $instrument_data) {

      $instrument_data['category'] = array_diff(
        $instrument_data['category'],
        $skipped_categories
      );

      foreach ($merge_groups_mapping as $source_group => $target_group) {
        $source_index = array_search(
          $source_group,
          $instrument_data['category']
        );
        if ($source_index !== FALSE) {
          $target_index = array_search(
            $target_group,
            $instrument_data['category']
          );
          if ($target_index !== FALSE) {
            unset($instrument_data['category'][$source_index]);
          }
          else {
            $instrument_data['category'][$source_index] = $target_group;
          }
        }
      }

      if (!$instrument_data['category']) {
        $wrong_format_instruments[] = $instrument_id;
        continue;
      }

      foreach ($languages as $language) {
        $instrument_symbol = tt(
          $instrument_data['symbol'],
          array(),
          array(
            'langcode' => $language->language,
            'context' => 'instrument symbol',
          )
        );

        $instrument_display_name = tt(
          $instrument_data['displayName'],
          array(),
          array(
            'langcode' => $language->language,
            'context' => 'instrument display name',
          )
        );

        $instrument_description = tt(
          $instrument_data['description'],
          array(),
          array(
            'langcode' => $language->language,
            'context' => 'instrument description',
          )
        );

        $instrument_data['tradingHours'] = str_replace(
          array("_db", "_da"),
          array("", ""),
          $instrument_data['tradingHours']
        );
		
		if($instrument_data['tradingHours'] == "-")
		{
			$instrument_data['tradingHours'] = implode(', ', $instrument_data['fullTradingHours']);
		}

        // skip duplicate entries for other languages if they don`t have translation
        if (
          $language->language === 'en' ||
          ($language->language !== 'en') && $instrument_symbol !== $instrument_data['symbol'] ||
          ($language->language !== 'en') && $instrument_display_name !== $instrument_data['displayName'] ||
          ($language->language !== 'en') && $instrument_description !== $instrument_data['description']
        ) {
          $instruments_language_data[$language->language][] = array(
            'value' => $instrument_id,
            'label' => (($instrument_data['ticker']) ? "$instrument_display_name ({$instrument_data['ticker']})" : $instrument_display_name),
            'search' =>
              (($instrument_symbol === $instrument_display_name) ? "{$instrument_symbol} {$instrument_display_name}" : $instrument_symbol) .
              "{$instrument_description}" .
              (($instrument_data['ticker']) ? " " . $instrument_data['ticker'] : ""),
          );
        }
      }

      foreach ($instrument_data['category'] as $category) {
        if (in_array($category, $formatted_spread_categories)) {
          $instrument_data['spreadPerUnit'] = instruments_get_spread_per_unit_formatted(
            $instrument_data['spreadPerUnit'],
            $instrument_data['symbol']
          );
        }
      }

      if(isset($list_of_old_ids[$instrument_id])){
        unset($list_of_old_ids[$instrument_id]);
      }
      else{
        $list_of_new_ids[] = $instrument_id;
      }

      $query->values(
        array(
          'iid' => $instrument_id,
          'symbol' => $instrument_data['symbol'],
          'category' => implode(',', $instrument_data['category']),
          'changed' => REQUEST_TIME,
          'data' => serialize($instrument_data),
        )
      );
    }

    /*
     * Save result array into cache as JSON
    */
    foreach ($instruments_language_data as $language_id => $instruments_translated_data) {
      asort($instruments_translated_data);
      $json_data = drupal_json_encode($instruments_translated_data);
      cache_set('instruments_search_data_' . $language_id, $json_data, 'cache');
    }


    $wrong_format_instruments_count = count($wrong_format_instruments);
    if ($wrong_format_instruments_count) {
      watchdog(
        'instruments',
        "Got {$wrong_format_instruments_count} instruments without category - they will not be used ("
        . implode(', ', $wrong_format_instruments)
        . ")",
        array(),
        WATCHDOG_WARNING
      );
    }

    $query->execute();

  } catch (Exception $e) {
    $transaction->rollback();
    watchdog(
      'instruments',
      'Error during writing instruments data to DB',
      array(),
      WATCHDOG_CRITICAL
    );
    watchdog_exception('instruments', $e);
    return FALSE;
  }

  _instruments_clear_related_cache('instruments');
  _instruments_update_sitemapxml();

  return TRUE;
}

/**
 * Provide dealing data (from local DB via local cache)
 * @param bool $force_cache_update - if true, then we will get data from DB in any case and refill cache
 * @return array - array with dealing data grouped by categories
 */
function _instruments_get_dealing_data($force_cache_update = FALSE) {
  if (($cache = cache_get(
      'instruments_dealing_data'
    )) && !$force_cache_update
  ) {
    $cached_data = $cache->data;
  }
  else {
    $result = db_select('instruments', 'i')
      ->fields('i', array('iid', 'symbol', 'category', 'data'))
      ->orderBy('iid')
      ->execute();
    $cached_data = array();
    $hidden_categories = instruments_get_hidden_list_groups();
    $white_list_categories = instruments_get_white_list_groups();

    foreach ($result as $record) {
      $categories_array = explode(',', $record->category);
      foreach ($categories_array as $category) {
		  
        $category_hierarchy = explode('.', $category);

        //continue processing of all items with white listed categories
        if (
          array_search($category, $white_list_categories) === FALSE &&
          array_search(
            $category_hierarchy[0] . ".*",
            $white_list_categories
          ) === FALSE
        ) {
          continue;
        }

        //but can hide something from white listed (for children for ex.)
        if (
          array_search($category, $hidden_categories) !== FALSE ||
          array_search($category . ".*", $hidden_categories) !== FALSE
        ) {
          continue;
        }

        _insert_instrument_into_category_hierarchy(
          $category_hierarchy,
          $record->iid,
          _instruments_map_data_to_cache($record),
          $cached_data
        );
      }
    
	
	}

    _sort_categories($cached_data);
    cache_set('instruments_dealing_data', $cached_data, 'cache');
  }

  return $cached_data;
}

/**
 * Translate DB data format to cache format (make some changes in format & get only used data)
 * @param $db_record_object - record from DB
 * @return array
 */
function _instruments_map_data_to_cache($db_record_object) {
  $instrument_data = unserialize($db_record_object->data);
  return array(
    $db_record_object->iid,
    $instrument_data['symbol'],
    ($instrument_data['spreadPerUnit'] ? $instrument_data['spreadPerUnit'] : '-') . " ({$instrument_data['spreadPerUnitCurrency']})",
    $instrument_data['leverage'],
    $instrument_data['tradingHours'],
  );
}

/**
 * Recursive function which put information about instrument into storage array
 * according to hierarchy of categories of this instrument.
 *
 * @param array $hierarchy - array of hierarchy of instrument's categories
 * @param $instrument_id - ID of instrument which we want to add to $storage
 * @param $data - data which we want to place to $storage
 * @param array $storage - storage object
 * @param bool $is_first_level - flag of first iteration
 */
function _insert_instrument_into_category_hierarchy(
  array $hierarchy,
  $instrument_id,
  $data,
  array &$storage,
  $is_first_level = TRUE
) {
  if (!is_array($hierarchy) || !is_array($storage)) {
    return;
  }
  if (!count($hierarchy)) {
    if (!array_key_exists('instruments', $storage)) {
      $storage['instruments'] = array();
    }
    $storage['instruments'][$instrument_id] = $data;
  }
  else {
    $current_category_level = array_shift($hierarchy);
    if ($is_first_level) {
      $where_to_add = &$storage;
    }
    else {
      $where_to_add = &$storage['subcategories'];
    }


    if (!array_key_exists($current_category_level, $where_to_add)) {
      $where_to_add[$current_category_level] = array(
        'name' => $current_category_level,
        'subcategories' => array(),
      );
    }

    _insert_instrument_into_category_hierarchy(
      $hierarchy,
      $instrument_id,
      $data,
      $where_to_add[$current_category_level],
      FALSE
    );
  }
}

/**
 * Sorts cache storage according specific order of categories in it
 * @param array $storage
 */
function _sort_categories(array &$storage) {
  global $instruments_categories_order;

  $instruments_categories_order = instruments_get_categories_order();

  $instruments_categories_order = array_flip($instruments_categories_order);

  _sort_category_hierarchy($storage);
}

/**
 * Help function for sorting categories according specific order of them
 * @param $a
 * @param $b
 * @return int
 */
function _sort_category_comparison($a, $b) {
  global $instruments_categories_order;

  if (($instruments_categories_order[$a['name']] == $instruments_categories_order[$b['name']])) {
    return 0;
  }
  return ($instruments_categories_order[$a['name']] < $instruments_categories_order[$b['name']]) ? -1 : 1;
}

/**
 * Recursive function for sorting tree-structure by keys (categories names)
 * according to specific order of them
 * @param array $storage - data which should be sorted
 */
function _sort_category_hierarchy(array &$storage) {
  global $instruments_categories_order;

  foreach ($storage as $storage_key => $storage_value) {
    if (!array_key_exists($storage_key, $instruments_categories_order)) {
      $instruments_categories_order[$storage_key] = count(
        $instruments_categories_order
      );
    }
  }

  uasort($storage, '_sort_category_comparison');

  foreach ($storage as $key => $value) {
    if (is_array($storage[$key]['subcategories']) && count(
        $storage[$key]['subcategories']
      )
    ) {
      _sort_category_hierarchy($storage[$key]['subcategories']);
    }
  }
}

/**
 * End of Dealing Data
 */


/**
 * Rollovers
 */

/**
 * Read monthly & weekly rollovers data from API and save it to local cache
 * @return bool - false there was some errors during getting data, true otherwise
 */
function _instruments_get_all_rollovers_from_api() {

  $error_flag = FALSE;
  foreach (array('week', 'month') as $period) {
    $data = _instruments_get_rollovers_for_period_from_api($period);
    $cacheExpired = new DateTime('+2 day', new DateTimeZone('UTC'));
    if ($data !== FALSE) {
      cache_set(
        _instruments_prepare_rollovers_cache_key($period),
        $data,
        'cache',
        $cacheExpired->getTimestamp()
      );
    }
    else {
      $error_flag = TRUE;
    }
  }

  if (!$error_flag) {
    watchdog(
      'instruments',
      'Data from instruments rollovers data API service got successfully',
      array(),
      WATCHDOG_INFO
    );
  }

  _instruments_clear_related_cache('rollovers');

  return !$error_flag;
}

/**
 * Read rollovers data for specific period from API and save it to local cache
 * @param string $period - required period (week|month)
 * @return bool|mixed - rollovers data for period or false if there was some errors during getting data
 */
function _instruments_get_rollovers_for_period_from_api($period = 'week') {
  $ctx = stream_context_create(
    array(
      'http' => array(
        'timeout' => 10,
      ),
    )
  );

  $path = variable_get_value('instruments_rollovers_data_path');
  $dates = _instruments_calculate_rollovers_period($period);
  $path = str_replace(array('{from}', '{to}'), $dates, $path);
  $response = file_get_contents($path, 0, $ctx);

  if ($response === FALSE) {
    watchdog(
      'instruments',
      'Reading instruments rollovers data from API has failed',
      array(),
      WATCHDOG_CRITICAL
    );

    _instruments_prepare_rollovers_stub_if_required($period);

    return FALSE;
  }

  $rollovers_data = drupal_json_decode($response);

  if ($rollovers_data === NULL) {
    watchdog(
      'instruments',
      "Instruments rollovers data API service returned not valid JSON ({$response})",
      array(),
      WATCHDOG_CRITICAL
    );

    _instruments_prepare_rollovers_stub_if_required($period);

    return FALSE;
  }

  $rollovers_data = _instruments_prepare_rollovers_cache_data(
    $rollovers_data,
    $period
  );

  watchdog(
    'instruments',
    'Data from instruments rollovers data API service got successfully',
    array(),
    WATCHDOG_INFO
  );

  return $rollovers_data;
}

/**
 * Provide rollovers data (from local cache or via API if cache is empty)
 * @param string $period - period of time for getting data (week|month)
 * @param bool $force_cache_update - if true, then we will get data from API in any case and refill cache
 * @return array - array with rollovers data
 */
function _instruments_get_rollovers(
  $period = 'week',
  $force_cache_update = FALSE
) {
  if (($cache = cache_get(
      _instruments_prepare_rollovers_cache_key($period)
    )) && !$force_cache_update
  ) {
    return $cache->data;
  }

  _instruments_get_all_rollovers_from_api();

  $cache = cache_get(_instruments_prepare_rollovers_cache_key($period));
  return $cache->data;
}


/**
 * Check cache data and if cache is empty write empty array to it
 * @param string $period - period of time for getting data (week|month)
 * (Prevent not controlling requests to API)
 */
function _instruments_prepare_rollovers_stub_if_required($period = 'week') {
  if (!($cache = cache_get(
    _instruments_prepare_rollovers_cache_key($period)
  ))
  ) {
    $cacheExpired = new DateTime('+1 hour', new DateTimeZone('UTC'));
    cache_set(
      _instruments_prepare_rollovers_cache_key($period),
      array(),
      'cache',
      $cacheExpired->getTimestamp()
    );
    ///TODO should be sent email to responsible people
  }
}

/**
 * Return array with 'from' and 'to' dates for specific period
 * @param string $period - period of time for getting data (week|month)
 * @return array - 'from' and to 'dates'
 */
function _instruments_calculate_rollovers_period($period = 'week') {
  $start_date = new DateTime('now', new DateTimeZone('UTC'));

  $start = '';
  $end = '';

  if ($period == 'week') {
    $day_of_week = (int) $start_date->format('w');
    //sunday move to the end of the week =)
    if ($day_of_week === 0) {
      $day_of_week = 7;
    }
    $day_of_week--;
    if ($day_of_week !== 0) {
      $start_date->modify("-{$day_of_week} day");
    }
    $start = $start_date->format('Y-m-d');
    $end_date = $start_date->modify('+6 day');
    $end = $end_date->format('Y-m-d');
  }

  if ($period == 'month') {
    $start = $start_date->format('Y-m-01');
    $end = $start_date->format('Y-m-t');
  }

  return array($start, $end);
}

/**
 * Calculate cache key according of required period of data and current date
 * @param string $period
 * @return string - cache key
 */
function _instruments_prepare_rollovers_cache_key($period = 'week') {
  $current_date = new DateTime('now', new DateTimeZone('UTC'));
  return "instruments_rollovers_data_{$period}_{$current_date->format('Y_m_d')}";
}

/**
 * Change format of data from API to some specific format according to required period
 * @param array $data - data from API
 * @param string $period - (week|month)
 * @return array - modified data from API
 */
function _instruments_prepare_rollovers_cache_data($data, $period) {
  if ($period == 'month') {
    array_walk(
      $data,
      function (&$value, $key) {
        $value = array(
          'instrument' => $value['instrument'],
          'rolloverDate' => _instruments_update_date_format(
            $value['rolloverDate']
          ),
        );
      }
    );
  }

  if ($period == 'week') {
    $result = array();
    foreach ($data as $value) {
      $key = $value['rolloverDate'] . "_" . substr(
          $value['contractStart'],
          0,
          7
        ) . "_" . substr($value['contractEnd'], 0, 7);
      if (!isset($result[$key])) {
        $result[$key] = array(
          'rolloverDate' => _instruments_update_date_format(
            $value['rolloverDate'],
            'j/m/Y'
          ),
          'contractStart' => _instruments_update_date_format(
            $value['contractStart'],
            'F Y'
          ),
          'contractEnd' => _instruments_update_date_format(
            $value['contractEnd'],
            'F Y'
          ),
          'instruments' => array(),
        );
      }
      $result[$key]['instruments'][] = $value['instrument'];
    }

    foreach ($result as $key => $group) {
      $last = array_pop($result[$key]['instruments']);
      $last_delimiter = '';
      if (count($result[$key]['instruments'])) {
        $last_delimiter = ' and ';
      }
      $result[$key]['instruments'] = implode(
        ', ',
        $result[$key]['instruments']
      );
      $result[$key]['instruments'] .= $last_delimiter . $last;
    }
    $data = $result;
  }
  return $data;
}

/**
 * Convert data from 'Y-m-d' format to some other specified format
 * @param string $value - date value
 * @param string $format (required format of date)
 * @return string - date in new format
 */
function _instruments_update_date_format($value, $format = 'd/m/Y') {
  if (!$value) {
    return '';
  }
  $result = format_date(
    DateTime::createFromFormat(
      'Y-m-d',
      $value,
      new DateTimeZone('UTC')
    )->getTimestamp(),
    'custom',
    $format,
    'UTC'
  );
  if ($result !== FALSE) {
    return $result;
  }
  return '';
}

/**
 * Clear specific data in cache_path table
 * @param $type - type of records in cache for clean
 */
function _instruments_clear_related_cache($type) {
  $types = array(
    'instruments' => array('cfds', 'instruments\/%'),
    'rollovers' => array('cfds/rollovers-dates', 'cfds/rollovers-weekly'),
  );
  if (array_key_exists($type, $types)) {
    $sql = 'DELETE FROM {cache_path} WHERE ';
    $conditions = array();
    $params = array();
    foreach ($types[$type] as $key => $path) {
      $conditions[] = "cid LIKE :p{$key}";
      $params["p{$key}"] = $path;
    }
    $sql .= implode(' OR ', $conditions);
    db_query($sql, $params);
  }
}
