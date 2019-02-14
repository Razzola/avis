<?php

	$mysqli = new mysqli("localhost", "root", "", "fca_pm");

	/*if ( isset($_POST["name"]) and isset($_POST["desc"]) ) {
		$name = $_POST["name"];
		$desc = $_POST["desc"];
		$uid = $_POST["uid"];
		// TODO Check uid, determinate if it's update action or not
		
		if ( $uid != "null" ) {
			$mysqli->query("UPDATE `ingredients` SET name='$name', description='$desc' WHERE uid=$uid");
		} else {
			$mysqli->query("INSERT INTO `ingredients` ( uid, name, description ) VALUES ( $uid, '$name', '$desc' )");
		}
		unset($_POST["uid"]);
		unset($_POST["name"]);
		unset($_POST["desc"]);
	}

	$result = $mysqli->query("SELECT COUNT(*) FROM `category`");
	$row = $result->fetch_row();
	$categoryTotal = $row[0];

	$result = $mysqli->query("SELECT COUNT(*) FROM `ingredients`");
	$row = $result->fetch_row();
	$ingredientsTotal = $row[0];
	
	$result = $mysqli->query("SELECT COUNT(*) FROM `products`");
	$row = $result->fetch_row();
	$productsTotal = $row[0];*/
	
	$result = $mysqli->query("SELECT COUNT(*) FROM `tickets`");
	$ticketsCount = $result->fetch_row();
	$ticketsTotal = $ticketsCount[0];
?>

<div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-database fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $ticketsTotal; ?></div>
                        <div>Mantis</div>
                    </div>
                </div>
            </div>
            <a href="index.php?p=view&type=prd">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-book fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"></div>
                        <div>Recipes</div>
                    </div>
                </div>
            </div>
            <a href="index.php?p=view&type=rec">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-database fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"></div>
                        <div>Warehouse</div>
                    </div>
                </div>
            </div>
            <a href="index.php?p=view&type=wh">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <form class="col-lg-3 col-md-6" action="" method="post" name="uploadCSV"
        enctype="multipart/form-data">
        <div class="input-row">
            <h4>Choose Mantis CSV</h4>
            <input
                type="file" name="fileMantis" id="fileMantis" accept=".csv">
            <button type="submit" id="submit" name="importMantis"
                class="btn btn-primary">Import</button>
            <br />

        </div>
        <div id="labelError"></div>
    </form>
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


                        $resultIdList = $mysqli->query("SELECT COUNT(*) FROM `tickets`");
                        $ticketsIdCount = $resultIdList->fetch_row();
                        $ticketsIdTotal = $ticketsIdCount[0];

                        if($ticketsIdTotal[0]=0){
                            $sqlInsert = "INSERT into tickets (id,environment,summary,category,owner,priority,status,date_submitted,due_date,updated,severity) values (
                            '" . $columnMantis[0] . "',
                            '".$environment."',
                            \"" . $columnMantis[12] . "\",
                            'Bug',
                            '" . $columnMantis[8] . "',
                            '" . $columnMantis[4] . "',
                            '" . $columnMantis[13] . "',
                            '" . $columnMantis[9] . "',
                            '" . $columnMantis[16] . "',
                            '','" . $columnMantis[11] . "',
                            '" . $columnMantis[5] . "')";
                            $resultMantis = mysqli_query($mysqli, $sqlInsert);

                            if (! empty($resultMantis)) {
                                $typeMantis = "success";
                                $messageMantis = "CSV Data Imported into the Database";
                            } else {
                                $typeMantis = "error";
                                $messageMantis = "Problem in Importing CSV Data";
                            }
                         }
                         else{
                            $sqlUpdate = "UPDATE tickets
                            SET id = '" . $columnMantis[0] . "',
                            environment'".$environment."',
                            summary = \"" . $columnMantis[12] . "\",
                            category = 'Bug',
                            owner = '" . $columnMantis[8] . "',
                            priority = '" . $columnMantis[4] . "',
                            status = '" . $columnMantis[13] . "',
                            date_submitted ='" . $columnMantis[9] . "',
                            due_date ='" . $columnMantis[16] . "',
                            updated = '','" . $columnMantis[11] . "',
                            severity'" . $columnMantis[5] . "'
                            WHERE id ='".$columnMantis[0]."' AND environment = '".$environment."'";
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
</div>
