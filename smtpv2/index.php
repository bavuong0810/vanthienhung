<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once 'phpmailer/Exception.php';
require_once 'phpmailer/PHPMailer.php';
require_once 'phpmailer/SMTP.php';

function sendEmail($subject, $message, $from, $to, $senderName, $attachments = null){
    // passing true in constructor enables exceptions in PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER; // for detailed debug output

        //Get JSON
        $Username_json = __DIR__ . '/email_admin.json';
        $Password_json = __DIR__ . '/email_password.json';
        $ccPath = __DIR__ . '/email_admin_cc.json';

        $mail->SMTPDebug = '';
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->CharSet = 'utf-8';

        //Default account smtp
        $Username = file_get_contents($Username_json);
        $Password = file_get_contents($Password_json);
        $Username = $Username?$Username:'0902707379vth@gmail.com';
        $Password = $Password?$Password:'wlukqevgwvtfdynp';
        //Set account
        $mail->Username = $Username;
        $mail->Password = $Password; 

        if( !$senderName ){
            $senderName = 'Công ty TNHH Vân Thiên Hùng';
        }

        // Sender and recipient settings
        $mail->setFrom($from, $senderName);
        $mail->addAddress($to, $senderName);
        
        $Cc = file_get_contents($ccPath);
        if( $Cc ){
            $mail->addCC($Cc, $senderName);
        }
        //$mail->addBCC('tkwebdanang@gmail.com', $senderName);
        //$mail->addReplyTo('it.danang.info@gmail.com', $senderName); // to set the reply to

        // Setting the email content
        $mail->IsHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;
        //$mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';

        $mail->send();
        return true;
    } catch (Exception $e) {
        //echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
        return false;
    }
}
?>
