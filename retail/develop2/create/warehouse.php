<?php
if ( $type == 'wh' ) {
	?>
                
                <div class="form-group col-xs-12 col-sm-6">
                    <label>Product</label>
                    <select class="form-control" name="product">
                    	 <?php

							$result = $mysqli->query("SELECT uid,name FROM `products`");
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
                
				<div class="form-group col-xs-12 col-sm-6">
                    <label>Quantity</label>
                    <input name="quantity" class="form-control" required>
                </div>
                
				<?php
		}
	?>
