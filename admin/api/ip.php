<?php

function banIp()
{
  global $d;

  $ip = $_GET['ip'];

  $result = $d->query("INSERT INTO `#_banned_ip`(`ip`, `time`, `total`, `is_banned`, `updated_at`) VALUES('$ip', NOW(), 1, 1, NOW()) ON DUPLICATE KEY UPDATE `is_banned` = 1, `total` = `total` + 1, `updated_at` = NOW()");

  // header('Content-type: application/json');

  echo $result;
}

function unbanIp()
{
  global $d;

  $ip = $_GET['ip'];

  $result = $d->query("UPDATE `#_banned_ip` SET `is_banned` = 0 WHERE `ip` = '$ip'");

  // header('Content-type: application/json');

  echo $result;
}

function warningIp()
{
  global $d;

  $ip = $_GET['ip'];

  $result = $d->query("INSERT INTO `#_warning_ip`(`ip`, `status`, `created_at`, `updated_at`) VALUES('$ip', 1, NOW(), NOW()) ON DUPLICATE KEY UPDATE `status` = 1, `updated_at` = NOW()");

  // header('Content-type: application/json');

  echo $result;
}

function unwarningIp()
{
  global $d;

  $ip = $_GET['ip'];

  $result = $d->query("UPDATE `#_warning_ip` SET `status` = 0 WHERE `ip` = '$ip'");

  // header('Content-type: application/json');

  echo $result;
}

function getIpInfoOfDate()
{
  global $d;

  $ip = $_GET['ip'];
  $date = $_GET['date'];

  $info = $d->o_fet("SELECT v.`id_sanpham`, v.`time`, sp.`alias_vi`, sp.`name_vi` FROM `#_view` v INNER JOIN `#_sanpham` sp ON v.`id_sanpham` = sp.`id` WHERE v.`id_sanpham` <> 0 AND v.`ip` = '$ip' AND v.`time` BETWEEN '$date 00:00:00' AND '" . $date . " 23:59:59' ORDER BY v.`time`");

  header('Content-type: application/json');
  echo json_encode($info);
}

function getIpInfoOfTime()
{
  global $d;

  $ip = $_GET['ip'];
  $startDate = $_GET['startDate'];
  $endDate = $_GET['endDate'];

  $info = $d->o_fet("SELECT v.`id_sanpham`, v.`time`, sp.`alias_vi`, sp.`name_vi` FROM `#_view` v INNER JOIN `#_sanpham` sp ON v.`id_sanpham` = sp.`id` WHERE v.`id_sanpham` <> 0 AND v.`ip` = '$ip' AND v.`time` BETWEEN '$startDate 00:00:00' AND '" . $endDate . " 23:59:59' ORDER BY v.`time`");

  header('Content-type: application/json');
  echo json_encode($info);
}
