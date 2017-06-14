
     <?php
     include 'dbconfig.php';

     //Sets the date specified in fromDate in the variable $fromDate.
    $fromDate=$_POST['fromDate'];
    $fromTimestamp = strtotime($fromDate);
    //Sets the date specified in toDate in the variable $toDate.
    $toDate=$_POST['toDate'];
    $toTimestamp = strtotime($toDate);

    // $emailId=$_POST['EmailId'];
    // $typeemail= (string)$emailId;

    $filtercontent=$_POST['Content'];

    $filteractivity=$_POST['Activity'];


         // Query to extract data from a given date range.
         $a = "SELECT  *  FROM Messages WHERE   Date >=  '$fromTimestamp' AND Date   <=  '$toTimestamp' AND  Activity = '{$filteractivity}' AND  Content = '{$filtercontent}' ";
     $sql = mysql_query($a);

     //     echo $sql;
     //     $row=mysql_fetch_assoc($sql);
          echo "
              <thead>
                   <tr>
                        <th>Date</th>
                        <th>EmailId</th>
                        <th>Activity</th>
                        <th>Content</th>
                   </tr>
              </thead>";


          while($row=mysql_fetch_assoc($sql))
                    {
                         $dt = date('m/d/Y', $row['Date']);
          ?>
                  <td><?php echo $dt ?></td>
                  <td><?php echo $row['MessageId'] ?></td>
                  <td><?php echo $row['Activity'] ?></td>
                  <td><?php echo $row['Content'] ?></td>
     
          <?php } ?>
