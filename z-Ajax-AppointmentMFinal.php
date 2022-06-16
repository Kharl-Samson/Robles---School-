<?php
require_once "Z-connection.php";
$fname = mysqli_real_escape_string($conn, $_GET['firstnameM']);
$mname = mysqli_real_escape_string($conn, $_GET['middlenameM']);
$lname = mysqli_real_escape_string($conn, $_GET['lastnameM']);
$address = mysqli_real_escape_string($conn, $_GET['addressM']);
$contact = mysqli_real_escape_string($conn, $_GET['contactM']);
$email = mysqli_real_escape_string($conn, $_GET['emailM']);
$date = mysqli_real_escape_string($conn, $_GET['date1M']);
$time = mysqli_real_escape_string($conn, $_GET['time1M']);
$status = "Pending";
$service = mysqli_real_escape_string($conn, $_GET['select_serviceM']);

    //checking if email already exist
    $s_email = "SELECT * FROM `patientinfo_db` WHERE email='$email'";
    $result_email = mysqli_query($conn, $s_email);
    $num_email = mysqli_num_rows($result_email); 


    //checking if email already exist
    $s_email1 = "SELECT * FROM `pendingappointment_tb` WHERE email='$email'";
    $result_email1 = mysqli_query($conn, $s_email1);
    $num_email1 = mysqli_num_rows($result_email1); 

    if($num_email != 0){
        echo "failed";
    }
    else if($num_email1 != 0){
        echo "email failed";
    }
    else{
     //connection to server to update
     $sqli = "INSERT INTO pendingappointment_tb (fname, mname, lname, address, contact, email, date, time, status, service) VALUES('" . $fname . "', '" . $mname . "', '" . $lname . "', '" . $address . "' , '" . $contact . "', '" . $email . "', '" . $date . "', '" . $time . "', '" . $status . "', '" . $service . "')";
     $results=mysqli_query($conn, $sqli);
     echo "success";
    }
  
    mysqli_close($conn);

?>