<?php

$mysqli = new mysqli("localhost", "root", "", "fca_pm");
$rfc = "";
if ( isset($_GET['rfc']) ) {
	$rfc = explode('|',$_GET['rfc'])[0];
	$sd = $_GET['startDate'];
	$ed = $_GET['endDate'];
	$manDays = $_GET['manDays'];
	$action = $_GET['action'];
	if($action=='insert')
	    $query = "INSERT INTO `work_period` ( rfc, startDate, endDate, manDays ) VALUES ( ".$rfc.", '".$sd."', '".$ed."',".$manDays." ) ";
    elseif($action=='update')
        $query = "UPDATE `work_period` SET startDate = '".$sd."', endDate = '".$ed."', manDays= ".$manDays."  WHERE rfc = ".$rfc;

    $result=$mysqli->query($query) or die ($mysqli->error);
}
	$mysqli->close();

	header("Location: ../index.php?p=work-setup");
//
?>

