<?php
/*....PHP MAILER FUNCTION USING GOOGLE SMTP.....*/
require 'PHPMailer-master/PHPMailerAutoload.php';
$mail = new PHPMailer;
//$mail->SMTPDebug = 3;
$mail->isSMTP();
// $mail->SMTPDebug = 1;
 $mail->SMTPAuth = true;
 $mail->SMTPSecure = 'ssl';
$mail->Host = "smtp.gmail.com";
$mail->Port = 465;
$mail->Username = 'moodswing@innoraft.com';
$mail->Password = 'moodswings@1234';

$mail->setFrom('moodswing@innoraft.com', 'Moodswing');
//$mail->addAddress('ellen@example.com');
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');
//$mail->addAttachment('/var/tmp/file.tar.gz');
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');
?>
