<?php
$block = module_invoke('instruments', 'block_view', 'instruments_search');
print render($block['content']);