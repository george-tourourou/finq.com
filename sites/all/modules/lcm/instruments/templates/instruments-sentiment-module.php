<?php 

	$instrument_symbol = strtolower($instrument_symbol);
	$instrument_symbol = str_replace("/","",$instrument_symbol);
	
	$data = file_get_contents("https://api-v2.finq.com/sentiment?key=1&brand=trade&q=$instrument_symbol");

	if($data == "{}")
	{
		return ;
	}
	
	$data = json_decode($data);
	$instrument_bought = "";
	$instrument_sold = "";
	
	
	foreach($data as $property => $value)
	{
		foreach($value as $prop => $val)
		{
			if($prop == 'percentageOfLongs')
			{
				$instrument_bought = $val;
			}
			else if($prop == 'percentageOfShorts')
			{
				$instrument_sold = $val;
			}
		}
	}
?>

<div id="sentiment" style="display: block;" class='instrument-info full'>
	<div class="sentiment-header">
		<?= tt('translate_cfds_instrument_traders_trends') ?>
	</div>
	<div class="sentiment-content">
		<div class="sentiment-sell">
			<span><?= tt('translate_kw_sold') ?> <?php echo $instrument_sold; ?>%</span>
		</div>
		<div class="percentage-wrapper">
			<div class="percentage" style="width: <?php echo $instrument_sold; ?>%;"></div>
		</div>
		<div class="sentiment-buy">
			<span><?= tt('translate_kw_bought') ?> <?php echo $instrument_bought; ?>%</span>
		</div>
	</div>
	<div class="sentiment-help"><br /></div>
	<!--<div class="sentiment-help"><a href="#" target="_blank"><?= tt('translate_cfds_instrument_what_is_traders_trends') ?></a></div>-->
</div>
