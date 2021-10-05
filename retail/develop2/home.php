<?php
    include "dictionary/all.php";


	$result = $GLOBALS['mysqli']->query("SELECT COUNT(*) FROM `cab` WHERE environment='IceScrum'");
	$ticketsCount = $result->fetch_row();
	$ticketsICTotal = $ticketsCount[0];

	$result = $GLOBALS['mysqli']->query("SELECT COUNT(*) FROM `cab` WHERE environment!='IceScrum'");
	$ticketsCount = $result->fetch_row();
	$ticketsNICTotal = $ticketsCount[0];
?>

<div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-database fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $ticketsICTotal; ?></div>
                        <div>IceScrum</div>
                    </div>
                </div>
            </div>
            <a href="index.php?p=view&type=<?php echo $mantis;?>">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-database fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $ticketsNICTotal; ?></div>
                        <div>Others</div>
                    </div>
                </div>
            </div>
            <a href="index.php?p=view&type=<?php echo $bugtracker;?>">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-dashboard fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo ""; ?></div>
                        <div>Go to</div>
                    </div>
                </div>
            </div>
            <a href="index.php?p=sprint-monitoring">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <!-- form class="col-lg-3 col-md-6" action="" method="post" name="uploadCSV"
        enctype="multipart/form-data">
        <div class="input-row">
            <h4>Choose Mantis CSV</h4>
            <input
                type="file" name="fileMantis" id="fileMantis" accept=".csv">
            <button type="submit" id="submit" name="importMantis"
                class="btn btn-primary">Import</button>
            <br />

        </div>
        <div id="labelError"></div>
    </form -->

    <!-- form class="col-lg-3 col-md-6" action="" method="post" name="uploadCSV"
        enctype="multipart/form-data">
        <div class="input-row">
            <h4>Choose BT CSV</h4>
            <input
                type="file" name="fileBT" id="fileBT" accept=".csv">
            <button type="submit" id="submit" name="importBT"
                class="btn btn-primary">Import</button>
            <br />

        </div>
        <div id="labelError"></div>
    </form -->

    <form class="col-lg-3 col-md-6" action="" method="post" name="uploadXML"
        enctype="multipart/form-data">
        <div class="input-row">
            <h4>Choose IS XML</h4>
            <input
                type="file" name="fileIS" id="fileIS" accept=".xml">
            <button type="submit" id="submit" name="importIS"
                class="btn btn-primary">Import</button>
            <br />

        </div>
        <div id="labelError"></div>
    </form>

    <form class="col-lg-3 col-md-6" action="" method="post" name="uploadCSV"
        enctype="multipart/form-data">
        <div class="input-row">
            <h4>Choose CAB CSV</h4>
            <input
                type="file" name="fileCAB" id="fileCAB" accept=".csv">
            <button type="submit" id="submit" name="importCAB"
                class="btn btn-primary">Import</button>
            <br />

        </div>
        <div id="labelError"></div>
    </form>

    <?php

        include "utils/importMantis.php";
        include "utils/importBugTracker.php";
        include "utils/importCAB.php";
        include "utils/importIceScrum.php";
    ?>
</div>
