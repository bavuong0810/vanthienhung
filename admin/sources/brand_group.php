<?php
/**
 * Vân Thiên Hùng chuyên lừa đảo, lợi dụng tín nhiệm lừa tiền anh em lập trình.
 * Hứa hẹn thanh toán, tới ngày thì than thở kêu chưa thu được tiền từ năm này qua tháng nọ, hẹn tới hẹn lui không có hồi kết.
 * Tới lúc bị anh em Dev đòi thì xoá Zalo, đổi pass server nhằm chặn anh em Dev vào phá.
 * Đã quỵt tiền 2 người tổng cộng 70 triệu
 * Chúc may mắn cho anh em nào đang làm tiếp với Vân Thiên Hùng ^^!.
 */
if (!defined('_source')) {
	die("Error");
}

$a = (isset($_REQUEST['a'])) ? addslashes($_REQUEST['a']) : "";
$p = 'brand_group';
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
	global $d, $items, $paging, $loai, $hang, $p, $fields;

	if (isset($_GET['remove_filter'])) {
		unset($_SESSION[$p.'_search']);
		$d->redirect('index.php?p='.$p.'&a=man');
		exit;
	}

	$fieldNamesToSearch = [
		"name_vi",
		"name_en",
		"name_ch",
	];
	
	// Prepare query
	$query = 'SELECT * FROM #_brand_group';
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
		if (!empty($_POST['fields']) || !empty($_SESSION[$p.'_search'])) {
			$fields = !empty($_POST['fields']) ? $_POST['fields'] : $_SESSION[$p.'_search'];
			$_SESSION[$p.'_search'] = $fields;
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

	// Prepare data
	$data = [];
	$fields = ['name_vi', 'name_en', 'name_ch', 'is_show', 'weight'];
	foreach ($fields as $field) {
		$data[$field] = $d->clear(addslashes($_POST[$field]));
	}
	$data['is_show'] = $data['is_show'] ? 1 : 0;
	$data['weight'] = intval($data['weight']);

	// Check existed
	$queryExisted = "SELECT * FROM #_brand_group WHERE name_vi = '".$data['name_vi']."'";
	if (!empty($id)) {
		$queryExisted .= "AND id <> " . intval($id);
	}
	$isExisted = $d->o_fet($queryExisted);
	if (!empty($isExisted[0])) {
		return $d->transfer('Đã tồn tại!', "index.php?p=".$p."&a=add");
	}

	// Upload image
	$fileName = $d->fns_Rand_digit(0,9,12);
	if ($_FILES['image'] && $image = $d->upload_image("image", '', '../img_data/images/', $fileName)) {
		$data['image'] = $image;
	}

	// Update data if edit
	if ($id != '') {
		// Remove old image
		if ($data['image']) {
			$oldImage = $d->o_fet("SELECT * FROM #_brand_group WHERE id = ".$id);
			if (!empty($oldImage[0]['image'])) {
				unlink('../img_data/images/'.$oldImage[0]['image']);
			}
		}

		// Update data
		$d->setTable('#_brand_group');
		$d->setWhere('id', $id);
		if ($d->update($data)) {
			return $d->redirect("index.php?p=".$p."&a=edit&id=".$id);
		}
		
		//echo mysql_error();
		$d->transfer("Cập nhật dữ liệu bị lỗi!", "index.php?p=".$p."&a=edit&id=".$id);
		return;
	}

	$d->setTable('#_brand_group');
	if ($id = $d->insert($data)) {
		$d->redirect("index.php?p=".$p."&a=edit&id=".$id);
		return;
	}

	echo $d->sql;
	echo mysql_error();
	$d->transfer("Thêm dữ liệu bị lỗi!", "index.php?p=".$p."&a=add");

}
function view() {
	global $d, $items, $dh, $p;

	$id = (isset($_REQUEST['id'])) ? addslashes($_REQUEST['id']) : "";

	if ($id == '') {
		$d->alert("Không nhận được dữ liệu");
		$d->redirect("index.php?p=".$p."&a=man&page=" . @$_REQUEST['page'] . "");
		return;
	}

	$items = $d->o_fet("SELECT * from #_brand_group WHERE id = '" . $id . "'");
}

function singleDelete() {
	global $d, $p;
	if (empty($_GET['id'])) {
		$d->transfer("Không nhận được dữ liệu", "index.php?p=".$p."&a=man");
		return;
	}

	$id = addslashes($_GET['id']);

	$d->reset();
	$d->setTable('#_brand_group');
	$d->setWhere('id', $id);
	if (!$d->delete()) {
		$d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=".$p."&a=man");	
	}
	
	// Move out all brands of group
	$d->reset();
	$d->setTable('#_brand');
	$d->setWhere('group_id', $id);
	if (!$d->update(['group_id' => null])) {
		$d->transfer("Có lỗi trong quá trình cập nhật dữ liệu!", "index.php?p=".$p."&a=man");
		return;
	}

	$d->redirect("index.php?p=".$p."&a=man&page=" . @$_REQUEST['page']);

}

function multiDelete() {
	global $d, $p;
	if (!isset($_POST['chk_child'])) {
		$d->redirect("index.php?p=".$p."&a=man&page=" . @$_REQUEST['page'] . "");
		return;
	}

	$chuoi = implode(', ', $_POST['chk_child']);
	if (!$d->o_que("DELETE FROM #_brand_group WHERE id IN ($chuoi)")) {
		$d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=".$p."&a=man");
	}

	$d->redirect("index.php?p=".$p."&a=man&page=" . @$_REQUEST['page'] . "");
}
