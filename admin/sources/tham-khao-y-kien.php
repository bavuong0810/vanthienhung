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
function show_menu_cauhoi_hd($menus = array(), $parrent = 0 ,&$chuoi = '')
{
      foreach ($menus as $val)
      {
          if ($val['category_id'] == $parrent)
          {
             $chuoi .= $val['id'].',';
              show_menu_cauhoi_hd($menus, $val['id'],$chuoi);
          }
      }
      return $chuoi;
}
function showdulieu(){
	global $d, $items, $paging, $loai,$loai_tin,$loai_tin_show , $soluong;
	if($_REQUEST['a'] == 'man'){
		//show du lieu
		//show du lieu
		if(isset($_GET['seach'])){
			$seach = addslashes($_GET['seach']);
			$key = (isset($_GET['key']))? addslashes($_GET['key']):"";
			if($seach == 'id'){
				$items = $d->o_fet("select * from #_cauhoi where id = '".$key."'");
			}else{
				$items = $d->o_fet("select * from #_cauhoi where name_vi like '%$key%'");
			}
		}
		else $items = $d->o_fet("select * from #_cauhoi order by id desc");


		if(isset($_GET['hienthi'])){
			$maxR= $d->lay_show_hienthi(addslashes($_GET['hienthi']));
		}
		else $maxR=35;
		// phan trang
		$page = isset($_GET['page']) ? addslashes($_GET['page']) : 1;
		$url=$d->fullAddress();
		$maxP= $maxR;
		$paging=$d->phantrang($items, $url, $page, $maxR, $maxP,'classunlink','classlink','page');
		$items=$paging['source'];
		//
	}else{
		//lay noi dung theo id
		if(isset($_REQUEST['id'])){
			@$id = addslashes($_REQUEST['id']);
			$items = $d->o_fet("select * from #_cauhoi where id =  '".$id."'");
		}
		$soluong =  $d->o_fet("select * from #_cauhoi");
	}
}

function luudulieu(){
	global $d;
	$id = (isset($_REQUEST['id'])) ? addslashes($_REQUEST['id']) : "";
	$file_name=$d->fns_Rand_digit(0,9,12);
	if($id != '')
	{
		if(@$file = $d->upload_image("file", '', '../img_data/images/',$file_name)){
			$data['image_path'] = $file;
			$hinhanh = $d->o_fet("select * from #_cauhoi where id = '".$id."'");
			foreach ($hinhanh as $ha) {
			@unlink('../img_data/images/'.$ha['image_path']);
			}//end img
		}

		$data['name_vi'] =addslashes($_POST['name_vi']);
		$data['name_en'] =addslashes($_POST['name_en']);
		$data['ngay_dang'] = date('d-m-Y h:m:s');
		$data['so_thu_tu'] =addslashes($_POST['so_thu_tu']);
		$data['hien_thi'] = isset($_POST['hien_thi']) ? 1 : 0;


		$d->reset();
		$d->setTable('#_cauhoi');
		$d->setWhere('id',$id);
		if($d->update($data)){
			//add cau tra loi
			// update cau cu
			$cau_tl_cu = $d->o_fet("select * from #_cauhoi_detail where category_id = '".$id."'");
			foreach ($cau_tl_cu as $tl_c) {
				$nd_c = addslashes($_POST['cau_cu_'.$tl_c['id']]);
				$nd_c_us = addslashes($_POST['cau_cu_us_'.$tl_c['id']]);
				if($nd_c == ''){
					$d->o_que("delete from #_cauhoi_detail where id = '".$tl_c['id']."'");
				}else $d->o_que("update #_cauhoi_detail set name_vi = '".$nd_c."', name_en = '".$nd_c_us."' where id = '".$tl_c['id']."'");
				
				
			}
			// end
			$cautraloi = $_POST['cau_tra_loi'];
			$cautraloi_us = $_POST['cau_tra_loi_us'];
			// foreach ($cautraloi as $value) {
			for ($i=0; $i < count($cautraloi); $i++) { 
				if($cautraloi[$i] <> ""){
					$d->reset();
					$data2['name_vi'] = $cautraloi[$i];
					$data2['name_en'] = $cautraloi_us[$i];


					$data2['category_id'] = $id;
					$d->setTable('#_cauhoi_detail');
					$d->insert($data2);
				}
			}
			//end
			$d->redirect("index.php?p=".@$_GET['p']."&a=man&page=".@$_REQUEST['page']."");
		}
		else{
			 $d->transfer("Cập nhật dữ liệu bị lỗi", "index.php?p=".@$_GET['p']."&a=man");
		}
	}
	else
	{
		if(@$file = $d->upload_image("file", '', '../img_data/images/',$file_name)){
			$data['image_path'] = $file;
		}

		$data['name_vi'] =addslashes($_POST['name_vi']);
		$data['name_en'] =addslashes($_POST['name_en']);
		$data['ngay_dang'] = date('d-m-Y h:m:s');
		$data['so_thu_tu'] =addslashes($_POST['so_thu_tu']);
		$data['hien_thi'] = isset($_POST['hien_thi']) ? 1 : 0;

		$d->reset();
		$d->setTable('#_cauhoi');
		if($d->insert($data))
		{
			//add cau tra loi
			$id = mysql_insert_id();
			$cautraloi = $_POST['cau_tra_loi'];
			$cautraloi_us = $_POST['cau_tra_loi_us'];
			// foreach ($cautraloi as $value) {
			for ($i=0; $i < count($cautraloi); $i++) { 
			// foreach ($cautraloi as $value) {
				if($cautraloi[$i] <> ""){
					$d->reset();
					$data2['name_vi'] = $cautraloi[$i];
					$data2['name_en'] = $cautraloi_us[$i];
					$data2['category_id'] = $id;
					$d->setTable('#_cauhoi_detail');
					$d->insert($data2);
				}
			}
			//end
			$d->redirect("index.php?p=".@$_GET['p']."&a=man");
		}
		else{
			 $d->transfer("Thêm dữ liệu bị lỗi!", "index.php?p=".@$_GET['p']."&a=man");
		}
	}
}

function xoadulieu(){
	global $d;
	if(isset($_GET['id'])){
		$id =  addslashes($_GET['id']);
		$hinhanh = $d->o_fet("select * from #_cauhoi where id = '".$id."'");
		@unlink('../img_data/images/'.$hinhanh[0]['image_path']);

		$d->reset();
		$d->setTable('#_cauhoi');
		$d->setWhere('id',$id);
		if($d->delete()){
			$d->o_que("delete from #_cauhoi_detail where category_id = '".$id."'");

			$d->redirect("index.php?p=".@$_GET['p']."&a=man&page=".@$_REQUEST['page']."");
		}else{
			$d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=".@$_GET['p']."&a=man");
		}
	}else $d->transfer("Không nhận được dữ liệu", "index.php?p=".@$_GET['p']."&a=man");
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
		$hinhanh = $d->o_fet("select * from #_cauhoi where id in ($chuoi)");
		if($d->o_que("delete from #_cauhoi where id in ($chuoi)")){
			//xoa hình ảnh
			$d->o_que("delete from #_cauhoi_detail where category_id in ($chuoi)");
			foreach ($hinhanh as $ha) {
				@unlink('../img_data/images/'.$ha['image_path']);

			}
			$d->redirect("index.php?p=".@$_GET['p']."&a=man&page=".@$_REQUEST['page']."");
		}
		else $d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=".@$_GET['p']."&a=man");
	}else $d->redirect("index.php?p=".@$_GET['p']."&a=man&page=".@$_REQUEST['page']."");
}
?>