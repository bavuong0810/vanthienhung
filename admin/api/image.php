<?php

require_once(__ROOT_PATH . '/zthumb-config.php');

function url_to_image()
{
  $url = isset($_GET['url']) ? $_GET['url'] : '';
  if (!$url) {
    echo json_encode([
      'isSuccess' => false,
      'message' => 'Không tìm thấy link nguồn',
    ]);
    return;
  }
  $result = uploadImageFromUrl($url);
  if (!$result) {
    echo json_encode([
      'isSuccess' => false,
      '$url' => $url,
      'message' => 'Tải lên thất bại, vui lòng thử lại',
    ]);
    return;
  }

  echo json_encode([
    'isSuccess' => true,
    'result' => $result,
  ]);
}

function uploadFile()
{
  global $d;
  $fileName = $d->fns_Rand_digit(0, 9, 12);
  @$file = $d->upload_image('file', '', __ROOT_PATH . '/img_data/images/', $fileName);
  if (!$file) {
    return [
      'isSuccess' => false,
      'message' => 'Lỗi tải lên, vui lòng thử lại!',
    ];
  }

  return [
    'isSuccess' => true,
    'path' => $file,
  ];
}

function uploadImg()
{
  global $d;
  $allowExtensions = ['JPEG', 'JPG', 'PNG', 'GIF', 'TIFF'];
  $nameParts = explode('.', $_FILES['file']['name']);
	$ext = end($nameParts);
  if (!in_array(strtoupper($ext), $allowExtensions)) {
    return [
      'isSuccess' => false,
      'message' => 'Loại tệp tin không được hỗ trợ!',
    ];
  }

  $fileName = $d->fns_Rand_digit(0, 9, 12);
  @$file = $d->upload_image('file', '', __ROOT_PATH . '/img_data/images/', $fileName);
  if (!$fileName) {
    return [
      'isSuccess' => false,
      'message' => 'Lỗi tải lên, vui lòng thử lại!',
    ];
  }

  return [
    'isSuccess' => true,
    'path' => $file,
  ];
}

function uploadWatermark()
{
  global $d, $SITE_WATERMARK_LOGOS;

  if (!isset($_GET['site'])) {
    die('Not found');
  }

  $site = $_GET['site'];
  if (!isset($SITE_WATERMARK_LOGOS[$site])) {
    die('Not found');
  }

  $getFullUrl = isset($_GET['site']) ? !!$_GET['site'] : true;

  $fileName = $SITE_WATERMARK_LOGOS[$site];
  @$isSuccess = $d->upload_image('file', '', __ROOT_PATH . '/', $fileName, true);
  if (!$isSuccess) {
    return [
      'isSuccess' => false,
      'message' => 'Lỗi tải lên, vui lòng thử lại!',
    ];
  }

  $path = $fileName;
  if ($getFullUrl) {
    $path = URLPATH . $fileName . '?time=' . time();
  }

  return [
    'isSuccess' => true,
    'path' => $path,
  ];
}

function getLogoConfig() {
  global $SITE_WATERMARK_LOGOS;
  return $SITE_WATERMARK_LOGOS;
}

function isLinkOk($url) {
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  // curl_setopt($curl, CURLOPT_FILETIME, true);
  curl_setopt($curl, CURLOPT_NOBODY, true);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_HEADER, true);
  $header = curl_exec($curl);
  // $this->info = curl_getinfo($curl);
  curl_close($curl);

  return strpos(explode(PHP_EOL, $header, 2)[0], 'HTTP/1.1 200 OK') !== false;
}

function clearErrorImages() {
  global $d;

  $id = 0;
  $count = 1000;
  $base = 'https://cdn.vanthienhung.vn/img_data/images/';
  $notOkIds = [];
  
  do {
    $rows = $d->o_fet("SELECT id, image_path FROM db_sanpham WHERE id > $id AND image_path <> NULL ORDER BY id ASC LIMIT 0, 1000");
    $count = count($rows);

    foreach ($rows as $row) {
      $isOk = isLinkOk($base . $row['image_path']);
      if (!$isOk) {
        echo "\n\n{$row['id']} - IS ERRORRRRRRRRR - {$row['image_path']}\n\n";
        $notOkIds[] = $row['id'];
      } else {
        echo "\n{$row['id']} - IS OK\n";
      }
    }
  } while ($count == 1000);

  $result = json_encode($notOkIds);
  file_put_contents('not_ok.json', $result);
  echo $result;
}

