<?php
if (!defined('_source')) die("Error");
$a = (isset($_REQUEST['a'])) ? addslashes($_REQUEST['a']) : "";

switch ($a) {
	case "man":
		showdulieu();
		$template = @$_REQUEST['p'] . "/hienthi";
		break;
	case "add":
		$extra = getExtra();
		showdulieu();
		$template = @$_REQUEST['p'] . "/them";
		break;
	case "edit":
		$extra = getExtra();
		showdulieu();
		$template = @$_REQUEST['p'] . "/them";
		break;
	case "import":
		showImport();
		$template = @$_REQUEST['p'] . "/import";
		break;
	case "export_list":
		export_file();
		break;
	case "save":
		luudulieu();
		break;
	case "delete":
		xoadulieu();
		break;
	case "delete_all":
		xoadulieu_mang();
		break;
	case 'toggle_image':
		toggle_image();
		break;
	default:
		$template = "index";
}

function showImport()
{
	global $d, $loai;

	// default select category "Loại khác" = 1699
	$loai = $d->array_category(0, '-', 1699, 3);
}

function toggle_image()
{
	global $d;

	$id = $_REQUEST['id'];
	$result = $d->query("UPDATE #_sanpham_hinhanh SET `hien_thi`=IF(`hien_thi`=1,0,1) where id = $id");
	echo json_encode(array('result' => $result));
	exit;
}

function getExtra()
{
	global $d;
	$str['thuonghieu'] = $d->o_fet("select * from #_extra where type = 0 and hide=1 order by stt asc,id desc");
	$str['model'] = $d->o_fet("select * from #_extra where type = 1 and hide=1 order by stt asc,id desc");
	$str['mfg_year'] = $d->o_fet("select * from #_extra where type = 2 and hide=1 order by stt asc,id desc");
	return $str;
}

