<?php
// $watermark = file_get_contents('image_watermark.data');

$DEFAULT_IMAGE = 'error.jpg';

$SITE_WATERMARKS = [
  '' => 'watermark_vth.png',
  'default' => 'watermark_vth.png',
  'vth' => 'watermark_vth.png',
  'vthcom' => 'watermark_vthcom.png',
  'vthcomvn' => 'watermark_vthcomvn.png',
  'dn' => 'watermark_dn.png',
  'bd' => 'watermark_bd.png',
  'bdcomvn' => 'watermark_bdcomvn.png',
  'hn' => 'watermark_hn.png',
  'local' => 'watermark_local.png',
];
$SITE_WATERMARK_LOGOS = [
  '' => 'watermark_vth.png',
  'default' => 'watermark_vth.png',
  'vth' => 'watermark_vth.png',
  'dn' => 'watermark_dn.png',
  'bd' => 'watermark_bd.png',
  'bdcomvn' => 'watermark_bdcomvn.png',
  'hn' => 'watermark_hn.png',
  'local' => 'watermark_local.png',
];

$SITES = [
  '' => 'https://vanthienhung.vn',
  'default' => 'https://vanthienhung.vn',
  'vth' => 'https://vanthienhung.vn',
  'vthcom' => 'https://vanthienhung.com',
  'vthcomvn' => 'https://vanthienhung.com.vn',
  'bd' => 'https://congnghiepbinhduong.vn',
  'bdcomvn' => 'https://congnghiepbinhduong.com.vn',
  'dn' => 'https://congnghiepdongnai.vn',
  'hn' => 'https://congnghiephanoi.vn',
  'local' => 'http://localhost',
];

// $watermark = file_get_contents('image_watermark.data');
// if (!empty($watermark)) {
//   foreach ($SITE_WATERMARKS as $key) {
//     $SITE_WATERMARKS[$key] = $watermark;
//   }
//   foreach ($SITE_WATERMARK_LOGOS as $key) {
//     $SITE_WATERMARK_LOGOS[$key] = $watermark;
//   }
// }

// $defaultImage = file_get_contents('default_product_image.data');
// if (!empty($defaultImage)) {
//   $DEFAULT_IMAGE = $defaultImage;
// }

define('DEFAULT_OPTION_WATERMARK', false);
define('DEBUG_ON', false);