function getImages() {
  global $d;

  $id = intval($_GET['id']);
  $limit = intval($_GET['limit']) ?: 1000;
  if ($limit > 5000) {
    $limit = 1000;
  }
  return $d->o_fet("SELECT id, image_path FROM db_sanpham WHERE id > $id AND image_path IS NOT NULL ORDER BY id ASC LIMIT 0, " . $limit);
}

function getSlideImages() {
  global $d;

  $id = intval($_GET['id']);
  $limit = intval($_GET['limit']) ?: 1000;
  if ($limit > 5000) {
    $limit = 1000;
  }
  return $d->o_fet("SELECT id, image_path FROM db_sanpham_hinhanh WHERE id > $id ORDER BY id ASC LIMIT 0, " . $limit);
}

function getSlideImagesByProduct() {
  global $d;

  $id = intval($_GET['id']);
  $limit = intval($_GET['limit']) ?: 1000;
  if ($limit > 5000) {
    $limit = 1000;
  }
  return $d->o_fet("SELECT id, image_path, hien_thi, title FROM db_sanpham_hinhanh WHERE id_sp = $id ORDER BY id ASC LIMIT 0, " . $limit);
}

function removeErrorImages() {
  global $d;

  $dataStr = file_get_contents('https://cdn.vanthienhung.vn/error_images.json');
  $data = json_decode($dataStr, 1);
  $chunks = array_chunk($data, 3000);

  
  foreach ($chunks as $chunk) {
    $d->query('UPDATE db_sanpham SET image_path = NULL WHERE id IN('.implode(',', $chunk).');');
  }
  echo "\n";
  echo 'TOTAL: ' . count($data);
  echo "\n";
  echo 'CHUNKS: ' . count($chunks);
}

function removeErrorSlideImages() {
  global $d;

  $dataStr = file_get_contents('https://cdn.vanthienhung.vn/error_slide_images.json');
  $data = json_decode($dataStr, 1);
  $chunks = array_chunk($data, 3000);
  
  foreach ($chunks as $chunk) {
    $d->query('DELETE FROM db_sanpham_hinhanh WHERE id IN('.implode(',', $chunk).');');
  }
  echo "\n";
  echo 'TOTAL: ' . count($data);
  echo "\n";
  echo 'CHUNKS: ' . count($chunks);
}

function checkRemoveErrorImages() {
  global $d;

  $id = intval($_GET['id']) ?: 0;
  $limit = intval($_GET['limit']) ?: 1000;
  $ref = str_replace('www.', '', $_SERVER["SERVER_NAME"]);
  
  $dataStr = file_get_contents('https://cdn.vanthienhung.vn/cdn/api.php?func=checkImages&id=' . $id . '&limit=' . $limit . '&ref=' . $ref);
  $data = json_decode($dataStr, 1);
  $chunks = array_chunk($data['errorIds'], 3000);

  foreach ($chunks as $chunk) {
    if (is_array($chunk) && count($chunk) > 0 ) {
      $d->query('UPDATE db_sanpham SET image_path = NULL WHERE id IN('.implode(',', $chunk).');');
    }
  }

  return $data;
}

function checkRemoveErrorSlideImages() {
  global $d;

  $id = intval($_GET['id']) ?: 0;
  $limit = intval($_GET['limit']) ?: 1000;
  $ref = str_replace('www.', '', $_SERVER["SERVER_NAME"]);
  
  $dataStr = file_get_contents('https://cdn.vanthienhung.vn/cdn/api.php?func=checkSlideImages&id=' . $id . '&limit=' . $limit . '&ref=' . $ref);
  $data = json_decode($dataStr, 1);
  $chunks = array_chunk($data['errorIds'], 3000);

  foreach ($chunks as $chunk) {
    if (is_array($chunk) && count($chunk) > 0 ) {
      $d->query('DELETE FROM db_sanpham_hinhanh WHERE id IN('.implode(',', $chunk).');');
    }
  }

  return $data;
}
