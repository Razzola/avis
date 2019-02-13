<?php
if ( $type == 'ing' ) {

	$mysqli = new mysqli("localhost", "root", "", "beerecipe");
	$result = $mysqli->query("SELECT name, description, uid FROM `ingredients` ORDER BY name");
	$row = $result->fetch_row();

	while ( $row != null ) {
		?>
                        	<tr>
	                            <td><?php echo $row[0]; ?></td>
	                            <td><?php echo $row[1]; ?></td>
	                            <td>
									<a href="index.php?p=update&uid=<?php echo $row[2]; ?>&type=<?php echo $type; ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
								</td>
	                        </tr>
                            <?php
								$row = $result->fetch_row();
                            	}
                            }
                            ?>
                            