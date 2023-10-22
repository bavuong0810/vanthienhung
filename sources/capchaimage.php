<?php
//file capcha_image.php
header('Content-type: image/png');
header("Pragma: No-cache");
header("Cache-Control:No-cache, Must-revalidate"); 


$sokytu=3;  $width = 80;  $height = 25; 
$fontsize=16; $x=30; $y=23;  //toạ độ chữ
$do_nghieng=3; $font = dirname(__FILE__).'/texas.ttf';//'arial.ttf'; 
$str= md5(rand(0,9999));  //chữ ngẫu nhiên 
$str = strtoupper(substr($str, 10, $sokytu)); 

session_start();
if (!empty($_SESSION['captcha_code'])) {
    $count = count($_SESSION['captcha_code']);
    if ($count > 5) {
        $count = 0;
    }
    $_SESSION['captcha_code'][$count] = strtolower($str);
} else {
    $_SESSION['captcha_code'] = [];
    $_SESSION['captcha_code'][] = strtolower($str);
}

$img = imagecreatetruecolor($width, $height); //tạo hình
$nen = imagecolorallocate($img,255, 255, 255); //one repeat scroll 0 0 rgba(219, 13, 30, 0.16);

$maubong = imagecolorallocate($img, 255, 255, 255);
$mauchu= imagecolorallocate($img, 8, 8, 8);
$vien = ImageColorAllocate($img, 127, 127, 127);

imagefilledrectangle($img, 0, 0, $width-1, $height-1, $nen);


imagettftext($img, $fontsize,$do_nghieng, $x+2, $y+2, $maubong,$font,$str);
imagettftext($img, $fontsize, $do_nghieng, $x, $y, $mauchu, $font, $str);
imagepng($img);
imagedestroy($img);
?>
