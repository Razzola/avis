<?php
     $sprint_id=null;
     $amount=0;
     $sprint_value=0;
     $effort=0;
     if (isset($_GET["sprint"])){
        $sprint_id=$_GET["sprint"];
        $ave_sprint=amountValueEffortPerSprint($sprint_id);
     }
     //Amount


?>

<div class="table-responsive col-lg-12 col-md-6">
        <select class="selectpicker" title="Scegli Sprint" name="sprintSelect" id="sprintSelect" onchange="location = this.options[this.selectedIndex].value && (window.location = 'index.php?p=cost-management-sprint&sprint='+this.options[this.selectedIndex].value);">
            <?php


             $stringQuery="SELECT id,CONCAT('Sprint ', order_number) FROM sprint";
             $result = $GLOBALS['mysqli']->query($stringQuery);
             $row = $result->fetch_row();

              while ( $row != null ) {
                    ?>
                        <option value=<?php echo $row[0]; if ($sprint_id==$row[0]) echo " selected";?>><?php echo $row[0]." - ".$row[1]; ?></option>
                    <?php


                  $row = $result->fetch_row();
                  }
              ?>

        </select>
        <label style="margin-left:50px;"><?php echo "Cost est.: ".$ave_sprint[0]." €";?></label>
        <label style="margin-left:50px;"><?php echo "Cost.: ".$ave_sprint[4]." €";?></label>
        <label style="margin-left:50px;"><?php echo "Effort : ".$ave_sprint[1]." MD";?></label>
        <label style="margin-left:50px;"><?php echo "Effective : ".$ave_sprint[3]." MD";?></label>
        <label style="margin-left:50px;"><?php echo "Value : ".$ave_sprint[2];?></label>
        <br/>
        <br/>
        <br/>
        <?php

                if ($sprint_id!=null){
        ?>
        <table class="table table-striped table-bordered table-sm">
            <thead>
                <tr>
                    <th class="th-sm">Story ID</th>
                    <th class="th-sm" style="width: 850px !important;">Summary</th>
                    <th class="th-sm">Cost Est. €</th>
                    <th class="th-sm">Cost Eff. €</th>
                    <th class="th-sm">Delta €</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $stringQuery="SELECT c.id,c.summary,SUM(cost*a.effort), SUM(cost*d.effective)
                                  FROM tasks a
                                  LEFT JOIN users b ON a.assigned_to=b.uid
                                  LEFT JOIN tickets c ON c.id=a.story_id
                                  LEFT JOIN cab d ON d.task_id=a.id
                                  WHERE a.sprint_id='".$sprint_id."'
                                  GROUP BY c.id";
                    $result = $mysqli->query($stringQuery);
                    //echo $stringQuery;
                    $row = $result->fetch_row();

                    while ( $row != null ) {
                    ?>
                    <tr>
                        <td><a href=
                            <?php
                                echo $icescrumUrl.$row[0];
                            ?> target="_blank"><?php echo $row[0]; ?></a></td>
                        <td><?php echo htmlentities($row[1]); ?></td>
                        <td><?php echo $row[2]; ?></td>
                        <td><?php echo $row[3]; ?></td>
                        <td
                            <?php
                                if($row[3]>$row[2] && $row[3]>0)
                                    echo "class='negative'";
                                elseif ($row[3]<$row[2] && $row[3]>0)
                                    echo "class='positive'";
                            ?>
                        ><?php echo $row[2]-$row[3]; ?></td>
                    </tr>
                    <?php
                        $row = $result->fetch_row();
                        }
                    ?>
            </tbody>
        </table>
        <?php
            }
        ?>

 </div>

