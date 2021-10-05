<?php
        function checkExistingSprint($sprint_id){
           $sprintIdListIS = $GLOBALS['mysqli']->query("SELECT COUNT(*) FROM `sprint` WHERE id ='".$sprint_id."' ");
           $sprintIdCountIS = $sprintIdListIS->fetch_row();
           $sprintIdTotalIS = $sprintIdCountIS[0];
            if($sprintIdTotalIS[0]==0){
                return false;
            }else
                return true;
      }
        function insertSprint($sprint){
            $sqlInsert = "INSERT into sprint (id,state,end_date,start_date,done_date,order_number) values (
            '" . $sprint->attributes()->id . "',
            '" . $sprint->state . "',
            '" . date("Y-m-d",strtotime($sprint->endDate)) . "',
            '" . date("Y-m-d",strtotime($sprint->startDate)) . "',
            '" . date("Y-m-d",strtotime($sprint->doneDate)) . "',
            '" . $sprint->orderNumber . "'
            )";
            //echo $columnBT[0]."<br/>";
            //echo $sqlInsert."<br/>";
            $result = mysqli_query($GLOBALS['mysqli'], $sqlInsert);

            check_error($result);
        }

         function updateSprint($sprint){
            $sqlUpdate = "UPDATE sprint
            SET state = '" . $sprint->state . "',
            end_date ='" . date("Y-m-d",strtotime($sprint->endDate)) . "',
            start_date ='" . date("Y-m-d",strtotime($sprint->startDate)) . "',
            done_date ='" . date("Y-m-d",strtotime($sprint->doneDate)) . "',
            order_number = '" . $sprint->orderNumber . "'
            WHERE id ='".$sprint->attributes()->id."'";
            $result = mysqli_query($GLOBALS['mysqli'], $sqlUpdate);

            check_error($result);
         }
?>