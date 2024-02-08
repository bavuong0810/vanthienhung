<?php
define('__ROOT_PATH', dirname(__FILE__));
define('_lib','./admin/lib/');
@include _lib."config.php";
@include_once _lib."function.php";
global $d;
global $lang;
$d = new func_index($config['database']);
date_default_timezone_set('Asia/Ho_Chi_Minh');

// process for products
$query = 'SELECT `id`, `image_path` FROM #_sanpham WHERE `image_path` != "" AND `image_path` IS NOT NULL';
$items = $d->o_fet($query);
$pushData = [];
$countItem = 0;
$totalItem = count($items);
foreach ($items as $key => $value) {
    $product_id = $value['id'];

    //Xoá ảnh lỗi
    $product_image =  FILEURL . 'img_data/images/' . $value['image_path'];
    if (!@getimagesize($product_image)) {
        $d->query('UPDATE db_sanpham SET image_path = NULL WHERE id = ' . $product_id . ';');
    }

    $queryGallery = 'SELECT `id`, `id_sp`, `image_path` FROM #_sanpham_hinhanh WHERE `image_path` != "" AND `image_path` IS NOT NULL AND id_sp = ' . $product_id;
    $productGalleries = $d->o_fet($queryGallery);

    //Xoá các hình ảnh sản phẩm có nhiều hơn 5 hình
    if (count($productGalleries) > 5) {
        for ($i = (count($productGalleries) - 1); $i >= 5; $i--) {
            $image_product_id = $productGalleries[$i]['id'];
            $d->o_que("delete from #_sanpham_hinhanh where id = " . $image_product_id);
        }
    }

    foreach ($productGalleries as $keyGallery => $valueGallery) {
        $image_url =  getenv('FILEURL') . '/img_data/images/' . $valueGallery['image_path'];
        if (!@getimagesize($image_url)) {
            $d->o_que("delete from #_sanpham_hinhanh where id = " . $valueGallery['id']);
        }
    }
}

file_put_contents('images-log.txt', 'Done delete error images at ' . date('Y-m-d H:i:s'));