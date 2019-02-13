
                            <?php
                            if ( $type == 'rec' ) {
                            
	                            $mysqli = new mysqli("localhost", "root", "", "beerecipe");
	                            $result = $mysqli->query("SELECT a.uid, a.name,a.description,amount,b.name FROM recipe a
	                            		LEFT JOIN category b ON a.category=b.uid ");
								$row = $result->fetch_row();  
								                          
                            	while ( $row != null ) {
                            ?>
                        	<tr>
	                            <td><?php echo $row[1]; ?></td>
	                            <td><?php echo $row[2]; ?></td>
	                            <td><?php echo $row[3]; ?></td>
	                            <td><?php echo $row[4]; ?></td>
	                            <td>
	                            	<form action="action/upload.php" method="post" enctype="multipart/form-data">
								    	<input type="file" name="fileToUpload" id="fileToUpload" style="float: left;">
								    	<input type="submit" value="Upload Image" name="submit" style="float: right;">
									</form>
								</td>	
	                            <td>
	                            	<a id="deletelink" href="action/delete.php?uid=<?php echo $row[0]; ?>&type=<?php echo $type; ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
									<a href="index.php?p=update&uid=<?php echo $row[0]; ?>&type=<?php echo $type; ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
               						<a href="action/sticker.php?uid=<?php echo $row[0]; ?>"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></a>	
								</td>
	                        </tr>
                            <?php
								$row = $result->fetch_row();
                            	}
                            }
                            ?>
                            