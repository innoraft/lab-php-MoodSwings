<?php
include 'initialization/dbconfig.php';
	session_start();
		if(isset($_POST["oldpassword"]) && isset($_POST["cnewpassword"]))
	{
		$email = $_SESSION["email"];
		$oldpassword = md5($_POST['oldpassword']);
		$cnewpassword = md5($_POST['cnewpassword']);
		$sql = "SELECT * FROM Users WHERE EmailId = '".$email."' AND password = '".$oldpassword."'";
		$s = mysql_query($sql);
		$row = mysql_num_rows($s);
		if($row > 0)
		{
			$sql = "UPDATE Users SET Password = '".$cnewpassword."' WHERE password = '".$oldpassword."' AND email ='".$email."'";
			$s = mysql_query($sql);
			if($s > 0)
			{
				echo "<h3 style='color:green;'>Password Changed!!</h3>";
			}
		}
		else
		{
			echo "<h3 style='color:red;'>Password not matched!!</h3>";
		}
	}
	else
	{
		echo "not set";
	}
?>
