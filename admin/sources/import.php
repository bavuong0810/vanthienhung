<?php
/**
 * Vân Thiên Hùng chuyên lừa đảo, lợi dụng tín nhiệm lừa tiền anh em lập trình.
 * Hứa hẹn thanh toán, tới ngày thì than thở kêu chưa thu được tiền từ năm này qua tháng nọ, hẹn tới hẹn lui không có hồi kết.
 * Tới lúc bị anh em Dev đòi thì xoá Zalo, đổi pass server nhằm chặn anh em Dev vào phá.
 * Đã quỵt tiền 2 người tổng cộng 70 triệu
 * Chúc may mắn cho anh em nào đang làm tiếp với Vân Thiên Hùng ^^!.
 */
@include "../lib/config.php";
if (getenv('APP_DEBUG') == 'false') {
    error_reporting(0);
    ini_set('display_startup_errors', 0);
    ini_set('display_errors', 0);
} else {
    error_reporting(-1);
    ini_set('display_startup_errors', 1);
    ini_set('display_errors', 1);
}
@include "../lib/function.php";
include '../php/PHPExcel/IOFactory.php';

header('Content-type: application/json');

global $d;
$d = new func_index($config['database']);

$brands = $d->o_fet("SELECT id, name from #_brand");
$brandsMap = [];
foreach ($brands as $brand) {
	$key = strtolower($brand['name']);
	$brandsMap[$key] = $brand['id'];
}
// Get last ID to generate new code
$sql = "SELECT `AUTO_INCREMENT`
		FROM  information_schema.TABLES
		WHERE TABLE_SCHEMA = '" . $config['database']['database'] . "'
		AND   TABLE_NAME   = '" . $config['database']['common_table_prefix'] . "sanpham';";
$rs = $d->o_fet($sql);
$newId = $rs[0]['AUTO_INCREMENT'];

$d->setTable('#_sanpham');

if (!$_FILES['file']['tmp_name']) {
	echo json_encode(['message' => 'Vui lòng chọn tệp!']);
	exit;
}
$inputFileName = $_FILES['file']['tmp_name'];
$defaultCatId = $_POST['categoryId'];

// Check file extension
$extension = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
if (!in_array($extension, ['xlsx', 'xls'])) {
	echo json_encode(['message' => 'Vui lòng chọn tệp excel!']);
	exit;
}

$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);

$fields = [
	'name_vi',
	'name_en',
	'name_ch',
	'category_id',
	'group_id',
	'brand_id',
	'model',
	'weight',
	'xuat_xu',
	'unit',
	'part_number',
	'specification',
	'code',
	'code_2',
	'hien_thi',
	'khung_nang',
	'mfg_year',
	'weight',
	'bao_hanh',
	'group_pos',
	'extra2',
	'group_quantity',
	'cost',
];

$allData = [];
$allData['inserted'] = 0;
$allData['failed'] = 0;
$allData['duplicated'] = 0;
foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
	$worksheetTitle     = $worksheet->getTitle();
	$highestRow         = $worksheet->getHighestRow(); // e.g. 10
	$highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
	$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);

	// Get header
	$headerRow = 2;
	$header = [];
	$fieldsMap = [];
	for ($col = 0; $col < $highestColumnIndex; ++$col) {
		$cell = $worksheet->getCellByColumnAndRow($col, $headerRow);
		$cellValue = $cell->getValue();
		if (!$cellValue) {
			$highestColumnIndex = $col;
			break;
		}
		$header[] = $cellValue;
		if (in_array($cellValue, $fields)) {
			$fieldsMap[$cellValue] = $col;
		}
	}

	for ($row = 3; $row <= $highestRow; ++$row) {
		$vals = array();
		$data = array();
		$file_name	= $d->fns_Rand_digit(0, 9, 12);

		for ($col = 0; $col < $highestColumnIndex; ++$col) {
			$cell = $worksheet->getCellByColumnAndRow($col, $row);
			// $vals[] = $cell->getValue();
			$value = $cell->getCalculatedValue();
			if (is_string($value)) {
				$value = trim($value);
			}
			$vals[] = $value;

			// if (@$file = $d->upload_image($val['3'], '', '../img_data/images/', $file_name)) {

			// 	$data['image_path'] = $file;
			// }
		}

		$data = mapColumnToFields($fieldsMap, $vals);
		$data = removeEmptyCols($data);
		if (empty($data['category_id']) || !$data['category_id']) {
			$data['category_id'] = $defaultCatId;
		}

		// empty row
		if (empty($data['name_vi']) || !$data['name_vi'] || strlen(trim($data['name_vi'])) == 0) {
			continue;
		}

		// Check duplicate
		$currentId = $newId;
		if (!empty($data['code'])) {
			$dupCount = $d->num_rows("select id from #_sanpham where code='" . $data['code'] . "'");
			if ($dupCount > 0) {
				$allData['duplicated']++;
				continue;
			}
		} else {
			$data['code'] = 'VTH' . $newId;
		}

		if (!empty($data['brand_id'])) {
			$brand = strtolower($data['brand_id']);
			if (!empty($brandsMap[$brand])) {
				$data['brand_id'] = $brandsMap[$brand];
			}
		}

		if (empty($data['hien_thi'])) {
			$data['hien_thi'] = 0;
		}

		$data['alias_vi'] = strtolower($d->bodautv($data['name_vi']));
		$count = $d->num_rows("select id from #_sanpham where alias_vi='" . $data['alias_vi'] . "'");
		if ($data['alias_vi'] != '' && $d->checkLink($data['alias_vi'], "alias_vi", '')) {
			$data['alias_vi'] .= "-" . rand(0, 99) . '-' . $currentId;
		}
		$data['alias_en'] = $data['alias_vi'];
		$data['alias_ch'] = $data['alias_vi'];

		$data['ngay_dang'] = time();
		try {
			$allData['ids'][] = $d->insert($data);
			$allData['inserted']++;
			$newId++;
		} catch (\Exception $e) {
			$allData['failedMessages'][] = $e->getMessage();
			$allData['failedSQL'][] = $d->sql;
			$allData['failed']++;
		}
	}
}
echo json_encode($allData);

function removeEmptyCols($data)
{
	foreach ($data as $key => $value) {
		if (empty($value)) {
			unset($data[$key]);
		}
	}

	return $data;
}

function mapColumnToFields($fieldsMap, $cellValues)
{
	$data = [];
	foreach ($fieldsMap as $field => $index) {
		if (gettype($cellValues[$index]) == 'object') {
			$data[$field] = $cellValues[$index]->getText();
			continue;
		}
		$data[$field] = $cellValues[$index];
	}

	return $data;
}
