<?php
include 'dbconfig.php';
include 'mail.php';
if(isset($_POST['email']))
{
	$email = $_POST['email'];
	$query=mysql_query("SELECT Password FROM Users WHERE EmailId = '$email'");
	$s = mysql_num_rows($query);
	$row = mysql_fetch_assoc($query);
	$password = $row['Password'];
	if($s == 0)
	{
		echo'<h4 style="color:red">Email not found!!</h4>';
	}
	else
	{

			$admin='<h1>Moodswing</h1><br><h1>Your password reset link given below</h1><br><a href="'.$_SERVER['SERVER_NAME'].'/Project%20level%203/devD2/resetpassword.php?authcode='.$password.'&email='. $_POST['email'].'">Click here to reset Password</a>';
					$mail->Subject = 'Moodswing';
				 	$mail->Body    = $admin;
				 	$mail->addAddress($email);
				 	$mail->isHTML(true);
				 	if(!$mail->send()) {
				 	   // echo 'Message could not be sent.';
				 	    //echo 'Mailer Error: ' . $mail->ErrorInfo;
				 	} else {
				 	    //echo 'Message has been sent'.$email.'<br>';
				 	}

				 $mail->clearAddresses();
				 echo "<h4 style='color:green;'>Password link send to your email</h4>";

	}
}
?>
