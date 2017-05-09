<?php
include 'dbconfig.php';
if(isset($_POST['btn-save']))
{
    $mail=$_POST['user_email'];
    $password=$_POST['password'];
    $password=md5($password);
$sql = mysql_query("INSERT INTO Users (EmailId,Password)
VALUES ('".$mail."','".$password."')");
echo "successful";
}
else{
    echo "unsuccessful";
    die();
  }
?>
