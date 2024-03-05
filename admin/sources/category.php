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
$p = (isset($_REQUEST['p'])) ? addslashes($_REQUEST['p']) : "";
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
	case "replace":
		replace();
		break;
	default:
		$template = "index";
}

function showdulieu(){
	global $d, $items, $paging, $loai, $hang, $loaibv, $soluong, $modules, $modulesMap, $fields;
	
	if (isset($_GET['remove_filter'])) {
		unset($_SESSION['category_search']);
		$d->redirect('index.php?p=category&a=man');
		exit;
	}

	$modules = $d->o_fet("select * from #_module where hide = 1 order by stt asc,id desc");
	$modulesMap = [];
	foreach ($modules as $module) {
		$modulesMap[$module['id']] = $module;
	}

	$fieldNamesToSearch = [
		"so_thu_tu",
		"name_vi",
		"name_ch",
		"name_en",
		"title_vi",
		"title_ch",
		"title_en",
		"content_ch",
		"content_en",
		"content_vi",
		"image_path",
		"keyword",
		"des",
		"menu",
		"hien_thi",
		"is_hot",
	];

	if($_REQUEST['a'] == 'man'){
		$loaibv = $d->array_category(0,'','',0);
		//show du lieu
		// if(isset($_GET['seach'])){
		// 	$seach = addslashes($_GET['seach']);
		// 	$key = (isset($_GET['key']))? addslashes($_GET['key']):"";
		// 	if($seach == 'id'){
		// 		$items = $d->o_fet("select * from #_category where id = '".$key."'");
		// 	}else{
		// 		$key = $d->bodautv($key);
		// 		$items = $d->o_fet("select * from #_category where alias_vi like '%".$key."%'");
		// 	}
		// }
		// else $items = $d->o_fet("select * from #_category where category_id = 0 order by so_thu_tu asc, id desc");


		//show du lieu
		$query = 'select * from #_category';
		$wheres  = array();

		if (!empty($_GET['category_id']) && $_GET['category_id'] && $_GET['category_id'] != -1 && $_GET['category_id'] != -2) {
			$category_id = $_GET['category_id'].$d->findIdSub($_GET['category_id']);	
		    $wheres[] = "FIND_IN_SET(category_id,'$category_id') <> 0";
		} else if ($_GET['category_id'] == -1) {
			$wheres[] = "(category_id = 0 OR category_id IS NULL)";
		} else if ($_GET['category_id'] == -2) {
			$wheres[] = "(category_id != 0 AND category_id IS NOT NULL)";
		}

		if (isset($_GET['search'])) {
			if (!empty($_POST['fields']) || !empty($_SESSION['category_search'])) {
				$fields = !empty($_POST['fields']) ? $_POST['fields'] : $_SESSION['category_search'];
				$_SESSION['category_search'] = $fields;
				foreach ($fields as $index => $field) {

					if ($field['name'] == 'image_path') {
						if ($field['value'] == 1) {
							$wheres[] = 'image_path IS NOT NULL';
						} else {
							$wheres[] = 'image_path IS NULL';
						}
						
						continue;
					}

					if ($field['name'] == 'all_field') {
						$whereAll = [];
						foreach ($fieldNamesToSearch as $fieldName) {
							if ($field['compare'] == 'like') {
								$value = empty($field['value']) ? '\'\'' : '\'%' . $field['value'] . '%\'';
								$whereAll[] = $fieldName . ' ' . $field['compare'] . ' ' . $value;
							} else if ($field['compare'] == 'start') {
								$field['compare'] = 'like';
								$value = empty($field['value']) ? '\'\'' : '\'' . $field['value'] . '%\'';
								$whereAll[] = $fieldName . ' ' . $field['compare'] . ' ' . $value;
							} else {
								$value = empty($field['value']) ? '\'\'' : $field['value'];
								
								if (empty($field['value'])) {
									$whereAll[] = $fieldName . ' IS NULL';
								} else {
									$whereAll[] = '(CAST(' . $fieldName . ' AS CHAR) ' . $field['compare'] . ' \'' . $value . '\' AND ' . $fieldName . ' IS NOT NULL)';
								}
							}
						}
						$wheres[] = ' (' . implode(' OR ', $whereAll) . ') ';

						continue;
					}

					$field['value'] = $d->clear(addslashes($field['value']));
					if($field['compare'] == 'like') {
						$field['value'] = '\'%'.$field['value'].'%\'';
					} else if ($field['compare'] == 'start') {
							$field['compare'] = 'like';
							$field['value'] = '\''.$field['value'].'%\'';
					} else {
						$field['value'] = '\''.$field['value'].'\'';
					}
					
					$wheres[] = $field['name'] . ' ' . $field['compare'] . ' ' . (empty($field['value']) ? '\'\'' : $field['value']);
				}
			}
		}

		if (!empty($wheres)) {
			$query .= ' where ' . implode(' and ', $wheres);
		}

		if (!empty($_GET['orderby'])) {
			$orderby = str_replace('-', ' ', $_GET['orderby']);
			$query .= " order by " . $orderby;
		} else {
			$query .= " order by category_id desc";
		}

		// phan trang
		if(isset($_GET['hienthi']) && $_GET['hienthi'] != 0){
			$maxR= $d->lay_show_hienthi(addslashes($_GET['hienthi']));
		}
		else $maxR=20;
		$page = isset($_GET['page']) && $_GET['page'] > 1 ? addslashes($_GET['page']) : 1;
		$offset = ($page - 1) * $maxR;

		// get total records for paging
		$queryCount = str_replace('*', 'count(id) as totalRecords', $query);

		$countResult = $d->o_fet($queryCount);
		$totalRecords = $countResult[0]['totalRecords'];

		// get items
		$query .= " limit $offset, $maxR";

		$items = $d->o_fet($query);

		$url=$d->fullAddress();
		$maxP=$maxR;
		$paging=$d->phantrang($totalRecords, $url, $page, $maxR, $maxP,'classunlink','classlink','page');
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


function replace() {
	global $d, $p;

	$id = (isset($_REQUEST['id'])) ? addslashes($_REQUEST['id']) : "";
	$toId = (isset($_REQUEST['toId'])) ? addslashes($_REQUEST['toId']) : "";
	if (!$id || !$toId) {
		$d->transfer("Không nhận được dữ liệu", "index.php?p=".$p."&a=man&page=" . @$_REQUEST['page'] . "");
	}
	$id = intval($id);
	$toId = intval($toId);

	$d->setTable('#_sanpham');
	$d->setWhere('category_id', $id);
	if (!$d->update(['category_id' => $toId])) {
		$d->transfer("Cập nhật dữ liệu bị lỗi", "index.php?p=" . $p . "&a=edit&id=" . $id);
		return false;
	}

	$d->setTable('#_category');
	$d->setWhere('category_id', $id);
	if (!$d->update(['category_id' => $toId])) {
		$d->transfer("Cập nhật dữ liệu bị lỗi", "index.php?p=" . $p . "&a=edit&id=" . $id);
		return false;
	}

	$d->reset();
	$d->setTable('#_category');
	$d->setWhere('id', $id);
	if (!$d->delete()) {
		$d->transfer("Cập nhật dữ liệu thành công nhưng xóa nhãn hiệu bị lỗi!", "index.php?p=" . $p . "&a=edit&id=" . $id);
		return false;
	}

	$d->transfer("Thay thế thành công!", "index.php?p=".$p."&a=man&page=" . @$_REQUEST['page'] . "");
	return true;
}