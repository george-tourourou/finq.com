<?php

function _rollovers_list_page() {
  module_load_include('inc', 'instruments', 'instruments_api');

  $file_path = drupal_get_path('module', 'instruments') . '/';
  drupal_add_css(path_to_theme() . '/css/rollovers.css');

  $table_header = array(
    tt(
      'translate_kw_instrument'
    ),
    tt(
      'translate_kw_rollover_date'
    ),
  );

    $list = _instruments_get_rollovers('month');

    $length = count($list);

    for ($i = 0; $i < $length; $i++) {
        for ($j = 0; $j < $length; $j++) {
            if($j == $i) {
                continue;
            }

            if(getTimestamp($list[$i]) < getTimestamp($list[$j])) {
                $a = $list[$j];
                $b = $list[$i];

                $list[$i] = $a;
                $list[$j] = $b;
            }
        }
    }

  $rollovers_table = theme_table(
    array(
      'header' => $table_header,
      'rows' => $list,
      'attributes' => array(),
      'sticky' => TRUE,
      'colgroups' => array(),
      'empty' => '',
      'caption' => FALSE,
    )
  );
  
  drupal_set_title("CFD Expiration Dates at Finq.com - Online Trading Schedule");
  
  return theme_render_template(
    $file_path . 'templates/rollovers-dates.tpl.php',
    array(
      'block_risk_warning' => _get_risk_warning_block(),
      'rollovers_table' => $rollovers_table,
    )
  );

}

function getTimestamp($rollover) {
    $day = substr($rollover['rolloverDate'], 0, 2);
    $month = substr($rollover['rolloverDate'], 3, 2);
    $year = substr($rollover['rolloverDate'], 6, 4);

    return strtotime($year.'-'.$month.'-'.$day);
}


function _rollovers_weekly_page() {
  module_load_include('inc', 'instruments', 'instruments_api');

  $file_path = drupal_get_path('module', 'instruments') . '/';
  drupal_add_css(path_to_theme() . '/css/rollovers.css');

  $rollovers = _instruments_get_rollovers('week');

  //$expiration_list = "<ol>";
  //foreach ($rollovers as $group) {
    //$expiration_list .= "<li><strong>{$group['instruments']}</strong> will be rolled over from the {$group['contractStart']} to the {$group['contractEnd']} contract on the <strong>{$group['rolloverDate']}</strong></li>";
  //}
  //$expiration_list .= "</ol>";
  $expiration_list .= "<ol>
<li><strong>NaturalGas, HeatingOil </strong>will be rolled over from the <strong>January 2022</strong> contract to the <strong>February 2022 </strong>contract on the <strong>24<sup>th</sup> of December 2021</strong>;</li>
<li><strong>HongKong45 </strong>will be rolled over from the <strong>December 2021</strong> contract to the <strong>January 2022 </strong>contract on the <strong>24<sup>th</sup> of December 2021</strong>;</li>
<li><strong>Soybeans, Rice </strong>will be rolled over from the <strong>January 2022</strong> contract to the <strong>March 2022 </strong>contract on the <strong>24<sup>th</sup> of December 2021</strong>;</li>
<li><strong>BrentOil </strong>will be rolled over from the <strong>February 2022</strong> contract to the <strong>March 2022 </strong>contract on the <strong>24<sup>th</sup> of December 2021</strong>;</li>
</ol>";


  $dates = _instruments_calculate_rollovers_period('week');
  $current_date = _instruments_update_date_format($dates[0], 'j F, Y');
  $rollover = array_shift($rollovers);
  $rollover_date = $rollover['rolloverDate'];

	drupal_set_title("Weekly CFD Expiration Dates at Finq.com - Online trading Schedule");
  
  return theme_render_template(
    $file_path . 'templates/rollovers-weekly.tpl.php',
    array(
      'current_date' => $current_date,
      'expiration_list' => $expiration_list,
      'rollover_date' => $rollover_date,
      'block_risk_warning' => _get_risk_warning_block(),
    )
  );
}