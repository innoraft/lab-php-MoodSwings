<?php
session_start();

// Include Autoloader
require_once 'vendor/autoload.php';
require_once 'helpers/helpers.php';
require_once 'Zend/Mail/Protocol/Imap.php';
require_once 'Zend/Mail/Storage/Imap.php';

// Get API Credentials
$config = parse_ini_file('helpers/config.ini');
$notice = '';
$authException = false;
$mime = new Mail_mime();
// Setup Google API Client
$client = new Google_Client();
$client->setClientId($config['client_id']);
$client->setClientSecret($config['client_secret']);
$client->setRedirectUri($config['redirect_url']);
$client->addScope('https://mail.google.com/');

/**************************
    * OAuth2 Authentication Flow
    *
    ***************************/

// Create GMail Service
$service = new Google_Service_Gmail($client);

// Check if user is logged out
if(isset($_REQUEST['logout'])){
     // Clear the access token from the session storage.
    // unset($_SESSION['access_token']);
    session_unset(($_SESSION['access_token']));
    // Deleting browser cache
    header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    // header('Location: https://google.com');

}

// Check if we have an authorization code
// The authentication code is appended to the URL after
// the user is successfully redirected from authentication.
if (isset($_SESSION['access_token'])) {

     // header('Location: https://google.com');
}else {
if(isset($_GET['code'])){
    $code = $_GET['code'];
    // Exchange the authentication code with the Google Client.
    $client->authenticate($code);
    // Retrieve the access token from the Google Client.
   // Here, we are storing the access token in the session storage
    $_SESSION['access_token'] = $client->getAccessToken();
    echo "hello";
    echo $client->getAccessToken();
    echo "string";
    $url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
    // Once the access token is retrieved, we no longer need the
   // authorization code in the URL. Redirect the user to a clean URL.
    header('Location: ' . filter_var($url,FILTER_VALIDATE_URL));
}
}

// Check if we have an access token in the session
// If an access token exists in the session storage, we may use it
// to authenticate the Google Client for authorized usage.
if(isset($_SESSION['access_token'])){
    $client->setAccessToken($_SESSION['access_token']);
} else {
     // If the Google Client does not have an authenticated access token,
    // have the user go through the OAuth2 authentication flow.
    // Get the OAuth2 authentication URL.
    $loginUrl = $client->createAuthUrl();
}

/**************************
    * OAuth2 Authentication Complete
    *
    ***************************/

    // Check if we have an access token ready for API calls
    try
    {
        if(isset($_SESSION['access_token']) && $client->getAccessToken()){
             echo "yo!the message,Salman Khan";

             function showInbox($imap) {
                  echo "yo!the message,Shahrukh Khan";
      /**
       * Print the INBOX message count and the subject of all messages
       * in the INBOX
       */
      $storage = new Zend_Mail_Storage_Imap($imap);
      include 'header.php';
      echo '<h1>Total messages: ' . $storage->countMessages() . "</h1>\n";
      /**
       * Retrieve first 5 messages.  If retrieving more, you'll want
       * to directly use Zend_Mail_Protocol_Imap and do a batch retrieval,
       * plus retrieve only the headers
       */
      echo 'First five messages: <ul>';
      for ($i = 1; $i <= $storage->countMessages() && $i <= 5; $i++ ){
        echo '<li>' . htmlentities($storage->getMessage($i)->subject) . "</li>\n";
      }
      echo '</ul>';
    }


            // Make API Calls
            if(isset($_POST['send'])){
                $to = $_POST['to'];
                $bcc = $_POST['bcc'];
                $cc = $_POST['cc'];
                $body = $_POST['message'];
                $subject = $_POST['subject'];

                $mime->addTo($to);
                $mime->addBcc($bcc);
                $mime->addCc($cc);
                $mime->setTXTBody($body);
                $mime->setHTMLBody($body);
                $mime->setSubject($subject);
                $message_body = $mime->getMessage();

                $encoded_message = base64url_encode($message_body);

                // Gmail Message Body
                $message = new Google_Service_Gmail_Message();
                $message->setRaw($encoded_message);

                // Send the Email
                $email = $service->users_messages->send('me',$message);
                if($email->getId()){
                    $notice = '<div class="alert alert-success">Email Sent successfully!</div>';
                } else {
                    $notice = '<div class="alert alert-danger">Oops...something went wrong, try again later</div>';
                }
            } else if(isset($_POST['draft'])){
                $to = $_POST['to'];
                $bcc = $_POST['bcc'];
                $cc = $_POST['cc'];
                $body = $_POST['message'];
                $subject = $_POST['subject'];

                $mime->addTo($to);
                $mime->addBcc($bcc);
                $mime->addCc($cc);
                $mime->setTXTBody($body);
                $mime->setHTMLBody($body);
                $mime->setSubject($subject);
                $message_body = $mime->getMessage();

                $encoded_message = base64url_encode($message_body);

                // Gmail Message Body
                $message = new Google_Service_Gmail_Message();
                $message->setRaw($encoded_message);

                // Gmail Draft
                $draft_body = new Google_Service_Gmail_Draft();
                $draft_body->setMessage($message);

                // Save as Draft
                $draft = $service->users_drafts->create('me',$draft_body);
                if($draft->getId()){
                    $notice = '<div class="alert alert-success">Draft saved successfully!</div>';
                } else {
                    $notice = '<div class="alert alert-danger">Oops...something went wrong, try again later</div>';
                }
            }

           showInbox($imap);
            /**
             * Get the list of message ids and filter only messages in inbox under the primary category tab
             * Also limit the result to 5 and return only the message ids
             */
            $list = $service->users_messages->listUsersMessages('me',['maxResults' => 5, 'fields' => 'messages/id', 'q' => 'in:inbox category:primary']);
            $messageList = $list->getMessages();

            /**
             * Enable Batch Request to ease up on our HTTP Requests
             */
            $client->setUseBatch(true);
            $batch = new Google_Http_Batch($client);

            /**
             * Prepare batch request for getting user messages
             */
             foreach($messageList as $mlist){
                 $batch->add($service->users_messages->get('me',$mlist->id,['format' => 'raw']),$mlist->id);
             }

            /**
             * Execute the Batch Request
             */
             $batchMessages = $batch->execute();

             $inboxMessage = [];

            /**
             * Create a new Mime Mail Parser Instance ready to decode raw message content
             */
            $mimeDecode = new PhpMimeMailParser\Parser();

             foreach($batchMessages as $dMessage){
                 $messageId = $dMessage->id;
                 $gMessage = $service->users_messages->get('me',$messageId,['format' => 'raw']);
                 $dcMessage = base64url_decode($dMessage->getRaw());

                 $mimeDecode->setText($dcMessage);
                 $mimeSubject = $mimeDecode->getHeader('subject');

                 $inboxMessage[] = [
                     'messageId' => $messageId,
                      'messageSubject' => $mimeSubject
                 ];
             }

        }

    }

    catch (Google_Auth_Exception $e)
    {
    	$authException = true;
    }
