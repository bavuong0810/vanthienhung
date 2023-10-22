<?php
$cachePath = '/company_info-' . $lang . '.html';
$cachePath = __CACHE_HTML . $cachePath;
if (file_exists($cachePath) && false) {
	echo file_get_contents($cachePath);
	echo '<!--cached-->';
} else {

	ob_start("minify_html");

	$inGroupProducts = [];
	$parentProduct = [];
	if ($item['product_type'] == ProductConfigs::TYPE_PRODUCT_GROUP) {
		$parentProduct = $item;
	}
	if (!empty($item['parent_number']) && is_numeric($item['parent_number'])) {
		if ($item['product_type'] == ProductConfigs::TYPE_PRODUCT) {
			$parentProduct = $d->simple_fetch(
				'SELECT `id`, `name_en`, `name_vi`, `name_ch`, `alias_vi`, `alias_en`, `alias_ch`, `image_path` from `#_sanpham` WHERE `hien_thi` = 1 AND `product_type` = ' .
					ProductConfigs::TYPE_PRODUCT_GROUP .
					" AND `parent_number` = {$item['parent_number']} ORDER BY `group_pos` ASC LIMIT 1"
			);
		}
		$inGroupProducts = $d->o_fet(
			'SELECT `id`, `name_en`, `name_vi`, `name_ch`, `alias_vi`, `alias_en`, `alias_ch`, `group_pos`, `parent_number`, `part_number`, `group_quantity`, `specification` from `#_sanpham` WHERE `hien_thi` = 1 AND `product_type` = ' .
				ProductConfigs::TYPE_PRODUCT .
				" AND `parent_number` = {$item['parent_number']} ORDER BY CAST(`group_pos` AS unsigned) ASC LIMIT 100"
		);
	}
?>

<?php
$belowDetailLeft1 = $d->getTemplates(59, 1);
$belowDetailLeft2 = $d->getTemplates(61);
$belowDetailLeft3 = $d->getTemplates(62);
$belowDetailLeft4 = $d->getTemplates(63);
$belowDetailRight1 = $d->getTemplates(60);
$belowDetailRight2 = $d->getTemplates(64);
$belowDetailRight3 = $d->getTemplates(65);
$belowDetailRight4 = $d->getTemplates(66);
?>
	
<div class="row10 clearfix">
	<?php if($belowDetailLeft2){?>
	<div class="col-md-12 plr10 mb-2">
		<ul class="nav nav-tabs" role="tablist">
			<li class="active">
				<a href="#ct-product-3" aria-controls="below_detail_list_childs" role="tab" data-toggle="tab">
					<?php echo $belowDetailLeft2['name_' . $lang]; ?>
				</a>
			</li>
		</ul>
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane fade in active clearfix" id="ct-product-3">
				<?php echo $belowDetailLeft2['content_' . $lang]; ?>
			</div>
		</div>	
	</div>
	<?php }?>
	
	<?php if($belowDetailLeft3){?>
	<div class="col-md-12 plr10 mb-2">
		<ul class="nav nav-tabs" role="tablist">
			<li class="active">
				<a href="#ct-product-3" aria-controls="below_detail_list_childs" role="tab" data-toggle="tab">
					<?php echo $belowDetailLeft3['name_' . $lang]; ?>
				</a>
			</li>
		</ul>
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane fade in active clearfix" id="ct-product-3">
				<?php echo $belowDetailLeft3['content_' . $lang]; ?>
			</div>
		</div>	
	</div>
	<?php }?>
	
	<?php if($belowDetailLeft4){?>
	<div class="col-md-12 plr10 mb-2">
		<ul class="nav nav-tabs" role="tablist">
			<li class="active">
				<a href="#ct-product-3" aria-controls="below_detail_list_childs" role="tab" data-toggle="tab">
					<?php echo $belowDetailLeft4['name_' . $lang]; ?>
				</a>
			</li>
		</ul>
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane fade in active clearfix" id="ct-product-3">
				<?php echo $belowDetailLeft4['content_' . $lang]; ?>
			</div>
		</div>	
	</div>
	<?php }?>
</div>

<?php 
$cacheContent = ob_get_flush();
file_put_contents($cachePath, minify_html($cacheContent));
}?>