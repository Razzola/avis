<div class="table-responsive col-lg-12 col-md-6">
        <table id="dtTable" class="table table-striped table-bordered table-sm">
            <thead>
                <tr>
                    <th class="th-sm">ID</th>
                    <th class="th-sm">RFC</th>
                    <th class="th-sm">Environment</th>
                    <th class="th-sm" style="width: 850px !important;">Description</th>
                    <th class="th-sm">Status</th>
                    <th class="th-sm">Prod Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $stringQuery="SELECT id,b.rfc,b.environment,description,prod_date, startDate, endDate FROM tickets a RIGHT JOIN cab b ON a.id=b.source_id LEFT JOIN work_period c ON b.rfc=c.rfc";
                    $result = $mysqli->query($stringQuery);
                    $row = $result->fetch_row();

                    while ( $row != null ) {
                    ?>
                    <tr>
                        <td><a href=
                            <?php
                            if ($row[2]==$bugtracker)
                                echo $btUrl;
                            else
                                echo $mantisUrl;
                             ?>view.php?id=<?php echo $row[0]; ?> target="_blank"><?php echo $row[0]; ?></a></td>
                        <td><?php echo $row[1]; ?></td>
                        <td><?php echo $row[2]; ?></td>
                        <td><?php echo htmlentities($row[3]); ?></td>
                        <td>
                        <?php
                            if ($row[5]>'1970-01-01')
                                echo "<a href='#' data-toggle='tooltip' title='Scheduled for ".$row[5]." / ".$row[6]."' > Planned </a>";
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