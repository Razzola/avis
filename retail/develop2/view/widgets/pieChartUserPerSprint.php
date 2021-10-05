<?php

    if (isset($_GET["sprint"]))
        $sprint_id=$_GET["sprint"];
    else
        $sprint_id=getCurrentSprint();

    $stringQuery="SELECT id,CONCAT('Sprint ', order_number),start_date, end_date FROM sprint WHERE id=".$sprint_id;
    $result = $GLOBALS['mysqli']->query($stringQuery);
    $row = $result->fetch_row();
    //Find work days//
    $datediff = strtotime($row[3]) - strtotime($row[2]);
    $daysdiff = round($datediff / (60 * 60 * 24));
    //echo $daysdiff."<br/>";
    $tmp=floor($daysdiff/5);
    $weekenddays=$tmp*2;
    $freeworking_days=$daysdiff - $weekenddays;
    //echo $freeworking_days;


    $stringQuery="SELECT lastname,firstname,SUM(effort),SUM(effective),availability
              FROM users a
              LEFT JOIN tasks b ON b.assigned_to=a.uid
              LEFT JOIN cab c ON c.task_id=b.id
              WHERE b.sprint_id='".$sprint_id."'
              AND assigned_to='".$GLOBALS['user']."'
              GROUP BY lastname,firstname";
    //echo $stringQuery;
    $result = $GLOBALS['mysqli']->query($stringQuery);
    $row = $result->fetch_row();
    if ($row != null){
        $effort=0;
        $effective=0;
        $delta=0;

        //calibrate the effort/effective by availability
        if ($row[2] != 0)
            $effort=round($row[2]*100/$row[4],0,PHP_ROUND_HALF_UP);
        else
            $effort=$row[2];

        if ($row[3] != 0)
            $effective=round($row[3]*100/$row[4],0,PHP_ROUND_HALF_UP);
        else
            $effective=$row[3];

        // calculating extra effort
        $delta=$effective-$effort;
        if ($delta < 0)
            $delta=0;

        // calculating free days

        if ($freeworking_days >=  ($effort+$delta))
            $freeworking_days=$freeworking_days-($effort+$delta);
        else
            $freeworking_days=0;

?>

<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {

    var data = google.visualization.arrayToDataTable([
      ['Task', 'Hours per Day'],
      <?php
      ?>
      ['Effort',  <?php echo $effort;?>],
      ['Extra effort',  <?php echo $delta;?>],
      ['Free',  <?php echo $freeworking_days;?>]
    ]);

    var options = {
      title: '<?php echo $row[0]." ".$row[1]; ?>',
        slices: {
          0: { color: '#4040FF' },
          1: { color: '#FF4040' },
          2: { color: '#2AB45C' }
        }
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart<?php echo $i;?>'));

    chart.draw(data, options);
  }
</script>

<div id="piechart<?php echo $i;?>" style="width: 720px; height: 400px; float:left;">

</div>

<?php
    }
?>
