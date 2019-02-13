<?php
	if ( $type == 'wh' ) {
	
		$result = $mysqli->query("SELECT uid, name, quantity, position
									FROM products WHERE uid =".$uid);
		$row = $result->fetch_row();
	
	?>
	
	<input name="uid" type="hidden" value="<?php echo $row[0];?>">
				
				<div class="form-group col-xs-12 col-sm-4">
                    <label>Product</label>
                    <p><?php echo $row[1]; ?></p>
                </div>
                <div class="form-group col-xs-12 col-sm-4">
                    <label>Position</label>
                    <input name="position" class="form-control" required value="<?php echo $row[3]; ?>"></input>
                </div>
                <div class="form-group col-xs-12 col-sm-4">
                    <label>Quantity</label>
                    <input name="quantity" class="form-control" required value="<?php echo $row[2]; ?>"></input>
                </div>
               
                
				<?php
	}
?>