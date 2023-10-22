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
	case "delete_all":
		xoadulieu_mang();
		break;
	default:
		$template = "index";
}

function showdulieu(){
	global $d, $items, $paging ;

	if($_REQUEST['a'] == 'man'){

		$query = "select * from #_tags order by id asc";

		if(isset($_GET['hienthi'])){
			$maxR= $d->lay_show_hienthi(addslashes($_GET['hienthi']));
		}
		else $maxR=35;
		$page = isset($_GET['page']) && $_GET['page'] > 1 ? addslashes($_GET['page']) : 1;
		$offset = ($page - 1) * $maxR;

		// get total records for paging
		$queryCount = str_replace('*', 'count(id) as totalRecords', $query);

		$countResult = $d->o_fet($queryCount);
		$totalRecords = $countResult[0]['totalRecords'];

		// get items
		$query .= " limit $offset, $maxR";
		$items = $d->o_fet($query);

		// phan trang
		$url=$d->fullAddress();
		$maxP= $maxR;
		$paging=$d->phantrang($totalRecords, $url, $page, $maxR, $maxP,'classunlink','classlink','page');

	}else{
		//lay noi dung theo id
		if(isset($_REQUEST['id'])){
			@$id = addslashes($_REQUEST['id']);
			$items = $d->o_fet("select * from #_tags where id =  '".$id."'");
		}
	}
}

function luudulieu(){
	global $d;

	$id = (isset($_REQUEST['id'])) ? addslashes($_REQUEST['id']) : "";
	$file_name=$d->fns_Rand_digit(0,9,12);
	if($id != '')
	{

		// if(@$file = $d->upload_image("file", '', '../img_data/images/',$file_name)){

		// 	$hinhanh = $d->o_fet("select * from #_tags where id = '".$id."'");
		// 	foreach ($hinhanh as $ha) {
		// 		@unlink('../img_data/images/'.$ha['image_path']);
		// 	}
		// 	$data['image_path'] = $file;
		// }

		$data['name_vi'] =$d->clear(addslashes($_POST['name_vi']));
		// $data['name_en'] =$d->clear(addslashes($_POST['name_en']));
		// $data['name_ch'] =$d->clear(addslashes($_POST['name_ch']));
		// $data['content_vi'] = $d->clear(addslashes($_POST['content_vi']));
		// $data['content_vi'] = $_POST['content_vi'];
		// $data['content_en'] = $d->clear(addslashes($_POST['content_en']));
		// $data['content_ch'] = $d->clear(addslashes($_POST['content_ch']));
		// $data['link'] = $d->clear(addslashes($_POST['link']));
		// $data['hien_thi'] = isset($_POST['hien_thi']) ? 1 : 0;


		$d->setTable('#_tags');
		$d->setWhere('id',$id);
		if($d->update($data)){
			$d->redirect("index.php?p=tags&a=man&page=".@$_REQUEST['page']);
		}
		else{
			$d->alert("Cập nhật dữ liệu bị lỗi!");
			$d->redirect("Cập nhật dữ liệu bị lỗi", "index.php?p=tags&a=man");
		}
	}
	else
	{


		if(@$file = $d->upload_image("file", '', '../img_data/images/',$file_name)){
			
			$data['image_path'] = $file;
		}

		$data['name_vi'] =$d->clear(addslashes($_POST['name_vi']));
		// $data['name_en'] =$d->clear(addslashes($_POST['name_en']));
		// $data['name_ch'] =$d->clear(addslashes($_POST['name_ch']));
		// $data['content_vi'] = $d->clear(addslashes($_POST['content_vi']));
		// $data['content_en'] = $d->clear(addslashes($_POST['content_en']));
		// $data['content_ch'] = $d->clear(addslashes($_POST['content_ch']));
		// $data['hien_thi'] = isset($_POST['hien_thi']) ? 1 : 0;
		// $data['link'] = $d->clear(addslashes($_POST['link']));

		$d->setTable('#_tags');
		
		if($d->insert($data))
		{
			$d->redirect("index.php?p=tags&a=man");
		}
		else{

			$d->alert("Thêm dữ liệu bị lỗi!");
			$d->redirect("Thêm dữ liệu bị lỗi", "index.php?p=tags&a=man");
		}
	}
}

function xoadulieu(){
	global $d;
	if(isset($_GET['id'])){
		$id =  addslashes($_GET['id']);
		$hinhanh = $d->o_fet("select * from #_tags where id = '".$id."'");
		@unlink('../img_data/images/'.$hinhanh[0]['image_path']);

		$d->reset();
		$d->setTable('#_tags');
		$d->setWhere('id',$id);
		if($d->delete()){
			$d->redirect("index.php?p=tags&a=man&page=".@$_REQUEST['page']);
		}else{
			$d->alert("Xóa dữ liệu bị lỗi!");
			$d->redirect("Xóa dữ liệu bị lỗi", "index.php?p=tags&a=man");
		}
	}else {
		$d->alert("Không nhận được dữ liệu!");
		$d->redirect("Xóa dữ liệu bị lỗi", "index.php?p=tags&a=man");
	}
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
		$hinhanh = $d->o_fet("select * from #_tags where id in ($chuoi)");
		if($d->o_que("delete from #_tags where id in ($chuoi)")){
			//xoa hình ảnh
			foreach ($hinhanh as $ha) {
				@unlink('../img_data/images/'.$ha['image_path']);

			}
			$d->redirect("index.php?p=tags&a=man&page=".@$_REQUEST['page']);
		}
		else{
			$d->alert("Không nhận được dữ liệu!");
			$d->redirect("Xóa dữ liệu bị lỗi", "index.php?p=tags&a=man");
		} 
	}else $d->redirect("index.php?p=tags&a=man&page=".@$_REQUEST['page']);
}
?>