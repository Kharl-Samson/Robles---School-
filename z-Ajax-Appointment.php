<?php
require_once "Z-connection.php";
$fname = mysqli_real_escape_string($conn, $_POST['firstname']);
$mname = mysqli_real_escape_string($conn, $_POST['middlename']);
$lname = mysqli_real_escape_string($conn, $_POST['lastname']);
$address = mysqli_real_escape_string($conn, $_POST['address']);
$contact = mysqli_real_escape_string($conn, $_POST['contact']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$date = mysqli_real_escape_string($conn, $_POST['date1']);
$time = mysqli_real_escape_string($conn, $_POST['time1']);
$code = mysqli_real_escape_string($conn, $_POST['verification_email']);
$status = "Pending";
$service = mysqli_real_escape_string($conn, $_POST['select_service']);



    //checking if email already exist
    $s_email = "SELECT * FROM `patientinfo_db` WHERE email='$email'";
    $result_email = mysqli_query($conn, $s_email);
    $num_email = mysqli_num_rows($result_email); 

    $sqlGet = "SELECT * FROM `appoinment_verification_tb` WHERE email='$email' ";
    $search_resulthover = filterTablehover($sqlGet);
    function filterTablehover($sqlGet){  
    $con=mysqli_connect('localhost','root','','robles_db');
    $filter_Result = mysqli_query($con, $sqlGet);
    return $filter_Result; 
    }
    $row_get = mysqli_fetch_array($search_resulthover);

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
    else if($row_get['code'] != $code){
        echo "invalid code";
    }
    else{
     //connection to server to update
     $sqli = "INSERT INTO pendingappointment_tb (fname, mname, lname, address, contact, email, date, time, status, service) VALUES('" . $fname . "', '" . $mname . "', '" . $lname . "', '" . $address . "' , '" . $contact . "', '" . $email . "', '" . $date . "', '" . $time . "', '" . $status . "' , '" . $service . "')";
     $results=mysqli_query($conn, $sqli);
     echo "success";
    }
  
    mysqli_close($conn);

?>