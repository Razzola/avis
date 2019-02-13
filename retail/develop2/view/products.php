
<?php
if ( $type == 'prd' ) {

	$mysqli = new mysqli("localhost", "root", "", "beerecipe");
	$result = $mysqli->query("SELECT a.name,a.description,a.price, b.name, a.uid FROM products a
															left join ingredients b on a.ingredients_uid=b.uid order by a.name");
	$row = $result->fetch_row();

	while ( $row != null ) {
	?>
                        	<tr>
	                            <td><?php echo $row[0]; ?></td>
                            <td><?php echo $row[1]; ?></td>
                            <td><?php echo $row[2]; ?></td>
                            <td><?php echo $row[3]; ?></td>
                            <td>
								<a href="index.php?p=update&uid=<?php echo $row[4]; ?>&type=<?php echo $type; ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
								</td>
	                        </tr>
                            <?php
								$row = $result->fetch_row();
                            	}
                            }
                            ?>
                            