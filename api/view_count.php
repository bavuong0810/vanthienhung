<?php
require __DIR__ . '/../vendor/autoload.php';
use GeoIp2\Database\Reader;

function view() {
	global $d;

	// Diable cache
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");

	// get client info
	$userAgent = $d->clear(addslashes($_SERVER['HTTP_USER_AGENT']));
	$isBot = view_bot_detect() ? 1 : 0;
	$ip = $d->get_client_ip();

	// update product view if has productId
	$productId = isset($_GET['productId']) ? intval($_GET['productId']) : 0;
	if ($productId != 0) {
		$query_update_view = "UPDATE `#_sanpham` SET `view` = `view` + 1 where `id` = ".$productId;
		$d->query($query_update_view);
	}

    // check column region, if not add column region
    $link = mysqli_connect($d->servername, $d->username, $d->password, $d->database);
    $result = mysqli_query($link,"SHOW COLUMNS FROM `" . $d->refix . "view` LIKE 'region'");
    $exists = ($result->current_field == 0) ? false : true;
    if (!$exists) {
        $query = "ALTER TABLE `" . $d->refix . "view` ADD `region` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL AFTER `is_bot`";
        mysqli_query($link, $query);
    }

    // get location by ip
    if ($ip != '127.0.0.1') {
        $dbLocation = $_SERVER["DOCUMENT_ROOT"] . '/admin/assets/GeoLite2-City.mmdb';
        $cityDbReader = new Reader($dbLocation);
        $record = $cityDbReader->city($ip);
        $region = $record->city->names['en'];
    } else {
        $region = '';
    }

	$query_update_view = "INSERT INTO `#_view`(`id_sanpham`, `time`, `ip`, `user_agent`, `is_bot`, `region`)
		VALUES(" . $productId . ", '" . date("Y-m-d H:i:s") . "', '" . $ip . "', '" . $userAgent . "', " . $isBot . ", '" . $region . "')";
	$d->query($query_update_view);
}

function view_bot_detect() {
  return (
    isset($_SERVER['HTTP_USER_AGENT'])
    && preg_match('/bot|crawl|slurp|spider|mediapartners/i', $_SERVER['HTTP_USER_AGENT'])
  );
}