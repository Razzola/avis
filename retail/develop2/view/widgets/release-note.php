<?php
$prodDate='';
$filterString='';
if (isset ($_GET['prod_date'])){
        $prodDate=$_GET['prod_date'];
        $filterString='WHERE prod_date='.$prodDate;
    }
?>

<div class="table-responsive col-lg-12 col-md-6">
        <select class="selectpicker" title="Scegli RFC" name="rfc" id="rfc" onchange="location = this.options[this.selectedIndex].value && (window.location = 'index.php?p=inner-release-note&prod_date='+this.options[this.selectedIndex].value);">
            <?php
             $stringQuery="SELECT prod_date FROM cab GROUP BY prod_date";
             $result = $mysqli->query($stringQuery);
              $row = $result->fetch_row();

              while ( $row != null ) {
                    if ($row[0]>'1970-01-01'){
                    ?>
                        <option value=<?php echo $row[0]; if ($prodDate==$row[0]) echo " selected";?>><?php echo $row[0]; ?></option>
                    <?php
                    }
              ?>

              <?php


                  $row = $result->fetch_row();
                  }
              ?>

        </select>
        <br/>
        <br/>
        <br/>
        <table id="dtTable" class="table table-striped table-bordered table-sm">
            <thead>
                <tr>
                    <th class="th-sm">ID</th>
                    <th class="th-sm">Environment</th>
                    <th class="th-sm">Source</th>
                    <th class="th-sm" style="width: 850px !important;">Description</th>
                    <th class="th-sm">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $stringQuery="SELECT rfc,environment,source_id, description, status FROM cab ".$filterString;
                    $result = $mysqli->query($stringQuery);
                    //echo $stringQuery;
                    $row = $result->fetch_row();

                    while ( $row != null ) {
                    ?>
                    <tr>
                        <td><a href=
                            <?php
                            if ($row[1]==$bugtracker)
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