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

                    echo $ticketsIdCountBT[0];
                    if($ticketsIdCountBT[0]==0){
                        $sqlInsert = "INSERT into tickets (id,environment,summary,category,priority,status,date_submitted,due_date,updated,assigned_to,reporter) values (
                        '" . $columnBT[0] . "',
                        '".$environment."',
                        \"" . $columnBT[7] . "\",
                        '" . $columnBT[4] . "',
                        '" . $columnBT[5] . "',
                        '" . $columnBT[6] . "',
                        '" . $columnBT[1] . "',
                        '" . $columnBT[2] . "',
                        '" . $columnBT[3] . "',
                        '',
                        '')";
                        echo $sqlInsert;
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
                        SET summary = \"" . $columnBT[7] . "\",
                        category = '" . $columnBT[4] . "',
                        priority = '" . $columnBT[5] . "',
                        status = '" . $columnBT[6] . "',
                        date_submitted ='" . $columnBT[1] . "',
                        due_date ='" . $columnBT[2] . "',
                        updated = '" . $columnBT[3] . "',
                        assigned_to = '',
                        reporter = ''
                        WHERE id ='".$columnBT[0]."' AND environment = '".$environment."'";
                        echo $sqlUpdate;
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