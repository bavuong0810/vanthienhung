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
	global $d, $items, $paging,$loai;
	$loai = $d->o_fet("select * from #_loaitour where hien_thi =1  order by so_thu_tu asc");
	if($_REQUEST['a'] == 'man'){
		//show du lieu
		if(isset($_GET['lammoi'])){
			$d->o_que("update #_tour set ngay_dang = '".time()."' where id = '".addslashes($_GET['id'])."'");
		}
		if(isset($_GET['seach'])){
			$seach = addslashes($_GET['seach']);
			$key = (isset($_GET['key']))? addslashes($_GET['key']):"";
			if($seach == 'id'){
				$items = $d->o_fet("select * from #_tour where id = '".$key."'");
			}else if($seach == 'name'){
				$items = $d->o_fet("select * from #_tour where name_vi like '%".$key."%'");
			}else{
				$items = $d->o_fet("select * from #_tour where code like '%".$key."%'");
			}
		}
		else $items = $d->o_fet("select * from #_tour  order by ngay_dang desc");

		if(isset($_GET['hienthi'])){
			$maxR= $d->lay_show_hienthi(addslashes($_GET['hienthi']));
		}
		else $maxR=35;
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
			$items = $d->o_fet("select * from #_tour where id =  '".$id."'");
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
		if(@$file = $d->upload_image("file2", '', '../img_data/images/',$file_name)){

			$image->load('../img_data/images/'.$file);
			$image->resizeToWidth(250);
			$img_resize = "thumb_".$file;
			$image->save('../img_data/images/'.$img_resize);

			$hinhanh = $d->o_fet("select * from #_tour where id = '".$id."'");
			foreach ($hinhanh as $ha) {
				@unlink('../img_data/images/'.$ha['image_path']);
				@unlink('../img_data/images/'.$ha['hinh_anh_thumb']);
			}
			$data['image_path'] = $file;
			$data['hinh_anh_thumb'] = $img_resize;
		}



		$category_id = "";
		foreach ($_POST['category_id'] as $vl) {
			$category_id .= addslashes($vl).",";

		}


		$data['category_id'] = trim($category_id);



		$data['ma_tour'] = addslashes($_POST['ma_tour']);

		$data['name_vi'] =addslashes($_POST['name_vi']);
		$data['name_en'] =addslashes($_POST['name_en']);

		$data['alias_vi'] = addslashes(trim($_POST['alias_vi'],"-"));
		$data['alias_en'] = addslashes(trim($_POST['alias_en'],"-"));

		$data['price'] = addslashes($_POST['price']);

		$data['thoi_gian_vn'] =addslashes($_POST['thoi_gian_vn']);
		$data['thoi_gian_us'] =addslashes($_POST['thoi_gian_us']);

		

		$data['phuong_tien_vn'] = addslashes($_POST['phuong_tien_vn']);
		$data['phuong_tien_us'] = addslashes($_POST['phuong_tien_us']);

		$data['khach_san_vn'] =addslashes($_POST['khach_san_vn']);
		$data['khach_san_us'] =addslashes($_POST['khach_san_us']);

		$data['khoi_hanh_vn'] =addslashes($_POST['khoi_hanh_vn']);
		$data['khoi_hanh_us'] =addslashes($_POST['khoi_hanh_us']);

		$data['diem_den_vn'] =addslashes($_POST['diem_den_vn']);
		$data['diem_den_us'] =addslashes($_POST['diem_den_us']);

		$data['diem_di_us'] =addslashes($_POST['diem_di_us']);
		$data['diem_di_vn'] =addslashes($_POST['diem_di_vn']);

		$data['lich_trinh_vn'] =addslashes($_POST['lich_trinh_vn']);
		$data['lich_trinh_us'] =addslashes($_POST['lich_trinh_us']);

		$data['chuong_trinh_us'] =addslashes($_POST['chuong_trinh_us']);
		$data['chuong_trinh_vn'] =addslashes($_POST['chuong_trinh_vn']);

		$data['chi_tiet_vn'] =addslashes($_POST['chi_tiet_vn']);
		$data['chi_tiet_us'] =addslashes($_POST['chi_tiet_us']);

		$data['quy_dinh_vn'] =addslashes($_POST['quy_dinh_vn']);
		$data['quy_dinh_us'] =addslashes($_POST['quy_dinh_us']);

		$data['title_vi'] =addslashes($_POST['title_vi']);
		$data['title_en'] =addslashes($_POST['title_en']);

		$data['keyword'] = addslashes($_POST['keyword']);
		$data['des'] = addslashes($_POST['des']);
	
		$data['hien_thi'] = isset($_POST['hien_thi']) ? 1 : 0;
		$data['is_hot'] = isset($_POST['is_hot']) ? 1 : 0;


		$d->reset();
		$d->setTable('#_tour');
		$d->setWhere('id',$id);
		if($d->update($data)){
			$d->redirect("index.php?p=tour&a=man&page=".@$_REQUEST['page']."");
		}
		else{
			 $d->transfer("Cập nhật dữ liệu bị lỗi", "index.php?p=tour&a=man");
		}
	}
	else
	{
		if(@$file = $d->upload_image("file2", '', '../img_data/images/',$file_name)){
			
			$image->load('../img_data/images/'.$file);
			$image->resizeToWidth(250);
			$img_resize = "thumb_".$file;
			$image->save('../img_data/images/'.$img_resize);

			$data['image_path'] = $file;
			$data['hinh_anh_thumb'] = $img_resize;
		}


		$category_id = "";
		foreach ($_POST['category_id'] as $vl) {
			$category_id .= addslashes($vl).",";

		}


		$data['category_id'] = trim($category_id);



		$data['ma_tour'] = addslashes($_POST['ma_tour']);

		$data['name_vi'] =addslashes($_POST['name_vi']);
		$data['name_en'] =addslashes($_POST['name_en']);

		$data['alias_vi'] = addslashes(trim($_POST['alias_vi'],"-"));
		$data['alias_en'] = addslashes(trim($_POST['alias_en'],"-"));

		$data['price'] = addslashes($_POST['price']);

		$data['thoi_gian_vn'] =addslashes($_POST['thoi_gian_vn']);
		$data['thoi_gian_us'] =addslashes($_POST['thoi_gian_us']);

		

		$data['phuong_tien_vn'] = addslashes($_POST['phuong_tien_vn']);
		$data['phuong_tien_us'] = addslashes($_POST['phuong_tien_us']);

		$data['khach_san_vn'] =addslashes($_POST['khach_san_vn']);
		$data['khach_san_us'] =addslashes($_POST['khach_san_us']);

		$data['khoi_hanh_vn'] =addslashes($_POST['khoi_hanh_vn']);
		$data['khoi_hanh_us'] =addslashes($_POST['khoi_hanh_us']);

		$data['diem_den_vn'] =addslashes($_POST['diem_den_vn']);
		$data['diem_den_us'] =addslashes($_POST['diem_den_us']);

		$data['diem_di_us'] =addslashes($_POST['diem_di_us']);
		$data['diem_di_vn'] =addslashes($_POST['diem_di_vn']);

		$data['lich_trinh_vn'] =addslashes($_POST['lich_trinh_vn']);
		$data['lich_trinh_us'] =addslashes($_POST['lich_trinh_us']);

		$data['chuong_trinh_us'] =addslashes($_POST['chuong_trinh_us']);
		$data['chuong_trinh_vn'] =addslashes($_POST['chuong_trinh_vn']);

		$data['chi_tiet_vn'] =addslashes($_POST['chi_tiet_vn']);
		$data['chi_tiet_us'] =addslashes($_POST['chi_tiet_us']);

		$data['quy_dinh_vn'] =addslashes($_POST['quy_dinh_vn']);
		$data['quy_dinh_us'] =addslashes($_POST['quy_dinh_us']);

		$data['title_vi'] =addslashes($_POST['title_vi']);
		$data['title_en'] =addslashes($_POST['title_en']);

		$data['keyword'] = addslashes($_POST['keyword']);
		$data['des'] = addslashes($_POST['des']);
	
		$data['hien_thi'] = isset($_POST['hien_thi']) ? 1 : 0;
		$data['is_hot'] = isset($_POST['is_hot']) ? 1 : 0;

		$data['ngay_dang'] = time();


		$d->setTable('#_tour');
		if($d->insert($data))
		{
			$d->redirect("index.php?p=tour&a=man");
		}
		else{
			 $d->transfer("Thêm dữ liệu bị lỗi!", "index.php?p=tour&a=man");
		}
	}
}

