<?php
     $story_id=null;
     if (isset($_GET["story"]))
        $story_id=$_GET["story"];
     //Amount
     $amount=0;
     if ($story_id!=null)
        $amount=amountPerStory($story_id);
?>

<div class="table-responsive col-lg-12 col-md-6">
        <select class="selectpicker" title="Scegli Story" name="storySelect" id="storySelect" onchange="location = this.options[this.selectedIndex].value && (window.location = 'index.php?p=cost-management&story='+this.options[this.selectedIndex].value);">
            <?php


             $stringQuery="SELECT id,summary FROM tickets";
             $result = $GLOBALS['mysqli']->query($stringQuery);
             $row = $result->fetch_row();

              while ( $row != null ) {
                    ?>
                        <option value=<?php echo $row[0]; if ($story_id==$row[0]) echo " selected";?>><?php echo $row[0]." - ".$row[1]; ?></option>
                    <?php


                  $row = $result->fetch_row();
                  }
              ?>

        </select>
        <label style="margin-left:50px;"><?php echo "Cost est. : ".$amount[0]." €";?></label>
        <label style="margin-left:50px;"><?php echo "Cost : ".$amount[1]." €";?></label>
        <br/>
        <br/>
        <br/>
        <?php

                if ($story_id!=null){
        ?>
        <table class="table table-striped table-bordered table-sm">
            <thead>
                <tr>
                    <th class="th-sm">Task ID</th>
                    <th class="th-sm" style="width: 850px !important;">Summary</th>
                    <th class="th-sm">Developer</th>
                    <th class="th-sm">Effort</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $stringQuery="SELECT a.id,summary, CONCAT(firstname,' ', lastname), effort
                                  FROM tasks a
                                  LEFT JOIN users b ON a.assigned_to=b.uid
                                  WHERE story_id=".$story_id;
                    $result = $mysqli->query($stringQuery);
                    //echo $stringQuery;
                    $row = $result->fetch_row();

                    while ( $row != null ) {
                    ?>
                    <tr>
                        <td><a href=
                            <?php
                                echo $icescrumUrl."T".$row[0];
                            ?> target="_blank"><?php echo $row[0]; ?></a></td>
                        <td><?php echo htmlentities($row[1]); ?></td>
                        <td><?php echo $row[2]; ?></td>
                        <td><?php echo $row[3]; ?></td>
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

