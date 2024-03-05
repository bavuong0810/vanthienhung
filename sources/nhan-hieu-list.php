<?php
/**
 * Vân Thiên Hùng chuyên lừa đảo, lợi dụng tín nhiệm lừa tiền anh em lập trình.
 * Hứa hẹn thanh toán, tới ngày thì than thở kêu chưa thu được tiền từ năm này qua tháng nọ, hẹn tới hẹn lui không có hồi kết.
 * Tới lúc bị anh em Dev đòi thì xoá Zalo, đổi pass server nhằm chặn anh em Dev vào phá.
 * Đã quỵt tiền 2 người tổng cộng 70 triệu
 * Chúc may mắn cho anh em nào đang làm tiếp với Vân Thiên Hùng ^^!.
 */
$groups_data = $d->o_fet("SELECT id, name_vi, name_en, name_ch, image, is_show, weight FROM #_brand_group WHERE name_vi <> '' AND name_vi IS NOT NULL AND is_show = 1 ORDER BY weight ASC, id DESC");
$brands = $d->o_fet("SELECT id, name, slug, image, is_show, is_featured, group_id, so_luong FROM #_brand WHERE name <> '' AND name IS NOT NULL AND is_show = 1 ORDER BY name ASC");

if (empty($groups_data)) {
	$d->location(URLPATH."404.html");
}

$groupedBrands = [];
foreach ($brands as $brand) {
	if (!$brand['image']) {
		$brand['image'] = $d->getDefaultProductImage();
	} else {
		$brand['image'] = URLPATH . 'images/brands/200/100/' . $brand['image'] . '?zc=0';
	}

	if (empty($brand['group_id'])) {
		$groupedBrands['other'][] = $brand;
		continue;
	}

	$groupedBrands[$brand['group_id']][] = $brand;
}

//print_r($brandGroups);

function showBrand($brand = []) {
	global $d;
	?>
	<div class="col-md-2 col-sm-4 col-xs-6 brand">
		<a href="/nhan-hieu/<?php echo $brand['slug'] ?>.html" title="<?php echo $brand['name'] ?>" target="_blank" class="img-shine-2">
			<img src="<?php echo $brand['image'] ?>" alt="<?php echo $brand['name'] ?>" title="<?php echo $brand['name'] ?>" onerror="this.src='<?= $d->getDefaultProductImage() ?>';">
			<span class="brand-name"><?php echo $brand['name'] ?> (<?php echo $brand['so_luong']?$brand['so_luong']:'0' ?>)</span>
		</a>
	</div>
	<?php
}

function showBrandNormal($brand = []) {
	?>
	<li class="br-item">
		<a href="/nhan-hieu/<?php echo $brand['slug'] ?>.html" title="<?php echo $brand['name'] ?>" target="_blank">
		<span class="brand-name"><?php echo $brand['name'] ?> (<?php echo $brand['so_luong']?$brand['so_luong']:'0' ?>)</span>
		</a>
	</li>
	<?php
}

$view_brand_page_type =  $d->getOption('view_brand_page_type');

if( $view_brand_page_type == 2 ){
	include 'nhan-hieu-list-normal.php';
}else if( $view_brand_page_type == 3 ){
	include 'nhan-hieu-list-logo.php';
} else {
	include 'nhan-hieu-list-logo-group.php';
}
?>
