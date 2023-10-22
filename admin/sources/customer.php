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
case "replace":
	replace();
	break;
default:
	$template = "index";
}

function showdulieu() {
	global $d, $items, $paging, $p, $fields;

	if (isset($_GET['remove_filter'])) {
		unset($_SESSION['brand_search']);
		$d->redirect('index.php?p='.$p.'&a=man');
		exit;
	}

	$fieldNamesToSearch = [
		"ho_ten",
		"so_dien_thoai",
		"email",
		"dia_chi",
	];
	
	// Prepare query
	$query = 'SELECT * FROM #_khachhang';
	$wheres = [];
	if (isset($_GET['seach'])) {
		$search = addslashes($_GET['seach']);
		$key = (isset($_GET['key'])) ? addslashes($_GET['key']) : "";
		if ($seach == 'id') {
			$wheres[] = "id = " . intval($key) . "";
		} else {
			$wheres[] = $search . " LIKE '%" . $key . "%'";
		}
	}

	if (isset($_GET['search'])) {
		if (!empty($_POST['fields']) || !empty($_SESSION['brand_search'])) {
			$fields = !empty($_POST['fields']) ? $_POST['fields'] : $_SESSION['brand_search'];
			$_SESSION['brand_search'] = $fields;
			foreach ($fields as $index => $field) {

				if ($field['name'] == 'image') {
					if ($field['value'] == 1) {
						$wheres[] = 'image IS NOT NULL';
					} else {
						$wheres[] = 'image IS NULL';
					}
					
					continue;
				}

				if ($field['name'] == 'all_field') {
					$whereAll = [];
					foreach ($fieldNamesToSearch as $fieldName) {
						if ($field['compare'] == 'like') {
							$value = empty($field['value']) ? '\'\'' : '\'%' . $field['value'] . '%\'';
							$whereAll[] = $fieldName . ' ' . $field['compare'] . ' ' . $value;
						} else if ($field['compare'] == 'start') {
							$field['compare'] = 'like';
							$value = empty($field['value']) ? '\'\'' : '\'' . $field['value'] . '%\'';
							$whereAll[] = $fieldName . ' ' . $field['compare'] . ' ' . $value;
						} else {
							$value = empty($field['value']) ? '\'\'' : $field['value'];
							
							if (empty($field['value'])) {
								$whereAll[] = $fieldName . ' IS NULL';
							} else {
								$whereAll[] = '(CAST(' . $fieldName . ' AS CHAR) ' . $field['compare'] . ' \'' . $value . '\' AND ' . $fieldName . ' IS NOT NULL)';
							}
						}
					}
					$wheres[] = ' (' . implode(' OR ', $whereAll) . ') ';

					continue;
				}

				$field['value'] = $d->clear(addslashes($field['value']));
				if($field['compare'] == 'like') {
					$field['value'] = '\'%'.$field['value'].'%\'';
				} else if ($field['compare'] == 'start') {
						$field['compare'] = 'like';
						$field['value'] = '\''.$field['value'].'%\'';
				} else {
					$field['value'] = '\''.$field['value'].'\'';
				}
				
				$wheres[] = $field['name'] . ' ' . $field['compare'] . ' ' . (empty($field['value']) ? '\'\'' : $field['value']);
			}
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
	$maxR = $d->lay_show_hienthi(addslashes($_GET['hienthi']) ?: 1);
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

	$data = [];
	$fields = ['ho_ten', 'email', 'so_dien_thoai', 'dia_chi', 'hien_thi'];
	foreach ($fields as $field) {
		$data[$field] = $d->clear(addslashes($_POST[$field]));
	}

	$data['hien_thi'] = $data['hien_thi'] ? 1 : 0;
	$data['ngay_dang'] = time();
	$data['name_vi'] = $data['ho_ten'];
	$data['mat_khau'] = md5(md5('123123'));
	$queryExisted = "SELECT * FROM #_khachhang WHERE email = '".$data['email']."'";
	if (!empty($id)) {
		$queryExisted .= "AND id <> " . intval($id);
	}
	$isExisted = $d->o_fet($queryExisted);
	if (!empty($isExisted[0])) {
		return $d->transfer('Đã tồn tại email này!', "index.php?p=".$p."&a=add");
	}

	if ($id != '') {
		$d->setTable('#_khachhang');
		$d->setWhere('id', $id);
		if ($d->update($data)) {
			$d->transfer("Cập nhật dữ liệu thành công", "index.php?p=".$p."&a=edit&id=".$id);
		} else {
			//echo mysql_error();
			$d->transfer("Cập nhật dữ liệu bị lỗi!", "index.php?p=".$p."&a=edit&id=".$id);
		}
	} else {
		$d->setTable('#_khachhang');
		if ($id = $d->insert($data)) {
			$d->transfer("Cập nhật dữ liệu thành công!", "index.php?p=".$p."&a=edit&id=".$id);
		} else {
			echo $d->sql;
			echo mysql_error();
			$d->transfer("Thêm dữ liệu bị lỗi!", "index.php?p=".$p."&a=add");
		}
	}

}
function view() {
	global $d, $items, $dh, $p, $brands, $brandGroups;

	$id = (isset($_REQUEST['id'])) ? addslashes($_REQUEST['id']) : "";
	if ($id == '') {
		$d->alert("Không nhận được dữ liệu");
		$d->redirect("index.php?p=".$p."&a=man&page=" . @$_REQUEST['page'] . "");
	} else {
		$items = $d->o_fet("SELECT b.* from #_khachhang b WHERE b.id = '" . $id . "'");
	}
}

function singleDelete() {
	global $d, $p;
	if (isset($_GET['id'])) {
		$id = addslashes($_GET['id']);

		$d->reset();
		$d->setTable('#_khachhang');
		$d->setWhere('id', $id);
		if (!$d->delete()) {
			$d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=".$p."&a=man");
			return false;
		}

		$d->redirect("index.php?p=".$p."&a=man&page=" . @$_REQUEST['page']);
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
	if (!$d->o_que("DELETE FROM #_khachhang WHERE id IN ($chuoi)")) {
		$d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=".$p."&a=man");
	}

	$d->redirect("index.php?p=".$p."&a=man&page=" . @$_REQUEST['page']);
}
