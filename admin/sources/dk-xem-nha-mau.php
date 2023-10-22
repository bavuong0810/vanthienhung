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
function show_menu_dknhamau_hd($menus = array(), $parrent = 0 ,&$chuoi = '')
{
      foreach ($menus as $val)
      {
          if ($val['category_id'] == $parrent)
          {
             $chuoi .= $val['id'].',';
              show_menu_dknhamau_hd($menus, $val['id'],$chuoi);
          }
      }
      return $chuoi;
}
function showdulieu(){
	global $d, $items, $paging, $loai,$loai_tin,$loai_tin_show , $soluong;
	if($_REQUEST['a'] == 'man'){
		//show du lieu
		if(isset($_GET['lammoi'])){
			$d->o_que("update #_dknhamau set ngay_dang = '".time()."' where id = '".addslashes($_GET['id'])."'");
		}
		if(isset($_GET['loaitin']) && $_GET['loaitin'] <> ''){
			
			if($_GET['loaitin'] == 0){
				$items = $d->o_fet("select * from #_dknhamau order by ngay_dang desc");
			}else{
			    $loaitin = $d->o_fet("select id, category_id from #_loaitintuc where hien_thi = 1");
			    $category_id = show_menu_dknhamau_hd($loaitin,@addslashes($_GET['loaitin']));
			    $category_id = trim($category_id,',');
			    $category_id = @addslashes($_GET['loaitin']) .','.$category_id;
			    $items = $d->o_fet("select * from #_dknhamau where FIND_IN_SET(category_id,'$category_id') <> 0 order by ngay_dang desc");
			}
		}else if(isset($_GET['seach'])){
			$seach = addslashes($_GET['seach']);
			$key = (isset($_GET['key']))? addslashes($_GET['key']):"";
			if($seach == 'id'){
				$items = $d->o_fet("select * from #_dknhamau where id = '".$key."'");
			}else{
				$items = $d->o_fet("select * from #_dknhamau where name_vi like '%$key%'");
			}
		}
		else $items = $d->o_fet("select * from #_dknhamau order by ngay_dang desc");


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
			$items = $d->o_fet("select * from #_dknhamau where id =  '".$id."'");
		}
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

			$image->load('../img_data/images/'.$file);
			$image->resizeToWidth(450);
			$img_resize = $d->fns_Rand_digit(0,9,12)."_thumb";
			$image->save('../img_data/images/'.$img_resize.'.jpg');

			$hinhanh = $d->o_fet("select * from #_dknhamau where id = '".$id."'");
			foreach ($hinhanh as $ha) {
				@unlink('../img_data/images/'.$ha['image_path']);
			}
			$data['image_path'] = $img_resize.".jpg";
		}

		$data['name_vi'] =addslashes($_POST['name_vi']);
		$data['name_en'] =addslashes($_POST['name_en']);
		$data['description_vi'] = addslashes($_POST['description_vi']);
		$data['description_en'] = addslashes($_POST['description_en']);
		$data['content_vi'] = addslashes($_POST['content_vi']);
		$data['content_en'] = addslashes($_POST['content_en']);
		$data['title_vi'] =addslashes($_POST['title_vi']);
		$data['title_en'] =addslashes($_POST['title_en']);
		$data['keyword'] = addslashes($_POST['keyword']);
		$data['tags_hienthi'] = addslashes($_POST['tags_hienthi']);
		//xu ly tags
		$tags = addslashes($_POST['tags_hienthi']);
		$tg2 = explode(',', $tags);
		$id_tag = "";

		foreach ($tg2 as $value) {
		   $kiemtra_tags = $d->o_fet("select name_vi, id from #_tags where name_vi = '".trim($value)."'");
		   if(count($kiemtra_tags) == 0  && trim($value) <> ''){
		   		if($d->o_que("insert into #_tags values('','".trim($value)."','".$d->bodautv($value)."')")){
		   			$id_tag  .= mysql_insert_id().",";
		   		}
		   }else{
	   			$id_tag  .= @$kiemtra_tags[0]['id'].",";
	   		}
		}
		$data['tags'] = trim($id_tag,",");
		//end tags
		$data['des'] = addslashes($_POST['des']);
		$data['hien_thi'] = isset($_POST['hien_thi']) ? 1 : 0;
		$data['noi_bat'] = isset($_POST['noi_bat']) ? 1 : 0;
		$data['alias_vi'] = addslashes(trim($_POST['alias_vi'],"-"));
		$data['alias_en'] = addslashes(trim($_POST['alias_en'],"-"));
		$data['category_id'] = addslashes($_POST['category_id']);

		$data['mo_ta_name_vi'] = addslashes($_POST['mo_ta_name_vi']);
		$data['mo_ta_name_en'] = addslashes($_POST['mo_ta_name_en']);



		$d->setTable('#_dknhamau');
		$d->setWhere('id',$id);
		if($d->update($data)){
			$d->redirect("index.php?p=dk-xem-nha-mau&a=man&page=".@$_REQUEST['page']."&loaitin=".@$_GET['loaitin']);
		}
		else{
			$d->alert("Cập nhật dữ liệu bị lỗi!");
			$d->redirect("Cập nhật dữ liệu bị lỗi", "index.php?p=dk-xem-nha-mau&a=man&loaitin=".@$_GET['loaitin']);
		}
	}
	else
	{


		if(@$file = $d->upload_image("file", '', '../img_data/images/',$file_name)){
			
			$image->load('../img_data/images/'.$file);
			$image->resizeToWidth(450);
			$img_resize = $d->fns_Rand_digit(0,9,12)."_thumb";
			$image->save('../img_data/images/'.$img_resize.'.jpg');

			$data['image_path'] = $img_resize.".jpg";
		}

		$data['name_vi'] =addslashes($_POST['name_vi']);
		$data['name_en'] =addslashes($_POST['name_en']);
		$data['description_vi'] = addslashes($_POST['description_vi']);
		$data['description_en'] = addslashes($_POST['description_en']);
		$data['content_vi'] = addslashes($_POST['content_vi']);
		$data['content_en'] = addslashes($_POST['content_en']);
		$data['title_vi'] =addslashes($_POST['title_vi']);
		$data['title_en'] =addslashes($_POST['title_en']);
		$data['keyword'] = addslashes($_POST['keyword']);
		$data['tags_hienthi'] = addslashes($_POST['tags_hienthi']);
		//xu ly tags
		$tags = addslashes($_POST['tags_hienthi']);
		$tg2 = explode(',', $tags);
		$id_tag = "";

		foreach ($tg2 as $value) {
		   $kiemtra_tags = $d->o_fet("select name_vi, id from #_tags where name_vi = '".trim($value)."'");
		   if(count($kiemtra_tags) == 0  && trim($value) <> ''){
		   		if($d->o_que("insert into #_tags values('','".trim($value)."','".$d->bodautv($value)."')")){
		   			$id_tag  .= mysql_insert_id().",";
		   		}
		   }else{
	   			$id_tag  .= @$kiemtra_tags[0]['id'].",";
	   		}
		}
		$data['tags'] = trim($id_tag,",");
		//end tags
		$data['des'] = addslashes($_POST['des']);
		$data['ngay_dang'] = time();
		$data['hien_thi'] = isset($_POST['hien_thi']) ? 1 : 0;
		$data['noi_bat'] = isset($_POST['noi_bat']) ? 1 : 0;
		$data['alias_vi'] = addslashes(trim($_POST['alias_vi'],"-"));
		$data['alias_en'] = addslashes(trim($_POST['alias_en'],"-"));
		$data['category_id'] = addslashes($_POST['category_id']);
		
		$data['mo_ta_name_vi'] = addslashes($_POST['mo_ta_name_vi']);
		$data['mo_ta_name_en'] = addslashes($_POST['mo_ta_name_en']);


		$d->setTable('#_dknhamau');
		if($d->insert($data))
		{
			$d->redirect("index.php?p=dk-xem-nha-mau&a=man&loaitin=".@$_GET['loaitin']);
		}
		else{
			$d->alert("Thêm dữ liệu bị lỗi!");
			$d->redirect("Thêm dữ liệu bị lỗi", "index.php?p=dk-xem-nha-mau&a=man&loaitin=".@$_GET['loaitin']);
		}
	}
}

