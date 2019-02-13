<?php

$mysqli = new mysqli("localhost", "root", "", "beerecipe");
$type = "";

if ( isset($_GET['type']) ) {
	$type = $_GET['type'];
	
	if ( $type == 'cat' and isset($_GET['uid']) and isset($_GET['name']) and isset($_GET['desc']) ) {
		$uid = $_GET['uid'];
		$name = $_GET['name'];
		$desc = $_GET['desc'];
	
		$result = $mysqli->query("UPDATE `category` SET name='$name', description='$desc' WHERE uid='$uid' ") or die($mysqli->error);
	
	}
	
	
	if ( $type == 'rec' and isset($_GET['uid']) and isset($_GET['name']) ) {
		$uid = $_GET['uid'];
		$name = $_GET['name'];
		$desc = $_GET['desc'];
		$ibu = $_GET['ibu'];
		$alcool= $_GET['alcool'];
	
	
		$url = $_SERVER['REQUEST_URI'];
		$params=explode('&',$url);
		$amount=0;
		foreach ($params as &$param) {
			$elements=explode("=",$param);
			$field = $elements[0];
			if (strpos($field, "prd_uid") !== false){
				$product[2]=null;
				$product[0]=$elements[1];
			}
			if (strpos($field, "quantity") !== false){
				$product[1] = $elements[1];
				//get price
				$prdQuery=$mysqli->query("SELECT price FROM products WHERE uid=".$product[0]);
				$product[2] = $prdQuery->fetch_row();
				$amount=$amount+($product[1]*$product[2][0]);
				$update="UPDATE `recipe_has_products` SET quantity=".$product[1]." WHERE recipe_uid=".$uid." AND products_uid=".$product[0];
				$query = $mysqli->query($update)or die($mysqli->error);
			}
				
		}
		
		//if developed in order to not overwrite ibu value bu save button
		if ($ibu!="")
			$ibufilter=", ibu='$ibu'";
		else
			$ibufilter='';
		/////////////////
		$result = $mysqli->query("UPDATE `recipe` SET amount='$amount',name='$name', description='$desc'".$ibufilter.", alcool='$alcool' WHERE uid='$uid' ") or die($mysqli->error);
		
	}

	
	if ( $type == 'ing' and isset($_GET['uid']) and isset($_GET['name']) and isset($_GET['desc']) ) {
		$uid = $_GET['uid'];
		$name = $_GET['name'];
		$desc = $_GET['desc'];
		
		$result = $mysqli->query("UPDATE `ingredients` SET name='$name', description='$desc' WHERE uid='$uid' ") or die($mysqli->error);
		
	}
	
	if ( $type == 'prd' and isset($_GET['uid']) and isset($_GET['name']) and isset($_GET['desc']) and isset($_GET['price']) and isset($_GET['ingredient']) ) {
		
		$uid = $_GET['uid'];
		$name = $_GET['name'];
		$desc = $_GET['desc'];
		$price = $_GET['price'];
		$ingredient = $_GET['ingredient'];
		
		$result = $mysqli->query("UPDATE `products` SET name='$name', description='$desc', price='$price', ingredients_uid='$ingredient' WHERE uid='$uid' ") or die($mysqli->error);
		$recipes = $mysqli->query("SELECT b.uid
									FROM recipe_has_products a
									JOIN recipe b ON a.recipe_uid=b.uid
									JOIN products c ON a.products_uid=c.uid
									WHERE a.products_uid=".$uid) or die($mysqli->error);
		$recipe = $recipes->fetch_row();
		
		while ($recipe != null ) {
			$updateRecipeAmount=$mysqli->query("SELECT b.uid, SUM(a.quantity*c.price) AS newamount
							FROM recipe_has_products a
							JOIN recipe b ON a.recipe_uid=b.uid
							JOIN products c ON a.products_uid=c.uid
							WHERE b.uid=".$recipe[0]) or die($mysqli->error);
			
			$newAmount = $updateRecipeAmount->fetch_row();
			$recipe = $recipes->fetch_row();
			$updateRecipe=$mysqli->query("UPDATE `recipe` SET amount=".$newAmount[1]." WHERE uid=".$newAmount[0]) or die($mysqli->error);
		}
	}
	
	if ( $type == 'wh' and isset($_GET['uid'])  and isset($_GET['quantity'])) {

		$uid = $_GET['uid'];
		$quantit = $_GET['quantity'];
		$position = $_GET['position'];
	
		$result = $mysqli->query("UPDATE `products` SET quantity='$quantit', position='$position' WHERE uid='$uid' ") or die($mysqli->error);
	}
}
if ( $type == 'rec' and isset($_GET['uid'])) {
	header("Location: ../index.php?p=update&type=" . $type."&uid=".$uid."");
}
else {
	header("Location: ../index.php?p=view&type=" . $type);
}
//
?>

