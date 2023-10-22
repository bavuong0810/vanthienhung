<?php
if (!defined('_source')) {
	die("Error");
}

include_once _ROOT . "/smtp/index.php";

$a = (isset($_REQUEST['a'])) ? addslashes($_REQUEST['a']) : "";
$p = (isset($_REQUEST['p'])) ? addslashes($_REQUEST['p']) : "";
switch ($a) {
case "man":
	showdulieu();
	$template = $p . "/hienthi";
	break;
case "add":
	showdulieu();
	$template = $p . "/them";
	break;
case "save":
	luudulieu();
	break;
case "edit":
	view();
	$template = $p . "/them";
	break;
case "view":
	view();
	$template = $p . "/view";
	break;
case "delete":
	singleDelete();
	break;
case "delete_all":
	multiDelete();
	break;
default:
	$template = "index";
}

function showdulieu() {
	global $d, $items, $paging, $loai, $hang, $p;
	
	// Prepare query
	$query = 'SELECT * FROM #_baohanh';
	$wheres = [];
	if (isset($_GET['seach'])) {
		$seach = addslashes($_GET['seach']);
		$key = (isset($_GET['key'])) ? addslashes($_GET['key']) : "";
		if ($seach == 'id') {
			$wheres[] = "id = " . intval($key) . "";
		} else {
			$wheres[] = $search . " like '%" . $key . "%'";
		}
	}

	if (!empty($wheres)) {
		$query .= ' WHERE ' . implode(' AND ', $wheres);
	}

	if (!empty($_GET['orderby'])) {
		$orderby = str_replace('-', ' ', $_GET['orderby']);
		$query .= " ORDER BY " . $orderby;
	} else {
		$query .= " ORDER BY id DESC";
	}

	// phan trang
	if (isset($_GET['hienthi'])) {
		$maxR = $d->lay_show_hienthi(addslashes($_GET['hienthi']));
	} else {
		$maxR = 35;
	}
	$page = isset($_GET['page']) && $_GET['page'] > 1 ? addslashes($_GET['page']) : 1;
	$offset = ($page - 1) * $maxR;

	// get total records for paging
	$queryCount = str_replace('*', 'count(id) as totalRecords', $query);
	$countResult = $d->o_fet($queryCount);
	$totalRecords = $countResult[0]['totalRecords'];

	// get items
	$query .= " limit $offset, $maxR";

	$items = $d->o_fet($query);

	$url = $d->fullAddress();
	$maxP = $maxR;
	$paging = $d->phantrang($totalRecords, $url, $page, $maxR, $maxP, 'classunlink', 'classlink', 'page');
}

function luudulieu() {
	global $d, $p;

	$id = (isset($_REQUEST['id'])) ? addslashes($_REQUEST['id']) : "";

	$data = ['updated_at' => date('Y-m-d H:i:s')];
	$fields = ['specification', 'code', 'start_at', 'end_at'];
	foreach ($fields as $field) {
		$data[$field] = $d->clear(addslashes($_POST[$field]));
	}
	if ($data['start_at']) {
		$data['start_at'] = DateTime::createFromFormat('!d-m-Y', $data['start_at'])->format('Y-m-d H:i:s');
	}
	if ($data['end_at']) {
		$data['end_at'] = DateTime::createFromFormat('!d-m-Y', $data['end_at'])->format('Y-m-d H:i:s');
	}

	if ($id != '') {
		$d->setTable('#_baohanh');
		$d->setWhere('id', $id);
		if ($d->update($data)) {
			$d->redirect("index.php?p=".$p."&a=view&id=".$id);
		} else {
			//echo mysql_error();
			$d->transfer("Cập nhật dữ liệu bị lỗi!", "index.php?p=".$p."&a=edit&id=".$id);
		}
	} else {
		$data['created_at'] = date('Y-m-d H:i:s');
		$d->setTable('#_baohanh');
		if ($id = $d->insert($data)) {
			$d->redirect("index.php?p=".$p."&a=man");
		} else {
			echo $d->sql;
			echo mysql_error();
			$d->transfer("Thêm dữ liệu bị lỗi!", "index.php?p=".$p."&a=add");
		}
	}

}
function view() {
	global $d, $items, $dh, $p;
	$id = (isset($_REQUEST['id'])) ? addslashes($_REQUEST['id']) : "";
	if ($id == '') {
		$d->alert("Không nhận được dữ liệu");
		$d->redirect("index.php?p=".$p."&a=man&page=" . @$_REQUEST['page'] . "");
	} else {
		$items = $d->o_fet("SELECT * from #_baohanh WHERE id = '" . $id . "'");
	}
}

function singleDelete() {
	global $d, $p;
	if (isset($_GET['id'])) {
		$id = addslashes($_GET['id']);

		$d->reset();
		$d->setTable('#_baohanh');
		$d->setWhere('id', $id);
		if ($d->delete()) {
			$d->redirect("index.php?p=".$p."&a=man&page=" . @$_REQUEST['page'] . "");
		} else {
			$d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=".$p."&a=man");
		}
	} else {
		$d->transfer("Không nhận được dữ liệu", "index.php?p=".$p."&a=man");
	}

}

function multiDelete() {
	global $d, $p;
	if (!isset($_POST['chk_child'])) {
		$d->redirect("index.php?p=".$p."&a=man&page=" . @$_REQUEST['page'] . "");
		return;
	}

	$chuoi = implode(', ', $_POST['chk_child']);
	if ($d->o_que("DELETE FROM #_baohanh WHERE id IN ($chuoi)")) {
		$d->redirect("index.php?p=".$p."&a=man&page=" . @$_REQUEST['page'] . "");
	} else {
		$d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=".$p."&a=man");
	}
}