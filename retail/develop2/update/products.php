<?php
	if ( $type == 'prd' ) {
		

		$result = $mysqli->query("SELECT uid,name,description, price, ingredients_uid FROM `products` WHERE uid =".$uid);
		$row = $result->fetch_row();
	?>
				
				<div class="form-group">
                    <label>Name</label>
                    <input name="name" class="form-control" value="<?php echo $row[1];?>">
                </div>
                
				<input name="uid" type="hidden" value="<?php echo $row[0];?>">

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="desc" class="form-control" rows="3" ><?php echo $row[2];?></textarea>
                </div>
				
				<div class="form-group">
                    <label>Price</label>
                    <input name="price" class="form-control" value="<?php echo $row[3];?>">
                </div>
                
                <div class="form-group">
                    <label>Ingredient</label>
                    <select class="form-control" name="ingredient" >
	                   	<option value="">Select product</option>
                    	 <?php

							$result = $mysqli->query("SELECT * FROM `ingredients` order by name");
							$ingredient = $result->fetch_row();
							
                            while ( $ingredient != null ) {
                            	if ($ingredient[0] == $row[4]){
	                            	?>
                            	<option value="<?php echo $ingredient[0]; ?>" selected><?php echo $ingredient[1]; ?></option>
                            	<?php
                            	}else{
                            		?>
                            			<option value="<?php echo $ingredient[0]; ?>"><?php echo $ingredient[1]; ?></option>
                            		<?php
                            	}
                            
	                            $ingredient = $result->fetch_row();
                            }
                            ?>
                    </select>
                </div>
                
				<?php
	}
?>
