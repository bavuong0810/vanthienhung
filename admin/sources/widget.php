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
	global $d, $items, $paging, $allGroups,$hang,$soluong, $loaibv, $selectedCategoryIds;

	if($_REQUEST['a'] == 'man'){
		//show du lieu
		if(isset($_GET['seach'])){
			$seach = addslashes($_GET['seach']);
			$key = (isset($_GET['key']))? addslashes($_GET['key']):"";
			if($seach == 'id'){
				$items = $d->o_fet("select * from #_widget where id = '".$key."' ORDER BY group_id ASC");
			}else{
				$items = $d->o_fet("select * from #_widget where name_vi like '%".$key."%' OR name_en like '%".$key."%' OR name_ch like '%".$key."%' ORDER BY group_id ASC");
			}
		}
		else $items = $d->o_fet("select * from #_widget order by group_id asc, weight asc, id desc");


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
			$items = $d->o_fet("select * from #_widget where id =  '".$id."'");
			$selectedCategories = $d->o_fet("select category_id from #_widget_category where widget_id =  '".$id."'");
			$selectedCategoryIds = [];
			foreach ($selectedCategories as $selectedCategory) {
				$selectedCategoryIds[] = $selectedCategory['category_id'];
			}
		}
		
		$soluong = $d->simple_fetch("select count(*) as soluong from #_widget");
		
	}

	$allGroups = $d->o_fet("select id, name_vi from #_group");
	$newAllGroups = [];
	foreach ($allGroups as $key => $group) {
		$newAllGroups[$group['id']] = $group;
	}
	$allGroups = $newAllGroups;

	$loaibv = $d->array_category(0, '', $selectedCategoryIds, 0, $items[0]['id']);
}

function luudulieu(){
	global $d;
	$id = (isset($_REQUEST['id'])) ? addslashes($_REQUEST['id']) : "";

	$data = [];
	$data['name_vi'] = $d->clear(addslashes($_POST['name_vi']));
	$data['name_en'] = $d->clear(addslashes($_POST['name_en']));
	$data['name_ch'] = $d->clear(addslashes($_POST['name_ch']));

	$data['content_vi'] = saveImagesFromHtml($_POST['content_vi']);
	$data['content_en'] = saveImagesFromHtml($_POST['content_en']);
	$data['content_ch'] = saveImagesFromHtml($_POST['content_ch']);


	$data['content_vi'] = $d->clear(addslashes($data['content_vi']));
	$data['content_en'] = $d->clear(addslashes($data['content_en']));
	$data['content_ch'] = $d->clear(addslashes($data['content_ch']));

	$data['weight'] = addslashes($_POST['weight']);
	$data['is_active'] = isset($_POST['is_active']) ? 1 : 0;
	$data['group_id'] = intval($_POST['group_id']);
	
	if($id != '')
	{
		$d->setTable('#_widget');
		$d->setWhere('id',$id);
		if($d->update($data)){

			// Update categories
			$d->reset();
			$d->setTable('#_widget_category');
			$d->setWhere('widget_id',$id);
			$d->delete();

			$widgetCategories = $_POST['widget_category'];
			$d->reset();
			$d->setTable('#_widget_category');
			foreach ($widgetCategories as $categoryId) {
				$d->insert(['widget_id' => $id, 'category_id' => $categoryId]);
			}

			$d->redirect("index.php?p=widget&a=man&page=".@$_REQUEST['page']."");
		}
		else{
			//echo mysql_error();
			$d->transfer("Cập nhật dữ liệu bị lỗi", "index.php?p=widget&a=man");
		}
	}
	else
	{
		$d->setTable('#_widget');
		if($id = $d->insert($data))
		{
			$widgetCategories = $_POST['widget_category'];
			$d->reset();
			$d->setTable('#_widget_category');
			foreach ($widgetCategories as $categoryId) {
				$d->insert(['widget_id' => $id, 'category_id' => $categoryId]);
			}

			$d->redirect("index.php?p=widget&a=man");
		}
		else{
			echo $d->sql; echo mysql_error();
			 $d->transfer("Thêm dữ liệu bị lỗi!", "index.php?p=widget&a=man");
		}
	}
}

function xoadulieu(){
	global $d;
	if(isset($_GET['id'])){
		$id =  addslashes($_GET['id']);

		$d->reset();
		$d->setTable('#_widget');
		$d->setWhere('id',$id);
		if($d->delete()){
			$d->redirect("index.php?p=widget&a=man&page=".@$_REQUEST['page']."");
		}else{
			$d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=widget&a=man");
		}
	}else $d->transfer("Không nhận được dữ liệu", "index.php?p=widget&a=man");
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

		if($d->o_que("delete from #_widget where id in ($chuoi)")){
			$d->redirect("index.php?p=widget&a=man&page=".@$_REQUEST['page']."");
		}
		else $d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=widget&a=man");
	}else $d->redirect("index.php?p=widget&a=man&page=".@$_REQUEST['page']."");
}
?>