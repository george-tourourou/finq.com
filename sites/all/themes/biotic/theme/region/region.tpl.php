<?php
/**
 * @file
 * Returns HTML for a region.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728112
 */
?>


<?php 
    
    if ( isset($clearfix) ) {
        
        if ($clearfix == 1 || $clearfix == 3) {
            print t('<div class="clearfix before-@key"></div>',array('@key' => $key));
        }
    }

?>


<?php if ($content): ?>
  <div class="<?php print $classes; ?>" <?php print $attributes; ?> >
    <div class="row-fluid">
        <?php print $content; ?>
    </div>
  </div>
<?php endif; ?>


<?php 
    
    if ( isset($clearfix) ) {
        
        if ($clearfix == 2 || $clearfix == 3) {
            print t('<div class="clearfix after-@key"></div>',array('@key' => $key));
        }
    }

?>