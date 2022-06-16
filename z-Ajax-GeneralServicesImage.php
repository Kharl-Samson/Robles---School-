<?php
session_start();
require_once "Z-connection.php";
$content= mysqli_real_escape_string($conn, $_POST['key_allservImage']);

if(mysqli_query($conn, "UPDATE `general_tb` SET s_img='$content' WHERE g_id='1'")) {
    echo 'success';
} 
else 
{
echo "Error: " . $sql . "" . mysqli_error($conn);
}


mysqli_close($conn);
?>