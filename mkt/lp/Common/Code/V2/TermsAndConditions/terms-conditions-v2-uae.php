<div class="col-12 terms-conditions">
    <div class="content">
        <?php $lang_code = GetCleanLanguageCode(); ?>
        <?php
        if($lang_code == "en" || $lang_code == "es")
        { ?>
            <p><?php echo GetTermsTranslation('terms_1_smaller_uae'); ?></p>
        <?php }
        else
        { ?>
            <p><?php echo GetTermsTranslation('terms_1_uae'); ?></p>
        <?php } ?>
        <p><?php echo GetTermsTranslation('terms_2_uae'); ?></p>
        <p><?php echo GetTermsTranslation('terms_3_uae'); ?></p>
        <p><?php echo GetTermsTranslation('terms_5_uae'); ?></p>
        <p><?php echo GetTermsTranslation('terms_4_uae'); ?></p>
		<p><?php echo GetTermsTranslation('terms_trademarks'); ?></p>
    </div>
</div>