<?php
     error_reporting(0);
     session_start();
     $u_name= $_SESSION['patient_active'];
     $sql = "SELECT * FROM `patientinfo_db` WHERE username = '$u_name' or email = '$u_name' ";
     $search_resulthover = filterTablehover($sql);
     function filterTablehover($sql){  
     $con=mysqli_connect('localhost','root','','robles_db');
     $filter_Result = mysqli_query($con, $sql);
     return $filter_Result; 
     }
?>