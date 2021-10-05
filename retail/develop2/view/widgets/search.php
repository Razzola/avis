<div class="table-responsive col-lg-12 col-md-6">
        <table id="dtTable" class="table table-striped table-bordered table-sm">
            <thead>
                <tr>
                    <th class="th-sm">Story ID</th>
                    <th class="th-sm">Task ID</th>
                    <th class="th-sm" style="width: 550px !important;">Story desc</th>
                    <th class="th-sm" style="width: 550px !important;">Task Desc</th>
                    <th class="th-sm">Effort</th>
                    <th class="th-sm">Effective</th>
                    <th class="th-sm">Sprint</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $stringQuery="SELECT a.id,b.id,a.summary, b.summary, order_number, start_date, end_date, a.environment, b.effort, d.effective
                                  FROM tickets a
                                  RIGHT JOIN tasks b ON a.id=b.story_id
                                  RIGHT JOIN cab d ON d.task_id=b.id
                                  JOIN sprint c ON b.sprint_id=c.id
                                  ORDER by b.id ASC";
                    $result = $GLOBALS['mysqli']->query($stringQuery);
                    $row = $result->fetch_row();

                    while ( $row != null ) {
                    ?>
                    <tr>
                        <td><a href=
                            <?php
                            if ($row[7]==$bugtracker)
                                echo $btUrl;
                            else if ($row[7]==$mantis)
                                echo $mantisUrl;
                            else if ($row[7]==$icescrum)
                                echo $icescrumUrl;
                            echo $row[0]; ?> target="_blank"><?php echo $row[0]; ?></a></td>
                        <td><a href=<?php  echo $icescrumUrl."T".$row[1];?> target="_blank"><?php echo $row[1]; ?></a></td>
                        <td><?php echo $row[2]; ?></td>
                        <td><?php echo htmlentities($row[3]); ?></td>
                        <td><?php echo $row[8]; ?></td>
                        <td
                            <?php
                                if($row[9]>$row[8] && $row[9]>0)
                                    echo "class='negative'";
                                elseif ($row[9]<$row[8] && $row[9]>0)
                                    echo "class='positive'";
                            ?>>
                            <?php echo $row[9]; ?>
                        </td>
                        <td>
                        <?php
                            if ($row[5]>'1970-01-01')
                                echo "<a href='#' data-toggle='tooltip' title='Scheduled for ".$row[5]." / ".$row[6]."' > Planned </a>";
                            else
                                echo "To be fixed"
                        ?>
                        </td>
                    </tr>
                    <?php
                        $row = $result->fetch_row();
                        }
                    ?>
            </tbody>
        </table>
        <a href="/avis/retail/develop2/export/cabEnricher.php">Cab Enricher</a><br/>
        <a href="/avis/retail/develop2/export/cabDiscrepancy.php">Cab Discrepancy</a>
 </div>