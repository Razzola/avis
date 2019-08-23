<div class='col-sm-12'>
    <form role="form" autocomplete="off" action="action/work-setup.php">
        <div class="bootstrap-select-wrapper col-sm-2">
            <label>RFC</label>
            <select class="selectpicker" title="Scegli RFC" name="rfc" id="rfc" onchange="updateWorkSetup()">
            <?php
             $stringQuery="SELECT id,b.rfc,b.environment,source_id, description,prod_date,startDate, endDate, manDays FROM tickets a RIGHT JOIN cab b ON a.id=b.source_id LEFT JOIN work_period c ON b.rfc=c.rfc WHERE b.status != 'Chiuso'";
             $result = $mysqli->query($stringQuery);
              $row = $result->fetch_row();

              while ( $row != null ) {
                $valueString=$row[1];
                if ($row[7]!=null || $row[7]!=""){
                    $valueString=$row[1]."|".$row[6]."|".$row[7]."|".$row[8];
                }
              ?>
                <option value=<?php echo $valueString; ?>><?php echo $row[1]." - ".htmlentities($row[4]); ?></option>
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
                              <td>".htmlentities($row[4])."</td>
                              <td>".$row[5]."</td>
                              <td>".$row[6]."</td>
                              <td>".$row[7]."</td>
                              <td>".$row[8]."</td>
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
    <form action="action/delete-work-setup.php">
        <div class="col-sm-2">
                <button style="margin-top:20px;"type="submit" class="btn btn-default">Clear</button>
        </div>
        <input type="hidden" id="toDelete" name="toDelete" value="">
    </form>
</div>