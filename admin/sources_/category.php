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
	global $d, $items, $paging, $loai,$hang,$loaibv,$soluong,$module;
	$module = $d->o_fet("select * from #_module where hide = 1 order by stt asc,id desc");

	if($_REQUEST['a'] == 'man'){
		$loaibv = $d->array_category(0,'','',0);
		//show du lieu
		if(isset($_GET['seach'])){
			$seach = addslashes($_GET['seach']);
			$key = (isset($_GET['key']))? addslashes($_GET['key']):"";
			if($seach == 'id'){
				$items = $d->o_fet("select * from #_category where id = '".$key."'");
			}else{
				$key = $d->bodautv($key);
				$items = $d->o_fet("select * from #_category where alias_vi like '%".$key."%'");
			}
		}
		else $items = $d->o_fet("select * from #_category where category_id = 0 order by so_thu_tu asc, id desc");


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
			$items = $d->o_fet("select * from #_category where id =  '".$id."'");
		}
		$loaibv = $d->array_category(0,'',$items[0]['category_id'],0,$items[0]['id']);

		
		$soluong = $loai = $d->o_fet("select * from #_category");
		
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

		
		if(@$file = $d->upload_image("file", '', '../img_data/images/',$file_name)){

			$hinhanh = $d->o_fet("select * from #_category where id = '".$id."'");
			@unlink('../img_data/images/'.$hinhanh[0]['image_path']);
			$data['image_path'] = $file;
		}


		$level=$d->simple_fetch("select * from #_category where id={$_POST['category_id']}");
		$data['level'] = ($level['level']!='') ? $level['level']+1 : 0;
		
		$data['category_id'] = addslashes($_POST['category_id']);

		$data['name_vi'] = $d->clear(addslashes($_POST['name_vi']));
		$data['name_en'] = $d->clear(addslashes($_POST['name_en']));
		$data['name_ch'] = $d->clear(addslashes($_POST['name_ch']));
		
		$data['alias_vi'] = $d->clear(addslashes($_POST['alias_vi']));
		if($d->checkLink($data['alias_vi'],"alias_vi",$id ) && $data['alias_vi']!='') {
			$data['alias_vi'].="-".rand(0,99);
		}

		$data['alias_en'] = $d->clear(addslashes($_POST['alias_en']));
		if($d->checkLink($data['alias_en'],"alias_en",$id ) && $data['alias_en']!='') {
			$data['alias_en'].="-".rand(0,99);
		}	
		
		$data['alias_ch'] = $d->clear(addslashes($_POST['alias_ch']));
		if($d->checkLink($data['alias_ch'],"alias_ch",$id ) && $data['alias_ch']!='') {
			$data['alias_ch'].="-".rand(0,99);
		}

		$data['description_vi'] = $d->clear(addslashes($_POST['description_vi']));
		$data['description_en'] = $d->clear(addslashes($_POST['description_en']));
		$data['description_ch'] = $d->clear(addslashes($_POST['description_ch']));
		
		$data['content_vi'] = $d->clear(addslashes($_POST['content_vi']));
		$data['content_en'] = $d->clear(addslashes($_POST['content_en']));
		$data['content_ch'] = $d->clear(addslashes($_POST['content_ch']));
		
		
		$data['module'] = addslashes($_POST['module']);
		$data['so_thu_tu'] = addslashes($_POST['so_thu_tu']);
		$data['hien_thi'] = isset($_POST['hien_thi']) ? 1 : 0;
		// $data['ordering'] = addslashes($_POST['ordering']);


		$data['title_vi'] =$d->clear(addslashes($_POST['title_vi']));
		$data['title_en'] =$d->clear(addslashes($_POST['title_en']));
		$data['title_ch'] =$d->clear(addslashes($_POST['title_ch']));		
		$data['keyword'] = $d->clear(addslashes($_POST['keyword']));
		$data['des'] = $d->clear(addslashes($_POST['des']));
		$d->setTable('#_category');
		$d->setWhere('id',$id);
		if($d->update($data)){
			$d->redirect("index.php?p=category&a=man&page=".@$_REQUEST['page']."");
		}
		else{
			//echo mysql_error();
			$d->transfer("Cập nhật dữ liệu bị lỗi", "index.php?p=category&a=man");
		}
	}
	else
	{

		if(@$file = $d->upload_image("file", '', '../img_data/images/',$file_name)){
			$data['image_path'] = $file;
		}
		$level=$d->simple_fetch("select * from #_category where id={$_POST['category_id']}");
		$data['level'] = ($level['level']!='') ? $level['level']+1 : 0;
		
		$data['category_id'] = addslashes($_POST['category_id']);

		$data['name_vi'] = $d->clear(addslashes($_POST['name_vi']));
		$data['name_en'] = $d->clear(addslashes($_POST['name_en']));
		$data['name_ch'] = $d->clear(addslashes($_POST['name_ch']));
		
		$data['alias_vi'] = $d->clear(addslashes($_POST['alias_vi']));
		if($d->checkLink($data['alias_vi'],"alias_vi",$id ) && $data['alias_vi']!='') {
			$data['alias_vi'].="-".rand(0,9);
		}

		$data['alias_en'] = $d->clear(addslashes($_POST['alias_en']));
		if($d->checkLink($data['alias_en'],"alias_en",$id ) && $data['alias_en']!='') {
			$data['alias_en'].="-".rand(0,9);
		}	
		
		$data['alias_ch'] = $d->clear(addslashes($_POST['alias_ch']));
		if($d->checkLink($data['alias_ch'],"alias_ch",$id ) && $data['alias_ch']!='') {
			$data['alias_ch'].="-".rand(0,9);
		}

		$data['description_vi'] = $d->clear(addslashes($_POST['description_vi']));
		$data['description_en'] = $d->clear(addslashes($_POST['description_en']));
		$data['description_ch'] = $d->clear(addslashes($_POST['description_ch']));
		
		$data['content_vi'] = $d->clear(addslashes($_POST['content_vi']));
		$data['content_en'] = $d->clear(addslashes($_POST['content_en']));
		$data['content_ch'] = $d->clear(addslashes($_POST['content_ch']));
		

		
		$data['module'] = addslashes($_POST['module']);
		$data['so_thu_tu'] = addslashes($_POST['so_thu_tu']);
		// $data['ordering'] = addslashes($_POST['ordering']);
		$data['hien_thi'] = isset($_POST['hien_thi']) ? 1 : 0;


		$data['title_vi'] =$d->clear(addslashes($_POST['title_vi']));
		$data['title_en'] =$d->clear(addslashes($_POST['title_en']));
		$data['title_ch'] =$d->clear(addslashes($_POST['title_ch']));		
		$data['keyword'] = $d->clear(addslashes($_POST['keyword']));
		$data['des'] = $d->clear(addslashes($_POST['des']));

		$d->setTable('#_category');
		if($d->insert($data))
		{
			$d->redirect("index.php?p=category&a=man");
		}
		else{
			echo $d->sql; echo mysql_error();
			 $d->transfer("Thêm dữ liệu bị lỗi!", "index.php?p=category&a=man");
		}
	}
}

