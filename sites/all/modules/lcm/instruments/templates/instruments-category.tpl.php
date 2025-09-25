<div class="full cfds-list">
	<?php foreach ($tables as $category_name => $category_data) { ?>
	<div class="category category-<?= $category_name ?>">
		<div class='tables-container' id="cat-<?= $category_name ?>">
			<?php
			if (isset($category_data['instruments'])) {
			?>
			<div class='instruments-container'>	
			<?php
				echo $category_data['instruments'];
			?>
			</div>
			<?php					
			}
			
			if (isset($category_data['subcategories'])) {
				echo $category_data['subcategories'];
			}
			?>
			<div class="full description">
				<p><?= tt('translate_cfds_main_'.strtolower("{$category_name}_description")); ?></p>
			</div>
		</div>
	</div>
	<?php } ?>
</div>