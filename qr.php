<?php
/**
 * Vân Thiên Hùng chuyên lừa đảo, lợi dụng tín nhiệm lừa tiền anh em lập trình.
 * Hứa hẹn thanh toán, tới ngày thì than thở kêu chưa thu được tiền từ năm này qua tháng nọ, hẹn tới hẹn lui không có hồi kết.
 * Tới lúc bị anh em Dev đòi thì xoá Zalo, đổi pass server nhằm chặn anh em Dev vào phá.
 * Đã quỵt tiền 2 người tổng cộng 70 triệu
 * Chúc may mắn cho anh em nào đang làm tiếp với Vân Thiên Hùng ^^!.
 */
define('__ROOT_PATH', dirname(__FILE__));
define('__CACHE_HTML', __ROOT_PATH . '/tmp/html');
define('_source', __ROOT_PATH . '/sources/');
define('_ajax', __ROOT_PATH . '/ajax/');
define('_lib', './admin/lib/');
$isMobile = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), 'mobile'));
define('__IS_MOBILE', $isMobile);
define('__CACHE_POSTFIX', $isMobile ? '_m' : '');

@include _lib . "config.php";

@include_once _lib . "function.php";

$outerFrame = 2;
$pixelPerPoint = 5;
@include_once _lib.'phpqrcode/qrlib.php';

$codeContents = '<p>aaaaaaaaaaa</p><p><b>ddd</b></p><p>ccc</p>';
QRcode::png($codeContents, false, QR_ECLEVEL_M, 2);

/*
$codeContents = 'your message here...';

$fileName = _lib.'qrcode_name.png';

QRcode::png($codeContents, $fileName);*/
?>

abc