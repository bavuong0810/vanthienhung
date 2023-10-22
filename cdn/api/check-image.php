<?php

function checkImages()
{
  $id = intval($_GET['id']) ?: 0;
  $limit = intval($_GET['limit']) ?: 1000;
  $dataStr = file_get_contents('https://vanthienhung.vn/admin/api-public.php?func=getImages&id=' . $id . '&limit=' . $limit);
  $rows = json_decode($dataStr, 1);
  $count = count($rows);
  $lastId = $rows[$count - 1]['id'];
  $errorCount = 0;

  $errorIds = [];
  foreach ($rows as $row) {
    if (file_exists(__ROOT_PATH . '/img_data/images/' . $row['image_path'])) {
      // echo "\n{$row['id']} - OK\n";
    } else {
      // echo "\n{$row['id']} - ERROR - {$row['image_path']}\n";
      $errorCount++;
      $errorIds[] = $row['id'];
    }
  }

  return [
    'isEnd' => $limit > $count,
    'errorIds' => $errorIds,
    'lastId' => $lastId,
  ];
}

function checkSlideImages()
{
  $id = intval($_GET['id']) ?: 0;
  $limit = intval($_GET['limit']) ?: 1000;
  $dataStr = file_get_contents('https://vanthienhung.vn/admin/api-public.php?func=getSlideImages&id=' . $id . '&limit=' . $limit);
  $rows = json_decode($dataStr, 1);
  $count = count($rows);
  $lastId = $rows[$count - 1]['id'];
  $errorCount = 0;

  $errorIds = [];
  foreach ($rows as $row) {
    if (file_exists(__ROOT_PATH . '/img_data/images/' . $row['image_path'])) {
      // echo "\n{$row['id']} - OK\n";
    } else {
      // echo "\n{$row['id']} - ERROR - {$row['image_path']}\n";
      $errorCount++;
      $errorIds[] = $row['id'];
    }
  }

  return [
    'isEnd' => $limit > $count,
    'errorIds' => $errorIds,
    'lastId' => $lastId,
  ];
}
