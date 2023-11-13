<?php
error_reporting(-1);
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

function convert_number_to_words( $number )
{
	$hyphen = ' ';
	$conjunction = '  ';
	$separator = ' ';
	$negative = 'âm ';
	$decimal = ' phẩy ';
	$dictionary = array(
		0 => 'Không',
		1 => 'Một',
		2 => 'Hai',
		3 => 'Ba',
		4 => 'Bốn',
		5 => 'Năm',
		6 => 'Sáu',
		7 => 'Bảy',
		8 => 'Tám',
		9 => 'Chín',
		10 => 'Mười',
		11 => 'Mười một',
		12 => 'Mười hai',
		13 => 'Mười ba',
		14 => 'Mười bốn',
		15 => 'Mười năm',
		16 => 'Mười sáu',
		17 => 'Mười bảy',
		18 => 'Mười tám',
		19 => 'Mười chín',
		20 => 'Hai mươi',
		30 => 'Ba mươi',
		40 => 'Bốn mươi',
		50 => 'Năm mươi',
		60 => 'Sáu mươi',
		70 => 'Bảy mươi',
		80 => 'Tám mươi',
		90 => 'Chín mươi',
		100 => 'trăm',
		1000 => 'ngàn',
		1000000 => 'triệu',
		1000000000 => 'tỷ',
		1000000000000 => 'nghìn tỷ',
		1000000000000000 => 'ngàn triệu triệu',
		1000000000000000000 => 'tỷ tỷ'
	);

	if( !is_numeric( $number ) )
	{
		return false;
	}

	if( ($number >= 0 && (int)$number < 0) || (int)$number < 0 - PHP_INT_MAX )
	{
		// overflow
		trigger_error( 'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX, E_USER_WARNING );
		return false;
	}

	if( $number < 0 )
	{
		return $negative . convert_number_to_words( abs( $number ) );
	}

	$string = $fraction = null;

	if( strpos( $number, '.' ) !== false )
	{
		list( $number, $fraction ) = explode( '.', $number );
	}

	switch (true)
	{
		case $number < 21:
			$string = $dictionary[$number];
			break;
		case $number < 100:
			$tens = ((int)($number / 10)) * 10;
			$units = $number % 10;
			$string = $dictionary[$tens];
			if( $units )
			{
				$string .= $hyphen . $dictionary[$units];
			}
			break;
		case $number < 1000:
			$hundreds = $number / 100;
			$remainder = $number % 100;
			$string = $dictionary[$hundreds] . ' ' . $dictionary[100];
			if( $remainder )
			{
				$string .= $conjunction . convert_number_to_words( $remainder );
			}
			break;
		default:
			$baseUnit = pow( 1000, floor( log( $number, 1000 ) ) );
			$numBaseUnits = (int)($number / $baseUnit);
			$remainder = $number % $baseUnit;
			$string = convert_number_to_words( $numBaseUnits ) . ' ' . $dictionary[$baseUnit];
			if( $remainder )
			{
				$string .= $remainder < 100 ? $conjunction : $separator;
				$string .= convert_number_to_words( $remainder );
			}
			break;
	}

	if( null !== $fraction && is_numeric( $fraction ) )
	{
		$string .= $decimal;
		$words = array( );
		foreach( str_split((string) $fraction) as $number )
		{
			$words[] = $dictionary[$number];
		}
		$string .= implode( ' ', $words );
	}

	return $string;
}

function copyRange( Worksheet $sheet, $srcRange, $dstCell) {
    // Validate source range. Examples: A2:A3, A2:AB2, A27:B100
    if( !preg_match('/^([A-Z]+)(\d+):([A-Z]+)(\d+)$/', $srcRange, $srcRangeMatch) ) {
        // Wrong source range
        return;
    }
    // Validate destination cell. Examples: A2, AB3, A27
    if( !preg_match('/^([A-Z]+)(\d+)$/', $dstCell, $destCellMatch) ) {
        // Wrong destination cell
        return;
    }

    $srcColumnStart = $srcRangeMatch[1];
    $srcRowStart = $srcRangeMatch[2];
    $srcColumnEnd = $srcRangeMatch[3];
    $srcRowEnd = $srcRangeMatch[4];

    $destColumnStart = $destCellMatch[1];
    $destRowStart = $destCellMatch[2];

    // For looping purposes we need to convert the indexes instead
    // Note: We need to subtract 1 since column are 0-based and not 1-based like this method acts.

    $srcColumnStart = Coordinate::columnIndexFromString($srcColumnStart);
    $srcColumnEnd = Coordinate::columnIndexFromString($srcColumnEnd);
    $destColumnStart = Coordinate::columnIndexFromString($destColumnStart);

    $rowCount = 0;
    for ($row = $srcRowStart; $row <= $srcRowEnd; $row++) {
        $colCount = 0;
        for ($col = $srcColumnStart; $col <= $srcColumnEnd; $col++) {
            $cell = $sheet->getCellByColumnAndRow($col, $row);
            $style = $sheet->getStyleByColumnAndRow($col, $row);
            $dstCell = Coordinate::stringFromColumnIndex($destColumnStart + $colCount) . (string)($destRowStart + $rowCount);
            $sheet->setCellValue($dstCell, $cell->getValue());
            $sheet->duplicateStyle($style, $dstCell);

            // Set width of column, but only once per row
            if ($rowCount === 0) {
                $w = $sheet->getColumnDimensionByColumn($col)->getWidth();
                $sheet->getColumnDimensionByColumn ($destColumnStart + $colCount)->setAutoSize(false);
                $sheet->getColumnDimensionByColumn ($destColumnStart + $colCount)->setWidth($w);
            }

            $colCount++;
        }

        $h = $sheet->getRowDimension($row)->getRowHeight();
        $sheet->getRowDimension($destRowStart + $rowCount)->setRowHeight($h);

        $rowCount++;
    }

    foreach ($sheet->getMergeCells() as $mergeCell) {
        $mc = explode(":", $mergeCell);
        $mergeColSrcStart = Coordinate::columnIndexFromString(preg_replace("/[0-9]*/", "", $mc[0]));
        $mergeColSrcEnd = Coordinate::columnIndexFromString(preg_replace("/[0-9]*/", "", $mc[1]));
        $mergeRowSrcStart = ((int)preg_replace("/[A-Z]*/", "", $mc[0]));
        $mergeRowSrcEnd = ((int)preg_replace("/[A-Z]*/", "", $mc[1]));

        $relativeColStart = $mergeColSrcStart - $srcColumnStart;
        $relativeColEnd = $mergeColSrcEnd - $srcColumnStart;
        $relativeRowStart = $mergeRowSrcStart - $srcRowStart;
        $relativeRowEnd = $mergeRowSrcEnd - $srcRowStart;

        if (0 <= $mergeRowSrcStart && $mergeRowSrcStart >= $srcRowStart && $mergeRowSrcEnd <= $srcRowEnd) {
            $targetColStart = Coordinate::stringFromColumnIndex($destColumnStart + $relativeColStart);
            $targetColEnd = Coordinate::stringFromColumnIndex($destColumnStart + $relativeColEnd);
            $targetRowStart = $destRowStart + $relativeRowStart;
            $targetRowEnd = $destRowStart + $relativeRowEnd;

            $merge = (string)$targetColStart . (string)($targetRowStart) . ":" . (string)$targetColEnd . (string)($targetRowEnd);
            //Merge target cells
            $sheet->mergeCells($merge);
        }
    }
}

include './admin/lib/tcpdf/vendor/autoload.php';
include './admin/lib/phpoffice_phpspreadsheet/index.php';
session_start();

define('__ROOT_PATH', dirname(__FILE__));
define('_lib','./admin/lib/');
@include _lib."config.php";
@include_once _lib."function.php";
global $d;
global $lang;
$d = new func_index($config['database']);
date_default_timezone_set('Asia/Ho_Chi_Minh');

if (!$_SESSION['cart'] || count($_SESSION['cart']) === 0) {
    die('Your cart is empty!');
}

$baseRow = $row = 17;
$helper = new Sample();
$reader = IOFactory::createReader('Xls');
$spreadsheet = $reader->load(__DIR__ . '/mau-bao-gia.xls');

$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('F8', 'Ngày ' . date('d') . ' tháng ' . date('m') . ' năm ' . date('Y'));

$cacheFile = __ROOT_PATH . '/tmp/html/' . md5('information') . '.cache'; // Cache file path
if (file_exists($cacheFile) && (time() - filemtime($cacheFile)) < 3600) {
    $information = unserialize(file_get_contents($cacheFile));
} else {
    $information = $d->simple_fetch("select * from #_thongtin limit 0,1");
    // Cache the result
    file_put_contents($cacheFile, serialize($information));
}

$stt = 0;
$deliveryFee = 0;
$sumQuantity = 0;
$tongtien = 0;
$total = 0;

$tax = $information['tax'] ? $information['tax'] : 8;
$tax = $tax / 100;

foreach ($_SESSION['cart'] as $key => $value) {
    //$product = $d->simple_fetch("select `id`, `category_id`, `alias_vi`, `alias_en`, `alias_ch`, `code`, `code_2`, `code_3`, `name_vi`, `name_en`, `name_ch`, `description_vi`, `description_en`, `description_ch`, `image_path`, `price`, `promotion_price`, `ngay_dang`, `is_hot`, `sp_moi`, `sp_hot`, `title_vi`, `title_en`, `title_ch`, `keyword`, `des`, `view`, `thanh_pho`, `quan`, `hien_thi`, `gear_type`, `group_pos`, `group_quantity`, `group_quantity`, `extra4`, `extra5`, `extra6`, `extra7`, `extra8`, `extra9`, `extra10`, `con_hang`, `so_thu_tu`, `style`, `specification`, `model`, `brand`, `loai`, `weight`, `nang_cao`, `khung_nang`, `mfg_year`, `gio_su_dung`, `xuat_xu`, `part_number`, `tinh_trang_hang`, `banh_sau`, `chieu_dai_cang`, `nang_thap_nhat`, `mat_ban`, `chieu_rong`, `bao_hanh`, `is_completed`, `cong_suat`, `ti_so_truyen`, `nguon_dien`, `kieu_dang` from #_sanpham where id={$key}");
	$product = $d->simple_fetch("select * from #_sanpham where id={$key}");
    $cartProducts[] = $product;
    if (empty($product)) {
        continue;
    }
    $id_product = $product['id'];
    $price = $product['price'];
    if($product['promotion_price'] > 0){
        $price = $product['promotion_price'];
    }
    if (!is_string($deliveryFee) && !empty($product['weight']) && $product['weight'] !== 0 && !empty($_SESSION['delivery_area']['price'])) {
        $fee = $product['weight'] * $value['so_luong'] * $_SESSION['delivery_area']['price'];
        $deliveryFee += $fee;
        $tongtien += $fee;
    } else {
        $deliveryFee = 'Thông báo sau!';
    }
    
    $sumQuantity += $value['so_luong'];
    $tongtien += $price * $value['so_luong'];
    $total += $price * $value['so_luong'];
    $stt++;
    $row = $baseRow + $stt - 1;

    if ($row != $baseRow) {
        $sheet->insertNewRowBefore($row);
        copyRange($sheet, 'A'.$baseRow.':O'.$baseRow, 'A'.$row);
    }
    $sheet->setCellValue('A' . $row, $stt)
        ->setCellValue('B' . $row, $product['code'])
        ->setCellValue('E' . $row, $product['name_'.$_SESSION['lang']] ?: $product['name_vi'])
        ->setCellValue('K' . $row, @$product['unit'] ?: 'Cái')
        ->setCellValue('L' . $row, $value['so_luong'])
        ->setCellValue('M' . $row, @$product['price'])
        // ->setCellValue('O' . $row, $product['price'] * $value['so_luong']);
        ->setCellValue('O' . $row, '=L' . $row . '*M' . $row);
}

$sheet->setCellValue('O' . ++$row, $tongtien);
$sheet->setCellValue('O' . ++$row, $total * $tax);
$sheet->setCellValue('O' . ++$row, $tongtien + ($total * $tax));
$sheet->setCellValue('C' . ++$row, convert_number_to_words($tongtien + ($total * $tax)) . ' nghìn đồng');

/**
 * RETURN FILE TO CLIENT
 */

// Redirect output to a client’s web browser (Xlsx)
header('Content-Type: application/pdf');
header('Content-Disposition: attachment;filename="'.getenv('APP_DOMAIN').'-bao-gia.pdf"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');
// If you're serving to IE over SSL, then the following may be needed
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0
$writer = IOFactory::createWriter($spreadsheet, 'Tcpdf');
$writer->save('php://output');
exit;
// 

// $className = PhpOffice\PhpSpreadsheet\Writer\Pdf\Mpdf::class;
// IOFactory::registerWriter('Pdf', $className);
// // Save
// $helper->write($spreadsheet, __FILE__, ['Pdf']);