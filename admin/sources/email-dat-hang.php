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
    $result = mysqli_query($link,"SHOW COLUMNS FROM `" . $d->refix . "emails` LIKE 'tell'");
    $exists = ($result->current_field == 0) ? false : true;
    if (!$exists) {
        $query = "ALTER TABLE `" . $d->refix . "emails` ADD `tell` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL AFTER `personal_info_account`";
        mysqli_query($link, $query);

        $query = "ALTER TABLE `" . $d->refix . "emails` ADD `zalo` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL AFTER `personal_info_account`";
        mysqli_query($link, $query);

        $query = "ALTER TABLE `" . $d->refix . "emails` ADD `skype` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL AFTER `personal_info_account`";
        mysqli_query($link, $query);

        $query = "ALTER TABLE `" . $d->refix . "emails` ADD `website` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL AFTER `personal_info_account`";
        mysqli_query($link, $query);
    }

    $result = mysqli_query($link,"SHOW COLUMNS FROM `" . $d->refix . "emails` LIKE 'reply_content'");
    $exists = ($result->current_field == 0) ? false : true;
    if (!$exists) {
        $query = "ALTER TABLE `" . $d->refix . "emails` ADD `reply_content` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL AFTER `personal_info_account`";
        mysqli_query($link, $query);
    }

	$query = "SELECT * FROM #_emails WHERE `email_type` = 'dat_hang'";
	$items = $d->o_fet($query);
}

function luudulieu(){
	global $d;
	$d->reset();
	/*
	$email_type = $_POST['email_type'];
    $admin_email = $_POST['admin_email'];
	$thank_you = addslashes($_POST['thank_you']);
    $dear_name = addslashes($_POST['dear_name']);
    $company_info_title = addslashes($_POST['company_info_title']);
    $company_info_account = addslashes($_POST['company_info_account']);
    $personal_info_title = addslashes($_POST['personal_info_title']);
    $personal_info_account = addslashes($_POST['personal_info_account']);*/
	
	$data = array();
    $data['tell'] = addslashes($_POST['tell']);
    $data['zalo'] = addslashes($_POST['zalo']);
    $data['skype'] = addslashes($_POST['skype']);
    $data['website'] = addslashes($_POST['website']);
    $data['reply_content'] = addslashes($_POST['reply_content']);
	$data['email_type'] = addslashes($_POST['email_type']);
	$data['thank_you'] = addslashes($_POST['thank_you']);
    $data['dear_name'] = addslashes($_POST['dear_name']);
    $data['company_info_title'] = addslashes($_POST['company_info_title']);
    $data['company_info_account'] = addslashes($_POST['company_info_account']);
    $data['personal_info_title'] = addslashes($_POST['personal_info_title']);
    $data['personal_info_account'] = addslashes($_POST['personal_info_account']);

	if( $d->isExitsValue('email_type', 'dat_hang', '#_emails') ){
		$d->setTable('#_emails');
		$d->setWhere('email_type', 'dat_hang');
		$d->update($data);
	} else {
		$d->setTable('#_emails');
		$d->insert($data);
	}

	/*
	$sql = "INSERT INTO db_emails (`email_type`, `email_admin`, `thank_you`, `dear_name`, `company_info_title`, `company_info_account`, `personal_info_title`, `personal_info_account`) VALUES ('$email_type', '$email_admin', '$thank_you', '$dear_name', '$company_info_title', '$company_info_account', '$personal_info_title', '$personal_info_account')";
	$result = $d->query($sql);

	if( $result ){
		$d->alert("Cập nhật dữ liệu thành công.");
	} else {
		$d->alert("Cập nhật dữ liệu không thành công.");
	}*/

	$d->disableCacheQuery();
	$d->reset();
	$d->clearMemCached();
	$d->alert("Cập nhật dữ liệu thành công.");
	$d->redirect("index.php?p=".$_GET['p']."&a=man");
}