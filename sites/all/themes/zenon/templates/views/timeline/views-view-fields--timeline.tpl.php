
<?php
    # FIELDS
    $timeline = array();
    foreach ($fields as $id => $field) {
        if ($id == 'field_large_image') {
            $field->content = strip_tags($field->content);
        }
        $timeline[$id] = $field->content;
    }

?>
<div class="year"> <?php echo $timeline['field_year'] ?> </div>
<div class="body">
    <div class="image <?php echo ($timeline['field_large_image'] == '1') ? 'large' : 'small' ?>"> <?php echo $timeline['field_timeline_image'] ?> </div>
    <div class="content"> <?php echo $timeline['body'] ?> </div>
</div>