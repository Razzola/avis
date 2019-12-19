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
            <div class="text-center">

                <button class="btn btn-primary hidden-print" onclick="javascript:history.back()"><span class="glyphicon glyphicon-step-backward" aria-hidden="true"></span> Back</button>
                <a class="btn btn-primary" href="export/excel.php" role="button"><span class="glyphicon glyphicon-th" aria-hidden="true"></span> Export to excel</a>
                <a class="btn btn-primary" href='index.php?p=gantt<?php echo '&team='.$team;?>' role="button"><span class="glyphicon glyphicon-signal" aria-hidden="true"></span> Go to gantt</a>
            </div>
            <br/>
                <?php
                $envFilter='';
                if($type!='All'){
                    $envFilter="AND environment ='".$type."'";
                }

                if  (!isset($perimeter)){
                    include "view/widgets/groupCounter.php";
                }elseif($perimeter=='Group'){
                    include "view/widgets/groupTeamCounter.php";
                    include "view/widgets/groupTickets.php";
                }elseif($perimeter=='User'){
                    include "view/widgets/userTickets.php";
                }

                ?>

            <div class="text-center">
                <button class="btn btn-primary hidden-print" onclick="javascript:history.back()"><span class="glyphicon glyphicon-step-backward" aria-hidden="true"></span> Back</button>
            </div>

         </div>

        </div>
    </div>
</div>