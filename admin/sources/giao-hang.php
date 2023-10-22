<?php
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
	case "delete_image":
		xoadulieu_image();
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
		$loaibv = $d->array_category(0,'','',0);
		//show du lieu
		if(isset($_GET['seach'])){
			$seach = addslashes($_GET['seach']);
			$key = (isset($_GET['key']))? addslashes($_GET['key']):"";
			if($seach == 'id'){
				$items = $d->o_fet("select * from #_delivery_area where id = '".$key."' ORDER BY `name`");
			}else{
				$key = $d->bodautv($key);
				$items = $d->o_fet("select * from #_delivery_area where `name` like '%".$key."%' ORDER BY `name`");
			}
		}
		else $items = $d->o_fet("select * from #_delivery_area order by name asc, id desc");

		if(isset($_GET['hienthi'])){
			$maxR= $d->lay_show_hienthi(addslashes($_GET['hienthi']));
		}
		else $maxR=35;

		// phan trang
		// $page = isset($_GET['page']) ? addslashes($_GET['page']) : 1;
		// $url=$d->fullAddress();
		// $maxP = $maxR;
		// $paging=$d->phantrang($items, $url, $page, $maxR, $maxP,'classunlink','classlink','page');
		// $items=$paging['source'];
		//
	}else{
		//lay noi dung theo id
		if(isset($_REQUEST['id'])){
			@$id = addslashes($_REQUEST['id']);
			$items = $d->o_fet("select * from #_delivery_area where id =  '".$id."'");
		}
		$loaibv = $d->array_category(0,'',$items[0]['category_id'],0,$items[0]['id']);

		
		$soluong = $loai = $d->o_fet("select * from #_delivery_area");
		
	}
}

function luudulieu(){
	global $d;
	
	$id = (isset($_REQUEST['id'])) ? addslashes($_REQUEST['id']) : "";
	if($id != '')
	{
		$data['name'] = $d->clear(addslashes($_POST['name']));
		$data['price'] = intval($d->clear(addslashes($_POST['price'])));
		$data['isActive'] = isset($_POST['isActive']) ? 1 : 0;

		$d->setTable('#_delivery_area');
		$d->setWhere('id',$id);
		if($d->update($data)){
			$d->redirect("index.php?p=giao-hang&a=man&page=".@$_REQUEST['page']."");
		}
		else{
			//echo mysql_error();
			$d->transfer("Cập nhật dữ liệu bị lỗi", "index.php?p=giao-hang&a=man");
		}
	}
	else
	{

		$data['name'] = $d->clear(addslashes($_POST['name']));
		$data['price'] = intval($d->clear(addslashes($_POST['price'])));
		$data['isActive'] = isset($_POST['isActive']) ? 1 : 0;

		$d->setTable('#_delivery_area');
		if($d->insert($data))
		{
			$d->redirect("index.php?p=giao-hang&a=man");
		}
		else{
			echo $d->sql; echo mysql_error();
			 $d->transfer("Thêm dữ liệu bị lỗi!", "index.php?p=giao-hang&a=man");
		}
	}
}

function xoadulieu(){
	global $d;
	if(isset($_GET['id'])){
		$id =  addslashes($_GET['id']);

		$d->reset();
		$d->setTable('#_delivery_area');
		$d->setWhere('id',$id);
		if($d->delete()){
			$d->redirect("index.php?p=giao-hang&a=man&page=".@$_REQUEST['page']."");
		}else{
			$d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=giao-hang&a=man");
		}
	}else $d->transfer("Không nhận được dữ liệu", "index.php?p=giao-hang&a=man");
}

function xoadulieu_image(){
	global $d;
	if(isset($_GET['id'])){
		$id =  addslashes($_GET['id']);
		$hinhanh = $d->o_fet("select * from #_delivery_area where id = '".$id."'");
		@unlink('../img_data/images/'.$hinhanh[0]['image_path']);
		$datahinh['image_path'] = '';
		$d->reset();
		$d->setTable('#_delivery_area');
		$d->setWhere('id',$id);
		if($d->update($datahinh)){
			$d->redirect("index.php?p=giao-hang&a=man&page=".@$_REQUEST['page']."");
		}else{
			$d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=giao-hang&a=man");
		}
	}else $d->transfer("Không nhận được dữ liệu", "index.php?p=giao-hang&a=man");
}

function xoadulieu_mang(){
	global $d;
	if(isset($_POST['chk_child'])){
		$chuoi = "";
		foreach ($_POST['chk_child'] as $val) {
			$chuoi .=$val.',';
		}
		$chuoi = trim($chuoi,',');
		//lay danh sách idsp theo chuoi
		$hinhanh = $d->o_fet("select * from #_delivery_area where id in ($chuoi)");

		if($d->o_que("delete from #_delivery_area where id in ($chuoi)")){
			$d->redirect("index.php?p=giao-hang&a=man&page=".@$_REQUEST['page']."");
		}
		else $d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=giao-hang&a=man");
	}else $d->redirect("index.php?p=giao-hang&a=man&page=".@$_REQUEST['page']."");
}
?>