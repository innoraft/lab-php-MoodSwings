<!-- This file deals with displaying the users table by running a query -->

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Table</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" media="screen">

    <!-- Stylesheet for this page -->
    <link href="assets/css/styleDisplayHtml.css" rel="stylesheet" type="text/css" media="screen">

    <!-- Stylesheet for logout button -->
    <link rel="stylesheet" href="assets/css/logoutButton.css">

</head>
<body>
     <?php
     include 'initialization/dbconfig.php';

     session_start();
     if ($_SESSION['loggedIn'] == true) {
         // Query to extract all data from a Users table.
         $sql = mysql_query("SELECT  *  FROM Users");
         $row=mysql_fetch_assoc($sql);
         ?>

         <div id="mySidenav" class="sidenav">
             <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
             <a href="googlecharts.php">Charts</a>
             <a href="displayHtml.php">Messages Table</a>
             <a href="usersTable.php">Users Table</a>
             <a href="userRoleTable.php">User Role Table</a>
             <a href="gmail.php">Inbox</a>
         </div>

         <div id="main">
               <nav class="navbar navbar-inverse mynavheader">
                    <div class="navbar-header">
                         <span style="font-size:25px;cursor:pointer;position: absolute;top: 8px;left: 14px;" onclick="openNav()">&#9776;</span>
                    </div>
                    <a href="logout.php"><button class="logout" name="logout">Log Out</button></a>
               </nav>

               <div class="panel panel-default mytable">
                     <table class="table" id="table">
                         <div class="col-sm-6">
                             <section class="panel">
                                 <header class="panel-heading">
                                     <strong>Users</strong>
                                 </header>
                            </div>
                            <div class="col-sm-6">
                                 <!--Filtering starts here-->
                                 <ul class="nav navbar-nav">
                                    <li><a href="displayHtml.php"><img src="assets/images/refresh.png"></a></li>
                                    <li><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#sortModal">Sort</button></li>

                                    <!-- Modal -->
                                    <div class="modal fade" id="sortModal" role="dialog">
                                         <div class="modal-dialog modal-sm">
                                             <div class="modal-content">
                                                  <div class="modal-header">
                                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                       <h4 class="modal-title">Select options to filter</h4>
                                                  </div>
                                                  <div class="modal-body">
                                                       <!-- The filter options goes here -->
                                                       <!-- The form starts here -->
                                                       <form class="form-signin" method="post" id="register-form">
                                                          <div id="error"></div>
                                                          <!-- Filter Email -->
                                                          <!-- <h5>Select Email</h5>
                                                          <div id="error"></div>
                                                          <div class="form-group">
                                                               <input type="text" class="form-control" placeholder="Email Id" name="EmailId" id="EmailId" />
                                                               <span id="from"></span>
                                                          </div> -->
                                                          <!-- Filter UserRole -->
                                                          <h5>Select User Role</h5>
                                                          <div id="error"></div>
                                                          <div class="form-group">
                                                               <select class="form-control" placeholder="User Role" name="UserRole" id="UserRole">
                                                                    <option value="Select">Select</option>
                                                                    <option value="Admin">Admin</option>
                                                                    <option value="Non-Admin">Non-Admin</option>
                                                               </select>
                                                               <span id="from"></span>
                                                          </div>
                                                       </form>
                                                       <!-- The form ends here -->
                                                  </div>
                                                  <div class="modal-footer">
                                                       <button type="button" class="btn btn-default" name="btn-save" id="btn-content-submit" data-dismiss="modal">Submit</button>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                                 </ul>
                                 <!--Filtering ends here-->
                                     <table class="table" id="pagination_data">
                                         <thead>
                                             <tr>
                                                  <!-- Displaying the data extracted from running the query in a tabular format. -->
                                                  <th>Email Id</th>
                                                  <th>User Role</th>
                                             </tr>
                                         </thead>
                                         <tbody>
                                             <tr><?php
                                                 // This loop iterates through all the rows and prints till the last value from the selected date range.
                                                 while($row=mysql_fetch_assoc($sql))
                                                            {?>
                                                                 <td><?php echo $row['EmailId'] ?></td><?php
                                                                      if ($row['UserRoleId'] == 1)
                                                                      {?>
                                                                           <td><?php echo "Admin" ?></td><?php
                                                                      }
                                                                      else
                                                                      {?>
                                                                           <td><?php echo "Non-Admin" ?></td><?php
                                                                      }?>
                                             </tr><?php
                                                  } ?>
                                         </tbody>
                                     </table>
                             </section>
                         </div>
                     </div>
          </div>
<?php }
     else {
          header('location:index.php?msg=user_not_logged_in');
     } ?>
</body>

<!-- Script to open and close side navigation bar -->
<script>
     function openNav() {
         document.getElementById("mySidenav").style.width = "234px";
         document.getElementById("main").style.marginLeft = "234px";
     }
     function closeNav() {
         document.getElementById("mySidenav").style.width = "0";
         document.getElementById("main").style.marginLeft= "0";
     }
</script>

<!-- Script for pagination. -->
<script>
     $(document).ready(function(){
          load_data();
          function load_data(page)
          {
               $.ajax({
                    url:"paginationUsers.php",
                    method:"POST",
                    data:{page:page},
                    success:function(data){
                         $('#pagination_data').html(data);
                    }
               })
          }
      $(document).on('click', '.pagination_link', function(){
           var page = $(this).attr("id");
           load_data(page);
      });
 });
 </script>
</script>

<!-- Script for loading data in same page using AJAX-->
<script>
    $(document).ready(function(){
     $('#btn-content-submit').click(function(e){

          //This prevents the default action of the button
          e.preventDefault();
          // console.log("works");
          var EmailId = $('#EmailId').val();
          var UserRole = $('#UserRole').val();

          // console.log(fromDate);
          // console.log(toDate);
          // console.log(Activity);
          // console.log(Content);


               $.ajax({
                    url:"filterUserRole.php",
                    type:"POST",
                    data :{
                         EmailId : EmailId,
                         UserRole : UserRole,
           		}, // sending the value of counter and blogtag to the server
                    success:function(data){
                    // Clearing the table contents so that the new fetched data from the filtering can be populated here.
                    $("#pagination_data").empty();
                    // console.log(data);
                    $('#pagination_data').html(data);
                    }
               });

     });
});
 </script>
</html>
