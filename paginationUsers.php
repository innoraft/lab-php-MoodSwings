<?php
 //pagination.php
 include 'initialization/dbconfig.php';

 $record_per_page = 5;
 $page = '';
 $output = '';

 if(isset($_POST["page"]))
 {
      $page = $_POST["page"];
 }
 else
 {
      $page = 1;
 }

 $start_from = ($page - 1)*$record_per_page;
 $query = "SELECT * FROM Users LIMIT $start_from, $record_per_page";
 $result = mysql_query($query);
 $output .= "
      <table class='table table-bordered'>
           <tr>
                <th>Email Id</th>
                <th>User Role</th>
           </tr>
 ";
 while($row = mysql_fetch_array($result))
 {
     $output .= '<tr><td>'.$row['EmailId'].'</td>';
     if ($row['UserRoleId'] == 1) {
           $output .= '<td>Admin</td></tr>';
      }
      else {
           $output .= '<td>Non-Admin</td></tr>';
      }
 }
 $output .= '</table><br /><div align="center">';
 $page_query = "SELECT * FROM Users";
 $page_result = mysql_query($page_query);
 $total_records = mysql_num_rows($page_result);
 $total_pages = ceil($total_records/$record_per_page);
 for($i=1; $i<=$total_pages; $i++)
 {
      $output .= "<span class='pagination_link' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='".$i."'>".$i."</span>";
 }
 $output .= '</div><br /><br />';
 echo $output;
 ?>
