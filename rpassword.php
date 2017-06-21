<?
include 'initialization/dbconfig.php';
if(isset($_POST['cnewpassword']) || isset($_POST['authcode'])|| isset($_POST['email']))
  {
      $cnewpassword = md5($_POST['cnewpassword']);
      $authcode = $_POST['authcode'];
      $email = $_POST['email'];
      $query=mysql_query("UPDATE admin SET password = '$cnewpassword' WHERE password = '$authcode' AND email = '$email'");
      $s = mysql_num_rows($query);
      if($s > 0)
      {
        echo '<h4>PASSWORD CHANGED!!</h4>';
      }
  }
?>
