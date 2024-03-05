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
	global $d, $items, $paging, $loai, $hang, $p, $fields, $brandGroups, $countForBrands;

	if (isset($_GET['remove_filter'])) {
		unset($_SESSION['brand_search']);
		$d->redirect('index.php?p='.$p.'&a=man');
		exit;
	}

	$brandGroupResults = $d->o_fet("SELECT id, name_vi FROM #_brand_group WHERE name_vi IS NOT NULL ORDER BY name_vi ASC, id DESC");
	$brandGroups = [];
	foreach ($brandGroupResults as $brandGroup) {
		$brandGroups[$brandGroup['id']] = $brandGroup;
	}

	$fieldNamesToSearch = [
		"slug",
		"name",
		"image",
		"is_show",
		"is_featured",
		"desc_vn",
		"desc_us",
		"desc_ch",
	];
	
	// Prepare query
	$query = 'SELECT * FROM #_brand';
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
	$offset_max = $page * $maxR;

	// get total records for paging
	$queryCount = str_replace('*', 'count(id) as totalRecords', $query);
	$countResult = $d->o_fet($queryCount);
	$totalRecords = $countResult[0]['totalRecords'];

	if( $totalRecords <= $maxR || $offset >= $totalRecords  ){
		$offset = 0;
		$offset_max = $maxR;
	}

	// get items
	$query .= " limit $offset, $offset_max";
	
	$items = $d->o_fet($query);
	$itemIds = [];
	foreach ($items as $item) {
		$itemIds[] = $item['id'];
	}
	$queryCountProducts = "SELECT brand_id, COUNT(id) AS count_product FROM #_sanpham WHERE brand_id IN (".implode(", ", $itemIds).") GROUP BY brand_id";
	$countProductsResult = $d->o_fet($queryCountProducts);
	$countForBrands = [];
	foreach ($countProductsResult as $countForBrand) {
		$countForBrands[$countForBrand['brand_id']] = $countForBrand['count_product'];
	}

	$url = $d->fullAddress();
	$maxP = $maxR;
	$paging = $d->phantrang($totalRecords, $url, $page, $maxR, $maxP, 'classunlink', 'classlink', 'page');
}

function luudulieu() {
	global $d, $p;

	$id = (isset($_REQUEST['id'])) ? addslashes($_REQUEST['id']) : "";

	$data = [];
	$fields = ['name', 'desc_vn', 'desc_us', 'desc_ch', 'is_show', 'is_featured', 'group_id'];
	foreach ($fields as $field) {
		$data[$field] = $d->clear(addslashes($_POST[$field]));
	}

	$data['is_show'] = $data['is_show'] ? 1 : 0;
	$data['is_featured'] = $data['is_featured'] ? 1 : 0;
	$data['slug'] = $d->bodautv($data['name']);
	$queryExisted = "SELECT * FROM #_brand WHERE slug = '".$data['slug']."'";
	if (!empty($id)) {
		$queryExisted .= "AND id <> " . intval($id);
	}
	$isExisted = $d->o_fet($queryExisted);
	if (!empty($isExisted[0])) {
		return $d->transfer('Đã tồn tại đường dẫn này!', "index.php?p=".$p."&a=add");
	}

	$fileName = $d->fns_Rand_digit(0,9,12);
	if ($_FILES['image'] && $image = $d->upload_image("image", '', '../img_data/images/', $fileName)) {
		$data['image'] = $image;
	}

	if ($id != '') {
		if ($data['image']) {
			$oldImage = $d->o_fet("SELECT * FROM #_brand WHERE id = ".$id);
			if (!empty($oldImage[0]['image'])) {
				unlink('../img_data/images/'.$oldImage[0]['image']);
			}
		}

		$d->setTable('#_brand');
		$d->setWhere('id', $id);
		if ($d->update($data)) {
			$d->redirect("index.php?p=".$p."&a=edit&id=".$id);
		} else {
			//echo mysql_error();
			$d->transfer("Cập nhật dữ liệu bị lỗi!", "index.php?p=".$p."&a=edit&id=".$id);
		}
	} else {
		$d->setTable('#_brand');
		if ($id = $d->insert($data)) {
			$d->redirect("index.php?p=".$p."&a=edit&id=".$id);
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
		$items = $d->o_fet("SELECT b.*, bg.name_vi AS group_name from #_brand b LEFT JOIN #_brand_group bg ON b.group_id = bg.id WHERE b.id = '" . $id . "'");
		$brands = $d->o_fet("SELECT id, name FROM #_brand WHERE name IS NOT NULL AND id <> {$id} ORDER BY name ASC, id DESC");
		$brandGroups = $d->o_fet("SELECT id, name_vi FROM #_brand_group WHERE name_vi IS NOT NULL ORDER BY name_vi ASC, id DESC");
	}
}

function singleDelete() {
	global $d, $p;
	if (isset($_GET['id'])) {
		$id = addslashes($_GET['id']);

		$d->reset();
		$d->setTable('#_brand');
		$d->setWhere('id', $id);
		if (!$d->delete()) {
			$d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=".$p."&a=man");
			return false;
		}

		$d->reset();
		$d->setTable('#_sanpham');
		$d->setWhere('brand_id', $id);
		if (!$d->update(['brand_id' => NULL])) {
			$d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=".$p."&a=man&page=" . @$_REQUEST['page']);
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
	if (!$d->o_que("DELETE FROM #_brand WHERE id IN ($chuoi)")) {
		$d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=".$p."&a=man");
	}

	$d->reset();
	$d->setTable('#_sanpham');
	foreach ($_POST['chk_child'] as $brandId) {
		$d->setWhereOr('brand_id', intval($brandId));
	}
	if (!$d->update(['brand_id' => NULL])) {
		$d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=".$p."&a=man&page=" . @$_REQUEST['page']);
	}

	$d->redirect("index.php?p=".$p."&a=man&page=" . @$_REQUEST['page']);
}

function replace() {
	global $d, $p;

	$id = (isset($_REQUEST['id'])) ? addslashes($_REQUEST['id']) : "";
	$toId = (isset($_REQUEST['toId'])) ? addslashes($_REQUEST['toId']) : "";
	if (!$id || !$toId) {
		$d->transfer("Không nhận được dữ liệu", "index.php?p=".$p."&a=man&page=" . @$_REQUEST['page'] . "");
	}
	$id = intval($id);
	$toId = intval($toId);

	$d->setTable('#_sanpham');
	$d->setWhere('brand_id', $id);
	if (!$d->update(['brand_id' => $toId])) {
		$d->transfer("Cập nhật dữ liệu bị lỗi", "index.php?p=" . $p . "&a=edit&id=" . $id);
		return false;
	}

	$d->reset();
	$d->setTable('#_brand');
	$d->setWhere('id', $id);
	if (!$d->delete()) {
		$d->transfer("Cập nhật dữ liệu thành công nhưng xóa nhãn hiệu bị lỗi!", "index.php?p=" . $p . "&a=edit&id=" . $id);
		return false;
	}

	$d->transfer("Thay thế thành công!", "index.php?p=".$p."&a=man&page=" . @$_REQUEST['page'] . "");
	return true;
}