<?php
    $mysqli = new mysqli("localhost", "root", "", "fca_pm");
    $rfc = "";
    if ( isset($_GET['toDelete']) ) {
        $rfc = $_GET['toDelete'];
        $query = "DELETE FROM `work_period` WHERE rfc = ".$rfc;
        echo $query;
        $result=$mysqli->query($query) or die ($mysqli->error);
    }

    header("Location: ../index.php?p=work-setup");
	$mysqli->close();
?>