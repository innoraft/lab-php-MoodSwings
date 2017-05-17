<?php
include 'dbconfig.php';
// if(isset($_GET['datee']))
// {
//      $selectDate=$_GET['datee'];
//     $timestamp = strtotime($selectDate);

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
       height: 600,
       bar: {groupWidth: "65%"},
       legend: { position: "none" },
     };
     var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
     chart.draw(view, options);
 }
 </script>
<html>
<body>
     <form action="filterchart.php" method="post">
          <input type="date" name="this_date" id="this_date">
          <input type="submit" id="submit" name="submit"/>
     </form>

     <div id="columnchart_values"></div>

     <!-- <script>
$(document).ready(function(){
     $('#submit').click(function(){
          var datee = $('#this_date').val();
          if(datee == '')
          {
               $('#error_message').html("Email required");
          }
          else
          {
               $('#error_message').html('');
               $.ajax({
                    url:"googlecharts.php?datee="+datee,
                    type:"GET",
                    //data:{email:email},
                    success:function(data){
                         alert(data);
                         $('#columnchart_values').css('visibility', 'visible').html(data);
                    }
               });
          }
     });
});
</script> -->

</body>
</html>
