<?php
session_start();
require_once "Z-connection.php";

date_default_timezone_set('Asia/Manila');
$key_name = $_SESSION['user_active'];
$dateToday = date("Y-m-d");
$time = date("h:i A");
$dateTime = $dateToday." ".$time;
$description = $key_name." has logged out.";

mysqli_query($conn, "INSERT INTO audit_tb (date, name, description) VALUES('".$dateTime."', '".$key_name."', '".$description."')");


unset($_SESSION["user_active"]);
unset($_SESSION["auditname"]);
header("Location: index.php");
exit();
?>