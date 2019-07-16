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
    $filterByType= "WHERE  environment='".$type."'";
}else{
    $filterByType="";
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

    <title>FCA PM</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>
    
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
                <a class="navbar-brand" href="index.php">Beerecipe</a>
            </div>
            <!-- Top Menu Items -->
            
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                    	<a href="javascript:;" data-toggle="collapse" data-target="#cat">
                            <i class="fa fa-fw fa-folder"></i>
                            Category
                            <i class="fa fa-fw fa-caret-down"></i>
                        </a>
                        <ul id="cat" class="collapse">
                            <li>
                                <a href="index.php?p=create&type=cat"><i class="fa fa-fw fa-plus"></i>Create</a>
                            </li>
                            <li>
                                <a href="index.php?p=view&type=cat"><i class="fa fa-fw fa-eye"></i>View</a>
                            </li>
                        </ul>
                        <a href="javascript:;" data-toggle="collapse" data-target="#ing">
                            <i class="fa fa-fw fa-leaf"></i>
                            Ingredients
                            <i class="fa fa-fw fa-caret-down"></i>
                        </a>
                        <ul id="ing" class="collapse">
                            <li>
                                <a href="index.php?p=create&type=ing"><i class="fa fa-fw fa-plus"></i>Create</a>
                            </li>
                            <li>
                                <a href="index.php?p=view&type=ing"><i class="fa fa-fw fa-eye"></i>View</a>
                            </li>
                        </ul>
                        <a href="javascript:;" data-toggle="collapse" data-target="#prd">
                            <i class="fa fa-fw fa-shopping-cart"></i>
                            Products
                            <i class="fa fa-fw fa-caret-down"></i>
                        </a>
                        <ul id="prd" class="collapse">
                            <li>
                                <a href="index.php?p=create&type=prd"><i class="fa fa-fw fa-plus"></i>Create</a>
                            </li>
                            <li>
                                <a href="index.php?p=view&type=prd"><i class="fa fa-fw fa-eye"></i>View</a>
                            </li>
                        </ul>
                        <a href="javascript:;" data-toggle="collapse" data-target="#rec">
                            <i class="fa fa-fw fa-book"></i>
                            Recipe
                            <i class="fa fa-fw fa-caret-down"></i>
                        </a>
                        <ul id="rec" class="collapse">
                            <li>
                                <a href="index.php?p=create&type=rec"><i class="fa fa-fw fa-plus"></i>Create</a>
                            </li>
                            <li>
                                <a href="index.php?p=view&type=rec"><i class="fa fa-fw fa-eye"></i>View</a>
                            </li>
                        </ul>
                        <a href="javascript:;" data-toggle="collapse" data-target="#wh">
                            <i class="fa fa-fw fa-archive"></i>
                            Warehouse
                            <i class="fa fa-fw fa-caret-down"></i>
                        </a>
                        <ul id="wh" class="collapse">
                            <li>
                                <a href="index.php?p=view&type=wh"><i class="fa fa-fw fa-eye"></i>View</a>
                            </li>
                        </ul>
                        <a href="javascript:;" data-toggle="collapse" data-target="#ca">
                            <i class="fa fa-fw fa-calculator"></i>
                            Calculate
                            <i class="fa fa-fw fa-caret-down"></i>
                        </a>
                        <ul id="ca" class="collapse">
                            <li>
                                <a href="index.php?p=calculator"><i class="fa fa-fw fa-magic"></i>AAU vs weight</a>
                            </li>
                        </ul>
                        
                        <a href="javascript:;" data-toggle="collapse" data-target="#diary">
                            <i class="fa fa-calendar-o"></i>
                            Diary
                            <i class="fa fa-fw fa-caret-down"></i>
                        </a>
                        <ul id="diary" class="collapse">
                            <li>
                                <a href="index.php?p=create&type=di"><i class="fa fa-fw fa-plus"></i>Create</a>
                            </li>
                            <li>
                                <a href="index.php?p=view&type=di"><i class="fa fa-fw fa-eye"></i>View</a>
                            </li>
                        </ul>
                    </li>
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

	$mysqli->close();

</body>

</html>
