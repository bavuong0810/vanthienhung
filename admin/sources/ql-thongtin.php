<?php
if(!defined('_source')) die("Error");
$a = (isset($_REQUEST['a'])) ? addslashes($_REQUEST['a']) : "";

$settingsFields = [
	'zalo' => [
		'type' => 'text',
		'label' => 'Zalo',
	],
	'website' => [
		'type' => 'text',
		'label' => 'Website',
	],
	'tell_contact' => [
		'type' => 'text',
		'label' => 'Tell',
	],
	'welcome_message' => [
		'type' => 'text',
		'label' => 'Lời chào',
	],
	'price_quote_note' => [
		'type' => 'rich_text',
		'label' => 'Ghi chú',
	],
	'company_stamp' => [
		'type' => 'image',
		'label' => 'Con dấu công ty',
	],
	'website_logo' => [
		'type' => 'image',
		'label' => 'Logo',
	],
	'rorate_logo' => [
		'type' => 'image',
		'label' => 'Logo nghiêng(768x820px)',
	],
	'ceo_sign' => [
		'type' => 'image',
		'label' => 'Chữ ký',
	],
	'ceo_name' => [
		'type' => 'text',
		'label' => 'Người ký tên',
	],
	'image_watermark' => [
		'type' => 'image',
		'label' => 'Đóng dấu hình ảnh',
		'api' => FILEURL . 'admin/api.php?func=uploadWatermark&site=' . THUMB_SITE_FOLDER,
	], 
	'default_product_image' => [
		'type' => 'image',
		'label' => 'Ảnh mặc định SP',
	],
	'CHAT_TITLE' => [
		'type' => 'text',
		'label' => 'Tiêu đề chat',
	],
	'CHAT_SITE_NAME' => [
		'type' => 'text',
		'label' => 'Tên công ty trong chat',
	],
	'bank_account' => [
		'type' => 'rich_text',
		'label' => 'Tài khoản thanh toán(chuyển khoản)',
	],
];

switch($a){
	case "man":
        global $d;

        // check column google_analytics, if not add column google_analytics
        $link = mysqli_connect($d->servername, $d->username, $d->password, $d->database);
        $result = mysqli_query($link,"SHOW COLUMNS FROM `" . $d->refix . "thongtin` LIKE 'google_analytics'");
        $exists = ($result->current_field == 0) ? false : true;
        if (!$exists) {
            $query = "ALTER TABLE `" . $d->refix . "thongtin` ADD `google_analytics` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL AFTER `lang_ch`";
            mysqli_query($link, $query);
        }

        // check column script_body, if not add column script_body
        $result = mysqli_query($link,"SHOW COLUMNS FROM `" . $d->refix . "thongtin` LIKE 'script_body'");
        $exists = ($result->current_field == 0) ? false : true;
        if (!$exists) {
            $query = "ALTER TABLE `" . $d->refix . "thongtin` ADD `script_body` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL AFTER `google_analytics`";
            mysqli_query($link, $query);
        }

        // check column tax, if not add column tax
        $result = mysqli_query($link,"SHOW COLUMNS FROM `" . $d->refix . "thongtin` LIKE 'tax'");
        $exists = ($result->current_field == 0) ? false : true;
        if (!$exists) {
            $query = "ALTER TABLE `" . $d->refix . "thongtin` ADD `tax` INT NULL DEFAULT '8' AFTER `lang_ch`;";
            mysqli_query($link, $query);
        }

		showdulieu();
		$template = @$_REQUEST['p']."/them";
		break;
	case "save":
		luudulieu();
		break;
	case "saveSettings":
		header('Content-type: application/json');
		$res = saveSettings();
		echo json_encode($res);
		exit();
	default:
		$template = "index";
}

function showdulieu(){
	global $d, $items, $settings;
	if(isset($_REQUEST['p'])){
		$id = addslashes($_REQUEST['p']);
		$d->disableCacheQuery();
		$items = $d->o_fet("select * from #_thongtin where id = '1'");
		$d->disableCacheQuery();
		$settings = $d->getAllSettings();
	}
}

function luudulieu(){
	global $d;
	$file_name=$d->fns_Rand_digit(0,9,5);
	if(@$file = $d->upload_image("file", '', '../img_data/icon/',$file_name)){

		$hinhanh = $d->o_fet("select * from #_thongtin where id = '1'");
		@unlink('../img_data/icon/'.$hinhanh[0]['favicon']);
		$data['favicon'] = $file;

	}
	if(@$file2 = $d->upload_image("file_2", '', '../img_data/icon/','')){
		$hinhanh = $d->o_fet("select * from #_thongtin where id = '1'");
		@unlink('../img_data/icon/'.$hinhanh[0]['icon_share']);
		$data['icon_share'] = $file2;

	}

	$data['hotline'] = addslashes($_POST['hotline']);
	$data['company_vn'] = addslashes($_POST['company_vn']);
	$data['company_us'] = addslashes($_POST['company_us']);
	$data['company_ch'] = addslashes($_POST['company_ch']);
	$data['address'] = addslashes($_POST['address']);
	$data['twitter'] = addslashes($_POST['twitter']);
	$data['facebook'] = addslashes($_POST['facebook']);
	$data['google'] = addslashes($_POST['google']);
	$data['youtube'] = addslashes($_POST['youtube']);
	$data['pinterest'] = addslashes($_POST['pinterest']);
	$data['instagram'] = addslashes($_POST['instagram']);
	$data['dien_thoai'] = addslashes($_POST['dien_thoai']);
	$data['fax'] = addslashes($_POST['fax']);
	$data['email'] = addslashes($_POST['email']);
	$data['coppy_right'] = addslashes($_POST['coppy_right']);
	$data['map'] = addslashes($_POST['map']);
	$data['id_facebook'] = addslashes($_POST['id_facebook']);
	$data['toa_do'] = addslashes($_POST['toa_do']);
	$data['lang_us'] = isset($_POST['lang_us']) ? addslashes($_POST['lang_us']) : 0;
	$data['lang_ch'] = isset($_POST['lang_ch']) ? addslashes($_POST['lang_ch']) : 0;
    $data['google_analytics'] = addslashes($_POST['google_analytics']);
    $data['script_body'] = addslashes($_POST['script_body']);
    $data['tax'] = addslashes($_POST['tax']);

	$d->reset();
	$d->setWhere("id","1");
	$d->setTable('#_thongtin');
	if($d->update($data)){
		$d->alert("Cập nhật dữ liệu thành công.");
		$d->redirect("index.php?p=".$_GET['p']."&a=man");
	}else{
		$d->alert("#ERR.");
		$d->redirect("index.php?p=".$_GET['p']."&a=man");
	}
}

function saveSettings() {
	global $d;
	$data = json_decode(file_get_contents('php://input'), true);
	if (!$data) {
		return [
			'isSuccess' => false,
			'message' => 'Dữ liệu không đúng',
		];
	}

	foreach ($data as $name => $value) {
		$d->reset();
		$d->setTable('#_settings');
		$d->replace(['name' => $name, 'value' => $value]);
	}
	$d->clearMemCached();
	if (!empty($data['image_watermark'])) {
		file_put_contents(__ROOT_PATH . '/image_watermark.data', 'img_data/images/' . $data['image_watermark']);
	}
	if (!empty($data['default_product_image'])) {
		file_put_contents(__ROOT_PATH . '/default_product_image.data', 'img_data/images/' . $data['default_product_image']);
	}

	return [
		'isSuccess' => true,
		'data' => $data,
	];
}
