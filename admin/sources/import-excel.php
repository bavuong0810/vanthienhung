
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
		$extra=getExtra();
		showdulieu();
		$template = @$_REQUEST['p']."/them";
		break;
	case "edit":
		$extra=getExtra();
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

function getExtra() {
	global $d;
	$str['thuonghieu'] = $d->o_fet("select * from #_extra where type = 0 and hide=1 order by stt asc,id desc");
	$str['model'] = $d->o_fet("select * from #_extra where type = 1 and hide=1 order by stt asc,id desc");
	$str['mfg_year'] = $d->o_fet("select * from #_extra where type = 2 and hide=1 order by stt asc,id desc");
	return $str;
}

function showdulieu(){
	global $d, $items, $paging,$loai;
	$loai = $d->array_category(0,'',$_GET['category_id'],3);
	
	if($_REQUEST['a'] == 'man'){

		//show du lieu
		if(isset($_GET['category_id']) && $_GET['category_id'] <> ''){
			
			if($_GET['category_id'] == 0){
				$items = $d->o_fet("select * from #_sanpham where style=0 order by so_thu_tu asc, id desc");
			}else{
				$category_id = $_GET['category_id'].$d->findIdSub($_GET['category_id']);	
			    $items = $d->o_fet("select * from #_sanpham where FIND_IN_SET(category_id,'$category_id') <> 0 and style=0 order by so_thu_tu asc, id desc");
			}
		}
		else if(isset($_GET['seach'])){
			$seach = addslashes($_GET['seach']);
			$key = (isset($_GET['key']))? addslashes($_GET['key']):"";
			if($seach == 'id'){
				$items = $d->o_fet("select * from #_sanpham where id = '".$key."' and style=0");
			}else if($seach == 'name'){
				$items = $d->o_fet("select * from #_sanpham where name_vi like '%".$key."%' and style=0");
			}else{
				$items = $d->o_fet("select * from #_sanpham where code like '%".$key."%' and style=0");
			}
		}
		else $items = $d->o_fet("select * from #_sanpham where style=0 order by ngay_dang desc");

		if(isset($_GET['hienthi'])){
			$maxR= $d->lay_show_hienthi(addslashes($_GET['hienthi']));
		}
		else $maxR=20;
		// phan trang
		$page = isset($_GET['page']) ? addslashes($_GET['page']) : 1;
		$url=$d->fullAddress();
		$maxP=$maxR;
		$paging=$d->phantrang($items, $url, $page, $maxR, $maxP,'classunlink','classlink','page');
		$items=$paging['source'];
		//
	}else{
				
		//lay noi dung theo id
		if(isset($_REQUEST['id'])){
			@$id = addslashes($_REQUEST['id']);
			$items = $d->o_fet("select * from #_sanpham where id =  '".$id."'");
			$loai = $d->array_category(0,'',$items[0]['category_id'],3);
		}
	}

}


?>