<div class="instruments-chart">
  <ul class="controls">
    <li>
      <select class="chart_instrument"></select>
    </li>
    <li>
      <div class="chart_control"></div>
    </li>
    <li>
      <div class="chart_type <?= $chart_type ?>"></div>
    </li>
    <li>
      <div class="trade-link">
        <span class="buy-link">
          <a <?= dc_insert('dc_registration_to_live_platform'); ?> target="_blank" ><?= tt(
              'Buy',
              array(),
              array('context' => 'instruments')
          ) ?>
          </a>
        </span>
        <span class="sell-link">
          <a <?= dc_insert('dc_registration_to_live_platform'); ?> target="_blank" ><?= tt(
              'Sell',
              array(),
              array('context' => 'instruments')
          ) ?>
          </a>
        </span>
      </div>
    </li>
  </ul>
</div>

<div id="container"></div>
<div class="widget-footer">
  <a href="<?php echo $lang_prefix ?>/instruments/<?php echo $instrument;?>" target="_blank" class="more-quotes">
    <span><?php echo tt("More Quotes by");?></span>
    <img src="/sites/default/files/New_Logo_white250w.png" />
  </a>
  <div class="instrument-risk-warning"><?php echo tt('CFD service | Carries risk of capital loss'); ?></div>

</div>