<?php
session_start();
require_once "Z-connection.php";
$key_name = mysqli_real_escape_string($conn, $_POST['username_l']);
$pass = mysqli_real_escape_string($conn, $_POST['password_l']);

date_default_timezone_set('Asia/Manila');
$dateToday = date("Y-m-d");
$time = date("h:i A");
$dateTime = $dateToday." ".$time;
$description = $key_name." has logged in";

$result = mysqli_query($conn, "SELECT * FROM staff_db WHERE email='$key_name' or username='$key_name' AND password='$pass' ");

$row = mysqli_fetch_array($result);
  
    if($row['email'] == $key_name && $row['password'] == $pass && $row['role'] == "Midwife" && $row['status'] == "Active"){
            $_SESSION['user_active'] = $key_name;
            mysqli_query($conn, "INSERT INTO audit_tb (date, name, description) VALUES('".$dateTime."', '".$key_name."', '".$description."')");
            echo "verified";
    }
    else if($row['username'] == $key_name && $row['password'] == $pass && $row['role'] == "Midwife" && $row['status'] == "Active"){
            $_SESSION['user_active'] = $key_name;
            mysqli_query($conn, "INSERT INTO audit_tb (date, name, description) VALUES('".$dateTime."', '".$key_name."', '".$description."')");
            echo "verified";
    }
    else if($row['email'] == $key_name && $row['password'] == $pass && $row['role'] == "Ob-Gyne" && $row['status'] == "Active"){
            $_SESSION['ob_active'] = $key_name;
            mysqli_query($conn, "INSERT INTO audit_tb (date, name, description) VALUES('".$dateTime."', '".$key_name."', '".$description."')");
            echo "verified1";
    }       
    else if($row['username'] == $key_name && $row['password'] == $pass && $row['role'] == "Ob-Gyne" && $row['status'] == "Active"){
            $_SESSION['ob_active'] = $key_name;
            mysqli_query($conn, "INSERT INTO audit_tb (date, name, description) VALUES('".$dateTime."', '".$key_name."', '".$description."')");
            echo "verified1";
    }

mysqli_close($conn);
?>