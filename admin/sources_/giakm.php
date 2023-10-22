<?php
	function vnd($money)
	{
		return @number_format($money,0,'.','.'). ' VNĐ';
	}
	$price = addslashes($_POST['price']);
	$khuyenmai = addslashes($_POST['khuyenmai']);
	$return = $price - $price *  $khuyenmai / 100;
	$giamgia = $price *  $khuyenmai / 100;

	// echo "<p style='margin-top:5px;color:red'>Giá gốc: (".vnd($price).') - Khuyến mãi: ('.$khuyenmai.'%) - Giảm giá: ('.vnd($giamgia).') - Thành tiền: ('.vnd($return).')</p>';
	echo "<p style='margin-top:5px;color:red'>Giá: ".vnd($price).'</p>';

?>