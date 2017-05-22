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
            <nav class="navbar navbar-inverse">
            <!-- <div class="container-fluid"> -->
                <div class="navbar-header">
                    <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>
                    <!-- <a class="navbar-brand" href="#">Moodswing</a> -->
                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Filter by </a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Date
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
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
        
        </div>

         

<!-- <script src="js/bootstrap.min.js"></script> -->

<script>
function openNav() {
alert('sonam');
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
}
</script>

</body>
</html>
