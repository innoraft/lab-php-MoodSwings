<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Inbox</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
    <link href="assets/css/styleGmail.css" rel="stylesheet" type="text/css" media="screen">
    <link href="https://fonts.googleapis.com/css?family=Oleo+Script" rel="stylesheet">
    
</head>
<body>
<?php

// This file is for extracting everything in a mail.
include 'dbconfig.php';

// Start Session
session_start();

// Include Autoloader
require 'vendor/autoload.php';

// Getting API Credentials from config.ini .
$config = parse_ini_file('initialization/config.ini');

// Create Google Client
$client = new Google_Client();
$client->setClientId($config['client_id']);
$client->setClientSecret($config['client_secret']);
$client->setRedirectUri($config['redirect_url']);
$client->addScope('https://mail.google.com/');

// Create Gmail Service
$service = new Google_Service_Gmail($client);

// Check if the user is logged out
if (isset($_REQUEST['logout'])) {
     unset($_SESSION['access_token']);
}

// Check if we have an authorization token.
if (isset($_GET['code'])) {
     $client->authenticate($_GET['code']);
     $_SESSION['access_token'] = $client->getAccessToken();
     $url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
     header('Location: ' . filter_var($url,FILTER_VALIDATE_URL));
}

// Check if we have an access token in the session
if (isset($_SESSION['access_token'])) {
     $client->setAccessToken($_SESSION['access_token']);
} else {
     $loginUrl = $client->createAuthUrl();
     echo '<div class="googleLogin"><a class="googleLogin" href=" '.$loginUrl. ' ">Login through Google</a></div>';
}



// Check if we have an access token ready for API call
try
{
     if (isset($_SESSION['access_token']) && $client->getAccessToken())
     {

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
                                                  <th>Message Number</th>
                                                  <th>Message Id</th>
                                                  <th>Activity</th>
                                                  <th>Content</th>
                                                  <th>Date</th>
                                                  <th>EmailId</th>
                                             </tr>
                                        </thead>
                                        <tbody>
                                             <tr>
                                             <?php

                                             // We make API Calls
                                             $list = $service->users_messages->listUsersMessages('me',['maxResults'=>1000,'labelIds'=> 'INBOX']);
                                             $messageList = $list->getMessages();


                                             foreach($messageList as $id_key=>$id_val)
                                                  {
                                                       // echo "<br><strong>Message number</strong> [$id_key]=> <strong>Message Id</strong> [$id_val->id]<br>"; //displays the index number with the message
                                                       $id=$id_val->id;
                                                       // print_r($messages->getSnippet());
                                                       $messages = $service->users_messages->get('me',$id);

                                                       // displays the message snippet
                                                       $data = $messages->getSnippet();
                                                       // echo "<strong>String:</strong> $data";

                                                       // remove the +1 if you don't want the ? included
                                                       $cut_position = strpos($data, ':');
                                                       $string= substr($data, 0, $cut_position);
                                                       $activity = substr($string, strpos($string, ";") +1);
                                                       // displays the activity
                                                       // echo "<strong>Activity:</strong> $activity<br>";

                                                       $content = substr($data, strpos($data, ":") +1);
                                                       // Triming the spaces
                                                       $emotions = trim($content);
                                                       // displays the content
                                                       // echo "<strong>Content:</strong> $emotions<br>";

                                                            foreach ($messages->payload->headers as $dateEmail=>$value)
                                                                 {
                                                                      if ($dateEmail == 1)
                                                                           {
                                                                                // displays the entire string under value
                                                                                // echo $value->value;
                                                                                $dateString = substr($value->value, strpos($value->value, ";") +1);
                                                                                $gotDate = new DateTime($dateString);
                                                                                $date =$gotDate->format('Y-m-d');
                                                                                $timestamp = strtotime($date);
                                                                                // displays the date and time
                                                                                // echo "<strong>Date:</strong> $date<br>";
                                                                           }
                                                                      if ($dateEmail == 5)
                                                                           {
                                                                                // echo $value->value;
                                                                                $pieces = explode('of',$value->value);
                                                                                $mail=substr($pieces[1],0,-1);
                                                                                // displays the entire string after of
                                                                                // echo $mail;
                                                                                // remove the +1 if you don't want the ? included
                                                                                $cut_position = strpos($mail, 'designates');
                                                                                $stringEmail = substr($mail, 0, $cut_position);
                                                                                // displays the email id
                                                                                // echo "<strong>Email Id:</strong> $stringEmail<br>";?>

                                                                           <!-- Code to print values in tabular format starts here -->
                                                                                <td><?php echo $id_key ?></td>
                                                                                <td><?php echo $id_val->id ?></td>
                                                                                <td><?php echo $activity ?></td>
                                                                                <td><?php echo $emotions ?></td>
                                                                                <td><?php echo $date ?></td>
                                                                                <td><?php echo $stringEmail ?></td>
                                                                           </tr>
                                                                           <!-- Code to print values in tabular format ends here -->

                                                                           <?php
                                                                           $sql=mysql_query("insert into Messages( MessageId, Activity, Content, Date, EmailId) VALUES ( '$id', '$activity', '$emotions', '$timestamp', '$stringEmail')");
                                                                           if ($sql)
                                                                                {
                                                                                     // echo "<strong>New record created successfully</strong><br><br>";
                                                                                } else
                                                                                     {
                                                                                          // echo "Error: " . $sql . "<br>" . mysql_error();
                                                                                     }
                                                                           }
                                                                 }

                                                       }?>
                                                      </tbody>
                                                    </table>
                                                  </section>
                                                </div>
                                              </table>
                                            </div>

                                          </div>
<?php

                                                       //exit();



     }

}catch (Google_Auth_Exception $e)
{
     echo 'Looks like your access token has expired. Click <a href=" '.$loginUrl. ' ">here</a> to login.';
}

 ?>
 

<script>
function openNav() {
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
