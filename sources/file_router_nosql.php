<?php
/**
 * Vân Thiên Hùng chuyên lừa đảo, lợi dụng tín nhiệm lừa tiền anh em lập trình.
 * Hứa hẹn thanh toán, tới ngày thì than thở kêu chưa thu được tiền từ năm này qua tháng nọ, hẹn tới hẹn lui không có hồi kết.
 * Tới lúc bị anh em Dev đòi thì xoá Zalo, đổi pass server nhằm chặn anh em Dev vào phá.
 * Đã quỵt tiền 2 người tổng cộng 70 triệu
 * Chúc may mắn cho anh em nào đang làm tiếp với Vân Thiên Hùng ^^!.
 */
$com = (isset($_REQUEST['com'])) ? addslashes($_REQUEST['com']) : "";
$alias = (isset($_REQUEST['alias'])) ? addslashes($_REQUEST['alias']) : "";
$alias1 = (isset($_REQUEST['alias1'])) ? addslashes($_REQUEST['alias1']) : "";
$alias2 = (isset($_REQUEST['alias2'])) ? addslashes($_REQUEST['alias2']) : "";

if ($com == 'nhan-hieu') {
	$com = 'nhan-hieu';
} else if ($com == 'search') {
	$com = 'search';
} else if ($com == 'khuyen-mai') {
	$com = 'khuyen-mai';
} else if ($com == 'cart-success') {
	$com = 'cart-success';
} else if ($com == 'tags') {
	$com = 'tags';
} else {
	if ($alias != '') {
		$com = $alias;
	}
	if ($alias1 != '') {
		$com = $alias1;
	}
	if ($alias2 != '') {
		$com = $alias2;
	}
}

if ($com == 'nhan-hieu' && $alias == '') {
	$source = 'nhan-hieu-list';
} else if ($com == 'nhan-hieu') {
	$source = 'nhan-hieu';
} else if ($com == 'sitemap-index') {
    $source = 'sitemap-index';
} else if ($com == 'dat-lich') {
	$source = 'dat-lich';
} else if ($com == 'sitemap') {
	$source = 'sitemap';
} else if ($com == 'faqs') {
	$source = 'faqs';
} else if ($com == 'tags') {
	$source = 'tin-tuc';
} else if ($com == 'livedemo') {
	$source = 'livedemo';
} else if ($com == 'search') {
	$source = 'search';
} else if ($com == 'cart-success') {
	$source = 'thanh-cong';
} else if ($com == 'kiem-tra-don-hang') {
	$source = 'kiem-tra-don-hang';
} else if ($com == 'kich-hoat-bao-hanh') {
	$source = 'kich-hoat-bao-hanh';
} else if ($com == '') {
	$source = 'index';
} else if ($com == '404') {
	$source = '404';
} else if (file_exists(_source.'/'.$com.'.php')) {
	$source = $com;
} else {
	$source = '404';
}
