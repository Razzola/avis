<?php
	$mysqli = new mysqli("localhost", "root", "", "beerecipe");
	if ( isset($_GET['delete']) and isset($_GET['table']) ) {

		$delete = $_GET['delete'];
		$table = $_GET['table'];
		$path = $_GET['path'];

		$result = $mysqli->query("DELETE FROM $table WHERE uid=$delete") or die ($mysqli->error);
	
		header("location: $path");	
		// TODO redirect to prev page
	} else {
		// FIXME in case of error redirect to error page, instead of showin' nothing.
	}
?>