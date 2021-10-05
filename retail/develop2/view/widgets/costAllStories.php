<?php
     $story_id=null;
     if (isset($_GET["story"]))
        $story_id=$_GET["story"];
     //Amount
     $amount=0;
     if ($story_id!=null)
        $amount=amountPerStory($story_id);
?>

<div class="table-responsive col-lg-12 col-md-6">

        <table id="dtTable" class="table table-striped table-bordered table-sm">
            <thead>
                <tr>
                    <th class="th-sm">ID</th>
                    <th class="th-sm" style="width: 850px !important;">Summary</th>
                    <th class="th-sm">Cost est.</th>
                    <th class="th-sm">Cost</th>
                    <th class="th-sm">Delta</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $stringQuery="SELECT a.id, a.summary, SUM(cost*b.effort), SUM(cost*d.effective)
                                  FROM tickets a
                                  LEFT JOIN tasks b ON a.id=b.story_id
                                  LEFT JOIN users c ON b.assigned_to=c.uid
                                  LEFT JOIN cab d on d.task_id=b.id
                                  GROUP BY a.id";
                    $result = $mysqli->query($stringQuery);
                    //echo $stringQuery;
                    $row = $result->fetch_row();

                    while ( $row != null ) {
                    ?>
                    <tr>
                        <td><a href=
                            <?php
                                echo $icescrumUrl.$row[0];
                            ?> target="_blank"><?php echo $row[0]; ?></a></td>
                        <td><?php echo htmlentities($row[1]); ?></td>
                        <td><?php echo $row[2]; ?></td>
                        <td><?php echo $row[3]; ?></td>
                        <td
                            <?php
                                if($row[3]>$row[2] && $row[3]>0)
                                    echo "class='negative'";
                                elseif ($row[3]<$row[2] && $row[3]>0)
                                    echo "class='positive'";
                            ?>
                        ><?php echo $row[2]-$row[3]; ?></td>
                    </tr>
                    <?php
                        $row = $result->fetch_row();
                        }
                    ?>
            </tbody>
        </table>

 </div>

