<?php
/**
 * @Author: Florin M.
 * @Date:   2015-11-11 13:22:50
 * @Last Modified by:   Florin M.
 * @Last Modified time: 2015-12-04 15:46:35
 */

hide($header);

// die("wooohooo keystock");
// 
// ?>


<style>
	.global-wrapper > div {
		display: none;
	}

	.global-wrapper	#mainwrapper {
		display: block;
	}

	.zopim {
		display: none;
	}
	#maincontainer {
		padding-top: 0;
	}
</style>
<?php print render($content); ?>