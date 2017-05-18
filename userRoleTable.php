<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Display</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
    <link href="assets/css/styleDisplayHtml.css" rel="stylesheet" type="text/css" media="screen">
    <script type="text/javascript" src="script.js"></script>
</head>
<body>
     <?php
     include 'dbconfig.php';

         // Query to extract data from a given date range.
         $sql = mysql_query("SELECT  *  FROM UserRole");
         $row=mysql_fetch_assoc($sql);
         ?>

<div class="display">

    <div class="container">

         <div class="row">

         <div class="col-md-3">
         <div class="dropdown">
              <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Filter by date
                   <span class="caret"></span></button>
                   <ul class="dropdown-menu">
                        <form action="filterDate.php" class="form-signin" method="post" id="register-form">
                            <h2 class="form-signin-heading">Date</h2><hr />
                            <div id="error">
                            </div>
                            <div class="form-group">
                               <input type="date" class=" dateform form-control" placeholder="From dd/mm/yyyy" name="fromDate" id="fromDate" />
                               <span id="from"></span>
                            </div>
                            <div class="form-group">
                               <input type="date" class="form-control" placeholder="To dd/mm/yyyy" name="toDate" id="toDate" />
                               <span id="to"></span>
                            </div>
                            <div class="form-group">
                               <button type="submit" class="btn btn-default" name="btn-save" id="btn-submit">
                                  Submit
                               </button>
                            </div>
                        </form>
                   </ul>
              </div>
         </div>

         <div class="col-md-3">
              <div class="dropdown">
                  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Filter by EmailId
                       <span class="caret"></span></button>
                       <ul class="dropdown-menu">
                            <form action="filterEmail.php" class="form-signin" method="post" id="register-form">
                               <h2 class="form-signin-heading">Email Id</h2><hr />
                               <div id="error">
                               </div>
                               <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Email Id" name="EmailId" id="EmailId" />
                                    <span id="from"></span>
                               </div>
                               <div class="form-group">
                                    <button type="submit" class="btn btn-default" name="btn-email" id="btn-email-submit">
                                      Submit
                                    </button>
                               </div>
                            </form>
                       </ul>
                  </div>
             </div>

             <div class="col-md-3">
                  <div class="dropdown">
                      <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Filter by Activity
                           <span class="caret"></span></button>
                           <ul class="dropdown-menu">
                                <form action="filterActivity.php" class="form-signin" method="post" id="register-form">
                                   <h2 class="form-signin-heading">Activity</h2><hr />
                                   <div id="error">
                                   </div>
                                   <div class="form-group">
                                       <input type="text" class="form-control" placeholder="Activity" name="Activity" id="Activity" />
                                       <span id="from"></span>
                                   </div>
                                   <div class="form-group">
                                       <button type="submit" class="btn btn-default" name="btn-activity" id="btn-activity-submit">
                                         Submit
                                       </button>
                                   </div>
                                </form>
                           </ul>
                      </div>
                 </div>

                 <div class="col-md-3">
                      <div class="dropdown">
                          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Filter by content
                               <span class="caret"></span></button>
                               <ul class="dropdown-menu">
                                    <form action="filterContent.php" class="form-signin" method="post" id="register-form">
                                       <h2 class="form-signin-heading">content</h2><hr />
                                       <div id="error">
                                       </div>
                                       <div class="form-group">
                                           <input type="text" class="form-control" placeholder="Content" name="Content" id="Content" />
                                           <span id="from"></span>
                                       </div>
                                       <div class="form-group">
                                           <button type="submit" class="btn btn-default" name="btn-content" id="btn-content-submit">
                                             Submit
                                           </button>
                                       </div>
                                   </form>

                               </ul>
                          </div>
</div>
</div>

     <div class="row">
        <div class="panel panel-default mytable">

             <table class="table">
                  <div class="col-sm-6">

                       <section class="panel">
                            <header class="panel-heading">

                                 <strong>Users Table</strong>
                                 </header>
                                 <table class="table">

                                     <thead>
                                        <tr>
                                              <!-- Displaying the data extracted from running the query in a tabular format. -->
                                             <th>User Role Id</th>
                                             <th>User RoleName</th>
                                             <th>User Description</th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                        <tr>
                                             <?php
                                                  // This loop iterates through all the rows and prints till the last value from the selected date range.
                                                 while($row=mysql_fetch_assoc($sql))
                                                       {
                                             ?>
                                                            <td><?php echo $row['UserRoleId'] ?></td>
                                                            <td><?php echo $row['UserRoleName'] ?></td>
                                                            <td><?php echo $row['UserDescription'] ?></td>
                                                       </tr>
                                                       <?php } ?>

                                                  </tbody>
                                             </table>
                                        </section>


                                   </div>

                              </div>
                         </div>


<script src="js/bootstrap.min.js"></script>
</body>
</html>
