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
$mysqli = new mysqli("localhost", "root", "", "fca_pm");

if($type!='All'){
    $filterByType= "WHERE  environment='".$type."' AND";
}else{
    $filterByType="WHERE";
}
$root="C:/xampp/htdocs/beerecipe/retail/develop2";
$exclude_closed=" STATUS NOT IN ('resolved','closed')";

include "dictionary/all.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FCA</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="css/dataTables.css" rel="stylesheet">
    <link href="css/bootstrap-datepicker.standalone.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" type="image/png" href="/fca_pm/retail/develop2/favicon.png"/>

    <!-- Latest compiled SELECT and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

    <!-- Gantt files -->
    <link rel="stylesheet" href="http://taitems.github.com/UX-Lab/core/css/prettify.css" />
    <link rel="stylesheet" href="css/gantt.css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- jQuery -->

<script src="//code.jquery.com/jquery-3.1.1.min.js" ></script>
<script src="js/bootstrap-datepicker.min.js"></script>

<!-- Latest compiled SELECT and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>


    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    
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
                <a class="navbar-brand" href="index.php">FCA Utilities</a>
            </div>
            <!-- Top Menu Items -->
            
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>

                        <a href="javascript:;" data-toggle="collapse" data-target="#Discrepancy">
                            <i class="fa fa-fw fa-plus"></i>
                           Tools
                            <i class="fa fa-fw fa-caret-down"></i>
                        </a>
                        <ul id="Discrepancy" class="collapse">
                            <li>
                                <a href="index.php?p=discrepancy"><i class="fa fa-fw fa-exchange"></i>TKT Discrepancy</a>
                            </li>
                            <li>
                                <a href="index.php?p=urls"><i class="fa fa-fw fa-link"></i>URLs</a>
                            </li>
                            <li>
                                <a href="index.php?p=search"><i class="fa fa-fw fa-search"></i>Search</a>
                            </li>
                            <li>
                                <a href="index.php?p=work-setup"><i class="fa fa-fw fa-desktop"></i>Work setup</a>
                            </li>
                        </ul>
                        <?php
                            $groups= $mysqli->query("SELECT groups FROM users RIGHT JOIN tickets ON users.user=tickets.assigned_to WHERE ".$exclude_closed." GROUP BY groups");
                            //echo "SELECT groups FROM users RIGHT JOIN tickets ON users.user=tickets.assigned_to WHERE ".$exclude_closed." GROUP BY groups";
                            $group = $groups->fetch_row();
                            while ( $group  != null ) {
                            ?>
                                <a href="javascript:;" data-toggle="collapse" data-target="#<?php echo $group[0]?>">
                                    <i class="fa fa-fw fa-folder"></i>
                                    <?php echo $group[0]?>
                                    <i class="fa fa-fw fa-caret-down"></i>
                                </a>
                                <ul id="<?php echo $group[0]?>" class="collapse">
                                    <li>
                                        <a href="index.php?p=view&amp;type=<?php echo $all?>&amp;team=<?php echo $group[0]?>&amp;perimeter=Group"><i class="fa fa-fw fa-eye"></i><?php echo $all?></a>
                                    </li>
                                    <li>
                                        <a href="index.php?p=view&amp;type=<?php echo $mantis?>&amp;team=<?php echo $group[0]?>&amp;perimeter=Group"><i class="fa fa-fw fa-eye"></i><?php echo $mantis?></a>
                                    </li>
                                    <li>
                                        <a href="index.php?p=view&amp;type=<?php echo $bugtracker?>&amp;team=<?php echo $group[0]?>&amp;perimeter=Group"><i class="fa fa-fw fa-eye"></i><?php echo $bugtracker?></a>
                                    </li>
                                </ul>
                         <?php
                            $group = $groups->fetch_row();
                            }
                        ?>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Dashboard <small><?php echo $name;?></small>
                        </h1>
                    </div>
                </div>

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

<!-- Gantt JS-->
<script src="js/gantt/jquery.fn.gantt.js"></script>
<script src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
<script src="http://taitems.github.com/UX-Lab/core/js/prettify.js"></script>

<?php
	$mysqli->close();
?>

</body>

</html>
