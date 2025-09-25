	<?php //render intruments search and markets table
		$block = module_invoke('block', 'block_view', '84');
		print render($block['content']);	
	?>