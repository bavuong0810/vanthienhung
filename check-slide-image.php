<?php
echo "start checking\n";
$id = 0;
$errorIds = [];
do {
  $dataStr = file_get_contents('https://vanthienhung.vn/admin/api-public.php?func=getSlideImages&id=' . $id);
  $rows = json_decode($dataStr, 1);
  $count = count($rows);
  $id = $rows[$count - 1]['id'];
  $errorCount = 0;

  foreach ($rows as $row) {
    if (file_exists('./img_data/images/' . $row['image_path'])) {
      // echo "\n{$row['id']} - OK\n";
    } else {
      // echo "\n{$row['id']} - ERROR - {$row['image_path']}\n";
      $errorCount++;
      $errorIds[] = $row['id'];
    }
  }

  echo "\n\n====> PART ERROR COUNT $errorCount\n\n";
} while ($count >= 1000);

$result = json_encode($errorIds);
file_put_contents('error_slide_images.json', $result);

$cleanResult = '';
if (count($errorIds) > 0) {
  $cleanResult = file_get_contents('https://vanthienhung.vn/admin/api-public.php?func=removeErrorSlideImages');
}

// send message to telegram
file_get_contents('https://api.telegram.org/bot1969674852:AAHQ-Tfxm1tze2sFqhV23RY09aN5AX3v67I/sendMessage?chat_id=-641791123&parse_mode=markdown&text=%0A*VTH*%0A_Clean%20'.count($errorIds).'%20slides%20image%20successfully_%0A' . urlencode($cleanResult));
