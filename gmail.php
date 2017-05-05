<?php

include 'dbconfig.php';

// Start Session
session_start();

// Include Autoloader
require 'vendor/autoload.php';

// Create Google Client
$client = new Google_Client();
$client->setClientId('657745825585-vr6qun12f9r7ftalcaph6kj3t6h37ac8.apps.googleusercontent.com');
$client->setClientSecret('0VvbRvDPCyZN-f7n0_BM8Wv6');
$client->setRedirectUri('http://localhost/Project%20level%203/devD2/messages.php');
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

 ?>
