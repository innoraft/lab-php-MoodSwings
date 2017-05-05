<?php

/*Starting mysql connection*/
$db = mysql_connect( 'localhost', 'root', 'ascii' );
mysql_select_db( 'moodswing', $db);
if(!$db){
     die("connection failed: ". mysql_error());
}
/*ending*/

?>
