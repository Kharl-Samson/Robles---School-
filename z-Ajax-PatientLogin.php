<?php
session_start();
require_once "Z-connection.php";
$key_name = mysqli_real_escape_string($conn, $_POST['username_l']);
$pass = mysqli_real_escape_string($conn, $_POST['password_l']);



$result = mysqli_query($conn, "SELECT * FROM `patientinfo_db` WHERE email='$key_name' or username='$key_name' AND password='$pass'");

$row = mysqli_fetch_array($result);
  
    if($row['email'] == $key_name && $row['password'] == $pass){
            $_SESSION['patient_active'] = $key_name;
            echo "verified";
    }
    else if($row['username'] == $key_name && $row['password'] == $pass){
            $_SESSION['patient_active'] = $key_name;
            echo "verified";
    }

mysqli_close($conn);
?>