<?php if ($page['header']): ?>
    <div id="header" class="col-12">
        <div class="container">
            <?php print render($page['header']); ?>
        </div>
    </div>
<?php endif; ?>

<div class="col-12">
    <?php print render($messages); ?>
    <?php if ($tabs): ?><div class="tabs"><?php print render($tabs); ?></div><?php endif; ?>
    <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>

    <?php print render($page['content']); ?>
</div>
<div id="footer" class="col-12">
    <?php if ($page['footer']): ?>
        <?php print render($page['footer']); ?>
    <?php endif; ?>
</div>