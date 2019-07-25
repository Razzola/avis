<?php

    if (isset($_POST["importCAB"])) {
        $fileNameCAB = $_FILES["fileCAB"]["tmp_name"];
        //$environment="BugTracker";

        if ($_FILES["fileCAB"]["size"] > 0) {

            $fileCAB = fopen($fileNameCAB, "r");
            $i=0;


            while (($columnCAB = fgetcsv($fileCAB, 10000, ",")) !== FALSE) {
                if($i>0){
                    //Take the list of IDs + environment
                    $resultIdListCAB = $mysqli->query("SELECT COUNT(*) FROM `cab` WHERE rfc ='".$columnCAB[0]."'");
                    $ticketsIdCountCAB = $resultIdListCAB->fetch_row();
                    $ticketsIdTotalCAB = $ticketsIdCountCAB[0];
                    if ($columnCAB[17]=='' || $columnCAB[17]=='TBD'){
                        $columnCAB[17] == null;  //stop inserting 1970-01-01
                    }else{
                        $columnCAB[17]= date("Y-m-d",strtotime(str_replace('/', '-', $columnCAB[17])));
                    }
                    //echo "SELECT COUNT(*) FROM `tickets` WHERE id ='".$columnCAB[0]."' AND environment = '".$environment."'";
                    //echo $columnCAB[17];
                    if($ticketsIdCountCAB[0]==0){
                        $sqlInsert = "INSERT into cab (rfc,environment,source_id,prod_date,status,description) values (
                        " . $columnCAB[0] . ",
                        '" . $columnCAB[1] . "',
                        '" . mysqli_real_escape_string($mysqli, $columnCAB[2]) . "',
                        '" . $columnCAB[17] . "',
                        '" . $columnCAB[5] . "',
                        '" . mysqli_real_escape_string($mysqli, $columnCAB[3]) . "')";
                        //echo $columnCAB[0]."<br/>";
                        //echo $sqlInsert."<br/>";
                        $resultCAB = mysqli_query($mysqli, $sqlInsert);

                        if (! empty($resultCAB)) {
                            $typeCAB = "success";
                            $messageCAB = "CSV Data Imported into the Database";
                        } else {
                            $typeCAB = "error";
                            $messageCAB = "Problem in Importing CSV Data";
                        }
                     }
                    else{
                        $sqlUpdate = "UPDATE cab
                        SET source_id = '" . mysqli_real_escape_string($mysqli, $columnCAB[2]) . "',
                        environment = '" . $columnCAB[1] . "',
                        prod_date ='" . $columnCAB[17]."',
                        description='" . mysqli_real_escape_string($mysqli, $columnCAB[3]) . "',
                        status='" . $columnCAB[5]."'
                        WHERE rfc ='".$columnCAB[0]."'";
                        //echo $columnCAB[2];
                        //echo $sqlUpdate."<br/>";
                        $resultCAB = mysqli_query($mysqli, $sqlUpdate);

                        if (! empty($resultCAB)) {
                            $typeCAB = "success";
                            $messageCAB = "CSV Data Imported into the Database";
                        } else {
                            $typeCAB = "error";
                            $messageCAB = "Problem in Importing CSV Data";
                        }
                     }
                }
                $i++;
            }
        }
    }
?>