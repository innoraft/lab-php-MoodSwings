<?php
// Connect to MySQL
$link = new mysqli( 'localhost', 'root', 'ascii', 'moodswing' );
if ( $link->connect_errno ) {
  die( "Failed to connect to MySQL: (" . $link->connect_errno . ") " . $link->connect_error );
}

// Fetch the data
$query = "
  SELECT Date,Content
  FROM Messages
  ORDER BY Date ASC";
$result = $link->query( $query );

// All good?
if ( !$result ) {
  // Nope
  $message  = 'Invalid query: ' . $link->error . "n";
  $message .= 'Whole query: ' . $query;
  die( $message );
}

// Set proper HTTP response headers
header( 'Content-Type: application/json' );

$data = array();

// Print out rows
while ( $row = $result->fetch_assoc() ) {
  // echo $row['Date'] . ' | ' . $row['Content'] ;
$data[] = $row;
}

echo json_encode($data);

// Close the connection
mysqli_close($link);
?>
