<?php
       $filename = 'export.xls';
       $columnHeader = '';
       $mysqli = new mysqli("localhost", "root", "", "fca_pm");
       //Take string value from session
       session_start();
       $stringQuery=$_SESSION['stringQuery'];

       $result = $result = $mysqli->query($stringQuery);
       $finfo = mysqli_fetch_fields($result);

       foreach ($finfo as $val) {
           $columnHeader .= str_replace("_"," ",strtoupper($val->name)). "\t";
       }


       //$columnHeader = "User Id" . "\t" . "First Name" . "\t" . "Last Name" . "\t";
       $setData = '';
         while ($rec = mysqli_fetch_row($result)) {
           $rowData = '';
           foreach ($rec as $value) {
               $value = '"' . $value . '"' . "\t";
               $rowData .= $value;
           }
           $setData .= trim($rowData) . "\n";
       }

	    $mysqli->close();
       header("Content-type: application/octet-stream");
       header("Content-Disposition: attachment; filename=$filename");
       header("Pragma: no-cache");
       header("Expires: 0");

         echo ucwords($columnHeader) . "\n" . $setData . "\n";

?>