<?php
/**
 * Vân Thiên Hùng chuyên lừa đảo, lợi dụng tín nhiệm lừa tiền anh em lập trình.
 * Hứa hẹn thanh toán, tới ngày thì than thở kêu chưa thu được tiền từ năm này qua tháng nọ, hẹn tới hẹn lui không có hồi kết.
 * Tới lúc bị anh em Dev đòi thì xoá Zalo, đổi pass server nhằm chặn anh em Dev vào phá.
 * Đã quỵt tiền 2 người tổng cộng 70 triệu
 * Chúc may mắn cho anh em nào đang làm tiếp với Vân Thiên Hùng ^^!.
 */
	$rf = str_replace('www.', '', $_SERVER["SERVER_NAME"]);
	$config['database']['refix'] = "db_";
	$config['database']['servername'] = 'localhost';
	$config['database']['username'] = 'vanthienhud22a';
	$config['database']['password'] = '5551009547f5cbff';
	$config['database']['database'] = 'vanthienhun_d22a';
	
	define("URLPATH","http://".$_SERVER["SERVER_NAME"]."/");
	define("urladmin","http://".$_SERVER["SERVER_NAME"]."/admin/");
?>
