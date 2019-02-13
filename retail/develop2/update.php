<?php

	$mysqli = new mysqli("localhost", "root", "", "beerecipe");
	$type = "";
	if ( isset($_GET['type']) ) {
		$type = $_GET['type'];
	}

	if ( isset($_GET['uid']) ) {
		$uid = $_GET['uid'];
	}

?>

<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"> Update form</h3>
        </div>
        <div class="panel-body">
            <form role="form" action="action/update.php">
            	<?php include "update/category.php";?>
            	<?php include "update/ingredients.php";?>
            	<?php include "update/products.php";?>
            	<?php include "update/warehouse.php";?>
            	<?php include "update/recipe.php";?>
                <input type="hidden" name="type" class="form-control" value="<?php echo $type; ?>">
                <button type="submit" class="btn btn-default"><?php echo $submit;?></button>
                <button type="reset" class="btn btn-default"><?php echo $reset;?></button>
                <?php  if ( $type == 'rec' ) {?>
				  <!-- Trigger the modal with a button -->
				  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#bitterCalculate"><?php echo $bitterCalculate;?></button>
				  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#StickerSize"><?php echo $sticker;?></button>
				  
				  <!-- Modal -->
				  <?php include "modals.php";?>
				  <!-- End Modal -->
				<?php }?>
				</div>
            </form>
        </div>
    </div>
    <!-- Custom JavaScript -->
    <script src="js/custom.js"></script>
</div>