<?php

function _dc_get_list_of_replacements() {
  return array(
    'dc_bonus' => array(
      'name' => 'Bonus for user',
      'description' => 'Provide bonus value (for example: "25$")',
      'default' => '',
      'template' => '<span data-dynamic=\'dynamic\' data-function=\'[jsFunctionName]\'>[value]</span>',
    ),
    'dc_bonus_table' => array(
      'name' => 'Bonus table',
      'description' => 'Provide table of bonuses for current country',
      'default' => '',
      'template' => 'data-dynamic=\'dynamic\' data-function=\'[jsFunctionName]\'',
    ),
    'dc_login_to_live_platform' => array(
      'name' => 'Link to live platform',
      'description' => 'Provide dynamic link to live platform according to user device',
      'default' => '',
      'template' => 'href=\'[value]\' data-dynamic=\'dynamic\' data-function=\'[jsFunctionName]\'',
    ),
    'dc_login_to_demo_platform' => array(
      'name' => 'Link to demo platform',
      'description' => 'Provide dynamic link to demo platform according to user device',
      'default' => '',
      'template' => 'href=\'[value]\' data-dynamic=\'dynamic\' data-function=\'[jsFunctionName]\'',
    ),
    'dc_call_to_action' => array(
      'name' => 'Call to action text',
      'description' => 'Provide call to action text (for example: Download App)',
      'default' => '',
      'template' => '<span data-dynamic=\'dynamic\' data-function=\'[jsFunctionName]\'>[value]</span>',
    ),
    'dc_registration_to_live_platform' => array(
      'name' => 'Real Registration in platform',
      'description' => 'Real Registration in platform with specific rule in desktop',
      'default' => '',
      'template' => 'href=\'[value]\' data-dynamic=\'dynamic\' data-function=\'[jsFunctionName]\'',
    ),
    'dc_registration_to_demo_platform' => array(
        'name' => 'demo Registration in platform',
        'description' => 'Demo Registration in platform with specific rule in desktop',
        'default' => '',
        'template' => 'href=\'[value]\' data-dynamic=\'dynamic\' data-function=\'[jsFunctionName]\'',
    ),
  );
}