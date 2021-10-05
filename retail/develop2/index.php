<?php 
$type = "";
$name="general";
if ( isset($_GET['type']) ) {
	$type = $_GET['type'];
	switch ($type) {
		case 'prd':
			$name = 'products';
			break;
		case 'rec':
			$name = 'recipes';
			break;
		case 'ing':
			$name= 'ingredients';
			break;
		case 'cat':
			$name= 'category';
			break;
		case 'wh':
			$name = 'warehouse';
	}
	
}
include "utils/dbConnect.php";
include "utils/amountPerStory.php";
include "utils/amountValueEffortPerSprint.php";
include "utils/sprintUtilities.php";

if($type!='All'){
    $filterByType= "WHERE  environment='".$type."' AND";
}else{
    $filterByType="WHERE";
}
$exclude_closed=" STATUS NOT IN ('resolved','closed')";

//All includes of inner code
include "dictionary/all.php";


//Session variables
if(!session_id()) session_start();
$stringQuery = '';



?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>AVIS</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="css/dataTables.css" rel="stylesheet">
    <link href="css/bootstrap-datepicker.standalone.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/custom.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" type="image/png" href="/fca_pm/retail/develop2/favicon.png"/>

    <!-- Latest compiled SELECT and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

    <!-- Gantt files -->
    <link rel="stylesheet" href="http://taitems.github.com/UX-Lab/core/css/prettify.css" />
    <link rel="stylesheet" href="css/gantt.css" />
    <link rel="stylesheet" href="css/print.css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</head>

<body>

    <!-- jQuery -->

<script src="//code.jquery.com/jquery-3.1.1.min.js" ></script>
<script src="js/bootstrap-datepicker.min.js"></script>

<!-- Latest compiled SELECT and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>


<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<script>
function export_to_excel() {
    window.location.assign(window.location.href+"&export_to_excel=true")
}

function exportExcel()
{
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", "export/excel.php", false ); // false for synchronous request
    xmlHttp.send( null );
    return xmlHttp.responseText;
}
</script>

    
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><?php echo $Project;?> Utilities</a>
            </div>
            <!-- Top Menu Items -->
            
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>

                                <!--a href="index.php?p=discrepancy"><i class="fa fa-fw fa-exchange"></i> TKT Discrepancy</a-->

                                <a href="index.php?p=urls"><i class="fa fa-fw fa-link"></i> URLs</a>

                                <a href="index.php?p=search"><i class="fa fa-fw fa-search"></i> Search</a>

                                <a href="index.php?p=work-setup"><i class="fa fa-fw fa-desktop"></i> Work setup</a>

                                <a href="index.php?p=inner-release-note"><i class="fa fa-fw fa-space-shuttle"></i> Internal release notes</a>

                                <a href="index.php?p=cost-management"><i class="fa fa-fw fa-dollar"></i>Story Costs</a>
                                <a href="index.php?p=cost-management-sprint"><i class="fa fa-fw fa-dollar"></i>Sprint Costs</a>
                                <a href="index.php?p=sprint-monitoring"><i class="fa fa-fw fa-dashboard"></i>Sprint Monitoring</a>



                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">


                <?php
	                $page = "home";
	                if ( isset($_GET['p']) ) {
	                	$page = $_GET['p'];
	                }
	                if (is_file($page . '.php')) {
	                	require $page . '.php';
	                } else {
	                	require "home.php";
	            	}
                ?>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.13/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>

<!-- Custom JS -->
<script src="js/custom.js"></script>
<script src="js/dataTables.js" defer></script>
<script src="js/moment.js"></script>
<script src="js/mandays-utils.js"></script>
<script src="js/datePicker.js" defer></script>
<script src="js/tooltip.js" ></script>
<script src="js/print.js" ></script>

<?php

	$mysqli->close();
?>

</body>

</html>
