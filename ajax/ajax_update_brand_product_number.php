<?php 
ob_start();
session_start();

@include "../admin/lib/config.php";
@include_once "../admin/lib/function.php";
@include_once "../smtp/index.php";

global $d;
global $lang;
$d = new func_index($config['database']);

$brands = $d->o_fet("select * from #_brand where is_show=1");

if( $brands ){
    $data = array();
    foreach( $brands as $brand ){

        $sql = $d->simple_fetch("select count(id) as cid from #_sanpham where brand_id = {$brand['id']} and hien_thi=1");

        $d->reset();
		$d->setTable('#_brand');
		$d->setWhere('id', $brand['id']);

        $count = $sql['cid'];
        $data['so_luong'] = $count?$count:0;

        $d->update($data);
    }
}

$groups = $d->o_fet("SELECT id FROM #_brand_group WHERE name_vi IS NOT NULL");
if( $groups ){
    $data = array();
    foreach( $groups as $group ){
        $count_product = $d->simple_fetch("select sum(so_luong) as quantity from #_brand where group_id='".$group['id']."' and is_show=1");

        $d->reset();
		$d->setTable('#_brand_group');
		$d->setWhere('id', $group['id']);

        $data['so_luong'] = $count_product['quantity']?$count_product['quantity']:0;

        $d->update($data);
        
    }
}

echo json_encode(array('isSuccess' => true, 'msg' => 'Gửi thành công!'));

exit;