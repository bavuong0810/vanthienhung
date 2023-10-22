<?php
if(!isset($_SESSION))
{
    session_start();
}
if(!isset($_SESSION["user_hash"]))
{
    die('Not found');
}

function uploadImageFromSorce($source) {

	// $image = imagecreatefromstring(base64_decode($source));
	// $name = date('Y-m-d_H-i-s-u') . '.png';

	// return imagejpeg($image, '../img_data/images/' . $name, 90) ? $name : false;

	$name = date('Y-m-d_H-i-s-u') . '.png';
	file_put_contents('../img_data/images/' . $name, base64_decode($source));

	return $name;
}

$source = file_get_contents('php://input');
if (isset($_REQUEST['image_source']) && !empty($source)) {
	$name = uploadImageFromSorce($source);

	echo json_encode(array("name" => $name));
	exit;
}

if (!empty($_POST['unlink'])) {
	$isSuccess = @unlink('../img_data/images/'.$ha['image_path']);

	echo json_encode(array("isSuccess" => $isSuccess));	
	exit;
}