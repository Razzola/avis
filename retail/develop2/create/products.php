<?php
if ( $type == 'prd' ) {
	?>
				
				<div class="form-group">
                    <label>Name</label>
                    <input name="name" class="form-control">
                    <p class="help-block">Name</p>
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="desc" class="form-control" rows="3"></textarea>
                </div>
				
				<div class="form-group">
                    <label>Price (0.00)</label>
                    <input name="price" class="form-control">
                    <p class="help-block">Price in kg</p>
                </div>
                
                <div class="form-group">
                    <label>Ingredient</label>
                    <select class="form-control" name="ingredient">
                    	 <?php

							$result = $mysqli->query("SELECT * FROM `ingredients` order by name");
							$row = $result->fetch_row();
							
                            while ( $row != null ) {
                            ?>
                            <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
                            <?php
	                            $row = $result->fetch_row();
                            }
                            ?>
                    </select>
                </div>
                
				<?php
	}
?>
