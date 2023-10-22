<?php
require 'class.phpmailer.php';
function sendmail($tieude, $noidung, $nguoigui, $nguoinhan, $tennguoigui) {
	$mail = new PHPMailer();
	$body = $noidung;
	$mail->IsSMTP();

	$mail->SMTPAuth = true;
	$mail->SMTPSecure = "tls";
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 587;
	$mail->Username = "0902707379vth@gmail.com";
	$mail->Password = "tunkmjkuqnfsugzb";
	// $mail->Password   = "0902833040vth";

	$mail->SetFrom($nguoigui, $tennguoigui);

	$mail->Subject = $tieude;

	$mail->MsgHTML($body);

	$mail->AddAddress($nguoinhan, $nguoinhan);

	if (!$mail->Send()) {
		return false;
	} else {
		return true;
	}

}
?>
