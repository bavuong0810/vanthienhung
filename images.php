<?php
define('__ROOT_PATH', dirname(__FILE__));
define('_lib','./admin/lib/');
@include _lib."config.php";
@include_once _lib."function.php";
global $d;
global $lang;
$d = new func_index($config['database']);
date_default_timezone_set('Asia/Ho_Chi_Minh');

$query = 'SELECT `id`, `image_path` FROM #_sanpham WHERE `image_path` != "" AND `image_path` IS NOT NULL';
$items = $d->o_fet($query);

foreach ($items as $key => $value) {
    $data = [
        'product_id' => $value['id'],
        'source' => getenv('APP_URL'),
        'path' => getenv('THUMB_SITE_FOLDER'),
        'image_type' => 'thumbnail',
        'image_path' => $value['image_path']
    ];

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://images.vanthienhung.vn/api/storage-image',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    //Process for Gallery
    $queryGallery = 'SELECT `id`, `id_sp`, `image_path` FROM #_sanpham_hinhanh WHERE `image_path` != "" AND `image_path` IS NOT NULL AND `id_sp` = ' . $value['id'];
    $gallery = $d->o_fet($queryGallery);
    if (count($gallery) > 0) {
        $imagePath = [];
        foreach ($gallery as $keyG => $valueG) {
            $imagePath[] = $value['image_path'];
        }
        $data = [
            'product_id' => $value['id'],
            'source' => getenv('APP_URL'),
            'path' => getenv('THUMB_SITE_FOLDER'),
            'image_type' => 'gallery',
            'image_path' => json_encode($imagePath)
        ];
    }
}
echo 'DONE';