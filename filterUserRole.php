<!-- This file handles the actions for filtering the options -->

     <?php
     include 'initialization/dbconfig.php';

     //Sets the date specified in fromDate in the variable $fromDate.
    // $fromDate=$_POST['fromDate'];
    // $fromTimestamp = strtotime($fromDate);
    //Sets the date specified in toDate in the variable $toDate.
    // $toDate=$_POST['toDate'];
    // $toTimestamp = strtotime($toDate);

    // $emailId=$_POST['EmailId'];
    // $typeemail= (string)$emailId;

    // $EmailId=$_POST['EmailId'];

    if ($_POST['UserRole'] == "Admin")
    {
         $UserRole=1;
    } else
    {
         $UserRole=2;
    }

     // Query to extract data from a given date range.
     $a = "SELECT  *  FROM Users WHERE  UserRoleId = '{$UserRole}' ";
     $sql = mysql_query($a);

     //     echo $sql;
     //     $row=mysql_fetch_assoc($sql);
          echo "
              <thead>
                   <tr>
                        <th>Email Id</th>
                        <th>User Role</th>
                   </tr>
              </thead>";


          while($row=mysql_fetch_assoc($sql))
                    {?>
                         <td><?php echo $row['EmailId'] ?></td><?php
                              if ($row['UserRoleId'] == 1)
                              {?>
                                   <td><?php echo "Admin" ?></td><?php
                              }
                              else
                              {?>
                                   <td><?php echo "Non-Admin" ?></td><?php
                              }?>
       </tr>

          <?php } ?>