function xoadulieu(){
	global $d;
	if(isset($_GET['id'])){
		$id =  addslashes($_GET['id']);
		$hinhanh = $d->o_fet("select * from #_dknhamau where id = '".$id."'");
		@unlink('../img_data/images/'.$hinhanh[0]['image_path']);

		$d->reset();
		$d->setTable('#_dknhamau');
		$d->setWhere('id',$id);
		if($d->delete()){
			$d->redirect("index.php?p=dk-xem-nha-mau&a=man&page=".@$_REQUEST['page']."&loaitin=".@$_GET['loaitin']);
		}else{
			$d->alert("Xóa dữ liệu bị lỗi!");
			$d->redirect("Xóa dữ liệu bị lỗi", "index.php?p=dk-xem-nha-mau&a=man&loaitin=".@$_GET['loaitin']);
		}
	}else {
		$d->alert("Không nhận được dữ liệu!");
		$d->redirect("Xóa dữ liệu bị lỗi", "index.php?p=dk-xem-nha-mau&a=man&loaitin=".@$_GET['loaitin']);
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
		$hinhanh = $d->o_fet("select * from #_dknhamau where id in ($chuoi)");
		if($d->o_que("delete from #_dknhamau where id in ($chuoi)")){
			//xoa hình ảnh
			foreach ($hinhanh as $ha) {
				@unlink('../img_data/images/'.$ha['image_path']);

			}
			$d->redirect("index.php?p=dk-xem-nha-mau&a=man&page=".@$_REQUEST['page']."&loaitin=".@$_GET['loaitin']);
		}
		else{
			$d->alert("Không nhận được dữ liệu!");
			$d->redirect("Xóa dữ liệu bị lỗi", "index.php?p=dk-xem-nha-mau&a=man&loaitin=".@$_GET['loaitin']);
		} 
	}else $d->redirect("index.php?p=dk-xem-nha-mau&a=man&page=".@$_REQUEST['page']."&loaitin=".@$_GET['loaitin']);
}
?>