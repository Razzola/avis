<?php
    function check_cab_error($result){
        if (! empty($result)) {
                $type = "success";
                $message = "CSV Data Imported into the Database";
            } else {
                $type = "error";
                $message = "Problem in Importing CSV Data";
            }
    }

    function check_existing_cab_record($rfc){
        $resultIdListCAB = $GLOBALS['mysqli']->query("SELECT COUNT(*) FROM `cab` WHERE rfc ='".$rfc."'");
        $ticketsIdCountCAB = $resultIdListCAB->fetch_row();
        $ticketsIdTotalCAB = $ticketsIdCountCAB[0];
        if($ticketsIdCountCAB[0]==0)
            return false;
        else
            return true;
    }


    if (isset($_POST["importCAB"])) {
        $fileNameCAB = $_FILES["fileCAB"]["tmp_name"];
        //$environment="BugTracker";
        if ($_FILES["fileCAB"]["size"] > 0) {
            $fileCAB = fopen($fileNameCAB, "r");
            $i=0;

            while (($columnCAB = fgetcsv($fileCAB, 10000, ",")) !== FALSE) {

                if($i>1){
                    //Take the list of IDs + environment

                    //if ($columnCAB[17]=='' || $columnCAB[17]=='TBD'){
                    //    $columnCAB[17] == null;  //stop inserting 1970-01-01
                    //}else{
                    //    $columnCAB[17]= date("Y-m-d",strtotime(str_replace('/', '-', $columnCAB[17])));
                    //}
                    //echo "SELECT COUNT(*) FROM `tickets` WHERE id ='".$columnCAB[0]."' AND environment = '".$environment."'";
                    //echo $columnCAB[17];
                    $rfc=$columnCAB[0];
                    $environment=$columnCAB[1];
                    $story_id=$columnCAB[2];
                    $task_id=$columnCAB[3];
                    $type=$columnCAB[7];
                    $effective=$columnCAB[9];
                    $status=$columnCAB[12];
                    $sprint=str_replace("Sprint ", "", $columnCAB[6]);

                    if(!check_existing_cab_record($rfc)){
                        $sqlInsert = "INSERT into cab (rfc,environment,story_id,task_id,type,effective, status, sprint_id) values (
                        " . $rfc . ",
                        '" . $environment . "',
                        '" . $story_id . "',
                        '" . $task_id . "',
                        '" .$type . "',
                        '" . $effective . "',
                        '" . $status . "',
                        '" . $sprint . "')";
                        //echo $columnCAB[0]."<br/>";
                        //echo $sqlInsert."<br/>";
                        $result = mysqli_query($GLOBALS['mysqli'], $sqlInsert);
                        check_cab_error($result);
                    }
                    else{
                        $sqlUpdate = "UPDATE cab
                        SET environment = '" . $environment . "',
                        story_id ='" . $story_id."',
                        task_id='" . $task_id . "',
                        type='" . $type."',
                        effective='" . str_replace(',','.',$effective)."',
                        status='" . $status."',
                        sprint_id='" . $sprint . "'
                        WHERE rfc ='".$rfc."'";
                        //echo $columnCAB[2];
                        //echo $sqlUpdate."<br/>";
                        $result = mysqli_query($GLOBALS['mysqli'], $sqlUpdate);

                        check_cab_error($result);
                    }
                }
                $i++;
            }
        }
    }
?>