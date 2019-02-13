			
				<?php
					if ( $type == 'rec' ) {
						$recipes = $mysqli->query("SELECT uid,name,description,category,amount,ibu,alcool FROM `recipe` WHERE uid =".$uid);
						$recipe = $recipes->fetch_row();
						
					?>
					<div div class="form-group col-xs-12 col-sm-6">
							<div class="form-group col-xs-12 col-sm-6" style="margin-left: -15px;">
			                    <label>Name</label>
			                    <input name="name" class="form-control" value="<?php echo $recipe[1];?>">
	               				<input type="hidden" name="uid" class="form-control col-xs-12 col-sm-4" value="<?php echo $uid; ?>">
			                </div>
			                <div class="form-group col-xs-12 col-sm-6">
		                    <label>Category</label>
		                    <select class="form-control" name="ingredient" >
			                   	<option value="">Select category</option>
		                    	 <?php
	
								$result = $mysqli->query("SELECT * FROM `category`");
								$category = $result->fetch_row();
								
	                            while ( $category != null ) {
	                            	if ($category[0] == $recipe[3]){
		                            	?>
			                            	<option value="<?php echo $category[0]; ?>" selected><?php echo $category[1]; ?></option>
		                            	<?php
	                            	}else{
	                            		?>
	                            			<option value="<?php echo $category[0]; ?>"><?php echo $category[1]; ?></option>
	                            		<?php
	                            	}
	                            
		                            $category = $result->fetch_row();
	                            }
	                            ?>
		                    </select>
		                </div>
			                
		                <div class="form-group ">
		                    <label>Description</label>
		                    <textarea style="width:94%;" name="desc" class="form-control" rows="3"><?php echo $recipe[2];?></textarea>
		                </div>
	               		<div class="form-group col-xs-12 col-sm-2">	
			                <label>Amount</label>
			                 <p><?php echo $recipe[4];?></p>
			            </div>
	               		<div class="form-group col-xs-12 col-sm-2">	
			                <label>IBU</label>
			                 <p><?php echo $recipe[5];?></p>
			            </div>
	               		<div class="form-group col-xs-12 col-sm-2">	
			                <label>Alcool</label>
			                <input name="alcool" class="form-control" value="<?php echo $recipe[6];?>">
			            </div>
	               		<div class="form-group col-xs-12 col-sm-2" >	
			            	<button style="margin-top: 10px;" type="button" class="btn btn-default" data-toggle="modal" data-target="#IBUCalculate"><?php echo $IBUCalculate;?></button>
	               		</div>
		            </div>
		            <img width="50%" alt="<?php echo $recipe[1];?>" src="recipeImages/<?php echo $recipe[1];?>-0.jpg">

	                <table class="table table-bordered table-hover table-striped " style="margin-top:10px;">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
	                <?php
                            $result = $mysqli->query("SELECT products_uid,NAME,a.quantity, price
														FROM recipe_has_products a
														LEFT JOIN products ON products.uid=a.products_uid
														WHERE recipe_uid=".$recipe[0]);
							$row = $result->fetch_row();  
							$prdIndex=0;
								                          
                            while ( $row != null ) {
                            ?>
                        	<tr>
	                            <td>
	                            	<?php echo $row[1]; ?>
               					 	<input type="hidden" name="prd_uid<?php echo $prdIndex;?>" class="form-control" value="<?php echo $row[0]; ?>">
               					</td>
	                            <td>
	                            	<input name="quantity<?php echo $prdIndex;?>" class="form-control" required value="<?php echo $row[2]; ?>">
	                            </td>
								<td>
	                            	<?php echo $row[3]; ?>
								</td>
	                            <td>
									<a href="index.php?p=update&uid=<?php echo $row[0]; ?>&type=prd"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
								</td>
	                        </tr>
                            <?php
								$row = $result->fetch_row();
								$prdIndex++;
                            }
                    ?>
                    	</tbody>
                    </table>              
					<?php
					}
				?>