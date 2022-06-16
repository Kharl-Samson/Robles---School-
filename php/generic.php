<?php
     error_reporting(0);
     session_start();
     $sql = "SELECT * FROM `general_tb`";
     $search_general = filterTablehoverG($sql);
     function filterTablehoverG($sql){  
     $con=mysqli_connect('localhost','root','','robles_db');
     $filter_Result = mysqli_query($con, $sql);
     return $filter_Result; 
     }
?>