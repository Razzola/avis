<div class="table-responsive col-lg-12 col-md-6">
        <table id="dtTable" class="table table-striped table-bordered table-sm">
            <thead>
                <tr>
                    <th class="th-sm">ID</th>
                    <th class="th-sm">RFC</th>
                    <th class="th-sm">Environment</th>
                    <th class="th-sm">Source ID</th>
                    <th class="th-sm">Due date</th>
                    <th class="th-sm">Prod Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $stringQuery="SELECT id,rfc,b.environment,source_id,due_date,prod_date FROM tickets a RIGHT JOIN cab b ON a.id=b.source_id WHERE due_date!=prod_date";
                    $result = $mysqli->query($stringQuery);
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
                        <td><?php echo $row[2]; ?></td>
                        <td><?php echo $row[3]; ?></td>
                        <td><?php echo $row[4]; ?></td>
                        <td><?php echo $row[5]; ?></td>
                    </tr>
                    <?php
                        $row = $result->fetch_row();
                        }
                    ?>
            </tbody>
        </table>

 </div>