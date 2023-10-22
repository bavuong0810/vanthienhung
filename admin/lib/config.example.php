<?php
$rootPath = dirname(dirname(__DIR__));
include_once $rootPath . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable($rootPath);
$dotenv->load();

function env($name, $default) {
  return getenv($name) ?: $default;
}

//	$rf = str_replace('www.', '', $_SERVER["SERVER_NAME"]);
$rf = 'localhost';
$config['database']['refix'] = "db_";
$config['database']['servername'] = 'mysql';
$config['database']['username'] = 'vanthienhud22a';
$config['database']['password'] = '5551009547f5cbff';
$config['database']['database'] = 'vanthienhun_d22a';
$config['database']['common_table_prefix'] = 'db_';
$config['database']['common_tables'] = ['sanpham', 'sanpham_hinhanh', 'group', 'category', 'brand_group', 'brand', 'user', 'user_permission_group', 'permission_group', 'delivery_area'];

$config['data'] = [
  'columns' => [
    'show' => env('DATA_SHOW_COLUMN', 'hien_thi'),
    'all_shows' => [
      'hien_thi' => 'Vân Thiên Hùng',
      'visible_bd' => 'Bình Dương',
      'visible_hn' => 'Hà Nội',
      'visible_dn' => 'Đồng Nai',
      'visible_nguyenle' => 'Nguyên Lê',
    ],
  ],
];

define("URLPATH", "http://" . $rf . "/");
define("FILEURL", "https://vanthienhung.vn/");
define("urladmin", "http://" . $rf . "/admin/");
define("DEFAULT_PRODUCT_IMAGE", getenv('DEFAULT_PRODUCT_IMAGE') ?: 'no-image.jpg');
