<?php
if(!defined('_source')) die("Error");
$a = (isset($_REQUEST['a'])) ? addslashes($_REQUEST['a']) : "";

switch($a){
	case "man":
		showdulieu();
		$template = @$_REQUEST['p']."/them";
		break;
	case "save":
		luudulieu();
		break;
	default:
		$template = "index";
}
function showdulieu(){
	global $d, $items;
	if(isset($_REQUEST['p'])){
		$id = addslashes($_REQUEST['p']);
		$items = $d->o_fet("select * from #_setting where id = '$id'");
	}
}

function luudulieu(){
	global $d;
	$id = (isset($_REQUEST['p'])) ? addslashes($_REQUEST['p']) : "";

	// xóa trước
	$d->reset();
	$d->setWhere('id',$id);
	$d->setTable('#_setting');
	$d->delete();
	//

	$data['id'] = $id;
	$data['content_vi'] = addslashes($_POST['content_vi']);
	$data['content_en'] = addslashes($_POST['content_en']);



	$d->reset();
	$d->setTable('#_setting');
	if($d->insert($data)){
		$d->alert("Cập nhật dữ liệu thành công.");
		echo $d->redirect("index.php?p=".$_GET['p']."&a=man");
	}else{
		echo $d->transfer("Cập nhật dữ liệu bị lỗi", "index.php?p=".$_GET['p']."&a=man");
	}
}
?>