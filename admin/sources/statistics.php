<?php
$action = $_GET['a'];
$dateFormat = 'Y-m-d';

if ($action == 'perMonth') {
	$template = @$_REQUEST['p']."/month";

	$endDate = $_GET['endDate'] ? $_GET['endDate'] : date($dateFormat);
	$startDate = $_GET['startDate'] ? $_GET['startDate'] : date($dateFormat, strtotime("-29 days", strtotime($endDate)));

	$ipEndDate = $_GET['ipEndDate'] ? $_GET['ipEndDate'] : date('Y-m-d');
	$ipStartDate = $_GET['ipStartDate'] ? $_GET['ipStartDate'] : date($dateFormat, strtotime("-29 days", strtotime($ipEndDate)));

	$inDateProducts = $d->o_fet("SELECT `id_sanpham`, sp.`id`, `time`, `code`, `name_vi`, `image_path`, `alias_vi`, `is_completed`, COUNT(`time`) as `views`, `price`, `promotion_price` FROM `#_view` v INNER JOIN `#_sanpham` sp ON v.`id_sanpham` = sp.`id` WHERE `id_sanpham` <> 0 AND `is_bot` <> 1 AND `time` BETWEEN '$startDate 00:00:00' AND  '$endDate 23:59:59' GROUP BY `id_sanpham` ORDER BY `views` DESC");

	$countInDateProducts = $d->o_fet("SELECT COUNT(DISTINCT `id_sanpham`) as `total` FROM `#_view` WHERE `id_sanpham` <> 0 AND `is_bot` <> 1 AND `time` BETWEEN '$startDate 00:00:00' AND '$endDate 23:59:59'");
	$countInDateProducts = $countInDateProducts[0]['total'];

	$viewIpDate = $_GET['ipDate'] ? $_GET['ipDate'] : date('Y-m-d');
	$inDateIps = $d->o_fet("SELECT v.*, count(DISTINCT v.`id_sanpham`) as totalProduct, count(v.`id`) as `totalView`, bi.is_banned FROM `#_view` v LEFT JOIN `#_banned_ip` bi ON v.`ip` = bi.`ip` WHERE `id_sanpham` <> 0 AND `is_bot` <> 1 AND v.`ip` IS NOT NULL AND v.`time` BETWEEN '$ipStartDate 00:00:00' AND  '$ipEndDate 23:59:59' GROUP BY v.`ip`");

	$countInDateIps = $d->o_fet("SELECT COUNT(DISTINCT `ip`) as `total` FROM `#_view` WHERE `is_bot` <> 1 AND `time` BETWEEN '$ipStartDate 00:00:00' AND '$ipEndDate 23:59:59'");
	$countInDateIps = $countInDateIps[0]['total'];

	$inMonthDateViews = $d->o_fet("SELECT DATE(`time`) as `date`, COUNT(`time`) as `views` FROM `#_view` WHERE `id_sanpham` <> 0 AND `is_bot` <> 1 AND `time` BETWEEN '".$startDate." 00:00:00' AND '".$endDate." 23:59:59' GROUP BY DATE(`time`)");

	$inMonthDateIps = $d->o_fet("SELECT DATE(`time`) as `date`, COUNT(DISTINCT `ip`) as `ips` FROM `#_view` WHERE `id_sanpham` <> 0 AND `is_bot` <> 1 AND `time` BETWEEN '".$startDate." 00:00:00' AND '".$endDate." 23:59:59' GROUP BY DATE(`time`)");
	
	// $inMonthDateViews = $d->o_fet("SELECT DATE(`time`) as `date`, COUNT(`time`) as `views` FROM `#_view` WHERE `is_bot` <> 1 AND `time` > '".date('Y-m-d', strtotime("-29 days", strtotime(date('Y-m-d'))))." 00:00:00' GROUP BY DATE(`time`)");

	// $inMonthDateIps = $d->o_fet("SELECT DATE(`time`) as `date`, COUNT(DISTINCT `ip`) as `ips` FROM `#_view` WHERE `is_bot` <> 1 AND `time` > '".date('Y-m-d', strtotime("-29 days", strtotime(date('Y-m-d'))))." 00:00:00' GROUP BY DATE(`time`)");

} else if ($action == 'perDay') {
	$template = @$_REQUEST['p']."/index";
	$viewDate = $_GET['date'] ? $_GET['date'] : date('Y-m-d');

	$inDateProducts = $d->o_fet("SELECT v.`region`, v.`ip`, `id_sanpham`, sp.`id`, `time`, `code`, `name_vi`, `image_path`, `alias_vi`, `is_completed`, COUNT(`time`) as `views`, `price`, `promotion_price` FROM `#_view` v INNER JOIN `#_sanpham` sp ON v.`id_sanpham` = sp.`id` WHERE `id_sanpham` <> 0 AND `is_bot` <> 1 AND `time` BETWEEN '$viewDate 00:00:00' AND  '$viewDate 23:59:59' GROUP BY `id_sanpham` ORDER BY `views` DESC");

	$countInDateProducts = $d->o_fet("SELECT COUNT(DISTINCT `id_sanpham`) as `total` FROM `#_view` WHERE `id_sanpham` <> 0 AND `is_bot` <> 1 AND `time` BETWEEN '$viewDate 00:00:00' AND '$viewDate 23:59:59'");
	$countInDateProducts = $countInDateProducts[0]['total'];

	$viewIpDate = $_GET['ipDate'] ? $_GET['ipDate'] : date('Y-m-d');
	$inDateIps = $d->o_fet("SELECT v.*, count(DISTINCT v.`id_sanpham`) as totalProduct, count(v.`id`) as `totalView`, bi.is_banned FROM `#_view` v LEFT JOIN `#_banned_ip` bi ON v.`ip` = bi.`ip` WHERE `id_sanpham` <> 0 AND v.`ip` IS NOT NULL AND v.`time` BETWEEN '$viewIpDate 00:00:00' AND  '$viewIpDate 23:59:59' GROUP BY v.`ip` ORDER BY v.`time` DESC");

	$countInDateIps = $d->o_fet("SELECT COUNT(DISTINCT `ip`) as `total` FROM `#_view` WHERE `id_sanpham` <> 0 AND `is_bot` <> 1 AND `time` BETWEEN '$viewDate 00:00:00' AND '$viewDate 23:59:59'");
	$countInDateIps = $countInDateIps[0]['total'];

	$inMonthDateViews = $d->o_fet("SELECT DATE(`time`) as `date`, COUNT(`time`) as `views` FROM `#_view` WHERE `id_sanpham` <> 0 AND `is_bot` <> 1 AND `time` > '".date('Y-m-d', strtotime("-29 days", strtotime(date('Y-m-d'))))." 00:00:00' GROUP BY DATE(`time`)");

	$inMonthDateIps = $d->o_fet("SELECT DATE(`time`) as `date`, COUNT(DISTINCT `ip`) as `ips` FROM `#_view` WHERE `id_sanpham` <> 0 AND `is_bot` <> 1 AND `time` > '".date('Y-m-d', strtotime("-29 days", strtotime(date('Y-m-d'))))." 00:00:00' GROUP BY DATE(`time`)");
} else if ($action = 'warningIps') {
	$template = @$_REQUEST['p']."/warningIps";

	// $inDateIps = $d->o_fet("SELECT ");
}
?>