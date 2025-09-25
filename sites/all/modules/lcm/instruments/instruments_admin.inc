<?php

/**
 * File with function which used in admin area
 */

/**
 * Provide confirmation form for re-read dealing data from service by force
 * @param $form
 * @param $form_state
 * @return mixed
 */
function instruments_force_refresh_confirmation_form($form, &$form_state) {
  $form = confirm_form(
    $form,
    'Are you sure to update Dealing Data from service by force right now?',
    'admin/config/tradefxl/instruments',
    'The action cannot be undone.',
    'Update data & clear all caches',
    'Cancel'
  );

  return $form;
}

/**
 * Implementation of submit action of instruments_force_refresh_confirmation_form form
 * @param $form
 * @param $form_state
 */
function instruments_force_refresh_confirmation_form_submit(
  $form,
  &$form_state
) {
  module_load_include('inc', 'instruments', 'instruments_api');

  if (_instruments_get_dealing_data_from_api()) {
    // warm the cache if successfully read data
    _instruments_get_dealing_data(TRUE);
    drupal_set_message('Dealing data was updated');
  }
  else {
    drupal_set_message(
      'Error has occurred during dealing data reading',
      'error'
    );
  }
}


/**
 * Provide confirmation form for re-read rollovers data from service by force
 * @param $form
 * @param $form_state
 * @return mixed
 */
function instruments_rollovers_force_refresh_confirmation_form(
  $form,
  &$form_state
) {
  $form = confirm_form(
    $form,
    'Are you sure to update Rollovers Data from service by force right now?',
    'admin/config/tradefxl/instruments',
    'The action cannot be undone.',
    'Update data & clear all caches',
    'Cancel'
  );

  return $form;
}

/**
 * Implementation of submit action of instruments_rollovers_force_refresh_confirmation_form form
 * @param $form
 * @param $form_state
 */
function instruments_rollovers_force_refresh_confirmation_form_submit(
  $form,
  &$form_state
) {
  module_load_include('inc', 'instruments', 'instruments_api');

  if (_instruments_get_all_rollovers_from_api() !== FALSE) {
    drupal_set_message('Rollovers data was updated');
  }
  else {
    drupal_set_message(
      'Error has occurred during rollovers data reading',
      'error'
    );
  }
}
