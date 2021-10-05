<?php
   include "../utils/dbConnect.php";
   $filename = 'cabDiscrepancy.xls';
   $stringQuery="SELECT * FROM(
                 SELECT order_number as 'sprint_id', a.id as 'task_id'
                 from tasks a
                 JOIN sprint b ON a.sprint_id=b.id
                 UNION ALL
                 SELECT sprint_id,task_id from cab where status!= 'Rejected') tbl
                 GROUP BY task_id
                 HAVING count(*) >= 3
                 ORDER BY task_id";
   $result = $GLOBALS['mysqli']->query($stringQuery);

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

     echo ucwords($columnHeader) . "\n" . $setData . "\n";
?>