<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Display</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
    <link href="style.css" rel="stylesheet" type="text/css" media="screen">
    <script type="text/javascript" src="script.js"></script>
</head>
<body>

<div class="display">

    <div class="container">


        <form action="displayResult.php" class="form-signin" method="post" id="register-form">

            <h2 class="form-signin-heading">Display data</h2><hr />

            <div id="error">
            </div>

            <div class="form-group">
                <input type="date" class="form-control" placeholder="From dd/mm/yyyy" name="fromDate" id="fromDate" />
                <span id="from"></span>
            </div>

            <div class="form-group">
                <input type="date" class="form-control" placeholder="To dd/mm/yyyy" name="toDate" id="toDate" />
                <span id="to"></span>
            </div>


            <div class="form-group">
                <button type="submit" class="btn btn-default" name="btn-save" id="btn-submit">
                  Submit
                </button>
            </div>

        </form>

    </div>

</div>

<?php
include 'dbconfig.php';


    // Query to extract data from a given date range.
    $sql = mysql_query("SELECT  *  FROM Messages");
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



?>


<script src="js/bootstrap.min.js"></script>
</body>
</html>
