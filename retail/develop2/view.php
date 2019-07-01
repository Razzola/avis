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
            case 'All':
                $name= 'All';
                break;

            case 'Team':
                $name = 'Team';
                break;
        }
    }
    if ( isset($_GET['team']) ) {
            $team = $_GET['team'];
     }else{
            $team = null;
    }

    if ( isset($_GET['user']) ) {
            $user = $_GET['user'];
     }else{
            $user = null;
    }

    if ( isset($_GET['perimeter']) ) {
            $perimeter = $_GET['perimeter'];
     }else{
            $perimeter = null;
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
        <h3>OVERALL</h3>
                <?php
                $envFilter='';
                if($type!='All'){
                    $envFilter="AND environment ='".$type."'";
                }
                if  (!isset($perimeter)){
                    include "view/widgets/groupCounter.php";
                }elseif($perimeter=='Group'){
                    include "view/widgets/groupTeamCounter.php";
                }elseif($perimeter=='User'){
                    include "view/widgets/userTickets.php";
                }

                ?>
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