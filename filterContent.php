<?php
include 'dbconfig.php';
// If the submit button is clicked the following code will be executed.
if(isset($_POST['btn-content']))
{
     //Sets the date specified in fromDate in the variable $fromDate.
    $filtercontent=$_POST['Content'];

    // Query to extract data from a given date range.
    $rs = mysql_query("SELECT  *  FROM Messages WHERE   Content = '".$filtercontent."' ");
    // $row=mysql_fetch_assoc($rs);

    // Displaying the data extracted from running the query in a tabular format.
    echo "<table>
     <tr>
       <td >  Date</td>
       <td >  EmailId</td>
       <td >  Activity </td>
       <td >  Content</td>
     </tr>";
     // This loop iterates through all the rows and prints till the last value from the selected date range.

    while($row=mysql_fetch_assoc($rs))
          {
               $dt = date('m/d/Y', $row['Date']);

               // print "<pre>";
               //  var_dump($row);
               //  print "</pre>";
                echo "<tr>";
                echo "<td>".$dt."</td>";
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
