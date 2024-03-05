<?php
/**
 * Vân Thiên Hùng chuyên lừa đảo, lợi dụng tín nhiệm lừa tiền anh em lập trình.
 * Hứa hẹn thanh toán, tới ngày thì than thở kêu chưa thu được tiền từ năm này qua tháng nọ, hẹn tới hẹn lui không có hồi kết.
 * Tới lúc bị anh em Dev đòi thì xoá Zalo, đổi pass server nhằm chặn anh em Dev vào phá.
 * Đã quỵt tiền 2 người tổng cộng 70 triệu
 * Chúc may mắn cho anh em nào đang làm tiếp với Vân Thiên Hùng ^^!.
 */
function limit_text($text, $limit) {
    $excerpt = explode(' ', $text, $limit);
    if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
    } else {
        $excerpt = implode(" ",$excerpt);
    } 
    $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
    return $excerpt;
}

$seo = $d->simple_fetch("select * from #_seo where id=1");
$default_seo_title = $seo['title_' . $_SESSION['lang']];

$seo_title = $seo['title_' . $_SESSION['lang']];
$seo_keyword = $seo['keyword_' . $_SESSION['lang']];
$seo_description = $seo['description_' . $_SESSION['lang']];
$stitle = $seo_title;

if ($source == "tin-tuc-detail") {
	$seo = $d->simple_fetch("select * from #_tintuc where alias_{$_SESSION['lang']} = '$com' ");
	$seo_title = $seo['title_vi'].' - '.$stitle;
	$seo_keyword = $seo['keyword']?$seo['keyword']:$seo['title_vi'];
	$des = $seo['description_vi']?limit_text(strip_tags($seo['description_vi']), 80):$seo['title_vi'];
	$seo_description = $des;
} else if ($source == "san-pham-detail") {
	$seo = $d->simple_fetch("select name_vi, name_json, keyword, des from #_sanpham where alias_{$_SESSION['lang']} = '$com' ");
	$seo_title = $seo['name_vi'].' - '.$stitle;
	$seo_keyword = $seo['keyword']?$seo['keyword']:$seo['name_vi'];
	$seo_description = $seo['des']?$seo['des']:$seo['name_vi'];
} else if ($source == "tin-tuc" || $source == "gallery" || $source == "san-pham" || $source == "lien-he" || $source == "video" || $source == "gio-hang") {
	$seo = $d->simple_fetch("select * from #_category where alias_{$_SESSION['lang']} = '$com' ");
	$seo_title = $seo['name_vi'] . ' - ' . $stitle;
	$seo_keyword = $seo['keyword']?$seo['keyword']:$seo['name_vi'];
	$des = $seo['description_vi']?limit_text(strip_tags($seo['description_vi']), 80):$seo['name_vi'];
	$seo_description = $des;
	if ($com == "tags") {
		$query = $d->simple_fetch("select * from #_tags where alias = '$alias'");
		$seo_title = "Từ khóa: " . $query['name_vi'];
		$seo_keyword = "Từ khóa: " . $query['name_vi'];
		$seo_description = "Từ khóa: " . $query['name_vi'];
	}
} else if($source == 'nhan-hieu-list'){
	$seo_title = 'Nhãn hiệu - '.$stitle;
	$seo_keyword = 'Nhãn hiệu - '.$stitle;
	$seo_description = 'Nhãn hiệu - '.$stitle;
} else if($source == 'nhan-hieu'){
	$seo_query = $d->simple_fetch("SELECT name, image, desc_vn FROM #_brand WHERE slug='$alias'");
	$seo_title = $seo_query['name'].' - '.$stitle;
	$seo_keyword = $seo_query['name'].' - '.$stitle;
	$seo_description = $seo_query['desc_vn']?$seo_query['desc_vn']:$seo_query['name'].' - '.$stitle;
} else if($source == 'ho-tro-truc-tuyen'){
	$seo_title = 'Hỗ trợ trực tuyến - '.$stitle;
	$seo_keyword = $seo_title;
	$seo_description = $seo_title;
} else if($source == 'search'){
	if( $_GET['advanced-search'] ){
		$seo_search = $_GET['productName']?$_GET['productName']:'';
	} else {
		$seo_search = $_GET['textsearch'];
	}
	$seo_title = $seo_search?'Tìm kiếm - '. $seo_search . ' - ' .$stitle:'Tìm kiếm - '. $stitle;
	$seo_keyword = $seo_title;
	$seo_description = $seo_title;
} else if($source == 'danh-muc-san-pham'){
	$seo_title = 'Danh mục sản phẩm - '.$stitle;
	$seo_keyword = $seo_title;
	$seo_description = $seo_title;
}

