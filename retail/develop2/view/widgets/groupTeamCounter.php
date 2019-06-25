<div class="table-responsive col-lg-12 col-md-12">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Users</th>
                    <?php
                        $mysqli = new mysqli("localhost", "root", "", "fca_pm");
                        if($type!='All'){
                            $filterByType= "WHERE  environment='".$type."'";
                        }else{
                            $filterByType="";
                        }
                        //Building column for all severities
                        $groups= $mysqli->query("SELECT severity FROM tickets GROUP BY severity");
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
                            $macroQuery=$macroQuery." LEFT JOIN (SELECT groups, COUNT(*) AS ".$column[0]." FROM users a LEFT JOIN tickets b ON a.user=b.assigned_to WHERE severity='".$column[0]."' GROUP BY groups) ".$column[0]." ON a.groups=".$column[0].".groups";
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
                    $result = $mysqli->query("SELECT a.USER,".$UTotal.",".$UBlock.",".$UCrash.",".$UUrgent.",".$UHigh.",".$UMajor.",".$UNormal.",".$UMinor.",".$UTrivial.",".$UTweak." FROM
                                              		(SELECT a.user AS USER, COUNT(*) AS TOTAL FROM users a
                                                    	      RIGHT JOIN tickets b ON a.user=b.assigned_to
                                                    	      WHERE a.groups='".$team."'
                                                    	      GROUP BY a.user) a
                                                    	      LEFT JOIN
                                                    	      (SELECT a.user AS USER, COUNT(*) AS ".$UMajor." FROM users a
                                                    	      RIGHT JOIN tickets b ON a.user=b.assigned_to
                                                    	      WHERE a.groups='".$team."'
                                                    	      AND severity='".$UMajor."'
                                                    	      GROUP BY a.user) b ON a.user=b.user
                                                    	      LEFT JOIN
                                                    	      (SELECT a.user AS USER, COUNT(*) AS ".$UMinor." FROM users a
                                                    	      RIGHT JOIN tickets b ON a.user=b.assigned_to
                                                    	      WHERE a.groups='".$team."'
                                                    	      AND severity='".$UMinor."'
                                                    	      GROUP BY a.user) c ON a.user=c.user
                                                    	      LEFT JOIN
                                                    	      (SELECT a.user AS USER, COUNT(*) AS ".$UBlock." FROM users a
                                                    	      RIGHT JOIN tickets b ON a.user=b.assigned_to
                                                    	      WHERE a.groups='".$team."'
                                                    	      AND severity='".$UBlock."'
                                                    	      GROUP BY a.user) d ON a.user=d.user
                                                    	      LEFT JOIN
                                                    	      (SELECT a.user AS USER, COUNT(*) AS ".$UCrash." FROM users a
                                                    	      RIGHT JOIN tickets b ON a.user=b.assigned_to
                                                    	      WHERE a.groups='".$team."'
                                                    	      AND severity='".$UCrash."'
                                                    	      GROUP BY a.user) e ON a.user=e.user
                                                    	      LEFT JOIN
                                                    	      (SELECT a.user AS USER, COUNT(*) AS ".$UUrgent." FROM users a
                                                    	      RIGHT JOIN tickets b ON a.user=b.assigned_to
                                                    	      WHERE a.groups='".$team."'
                                                    	      AND severity='".$UUrgent."'
                                                    	      GROUP BY a.user) f ON a.user=f.user
                                                    	      LEFT JOIN
                                                    	      (SELECT a.user AS USER, COUNT(*) AS ".$UHigh." FROM users a
                                                    	      RIGHT JOIN tickets b ON a.user=b.assigned_to
                                                    	      WHERE a.groups='".$team."'
                                                    	      AND severity='".$UHigh."'
                                                    	      GROUP BY a.user) g ON a.user=g.user
                                                    	      LEFT JOIN
                                                    	      (SELECT a.user AS USER, COUNT(*) AS ".$UTrivial." FROM users a
                                                    	      RIGHT JOIN tickets b ON a.user=b.assigned_to
                                                    	      WHERE a.groups='".$team."'
                                                    	      AND severity='".$UTrivial."'
                                                    	      GROUP BY a.user) h ON a.user=h.user
                                                    	      LEFT JOIN
                                                    	      (SELECT a.user AS USER, COUNT(*) AS ".$UTweak." FROM users a
                                                    	      RIGHT JOIN tickets b ON a.user=b.assigned_to
                                                    	      WHERE a.groups='".$team."'
                                                    	      AND severity='".$UTweak."'
                                                    	      GROUP BY a.user) i ON a.user=i.user
                                                    	      LEFT JOIN
                                                    	      (SELECT a.user AS USER, COUNT(*) AS ".$UNormal." FROM users a
                                                    	      RIGHT JOIN tickets b ON a.user=b.assigned_to
                                                    	      WHERE a.groups='".$team."'
                                                    	      AND severity='".$UNormal."'
                                                    	      GROUP BY a.user) l ON a.user=l.user");
                    $row = $result->fetch_row();

                    while ( $row != null ) {
                    ?>
                    <tr>
                        <td><a href="index.php?p=view&perimeter=User&user=<?php echo $row[0]; ?>"><?php echo $row[0]; ?></a></td>
                        <td><?php echo $row[1]; ?></td>
                        <td><?php echo $row[2]; ?></td>
                        <td><?php echo $row[3]; ?></td>
                        <td><?php echo $row[4]; ?></td>
                        <td><?php echo $row[5]; ?></td>
                        <td><?php echo $row[6]; ?></td>
                        <td><?php echo $row[7]; ?></td>
                        <td><?php echo $row[8]; ?></td>
                        <td><?php echo $row[9]; ?></td>
                        <td><?php echo $row[10]; ?></td>
                    </tr>
                    <?php
                        $row = $result->fetch_row();
                        }
                    ?>


                    <?php


                        $firstRow="SELECT a.GROUPS,".$firstRow." FROM ";
                        $totTicketsByType="(SELECT groups AS GROUPS, COUNT(*) AS TOTAL FROM users a RIGHT JOIN tickets b ON a.user=b.assigned_to ".$filterByType."GROUP BY groups) a";
                        $ultimateQuery=$firstRow.$totTicketsByType.$macroQuery;
                        //echo $ultimateQuery;
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