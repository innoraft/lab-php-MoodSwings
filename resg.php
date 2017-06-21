<!-- This file takes the values from registerHtml.php and runs a query to register a new user into the portal -->

<?php
include 'initialization/dbconfig.php';
// Checking if the button is clicked.
if(isset($_POST['btn-save']))
{
     // Storing the user mail and user passwords in the variables $mail and $password respectively.These are the values from the fields of the HTML file.
    $mail=$_POST['email'];
    $password=$_POST['pass'];
    // Encrypting password with md5.
    $password=md5($password);
    // Query to insert the values of EmailId and Password into the table Users.
    $sql = mysql_query("INSERT INTO Users (EmailId,Password,UserRoleId)
               VALUES ('".$mail."','".$password."',2)");
     echo "successful";
     header('location:index.php?msg=successful');
}
else{
    echo "unsuccessful";
    die();
  }
?>