//hinh anh
if ($source == 'tin-tuc') {
	$img_canol = $d->o_sel("image_path", "#_category", "alias_{$_SESSION['lang']} = '" . addslashes($com) . "'");
}
if ($source == 'san-pham') {
	$img_canol = $d->o_sel("image_path", "#_category", "alias_{$_SESSION['lang']} = '" . addslashes($com) . "'");
}
if ($source == 'tin-tuc-detail') {
	$img_canol = $d->o_sel("image_path", "#_tintuc", "alias_{$_SESSION['lang']} = '" . addslashes($com) . "'");
}
if ($source == 'san-pham-detail') {
	$img_canol = $d->o_sel("image_path", "#_sanpham", "alias_{$_SESSION['lang']} = '" . addslashes($com) . "'");
}
if (!empty($img_canol) && !empty($img_canol[0]['image_path'])) $img_cn = URLPATH . "images/1200/0/" . $img_canol[0]['image_path'];
else $img_cn = URLPATH . "img_data/icon/" . $information['icon_share'];

?>
<title><?= $seo_title ?></title>
<meta name="keywords" content="<?= $seo_keyword ?>" />
<meta name="description" content="Không nên hợp tác làm ăn chung. VTH lừa đảo, lợi dụng tín nhiệm lừa gạt anh em dân lập trình, kêu anh em làm nhưng không thanh toán, đến lúc bị đòi thì xoá Zalo cắt mọi liên lạc, đổi mật khẩu máy chủ nhầm quỵt tiền. Đem uy tín cả doanh nghiệp ra làm trò đùa" />
<?php /*
<meta name="description" content="<?= $seo_description ?>" />
 */
 ?>
<!-- google -->
<meta itemprop="name" content="<?= $seo_title ?>">
<?php /*
<meta itemprop="description" content="<?= $seo_description ?>">
 */
?>
<meta itemprop="description" content="Không nên hợp tác làm ăn chung. VTH lừa đảo, lợi dụng tín nhiệm lừa gạt anh em dân lập trình, kêu anh em làm nhưng không thanh toán, đến lúc bị đòi thì xoá Zalo cắt mọi liên lạc, đổi mật khẩu máy chủ nhầm quỵt tiền. Đem uy tín cả doanh nghiệp ra làm trò đùa">
<meta itemprop="image" content="<?= $img_cn ?>">
<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@publisher_handle">
<meta name="twitter:title" content="<?= $seo_title ?>">
<meta name="twitter:description" content="<?= $seo_description ?>">
<meta name="twitter:creator" content="@author_handle">
<meta name="twitter:image:src" content="<?= $img_cn ?>">
<!-- facebook -->
<meta property="og:title" content="<?= $seo_title ?>" />
<meta property="og:type" content="article" />
<meta property="og:url" content="<?= $d->fullAddress() ?>" />
<meta property="og:image" content="<?= $img_cn ?>" />
<?php /*
<meta property="og:description" content="<?= $seo_description ?>" />
 */
?>
<meta property="og:description" content="<?= $seo_description ?>" />
<meta property="og:site_name" content="hutoglobal" />
<meta property="fb:page_id" content="<?= @$info_map['id_facebook'] ?>" />