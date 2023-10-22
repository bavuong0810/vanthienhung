<?php


error_reporting();
@include "../lib/config.php";
@include "../lib/function.php";
	
global $d;
$d = new func_index($config['database']);

include '../php/PHPExcel/IOFactory.php';



$inputFileName = $_FILES['file']['tmp_name'];
echo 'Loading file ',pathinfo($inputFileName,PATHINFO_BASENAME),' using IOFactory to identify the format<br />';
$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);


//echo '<hr />';
//echo '<br>Data: <table width="100%" cellpadding="3" cellspacing="0"><tr>';

$id = (isset($_REQUEST['id'])) ? addslashes($_REQUEST['id']) : "";


$d->setTable('#_sanpham');

$data =array();
foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
    $worksheetTitle     = $worksheet->getTitle();
    $highestRow         = $worksheet->getHighestRow(); // e.g. 10
    $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
    
   /* for ($row = 1; $row <= $highestRow; ++ $row) {

        echo '<tr>';
        for ($col = 0; $col < $highestColumnIndex; ++ $col) {
            $cell = $worksheet->getCellByColumnAndRow($col, $row);
            $val = $cell->getValue();
            if($row === 1)
            echo '<td style="background:#000; color:#fff;">' . $val . '</td>';
            else
                echo '<td>' . $val . '</td>';
        }
        echo '</tr>';
    }*/
	
	for ($row = 2; $row <= $highestRow; ++ $row) {
		
		$val		= array();
		$file_name	= $d->fns_Rand_digit(0,9,12);
		
		for ($col = 0; $col < $highestColumnIndex; ++ $col) {
		   $cell = $worksheet->getCellByColumnAndRow($col, $row);
		   $val[] = $cell->getValue();
		   
			if(@$file = $d->upload_image($val['3'], '', '../img_data/images/',$file_name)){
				
				$data['image_path'] = $file;
			}
		   
			$data['category_id'] 	= addslashes($_POST['category_id']);
			$data['code']   	= $d->chuoird(4);
			
			$data['name_vi']  		= $val['0'];
			$data['description_vi'] 		= $val['1'];
			$data['description_2']   = $val['2'];
			
			$data['code'] 			= $val['6'];

			$data['price'] 			= $val['7'];
			
			$data['alias_vi'] = $d->bodautv($data['name_vi']);
			if($d->checkLink($data['alias_vi'],"alias_vi",$id ) && $data['alias_vi']!='') {
			$data['alias_vi'].="-".rand(0,99);
			}

			$data['title_vi'] = $val['8'];
			$data['keyword']  = $val['9'];
			$data['des'] 	  = $val['10'];
			
		
			$data['extra0'] = addslashes($_POST['thuonghieu']);
			$data['group_pos'] = addslashes($_POST['model']);
			$data['extra2'] = addslashes($_POST['mfg_year']);
	
			$data['style'] = 0;
			
			$data['hien_thi'] = isset($_POST['hien_thi']) ? 1 : 0;
			$data['is_hot'] = isset($_POST['is_hot']) ? 1 : 0;
			$data['sp_moi'] = isset($_POST['sp_moi']) ? 1 : 0;
			$data['sp_hot'] = isset($_POST['sp_hot']) ? 1 : 0;
	
			$data['ngay_dang'] = time();
		}
		
		 $d->insert($data);

	}
	
    
}
$d->redirect(urladmin."index.php?p=san-pham&a=man");

//echo '</table>';





?>
