<?php

/**
 * User interface for string editing (just a copy of function
 * i18n_string_locale_translate_edit_form but with english language)
 */
function custom_localization_locale_translate_edit_form($form, &$form_state, $lid) {
    include_once(drupal_get_path('module', 'i18n_string').'/i18n_string.pages.inc');


    // Fetch source string, if possible.
    $source = db_query('SELECT source, context, textgroup, location FROM {locales_source} WHERE lid = :lid', array(':lid' => $lid))->fetchObject();
    if (!$source) {
        drupal_set_message(t('String not found.'), 'error');
        drupal_goto('admin/config/regional/translate/translate');
    }

    // Add original text to the top and some values for form altering.
    $form['original'] = array(
      '#type'  => 'item',
      '#title' => t('Original text'),
      '#markup' => check_plain(wordwrap($source->source, 0)),
    );
    if (!empty($source->context)) {
        $form['context'] = array(
          '#type' => 'item',
          '#title' => t('Context'),
          '#markup' => check_plain($source->context),
        );
    }
    $form['lid'] = array(
      '#type'  => 'value',
      '#value' => $lid
    );
    $form['textgroup'] = array(
      '#type'  => 'value',
      '#value' => $source->textgroup,
    );
    $form['location'] = array(
      '#type'  => 'value',
      '#value' => $source->location
    );

    // Include default form controls with empty values for all languages.
    // This ensures that the languages are always in the same order in forms.
    $languages = language_list();

    $form['translations'] = array('#tree' => TRUE);
    // Approximate the number of rows to use in the default textarea.
    $rows = min(ceil(str_word_count($source->source) / 12), 10);
    foreach ($languages as $langcode => $language) {
        $form['translations'][$langcode] = array(
          '#type' => 'textarea',
          '#title' => t($language->name),
          '#rows' => $rows,
          '#default_value' => '',
        );
    }

    // Fetch translations and fill in default values in the form.
    $result = db_query("SELECT DISTINCT translation, language FROM {locales_target} WHERE lid = :lid", array(':lid' => $lid));
    foreach ($result as $translation) {
        $form['translations'][$translation->language]['#default_value'] = $translation->translation;
    }

    $form['actions'] = array('#type' => 'actions');
    $form['actions']['submit'] = array('#type' => 'submit', '#value' => t('Save translations'));

    $form['#validate'][] = 'i18n_string_locale_translate_edit_form_validate';
    $form['#submit'][] = 'i18n_string_locale_translate_edit_form_submit';


    // Restrict filter permissions and handle validation and submission for i18n strings.
    if (i18n_string_group_info($source->textgroup)) {
        if ($i18nstring = i18n_string_get_by_lid($form['lid']['#value'])) {
            $form['i18n_string'] = array('#type' => 'value', '#value' => $i18nstring);
            if ($message = $i18nstring->check_translate_access()) {
                drupal_set_message($message);
                $disabled = TRUE;
            }
            // Add format help anyway, though the form may be disabled.
            $form['translations']['format_help']['#markup'] = _i18n_string_translate_format_help($i18nstring->format);
        }
        else {
            drupal_set_message(t('Source string not found.'), 'warning');
            $disabled = TRUE;
        }
        if (!empty($disabled)) {
            // Disable all form elements
            $form['submit']['#disabled'] = TRUE;
            foreach (element_children($form['translations']) as $langcode) {
                $form['translations'][$langcode]['#disabled'] = TRUE;
            }
        }
    }
    return $form;
}


/**
 * User interface for the translation import screen (just a copy of function
 * locate_translate_import_form but with english language in dropdown)
 */
function custom_localization_translate_import_form($form) {
    include_once(drupal_get_path('module', 'locale').'/locale.admin.inc');

    // Get all languages, except English
    drupal_static_reset('language_list');
    $names = locale_language_list('name');

    if (!count($names)) {
        $languages = _locale_prepare_predefined_list();
        $default = key($languages);
    }
    else {
        $languages = array(
          t('Already added languages') => $names,
          t('Languages not yet added') => _locale_prepare_predefined_list()
        );
        $default = key($names);
    }

    $form['import'] = array('#type' => 'fieldset',
      '#title' => t('Import translation'),
    );
    $form['import']['file'] = array('#type' => 'file',
      '#title' => t('Language file'),
      '#size' => 50,
      '#description' => t('A Gettext Portable Object (<em>.po</em>) file.'),
    );
    $form['import']['langcode'] = array('#type' => 'select',
      '#title' => t('Import into'),
      '#options' => $languages,
      '#default_value' => $default,
      '#description' => t('Choose the language you want to add strings into. If you choose a language which is not yet set up, it will be added.'),
    );
    $form['import']['group'] = array('#type' => 'radios',
      '#title' => t('Text group'),
      '#default_value' => 'default',
      '#options' => module_invoke_all('locale', 'groups'),
      '#description' => t('Imported translations will be added to this text group.'),
    );
    $form['import']['mode'] = array('#type' => 'radios',
      '#title' => t('Mode'),
      '#default_value' => LOCALE_IMPORT_KEEP,
      '#options' => array(
        LOCALE_IMPORT_OVERWRITE => t('Strings in the uploaded file replace existing ones, new ones are added. The plural format is updated.'),
        LOCALE_IMPORT_KEEP => t('Existing strings and the plural format are kept, only new strings are added.')
      ),
    );
    $form['import']['submit'] = array('#type' => 'submit', '#value' => t('Import'));

    $form['#submit'][] = 'locale_translate_import_form_submit';

    return $form;
}

/**
 * User interface for the translation export screen (just a copy of function
 * locate_translate_export_screen but with english language)
 */
function custom_localization_translate_export_screen() {
    include_once(drupal_get_path('module', 'locale').'/locale.admin.inc');

    // Get all languages, except English
    drupal_static_reset('language_list');
    $names = locale_language_list('name');
    $output = '';
    // Offer translation export if any language is set up.
    if (count($names)) {
        $elements = drupal_get_form('locale_translate_export_po_form', $names);
        $output = drupal_render($elements);
    }
    $elements = drupal_get_form('locale_translate_export_pot_form');
    $output .= drupal_render($elements);
    return $output;
}