<?php
    $mysqli = new mysqli("localhost", "root", "", "fca_pm");
    $rfc = "";
    if ( isset($_GET['rfc']) ) {
        $rfc = explode('|',$_GET['rfc'])[0];
        $sd = $_GET['startDate'];
        $ed = $_GET['endDate'];
        $manDays = $_GET['manDays'];
        $action = $_GET['action'];
        $query = "DELETE FROM `work_period` WHERE rfc = ".$rfc;
        $result=$mysqli->query($query) or die ($mysqli->error);
    }

    header("Location: ../index.php?p=work-setup");
	$mysqli->close();
?>