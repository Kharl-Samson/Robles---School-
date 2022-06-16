<?php
session_start();
date_default_timezone_set('Asia/Manila');
require_once "Z-connection.php";
$fname = mysqli_real_escape_string($conn, $_POST['fname']);
$lname = mysqli_real_escape_string($conn, $_POST['lname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$question = trim($_POST['question']);
$date = date("d/m/Y");

$time =  date("h:i A");
$status = "unread";
$archive = "off";

if(mysqli_query($conn, "INSERT INTO inquiry_tb (fname, lname, email, question, date, status, archive, time) VALUES('" . $fname . "', '" . $lname . "', '" . $email . "', '" . $question . "' , '" . $date . "', '" . $status . "' , '" . $archive . "' , '" . $time . "')")) {
echo '1';
} 
else {
echo "Error: " . $sql . "" . mysqli_error($conn);
}
mysqli_close($conn);
?>