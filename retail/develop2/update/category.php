<?php
	if ( $type == 'cat' ) {
		$result = $mysqli->query("SELECT uid,name,description FROM `category` WHERE uid =".$uid);
		$row = $result->fetch_row();			
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
		<?php	
	}
?>