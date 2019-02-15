<table class="table table-bordered table-hover table-striped">
    <thead>
        <tr>
            <th>Group</th>
            <th>Opened tickets</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $mysqli = new mysqli("localhost", "root", "", "fca_pm");
            $result = $mysqli->query("SELECT groups, COUNT(*) FROM users a
                                      INNER JOIN tickets b ON a.user=b.assigned_to
                                      WHERE environment = 'Mantis'
                                      GROUP BY groups");
            $row = $result->fetch_row();

            while ( $row != null ) {
            ?>
            <tr>
                <td><?php echo $row[0]; ?></td>
            <td><?php echo $row[1]; ?></td>
            <td>
                <a href="index.php?p=update&uid=<?php echo $row[0]; ?>&type=<?php echo $type; ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                </td>
            </tr>
            <?php
                $row = $result->fetch_row();
                }
            ?>
    </tbody>
</table>