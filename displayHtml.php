<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All messages</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
    <link href="assets/css/styleDisplayHtml.css" rel="stylesheet" type="text/css" media="screen">
</head>
<body>
     <?php
     include 'dbconfig.php';

         // Query to extract data from a given date range.
         $sqlnum = mysql_query("SELECT  *  FROM Messages");
         $num = mysql_num_rows($sqlnum);
          ?>

    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="googlecharts.php">Charts</a>
        <a href="displayHtml.php">Messages Table</a>
        <a href="usersTable.php">Users Table</a>
        <a href="userRoleTable.php">User Role Table</a>
        <a href="gmail.php">Inbox</a>
    </div>

    <div id="main">
          <nav class="navbar navbar-inverse mynavheader">
               <div class="navbar-header">
                    <span style="font-size:25px;cursor:pointer;position: absolute;top: 8px;left: 14px;" onclick="openNav()">&#9776;</span>
               </div>
          </nav>

          <div class="panel panel-default mytable">
                <table class="table" id="table">
                    <div class="col-sm-6">
                        <section class="panel">
                            <header class="panel-heading">
                                <strong>Activities</strong>
                            </header>
                       </div>
                       <div class="col-sm-6">
                            <!--Filtering starts here-->
                            <ul class="nav navbar-nav">
                               <li><a href="displayHtml.php"><img src="assets/images/refresh.png"></a></li>
                               <li><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#sortModal">Sort</button></li>
                               <!-- Modal -->
                               <div class="modal fade" id="sortModal" role="dialog">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                             <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                  <h4 class="modal-title">Select options to filter</h4>
                                             </div>
                                             <div class="modal-body">
                                                  <!-- The filter options goes here -->
                                                  <!-- The form starts here -->
                                                  <form class="form-signin" method="post" id="register-form">
                                                     <div id="error">
                                                     </div>
                                                     <h5>Select Date</h5>
                                                     <!-- Filter date -->
                                                     <div class="form-group">
                                                          <input type="date" class=" dateform form-control" placeholder="From dd/mm/yyyy" name="fromDate" id="fromDate" />
                                                          <span id="from"></span>
                                                     </div>
                                                     <div class="form-group">
                                                          <input type="date" class="form-control" placeholder="To dd/mm/yyyy" name="toDate" id="toDate" />
                                                          <span id="to"></span>
                                                     </div>
                                                  <h5>Select Email</h5>
                                                  <!-- Filter Email -->
                                                     <div id="error">
                                                     </div>
                                                     <div class="form-group">
                                                          <input type="text" class="form-control" placeholder="Email Id" name="EmailId" id="EmailId" />
                                                          <span id="from"></span>
                                                     </div>
                                                  <h5>Select Activity</h5>
                                                  <!-- Filter Activity -->
                                                     <div id="error">
                                                     </div>
                                                     <div class="form-group">
                                                          <select class="form-control" placeholder="Activity" name="Activity" id="Activity">
                                                               <option value="feeling">feeling</option>
                                                               <option value="eating">eating</option>
                                                               <option value="watching">watching</option>
                                                          </select>
                                                          <span id="from"></span>
                                                     </div>
                                                  <h5>Select Content</h5>
                                                  <!-- Filter Content -->
                                                     <div id="error">
                                                     </div>
                                                     <div class="form-group">
                                                          <select class="form-control" placeholder="Content" name="Content" id="Content">
                                                               <option value="fresh">fresh</option>
                                                               <option value="happy">happy</option>
                                                               <option value="excited">excited</option>
                                                          </select>
                                                          <span id="from"></span>
                                                     </div>
                                                     <!-- Submit button -->
                                                     <div class="form-group">
                                                          <button type="submit" class="btn btn-default" name="btn-save" id="btn-content-submit">
                                                          Submit
                                                          </button>
                                                     </div>
                                                  </form>
                                                  <!-- The form ends here -->
                                             </div>
                                             <div class="modal-footer">
                                                  <button type="button" class="btn btn-default" data-dismiss="modal">Submit</button>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                            </ul>
                            <!--Filtering ends here-->
                                <table class="table" id="pagination_data">
                                    <thead>
                                        <tr>
                                              <!-- Displaying the data extracted from running the query in a tabular format. -->
                                             <th>Date</th>
                                             <th>Message Id</th>
                                             <th>Activity</th>
                                             <th>Content</th>
                                             <th>Email Id</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php
                                            $sql = mysql_query("SELECT  *  FROM Messages");
                                            $startrownum = mysql_num_rows($sql);
                                             //$row=mysql_fetch_assoc($sql);
                                            // This loop iterates through all the rows and prints till the last value from the selected date range.
                                            while($row=mysql_fetch_assoc($sql))
                                                       {
                                                            $dt = date('m/d/Y', $row['Date']);
                                             ?>
                                                    <td><?php echo $dt ?></td>
                                                    <td><?php echo $row['MessageId'] ?></td>
                                                    <td><?php echo $row['Activity'] ?></td>
                                                    <td><?php echo $row['Content'] ?></td>
                                                    <td><?php echo $row['EmailId'] ?></td>
                                        </tr>
                                            <?php } ?>
                                    </tbody>
                                </table>
                        </section>
                    </div>
                </div>
     </div>

</body>

<script>
     function openNav()
     {
          document.getElementById("mySidenav").style.width = "234px";
          document.getElementById("main").style.marginLeft = "234px";
     }

     function closeNav()
     {
          document.getElementById("mySidenav").style.width = "0";
          document.getElementById("main").style.marginLeft= "0";
     }
</script>

<script>
     $(document).ready(function(){
          load_data();
          function load_data(page)
          {
               $.ajax({
                    url:"pagination.php",
                    method:"POST",
                    data:{page:page},
                    success:function(data){
                         $('#pagination_data').html(data);
                    }
               })
          }
      $(document).on('click', '.pagination_link', function(){
           var page = $(this).attr("id");
           load_data(page);
      });
 });
 </script>

</body>

<script>
    $(document).ready(function(){
     $('#btn-content-submit').click(function(e){

          e.preventDefault(); //This prevents the default action of the button
          // console.log("works");
          var fromDate = $('#fromDate').val();
          var toDate = $('#toDate').val();
          var Activity = $('#Activity').val();
          var Content = $('#Content').val();

          // console.log(fromDate);
          // console.log(toDate);
          // console.log(Activity);
          // console.log(Content);


               $.ajax({
                    url:"filter.php",
                    type:"POST",
                    data :{
                         fromDate : fromDate,
                         toDate : toDate,
                         Content : Content,
                         Activity : Activity
           		}, // sending the value of counter and blogtag to the server
                    //data:{email:email},
                    success:function(data){
                    // $('#displayHtml').html(data);
                    $("#pagination_data").empty(); // Clearing the table contents so that the new fetched data from the filtering can be populated here.
                    // console.log(data);
                    $('#pagination_data').html(data);
                    }
               });

     });
});
 </script>

<!-- <script>

$(document).ready(function(){
$('#btn-content-submit').click(function(){


 $.ajax({

 		data :{
               fromDate : fromDate,
               toDate : toDate,
 			EmailId : EmailId,
               Content : Content,
               Activity : Activity
 		}, // sending the value of counter and blogtag to the server

 		type: 'POST',
 		url : 'filter.php' file for server side functions.

 	})

     .done(function(data){ // This function will execute after the AJAX request.

      	console.log("works");
    	});
}
}

</script> -->

</html>
