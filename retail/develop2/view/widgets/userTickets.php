<div class="table-responsive col-lg-6 col-md-6">
        <table id="dtTable" class="table table-striped table-bordered table-sm">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Environment</th>
                    <th>Summary</th>
                    <th>Reporter</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $stringQuery="SELECT id,environment,summary,reporter FROM tickets ".$filterByType."AND assigned_to='".$user."' AND ".$exclude_closed;
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
                    </tr>
                    <?php
                        $row = $result->fetch_row();
                        }
                    ?>
            </tbody>
        </table>

 </div>