function showdulieu()
{
	global $d, $items, $paging, $loai, $groups, $brands, $fields, $parents, $a, $config;

	$items = [
		[
			'product_type' => ProductConfigs::TYPE_PRODUCT,
		],
	];

	$fieldNamesToSearch = [
		"so_thu_tu",
		"name_vi",
		"name_ch",
		"name_en",
		"code",
		"code_2",
		"code_3",
		"model",
		"view",
		"part_number",
		"price",
		"promotion_price",
		"specification",
		"loai",
		"weight",
		"nang_cao",
		"khung_nang",
		"mfg_year",
		"gio_su_dung",
		"xuat_xu",
		"hien_thi",
		"is_hot",
		"sp_hot",
		"is_completed",
		"cong_suat",
		"ti_so_truyen",
		"nguon_dien",
		"kieu_dang",
		"is_new",
		"br.name"
	];

	if (isset($_GET['remove_filter'])) {
		unset($_SESSION['product_search']);
		header('location: index.php?p=san-pham-con&a=man');
		exit;
	}

	if ($_REQUEST['a'] == 'man') {
		$loai = $d->array_category(0, '', $_GET['category_id'], 3);

		//show du lieu
		$select = 'sp.*, br.name AS brand_name, br.slug AS brand_slug';
		$query = 'SELECT ' . $select . ' FROM #_sanpham sp LEFT JOIN #_brand br ON sp.brand_id = br.id';
		$wheres  = [
			'style = 0',
			'product_type = ' . ProductConfigs::TYPE_PRODUCT,
			'parent_number IS NOT NULL',
			"parent_number <> ''",
		];

		if (
			!empty($_GET['category_id']) &&
			$_GET['category_id'] &&
			$_GET['category_id'] != -1 &&
			$_GET['category_id'] != -2
		) {
			$category_id = $_GET['category_id'] . $d->findIdSub($_GET['category_id']);
			$wheres[] = "FIND_IN_SET(category_id,'$category_id') <> 0";
		} elseif ($_GET['category_id'] == -1) {
			$wheres[] = "(category_id = 0 OR category_id IS NULL)";
		} elseif ($_GET['category_id'] == -2) {
			$wheres[] = "(category_id != 0 AND category_id IS NOT NULL)";
		}

		if (isset($_GET['search'])) {
			if (!empty($_POST['fields']) || !empty($_SESSION['product_search'])) {
				$fields = !empty($_POST['fields']) ? $_POST['fields'] : $_SESSION['product_search'];
				$_SESSION['product_search'] = $fields;
				foreach ($fields as $index => $field) {

					if ($field['name'] == 'image_path') {
						if ($field['value'] == 1) {
							$wheres[] = 'image_path IS NOT NULL';
						} else {
							$wheres[] = 'image_path IS NULL';
						}

						continue;
					}

					if ($field['name'] == 'brand_id') {
						if ($field['value'] == 1) {
							$wheres[] = '(brand_id IS NOT NULL AND brand_id <> \'\')';
						} else {
							$wheres[] = '(brand_id IS NULL OR brand_id = \'\')';
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
					if ($field['compare'] == 'like') {
						$field['value'] = '\'%' . $field['value'] . '%\'';
					} else if ($field['compare'] == 'start') {
						$field['compare'] = 'like';
						$field['value'] = '\'' . $field['value'] . '%\'';
					} else {
						$field['value'] = '\'' . $field['value'] . '\'';
					}

					$wheres[] = $field['name'] . ' ' . $field['compare'] . ' ' . (empty($field['value']) ? '\'\'' : $field['value']);
				}
			}
		}

		if (!empty($wheres)) {
			$query .= ' where ' . implode(' and ', $wheres);
		}

		if (!empty($_GET['orderby'])) {
			$orderby = str_replace('-', ' ', $_GET['orderby']);
			$query .= " order by " . $orderby;
		} else {
			$query .= " order by category_id desc";
		}

		// phan trang

		// foreach ($items as $key => $value) {
		// 	watermark_image($value['image_path'], '../img_data/images/');
		// }
		if (isset($_GET['hienthi']) && $_GET['hienthi'] != 0) {
			$maxR = $d->lay_show_hienthi(addslashes($_GET['hienthi']));
		} else $maxR = 20;
		$page = isset($_GET['page']) && $_GET['page'] > 1 ? addslashes($_GET['page']) : 1;
		$offset = ($page - 1) * $maxR;

		// get total records for paging
		$queryCount = str_replace($select, 'COUNT(sp.id) AS totalRecords', $query);
		// Remove LEFT JOIN for better performance
		$queryCount = str_replace(' sp LEFT JOIN ' . $config['database']['common_table_prefix'] . 'brand br ON sp.brand_id = br.id', '', $queryCount);

		$countResult = $d->o_fet($queryCount);
		$totalRecords = $countResult[0]['totalRecords'];

		// get items
		$query .= " limit $offset, $maxR";

		$items = $d->o_fet($query);

		$url = $d->fullAddress();
		$maxP = $maxR;
		$paging = $d->phantrang($totalRecords, $url, $page, $maxR, $maxP, 'classunlink', 'classlink', 'page');
		// $items=$paging['source'];
		//
	} else {

		//lay noi dung theo id
		if (isset($_REQUEST['id'])) {
			@$id = addslashes($_REQUEST['id']);
			$items = $d->o_fet("select * from #_sanpham where id =  '" . $id . "'");
			$loai = $d->array_category(0, '', $items[0]['category_id'], 3);


			$groups = $d->getAllGroups();
			$brands = $d->getAllBrands();
		}
	}

	if (($a == 'add' || $a == 'edit') && $items && $items[0] && $items[0]['parent_number']) {
		$parents = $d->o_fet("SELECT id, name_vi, parent_number FROM #_sanpham WHERE parent_number = " . $items[0]['parent_number'] . " AND name_vi IS NOT NULL AND product_type = " . ProductConfigs::TYPE_PRODUCT_GROUP . " ORDER BY name_vi ASC, parent_number DESC");
	}
}

function luudulieu()
{
	global $d;


	$id = (isset($_REQUEST['id'])) ? addslashes($_REQUEST['id']) : "";
	$file_name = $d->fns_Rand_digit(0, 9, 12);
	$data = [
		'product_type' => ProductConfigs::TYPE_PRODUCT,
	];

	if (!empty($_POST['referer'])) {
		$referer = trim($_POST['referer']);
	}

	if ($id != '') {

		if (!empty($_POST['file2_clipboard'])) {
			$data['image_path'] = $_POST['file2_clipboard'];
		}
		if (!$data['image_path'] && !empty($_POST['file2_url'])) {
			$data['image_path'] = uploadImageFromUrl($_POST['file2_url']);
		}

		if (!$data['image_path'] && @$file = $d->upload_image("file2", '', '../img_data/images/', $file_name)) {
			$hinhanh = $d->o_fet("select * from #_sanpham where id = '" . $id . "'");
			unlink('../img_data/images/' . $hinhanh[0]['image_path']);
			$data['image_path'] = $file;
			// watermark_image($file, '../img_data/images/');
			// $d->create_thumb($file,200,200,'../img_data/images/',time(),'../img_data/thumb/');
		}

		$data['category_id'] = addslashes($_POST['category_id']);
		$data['group_id'] = addslashes($_POST['group_id']);
		$data['code'] = $d->clear(addslashes($_POST['code']));
		$data['code_2'] = $d->clear(addslashes($_POST['code_2']));

		$data['name_vi'] = $d->clear(addslashes($_POST['name_vi']));
		$data['name_en'] = $d->clear(addslashes($_POST['name_en']));
		$data['name_ch'] = $d->clear(addslashes($_POST['name_ch']));

		$data['description_vi'] = $d->clear(addslashes($_POST['description_vi']));
		$data['description_vi'] = str_replace('<p>&nbsp;</p>', '', $data['description_vi']);
		$data['description_en'] = $d->clear(addslashes($_POST['description_en']));
		$data['description_en'] = str_replace('<p>&nbsp;</p>', '', $data['description_en']);
		$data['description_ch'] = $d->clear(addslashes($_POST['description_ch']));
		$data['description_ch'] = str_replace('<p>&nbsp;</p>', '', $data['description_ch']);

		$data['price'] = intval($d->clear(addslashes($_POST['price'])));
		$data['promotion_price'] = intval($d->clear(addslashes($_POST['promotion_price'])));

		$data['description_2'] = $d->clear(addslashes($_POST['description_2']));
		$data['content_en'] = $d->clear(addslashes($_POST['content_en']));
		$data['content_ch'] = $d->clear(addslashes($_POST['content_ch']));

		$data['alias_vi'] = $d->clear(addslashes($_POST['alias_vi']));
		if ($d->checkLink($data['alias_vi'], "alias_vi", $id) && $data['alias_vi'] != '') {
			$data['alias_vi'] .= "-" . rand(10, 999);
		}

		$data['alias_en'] = $d->clear(addslashes($_POST['alias_en']));
		if ($d->checkLink($data['alias_en'], "alias_en", $id) && $data['alias_en'] != '') {
			$data['alias_en'] .= "-" . rand(10, 999);
		}

		$data['alias_ch'] = $d->clear(addslashes($_POST['alias_ch']));
		if ($d->checkLink($data['alias_ch'], "alias_ch", $id) && $data['alias_ch'] != '') {
			$data['alias_ch'] .= "-" . rand(10, 999);
		}
		$data['alias_ch'] = $d->bodautv($data['alias_ch']);
		$data['alias_vi'] = $d->bodautv($data['alias_vi']);
		$data['alias_en'] = $d->bodautv($data['alias_en']);

		$data['title_vi'] = $d->clear(addslashes($_POST['title_vi']));
		$data['title_en'] = $d->clear(addslashes($_POST['title_en']));
		$data['title_ch'] = $d->clear(addslashes($_POST['title_ch']));

		$data['keyword'] = $d->clear(addslashes($_POST['keyword']));
		$data['des'] = $d->clear(addslashes($_POST['des']));

		$data['hien_thi'] = $data['category_id'] == 0 ? 0 : (isset($_POST['hien_thi']) ? 1 : 0);
		$data['is_hot'] = isset($_POST['is_hot']) ? 1 : 0;
		$data['sp_moi'] = isset($_POST['sp_moi']) ? 1 : 0;
		$data['sp_hot'] = isset($_POST['sp_hot']) ? 1 : 0;
		$data['con_hang'] = isset($_POST['con_hang']) ? 1 : 0;
		$data['is_completed'] = isset($_POST['is_completed']) ? 1 : 0;
		$data['is_new'] = isset($_POST['is_new']) ? 1 : 0;

		$data['specification'] = $d->clear(addslashes($_POST['specification']));
		$data['model'] = $d->clear(addslashes($_POST['model']));
		$data['brand_id'] = $d->clear(addslashes($_POST['brand_id']));
		$data['loai'] = $d->clear(addslashes($_POST['loai']));
		$data['weight'] = $d->clear(addslashes($_POST['weight']));
		$data['khung_nang'] = $d->clear(addslashes($_POST['khung_nang']));
		
		$data['bao_hanh'] = $d->clear(addslashes($_POST['bao_hanh']));

		$data['gio_su_dung'] = $d->clear(addslashes($_POST['gio_su_dung']));
		$data['xuat_xu'] = $d->clear(addslashes($_POST['xuat_xu']));
		$data['tinh_trang_hang'] = $d->clear(addslashes($_POST['tinh_trang_hang']));
		$data['banh_sau'] = $d->clear(addslashes($_POST['banh_sau']));
		$data['part_number'] = $d->clear(addslashes($_POST['part_number']));
		$data['mfg_year'] = $d->clear(addslashes($_POST['mfg_year']));

		$data['cong_suat'] = $d->clear(addslashes($_POST['cong_suat']));
		$data['nguon_dien'] = $d->clear(addslashes($_POST['nguon_dien']));
		$data['unit'] = $d->clear(addslashes($_POST['unit']));
		$data['group_pos'] = $d->clear(addslashes($_POST['group_pos']));
		$data['group_quantity'] = $d->clear(addslashes($_POST['group_quantity']));
		$data['parent_number'] = $d->clear(addslashes($_POST['parent_number']));
		if (empty($data['parent_number'])) {
			$data['parent_number'] = null;
		}

		// $extraNum = 10;
		// for ($i = 0; $i <= $extraNum; $i++) {
		// 	$data['extra' . $i] = $d->clear(addslashes($_POST['extra' . $i]));
		// }

		$data['updated_at'] = date('Y-m-d H-i-s', time());

		$d->reset();
		$d->setTable('#_sanpham');
		$d->setWhere('id', $id);
		if ($d->update($data)) {
			//add thong so
			/////up hinh
			for ($i = 1; $i <= 15; $i++) {
				$upload = false;
				if (isset($_POST['txt_up_' . $i]) && $_POST['txt_up_' . $i] == 1) {
					$file_name = $d->fns_Rand_digit(0, 9, 12);

					// 		if(!empty($_POST['file_clipboard_'.$i])) {
					// 			if ($upload = uploadImageFromSorce($_POST['file_clipboard_'.$i])) {
					// 	$data_hinh['image_path'] = $upload;
					// 	$data_hinh['title'] = $_REQUEST['title'.$i];
					//   		$data_hinh['id_sp'] = $id;
					// 	$d->reset();
					// 	$d->setTable('#_sanpham_hinhanh');
					// 	$d->insert($data_hinh);
					// }
					// 		}
					if (!empty($_POST['file_clipboard_' . $i])) {
						$upload = trim($_POST['file_clipboard_' . $i]);
						$data_hinh['image_path'] = $upload;
						$data_hinh['title'] = $_REQUEST['title' . $i];
						$data_hinh['id_sp'] = $id;
						$d->reset();
						$d->setTable('#_sanpham_hinhanh');
						$d->insert($data_hinh);
					}
					if (!$upload && !empty($_POST['file_url_' . $i])) {
						if ($upload = uploadImageFromUrl($_POST['file_url_' . $i])) {
							$data_hinh['image_path'] = $upload;
							$data_hinh['title'] = $_REQUEST['title' . $i];
							$data_hinh['id_sp'] = $id;
							$d->reset();
							$d->setTable('#_sanpham_hinhanh');
							$d->insert($data_hinh);
						}
					}
					if (!$upload && @$file = $d->upload_image("file_" . $i, '', '../img_data/images/', $file_name)) {
						$data_hinh['image_path'] = $file;
						$data_hinh['title'] = $_REQUEST['title' . $i];
						$data_hinh['id_sp'] = $id;
						$d->reset();
						$d->setTable('#_sanpham_hinhanh');
						$d->insert($data_hinh);
					}
				}
			}
			//   	$mau = $_POST['gear_type'];
			// $text_mau = '';
			// if(is_array($mau) && !empty($mau)){
			// 	$d->o_que("delete from #_sanpham_phienban where id_sanpham = '".$id."' and type=0");
			// 	foreach ($mau as $key => $value) {
			// 		$data_extra['id_extra'] = $value;
			//    		$data_extra['id_sanpham'] = $id;
			// 		$d->reset();
			// 		$d->setTable('#_sanpham_phienban');
			// 		$d->insert($data_extra);
			// 	}
			// }
			// $size = $_POST['group_pos'];
			// $text_size = '';
			// if(is_array($size) && !empty($size)){
			// 	$d->o_que("delete from #_sanpham_phienban where id_sanpham = '".$id."' and type=1");
			// 	foreach ($size as $key => $value) {
			// 		$data_extra['id_extra'] = $value;
			//    		$data_extra['id_sanpham'] = $id;
			//    		$data_extra['type'] = 1;
			// 		$d->reset();
			// 		$d->setTable('#_sanpham_phienban');
			// 		$d->insert($data_extra);
			// 	}
			// }
			///
			$d->redirect($referer ?: "index.php?p=san-pham-con&a=man&page=" . @$_REQUEST['page'] . "");
		} else {
			// echo mysqli_error();
			$d->transfer("Cập nhật dữ liệu bị lỗi", $referer ?: "index.php?p=san-pham-con&a=man");
		}
	} else {
		if (!empty($_POST['file2_clipboard'])) {
			$data['image_path'] = $_POST['file2_clipboard'];
		}
		if (!$data['image_path'] && !empty($_POST['file2_url'])) {
			$data['image_path'] = uploadImageFromUrl($_POST['file2_url']);
		}

		if (!$data['image_path'] && @$file = $d->upload_image("file2", '', '../img_data/images/', $file_name)) {
			$data['image_path'] = $file;
			// watermark_image($file, '../img_data/images/');
		}
		$data['category_id'] = addslashes($_POST['category_id']);
		$data['code'] = $d->clear(addslashes($_POST['code']));
		$data['code_2'] = $d->clear(addslashes($_POST['code_2']));

		$data['name_vi'] = $d->clear(addslashes($_POST['name_vi']));
		$data['name_en'] = $d->clear(addslashes($_POST['name_en']));
		$data['name_ch'] = $d->clear(addslashes($_POST['name_ch']));

		$data['description_vi'] = $d->clear(addslashes($_POST['description_vi']));
		$data['description_vi'] = str_replace('<p>&nbsp;</p>', '', $data['description_vi']);
		$data['description_en'] = $d->clear(addslashes($_POST['description_en']));
		$data['description_en'] = str_replace('<p>&nbsp;</p>', '', $data['description_en']);
		$data['description_ch'] = $d->clear(addslashes($_POST['description_ch']));
		$data['description_ch'] = str_replace('<p>&nbsp;</p>', '', $data['description_ch']);

		$data['price'] = intval($d->clear(addslashes($_POST['price'])));
		$data['promotion_price'] = intval($d->clear(addslashes($_POST['promotion_price'])));

		$data['description_2'] = $d->clear(addslashes($_POST['description_2']));
		$data['content_en'] = $d->clear(addslashes($_POST['content_en']));
		$data['content_ch'] = $d->clear(addslashes($_POST['content_ch']));

		$data['alias_vi'] = $d->clear(addslashes($_POST['alias_vi']));
		if ($d->checkLink($data['alias_vi'], "alias_vi", $id) && $data['alias_vi'] != '') {
			$data['alias_vi'] .= "-" . rand(10, 999);
		}

		$data['alias_en'] = $d->clear(addslashes($_POST['alias_en']));
		if ($d->checkLink($data['alias_en'], "alias_en", $id) && $data['alias_en'] != '') {
			$data['alias_en'] .= "-" . rand(10, 999);
		}

		$data['alias_ch'] = $d->clear(addslashes($_POST['alias_ch']));
		if ($d->checkLink($data['alias_ch'], "alias_ch", $id) && $data['alias_ch'] != '') {
			$data['alias_ch'] .= "-" . rand(10, 999);
		}

		$data['alias_ch'] = $d->bodautv($data['alias_ch']);
		$data['alias_vi'] = $d->bodautv($data['alias_vi']);
		$data['alias_en'] = $d->bodautv($data['alias_en']);

		$data['title_vi'] = $d->clear(addslashes($_POST['title_vi']));
		$data['title_en'] = $d->clear(addslashes($_POST['title_en']));
		$data['title_ch'] = $d->clear(addslashes($_POST['title_ch']));

		$data['keyword'] = $d->clear(addslashes($_POST['keyword']));
		$data['des'] = $d->clear(addslashes($_POST['des']));

		$data['specification'] = $d->clear(addslashes($_POST['specification']));
		$data['model'] = $d->clear(addslashes($_POST['model']));
		$data['brand_id'] = $d->clear(addslashes($_POST['brand_id']));
		$data['loai'] = $d->clear(addslashes($_POST['loai']));
		$data['weight'] = $d->clear(addslashes($_POST['weight']));
		
		$data['bao_hanh'] = $d->clear(addslashes($_POST['bao_hanh']));

		$data['khung_nang'] = $d->clear(addslashes($_POST['khung_nang']));
		$data['gio_su_dung'] = $d->clear(addslashes($_POST['gio_su_dung']));
		$data['xuat_xu'] = $d->clear(addslashes($_POST['xuat_xu']));
		$data['tinh_trang_hang'] = $d->clear(addslashes($_POST['tinh_trang_hang']));
		$data['banh_sau'] = $d->clear(addslashes($_POST['banh_sau']));
		$data['part_number'] = $d->clear(addslashes($_POST['part_number']));
		$data['mfg_year'] = $d->clear(addslashes($_POST['mfg_year']));

		$data['style'] = 0;
		$data['hien_thi'] = $data['category_id'] == 0 ? 0 : (isset($_POST['hien_thi']) ? 1 : 0);
		$data['is_hot'] = isset($_POST['is_hot']) ? 1 : 0;
		$data['sp_moi'] = isset($_POST['sp_moi']) ? 1 : 0;
		$data['sp_hot'] = isset($_POST['sp_hot']) ? 1 : 0;
		$data['con_hang'] = isset($_POST['con_hang']) ? 1 : 0;
		$data['is_completed'] = isset($_POST['is_completed']) ? 1 : 0;
		$data['is_new'] = isset($_POST['is_new']) ? 1 : 0;

		$data['ngay_dang'] = time();

		$data['cong_suat'] = $d->clear(addslashes($_POST['cong_suat']));
		$data['nguon_dien'] = $d->clear(addslashes($_POST['nguon_dien']));
		
		$data['unit'] = $d->clear(addslashes($_POST['unit']));
		$data['group_pos'] = $d->clear(addslashes($_POST['group_pos']));
		$data['group_quantity'] = $d->clear(addslashes($_POST['group_quantity']));
		$data['parent_number'] = $d->clear(addslashes($_POST['parent_number']));
		if (empty($data['parent_number'])) {
			unset($data['parent_number']);
		}

		// $extraNum = 10;
		// for ($i = 0; $i <= $extraNum; $i++) {
		// 	$data['extra' . $i] = $d->clear(addslashes($_POST['extra' . $i]));
		// }

		$data['updated_at'] = date('Y-m-d H-i-s', time());

		$d->setTable('#_sanpham');
		if ($idsp = $d->insert($data)) {
			/////up hinh		
			for ($i = 1; $i <= 15; $i++) {
				$upload = false;
				$file_name = $d->fns_Rand_digit(0, 9, 12);
				if (isset($_POST['txt_up_' . $i]) && $_POST['txt_up_' . $i] == 1) {
					// 		if(!empty($_POST['file_clipboard_'.$i])) {
					// 			if ($upload = uploadImageFromSorce($_POST['file_clipboard_'.$i])) {
					// 	$data_hinh['image_path'] = $upload;
					// 	$data_hinh['title'] = $_REQUEST['title'.$i];
					//   		$data_hinh['id_sp'] = $idsp;
					// 	$d->reset();
					// 	$d->setTable('#_sanpham_hinhanh');
					// 	$d->insert($data_hinh);
					// }
					// 		}
					if (!empty($_POST['file_clipboard_' . $i])) {
						$upload = trim($_POST['file_clipboard_' . $i]);
						$data_hinh['image_path'] = $upload;
						$data_hinh['title'] = $_REQUEST['title' . $i];
						$data_hinh['id_sp'] = $idsp;
						$d->reset();
						$d->setTable('#_sanpham_hinhanh');
						$d->insert($data_hinh);
					}
					if (!$upload && !empty($_POST['file_url_' . $i])) {
						if ($upload = uploadImageFromUrl($_POST['file_url_' . $i])) {
							$data_hinh['image_path'] = $upload;
							$data_hinh['title'] = $_REQUEST['title' . $i];
							$data_hinh['id_sp'] = $idsp;
							$d->reset();
							$d->setTable('#_sanpham_hinhanh');
							$d->insert($data_hinh);
						}
					}
					if (!$upload && @$file = $d->upload_image("file_" . $i, '', '../img_data/images/', $file_name)) {
						$data_hinh['image_path'] = $file;
						$data_hinh['title'] = $_REQUEST['title' . $i];
						$data_hinh['id_sp'] = $idsp;
						$d->reset();
						$d->setTable('#_sanpham_hinhanh');
						$d->insert($data_hinh);
					}
				}
			}
			//   	$mau = $_POST['gear_type'];
			// $text_mau = '';
			// if(is_array($mau) && !empty($mau)){
			// 	foreach ($mau as $key => $value) {
			// 		$data_extra['id_extra'] = $value;
			//    		$data_extra['id_sanpham'] = $idsp;
			// 		$d->reset();
			// 		$d->setTable('#_sanpham_phienban');
			// 		$d->insert($data_extra);
			// 	}
			// }
			// $size = $_POST['group_pos'];
			// $text_size = '';
			// if(is_array($size) && !empty($size)){
			// 	foreach ($size as $key => $value) {
			// 		$data_extra['id_extra'] = $value;
			//    		$data_extra['id_sanpham'] = $idsp;
			//    		$data_extra['type'] = 1;
			// 		$d->reset();
			// 		$d->setTable('#_sanpham_phienban');
			// 		$d->insert($data_extra);
			// 	}
			// }
			///
			$d->redirect($referer ?: "index.php?p=san-pham-con&a=man");
		} else {
			echo mysql_error();
			$d->transfer("Thêm dữ liệu bị lỗi!", $referer ?: "index.php?p=san-pham-con&a=man");
		}
	}
}

function export_file()
{
	global $d;
	if (isset($_REQUEST['ex_id'])) {
		$id = $_REQUEST['ex_id'];
		$items = $d->o_fet("select * from #_user_question where id_event = $id order by id asc");
		$even  = $d->simple_fetch("select * from #_sukien where id = $id order by id asc");
	}
	$date = date("d-m-Y");
	$filename = $d->bodautv($even['name_vi']) . "-" . $date;
	$ex_file .= '
	<table border="1">
	<thead>
		<tr bgcolor="#FFFF99"><th colspan="7">' . $even['name_vi'] . '</th></tr>
		<tr>
			<th>Trả lời đúng</th>
			<th>STT</th>
			<th>Thành viên</th>
			<th>Email</th>
			<th>Điện thoại</th>
			<th>Câu trả lời</th>
			<th>Gửi lúc</th>
		</tr>
	</thead>
	<tbody>
	';
	$count = count($items);
	for ($i = 0; $i < $count; $i++) {

		$user = $d->simple_fetch("select * from #_member where id={$items[$i]['id_user']}");

		if ($items[$i]['best_true'] == 1) {
			$best = "Trả lời đúng";
		} else {
			$best = "chưa đúng";
		};

		$ex_file .= '
		<tr>
			<td>' . $best . '</td>
			<td align="center">' . $i . '</td>

			<td>' . $user['name'] . '</td>
			<td>' . $user['email'] . '</td>
			<td>' . $user['phone'] . '</td>
			
			<td>' . nl2br($items[$i]['noidung']) . '</td>

			<td>' . date('h:i:s d-m-Y', $items[$i]['create_at']) . '></td>

		</tr>
		';
	}
	$ex_file .= '
	</tbody>
	</table>
	';
	header("Content-type: application/xls");
	header("Content-Disposition: attachment; filename=$filename.xls");
	header("Pragma: no-cache");
	header("Expires: 0");

	echo $ex_file;
	$d->redirect("index.php?p=su-kien&view_list&id=" . $id . "&page");
}

function xoadulieu()
{
	global $d;
	if (isset($_GET['id'])) {
		$id =  addslashes($_GET['id']);
		//xoa img
		$hinhanh = $d->o_fet("select * from #_sanpham where id = '" . $id . "'");
		foreach ($hinhanh as $ha) {
			@unlink('../img_data/images/' . $ha['image_path']);
		}

		//xoa size
		// $d->o_que("delete from #_sanpham_detail where id_sp = '".$id."'");
		//

		// xoa anh chi tiet
		$hinhanh_chitiet = $d->o_fet("select * from #_sanpham_hinhanh where id_sp = '" . $id . "'");
		$d->o_que("delete from #_sanpham_hinhanh where id_sp = '" . $id . "'");
		foreach ($hinhanh_chitiet as $hact) {
			@unlink('../img_data/images/' . $hact['image_path']);
		}
		// end
		//xoa hinhanh
		$hinhanh = $d->o_fet("select * from #_sanpham_hinhanh where id_sp = '" . $id . "'");
		foreach ($hinhanh as $ha) {
			@unlink('../img_data/images/' . $ha['image_path']);
		}
		// end
		if ($d->o_que("delete from #_sanpham where id='" . $id . "'")) {
			$d->redirect("index.php?p=san-pham-con&a=man&page=" . @$_REQUEST['page'] . "");
		} else
			$d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=san-pham-con&a=man");
	} else $d->transfer("Không nhận được dữ liệu", "index.php?p=san-pham-con&a=man");
}

function xoadulieu_mang()
{
	global $d;
	if (isset($_POST['chk_child'])) {
		$chuoi = "";
		foreach ($_POST['chk_child'] as $val) {
			$chuoi .= $val . ',';
		}
		$chuoi = trim($chuoi, ',');
		//lay danh sách idsp theo chuoi
		$hinhanh = $d->o_fet("select * from #_sanpham where id in ($chuoi)");
		$hinhanh2 = $d->o_fet("select * from #_sanpham_hinhanh where id_sp in ($chuoi)");
		if ($d->o_que("delete from #_sanpham where id in ($chuoi)")) {
			//xoa hình ảnh
			foreach ($hinhanh as $ha) {
				@unlink('../img_data/images/' . $ha['image_path']);
			}
			//xoa size
			// $d->o_que("delete from #_sanpham_detail where id_sp in ($chuoi)");
			//
			// xoa anh chi tiet
			$hinhanh_chitiet = $d->o_fet("select * from #_sanpham_hinhanh where id_sp in ($chuoi)");
			$d->o_que("delete from #_sanpham_hinhanh where id_sp in ($chuoi)");
			foreach ($hinhanh_chitiet as $hact) {
				@unlink('../img_data/images/' . $hact['image_path']);
			}
			//xoaha2
			foreach ($hinhanh2 as $ha) {
				@unlink('../img_data/images/' . $ha['image_path']);
			}
			$d->redirect("index.php?p=san-pham-con&a=man&page=" . @$_REQUEST['page'] . "");
		} else $d->transfer("Xóa dữ liệu bị lỗi", "index.php?p=san-pham-con&a=man");
	} else $d->redirect("index.php?p=san-pham-con&a=man&page=" . @$_REQUEST['page'] . "");
}
