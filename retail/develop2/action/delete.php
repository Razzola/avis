<?php

$mysqli = new mysqli("localhost", "root", "", "beerecipe");
$type = "";

if ( isset($_GET['type']) ) {
	$type = $_GET['type'];
	
	if ( $type == 'rec' and isset($_GET['uid']) ) {
	
		$uid = $_GET['uid'];
	
		$result = $mysqli->query("DELETE FROM `recipe_has_products` WHERE recipe_uid = '$uid'") or die($mysqli->error);
		$result = $mysqli->query("DELETE FROM `recipe` WHERE uid = '$uid'") or die($mysqli->error);
	}
	
	if ( $type == 'wh' and isset($_GET['uid']) ) {
	
		$uid = $_GET['uid'];
	
		$result = $mysqli->query("DELETE FROM `warehouse` WHERE uid = '$uid'") or die($mysqli->error);
		}
	
}

function updateRecipes($product_id) {
	$mysqli = new mysqli("localhost", "root", "", "beerecipe");
	
	$recipes = $mysqli->query("SELECT b.uid
									FROM recipe_has_products a
									JOIN recipe b ON a.recipe_uid=b.uid
									JOIN products c ON a.products_uid=c.uid
									WHERE a.products_uid=".$product_id) or die($mysqli->error);
	$recipe = $recipes->fetch_row();
	
	while ($recipes != null ) {
		echo "SELECT b.uid, SUM(a.quantity*c.price) AS newamount
							FROM recipe_has_products a
							JOIN recipe b ON a.recipe_uid=b.uid
							JOIN products c ON a.products_uid=c.uid
							WHERE b.uid=".$recipe[0];
		/*$updateRecipeAmount=$mysqli->query("SELECT b.uid, SUM(a.quantity*c.price) AS newamount
							FROM recipe_has_products a
							JOIN recipe b ON a.recipe_uid=b.uid
							JOIN products c ON a.products_uid=c.uid
							WHERE b.uid=".$recipe[0]) or die($mysqli->error);*/
	
		$newAmount = $updateRecipeAmount->fetch_row();
		$recipe = $recipes->fetch_row();
		$updateRecipe=$mysqli->query("UPDATE `recipe` SET amount=".$newAmount[1]." WHERE uid=".$newAmount[0]) or die($mysqli->error);
	}
}



header("Location: ../index.php?p=view&type=" . $type);

?>

