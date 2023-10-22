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
	global $d, $item;
	if(isset($_REQUEST['p'])){
		$item = $d->o_fet("select * from #_seo where id=1 ");	}
}

function luudulieu(){
	global $d;
	// xóa trước
	$d->reset();
	$d->setTable('#_seo');


	$data['title_vi'] = addslashes($_POST['title_vi']);
	$data['title_en'] = addslashes($_POST['title_en']);

	$data['keyword_vi'] = addslashes($_POST['keyword_vi']);
	$data['keyword_en'] = addslashes($_POST['keyword_en']);
	
	$data['description_vi'] = addslashes($_POST['description_vi']);
	$data['description_en'] = addslashes($_POST['description_en']);

	$d->reset();
	$d->setTable('#_seo');
	$d->setWhere('id',1);
	if($d->update($data)){
		$d->alert("Cập nhật dữ liệu thành công.");
		echo $d->redirect("index.php?p=seo-co-ban&a=man");
	}else{
		echo $d->transfer("Cập nhật dữ liệu bị lỗi", "index.php?p=seo-co-ban&a=man");
	}
}
?>