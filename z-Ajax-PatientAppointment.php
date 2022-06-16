<?php
require_once "Z-connection.php";
$fname = mysqli_real_escape_string($conn, $_GET['firstname']);
$mname = mysqli_real_escape_string($conn, $_GET['middlename']);
$lname = mysqli_real_escape_string($conn, $_GET['lastname']);
$address = mysqli_real_escape_string($conn, $_GET['address']);
$contact = mysqli_real_escape_string($conn, $_GET['contact']);
$email = mysqli_real_escape_string($conn, $_GET['email']);
$date = mysqli_real_escape_string($conn, $_GET['date1']);
$time = mysqli_real_escape_string($conn, $_GET['time1']);
$status = "Pending";
$service =  mysqli_real_escape_string($conn, $_GET['select_service']);

$id = mysqli_real_escape_string($conn, $_GET['id_key']);


    //checking if the patient already have an appointment
    $s_id = "SELECT * FROM `pendingappointment_tb` WHERE patient_id='$id'";
    $result_id = mysqli_query($conn, $s_id);
    $num_id = mysqli_num_rows($result_id); 

    //checking if the patient already have an appointment
    $s_id1 = "SELECT * FROM `acceptedappointment_tb` WHERE patient_id='$id'";
    $result_id1 = mysqli_query($conn, $s_id1);
    $num_id1 = mysqli_num_rows($result_id1); 
  
    if($num_id == 1){
        echo "failed";
    }
    else if($num_id1 == 1){
        echo "failed1";
    }
    else{
     //connection to server to update
     $sqli = "INSERT INTO pendingappointment_tb (patient_id, fname, mname, lname, address, contact, email, date, time, status, service) VALUES('" . $id . "', '" . $fname . "', '" . $mname . "', '" . $lname . "', '" . $address . "' , '" . $contact . "', '" . $email . "', '" . $date . "', '" . $time . "', '" . $status . "' , '" . $service . "')";
     $results=mysqli_query($conn, $sqli);
     echo "success";
    }
    mysqli_close($conn);

?>