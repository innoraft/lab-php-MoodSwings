<!-- This is the configuration file for the database -->

<?php
include ("initialization/dbcredentials.php");

// User needs to provide the server name,user name and password of the database here

$db = mysql_connect( $serverName, $userName, $password );
mysql_select_db( $databaseName, $db);
if(!$db){
     die("connection failed: ". mysql_error());
}
?>
