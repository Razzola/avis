<?php
	if ( $type == 'ing' ) {
	
		$result = $mysqli->query("SELECT uid,name,description FROM `ingredients` WHERE uid =".$uid);
		$row = $result->fetch_row();
		$prIngs = $mysqli->query("SELECT name,description, price FROM `products` WHERE ingredients_uid =".$uid);
		$prIng = $prIngs->fetch_row();
	
	?>
	
	<input name="uid" type="hidden" value="<?php echo $row[0];?>">
				
				<div class="form-group">
                    <label>Name</label>
                    <input name="name" class="form-control" value="<?php echo $row[1];?>">
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="desc" class="form-control" rows="3"><?php echo $row[2];?></textarea>
                </div>
                <label>Products</label>
                <table class="table table-bordered table-hover table-striped">
                	<thead>
                		<tr>
                			<td>Name</td>
                			<td>Descripion</td>
                			<td>Price</td>
                		</tr>
                	</thead>
                	<tbody>
                		<?php while ( $prIng != null ) {
                            ?>
                        	<tr>
	                            <td><?php echo $prIng[0]; ?></td>
                            <td><?php echo $prIng[1]; ?></td>
                            <td><?php echo $prIng[2]; ?></td>
	                        </tr>
                            <?php
								$prIng = $prIngs->fetch_row();
                            	}
                            ?>
                    	</tbody>
                	</table>
	                
					<?php
	}
?>