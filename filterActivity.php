<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Filter</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
    <link href="assets/css/styleDisplayHtml.css" rel="stylesheet" type="text/css" media="screen">
    <script type="text/javascript" src="script.js"></script>
</head>
<body>
     <?php
     include 'dbconfig.php';

     // If the submit button is clicked the following code will be executed.
     if(isset($_POST['btn-activity']))
     {
          //Sets the date specified in fromDate in the variable $fromDate.
         $filteractivity=$_POST['Activity'];

         // Query to extract data from a given date range.
         $rs = mysql_query("SELECT  *  FROM Messages WHERE   Activity = '".$filteractivity."' ");
         // $row=mysql_fetch_assoc($rs);

         ?>

<div class="display">

    <div class="container">

     <div class="row">
        <div class="panel panel-default mytable">

             <table class="table">
                  <div class="col-sm-6">

                       <section class="panel">
                            <header class="panel-heading">
                                 <strong>Filtered Content</strong>
                                 </header>
                                 <table class="table">

                                     <thead>
                                        <tr>
                                              <!-- Displaying the data extracted from running the query in a tabular format. -->
                                             <th>Date</th>
                                             <th>EmailId</th>
                                             <th>Activity</th>
                                             <th>Content</th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                        <tr>
                                             <?php
                                                  // This loop iterates through all the rows and prints till the last value from the selected date range.
                                                 while($row=mysql_fetch_assoc($rs))
                                                       {
                                                            $dt = date('m/d/Y', $row['Date']);
                                             ?>
                                                            <td><?php echo $dt ?></td>
                                                            <td><?php echo $row['EmailId'] ?></td>
                                                            <td><?php echo $row['Activity'] ?></td>
                                                            <td><?php echo $row['Content'] ?></td>
                                                       </tr>
                                                       <?php } ?>
                                                       <?php } ?>

                                                  </tbody>
                                             </table>
                                        </section>


                                   </div>
                              </table>
                              </div>
                         </div>
</div>

<script src="js/bootstrap.min.js"></script>
</body>
</html>