function xoadulieu(){
	global $d;
	if(isset($_GET['id'])){
		$id =  addslashes($_GET['id']);
		//xoa img
		$hinhanh = $d->o_fet("select * from #_tour where id = '".$id."'");
		foreach ($hinhanh as $ha) {
			@unlink('../img_data/images/'.$ha['image_path']);
			@unlink('../img_data/images/'.$ha['hinh_anh_thumb']);
		}
		//xoa size
			$d->o_que("delete from #_tour_detail where id_sp = '".$id."'");
		//
		// xoa anh chi tiet
		$hinhanh_chitiet = $d->o_fet("select * from #_tour_hinhanh where id_sp = '".$id."'");
		$d->o_que("delete from #_tour_hinhanh where id_sp = '".$id."'");
		foreach ($hinhanh_chitiet as $hact) {
			@unlink('../img_data/images/'.$hact['image_path']);
			@unlink('../img_data/images/'.$hact['hinh_anh_thumb']);
		}
		// end
		//xoa hinhanh
		$hinhanh = $d->o_fet("select * from #_chitietsanpham where id_sp = '".$id."'");
		foreach ($hinhanh as $ha) {
			@unlink('../img_data/images/'.$ha['image_path']);
			@unlink('../img_data/images/'.$ha['hinh_anh_thumb']);
			
		}
		// end
		if($d->o_que("delete from #_tour where id='".$id."'")){
			$d->redirect("index.php?p=tour&a=man&page=".@$_REQUEST['page']."");
		}else
			$d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=tour&a=man");
	}else $d->transfer("Không nhận được dữ liệu", "index.php?p=tour&a=man");
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
		$hinhanh = $d->o_fet("select * from #_tour where id in ($chuoi)");
		$hinhanh2 = $d->o_fet("select * from #_chitietsanpham where category_id in ($chuoi)");
		if($d->o_que("delete from #_tour where id in ($chuoi)")){
			//xoa hình ảnh
			foreach ($hinhanh as $ha) {
				@unlink('../img_data/images/'.$ha['image_path']);
				@unlink('../img_data/images/'.$ha['hinh_anh_thumb']);
			}
			//xoa size
			$d->o_que("delete from #_tour_detail where id_sp in ($chuoi)");
			//
			// xoa anh chi tiet
			$hinhanh_chitiet = $d->o_fet("select * from #_tour_hinhanh where id_sp in ($chuoi)");
			$d->o_que("delete from #_tour_hinhanh where id_sp in ($chuoi)");
			foreach ($hinhanh_chitiet as $hact) {
				@unlink('../img_data/images/'.$hact['image_path']);
				@unlink('../img_data/images/'.$hact['hinh_anh_thumb']);
			}
			//xoaha2
			foreach ($hinhanh2 as $ha) {
				@unlink('../img_data/images/'.$ha['image_path']);
			}
			$d->redirect("index.php?p=tour&a=man&page=".@$_REQUEST['page']."");
		}
		else $d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=tour&a=man");
	}else $d->redirect("index.php?p=tour&a=man&page=".@$_REQUEST['page']."");
}
?>