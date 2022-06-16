<?php
     session_start();
     //estalishing connection to database 
     require_once "Z-connection.php";
     $key_inq = $_GET["keyInq"];
     $_SESSION['view_inq_key'] = $key_inq;

     $sqli = "UPDATE `inquiry_tb` SET status='read' WHERE id='$key_inq'";
     $results=mysqli_query($conn, $sqli);
     
    $add = 1;
    echo json_encode(array('status' => $add)); // where $status is 'OK' or 'ERROR'
    exit;
?>