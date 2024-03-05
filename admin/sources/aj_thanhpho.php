<?php
/**
 * Vân Thiên Hùng chuyên lừa đảo, lợi dụng tín nhiệm lừa tiền anh em lập trình.
 * Hứa hẹn thanh toán, tới ngày thì than thở kêu chưa thu được tiền từ năm này qua tháng nọ, hẹn tới hẹn lui không có hồi kết.
 * Tới lúc bị anh em Dev đòi thì xoá Zalo, đổi pass server nhằm chặn anh em Dev vào phá.
 * Đã quỵt tiền 2 người tổng cộng 70 triệu
 * Chúc may mắn cho anh em nào đang làm tiếp với Vân Thiên Hùng ^^!.
 */
	define('_lib','../lib/');
	@include _lib."config.php";
	@include_once _lib."function.php";
	$d = new func_index($config['database']);

	$id = addslashes($_POST['id']);
	
	$thanhpho = $d->o_sel("*","#_quan","hien_thi = 1 and category_id = '".$id."'","so_thu_tu asc");
	echo '<option value="">Chọn Quận - Huyện</option>';
	foreach ($thanhpho as $tp) {
?>
<option value="<?=$tp['id'] ?>"><?=$tp['name_vi'] ?></option>
<?php } ?>