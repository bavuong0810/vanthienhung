<?php 
define('_lib', '../admin/lib/');
@include _lib . "config.php";
@include_once _lib . "function.php";

global $d;
global $lang;
$d = new func_index($config['database']);

$product_id = $_GET['product_id'];

if( !$product_id ){
    exit;
}

$d->query('UPDATE db_sanpham SET image_path = NULL WHERE id='.$product_id);

$default_img = $d->getDefaultProductImage(300, 220);
return [
        'default_img' => $default_img,
    ];
?>