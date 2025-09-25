<?php
    global $language;
?>
<div class='full cfds rollovers-dates'>
    <div class="theme-content">
		<div class='full breadcrumb-navigation'>
		<a href='/<?php echo $language->prefix; ?>'><?= tt('translate_kw_home') ?></a> <i class="fa fa-angle-right" aria-hidden="true"></i>  
			<a href='/<?php echo $language->prefix; ?>/assets'><?= tt('translate_kw_assets') ?></a> <i class="fa fa-angle-right" aria-hidden="true"></i>  <span><?= tt('translate_cfds_rollovers_dates_title') ?></span> 
		</div>
		<div class='full'>
			<h1><?= tt('translate_cfds_rollovers_dates_title') ?></h1>
			
			<div class="ro-text full">
				<p><?= tt('translate_cfds_rollovers_dates_description') ?></p>
			</div>
			
			<div class='full notes'>
				<p class='full'><?= tt('translate_cfds_rollovers_dates_note_that') ?></p>
				<ul class='full'>
					<li><?= tt('translate_cfds_rollovers_dates_l1') ?></li>
					<li><?= tt('translate_cfds_rollovers_dates_l2') ?></li>
					<li><?= tt('translate_cfds_rollovers_dates_l3') ?></li>
				</ul>			
			</div>
			
			<div class="ro-subtitle full">
				<b class='pull-left'>
					<?= tt('translate_kw_expiration_dates')?>
				</b>
				<a class='pull-right' href="/<?php echo $language->prefix; ?>/cfds/rollovers-weekly">
					<?= tt('translate_kw_weekly_expiration_rollover')?>
				</a>
			</div>
			<div class="full ro-text">
				<p><?= tt('translate_cfds_rollovers_dates_p1')?></p>
			</div>
			
			<?php //echo $rollovers_table; ?>
            <table class="sticky-enabled tableheader-processed sticky-table">
                <thead>
                    <tr>
                        <th>
                            <p><?= tt('translate_kw_instrument') ?></p>
                        </th>
                        <th>
                            <p><?= tt('translate_kw_rollover_date') ?></p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php mt4_table(expiration,dates); ?>
                </tbody>
            </table>

			<div class="full">
				<p>
					<?= tt('translate_cfds_rollovers_dates_note_p1')?>
					<br /><br />
					<?= tt('translate_cfds_rollovers_dates_note_p2')?>
				</p>
			</div>
		</div>
    </div>
</div>