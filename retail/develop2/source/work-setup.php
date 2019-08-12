<?php

    $mysqli = new mysqli("localhost", "root", "", "fca_pm");
    $stringQuery="SELECT a.rfc, startDate, endDate, manDays, environment, source_id FROM work_period a LEFT JOIN cab b ON a.rfc=b.rfc";
    $result = $mysqli->query($stringQuery);
    $row = $result->fetch_row();
    $i = 0;

    while ( $row != null ) {
        sdDate= $row[1];

        $myObj[] = (object)array();
        $myObj[$i]->from = "/Date(".strtotime($row[1]).")/";
        $myObj[$i]->to = "/Date(".strtotime($row[2]).")/";
        $myObj[$i]->desc = $row[4]." ".$row[5];
        $myObj[$i]->customClass ="";
    	$myObj[$i]->dataObj="";
        $row = $result->fetch_row();

        $mySource[] = (object)array();
        $mySource[$i]->name = $row[4]." ".$row[5];
        $mySource[$i]->desc = $row[4]." ".$row[5];
        $mySource[$i]->values = $myObj;
    	$i++;
    }



    $myJSON = ($mySource);

    echo json_encode($myJSON,JSON_UNESCAPED_SLASHES);

	$mysqli->close();
?>