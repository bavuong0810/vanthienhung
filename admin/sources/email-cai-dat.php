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
}

function luudulieu(){
	global $d;
	$d->reset();

	$email_admin = trim($_POST['email_admin']);
	$email_admin_cc = trim($_POST['email_admin_cc']);
	$email_password_json = trim($_POST['email_password']);
	$admin_sms_json = trim($_POST['admin_sms']);
	//$oauth_client_json = trim($_POST['oauth_client_json']);
    //$access_token_json = trim($_POST['access_token_json']);
	

	if( $email_admin ){
		$email_admin_url = './../smtpv2/email_admin.json';
		file_put_contents($email_admin_url, $email_admin);
	}

	if( $email_admin_cc ){
		$email_admin_cc_url = './../smtpv2/email_admin_cc.json';
		file_put_contents($email_admin_cc_url, $email_admin_cc);
	}

	if( $email_password_json ){
		$email_password_url = './../smtpv2/email_password.json';
		file_put_contents($email_password_url, $email_password_json);
	}

	if( $admin_sms_json ){
		file_put_contents(__ROOT_PATH . '/img_data/files/sms/admin_sms.json', $admin_sms_json);
	}

	/*
	if( $oauth_client_json ){
		$credentials_url = './../smtp/credentials.json';
		file_put_contents($credentials_url, $oauth_client_json);
	}

	if( $access_token_json ){
		$access_token_url = './../smtp/token.json';
		file_put_contents($access_token_url, $access_token_json);
	}*/

	$d->disableCacheQuery();
	$d->reset();
	$d->clearMemCached();
	$d->alert("Cập nhật dữ liệu thành công.");
	$d->redirect("index.php?p=".$_GET['p']."&a=man");
}