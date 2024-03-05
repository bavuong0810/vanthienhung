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
		$template = @$_REQUEST['p']."/hienthi";
		break;
	case "add":
		showdulieu();
		$template = @$_REQUEST['p']."/them";
		break;
	case "edit":
		showdulieu();
		$template = @$_REQUEST['p']."/them";
		break;
	case "save":
		luudulieu();
		break;
	case "delete":
		xoadulieu();
		break;
	case "delete_all":
		xoadulieu_mang();
		break;
	default:
		$template = "index";
}

function showdulieu(){
	global $d, $items, $paging, $loai,$hang,$loaibv,$soluong;
	if($_REQUEST['a'] == 'man'){

		//show du lieu
		if(isset($_GET['seach'])){
			$seach = addslashes($_GET['seach']);
			$key = (isset($_GET['key']))? addslashes($_GET['key']):"";
			if($seach == 'id'){
				$items = $d->o_fet("select * from #_thanhpho where id = '".$key."'");
			}else{
				$items = $d->o_fet("select * from #_thanhpho where name_vi like '%".$key."%'");
			}
		}
		else $items = $d->o_fet("select * from #_thanhpho  order by so_thu_tu asc");


		if(isset($_GET['hienthi'])){
			$maxR= $d->lay_show_hienthi(addslashes($_GET['hienthi']));
		}
		else $maxR=35;
		// phan trang
		$page = isset($_GET['page']) ? addslashes($_GET['page']) : 1;
		$url=$d->fullAddress();
		$maxP = $maxR;
		$paging=$d->phantrang($items, $url, $page, $maxR, $maxP,'classunlink','classlink','page');
		$items=$paging['source'];
		//
	}else{
		//lay noi dung theo id
		if(isset($_REQUEST['id'])){
			@$id = addslashes($_REQUEST['id']);
			$items = $d->o_fet("select * from #_thanhpho where id =  '".$id."'");
		}
		$soluong = $loai = $d->o_fet("select * from #_thanhpho");
	}
}

function luudulieu(){
	global $d;
	@include('resize_img.php');
	$image = new SimpleImage();
	$id = (isset($_REQUEST['id'])) ? addslashes($_REQUEST['id']) : "";
	$file_name=$d->fns_Rand_digit(0,9,12);
	if($id != '')
	{



		$data['name_vi'] = addslashes($_POST['name_vi']);


		$data['so_thu_tu'] = addslashes($_POST['so_thu_tu']);

		$data['hien_thi'] = isset($_POST['hien_thi']) ? 1 : 0;


		$d->setTable('#_thanhpho');
		$d->setWhere('id',$id);
		if($d->update($data)){
			$d->redirect("index.php?p=thanh-pho&a=man&page=".@$_REQUEST['page']."");
		}
		else{
			 $d->transfer("Cập nhật dữ liệu bị lỗi", "index.php?p=thanh-pho&a=man");
		}
	}
	else
	{

				$data['name_vi'] = addslashes($_POST['name_vi']);


		$data['so_thu_tu'] = addslashes($_POST['so_thu_tu']);

		$data['hien_thi'] = isset($_POST['hien_thi']) ? 1 : 0;

		$d->setTable('#_thanhpho');
		if($d->insert($data))
		{
			$d->redirect("index.php?p=thanh-pho&a=man");
		}
		else{
			 $d->transfer("Thêm dữ liệu bị lỗi!", "index.php?p=thanh-pho&a=man");
		}
	}
}

function xoadulieu(){
	global $d;
	if(isset($_GET['id'])){
		$id =  addslashes($_GET['id']);
		

		$d->reset();
		$d->setTable('#_thanhpho');
		$d->setWhere('id',$id);
		if($d->delete()){
			$d->redirect("index.php?p=thanh-pho&a=man&page=".@$_REQUEST['page']."");
		}else{
			$d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=thanh-pho&a=man");
		}
	}else $d->transfer("Không nhận được dữ liệu", "index.php?p=thanh-pho&a=man");
}

function xoadulieu_mang(){
	global $d;
	if(isset($_POST['chk_child'])){
		$chuoi = "";
		foreach ($_POST['chk_child'] as $val) {
			$chuoi .=$val.',';
		}
		$chuoi = trim($chuoi,',');
	

		if($d->o_que("delete from #_thanhpho where id in ($chuoi)")){
			
			$d->redirect("index.php?p=thanh-pho&a=man&page=".@$_REQUEST['page']."");
		}
		else $d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=thanh-pho&a=man");
	}else $d->redirect("index.php?p=thanh-pho&a=man&page=".@$_REQUEST['page']."");
}
?>