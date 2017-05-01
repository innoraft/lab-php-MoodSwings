<?php

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

// Chcek if we have an access token ready for API call

try
{
     if (isset($_SESSION['access_token']) && $client->getAccessToken()) {
          // We make API Calls
          $list = $service->users_messages->listUsersMessages('me',['maxResults'=>4,'labelIds'=> 'INBOX']);
          $messageList = $list->getMessages();
          // var_dump($messageList);
          print "<pre>";
          print_r($messageList);
          print "</pre>";

          foreach($messageList as $id_key=>$id_val)
          {
               echo "$id_key=> $id_val->id"?><br  /><?php
               $id=$id_val->id;
               $messages = $service->users_messages->get('me',$id);
               print_r($messages->getSnippet());?><br  /><?php


               $data = $messages->getSnippet();
               $emotions = substr($data, strpos($data, ":") +1);
               echo $emotions;?><br  /><?php
                    }


          // $id = '15badc7f4a507ddd';

          // ------------------------------------------NEW CODE STARTS HERE-------------------------------------------------------

          // ------------------------------------------NEW CODE ENDS HERE-------------------------------------------------------
          exit();

          // ------------------------------------------CODE TO SEND EMAIL STARTS HERE-------------------------------------------------------

          // $id = '15badc7f4a507ddd';
          // $messages = $service->users_messages->get('me',$id);
          // var_dump($messages->getSnippet());
          // exit();

          // $mime = new Mail_mime();
          // $mime->setSubject('Testing Gmail API');
          // $mime->setTXTBody('This is a demo Email');
          // $mime->setHTMLBody('This is an <strong>HTML</strong> email');
          // $mime->addCc('souvik.pal@innoraft.com');
          // $message_body = $mime->getMessage();
          //
          // $encodeMessage = base64url_encode($message_body);
          //
          // $message = new Google_Service_Gmail_Message();
          // $message->setRaw($message_body);
          //
          // $send = $service->users_messages->send('me',$message);
          // var_dump($send);
          // exit();

          // ------------------------------------------CODE TO SEND EMAIL ENDS HERE-------------------------------------------------------


     }

} catch (Google_Auth_Exception $e) {
     echo 'Looks like your access token has expired. Click <a href=" '.$loginUrl. ' ">here</a> to login.';
}

 ?>
