<?php

    if (isset($_POST["importBT"])) {

        $fileNameBT = $_FILES["fileBT"]["tmp_name"];
        $environment="BugTracker";

        if ($_FILES["fileBT"]["size"] > 0) {

            $fileBT = fopen($fileNameBT, "r");
            $i=0;


            while (($columnBT = fgetcsv($fileBT, 10000, ",")) !== FALSE) {
                if($i>0){

                    //Take the list of IDs + environment
                    $resultIdListBT = $mysqli->query("SELECT COUNT(*) FROM `tickets` WHERE id ='".$columnBT[0]."' AND environment = '".$environment."'");
                    $ticketsIdCountBT = $resultIdListBT->fetch_row();
                    $ticketsIdTotalBT = $ticketsIdCountBT[0];
                    //echo "SELECT COUNT(*) FROM `tickets` WHERE id ='".$columnBT[0]."' AND environment = '".$environment."'";
                    //echo $ticketsIdCountBT[0];
                    if($ticketsIdCountBT[0]==0){
                        $sqlInsert = "INSERT into tickets (id,environment,summary,category,priority,status,date_submitted,due_date,updated,assigned_to,reporter) values (
                        '" . $columnBT[0] . "',
                        '".$environment."',
                        '" . mysqli_real_escape_string($mysqli, $columnBT[10]) . "',
                        '" . $columnBT[6] . "',
                        '" . $columnBT[7] . "',
                        '" . substr($columnBT[7],2) . "',
                        '" . $columnBT[8] . "',
                        '" . date("Y-m-d",strtotime($columnBT[1])) . "',
                        '" . date("Y-m-d",strtotime($columnBT[2])) . "',
                        '" . date("Y-m-d",strtotime($columnBT[3])) . "',
                        '" . str_replace(".","",$columnBT[5]) . "',
                        '" . $columnBT[9] . "')";
                        //echo $columnBT[0]."<br/>";
                        //echo $sqlInsert."<br/>";
                        $resultBT = mysqli_query($mysqli, $sqlInsert);

                        if (! empty($resultBT)) {
                            $typeBT = "success";
                            $messageBT = "CSV Data Imported into the Database";
                        } else {
                            $typeBT = "error";
                            $messageBT = "Problem in Importing CSV Data";
                        }
                     }
                     else{
                        $sqlUpdate = "UPDATE tickets
                        SET summary = '" . mysqli_real_escape_string($mysqli, $columnBT[10]) . "',
                        category = '" . $columnBT[6] . "',
                        priority = '" . $columnBT[7] . "',
                        severity = '" . substr($columnBT[7],2) . "',
                        status = '" . $columnBT[8] . "',
                        date_submitted ='" . date("Y-m-d",strtotime($columnBT[1])) . "',
                        due_date ='" . date("Y-m-d",strtotime($columnBT[2])) . "',
                        updated = '" . date("Y-m-d",strtotime($columnBT[3])) . "',
                        assigned_to = '" . str_replace(".","",$columnBT[5]) . "',
                        reporter = '" . $columnBT[9] . "'
                        WHERE id ='".$columnBT[0]."' AND environment = '".$environment."'";
                        //echo $columnBT[2];
                        //echo $sqlUpdate."<br/>";
                        $resultBT = mysqli_query($mysqli, $sqlUpdate);

                        if (! empty($resultBT)) {
                            $typeBT = "success";
                            $messageBT = "CSV Data Imported into the Database";
                        } else {
                            $typeBT = "error";
                            $messageBT = "Problem in Importing CSV Data";
                        }
                     }
                }
                $i++;
            }
        }
    }
?>