<?php

	$mysqli = new mysqli("localhost", "root", "", "beerecipe");
	$type = "";
	if ( isset($_GET['type']) ) {
		$type = $_GET['type'];
	}

?>

<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"> Creation form</h3>
        </div>
        <div class="panel-body">
            <form role="form" action="action/create.php">
            	<?php include "create/ingredients.php";?>
				<?php include "create/category.php";?>
				<?php include "create/products.php";?>
				<?php include "create/recipe.php";?>
				<?php include "create/warehouse.php";?>
				<?php include "create/diary.php";?>	
            	<?php include "create/recipe.php";?>			
				<input type="hidden" name="type" class="form-control" value="<?php echo $type; ?>">
                <button type="submit" class="btn btn-default"><?php echo $submit;?></button>
                <button type="reset" class="btn btn-default"><?php echo $reset;?></button>

            </form>
        </div>
    </div>
    <!-- Custom JavaScript -->
    <script src="js/custom.js"></script>
</div>