function xoadulieu(){
	global $d;
	if(isset($_GET['id'])){
		$id =  addslashes($_GET['id']);
		$hinhanh = $d->o_fet("select * from #_category where id = '".$id."'");
		@unlink('../img_data/images/'.$hinhanh[0]['image_path']);

		$d->reset();
		$d->setTable('#_category');
		$d->setWhere('id',$id);
		if($d->delete()){
			$d->redirect("index.php?p=category&a=man&page=".@$_REQUEST['page']."");
		}else{
			$d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=category&a=man");
		}
	}else $d->transfer("Không nhận được dữ liệu", "index.php?p=category&a=man");
}

function xoadulieu_image(){
	global $d;
	if(isset($_GET['id'])){
		$id =  addslashes($_GET['id']);
		$hinhanh = $d->o_fet("select * from #_category where id = '".$id."'");
		@unlink('../img_data/images/'.$hinhanh[0]['image_path']);
		$datahinh['image_path'] = '';
		$d->reset();
		$d->setTable('#_category');
		$d->setWhere('id',$id);
		if($d->update($datahinh)){
			$d->redirect("index.php?p=category&a=man&page=".@$_REQUEST['page']."");
		}else{
			$d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=category&a=man");
		}
	}else $d->transfer("Không nhận được dữ liệu", "index.php?p=category&a=man");
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
		$hinhanh = $d->o_fet("select * from #_category where id in ($chuoi)");

		if($d->o_que("delete from #_category where id in ($chuoi)")){
			//xoa hình ảnh
			foreach ($hinhanh as $ha) {
				@unlink('../img_data/images/'.$ha['image_path']);

			}
			$d->redirect("index.php?p=category&a=man&page=".@$_REQUEST['page']."");
		}
		else $d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=category&a=man");
	}else $d->redirect("index.php?p=category&a=man&page=".@$_REQUEST['page']."");
}
?>