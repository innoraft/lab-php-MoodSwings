
<?php
/*..............DATABASE CONNECTION AND DATABASE CREDENTIALS ...*/
include ("initialization/dbcredentials.php");
$db = mysql_connect($serverName, $userName, $password);
if (!$db) {
die("Connection failed: " . mysql_error());
}


//.......CREATE DATABASE moodswing.........

$create_database = mysql_query("CREATE DATABASE ".$database_name." ;");
mysql_select_db($database_name,$db);
if($create_database == TRUE)
{
echo "DATABASE CREATED";
}

//................ MESSAGES TABLE.................
$create_table_messages = mysql_query("CREATE TABLE IF NOT EXISTS `Messages` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `MessageId` varchar(50) NOT NULL,
  `Activity` varchar(50) DEFAULT NULL,
  `Content` varchar(50) DEFAULT NULL,
  `Date` bigint(20) DEFAULT NULL,
  `EmailId` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`MessageId`),
  KEY `Id` (`Id`)
)");
if($create_table_messages == TRUE)
{
echo " User table is created";
}
else
{
echo "ERROR in user table";
}

//.................. USERROLE TABLE,........................
$create_table_userrole = mysql_query("CREATE TABLE IF NOT EXISTS `UserRole` (
  `UserRoleId` int(11) NOT NULL,
  `UserRoleName` varchar(50) DEFAULT NULL,
  `UserDescription` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`UserRoleId`)
)");
if($create_table_userrole == TRUE)
{
echo " News table is created";
}
else
{
echo "ERROR in News table";
}

//.................. USERS TABLE,........................

$create_table_users = mysql_query("CREATE TABLE IF NOT EXISTS `Users` (
  `EmailId` varchar(100) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  `UserRoleId` int(11) DEFAULT NULL,
  UNIQUE KEY `EmailId` (`EmailId`)
)");
if($create_table_users == TRUE)
{
echo " Likes table is created";
}
else
{
echo "ERROR in likes table";
}

?>
