<?php
 //pagination.php
 include 'dbconfig.php';

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
 $query = "SELECT * FROM Messages LIMIT $start_from, $record_per_page";
 $result = mysql_query($query);
 $output .= "
      <table class='table table-bordered'>
           <tr>
                <th>Date</th>
                <th>Message Id</th>
                <th>Activity</th>
                <th>Content</th>
                <th>Email Id</th>
           </tr>
 ";
 while($row = mysql_fetch_array($result))
 {
      $dt = date('m/d/Y', $row['Date']);
      $output .= '
           <tr>
                <td>'.$dt.'</td>
                <td>'.$row["MessageId"].'</td>
                <td>'.$row["Activity"].'</td>
                <td>'.$row["Content"].'</td>
                <td>'.$row["EmailId"].'</td>
           </tr>
      ';
 }
 $output .= '</table><br /><div align="center">';
 $page_query = "SELECT * FROM Messages";
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
