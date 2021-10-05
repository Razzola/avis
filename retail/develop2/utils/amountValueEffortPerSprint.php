<?php

    function amountValueEffortPerSprint($sprint_id){
        $stringQuery="SELECT SUM(cost*effort), SUM(effort), SUM(effective),SUM(cost*effective)
                                             FROM tasks a
                                             LEFT JOIN users b ON a.assigned_to=b.uid
                                             LEFT JOIN cab c ON c.task_id=a.id
                                             WHERE a.sprint_id=".$sprint_id;
         $result = $GLOBALS['mysqli']->query($stringQuery);
         //echo $stringQuery;
         $sprint_result = $result->fetch_row();
         $sprint_detail=null;
         $amount_estimated = $sprint_result[0];
         $effort = $sprint_result[1];
         $effective = $sprint_result[2];
         $amount = $sprint_result[3];
         $stringQuery="SELECT SUM(VALUE)
                          FROM tickets a
                          WHERE a.sprint_id=".$sprint_id;
          $result = $GLOBALS['mysqli']->query($stringQuery);
          //echo $stringQuery;
          $sprint_value = $result->fetch_row()[0];
          $sprint_detail[0]=$amount_estimated;
          $sprint_detail[1]=$effort;
          $sprint_detail[2]=$sprint_value;
          $sprint_detail[3]=$effective;
          $sprint_detail[4]=$amount;

    return $sprint_detail;
    }

?>