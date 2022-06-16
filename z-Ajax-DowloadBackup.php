<?php
    error_reporting(0);
	include 'backup_function.php';
	$server = "localhost";
	$username = "root";
	$password = "";
	$dbname = "robles_db";	
	
	backDb($server, $username, $password, $dbname);
    echo "<script>history.back()</script>";
	exit();
?>