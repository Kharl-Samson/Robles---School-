<?php
require_once "Z-connection.php";
$email = mysqli_real_escape_string($conn, $_GET['emailM']);
$code = mysqli_real_escape_string($conn, $_GET['final_codeM']);

    $sqlGet = "SELECT * FROM `appoinment_verification_tb` WHERE email='$email' ";
    $search_resulthover = filterTablehover($sqlGet);
    function filterTablehover($sqlGet){  
    $con=mysqli_connect('localhost','root','','robles_db');
    $filter_Result = mysqli_query($con, $sqlGet);
    return $filter_Result; 
    }
    $row_get = mysqli_fetch_array($search_resulthover);

    if($row_get['code'] != $code){
        echo "invalid code";
    }
    else{
     echo "success";
    }
  
    mysqli_close($conn);

?>