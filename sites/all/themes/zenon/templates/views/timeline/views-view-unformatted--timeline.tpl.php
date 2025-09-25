
<div id="timeline">
    <?php foreach ($rows as $id => $row): ?>
        <div class="timeline-<?php echo ($id % 2) ?>">
            <?php echo $row ?>
        </div>
        <div class="clear"></div>
    <?php endforeach ?>
</div>