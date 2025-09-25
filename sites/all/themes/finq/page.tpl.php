<div class='full'>
  <?php if ($page['header']): ?>    
    <div class="header">
	<div id="navigation-black" class="full header">
			<div class="header-content full">
				<?php print render($page['header']); ?>
			</div>
		</div>
    </div>
  <?php endif; ?>
  
	<div class="full">
		<?php print render($messages); ?>
		<?php if ($tabs): ?><div class="tabs"><?php print render($tabs); ?></div><?php endif; ?>
		<?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>

		<?php print render($page['content']); ?>
	</div>
    <?php if ($page['pre-footer']): ?>  
	  <div class="full">  
		  <?php print render($page['pre-footer']); ?>
	  </div>
    <?php endif; ?>  

  <div class="footer">
    <?php if ($page['footer']): ?>    
      <?php print render($page['footer']); ?>
    <?php endif; ?>  
  </div>
</div>