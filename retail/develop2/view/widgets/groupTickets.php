<div class="table-responsive col-lg-12 col-md-6">
        <table id="dtTable" class="table table-striped table-bordered table-sm">
            <thead>
                <tr>
                    <th class="th-sm">ID</th>
                    <th class="th-sm">Environment</th>
                    <th class="th-sm" style="width: 850px !important;">Summary</th>
                    <th class="th-sm">Severity</th>
                    <th class="th-sm">Status    </th>
                    <th class="th-sm">Prod Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $stringQuery="SELECT id,a.environment,summary,severity, prod_date, startDate, endDate FROM tickets a LEFT JOIN users b ON a.assigned_to=b.user LEFT JOIN cab c ON a.id=c.source_id LEFT JOIN work_period d ON c.rfc=d.rfc ".str_replace("environment", "a.environment", $filterByType)." groups='".$team."' AND a.".substr($exclude_closed, 1);
                    $result = $mysqli->query($stringQuery);


                    $_SESSION['stringQuery'] = $stringQuery;
                    //echo $stringQuery;
                    $row = $result->fetch_row();

                    while ( $row != null ) {
                    ?>
                    <tr>
                        <td><a href=
                            <?php
                            if ($row[1]==$bugtracker)
                                echo $btUrl;
                            else
                                echo $mantisUrl;
                             ?>view.php?id=<?php echo $row[0]; ?> target="_blank"><?php echo $row[0]; ?></a></td>
                        <td><?php echo $row[1]; ?></td>
                        <td><?php echo htmlentities($row[2]); ?></td>
                        <td><?php echo $row[3]; ?></td>
                        <td>
                        <?php
                            if ($row[5]>'1970-01-01')
                                echo "<a href='#' data-toggle='tooltip' title='Scheduled for ".$row[5]." - ".$row[6]."' > Planned </a>";
                            else
                                echo "To be fixed"
                        ?>
                        </td>


                        <td>
                        <?php
                            if ($row[4]>'1970-01-01')
                                echo $row[4];
                            ?>
                        </td>
                    </tr>
                    <?php
                        $row = $result->fetch_row();
                        }
                    ?>
            </tbody>
        </table>
 </div>