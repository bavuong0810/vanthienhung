<?php
/**
 * Vân Thiên Hùng chuyên lừa đảo, lợi dụng tín nhiệm lừa tiền anh em lập trình.
 * Hứa hẹn thanh toán, tới ngày thì than thở kêu chưa thu được tiền từ năm này qua tháng nọ, hẹn tới hẹn lui không có hồi kết.
 * Tới lúc bị anh em Dev đòi thì xoá Zalo, đổi pass server nhằm chặn anh em Dev vào phá.
 * Đã quỵt tiền 2 người tổng cộng 70 triệu
 * Chúc may mắn cho anh em nào đang làm tiếp với Vân Thiên Hùng ^^!.
 */
define('__ROOT_PATH', dirname(__FILE__));
define('_lib','./admin/lib/');
@include _lib."config.php";
@include_once _lib."function.php";
global $d;
global $lang;
$d = new func_index($config['database']);
date_default_timezone_set('Asia/Ho_Chi_Minh');

// process for products
$query = 'SELECT `id`, `image_path` FROM #_sanpham WHERE `image_path` != "" AND `image_path` IS NOT NULL GROUP BY `image_path`';
$items = $d->o_fet($query);
$pushData = [];
$countItem = 0;
$totalItem = count($items);
foreach ($items as $key => $value) {
    if ($countItem == 100) {
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
            CURLOPT_POSTFIELDS => json_encode(['images' => $pushData]),
            CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $countItem = 0;
        $pushData = [];
    }

    $pushData[] = [
        'product_id' => $value['id'],
        'source' => getenv('APP_URL'),
        'path' => getenv('THUMB_SITE_FOLDER'),
        'image_type' => 'thumbnail',
        'image_path' => $value['image_path']
    ];
    $countItem++;

    if (($totalItem - 1) - $key == 0) {
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
            CURLOPT_POSTFIELDS => json_encode(['images' => $pushData]),
            CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
        ));

        $response = curl_exec($curl);
        curl_close($curl);
    }
}

//db_slide_sp
$slides = $d->o_fet("select * from #_slide_sp");
$sliderData = [];
foreach ($slides as $key => $slide) {
    $sliderData[] = [
        'product_id' => $slide['id'],
        'source' => getenv('APP_URL'),
        'path' => getenv('THUMB_SITE_FOLDER'),
        'image_type' => 'slide',
        'image_path' => $slide['image_path']
    ];
}
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
    CURLOPT_POSTFIELDS => json_encode(['images' => $sliderData]),
    CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
));
$response = curl_exec($curl);
curl_close($curl);

//db_gallery
$galleries = $d->o_fet("SELECT * FROM `#_gallery`");
$galleryData = [];
foreach ($galleries as $key => $gallery) {
    $galleryData[] = [
        'product_id' => $gallery['id'],
        'source' => getenv('APP_URL'),
        'path' => getenv('THUMB_SITE_FOLDER'),
        'image_type' => 'partner',
        'image_path' => $gallery['picture']
    ];
}
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
    CURLOPT_POSTFIELDS => json_encode(['images' => $galleryData]),
    CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
));
$response = curl_exec($curl);
curl_close($curl);

//Process for Gallery
$queryGallery = 'SELECT `id`, `id_sp`, `image_path` FROM #_sanpham_hinhanh WHERE `image_path` != "" AND `image_path` IS NOT NULL';
$productGalleries = $d->o_fet($queryGallery);
if (count($productGalleries) > 0) {
    $pushDataGallery = [];
    $countItemGallery = 0;
    $totalItem = count($productGalleries);
    foreach ($productGalleries as $keyG => $valueG) {
        if ($countItemGallery == 100) {
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
                CURLOPT_POSTFIELDS => json_encode(['images' => $pushDataGallery]),
                CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
            ));

            $response = curl_exec($curl);
            curl_close($curl);

            $countItemGallery = 0;
            $pushDataGallery = [];
        }

        $pushDataGallery[] = [
            'product_id' => $valueG['id_sp'],
            'source' => getenv('APP_URL'),
            'path' => getenv('THUMB_SITE_FOLDER'),
            'image_type' => 'productGallery',
            'image_path' => $valueG['image_path']
        ];
        $countItemGallery++;

        if (($totalItem - 1) - $keyG == 0) {
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
                CURLOPT_POSTFIELDS => json_encode(['images' => $pushDataGallery]),
                CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
            ));

            $response = curl_exec($curl);
            curl_close($curl);
        }
    }
}

file_put_contents('images-log.txt', 'Done sync at ' . date('Y-m-d H:i:s'));