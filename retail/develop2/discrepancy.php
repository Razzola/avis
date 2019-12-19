<?php

?>
<div class="col-lg-12">
    <div class="panel panel-default">
    <br/>
        <div class="panel-body">
        <!--div class="text-right">
             <a href="index.php?p=create&type=<?php echo $type;?>">Insert new <?php echo $name;?>
               <i class="fa fa-arrow-circle-right"></i></a>
        </div--!>

            <h3>Discrepancy</h3>
            <div class="text-center">
                <button class="btn btn-primary hidden-print" onclick="javascript:history.back()"><span class="glyphicon glyphicon-step-backward" aria-hidden="true"></span> Back</button>
            </div>
            <br/>
                <?php
                    include "view/widgets/ticketsCab.php";

                ?>

            <div class="text-center">
               <button class="btn btn-primary hidden-print" onclick="javascript:history.back()"><span class="glyphicon glyphicon-step-backward" aria-hidden="true"></span> Back</button>
            </div>

         </div>

        </div>
    </div>
</div>
