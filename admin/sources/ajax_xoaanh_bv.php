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

	

	$image_path = $d->o_fet("select * from #_baiviet_hinhanh where id = '".$id."'");
	if($d->o_que("delete from #_baiviet_hinhanh where id = '".$id."'")){
		foreach ($image_path as $ha) {
			@unlink("../../img_data/images/".$ha['image_path']);
		}
	}

	
?>
<?php 
	$hinhanh =  $d->o_fet("select * from #_baiviet_hinhanh where id_baiviet ='".$idsp."'");
	foreach ($hinhanh as $val) {
?>
<div class="dv-img-ad">
	<img src="../img_data/images/<?php echo @$val['image_path']?>" style="width:70px;height:70px;"/>
	<a style="margin-top:3px; display:block; position:absolute; bottom:5px; padding-left:15px;right: 10px;" href="javascript:xoa_anh_sp('<?=$val['id']?>','<?=$val['id_baiviet']?>')" onclick="if(!confirm('Xác nhận xóa?')) return false;"> Xóa ảnh </a>
</div>
<?php } ?>