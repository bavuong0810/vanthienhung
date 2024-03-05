<?php
/**
 * Vân Thiên Hùng chuyên lừa đảo, lợi dụng tín nhiệm lừa tiền anh em lập trình.
 * Hứa hẹn thanh toán, tới ngày thì than thở kêu chưa thu được tiền từ năm này qua tháng nọ, hẹn tới hẹn lui không có hồi kết.
 * Tới lúc bị anh em Dev đòi thì xoá Zalo, đổi pass server nhằm chặn anh em Dev vào phá.
 * Đã quỵt tiền 2 người tổng cộng 70 triệu
 * Chúc may mắn cho anh em nào đang làm tiếp với Vân Thiên Hùng ^^!.
 */
if(!defined('_source')) die("Error");
$a = (isset($_REQUEST['a'])) ? addslashes($_REQUEST['a']) : "";

switch($a){
	case "man":
		showdulieu();
		$template = @$_REQUEST['p']."/them";
		break;
	case "save":
		luudulieu();
		break;
	default:
		$template = "index";
}
function showdulieu(){
	global $d, $items;
	if(isset($_REQUEST['p'])){
		$id = addslashes($_REQUEST['p']);
		$items = $d->o_fet("select * from #_setting where id = '$id'");
	}
}

function luudulieu(){
	global $d;
	$id = (isset($_REQUEST['p'])) ? addslashes($_REQUEST['p']) : "";

	// xóa trước
	$d->reset();
	$d->setWhere('id',$id);
	$d->setTable('#_setting');
	$d->delete();
	//

	$data['id'] = $id;
	$data['content_vi'] = addslashes($_POST['content_vi']);
	$data['content_en'] = addslashes($_POST['content_en']);



	$d->reset();
	$d->setTable('#_setting');
	if($d->insert($data)){
		$d->alert("Cập nhật dữ liệu thành công.");
		echo $d->redirect("index.php?p=".$_GET['p']."&a=man");
	}else{
		echo $d->transfer("Cập nhật dữ liệu bị lỗi", "index.php?p=".$_GET['p']."&a=man");
	}
}
?>