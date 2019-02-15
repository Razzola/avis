<?php

    $type = "";
    if ( isset($_GET['type']) ) {
        $type = $_GET['type'];


        switch ($type) {
            case 'Mantis':
                $name = 'Mantis';
                break;
            case 'BT':
                $name = 'BugTracker';
                break;
            case 'Total':
                $name= 'Total';
                break;
        }
    }

?>

<div class="col-lg-12">
    <div class="panel panel-default">
    <br/>
        <div class="panel-body">
        <!--div class="text-right">
             <a href="index.php?p=create&type=<?php echo $type;?>">Insert new <?php echo $name;?> 
               <i class="fa fa-arrow-circle-right"></i></a>
         </div--!>
        <br/>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Group</th>
                            <th>Opened tickets</th>
                        </tr>
                    </thead>
                        <?php include "/view/widgets/groupMantisCounter.php";?>
                    </tbody>
                </table>
            </div>
            <!--div class="text-right">
                <a href="index.php?p=create&type=<?php echo $type;?>">Insert new <?php echo $name;?>
                  <i class="fa fa-arrow-circle-right"></i></a>
            </div--!>
        </div>
    </div>
</div>
    <!-- Custom JavaScript -->
    <script src="js/custom.js"></script>