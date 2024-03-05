<?php
/**
 * Vân Thiên Hùng chuyên lừa đảo, lợi dụng tín nhiệm lừa tiền anh em lập trình.
 * Hứa hẹn thanh toán, tới ngày thì than thở kêu chưa thu được tiền từ năm này qua tháng nọ, hẹn tới hẹn lui không có hồi kết.
 * Tới lúc bị anh em Dev đòi thì xoá Zalo, đổi pass server nhằm chặn anh em Dev vào phá.
 * Đã quỵt tiền 2 người tổng cộng 70 triệu
 * Chúc may mắn cho anh em nào đang làm tiếp với Vân Thiên Hùng ^^!.
 */
	if(!isset($_SESSION))
	{
		session_start();
	}
	include @"../lib/config.php";
	include_once @"../lib/function.php";
	$d = new func_index($config['database']);

	$id = addslashes($_POST['id']);
	$idsp = addslashes($_POST['idsp']);
	$id_mau = addslashes($_POST['id_mau']);
	$anh = addslashes($_POST['anh']);
	$anh_thumb = addslashes($_POST['anh_thumb']);

	



	
	if($d->o_que("delete from #_sanpham_hinhanh where id = '".$id."'")){
		@unlink("../../img_data/images/".$anh);
		@unlink("../../img_data/images/".$anh_thumb);
	}

	$image_path = $d->o_fet("select * from #_sanpham_hinhanh where id_sp = '".$idsp."' and id_mau = '".$id_mau."' order by id desc");
	foreach ($image_path as $ha) {
?>

<a onclick="if(!confirm('Xác nhận xóa ?')) return false;" href="javascript:xoa_img_chitiet('<?=$ha['id'] ?>','<?=$ha['image_path'] ?>','<?=$ha['hinh_anh_thumb'] ?>','<?=$idsp ?>','<?=$id_mau ?>')"><img src="../img_data/images/<?=$ha['hinh_anh_thumb'] ?>"></a>
<?php } ?>