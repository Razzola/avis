<?php
   include "../utils/dbConnect.php";
   $filename = 'cabEnricher.xls';
   $stringQuery="SELECT b.environment,story_id,b.id,c.summary, b.summary, CONCAT('Sprint ',order_number), '',REPLACE(b.effort, '.', ','),'', CONCAT(SUBSTRING(firstname, 1, 1),SUBSTRING(lastname, 1, 1)),'','',b.impact
                                                   FROM sprint a
                                                   RIGHT JOIN tasks b ON b.sprint_id=a.id
                                                   LEFT JOIN tickets c ON b.story_id=c.id
                                                   LEFT JOIN users d on d.uid=b.assigned_to
                                                   WHERE b.id NOT IN (SELECT task_id from cab)
                                                   ORDER BY b.id ASC";
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