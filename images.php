<?php
define('__ROOT_PATH', dirname(__FILE__));
define('_lib','./admin/lib/');
define('_source','./sources/');
@include _lib."config.php";
@include_once _lib."function.php";
global $d;
global $lang;
include _source."lang.php";
include _source."language_".$_SESSION['lang'].".php";
$d = new func_index($config['database']);
date_default_timezone_set('Asia/Ho_Chi_Minh');

$link = mysqli_connect($d->servername, $d->username, $d->password, $d->database);
$query = "select `id`, `image_path`, `name_vi` from `" . $d->refix . "_sanpham`";
$result = mysqli_query($link, $query);
print_r($result); die();