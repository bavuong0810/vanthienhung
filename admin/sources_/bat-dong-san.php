<?php
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
	$str['extra0'] = $d->o_fet("select * from #_extra where type=0 and hide=1 order by stt asc,id desc");
	return $str;
}

function showdulieu(){
	global $d, $items, $paging,$loai;
	$loai = $d->array_category(0,'',$_GET['category_id'],4);
	
	if($_REQUEST['a'] == 'man'){

		//show du lieu
		if(isset($_GET['category_id']) && $_GET['category_id'] <> ''){
			
			if($_GET['category_id'] == 0){
				$items = $d->o_fet("select * from #_sanpham where style=1 order by so_thu_tu asc, id desc");
			}else{
				$category_id = $_GET['category_id'].$d->findIdSub($_GET['category_id']);	
			    $items = $d->o_fet("select * from #_sanpham where FIND_IN_SET(category_id,'$category_id') <> 0 and style=1 order by so_thu_tu asc, id desc");
			}
		}
		else if(isset($_GET['seach'])){
			$seach = addslashes($_GET['seach']);
			$key = (isset($_GET['key']))? addslashes($_GET['key']):"";
			if($seach == 'id'){
				$items = $d->o_fet("select * from #_sanpham where id = '".$key."' and style=1");
			}else if($seach == 'name'){
				$items = $d->o_fet("select * from #_sanpham where name_vi like '%".$key."%' and style=1");
			}else{
				$items = $d->o_fet("select * from #_sanpham where code like '%".$key."%' and style=1");
			}
		}
		else $items = $d->o_fet("select * from #_sanpham where style=1 order by ngay_dang desc");

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
			$loai = $d->array_category(0,'',$items[0]['category_id'],4);
		}
	}

}

function luudulieu(){
	global $d;


	$id = (isset($_REQUEST['id'])) ? addslashes($_REQUEST['id']) : "";
	$file_name=$d->fns_Rand_digit(0,9,12);
	if($id != '')
	{
		if(@$file = $d->upload_image("file2", '', '../img_data/images/',$file_name)){


			$hinhanh = $d->o_fet("select * from #_sanpham where id = '".$id."'");
			unlink('../img_data/images/'.$hinhanh[0]['image_path']);

			$data['image_path'] = $file;
		}

		$data['category_id'] = addslashes($_POST['category_id']);
		$data['code'] = $d->clear(addslashes($_POST['code']));

		$data['name_vi'] = $d->clear(addslashes($_POST['name_vi']));
		$data['name_en'] = $d->clear(addslashes($_POST['name_en']));
		$data['name_ch'] = $d->clear(addslashes($_POST['name_ch']));

		$data['description_vi'] = $d->clear(addslashes($_POST['description_vi']));
		$data['description_en'] = $d->clear(addslashes($_POST['description_en']));
		$data['description_ch'] = $d->clear(addslashes($_POST['description_ch']));

		$data['price'] = $d->clear(addslashes($_POST['price']));

		$data['promotion_price'] = $d->clear(addslashes($_POST['promotion_price']));

		$data['description_2'] = $d->clear(addslashes($_POST['description_2']));
		$data['content_en'] = $d->clear(addslashes($_POST['content_en']));
		$data['content_ch'] = $d->clear(addslashes($_POST['content_ch']));

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

		$data['title_vi'] = $d->clear(addslashes($_POST['title_vi']));
		$data['title_en'] = $d->clear(addslashes($_POST['title_en']));
		$data['title_ch'] = $d->clear(addslashes($_POST['title_ch']));

		$data['keyword'] = $d->clear(addslashes($_POST['keyword']));
		$data['des'] = $d->clear(addslashes($_POST['des']));
		
		$data['extra0'] = addslashes($_POST['extra0']);


		$data['hien_thi'] = isset($_POST['hien_thi']) ? 1 : 0;
		$data['is_hot'] = isset($_POST['is_hot']) ? 1 : 0;
		$data['sp_moi'] = isset($_POST['sp_moi']) ? 1 : 0;
		$data['sp_hot'] = isset($_POST['sp_hot']) ? 1 : 0;


		$d->reset();
		$d->setTable('#_sanpham');
		$d->setWhere('id',$id);
		if($d->update($data)){
			//add thong so
			$hang = trim($hang,",");

			/////up hinh
	    	for ($i=1; $i <= 15; $i++) { 
	    		if(isset($_POST['txt_up_'.$i]) && $_POST['txt_up_'.$i] == 1){
	    			$file_name=$d->fns_Rand_digit(0,9,12);
	    			if(@$file = $d->upload_image("file_".$i, '', '../img_data/images/',$file_name)){
						$data_hinh['image_path'] = $file;
						$data_hinh['title'] = $_REQUEST['title'.$i];
			    		$data_hinh['id_sp'] = $id;
						$d->reset();
						$d->setTable('#_sanpham_hinhanh');
						$d->insert($data_hinh);
					}
	    		}
	    	}

        	///
			$d->redirect("index.php?p=bat-dong-san&a=man&page=".@$_REQUEST['page']."");
		}
		else{
			echo mysql_error();	
			 $d->transfer("Cập nhật dữ liệu bị lỗi", "index.php?p=bat-dong-san&a=man");
		}
	}
	else
	{
		if(@$file = $d->upload_image("file2", '', '../img_data/images/',$file_name)){
			
			$data['image_path'] = $file;
		}
		$data['category_id'] = addslashes($_POST['category_id']);
		$data['code'] = $d->clear(addslashes($_POST['code']));

		$data['name_vi'] = $d->clear(addslashes($_POST['name_vi']));
		$data['name_en'] = $d->clear(addslashes($_POST['name_en']));
		$data['name_ch'] = $d->clear(addslashes($_POST['name_ch']));

		$data['description_vi'] = $d->clear(addslashes($_POST['description_vi']));
		$data['description_en'] = $d->clear(addslashes($_POST['description_en']));
		$data['description_ch'] = $d->clear(addslashes($_POST['description_ch']));

		$data['price'] = $d->clear(addslashes($_POST['price']));

		$data['promotion_price'] = $d->clear(addslashes($_POST['promotion_price']));

		$data['description_2'] = $d->clear(addslashes($_POST['description_2']));
		$data['content_en'] = $d->clear(addslashes($_POST['content_en']));
		$data['content_ch'] = $d->clear(addslashes($_POST['content_ch']));

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

		$data['title_vi'] = $d->clear(addslashes($_POST['title_vi']));
		$data['title_en'] = $d->clear(addslashes($_POST['title_en']));
		$data['title_ch'] = $d->clear(addslashes($_POST['title_ch']));

		$data['keyword'] = $d->clear(addslashes($_POST['keyword']));
		$data['des'] = $d->clear(addslashes($_POST['des']));
	
		$data['extra0'] = addslashes($_POST['extra0']);


		$data['style'] = 1;
		
		$data['hien_thi'] = isset($_POST['hien_thi']) ? 1 : 0;
		$data['is_hot'] = isset($_POST['is_hot']) ? 1 : 0;
		$data['sp_moi'] = isset($_POST['sp_moi']) ? 1 : 0;
		$data['sp_hot'] = isset($_POST['sp_hot']) ? 1 : 0;

		$data['ngay_dang'] = time();

		
		$d->setTable('#_sanpham');
		if($d->insert($data))
		{
			$idsp = mysql_insert_id();
			/////up hinh
			
	    	for ($i=1; $i <= 15; $i++) { 
	    		$file_name=$d->fns_Rand_digit(0,9,12);
	    		if(isset($_POST['txt_up_'.$i]) && $_POST['txt_up_'.$i] == 1){
	    			if(@$file = $d->upload_image("file_".$i, '', '../img_data/images/',$file_name)){
						$data_hinh['image_path'] = $file;
						$data_hinh['title'] = $_REQUEST['title'.$i];
			    		$data_hinh['id_sp'] = $idsp;
						$d->reset();
						$d->setTable('#_sanpham_hinhanh');
						$d->insert($data_hinh);
					}
	    		}
	    	}

        	///
			$d->redirect("index.php?p=bat-dong-san&a=man");
		}
		else{
			echo mysql_error();
			$d->transfer("Thêm dữ liệu bị lỗi!", "index.php?p=bat-dong-san&a=man");
		}
	}
}

