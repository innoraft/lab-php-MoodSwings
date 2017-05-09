<?php

// This file is for registering a new user.

include 'dbconfig.php';

// Checking if the button is clicked.
if(isset($_POST['btn-save']))
{
     // Storing the user mail and user passwords in the variables $mail and $password respectively.
    $mail=$_POST['user_email'];
    $password=$_POST['password'];
    // Encrypting password with md5.
    $password=md5($password);

    // Query to insert the values of EmailId and Password into the table Users.
    $sql = mysql_query("INSERT INTO Users (EmailId,Password)
               VALUES ('".$mail."','".$password."')");
     echo "successful";
}
else{
    echo "unsuccessful";
    die();
  }
?>
