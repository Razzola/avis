<?php

    $mysqli = new mysqli("localhost", "root", "", "fca_pm");
    $stringQuery="SELECT a.rfc, startDate, endDate, manDays, environment, source_id, description FROM work_period a LEFT JOIN cab b ON a.rfc=b.rfc WHERE endDate > DATE_ADD(CURDATE(), INTERVAL -30 DAY)";
    $result = $mysqli->query($stringQuery);
    $row = $result->fetch_row();
    $i = 0;

    while ( $row != null ) {
        $sdDate=strtotime($row[1])*1000;
        $edDate=strtotime($row[2])*1000;

        $myObj[] = (object) [
            'from' => "/Date(".$sdDate.")/",
            'to' => "/Date(".$edDate.")/",
            'desc' => $row[6]
        ];


        $mySource[$i]= (object) [
              'name' => "RFC ".$row[0]." - ".$row[4]." ".$row[5],
              'values' => $myObj
         ];

        $myObj= null;
        $row = $result->fetch_row();
    	$i++;
    }



    $myJSON = ($mySource);

    echo json_encode($myJSON,JSON_UNESCAPED_SLASHES);

	$mysqli->close();

?>