<!-- This file takes values from index.php and runs a query to login a user into the portal -->

<?php
include 'initialization/dbconfig.php';
session_start();

if(isset($_POST['btn-resg']))
     {
          header('location:resgHtml.php?msg=successful');
     }

// Checking to see if the login button "isset", i.e. if it has been clicked, then the following code will be executed.
if(isset($_POST['btn-login']))
     {

          // Storing the user mail and user passwords in the variables $mail and $password respectively.
          $mail=$_POST['email'];
          $password=$_POST['password'];
          // Encrypting password with md5.
          $password=md5($password);

          // Fetching all EmailId's from the table Users.
          $sql=mysql_query("SELECT * FROM Users WHERE EmailId='".$mail."'");
          $sql_row= mysql_num_rows($sql);
          $get_value= mysql_fetch_assoc($sql);

          // Fetches the id, email and password respectively.
          $get_user_id=$get_value['UserRoleId'];
          $get_mail= $get_value['EmailId'];
          $get_pass= $get_value['Password'];

          $_SESSION["username"] = $get_mail;
          // Checking if the database is not empty i.e. if there is atleast one row then the following code will be executed.
          if($sql_row > 0)
               {
                    // Comparing the EmailId recieved from $get_mail and $mail.
                    if(strcasecmp($get_mail,$mail)==0)
                         {
                              // Comparing the password recieved from $get_pass and $password.
                              if(strcasecmp($get_pass,$password)==0)
                                   {

                                        if($get_user_id==1)
                                             {
                                                  $_SESSION['loggedIn'] = true;
                                                  // Storing a value in a $_SESSION[''] variable means it can be accessed from other files also.
                                                  $_SESSION['EmailId']= $get_mail;
                                                  header('location:dashboardAdmin.php?msg=successful');
                                             }
                                             else{
                                                  $_SESSION['loggedIn'] = true;
                                                  header('location:dashboardNonAdmin.php?msg=successful');

                                             }
                                   }
                                   else {
                                        echo "Invalid Password";
                                   }
                              }
                         else{
                              echo "email invalid";
                         }

               }
               else{
                    echo "unsuccessful";
                    header('location:resgHtml.php?msg=successful');
               }

     }

 ?>
