<div class="row-fluid" id="top_lvl_page">
    <div style="background: url(/sites/all/themes/zenon/assets/images/top_lev_bg.png) center top no-repeat;">
        <?php $file = file_load($node->field_top_level_image['und'][0]['fid']); ?>

        <div class="row-fluid">
            <header class="key_margin_bottom_30 key_centered col-md-6 col-sm-6 col-lg-6 col-xs-6 col-sm-offset-3 col-lg-offset-3 col-xs-offset-3 col-md-offset-3 ">
                <h2 class="key_title_h2 key_centered">
                    <?php print render($content['field_top_level_title']); ?>
                </h2>
            </header>
        </div>
        <div class="key_top_lvl_img wrapper clearfix">
            <img class="center-block" src="<?php print file_create_url($file->uri); ?>"/>
        </div>
        <div class="row container key_top_lvl_content">
            <?php print render($content['body']); ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery('#maincontainer').removeClass('container').css('padding-top', '0');
    jQuery('.region-content').removeClass('col-xs-12 col-sm-12 col-md-12 col-lg-12');
    jQuery('#block-system-main').removeClass('col-xs-12 col-sm-12 col-md-12 col-lg-12');
</script>