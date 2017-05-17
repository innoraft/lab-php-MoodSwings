<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Display</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" media="screen">
    <script type="text/javascript" src="script.js"></script>
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
     echo 'Click <a href=" '.$loginUrl. ' ">here</a> to login.';
}


// Check if we have an access token ready for API call
try
{
     if (isset($_SESSION['access_token']) && $client->getAccessToken())
     {

          ?>
          <div class="panel panel-default">

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

                                                       }

                                                       exit();



     }

}catch (Google_Auth_Exception $e)
{
     echo 'Looks like your access token has expired. Click <a href=" '.$loginUrl. ' ">here</a> to login.';
}

 ?>
</body>
