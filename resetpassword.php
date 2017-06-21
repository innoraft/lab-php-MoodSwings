<?php
include 'dbconfig.php';

$authcode = isset($_GET['authcode']) ? $_GET['authcode'] : ''; // Had faced error in this.
$email = isset($_GET['email']) ? $_GET['email'] : ''; // Had faced error in this.
if(isset($_POST['cnewpassword']) and isset($_POST['auth']) and isset($_POST['Email']))
{

      $cnewpassword = md5($_POST['cnewpassword']);
       $authcode = $_POST['auth'];
      $email = $_POST['Email'];
      $query = mysql_query("UPDATE Users SET Password = '".$cnewpassword."' WHERE Password = '".$authcode."' AND EmailId = '".$email."'");
      if(mysql_affected_rows() > 0)
      {
        echo "<h3 style='color:red'>Password Changed</h3>";
        exit();
      }
      else {
        echo "<h3 style='color:red'>You are Unauthorized </h3>";
        exit();
        # code...
      }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Moodswing</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<style type="text/css">
.navbar{
  border-radius: 0px;
}
 #box
  {
   width:100%;
   max-width:500px;
   border:1px solid #ccc;
   border-radius:5px;
   margin:0 auto;
   padding:0 20px;
   box-sizing:border-box;
   height:270px;
   box-shadow: 0 10px 24px rgba(0,0,0,0.20), 0 11px 10px rgba(0,0,0,0.15);
   background-color:white;
  }
</style>
<body style="background:url(img/2.jpg); background-size:cover;">
<div class="container">
   <h2 align="center">Change Password</h2><br /><br />
   <div id="box">
    <br />
    <form method="post" id="form_id">
     <div class="form-group">
      <label>New Password</label>
      <input type="password" name="password" id="newpassword" class="form-control" />
     </div>
     <div class="form-group">
      <label>Confirm New Password</label>
      <input type="password" name="password" id="cnewpassword" class="form-control" />
     </div>
     <div class="form-group">
      <input type="button" name="login" id="submit" class="btn btn-success" value="Change Password" />
     </div>
     <div id="error"></div>
    </form>
    <br />
   </div>
  </div>

</body>


<script>
     $(document).ready(function(){
      $('#submit').click(function(){
           var newpassword = $('#newpassword').val();
           var cnewpassword = $('#cnewpassword').val();
           var authcode = '<?php echo $authcode; ?>';
           var email = '<?php echo $email; ?>';
           if(newpassword == '' || cnewpassword == '')
           {
                $('#error').html("<h4 style='color:red;'>Required all Fields value</h4>");
           }
           else if(cnewpassword != newpassword)
           {
              $('#error').html('');
              $('#error').html("<h4 style='color:red;'>Password not matched</h4>");
           }
           else
           {
                $('#error').html('');
                $.ajax({
                     url:"resetpassword.php",
                     type:"POST",
                     data:{cnewpassword:cnewpassword,auth:authcode,Email:email},
                     success:function(data){
                           $('#error').html(data);
                           $('#form_id').trigger("reset");
                     }
                });
           }
      });
 });
  </script>
</html>
