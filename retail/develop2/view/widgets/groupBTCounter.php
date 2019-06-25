<div class="table-responsive col-lg-4 col-md-6">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Group</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $mysqli = new mysqli("localhost", "root", "", "fca_pm");
                    $result = $mysqli->query("SELECT groups, COUNT(*) FROM users a
                                              INNER JOIN tickets b ON a.user=b.assigned_to
                                              WHERE environment = 'BugTracker'
                                              GROUP BY groups");
                    $row = $result->fetch_row();

                    while ( $row != null ) {
                    ?>
                    <tr>
                        <td><a href="index.php?p=view&type=<?php echo $type;?>&team=<?php echo $row[0]; ?>&perimeter=Group"><?php echo $row[0];?> </a></td>
                    <td><?php echo $row[1]; ?></td>
                    </tr>
                    <?php
                        $row = $result->fetch_row();
                        }
                    ?>
            </tbody>
        </table>
 </div>