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
	$d->disableCacheQuery();
	$d->reset();

	$query = "SELECT * FROM #_email_bao_gia";
	$items = $d->o_fet($query);
}

function luudulieu(){
	global $d;
	$d->reset();

    $data = array();
	$data['email_type'] = addslashes($_POST['email_type']);
	
    $data['email_menu_title_1'] = addslashes($_POST['email_menu_title_1']);
    $data['email_menu_link_1'] = addslashes($_POST['email_menu_link_1']);
    $data['email_menu_title_2'] = addslashes($_POST['email_menu_title_2']);
    $data['email_menu_link_2'] = addslashes($_POST['email_menu_link_2']);
    $data['email_menu_title_3'] = addslashes($_POST['email_menu_title_3']);
    $data['email_menu_link_3'] = addslashes($_POST['email_menu_link_3']);
    $data['email_content'] = addslashes($_POST['email_content']);
    $data['email_address'] = addslashes($_POST['email_address']);
    $data['email_phone'] = addslashes($_POST['email_phone']);
    $data['email_email'] = addslashes($_POST['email_email']);
    $data['email_footer_title'] = addslashes($_POST['email_footer_title']);
    $data['email_footer_content'] = addslashes($_POST['email_footer_content']);
    $data['email_footer_menu_title_1'] = addslashes($_POST['email_footer_menu_title_1']);
    $data['email_footer_menu_link_1'] = addslashes($_POST['email_footer_menu_link_1']);
    $data['email_footer_menu_title_2'] = addslashes($_POST['email_footer_menu_title_2']);
    $data['email_footer_menu_link_2'] = addslashes($_POST['email_footer_menu_link_2']);
    $data['email_footer_menu_title_3'] = addslashes($_POST['email_footer_menu_title_3']);
    $data['email_footer_menu_link_3'] = addslashes($_POST['email_footer_menu_link_3']);

	if( $d->isExitsValue('email_type', 'bao_gia', '#_email_bao_gia') ){
		$d->setTable('#_email_bao_gia');
		$d->setWhere('email_type', 'bao_gia');
		$d->update($data);
	} else {
		$d->setTable('#_email_bao_gia');
		$d->insert($data);
	}

	$d->disableCacheQuery();
	$d->reset();
	$d->clearMemCached();
	$d->alert("Cập nhật dữ liệu thành công.");
	$d->redirect("index.php?p=".$_GET['p']."&a=man");
}