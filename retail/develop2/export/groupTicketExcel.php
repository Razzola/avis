<?php
   $filename = 'export.xls';
   $mysqli = new mysqli("localhost", "root", "", "fca_pm");
   $stringQuery="SELECT id,a.environment,summary,severity, prod_date, startDate, endDate FROM tickets a LEFT JOIN users b ON a.assigned_to=b.user LEFT JOIN cab c ON a.id=c.source_id LEFT JOIN work_period d ON c.rfc=d.rfc ";
   $result = $mysqli->query($stringQuery);

   $columnHeader = '';
   $finfo = mysqli_fetch_fields($result);

   foreach ($finfo as $val) {
       $columnHeader .= str_replace("_"," ",strtoupper($val->name)). "\t";
       echo str_replace("_"," ",strtoupper($val->name));
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

   header("Content-type: application/octet-stream");
   header("Content-Disposition: attachment; filename=$filename");
   header("Pragma: no-cache");
   header("Expires: 0");

     echo ucwords($columnHeader) . "\n" . $setData . "\n";*/
?>