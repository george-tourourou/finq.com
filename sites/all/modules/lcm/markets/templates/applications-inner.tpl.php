<?php
global $language;
$android_link = variable_get_value(
  'dc_live_platform_link_client_mobile_android'
);
$apple_link = variable_get_value('dc_live_platform_link_client_mobile_ios');
//$webtrader_link = dc_insert('dc_login_to_live_platform');
$webtrader_link = variable_get_value(
  'dc_webtrader_link'
);

$webtrader_link .= (parse_url($webtrader_link, PHP_URL_QUERY) ? '&' : '?') . 'lang=' . $language->language;
?>

<div class="applications-inner">

  <a id="iphone-app-box" class="apps add-tracking-parameters apple" href="<?= $apple_link ?>">
    <span class="caption">
      <?= tt('translate_front_iphone_apps') ?>
    </span>
    <span class="icon"></span>
  </a>

  <a id="android-app-box" class="apps add-tracking-parameters android" href="<?= $android_link ?>">
    <span class="caption">
      <?= tt('translate_front_android_apps') ?>
    </span>
    <span class="icon"></span>
  </a>

  <a id="webtrader-browsers" class="apps add-tracking-parameters webtrader"
     href="<?= $webtrader_link ?>">
    <span class="caption">Web Trader</span>
    <span class="icon"></span>
  </a>

</div>
