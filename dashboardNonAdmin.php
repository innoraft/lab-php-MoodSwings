<!-- This file deals with showing Non-Administrator a dashboard for all the accessible operations -->

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Non-Admin</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Oleo+Script" rel="stylesheet">
    <link href="assets/css/styleDashboardNonAdmin.css" rel="stylesheet" type="text/css" media="screen">

    <link rel="stylesheet" href="assets/css/logoutButton.css">
</head>

<body>
     <?php
     session_start();
      if ($_SESSION['loggedIn'] == true) {
      ?>
     <div class="col-md-4">
          <div class="row row_charts">
               <div class="card card-1">
                    <img class="img1" src="assets/images/1.png" alt="card-1" style="width:290px;height:190px;margin:5px;">
               </div>
          </div>
          <div class="row row_users_tables">
               <div class="card card-3">
                    <img class="img1" src="3.png" alt="Mountain View" style="width:290px;height:190px;margin:5px;">
               </div>
          </div>
          <div class="row row_inbox">
               <div class="card card-5">
                    <img class="img1" src="5.png" alt="Mountain View" style="width:290px;height:190px;margin:5px;">
               </div>
          </div>
     </div>
     <div class="col-md-4">
          <div class="row">
               <p class="text">Welcome User</p>
          </div>
          <div class="row">
               <a href="googlecharts.php" class="button-charts">
               <span>Charts</span>
               </a>
               <a href="displayHtml.php" class="button-mtable">
               <span>Messages Table</span>
               </a>
               <a href="logout.php"><button class="logout" name="logout">Log Out</button></a>
          </div>
     </div>
     <div class="col-md-4">
          <div class="row row_messages_table">
               <div class="card card-2">
                    <img class="img1" src="assets/images/2.png" alt="card-2" style="width:290px;height:190px;margin:5px;">
               </div>
          </div>
          <div class="row row_userrole_table">
               <div class="card card-4">
                    <img class="img1" src="4.png" alt="Mountain View" style="width:290px;height:190px;margin:5px;">
               </div>
          </div>
     </div>
<?php }
else {
     header('location:index.php?msg=user_not_logged_in');
} ?>
</body>
<script>
$(document).ready(function(){
     // function for charts button
    $(".button-charts").hover(function(){
        $(".card-1").toggleClass("show");
    });

    // function for meesages table button
    $(".button-mtable").hover(function(){
        $(".card-2").toggleClass("show");
    });

    // function for users table button
    $(".button-utable").hover(function(){
        $(".card-3").toggleClass("show");
    });

    // function for user role table button
    $(".button-urtable").hover(function(){
        $(".card-4").toggleClass("show");
    });

    // function for inbox button
    $(".button-inbox").hover(function(){
        $(".card-5").toggleClass("show");
    });

});
</script>
