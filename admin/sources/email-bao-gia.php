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

    // check column region, if not add column region
    $link = mysqli_connect($d->servername, $d->username, $d->password, $d->database);
    $result = mysqli_query($link,"SHOW COLUMNS FROM `" . $d->refix . "email_bao_gia` LIKE 'tell'");
    $exists = ($result->current_field == 0) ? false : true;
    if (!$exists) {
        $query = "ALTER TABLE `" . $d->refix . "email_bao_gia` ADD `tell` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL AFTER `email_footer_menu_link_3`";
        mysqli_query($link, $query);

        $query = "ALTER TABLE `" . $d->refix . "email_bao_gia` ADD `zalo` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL AFTER `email_footer_menu_link_3`";
        mysqli_query($link, $query);

        $query = "ALTER TABLE `" . $d->refix . "email_bao_gia` ADD `skype` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL AFTER `email_footer_menu_link_3`";
        mysqli_query($link, $query);

        $query = "ALTER TABLE `" . $d->refix . "email_bao_gia` ADD `website` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL AFTER `email_footer_menu_link_3`";
        mysqli_query($link, $query);

        $query = "ALTER TABLE `" . $d->refix . "email_bao_gia` ADD `company_info_title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL AFTER `email_footer_menu_link_3`";
        mysqli_query($link, $query);

        $query = "ALTER TABLE `" . $d->refix . "email_bao_gia` ADD `company_info_account` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL AFTER `email_footer_menu_link_3`";
        mysqli_query($link, $query);

        $query = "ALTER TABLE `" . $d->refix . "email_bao_gia` ADD `personal_info_title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL AFTER `email_footer_menu_link_3`";
        mysqli_query($link, $query);

        $query = "ALTER TABLE `" . $d->refix . "email_bao_gia` ADD `personal_info_account` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL AFTER `email_footer_menu_link_3`";
        mysqli_query($link, $query);
    }

    $result = mysqli_query($link,"SHOW COLUMNS FROM `" . $d->refix . "email_bao_gia` LIKE 'dear_name'");
    $exists = ($result->current_field == 0) ? false : true;
    if (!$exists) {
        $query = "ALTER TABLE `" . $d->refix . "email_bao_gia` ADD `dear_name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL AFTER `email_footer_menu_link_3`";
        mysqli_query($link, $query);

        $query = "ALTER TABLE `" . $d->refix . "email_bao_gia` ADD `thank_you` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL AFTER `email_footer_menu_link_3`";
        mysqli_query($link, $query);

        $query = "ALTER TABLE `" . $d->refix . "email_bao_gia` ADD `reply_content` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL AFTER `email_footer_menu_link_3`";
        mysqli_query($link, $query);
    }

	$query = "SELECT * FROM #_email_bao_gia";
	$items = $d->o_fet($query);
}

function luudulieu(){
	global $d;
	$d->reset();

    $data = array();
	$data['email_type'] = addslashes($_POST['email_type']);

    $data['tell'] = addslashes($_POST['tell']);
    $data['zalo'] = addslashes($_POST['zalo']);
    $data['skype'] = addslashes($_POST['skype']);
    $data['website'] = addslashes($_POST['website']);
    $data['company_info_title'] = addslashes($_POST['company_info_title']);
    $data['company_info_account'] = addslashes($_POST['company_info_account']);
    $data['personal_info_title'] = addslashes($_POST['personal_info_title']);
    $data['personal_info_account'] = addslashes($_POST['personal_info_account']);
    $data['dear_name'] = addslashes($_POST['dear_name']);
    $data['thank_you'] = addslashes($_POST['thank_you']);
    $data['reply_content'] = addslashes($_POST['reply_content']);

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