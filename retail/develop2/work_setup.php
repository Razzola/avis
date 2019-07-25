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
          $row = $result->fetch_row();
          }
      ?>

  </select>
</div>
<div class='col-sm-6'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker1'>
                    <input type='text' class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
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
                <?php
                    $stringQuery="SELECT id,rfc,b.environment,description,prod_date FROM tickets a RIGHT JOIN cab b ON a.id=b.source_id WHERE b.status != 'Chiuso'";
                    $result = $mysqli->query($stringQuery);
                    $row = $result->fetch_row();

                    while ( $row != null ) {
                    ?>
                    <tr>
                        <td><a href=
                            <?php
                            if ($row[2]==$bugtracker)
                                echo $btUrl;
                            else
                                echo $mantisUrl;
                             ?>view.php?id=<?php echo $row[0]; ?> target="_blank"><?php echo $row[0]; ?></a></td>
                        <td><?php echo $row[1]; ?></td>
                        <td><?php echo $row[2]; ?></td>
                        <td><?php echo htmlentities($row[3]); ?></td>
                        <td><?php echo $row[4]; ?></td>
                    </tr>
                    <?php
                        $row = $result->fetch_row();
                        }
                    ?>
            </tbody>
        </table>

 </div>