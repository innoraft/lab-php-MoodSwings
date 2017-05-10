<?php
include 'dbconfig.php';

// If the submit button is clicked the following code will be executed.
if(isset($_POST['btn-save']))
{
     //Sets the date specified in fromDate in the variable $fromDate.
    $fromDate=$_POST['fromDate'];
    $fromTimestamp = strtotime($fromDate);
    //Sets the date specified in toDate in the variable $toDate.
    $toDate=$_POST['toDate'];
    $toTimestamp = strtotime($toDate);

    // Query to extract data from a given date range.
    $sql = mysql_query("SELECT  *  FROM Messages WHERE   Date >= '$fromTimestamp' AND Date   <= '$toTimestamp'");
    $row=mysql_fetch_assoc($sql);

    // Displaying the data extracted from running the query in a tabular format.
    echo "<table>
     <tr>
       <td >  Date</td>
       <td >  EmailId</td>
       <td >  Activity </td>
       <td >  Content</td>
     </tr>";
     // This loop iterates through all the rows and prints till the last value from the selected date range.
    while($row=mysql_fetch_assoc($sql))
          {


               // print "<pre>";
               //  var_dump($row);
               //  print "</pre>";
                echo "<tr>";
                echo "<td>".$row['Date']."</td>";
                echo "<td>".$row['EmailId']."</td>";
                echo "<td>".$row['Activity']."</td>";
                echo "<td>".$row['Content']."</td>";
                echo "</tr>";

           }
}
else{
    echo "unsuccessful";
    die();
  }


?>
