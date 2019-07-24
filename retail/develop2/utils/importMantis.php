<?php

    if (isset($_POST["importMantis"])) {

        $fileNameMantis = $_FILES["fileMantis"]["tmp_name"];
        $environment="Mantis";

        if ($_FILES["fileMantis"]["size"] > 0) {

            $fileMantis = fopen($fileNameMantis, "r");
            $i=0;


            while (($columnMantis = fgetcsv($fileMantis, 10000, ",")) !== FALSE) {
                if($i>0){

                    //Take the list of IDs + environment
                    $resultIdList = $mysqli->query("SELECT COUNT(*) FROM `tickets` WHERE id ='".$columnMantis[0]."' AND environment = '".$environment."'");
                    $ticketsIdCount = $resultIdList->fetch_row();
                    $ticketsIdTotal = $ticketsIdCount[0];


                    //$resultIdList = $mysqli->query("SELECT COUNT(*) FROM `tickets`");
                    //$ticketsIdCount = $resultIdList->fetch_row();
                    //$ticketsIdTotal = $ticketsIdCount[0];

                    if($ticketsIdTotal[0]==0){
                        $sqlInsert = "INSERT into tickets (id,environment,summary,category,owner,priority,status,date_submitted,due_date,updated,severity,assigned_to,reporter, quotation,project) values (
                        '" . $columnMantis[0] . "',
                        '".$environment."',
                        '" . mysqli_real_escape_string($mysqli, $columnMantis[12]) . "',
                        'Bug',
                        '" . $columnMantis[8] . "',
                        '" . $columnMantis[4] . "',
                        '" . $columnMantis[13] . "',
                        '" . $columnMantis[9] . "',
                        '" . $columnMantis[16] . "',
                        '" . $columnMantis[11] . "',
                        '" . $columnMantis[5] . "',
                        '" . str_replace(".","",$columnMantis[3]) . "',
                        '" . $columnMantis[2] . "',
                         '" . $columnMantis[17] . "',
                        '" . $columnMantis[1] . "')";
                        $resultMantis = mysqli_query($mysqli, $sqlInsert);
                        //echo $sqlInsert;
                        if (! empty($resultMantis)) {
                            $typeMantis = "success";
                            $messageMantis = "CSV Data Imported into the Database";
                        } else {
                            $typeMantis = "error";
                            $messageMantis = "Problem in Importing CSV Data";
                        }
                        if (!$resultMantis)
                            echo mysqli_error($mysqli)."<br/>";
                     }
                    else{
                        $sqlUpdate = "UPDATE tickets
                        SET summary = '" . mysqli_real_escape_string($mysqli, $columnMantis[12]) . "',
                        category = 'Bug',
                        owner = '" . $columnMantis[8] . "',
                        priority = '" . $columnMantis[4] . "',
                        status = '" . $columnMantis[13] . "',
                        date_submitted ='" . $columnMantis[9] . "',
                        due_date ='" . $columnMantis[16] . "',
                        updated = '" . $columnMantis[11] . "',
                        severity = '" . $columnMantis[5] . "',
                        assigned_to = '" . str_replace(".","",$columnMantis[3]) . "',
                        reporter = '" . $columnMantis[2] . "',
                        quotation = '" . $columnMantis[17] . "',
                        project = '" . $columnMantis[1] . "'
                        WHERE id ='".$columnMantis[0]."' AND environment = '".$environment."'";
                        //echo $sqlUpdate;
                        $resultMantis = mysqli_query($mysqli, $sqlUpdate);

                        if (! empty($resultMantis)) {
                            $typeMantis = "success";
                            $messageMantis = "CSV Data Imported into the Database";
                        } else {
                            $typeMantis = "error";
                            $messageMantis = "Problem in Importing CSV Data";
                        }
                     }
                }
                $i++;
            }
        }
    }
?>