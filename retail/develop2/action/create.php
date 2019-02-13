<?php

$mysqli = new mysqli("localhost", "root", "", "beerecipe");
$type = "";

if ( isset($_GET['type']) ) {
	$type = $_GET['type'];
		
	if ( $type == 'ing' and isset($_GET['name']) and isset($_GET['desc']) ) {
		
		$name = $_GET['name'];
		$desc = $_GET['desc'];
		
		$result = $mysqli->query("INSERT INTO `ingredients` ( uid, name, description ) VALUES ( null, '$name', '$desc' ) ") or die($mysqli->error);
		
	}
	
	if ( $type == 'cat' and isset($_GET['name']) and isset($_GET['desc']) ) {
	
		$name = $_GET['name'];
		$desc = $_GET['desc'];
	
		$result = $mysqli->query("INSERT INTO `category` ( uid, name, description ) VALUES ( null, '$name', '$desc' ) ") or die($mysqli->error);
	
	}
	
	if ( $type == 'prd' and isset($_GET['name'])  and isset($_GET['price']) and isset($_GET['ingredient']) ) {

		$name = $_GET['name'];
		$desc = $_GET['desc'];
		$price = $_GET['price'];
		$reference = $_GET['ingredient'];
		
		$result = $mysqli->query("INSERT INTO `products` ( uid, name, description, price, ingredients_uid ) VALUES ( null, '$name', '$desc', '$price', '$reference' ) ") or die($mysqli->error);
		
	}
	if ( $type == 'rec' and isset($_GET['name'])) {
		
		$name = $_GET['name'];
		$desc = $_GET['desc'];
		$cat = $_GET['category'];
	
		$result = $mysqli->query("INSERT INTO `recipe` ( uid, name, description, category ) VALUES ( null, '$name', '$desc','$cat' ) ") or die($mysqli->error);
	
		$url = $_SERVER['REQUEST_URI'];
		$params=explode('&',$url);
		$max= $mysqli->query("SELECT MAX(uid) FROM recipe");
		$recipeUid = $max->fetch_row();
		$amount=0;
		foreach ($params as &$param) {
				$elements=explode("=",$param);
					$field = $elements[0];
					if (strpos($field, "ingredient") !== false){
						$ingredient[2]=null;
					}
					if (strpos($field, "product") !== false){
						$productMid = null;
						if (strpos($elements[1], "|") !== false){
							$productMid = explode("|",$elements[1]);
						}else{
							$productMid = explode("%7C",$elements[1]);
						}
						$ingredient[0]=$productMid[0];
					}
					if (strpos($field, "quantity") !== false){
						$ingredient[1] = $elements[1];
					}
					if (strpos($field, "price") !== false){
						$ingredient[2] = $elements[1];
						$amount=$amount+($ingredient[1]*$ingredient[2]);
						$insert="INSERT INTO `recipe_has_products` ( recipe_uid, products_uid, quantity ) VALUES (".$recipeUid[0].",".$ingredient[0].",".$ingredient[1].");";
						//echo $insert."<br/>";
						$query = $mysqli->query($insert)or die($mysqli->error);
						}
					
		}
		$update="UPDATE `recipe` SET amount=".$amount." WHERE uid=".$recipeUid[0];
		//echo $update."<br/>";
		$query = $mysqli->query($update)or die($mysqli->error);
	}
	
	if ( $type == 'wh' ) {
	
		$product = $_GET['product'];
		$quantity = $_GET['quantity'];
	
		$result = $mysqli->query("INSERT INTO `warehouse` ( uid, product_uid, quantity ) VALUES ( null, '$product', '$quantity' ) ") or die($mysqli->error);
	
	}
}

header("Location: ../index.php?p=view&type=" . $type);

//$result = $mysqli->query("UPDATE `ingredients` SET name='$name', description='$desc' WHERE uid='$uid' ") or die($mysqli->error);
?>

