<div class="table-responsive col-lg-12 col-md-12">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Group</th>
                    <?php
                        //Building column for all severities
                        $groups= $mysqli->query("SELECT severity FROM tickets WHERE ".$exclude_closed."GROUP BY severity");
                        $column = $groups->fetch_row();
                        $firstRow="";                   //init first row query
                        $i=0;
                        $macroQuery="";
                        while ( $column != null ) {
                            if($i!=0){
                                $firstRow=$firstRow.",";
                            }
                            $firstRow=$firstRow.$column[0];
                            //Building macro query
                            $macroQuery=$macroQuery." LEFT JOIN (SELECT groups, COUNT(*) AS ".$column[0]." FROM users a LEFT JOIN tickets b ON a.user=b.assigned_to WHERE severity='".$column[0]."'  ".$envFilter." AND ".$exclude_closed."GROUP BY groups) ".$column[0]." ON a.groups=".$column[0].".groups";
                            //
                            $i++;
                            ?>
                            <th>
                                <?php echo strtoupper($column[0]);
                                    $column = $groups->fetch_row();?>
                            </th>
                    <?php
                        }
                        //
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php


                    $firstRow="SELECT a.GROUPS,".$firstRow." FROM ";
                    $totTicketsByType="(SELECT groups AS GROUPS, COUNT(*) AS TOTAL FROM users a RIGHT JOIN tickets b ON a.user=b.assigned_to ".$filterByType."  ".$envFilter." AND ".$exclude_closed."GROUP BY groups) a";
                    $ultimateQuery=$firstRow.$totTicketsByType.$macroQuery;
                    $result = $mysqli->query($ultimateQuery);
                    $row = $result->fetch_row();



                    while ( $row != null ) {
                    if ($row[0]!=null){
                        ?>
                        <tr>
                            <?php
                                $cell=0;
                                $cellValue="";
                                while ( $cell <= $i ){
                                    if ($cell==0)
                                        $cellValue="<a href='index.php?p=view&type=".$type."&team=".$row[$cell]."&perimeter=Group'>".$row[0]."</a>";
                                    else
                                        $cellValue=$row[$cell];
                                ?>
                                <td><?php echo $cellValue; ?></td>
                                <?php
                                    $cell++;
                                }
                            ?>
                        </tr>
                    <!--<td><a href="index.php?p=view&type=<?php echo $type;?>&team=<?php echo $row[0]; ?>&perimeter=Group"><?php echo $row[0];?> </a></td>-->
                    <?php
                        }
                        $row = $result->fetch_row();
                        }
                    ?>
            </tbody>
        </table>
 </div>