<?php
include 'dbconfig.php';
session_start();
?>
<?php
if(isset($_POST['btn-login']))
{
  $mail=$_POST['user_mail'];
  $password=$_POST['user_password'];
  $password=md5($password);
  $sql=mysql_query("SELECT * FROM Users WHERE EmailId='".$mail."'");
  $sql_row= mysql_num_rows($sql);
  $get_value= mysql_fetch_assoc($sql);
  $get_user_id=$get_value['id'];
  $get_mail= $get_value['email'];
  $get_pass= $get_value['password'];
  if($sql_row>0)
   {
      if(strcasecmp($get_mail,$mail)==0)
      {
          if(strcasecmp($get_pass,$password)==0)
            {

                  $_SESSION['mail']= $get_mail;
                  header('location:adminhome.php?msg=successful');
            }
          else {
            echo "password invalid";
            }
       }
       else
          echo "email password invalid";
    }

    else
    echo "unsuccessful";

}

 ?>
