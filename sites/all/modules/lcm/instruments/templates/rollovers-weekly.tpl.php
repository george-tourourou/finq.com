<?php
    global $language;
?>
<div class="full cfds rollovers-weekly">
    <div class="theme-content">
		<div class='full breadcrumb-navigation'>
		<a href='/<?php echo $language->prefix; ?>'><?= tt('translate_kw_home') ?></a> <i class="fa fa-angle-right" aria-hidden="true"></i>  
			<a href='/<?php echo $language->prefix; ?>/assets'><?= tt('translate_kw_assets') ?></a> <i class="fa fa-angle-right" aria-hidden="true"></i>  <span><?= tt('translate_cfds_rollovers_weekly_title') ?></span> 
		</div>
        <h1>
            <?= tt('translate_cfds_rollovers_weekly_title') ?>
        </h1>
        <div class='full'>
			<div class="full ro-current-date">
				<?= $current_date ?>
			</div>
			<div class="full ro-text">
				<p>
					<?= tt('translate_cfds_rollovers_weekly_be_advised') ?>
				</p>
			</div>
			<div class='full'>
				<!-- <?= $expiration_list ?> -->
                <?php mt4_table(expiration,rollovers); ?>
			</div>		
			<div class='full notes'>
				<p><?= tt('translate_cfds_rollovers_weekly_note') ?></p>   
				<span><?= tt('translate_cfds_rollovers_weekly_written_by') ?></span>    
			</div>		

        </div>
        <div class='col-xs-12 col-sm-12 col-md-5 col-lg-5 rightAreaContainer'>
            <img alt="" class="img-responsive center-block" src="/sites/default/files/webtrader-cosmos.png">
            <div class="page-instruments" style="margin: 0 0 10px; float:left;">
                <?php include_once "instruments-banner.php"; ?>
            </div>
        </div>
    </div>
</div>