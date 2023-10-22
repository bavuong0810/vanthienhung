<?php 
ob_start();
session_start();

@include "../admin/lib/config.php";
@include_once "../admin/lib/function.php";
@include_once "../smtp/index.php";

global $d;
global $lang;
$d = new func_index($config['database']);

$limit = $_REQUEST['limit'];
$limit = str_replace('-', ',', $limit);

if($limit){
    $sql_query = "select id from #_category where hien_thi=1 LIMIT $limit";
} else {
    $sql_query = "select id from #_category where hien_thi=1";
}

$cats = $d->o_fet($sql_query);

if( $cats ){
    $data = array();
    foreach( $cats as $cat ){
        $sql = $d->simple_fetch("select count(id) as cid from #_sanpham where category_id = {$cat['id']} and hien_thi=1");

        $d->reset();
		$d->setTable('#_category');
		$d->setWhere('id', $cat['id']);

        $count = $sql['cid'];
        $data['so_luong'] = $count?$count:0;

        $d->update($data);

    }
}

echo json_encode(array('isSuccess' => true, 'msg' => 'Gửi thành công!'));

exit;