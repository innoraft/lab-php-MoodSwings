<?php

include 'dbconfig.php';

/*Starting mysql connection*/
// $db = mysql_connect( 'localhost', 'root', 'ascii' );
// mysql_select_db( 'moodswing', $db);
// if(!$db){
//      die("connection failed: ". mysql_error());
// }
/*ending*/

// Start Session
session_start();

// Include Autoloader
require 'vendor/autoload.php';
require 'helpers/utilities.php';

// Create Google Client
$client = new Google_Client();
$client->setClientId('657745825585-vr6qun12f9r7ftalcaph6kj3t6h37ac8.apps.googleusercontent.com');
$client->setClientSecret('0VvbRvDPCyZN-f7n0_BM8Wv6');
$client->setRedirectUri('http://localhost/Project%20level%203/devD2/gmail.php');
$client->addScope('https://mail.google.com/');

// Create Gmail Service
$service = new Google_Service_Gmail($client);

// Check if the user is logged out
if (isset($_REQUEST['logout'])) {
     unset($_SESSION['access_token']);
}

// Check if we have an authorization token
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
     if (isset($_SESSION['access_token']) && $client->getAccessToken()) {
          // We make API Calls
          $list = $service->users_messages->listUsersMessages('me',['maxResults'=>4,'labelIds'=> 'INBOX']);
          $messageList = $list->getMessages();
          // var_dump($messageList);
          // print "<pre>";
          // print_r($messageList);
          // print "</pre>";

          foreach($messageList as $id_key=>$id_val)
          {
               echo "<strong>Message number</strong> [$id_key]=> <strong>Message Id</strong> [$id_val->id]"?><br><?php //displays the index number with the message
               $id=$id_val->id;
               $messages = $service->users_messages->get('me',$id);
               // print_r($messages->getSnippet());

               $data = $messages->getSnippet();
               // echo "<strong>String:</strong> $data";
                // displays the message snippet

               $cut_position = strpos($data, ':'); // remove the +1 if you don't want the ? included
               $string= substr($data, 0, $cut_position);
               $activity = substr($string, strpos($string, ";") +1);
               echo "<strong>Activity:</strong> $activity";?><br><?php // displays the activity


               $emotions = substr($data, strpos($data, ":") +1);
               echo "<strong>Content:</strong> $emotions";?><br><?php // displays the content

               foreach ($messages->payload->headers as $dateEmail=>$value) {
                    if ($dateEmail == 1) {
                    // echo $value->value;
                    // displays the entire string under value
                    $dateString = substr($value->value, strpos($value->value, ";") +1);
                    $gotDate = new DateTime($dateString);
                    $date =$gotDate->format('Y-m-d H:i:s');
                    $x = strtotime($date);
                    echo "<strong>Date:</strong> $x";?><br><?php // displays the date and time
               }
                    if ($dateEmail == 5) {
                         // echo $value->value;
                         $pieces = explode('of',$value->value);
                         $mail=substr($pieces[1],0,-1);
                         // echo $mail;
                         //displays the entire string after of
                         $cut_position = strpos($mail, 'designates'); // remove the +1 if you don't want the ? included
                         $stringEmail = substr($mail, 0, $cut_position);
                         echo "<strong>Email Id:</strong> $stringEmail";?><br><?php ?><br><?php // displays the email id

                         $sql=mysql_query("insert into Messages(ID, MessageId, Activity, Content, Date, EmailId) VALUES (0, '$id', '$activity', '$emotions', '$date', '$stringEmail')");
                         if ($sql) {
                              echo "New record created successfully";
                         } else {
                              echo "Error: " . $sql . "<br>" . mysql_error();
                         }
                    }
               }

               // print "<pre>";
               // print_r($messages); // This prints the entire detail of the message i.e. Message Id,Email Id, Date and time, Message body.
               // print "</pre>";

                    }

                    exit();



     }

}catch (Google_Auth_Exception $e) {
     echo 'Looks like your access token has expired. Click <a href=" '.$loginUrl. ' ">here</a> to login.';
     }
//message number=>message Id
//Content
//Date
//Email Id
 ?>
