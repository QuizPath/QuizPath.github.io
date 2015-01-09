<?php
	require_once 'login.php';
	$link = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
	
	if( mysqli_connect_errno()) die( "Unable to connect to MySQL: " .mysqli_connect_error());
?>	