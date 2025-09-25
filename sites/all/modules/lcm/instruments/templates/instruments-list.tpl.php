

<style>
.cfds-list-v2 {
  background: #fff;
}
.cfds-list-v2 h1 {
  font-size: 65px;
  margin: 65px 0 45px;
  float: left;
}
.cfds-list-v2 .assets-categories a {
  border: 2px solid #ffffff;
  color: #757575;
  font-size: 22px;
  float: left;
  padding: 20px 30px;
  text-transform: uppercase;
  text-decoration: none;
}
.cfds-list-v2 .assets-categories a.selected {
  color: #000000;
  border: 2px solid #7f7f7f;
}
.cfds-list-v2 .assets-body {
  padding: 60px 0;
  background: #e6e6e6;
}
.cfds-list-v2 .assets-body h2 .selected {
  font-size: 40px;
}
.cfds-list-v2 .assets-body .panel-group .panel {
  margin-top: 1px;
}
.cfds-list-v2 .assets-body .panel-group .panel-default {
  border: none;
}
.cfds-list-v2 .assets-body .panel-collapse.collapse.in {
  background: #e6e6e6;
}
.cfds-list-v2 .assets-body .panel-heading {
  padding: 0;
}
.cfds-list-v2 .assets-body .panel-title a {
  text-decoration: none;
  padding: 10px 15px;
}
.cfds-list-v2 .assets-body .panel-title a .fa-angle-up,
.cfds-list-v2 .assets-body .panel-title a .fa-angle-down {
  display: block;
  float: left;
  color: #b0b0b0;
  font-size: 30px;
  margin-right: 20px;
}
.cfds-list-v2 .assets-body .panel-title a .fa-angle-down {
  display: none;
}
.cfds-list-v2 .assets-body .panel-title a.collapsed {
  background: #fff;
}
.cfds-list-v2 .assets-body .panel-title a.collapsed .fa-angle-up {
  display: none;
}
.cfds-list-v2 .assets-body .panel-title a.collapsed .fa-angle-down {
  display: block;
}
.cfds-list-v2 .assets-body .panel-body {
  background: #d3d3d3;
}
.cfds-list-v2 .assets-body .panel-body .sub-category-tab {
  float: left;
  padding: 12px 20px;
  margin: 15px 0 10px 0;
  font-size: 14px;
  border-radius: 20px !important;
  line-height: 1;
  text-transform: capitalize;
  text-decoration: none;
}
.cfds-list-v2 .assets-body .panel-body .sub-category-tab.active.btn.btn-promo {
  background: #000;
  border-radius: 10px;
  color: #fff;
}
.cfds-list-v2 .assets-body .panel-body table {
  margin-top: 40px;
}
.cfds-list-v2 .assets-body .panel-body table tr {
  background: #fff;
}
.cfds-list-v2 .assets-body .panel-body table tr:nth-child(2n) {
  background: #f2f2f2;
}
.cfds-list-v2 .assets-body .panel-body table tr th {
  background: #e8e8e9;
  text-align: center;
  border: none;
  text-transform: initial;
  font-size: 14px;
  color: #000;
  font-weight: 100;
}
.cfds-list-v2 .assets-body .panel-body table tr td,
.cfds-list-v2 .assets-body .panel-body table tr th {
  text-align: center;
  border: none;
  padding: 25px 20px;
}
.cfds-list-v2 .assets-body .panel-body table tr td:nth-child(4n+1),
.cfds-list-v2 .assets-body .panel-body table tr th:nth-child(4n+1) {
  text-align: left;
}
</style>

<div class="full cfds-list-v2">
    <div class="theme-content">
		<div class="full assets-categories">			
			<div class="full">
				<h1><?= tt('translate_kw_all_instruments_list'); ?> a</h1>
			</div>
			<!--
			<div class="full">
				<a href="#Shares-p">
					<?= tt('translate_kw_stocks')?>
				</a>
				<a href="#index-p">
					<?= tt('translate_kw_indices')?>
				</a>
				<a href="#currency-p">
					<?= tt('translate_kw_forex')?>
				</a>
				<a href="#metal-p">
					<?= tt('translate_kw_commodities')?>
				</a>
				<a href="#bonds-p">
					<?= tt('translate_kw_bonds')?>
				</a>
				<a href="#ETFs-p">
					<?= tt('translate_kw_etfs')?>
				</a>
				<a href="#currency-p">
					<?= tt('translate_kw_crypto')?>
				</a>
			</div>
			-->
		</div>
	</div>	
	<div class="full assets-body">	
		<div class="full panel-group" id="accordion">
		<?php foreach ($tables as $category_name => $category_data) { ?>						
			<div id="<?= $category_name ?>-p" class="panel panel-default full">
				<div class="theme-content">
				  <div class="panel-heading full">
					<h2 class="panel-title full">
					  <a class="collapsed full" aria-expanded="false" data-toggle="collapse" data-parent="#accordion" href="#<?= $category_name ?>">
						<i class="fa fa-angle-up" aria-hidden="true"></i>
						<i class="fa fa-angle-down" aria-hidden="true"></i>
						<?= tt('translate_cfds_'.strtolower($category_name))?>
					  </a>
					</h2>
				  </div>
				</div>
			  <div id="<?= $category_name ?>" class="panel-collapse collapse full" aria-expanded="false">				
				<div class="panel-body full">
					<div class="theme-content">
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
			  </div>
			</div>
		<?php } ?>	
		</div>		
	</div>
</div>
