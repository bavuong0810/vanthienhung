<?php
		$thanhcong = $d->getTemplates(29);
?>

<div class="container">
<div class="row10">
<?php include "left.php"; ?>
<?php
	$vnp_HashSecret = getenv('VNPAY_SECRET'); //Chuỗi bí mật
	$vnp_SecureHash = $_GET['vnp_SecureHash'];
	$data = $_REQUEST;
	foreach ($data as $key => $value) {
    	if (substr($key, 0, 4) == "vnp_") {
        $inputData[$key] = $value;
    }
	}
	unset($inputData['vnp_SecureHashType']);
	unset($inputData['vnp_SecureHash']);
	ksort($inputData);
	$i = 0;
	$hashData = "";
	foreach ($inputData as $key => $value) {
		if ($i == 1) {
			$hashData = $hashData . '&' . $key . "=" . $value;
		} else {
			$hashData = $hashData . $key . "=" . $value;
			$i = 1;
		}
	}
	// $secureHash = md5($vnp_HashSecret . $hashData);
	$secureHash = hash('sha256', $vnp_HashSecret . $hashData);
	?>				
	<div class="main-content col-md-9 plr10 bg-white">
		<div class="clearfix"></div>
						
		<!-- <div class="box-item module">
		<?=@$thanhcong['content_'.$_SESSION['lang']];?>
		</div> -->
		<?php if ($secureHash == $vnp_SecureHash && $_GET['vnp_ResponseCode'] == '00'): ?>
			<div class="box-item module text-success text-center">
				<p>
					<i class="fa fa-check-circle" style="font-size: 150px;"></i>
				</p>
				<h3>
					Đặt hàng thành công!
				</h3>
				<h4>
					Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất. Xin cảm ơn!
				</h4>
			</div>
		<?php else: ?>
			<div class="box-item module text-warning text-center">
				<p>
					<i class="fa fa-info-circle" style="font-size: 150px;"></i>
				</p>
				<h3>
					Có lỗi xảy ra!
				</h3>
			</div>
		<?php endif; ?>
		<div class="box-item module">
			<div class="form-group">
				<label >Mã đơn hàng:</label>
				<label><?php echo $d->clean($_GET['vnp_TxnRef']) ?></label>
			</div>    
			<div class="form-group">

				<label >Số tiền:</label>
				<label><?php echo intval($d->vnd($_GET['vnp_Amount']))/100 ?></label>
			</div>  
			<div class="form-group">
				<label >Nội dung thanh toán:</label>
				<label><?php echo $d->clean($_GET['vnp_OrderInfo']) ?></label>
			</div> 
			<div class="form-group">
				<label >Mã phản hồi:</label>
				<label><?php echo $d->clean($_GET['vnp_ResponseCode']) ?></label>
			</div> 
			<div class="form-group">
				<label >Mã GD Tại VNPAY:</label>
				<label><?php echo $d->clean($_GET['vnp_TransactionNo']) ?></label>
			</div> 
			<div class="form-group">
				<label >Mã Ngân hàng:</label>
				<label><?php echo $d->clean($_GET['vnp_BankCode']) ?></label>
			</div> 
			<div class="form-group">
				<label >Thời gian thanh toán:</label>
				<label><?php echo date_format(date_create_from_format('YmdHis', $d->clean($_GET['vnp_PayDate'])), 'H:i:s d-m-Y'); ?></label>
			</div> 
			<div class="form-group">
				<label >Kết quả:</label>
				<label>
					<?php
					if ($secureHash == $vnp_SecureHash) {
						if ($_GET['vnp_ResponseCode'] == '00') {
							echo "GD Thanh cong";
						} else {
							echo "GD Khong thanh cong";
						}
					} else {
						echo "Chu ky khong hop le";
					}
					?>

				</label>
			</div>
		</div>
	</div>

</div>
</div>