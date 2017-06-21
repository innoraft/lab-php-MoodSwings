<!-- This file deals with displaying the analytics in google charts -->

<?php
include 'dbconfig.php';

  $lista = array();
  $dens = array();
  $cor = array();
  $cor[0] = '#ff3300';
  $cor[1] = '#0000ff';
  $cor[2] = '#006600';
  $cor[3] = '#ff0066';
  $cor[4] = '#00ffe9';
  $i=0;
  $sql= "SELECT DISTINCT Activity,COUNT(Activity) people from Messages GROUP by Activity";
  $resultado=mysql_query($sql);
    while($row = mysql_fetch_assoc($resultado))
    {
      $id = $row['Activity'];
      $likess = $row['people'];
      $lista[$i] = $id;
      $dens[$i]=$likess;
      $i=$i+1;
    }
  //}
  ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
  <link href="assets/css/styleGoogleCharts.css" rel="stylesheet" type="text/css" media="screen">
 <script type="text/javascript">
   google.charts.load("current", {packages:['corechart']});
   google.charts.setOnLoadCallback(drawChart);
   function drawChart() {
     var data = google.visualization.arrayToDataTable([
       ["Element", "Likes", { role: "style" } ],
         <?php
           $k=$i;
            for ($i = 0; $i < $k; $i++) { ?>

             ['<?php echo $lista[$i]; ?>',<?php echo $dens[$i]; ?>,'<?php echo $cor[$i]; ?>'],
             <?php } ?>

             ]);

     var view = new google.visualization.DataView(data);
     view.setColumns([0, 1,
                      { calc: "stringify",
                        sourceColumn: 1,
                        type: "string",
                        role: "annotation" },
                      2]);

     var options = {
       title: "People vs Activity",
       width: 1200,
       height: 500,
       bar: {groupWidth: "65%"},
       legend: { position: "none" },
     };
     var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
     chart.draw(view, options);
 }
 </script>
<html>
<body>

     <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="googlecharts.php">Charts</a>
        <a href="displayHtml.php">Messages Table</a>
        <a href="usersTable.php">Users Table</a>
        <a href="userRoleTable.php">User Role Table</a>
        <a href="gmail.php">Inbox</a>
    </div>

    <div id="main">
        <!-- <div class="row"> -->
            <nav class="navbar navbar-inverse mynavheader">
            <!-- <div class="container-fluid"> -->
                <div class="navbar-header">
                    <span style="font-size:25px;cursor:pointer;position: absolute;top: 8px;left: 14px;" onclick="openNav()">&#9776;</span>
                    <!-- <a class="navbar-brand" href="#">Moodswing</a> -->
                </div>
                <ul class="nav navbar-nav">
                     <li class="dropdown">
                         <a class="dropdown-toggle" data-toggle="dropdown" href="#">Filter by Date
                         <span class="caret"></span></a>
                         <ul class="dropdown-menu mydropdownmenu">
                              <form action="filterchart.php" method="post">
                                  <input type="date" name="this_date" id="this_date">
                                  <button type="submit" id="submit" name="submit"/>SUBMIT</button>
                             </form>
                         </ul>
                     </li>

               </ul>
          </nav>

     <div class="card">
          <div id="columnchart_values"></div>
     </div>
</div>
</body>

<!-- script for opening and closing of the nav bar -->
<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "234px";
    document.getElementById("main").style.marginLeft = "234px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
}
</script>

</html>
