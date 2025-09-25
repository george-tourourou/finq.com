<?php
    global $language;

	$instrArray = explode('/', $_SERVER['REQUEST_URI']);
	$instrArray = explode('?', $instrArray[3]);
	$instrSymbol = strtolower($instrArray[0]);
	
	$isCrypto = false;
	$cryptos_list = 'bitcoin,ethereum,ethclassic,bitcoineur,dash,dasheur,ethereumeur,litecoin,litecoineur,ripple,bchusd';
	
	$country_code=getenv(GEOIP2_COUNTRY_CODE);
	$restriction_countries=array("LK");


	if (in_array($country_code, $restriction_countries))
	{
		if(strpos($cryptos_list, $instrSymbol) !== false){
			header("Location: https://www.finq.com/en/assets/");
			exit();
		}
		
	}
	/*
	$isCrypto = false;
	
	$cryptos_list = 'bitcoin,ethereum,ethclassic,bitcoineur,dash,dasheur,ethereumeur,litecoin,litecoineur,ripple,bchusd';
	
	if (strpos($cryptos_list, $instrSymbol) !== false) {
		$instrument_category = 'crypto';
		$instrument_symbol = trim($instrSymbol);
		$isCrypto = true;
		$dealing_data['description'] = ucwords($instrument_symbol);
				$dealing_data['expiresDaily'] = "no";
		$dealing_data['leverage'] = "1:2";
		switch ($instrument_symbol) {
			case "bchusd":
				$dealing_data['description'] = "Bitcoin Cash";
				break;
			case "bitcoineur":
				$dealing_data['description'] = "Bitcoin/EUR";
				break;
			case "dasheur":
				$dealing_data['description'] = "Dash/EUR";
				break;
			case "ethclassic":
				$dealing_data['description'] = "Ethereum Classic";
				break;
			case "ethereumeur":
				$dealing_data['description'] = "Ethereum/EUR";
				break;
			case "litecoineur":
				$dealing_data['description'] = "Litecoin/EUR";
				break;			
		}
		
		drupal_set_title($dealing_data['description']);
	}
	*/
	?>
