<div class="table-responsive col-lg-4 col-md-6">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $mysqli = new mysqli("localhost", "root", "", "fca_pm");
                    $stringQuery="SELECT id FROM tickets WHERE assigned_to='".$user."'";
                    echo $stringQuery;
                    $result = $mysqli->query("SELECT id FROM tickets WHERE assigned_to='".$user."'");
                    $row = $result->fetch_row();

                    while ( $row != null ) {
                    ?>
                    <tr>
                        <td><a href="https://triplesensereply.mantishub.io/view.php?id=<?php echo $row[0]; ?>" target="_blank"><?php echo $row[0]; ?></td>
                    </tr>
                    <?php
                        $row = $result->fetch_row();
                        }
                    ?>
            </tbody>
        </table>
 </div>