<?php
session_start();

if (!isset($_SESSION['lang'])) {
	$_SESSION['lang'] = 'vi';
}

define('__ROOT_PATH', dirname(__FILE__));

if (getenv('APP_DEBUG') == 'false') {
	error_reporting(0);
	ini_set('display_startup_errors', 0);
	ini_set('display_errors', 0);
} else {
	error_reporting(-1);
	ini_set('display_startup_errors', 1);
	ini_set('display_errors', 1);
}

@include "admin/lib/config.php";
@include "admin/lib/function.php";
global $d;
$d = new func_index($config['database']);

date_default_timezone_set('Asia/Ho_Chi_Minh');

// Include all api here
require_once __ROOT_PATH . '/api/cart.php';
require_once __ROOT_PATH . '/api/price_request.php';
require_once __ROOT_PATH . '/api/view_count.php';
require_once __ROOT_PATH . '/api/guarantee.php';
require_once __ROOT_PATH . '/api/product.php';
require_once __ROOT_PATH . '/api/email_contact.php';
require_once __ROOT_PATH . '/api/brand.php';

if ($_REQUEST['func']) {
	if (function_exists($_REQUEST['func'])) {
		$result = call_user_func($_REQUEST['func']);
		if (is_array($result)) {
			header('Content-type: application/json');
			echo json_encode($result);
		}
	} else {
		die('404 NOT FOUND');
	}
}