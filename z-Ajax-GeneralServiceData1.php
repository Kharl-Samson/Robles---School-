<?php
session_start();
require_once "Z-connection.php";
$key_allservName= mysqli_real_escape_string($conn, $_POST['key_allservName']);
$key_allservDesc= mysqli_real_escape_string($conn, $_POST['key_allservDesc']);

if(mysqli_query($conn, "UPDATE `general_tb` SET s_Sheader='$key_allservName' , s_sDesc='$key_allservDesc' WHERE g_id='1'")) {
    echo 'success';
} 
else 
{
echo "Error: " . $sql . "" . mysqli_error($conn);
}


mysqli_close($conn);
?>