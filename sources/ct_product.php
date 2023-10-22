<?php
$detailNeedShow = [
	'brand_id' => 'Nhãn hiệu',
    'model' => 'Model',
	//'code' => 'Mã sản phẩm',
	'part_number' => 'Part number',
	'specification' => 'Quy cách',
	'loai' => 'Loại Động cơ',
	'weight' => 'Trọng lượng (kg)',
	'mfg_year' => 'Năm sản xuất',
	'khung_nang' => 'Khung nâng (m)',
	'bao_hanh' => 'Bảo hành',
	'xuat_xu' => 'Xuất xứ',
	'tinh_trang_hang' => 'Tình trạng hàng',
];

if (!empty($_COOKIE['productLayout']) && $_COOKIE['productLayout'] == 'small_list') {
	?>
	<table class="table table-striped bg-white">
		<thead>
			<tr>
				<th>Tên</th>
				<th class="hidden-xs txt-inline" style="width: 170px;">Thương hiệu</th>
				<th class="hidden-xs txt-inline" style="width: 140px;">Model</th>
				<th class="hidden-xs txt-inline" style="width: 160px;">Quy cách</th>
				<th class="hidden-xs" style="width: 200px;">Part Number</th>
				<th class="hidden-xs" style="width: 200px;">Giá</th>
				<th style="width: 110px;">Order</th>
			</tr>
		</thead>
		<tbody>
	<?php
}

foreach ($sanpham as $item) {

	if (empty($item['image_path'])) {
		$image_file_name = '';
		$item['image_path'] = $d->getDefaultProductImage(300, 220);
		
	} else {
		$image_file_name = $item['image_path'];
		$item['image_path'] = THUMB_BASE . 'images/300/220/' . $item['id'] . '/' . $item['image_path'];
	}

	// Custom name
	$item['name_' . $_SESSION['lang']] = getCustomProductName($item);

	if (!empty($_COOKIE['productLayout']) && $_COOKIE['productLayout'] == 'list') {
		include 'ct_product_list.php';
		continue;
	}
	if (!empty($_COOKIE['productLayout']) && $_COOKIE['productLayout'] == 'small_list') {
		include 'ct_product_small_list.php';
		continue;
	}

	include 'ct_product_grid.php';
}
if (!empty($_COOKIE['productLayout']) && $_COOKIE['productLayout'] == 'small_list') {
	?>
		</tbody>
	</table>
	<?php
}
?>

<script type="text/javascript">
$(document).ready(function($) {
	$('.addToCart').click(function(e) {
		const id = $(this).data('product');
		//const soluong = $('#numberOfProduct').val();
		const soluong = 1;

		const data = {
			id,
			soluong,
			func: 'addToCart',
		};

		const success = (res) => {
			/*
			$('#modalBackdrop').removeClass('hidden').animate({
				opacity: 0.3
			}, 500);
			$(this).effect("transfer", {
				to: "#cart",
				className: "add-to-cart-effect"
			}, 500, () => $('#modalBackdrop').animate({
				display: "block !important",
				opacity: 0.3
			}, 500).addClass('hidden'));
			*/
			
			updateProductInCart();
		};

		const error = (res) => {
			alert('Thêm sản phẩm vào giỏ hàng không thành công, vui lòng thử lại!');
		};

		$.ajax({
			url: '/api.php',
			method: 'POST',
			data,
			success,
			error,
		});

	});
});
</script>
