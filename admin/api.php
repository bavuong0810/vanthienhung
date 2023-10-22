<?php
if (!isset($_SESSION)) {
	session_start();
}

if (!isset($_SESSION['lang'])) {
	$_SESSION['lang'] = 'vi';
}

header('Access-Control-Allow-Credentials: true');

function isAllowdHost()
{
	$allowedFuncs = [
		'uploadWatermark',
		'getLogoConfig',
		'uploadImg',
		'url_to_image',
		'clearCacheImage',
		'clearCache',
	];
	$allowedHosts = [
		'vanthienhung.com',
		'vanthienhung.vn',
		'crm.vanthienhung.vn',
		'vanthienhung.com.vn',
		'congnghiepbinhduong.vn',
		'congnghiepbinhduong.com.vn',
		'congnghiephanoi.vn',
		'congnghiepdongnai.vn',
		'localhost',
		'localhost:8000',
		'bacdan.online',
		'chodansin.online',
		'congnghiepbinhduong.online',
		'phutungxecogioi.online',
		'phutungxenang.online',
		'suaxe.online',
		'vanthienhung.com.vn',
		'vanthienhung.online',
		'voxe.online',
		'xenang.online',
		'xetai.online',
	];
	$host = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);

	if (!in_array($host, $allowedHosts)) {
		return false;
	}

	if (!isset($_GET['func']) || !in_array($_GET['func'], $allowedFuncs)) {
		return false;
	}

	// Allow from any origin
	// if (isset($_SERVER['HTTP_ORIGIN'])) {
		// Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
		// you want to allow, and if so:
		header("Access-Control-Allow-Origin: *");
		header('Access-Control-Allow-Credentials: true');
		header('Access-Control-Max-Age: 86400');    // cache for 1 day
	// }

	// Access-Control headers are received during OPTIONS requests
	if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

		if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
			// may also be using PUT, PATCH, HEAD etc
			header("Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE, PUT");

		if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
			header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

		exit(0);
	}

	return true;
}

if (!isset($_GET["func"])) {
	die('Not found');
}

if (!isset($_SESSION["user_hash"]) && !isAllowdHost()) {
	die('Not found');
}

define('__ROOT_PATH', dirname(dirname(__FILE__)));
@include "lib/config.php";
if (getenv('APP_DEBUG') == 'false') {
	error_reporting(0);
	ini_set('display_startup_errors', 0);
	ini_set('display_errors', 0);
} else {
	error_reporting(-1);
	ini_set('display_startup_errors', 1);
	ini_set('display_errors', 1);
}

@include "lib/function.php";
@include "api/index.php";

global $d;
$d = new func_index($config['database']);

if ($_REQUEST['func']) {
	if (function_exists($_REQUEST['func'])) {
		$result = call_user_func($_REQUEST['func']);
		if (is_array($result)) {
			header('Content-type: application/json');
			echo json_encode($result);
		}
	}
}
