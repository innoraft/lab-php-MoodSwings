<!-- This file deals with making the api call to extract the messages from the inbox and populating it in a database -->

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inbox</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
    <link href="assets/css/styleGmail.css" rel="stylesheet" type="text/css" media="screen">
    <link href="https://fonts.googleapis.com/css?family=Oleo+Script" rel="stylesheet">

    <!-- Stylesheet for logout button -->
    <link rel="stylesheet" href="assets/css/logoutButton.css">

</head>

<body>
<?php

// This file is for extracting everything in a mail.
include 'initialization/dbconfig.php';

// Start Session.
session_start();

if ($_SESSION['loggedIn'] == true) {

// Include Autoloader.
require 'vendor/autoload.php';

// Getting API Credentials from config.ini .
$config = parse_ini_file('initialization/config.ini');

// Create Google Client.
$client = new Google_Client();
$client->setClientId($config['client_id']);
$client->setClientSecret($config['client_secret']);
$client->setRedirectUri($config['redirect_url']);
$client->addScope('https://mail.google.com/');

// Create Gmail Service.
$service = new Google_Service_Gmail($client);

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

// Check if we have an access token in the session.
if (isset($_SESSION['access_token'])) {
     $client->setAccessToken($_SESSION['access_token']);
} else {
     $loginUrl = $client->createAuthUrl();
     echo '<div class="googleLogin"><a class="googleLogin" href=" '.$loginUrl. ' ">Login through Google</a></div>';
}

// Check if we have an access token ready for API call.
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
          <nav class="navbar navbar-inverse mynavheader">
               <div class="navbar-header">
                    <span style="font-size:25px;cursor:pointer;position: absolute;top: 8px;left: 14px;" onclick="openNav()">&#9776;</span>
               </div>
               <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Filter by </a></li>
                    <li class="dropdown">
                         <a class="dropdown-toggle" data-toggle="dropdown" href="#">Date
                         <span class="caret"></span></a>
                         <ul class="dropdown-menu">
                              <form action="filterDate.php" class="form-signin" method="post" id="register-form">
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
                              <span class="caret"></span>
                         </a>
                         <ul class="dropdown-menu">
                              <form action="filterEmail.php" class="form-signin" method="post" id="register-form">
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
                              <span class="caret"></span>
                         </a>
                         <ul class="dropdown-menu">
                              <form action="filterActivity.php" class="form-signin" method="post" id="register-form">
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
                              <span class="caret"></span>
                         </a>
                         <ul class="dropdown-menu">
                              <form action="filterContent.php" class="form-signin" method="post" id="register-form">
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
                    <a href="logout.php"><button class="logout" name="logout">Log Out</button></a>

                </ul>
          </nav>

          <div class="panel panel-default mytable">

               <table class="table">
                    <div class="col-sm-6">

                         <section class="panel">
                              <header class="panel-heading">
                                   <strong>Messages</strong>
                                   </header>
                                   <table class="table" id="pagination_data">
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

                                             // We make API Calls.
                                             $list = $service->users_messages->listUsersMessages('me',['maxResults'=>100000000,'labelIds'=> 'INBOX']);
                                             $messageList = $list->getMessages();


                                             foreach($messageList as $id_key=>$id_val)
                                                  {
                                                       // echo "<br><strong>Message number</strong> [$id_key]=> <strong>Message Id</strong> [$id_val->id]<br>"; //displays the index number with the message.
                                                       $id=$id_val->id;
                                                       // print_r($messages->getSnippet());
                                                       $messages = $service->users_messages->get('me',$id);

                                                       // displays the message snippet.
                                                       $data = $messages->getSnippet();
                                                       // echo "<strong>String:</strong> $data";

                                                       // preg_match_all("/\#(.*?)\:/", $data, $arrayData);
                                                       // $arrayData = implode(" ",$arrayData[1]);
                                                       // echo $arrayData;
                                                       // print "<pre>";
                                                       // print_r($arrayData[1]);
                                                       // print "</pre>";

                                                       preg_match_all("/\#(.*?)\:/", $data, $arrayActivity);
                                                       $stringActivity = implode(" ",$arrayActivity[1]);
                                                       // print "<pre>";
                                                       // print_r($arrayActivity[1]);
                                                       // print "</pre>";

                                                       preg_match_all("/\:(.*?)\#/", $data, $arrayContent);
                                                       $stringContent = implode(" ",$arrayContent[1]);
                                                       // print "<pre>";
                                                       // print_r($arrayContent[1]);
                                                       // print "</pre>";

                                                       // remove the +1 if you don't want the ? included.
                                                       // $cut_position = strpos($data, ':');
                                                       // $string= substr($data, 0, $cut_position);
                                                       // $activity = substr($string, strpos($string, ";") +1);
                                                       // displays the activity.
                                                       // echo "<strong>Activity:</strong> $activity<br>";

                                                       // $content = substr($data, strpos($data, ":") +1);
                                                       // Triming the spaces.
                                                       // $emotions = trim($content);
                                                       // displays the content.
                                                       // echo "<strong>Content:</strong> $emotions<br>";


                                                            foreach ($messages->payload->headers as $dateEmail=>$value)
                                                                 {
                                                                      if ($dateEmail == 1)
                                                                           {
                                                                                // displays the entire string under value.
                                                                                // echo $value->value;
                                                                                $dateString = substr($value->value, strpos($value->value, ";") +1);
                                                                                $gotDate = new DateTime($dateString);
                                                                                $date =$gotDate->format('Y-m-d');
                                                                                $timestamp = strtotime($date);
                                                                                // displays the date and time.
                                                                                // echo "<strong>Date:</strong> $date<br>";
                                                                           }
                                                                      if ($dateEmail == 5)
                                                                           {
                                                                                // echo $value->value;
                                                                                $pieces = explode('of',$value->value);
                                                                                $mail=substr($pieces[1],0,-1);
                                                                                // displays the entire string after of.
                                                                                // echo $mail;
                                                                                // remove the +1 if you don't want the ? included.
                                                                                $cut_position = strpos($mail, 'designates');
                                                                                // This contains the entire email id.
                                                                                $stringEmail = substr($mail, 0, $cut_position);
                                                                                // Separating the first part and the second part of email id.
                                                                                $parts = explode("@", $stringEmail);
                                                                                // Storing the first part of the email id in $username.
                                                                                $username = $parts[0];
                                                                                // echo $username;
                                                                                $parts = explode(".", $username);
                                                                                // Stores the first part of the username before "."
                                                                                $first = $parts[0];
                                                                                // Stores the second part of the username before "."
                                                                                $second = $parts[1];
                                                                                //echo $first;
                                                                                //echo $second;
                                                                                // displays the email id.
                                                                                // echo "<strong>Email Id:</strong> $stringEmail<br>";?>

                                                                           <!-- Code to print values in tabular format starts here -->
                                                                                <td><?php echo $id_key ?></td>
                                                                                <td><?php echo $id_val->id ?></td>
                                                                                <td><?php echo $stringActivity ?></td>
                                                                                <td><?php echo $stringContent ?></td>
                                                                                <td><?php echo $date?></td>
                                                                                <td><?php echo $stringEmail ?></td>
                                                                           </tr>
                                                                           <!-- Code to print values in tabular format ends here -->

                                                                           <?php
                                                                           $sql=mysql_query("insert into Messages( MessageId, Activity, Content, Date, EmailId) VALUES ( '$id', '$stringActivity', '$stringContent', '$timestamp', '$stringEmail')");
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

}
catch (Google_Auth_Exception $e)
{
     echo 'Looks like your access token has expired. Click <a href=" '.$loginUrl. ' ">here</a> to login.';
}
 ?>

<script>
     function openNav()
     {
          document.getElementById("mySidenav").style.width = "234px";
          document.getElementById("main").style.marginLeft = "234px";
     }

     function closeNav()
     {
          document.getElementById("mySidenav").style.width = "0";
          document.getElementById("main").style.marginLeft= "0";
     }
</script>

<script>
     $(document).ready(function(){
          load_data();
          function load_data(page)
          {
               $.ajax({
                    url:"pagination.php",
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
 <?php }
 else {
      header('location:index.php?msg=user_not_logged_in');
 } ?>
</body>
</html>
