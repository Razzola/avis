<?php
     $sprint_id=null;
     $amount=0;
     $sprint_value=0;
     $effort=0;
     $ave_sprint=null;
     if (isset($_GET["sprint"])){
        $sprint_id=$_GET["sprint"];
     }else
        $sprint_id=getCurrentSprint();
     //Amount
     $ave_sprint=amountValueEffortPerSprint($sprint_id);


?>


<div class="table-responsive col-lg-12 col-md-6" style="height:1500px;">
        <select class="selectpicker" title="Scegli Sprint" name="sprintSelect" id="sprintSelect" onchange="location = this.options[this.selectedIndex].value && (window.location = 'index.php?p=sprint-monitoring&sprint='+this.options[this.selectedIndex].value);">
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
        <label style="margin-left:50px;"><?php echo "Cost : ".$ave_sprint[4]." €";?></label>
        <label style="margin-left:50px;"><?php echo "Effort : ".$ave_sprint[1]." MD";?></label>
        <label style="margin-left:50px;"><?php echo "Effective : ".$ave_sprint[3]." MD";?></label>
        <label style="margin-left:50px;"><?php echo "Value : ".$ave_sprint[2];?></label>
        <br/>
        <br/>
        <br/>
        <?php
            $i=0;

             $find_users="SELECT uid,lastname FROM users WHERE availability IS NOT NULL";
             $result_users = $GLOBALS['mysqli']->query($find_users);
             //echo $stringQuery;
             $users = $result_users->fetch_row();

             //echo "HEY".$row[0];
             while ($users != null) {
                $GLOBALS['user']=$users[0];
                   include "pieChartUserPerSprint.php";
                 $i++;
                 $users = $result_users->fetch_row();
            }
        ?>

 </div>