function xoadulieu(){
	global $d;
	if(isset($_GET['id'])){
		$id =  addslashes($_GET['id']);
		//xoa img
		$hinhanh = $d->o_fet("select * from #_sanpham where id = '".$id."'");
		foreach ($hinhanh as $ha) {
			@unlink('../img_data/images/'.$ha['image_path']);
		}
		//xoa size
			$d->o_que("delete from #_sanpham_detail where id_sp = '".$id."'");
		//
		// xoa anh chi tiet
		$hinhanh_chitiet = $d->o_fet("select * from #_sanpham_hinhanh where id_sp = '".$id."'");
		$d->o_que("delete from #_sanpham_hinhanh where id_sp = '".$id."'");
		foreach ($hinhanh_chitiet as $hact) {
			@unlink('../img_data/images/'.$hact['image_path']);
		}
		// end
		//xoa hinhanh
		$hinhanh = $d->o_fet("select * from #_sanpham_hinhanh where id_sp = '".$id."'");
		foreach ($hinhanh as $ha) {
			@unlink('../img_data/images/'.$ha['image_path']);
			
		}
		// end
		if($d->o_que("delete from #_sanpham where id='".$id."'")){
			$d->redirect("index.php?p=bat-dong-san&a=man&page=".@$_REQUEST['page']."");
		}else
			$d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=bat-dong-san&a=man");
	}else $d->transfer("Không nhận được dữ liệu", "index.php?p=bat-dong-san&a=man");
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
		$hinhanh = $d->o_fet("select * from #_sanpham where id in ($chuoi)");
		$hinhanh2 = $d->o_fet("select * from #_sanpham_hinhanh where category_id in ($chuoi)");
		if($d->o_que("delete from #_sanpham where id in ($chuoi)")){
			//xoa hình ảnh
			foreach ($hinhanh as $ha) {
				@unlink('../img_data/images/'.$ha['image_path']);
			}
			//xoa size
			$d->o_que("delete from #_sanpham_detail where id_sp in ($chuoi)");
			//
			// xoa anh chi tiet
			$hinhanh_chitiet = $d->o_fet("select * from #_sanpham_hinhanh where id_sp in ($chuoi)");
			$d->o_que("delete from #_sanpham_hinhanh where id_sp in ($chuoi)");
			foreach ($hinhanh_chitiet as $hact) {
				@unlink('../img_data/images/'.$hact['image_path']);
			}
			//xoaha2
			foreach ($hinhanh2 as $ha) {
				@unlink('../img_data/images/'.$ha['image_path']);
			}
			$d->redirect("index.php?p=bat-dong-san&a=man&page=".@$_REQUEST['page']."");
		}
		else $d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=bat-dong-san&a=man");
	}else $d->redirect("index.php?p=bat-dong-san&a=man&page=".@$_REQUEST['page']."");
}
?>