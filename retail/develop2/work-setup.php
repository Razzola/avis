<?php

?>
<div class="bootstrap-select-wrapper">
  <label>Etichetta</label>
  <select title="Scegli una opzione">
  <?php
      $stringQuery="SELECT id,rfc,b.environment,description,prod_date FROM tickets a RIGHT JOIN cab b ON a.id=b.source_id WHERE b.status != 'Chiuso'";
      $result = $mysqli->query($stringQuery);
      $row = $result->fetch_row();

      while ( $row != null ) {

      ?>
        <option value=<?php echo $row[1]; ?>><?php echo $row[1]; ?></option>
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
<div class='col-sm-2'>
            <div class="it-datepicker-wrapper">
              <div class="form-group">
                <input class="form-control" id="date" type="text" placeholder="" title="format : "/>
              </div>
            </div>
 </div>
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