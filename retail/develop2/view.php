<?php

$type = "";
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
		case 'wh':
			$name= 'product';
			break;
	}
}

?>

<div class="col-lg-12">
    <div class="panel panel-default">
    <br/>
        <div class="panel-body">
        <div class="text-right">
             <a href="index.php?p=create&type=<?php echo $type;?>">Insert new <?php echo $name;?> 
               <i class="fa fa-arrow-circle-right"></i></a>
         </div>
         <br/>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <?php
                            if ( $type == 'ing' ) {
                            ?>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Action</th>
                            <?php
                            }
                            ?>
                            
                            <?php
                            if ( $type == 'prd' ) {
                            ?>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Reference</th>
                            <th>Action</th>
                            <?php
                            }
                            ?>
                            
                            
                            <?php
                            if ( $type == 'rec' ) {
                            ?>
                            <th>Name</th>
                            <th width="500px">Description</th>
                            <th>Amount</th>
                            <th>Category</th>
                            <th width="400px">Upload Image</th>
                            <th>Actions</th>
                            <?php
                            }
                            ?>
                            
                            <?php
                            if ( $type == 'cat' ) {
                            ?>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Action</th>
                            <?php
                            }
                            ?>
                            
                            
                            <?php
                            if ( $type == 'wh' ) {
                            ?>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Position</th>
                            <th>Action</th>
                            <?php
                            }
                            ?>
                            
                        </tr>
                    </thead>
                    <tbody>
            	<?php include "view/category.php";?>
            	<?php include "view/ingredients.php";?>
            	<?php include "view/products.php";?>
            	<?php include "view/warehouse.php";?>
            	<?php include "view/recipe.php";?>
            	<?php include "view/diary.php";?>
                    </tbody>
                </table>
            </div>
            <div class="text-right">
                <a href="index.php?p=create&type=<?php echo $type;?>">Insert new <?php echo $name;?>
                  <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
</div>
    <!-- Custom JavaScript -->
    <script src="js/custom.js"></script>