<div class="table-responsive col-lg-12 col-md-6">

        <table id="dtTable" class="table table-striped table-bordered table-sm">
            <thead>
                <tr>
                    <th class="th-sm">ID</th>
                    <th class="th-sm">Sprint</th>
                    <th class="th-sm">Cost est.</th>
                    <th class="th-sm">Cost</th>
                    <th class="th-sm">Delta</th>
                    <th class="th-sm">Effort</th>
                    <th class="th-sm">Effective</th>
                    <th class="th-sm">Value</th>
                    <th class="th-sm">Start date</th>
                    <th class="th-sm">End date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $stringQuery="SELECT id, order_number, start_date, end_date FROM sprint";
                    $result = $GLOBALS['mysqli']->query($stringQuery);
                    //echo $stringQuery;
                    $row = $result->fetch_row();

                    while ( $row != null ) {
                        $ave_sprint=amountValueEffortPerSprint($row[0]);
                    ?>
                    <tr>
                        <td><a href=
                            <?php
                                echo $icescrumSprintUrl.$row[0]."/details";
                            ?> target="_blank"><?php echo $row[0]; ?></a></td>
                        <td><?php echo htmlentities("Sprint ".$row[1]); ?></td>
                        <td><?php echo $ave_sprint[0]; ?></td>
                        <td><?php echo $ave_sprint[4]; ?></td>
                        <td
                            <?php
                                if($ave_sprint[4]>$ave_sprint[0] && $ave_sprint[4]>0)
                                    echo "class='negative'";
                                elseif ($ave_sprint[4]<$ave_sprint[0] && $ave_sprint[4]>0)
                                    echo "class='positive'";
                            ?>
                        ><?php echo $ave_sprint[0]-$ave_sprint[4]; ?></td>
                        <td><?php echo $ave_sprint[1]; ?></td>
                        <td><?php echo $ave_sprint[3]; ?></td>
                        <td><?php echo $ave_sprint[2]; ?></td>
                        <td><?php echo $row[2]; ?></td>
                        <td><?php echo $row[3]; ?></td>
                    </tr>
                    <?php
                        $row = $result->fetch_row();
                        }
                    ?>
            </tbody>
        </table>

 </div>