<div class='cfd-instrument full'>
    <div class="theme-content">
		<div class='full breadcrumb-navigation'>
		<a href='/<?php echo $language->prefix; ?>'><?= tt('translate_kw_home') ?></a> <i class="fa fa-angle-right" aria-hidden="true"></i>  
			<a href='/<?php echo $language->prefix; ?>/assets'><?= tt('translate_kw_assets') ?></a>  <i class="fa fa-angle-right" aria-hidden="true"></i>  			
			
			<?php if(strpos($instrument_category, 'crypto') !== false) { ?>
				<a href='/<?php echo $language->prefix; ?>/assets/crypto'><?= tt('translate_kw_crypto') ?></a> 
			<?php } else if(strpos($instrument_category, 'shares') !== false) {?>			
				<a href='/<?php echo $language->prefix; ?>/assets/stocks'><?= tt('translate_kw_stocks') ?></a> 
			<?php } else if(strpos($instrument_category, 'index') !== false) {?>		
				<a href='/<?php echo $language->prefix; ?>/assets/indices'><?= tt('translate_kw_indices') ?></a> 
			<?php } else if(strpos($instrument_category, 'etfs') !== false) {?>		
				<a href='/<?php echo $language->prefix; ?>/assets/etfs'><?= tt('translate_kw_etfs') ?></a> 
			<?php } else if(strpos($instrument_category, 'commodity') !== false) {?>		
				<a href='/<?php echo $language->prefix; ?>/assets/commodities'><?= tt('translate_kw_commodities') ?></a> 
			<?php } else if(strpos($instrument_category, 'bonds') !== false) {?>		
				<a href='/<?php echo $language->prefix; ?>/assets/bonds'><?= tt('translate_kw_bonds') ?></a> 
			<?php } else if(strpos($instrument_category, 'currency') !== false) {?>		
				<a href='/<?php echo $language->prefix; ?>/assets/forex'><?= tt('translate_kw_forex') ?></a> 			
			<?php } ?>

			<i class="fa fa-angle-right" aria-hidden="true"></i>  			
			<span cat='<?php echo $instrument_category; ?>'><?= $dealing_data['description'] ?></span> 
		</div>
        <h1><?= tt($dealing_data['description']) ?></h1>
        <div class='full'>
            <div class="instruments-container full">
                <div class="instrument-info full">
                    <div class="progress"></div>
                    <div class="instrument-value col-mg-5_15 full-tablet">
                        <div class="full instrument-value-header">
                            <div class="full">
                                <div class="price" data-value="buy"></div>
                                <div class="percentage up" data-value="change"></div>
                            </div>
                            <div class="full instrument-name">
                                <p><?php echo drupal_set_title(); ?></p>
                            </div>
                            <div class="full instrument-high-low">
                                <span class="high"><?= tt('translate_kw_high', array()) ?>:</span> <span data-value="high"></span>
                                <span class="low"><?= tt('translate_kw_low') ?>:</span> <span data-value="low"></span>
                            </div>
                        </div>
                    </div>
                    <div class="instrument-content col-mg-10_15 full-tablet">
                        <div class="instrument-actions">
                            <div class="col-6_12 full-650 instrument-actions-buy">
                                <div class="sell full">
                                    <a class="show-popup-warning full" <?= dc_insert('dc_registration_to_live_platform'); ?>>
                                        <span class="title"><?= tt('translate_kw_sell')?>:</span>
                                        <span class="value" data-value="sell"></span>
									</a>
                                </div>							
                            </div>
                            <div class="col-6_12 full-650 instrument-actions-sell">
                                <div class="buy full">
                                    <a class="show-popup-warning full" <?= dc_insert('dc_registration_to_live_platform'); ?>>
                                        <span class="title"><?= tt('translate_kw_buy')?>:</span>                                        
                                        <span class="value" data-value="buy"></span>
									</a>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="instrument-content instrument-content-table  col-mg-10_15 full-tablet">
                        <div class="instrument-actions">
						
                            <div class="col-6_12 full-650 instrument-actions-buy">
                                <div class="full info-rows">
                                    <div class="full">
                                        <span class="info-row-label tp sub-title" data-toggle="tooltip" title="<?= tt('translate_cfds_instrument_spread_per_unit_description')?>"><?= tt('translate_kw_spread_per_unit') ?></span>
                                        <span class="info-row-value sub-value"><?= $dealing_data['spreadPerUnit'] ?> <?= $dealing_data['spreadPerUnitCurrency'] ?></span>
                                    </div>
                                    <div class="full">
                                        <span class="info-row-label tp sub-title" data-toggle="tooltip" title="<?= tt('translate_cfds_instrument_premium_buy_description')?>"><?= tt('translate_kw_premium_buy')?></span>
                                        <span class="info-row-value sub-value"><?= $dealing_data['overnightInterestBuy'] ?></span>
                                    </div>
                                    <div class="full">
                                        <span class="info-row-label tp sub-title" data-toggle="tooltip" title="<?= tt('translate_cfds_instrument_initial_margin_description') ?>"><?= tt('translate_kw_initial_margin') ?></span>
                                        <span class="info-row-value sub-value"><?= $dealing_data['initialMargin'] ?></span>
                                    </div>
                                    <div class="full">
                                        <span class="info-row-label tp sub-title" data-toggle="tooltip" title="<?= tt('translate_cfds_instrument_expires_daily_description')?>"><?= tt('translate_kw_expires_daily')?></span>
                                        <span class="info-row-value sub-value"><?= $dealing_data['expiresDaily'] ?></span>
                                    </div> 									
                                </div>
                            </div>
                            <div class="col-6_12 full-650 instrument-actions-sell">
                                <div class="full info-rows">
                                    <div class="full ">
                                        <span class="info-row-label tp sub-title" data-toggle="tooltip" title="<?= tt('translate_cfds_instrument_leverage_description') ?>"><?= tt('translate_kw_leverage')?></span>
                                        <span class="info-row-value sub-value"><?= $dealing_data['leverage'] ?></span>
                                    </div>
                                    <!--<div class="full info-row">
                                        <span class="info-row-label tp" data-toggle="tooltip"  title="<?= tt('translate_cfds_instrument_spread_description') ?>"><?= tt('translate_kw_spread')?> (%)</span>
                                        <span class="info-row-value"><?= $dealing_data['spreadPercent'] ?></span>
                                    </div>-->
                                    <div class="full">
                                        <span class="info-row-label tp sub-title" data-toggle="tooltip" title="<?= tt('translate_cfds_instrument_premium_sell_description') ?>"><?= tt('translate_kw_premium_sell') ?></span>
                                        <span class="info-row-value sub-value"><?= $dealing_data['overnightInterestSell'] ?></span>
                                    </div>
                                    <div class="full">
                                        <span class="info-row-label tp sub-title" data-toggle="tooltip" title="<?= tt('translate_cfds_instrument_maintenance_margin_description') ?>"><?= tt('translate_kw_maintenance_margin') ?></span>
                                        <span class="info-row-value sub-value"><?= $dealing_data['maintenanceMargin'] ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include_once "instruments-sentiment-module.php"; ?>
            </div>
            <div class="instruments-chart full">
                <ul class="controls">
                    <li>
                        <div class="chart_control"></div>
                    </li>
                    <li>
                        <div class="chart_type c"></div>
                    </li>
                </ul>
            </div>
            <div id='chartContainer' class='full'>
                <div id="container"></div>
            </div>
            <div class="instruments-table">
			<?= $instrument_table ?>
            </div>
        </div>
    </div>
</div>

<script>

$(document).ready(function () {
	$('[data-toggle="tooltip"]').tooltip(); 
	
    var url = $('.buy a').attr('href');
	
	url = url.replace('undefined', 'https://live-cosmos.finq.com/fxclient5/')
	
	$('.buy a').attr('href', url);
	$('.sell a').attr('href', url);
});



</script>