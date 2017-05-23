<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>All messages</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
    <link href="assets/css/styleDisplayHtml.css" rel="stylesheet" type="text/css" media="screen">
</head>
<body>
     <?php
     include 'dbconfig.php';

         // Query to extract data from a given date range.
         $sql = mysql_query("SELECT  *  FROM Messages");
         $row=mysql_fetch_assoc($sql);
         ?>



    <!-- <div class="container"> -->

    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="googlecharts.php">Charts</a>
        <a href="displayHtml.php">Messages Table</a>
        <a href="usersTable.php">Users Table</a>
        <a href="userRoleTable.php">User Role Table</a>
        <a href="gmail.php">Inbox</a>
    </div>

    <div id="main">
        <!-- <div class="row"> -->
            <nav class="navbar navbar-inverse mynavheader">
            <!-- <div class="container-fluid"> -->
                <div class="navbar-header">
                    <span style="font-size:25px;cursor:pointer;position: absolute;top: 8px;left: 14px;" onclick="openNav()">&#9776;</span>
                    <!-- <a class="navbar-brand" href="#">Moodswing</a> -->
                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Filter by </a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Date
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu mydropdownmenu">
                            <form action="filterDate.php" class="form-signin" method="post" id="register-form">
                                <!-- <h2 class="form-signin-heading">Date</h2><hr /> -->
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
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Email Id
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <form action="filterEmail.php" class="form-signin" method="post" id="register-form">
                               <!-- <h2 class="form-signin-heading">Email Id</h2><hr /> -->
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
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Activity
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <form action="filterActivity.php" class="form-signin" method="post" id="register-form">
                                <!-- <h2 class="form-signin-heading">Activity</h2><hr /> -->
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
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Content
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <form action="filterContent.php" class="form-signin" method="post" id="register-form">
                                <!-- <h2 class="form-signin-heading">content</h2><hr /> -->
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
                    </li>
                </ul>
            <!-- </div> -->
        </nav>
        <!-- </div> -->

        <!-- <div class="row"> -->
            <div class="panel panel-default mytable">
                <table class="table">
                    <div class="col-sm-6">
                        <section class="panel">
                            <header class="panel-heading">
                                <strong>Messages</strong>
                            </header>
                                <table class="table">
                                    <thead>
                                        <tr>
                                              <!-- Displaying the data extracted from running the query in a tabular format. -->
                                             <th>Date</th>
                                             <th>Message Id</th>
                                             <th>Activity</th>
                                             <th>Content</th>
                                             <th>Email Id</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php
                                            // This loop iterates through all the rows and prints till the last value from the selected date range.
                                            while($row=mysql_fetch_assoc($sql))
                                                       {
                                                            $dt = date('m/d/Y', $row['Date']);
                                             ?>
                                                    <td><?php echo $dt ?></td>
                                                    <td><?php echo $row['MessageId'] ?></td>
                                                    <td><?php echo $row['Activity'] ?></td>
                                                    <td><?php echo $row['Content'] ?></td>
                                                    <td><?php echo $row['EmailId'] ?></td>
                                        </tr>
                                            <?php } ?>

                                    </tbody>
                                </table>
                        </section>
                    </div>
                </div>
            <!-- </div> -->
        </div>




<!-- <script src="js/bootstrap.min.js"></script> -->

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

</body>
</html>
