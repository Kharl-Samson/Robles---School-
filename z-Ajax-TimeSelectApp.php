<?php
    header('Content-type: application/json');
    require_once "Z-connection.php";
     $time =$_GET["time"];
     $date =$_GET["date"];

     $s_email = "SELECT * FROM `pendingappointment_tb` WHERE date='$date' and time='$time'";
     $result_email = mysqli_query($conn, $s_email);
     $num_email = mysqli_num_rows($result_email); 
  

     $s_email1 = "SELECT * FROM `acceptedappointment_tb` WHERE date='$date' and time='$time'";
     $result_email1 = mysqli_query($conn, $s_email1);
     $num_email1 = mysqli_num_rows($result_email1); 
  
     $add = $num_email+$num_email1;

    echo json_encode(array('status' => $add)); // where $status is 'OK' or 'ERROR'
    exit;
    
?>


