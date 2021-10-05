<?php

    function amountPerStory($story_id){
        $stringQuery="SELECT SUM(cost*effort),SUM(cost*effective)
                          FROM tasks a
                          LEFT JOIN users b ON a.assigned_to=b.uid
                          LEFT JOIN cab c on c.task_id=a.id
                          WHERE a.story_id=".$story_id;
        $result = $GLOBALS['mysqli']->query($stringQuery);
        //echo $stringQuery;
        $amount = $result->fetch_row();

    return $amount;
    }

?>