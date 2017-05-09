<?php
include 'dbconfig.php';

if(isset($_POST['btn-save']))
{
    $fromDate=$_POST['fromDate'];
    $toDate=$_POST['toDate'];


    $sql = mysql_query("SELECT  *  FROM Messages WHERE   Date >= '$fromDate' AND Date   <= '$toDate'");
    $row=mysql_fetch_assoc($sql);
    echo "<table>
     <tr>
       <td >  Date</td>
       <td >  EmailId</td>
       <td >  Activity </td>
       <td >  Content</td>
     </tr>";
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
  //SELECT  *  FROM Messages WHERE   Date >= 26-04-2017 AND Date   <= 05-05-2017;


?>
