<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
     <link href="assets/css/styleGoogleCharts.css" rel="stylesheet" type="text/css" media="screen">


     <?php
     include 'dbconfig.php';

     if(isset($_POST['this_date']))
     {
          $selectDate=$_POST['this_date'];
         $timestamp = strtotime($selectDate);

       $lista = array();
       $dens = array();
       $cor = array();
       $cor[0] = '#ff3300';
       $cor[1] = '#0000ff';
       $cor[2] = '#006600';
       $cor[3] = '#ff0066';
       $cor[4] = '#00ffe9';
       $i=0;
       $sql= "SELECT DISTINCT Activity,COUNT(Activity) people from Messages where Date='$timestamp' GROUP by Activity";
       $resultado=mysql_query($sql);
         while($row = mysql_fetch_assoc($resultado))
         {
           $id = $row['Activity'];
           $likess = $row['people'];
           $lista[$i] = $id;
           $dens[$i]=$likess;
           $i=$i+1;
         }
       }
       ?>
     <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
</head>
<body>
     <div id="columnchart_values"></div>
</body>
</html>
