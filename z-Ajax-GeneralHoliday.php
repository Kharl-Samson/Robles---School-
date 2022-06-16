<?php
session_start();
require_once "Z-connection.php";
$key_allholidayName= mysqli_real_escape_string($conn, $_POST['key_allholidayName']);
$key_allholidayDate= mysqli_real_escape_string($conn, $_POST['key_allholidayDate']);

if(mysqli_query($conn, "UPDATE `general_tb` SET holidays='$key_allholidayDate' , holiday_name='$key_allholidayName' WHERE g_id='1'")) {
    echo 'success';
} 
else 
{
echo "Error: " . $sql . "" . mysqli_error($conn);
}


mysqli_close($conn);
?>