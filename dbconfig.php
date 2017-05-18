<?php
include ("initialization/dbcredentials.php");

// This file is for configuring the database.

$db = mysql_connect( $serverName, $userName, $password );
mysql_select_db( 'moodswing', $db);
if(!$db){
     die("connection failed: ". mysql_error());
}
?>
