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

	$do = addslashes($_POST['do']);
	
	if($do=='update_stt') {
		$table = $_POST['table'];
		$col = $_POST['col'];
		$val = $_POST['val'];
		$id = $_POST['id'];
		$d->o_que("update $table set $col=$val where id=$id");
	}
	else if($do=='get_list_extra') {

		$id = $_POST['id'];
		$id =implode(", ", $id);
		$list = $d->o_fet("select * from #_extra where id IN ($id) order by stt asc,id desc");
		//$selected="selected='selected'";
		//echo $str1 ='<option></option>';
		foreach($list as $a) {
			
			echo $str = "<option value='{$a['id']}' >{$a['title_vi']}</option>";
		}

	}

?>