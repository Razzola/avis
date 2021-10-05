<?php

    function getCurrentSprint(){
        $stringQuery="SELECT id
                       FROM sprint
                       WHERE start_date < NOW()
                       AND end_date > NOW();";
        $result = $GLOBALS['mysqli']->query($stringQuery);
        $row = $result->fetch_row();
        $sprint_id=$row[0];
        return $sprint_id;
    }

 ?>