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
function show_menu_tintuc_hd($menus = array(), $parrent = 0 ,&$chuoi = '')
{
      foreach ($menus as $val)
      {
          if ($val['category_id'] == $parrent)
          {
             $chuoi .= $val['id'].',';
              show_menu_tintuc_hd($menus, $val['id'],$chuoi);
          }
      }
      return $chuoi;
}
function showdulieu(){
	global $d, $items, $paging, $loai, $soluong;
	$loai = $d->array_category(0,'',$_GET['loaitin'],2);
	if($_REQUEST['a'] == 'man'){
	
		//show du lieu
		if(isset($_GET['lammoi'])){
			$d->o_que("update #_tintuc set ngay_dang = '".time()."' where id = '".addslashes($_GET['id'])."'");
		}
		if(isset($_GET['loaitin']) && $_GET['loaitin'] <> ''){
			
			if($_GET['loaitin'] == 0){
				$items = $d->o_fet("select * from #_tintuc order by so_thu_tu asc, ngay_dang desc, id desc");
			}else{
			    $loaitin = $d->o_fet("select id, category_id from #_category where hien_thi = 1");
			    $category_id = show_menu_tintuc_hd($loaitin,@addslashes($_GET['loaitin']));
			    $category_id = trim($category_id,',');
			    $category_id = @addslashes($_GET['loaitin']) .','.$category_id;
			    $items = $d->o_fet("select * from #_tintuc where FIND_IN_SET(category_id,'$category_id') <> 0 order by so_thu_tu asc, ngay_dang desc, id desc");
			}
		}else if(isset($_GET['seach'])){
			$seach = addslashes($_GET['seach']);
			$key = (isset($_GET['key']))? addslashes($_GET['key']):"";
			if($seach == 'id'){
				$items = $d->o_fet("select * from #_tintuc where id = '".$key."'");
			}else{
				$key = $d->bodautv($key);
				$items = $d->o_fet("select * from #_tintuc where alias_vi like '%$key%' order by so_thu_tu asc, ngay_dang desc, id desc");
			}
		}
		else $items = $d->o_fet("select * from #_tintuc order by so_thu_tu asc, ngay_dang desc, id desc");


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
			$items = $d->o_fet("select * from #_tintuc where id =  '".$id."'");
			$loai = $d->array_category(0,'',$items[0]['category_id'],2);
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

			$hinhanh = $d->o_fet("select * from #_tintuc where id = '".$id."'");
			foreach ($hinhanh as $ha) {
				@unlink('../img_data/images/'.$ha['image_path']);
			}
			$data['image_path'] = $file;
		}
		$data['category_id'] = addslashes($_POST['category_id']);

		$data['name_vi'] = $d->clear(addslashes($_POST['name_vi']));
		$data['name_en'] = $d->clear(addslashes($_POST['name_en']));
		$data['name_ch'] = $d->clear(addslashes($_POST['name_ch']));
		$data['description_vi'] = $d->clear(addslashes($_POST['description_vi']));
		$data['description_en'] = $d->clear(addslashes($_POST['description_en']));
		$data['description_ch'] = $d->clear(addslashes($_POST['description_ch']));
		$data['content_vi'] = $d->clear(addslashes($_POST['content_vi']));
		$data['content_en'] = $d->clear(addslashes($_POST['content_en']));
		$data['content_ch'] = $d->clear(addslashes($_POST['content_ch']));
		
		$data['alias_vi'] = $d->clear(addslashes($_POST['alias_vi']));
		if($d->checkLink($data['alias_vi'],"alias_vi",$id ) && $data['alias_vi']!='') {
			$data['alias_vi'].="-".rand(10,999);
		}

		$data['alias_en'] = $d->clear(addslashes($_POST['alias_en']));
		if($d->checkLink($data['alias_en'],"alias_en",$id ) && $data['alias_en']!='') {
			$data['alias_en'].="-".rand(10,999);
		}	
		
		$data['alias_ch'] = $d->clear(addslashes($_POST['alias_ch']));
		if($d->checkLink($data['alias_ch'],"alias_ch",$id ) && $data['alias_ch']!='') {
			$data['alias_ch'].="-".rand(10,999);
		}
		
		
		$data['title_vi'] = $d->clear(addslashes($_POST['title_vi']));
		$data['title_en'] = $d->clear(addslashes($_POST['title_en']));
		$data['title_ch'] = $d->clear(addslashes($_POST['title_ch']));
		$data['keyword'] = $d->clear(addslashes($_POST['keyword']));
		$data['tags_hienthi'] = addslashes($_POST['tags_hienthi']);
		//xu ly tags
		$tags = addslashes($_POST['tags_hienthi']);
		$tg2 = explode(',', $tags);
		$id_tag = "";

		foreach ($tg2 as $value) {
		   $kiemtra_tags = $d->o_fet("select name_vi, id from #_tags where name_vi = '".trim($value)."'");
		   if(count($kiemtra_tags) == 0  && trim($value) <> ''){
		   		$dataInsert = array(
		   			'id' => '',
		   			'name_vi' => trim($value),
		   			'alias' => $d->bodautv($value),
		   		);
		   		$d->setTable('#_tags');
		   		if($idTags = $d->insert($dataInsert)){
		   			$id_tag  .= $idTags.",";
		   		}
		   }else{
	   			$id_tag  .= @$kiemtra_tags[0]['id'].",";
	   		}
		}
		$data['tags'] = trim($id_tag,",");
		//end tags
		$data['des'] = addslashes($_POST['des']);
		$data['hien_thi'] = isset($_POST['hien_thi']) ? 1 : 0;
		//$data['noi_bat'] = isset($_POST['noi_bat']) ? 1 : 0;
		if(!empty($_POST['hen_ngay'])){
			$str_ngay = $_POST['hen_ngay'].' '.$_POST['hen_gio'].':0:0';
			$edate=strtotime($_POST['hen_ngay']); 
			$edate=date("Y-m-d",$edate);
			$hen_ngay_dang = strtotime($str_ngay);
			$data['hen_ngay'] =$edate;
			$data['hen_gio'] = addslashes($_POST['hen_gio']);
			$data['hen_ngay_dang'] = $hen_ngay_dang;
		}

		$d->setTable('#_tintuc');
		$d->setWhere('id',$id);
		if($d->update($data)){
			
			/////up hinh
	    	for ($i=1; $i <= 15; $i++) { 
	    		if(isset($_POST['txt_up_'.$i]) && $_POST['txt_up_'.$i] == 1){
	    			$file_name=$d->fns_Rand_digit(0,9,12);
	    			if(@$file = $d->upload_image("file_".$i, '', '../img_data/images/',$file_name)){
						$data_hinh['image_path'] = $file;
						$data_hinh['title'] = $_REQUEST['title'.$i];
			    		$data_hinh['id_baiviet'] = $id;
						$d->reset();
						$d->setTable('#_baiviet_hinhanh');
						$d->insert($data_hinh);
					}
	    		}
	    	}

			/*
	    	// SITEMAP
	    	$sitemap = '<?xml version="1.0" encoding="UTF-8"?>
				<urlset
				    xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
				    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
				    xsi:schemaLocation="
				            http://www.sitemaps.org/schemas/sitemap/0.9
				            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
					<url>
				       <loc>'.@URLPATH.'</loc>
				       <priority>1</priority>
				  	</url>';

	

	
			$tintuc = $d->o_fet("select * from #_tintuc where hien_thi = 1 order by id desc");
			foreach ($tintuc as $item) {
				if(!empty($item['alias_vi'])){
					$sitemap .= '
						<url>
						 <loc>'.URLPATH.$d->create_long_link($item['alias_vi'],'vn').'.html</loc>
						 <priority>'.((float)rand(500, 800)/1000).'</priority>
						</url>';
				}

			}


			$category = $d->o_fet("select * from #_category where hien_thi = 1 order by so_thu_tu asc,id desc");
			foreach ($category as $item) {

				$sitemap .= '
					<url>
					 <loc>'.URLPATH.$d->create_long_link($item['alias_vi'],'vn').'.html</loc>
					 <priority>'.((float)rand(500, 800)/1000).'</priority>
					</url>';	

			}


			$sanpham = $d->o_fet("select * from #_sanpham where hien_thi = 1 order by so_thu_tu asc, id desc");
			foreach ($sanpham as $item) {
				

				$sitemap .= '
						<url>
						 <loc>'.URLPATH.$d->create_long_link($item['alias_vi'],'vn').'.html</loc>
						 <priority>'.((float)rand(500, 800)/1000).'</priority>
						</url>';

			}



			$sitemap .= '
			</urlset>';

			$file = fopen("../sitemap.xml","w+");
			fwrite($file, $sitemap);
			fclose($file);
			*/

			
			$d->redirect("index.php?p=bai-viet&a=man&page=".@$_REQUEST['page']."&loaitin=".@$_GET['loaitin']);
		}
		else{

			$d->alert("Cập nhật dữ liệu bị lỗi!");
			$d->redirect("Cập nhật dữ liệu bị lỗi", "index.php?p=bai-viet&a=man&loaitin=".@$_GET['loaitin']);
		}
	}
	else
	{


		if(@$file = $d->upload_image("file", '', '../img_data/images/',$file_name)){
			
			$data['image_path'] = $file;
		}
		
		$data['category_id'] = addslashes($_POST['category_id']);
		
		$data['name_vi'] = $d->clear(addslashes($_POST['name_vi']));
		$data['name_en'] = $d->clear(addslashes($_POST['name_en']));
		$data['name_ch'] = $d->clear(addslashes($_POST['name_ch']));
		$data['description_vi'] = $d->clear(addslashes($_POST['description_vi']));
		$data['description_en'] = $d->clear(addslashes($_POST['description_en']));
		$data['description_ch'] = $d->clear(addslashes($_POST['description_ch']));
		$data['content_vi'] = $d->clear(addslashes($_POST['content_vi']));
		$data['content_en'] = $d->clear(addslashes($_POST['content_en']));
		$data['content_ch'] = $d->clear(addslashes($_POST['content_ch']));
		
		$data['alias_vi'] = $d->clear(addslashes($_POST['alias_vi']));
		if($d->checkLink($data['alias_vi'],"alias_vi",$id ) && $data['alias_vi']!='') {
			$data['alias_vi'].="-".rand(10,999);
		}

		$data['alias_en'] = $d->clear(addslashes($_POST['alias_en']));
		if($d->checkLink($data['alias_en'],"alias_en",$id ) && $data['alias_en']!='') {
			$data['alias_en'].="-".rand(10,999);
		}	
		
		$data['alias_ch'] = $d->clear(addslashes($_POST['alias_ch']));
		if($d->checkLink($data['alias_ch'],"alias_ch",$id ) && $data['alias_ch']!='') {
			$data['alias_ch'].="-".rand(10,999);
		}
		
		
		$data['title_vi'] = $d->clear(addslashes($_POST['title_vi']));
		$data['title_en'] = $d->clear(addslashes($_POST['title_en']));
		$data['title_ch'] = $d->clear(addslashes($_POST['title_ch']));
		$data['keyword'] = $d->clear(addslashes($_POST['keyword']));
		$data['tags_hienthi'] = addslashes($_POST['tags_hienthi']);

		//xu ly tags
		$tags = addslashes($_POST['tags_hienthi']);
		$tg2 = explode(',', $tags);
		$id_tag = "";

		foreach ($tg2 as $value) {
		   $kiemtra_tags = $d->o_fet("select name_vi, id from #_tags where name_vi = '".trim($value)."'");
		   if(count($kiemtra_tags) == 0  && trim($value) <> ''){
		   		$dataInsert = array(
		   			'id' => '',
		   			'name_vi' => trim($value),
		   			'alias' => $d->bodautv($value),
		   		);
		   		$d->setTable('#_tags');
		   		if($idTags = $d->insert($dataInsert)){
		   			$id_tag  .= $idTags.",";
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
		//$data['noi_bat'] = isset($_POST['noi_bat']) ? 1 : 0;
		if(!empty($_POST['hen_ngay'])){
			$str_ngay = $_POST['hen_ngay'].' '.$_POST['hen_gio'].':0:0';
			$edate=strtotime($_POST['hen_ngay']); 
			$edate=date("Y-m-d",$edate);
			$hen_ngay_dang = strtotime($str_ngay);
			$data['hen_ngay'] =$edate;
			$data['hen_gio'] = addslashes($_POST['hen_gio']);
			$data['hen_ngay_dang'] = $hen_ngay_dang;
		}
		// var_dump($data['hen_ngay']); die;
		$d->setTable('#_tintuc');
		if($idsp = $d->insert($data))
		{
			/////up hinh
			
	    	for ($i=1; $i <= 15; $i++) { 
	    		$file_name=$d->fns_Rand_digit(0,9,12);
	    		if(isset($_POST['txt_up_'.$i]) && $_POST['txt_up_'.$i] == 1){
	    			if(@$file = $d->upload_image("file_".$i, '', '../img_data/images/',$file_name)){
						$data_hinh['image_path'] = $file;
						$data_hinh['title'] = $_REQUEST['title'.$i];
			    		$data_hinh['id_baiviet'] = $idsp;
						$d->reset();
						$d->setTable('#_baiviet_hinhanh');
						$d->insert($data_hinh);
					}
	    		}
	    	}	

	    	// SITEMAP
	    	/*$sitemap = '<?xml version="1.0" encoding="UTF-8"?>
				<urlset
				    xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
				    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
				    xsi:schemaLocation="
				            http://www.sitemaps.org/schemas/sitemap/0.9
				            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
					<url>
				       <loc>'.@URLPATH.'</loc>
				       <priority>1</priority>
				  	</url>';

	

	
			$tintuc = $d->o_fet("select * from #_tintuc where hien_thi = 1 order by id desc");
			foreach ($tintuc as $item) {
				$sitemap .= '
						<url>
						 <loc>'.URLPATH.$d->create_long_link($item['alias_vi'],'vn').'.html</loc>
						 <priority>'.((float)rand(500, 800)/1000).'</priority>
						</url>';

			}


			$category = $d->o_fet("select * from #_category where hien_thi = 1 order by so_thu_tu asc,id desc");
			foreach ($category as $item) {

				$sitemap .= '
					<url>
					 <loc>'.URLPATH.$d->create_long_link($item['alias_vi'],'vn').'.html</loc>
					 <priority>'.((float)rand(500, 800)/1000).'</priority>
					</url>';	

			}


			$sanpham = $d->o_fet("select * from #_sanpham where hien_thi = 1 order by so_thu_tu asc, id desc");
			foreach ($sanpham as $item) {
				

				$sitemap .= '
						<url>
						 <loc>'.URLPATH.$d->create_long_link($item['alias_vi'],'vn').'.html</loc>
						 <priority>'.((float)rand(500, 800)/1000).'</priority>
						</url>';

			}



			$sitemap .= '
			</urlset>';

			$file = fopen("../sitemap.xml","w+");
			fwrite($file, $sitemap);
			fclose($file);
			*/
					
			$d->redirect("index.php?p=bai-viet&a=man&loaitin=".@$_GET['loaitin']);
		}
		else{
			$d->alert("Thêm dữ liệu bị lỗi!");
			$d->redirect("Thêm dữ liệu bị lỗi", "index.php?p=bai-viet&a=man&loaitin=".@$_GET['loaitin']);
		}
	}
}

function xoadulieu(){
	global $d;
	if(isset($_GET['id'])){
		$id =  addslashes($_GET['id']);
		$hinhanh = $d->o_fet("select * from #_tintuc where id = '".$id."'");
		@unlink('../img_data/images/'.$hinhanh[0]['image_path']);
		
		// xoa anh chi tiet
		$hinhanh_chitiet = $d->o_fet("select * from #_baiviet_hinhanh where id_baiviet = '".$id."'");
		$d->o_que("delete from #_baiviet_hinhanh where id_baiviet = '".$id."'");
		foreach ($hinhanh_chitiet as $hact) {
			@unlink('../img_data/images/'.$hact['image_path']);
		}
		// end		
		$d->reset();
		$d->setTable('#_tintuc');
		$d->setWhere('id',$id);
		if($d->delete()){
			$d->redirect("index.php?p=bai-viet&a=man&page=".@$_REQUEST['page']."&loaitin=".@$_GET['loaitin']);
		}else{
			$d->alert("Xóa dữ liệu bị lỗi!");
			$d->redirect("Xóa dữ liệu bị lỗi", "index.php?p=bai-viet&a=man&loaitin=".@$_GET['loaitin']);
		}
	}else {
		$d->alert("Không nhận được dữ liệu!");
		$d->redirect("Xóa dữ liệu bị lỗi", "index.php?p=bai-viet&a=man&loaitin=".@$_GET['loaitin']);
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
		$hinhanh = $d->o_fet("select * from #_tintuc where id in ($chuoi)");
		if($d->o_que("delete from #_tintuc where id in ($chuoi)")){
			//xoa hình ảnh
			foreach ($hinhanh as $ha) {
				@unlink('../img_data/images/'.$ha['image_path']);

			}
			// xoa anh chi tiet
			$hinhanh_chitiet = $d->o_fet("select * from #_baiviet_hinhanh where id_baiviet in ($chuoi)");
			$d->o_que("delete from #_baiviet_hinhanh where id_baiviet in ($chuoi)");
			foreach ($hinhanh_chitiet as $hact) {
				@unlink('../img_data/images/'.$hact['image_path']);
			}			
			
			$d->redirect("index.php?p=bai-viet&a=man&page=".@$_REQUEST['page']."&loaitin=".@$_GET['loaitin']);
		}
		else{
			$d->alert("Không nhận được dữ liệu!");
			$d->redirect("Xóa dữ liệu bị lỗi", "index.php?p=bai-viet&a=man&loaitin=".@$_GET['loaitin']);
		} 
	}else $d->redirect("index.php?p=bai-viet&a=man&page=".@$_REQUEST['page']."&loaitin=".@$_GET['loaitin']);
}
?>