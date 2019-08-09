<?php

?>
<div class='col-sm-12'>
    <form role="form" autocomplete="off" action="action/work-setup.php">
        <div class="bootstrap-select-wrapper col-sm-2">
            <label>RFC</label>
            <select class="selectpicker" title="Scegli RFC" name="rfc" id="rfc" onchange="updateWorkSetup()">
            <?php
              $stringQuery="SELECT id,rfc,b.environment,description,prod_date FROM tickets a RIGHT JOIN cab b ON a.id=b.source_id WHERE b.status != 'Chiuso'";
              $result = $mysqli->query($stringQuery);
              $row = $result->fetch_row();

              while ( $row != null ) {
                //code to take work periods
                $strQueryWorkPeriod="SELECT rfc, startDate, endDate, manDays from work_period WHERE rfc = ".$row[1];
                $wpResult = $mysqli->query($strQueryWorkPeriod);
                $wpRow = $wpResult->fetch_row();
                $valueString=$row[1];
                if ($wpRow[0]!=null){
                    $valueString=$row[1]."|".$wpRow[1]."|".$wpRow[2]."|".$wpRow[3];
                }
                ///
              ?>
                <option value=<?php echo $valueString; ?>><?php echo $row[1]; ?></option>
              <?php

              if ($row[2]==$bugtracker)
                  $direction = $btUrl;
              else
                  $direction =  $mantisUrl;
              //building table rows
              $table_row="<tr><td><a href='".$direction."view.php?id=".$row[0]."' target='_blank'>".$row[0]."</a></td>
                              <td>".$row[1]."</td>
                              <td>".$row[2]."</td>
                              <td>".htmlentities($row[3])."</td>
                              <td>".$row[4]."</td>
                          </tr>";
                  $table_rows=$table_rows.$table_row;
                  $row = $result->fetch_row();
                  }
              ?>

          </select>
        </div>
        <div class="it-datepicker-wrapper col-sm-2">
          <div class="form-group">
          <label>Start date</label>
            <input class="form-control date" id="startDate" name="startDate" type="text" placeholder="" onchange="updateManDays()"/>
          </div>
        </div>
        <div class="it-datepicker-wrapper col-sm-2">
          <div class="form-group">
          <label>End date</label>
            <input class="form-control date" id="endDate" name="endDate" type="text" placeholder="" onchange="updateManDays()"/>
          </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
              <label>Man Days</label>
                <input class="form-control" id="manDays" name="manDays" type="text" onchange="updateEndDate()"/>
            </div>
        </div>
        <div class="col-sm-2">
                <button style="margin-top:20px;"type="submit" class="btn btn-default">Save</button>
        </div>
        <input type="hidden" id="action" name="action" value="insert">
    </form>
</div>
<?php
    include "view/widgets/overall-gantt.php";
?>
<div class="table-responsive col-lg-12 col-md-6">
        <table id="dtTable" class="table table-striped table-bordered table-sm">
            <thead>
                <tr>
                    <th class="th-sm">ID</th>
                    <th class="th-sm">RFC</th>
                    <th class="th-sm">Environment</th>
                    <th class="th-sm">Description</th>
                    <th class="th-sm">Prod Date</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $table_rows; ?>
            </tbody>
        </table>

 </div>