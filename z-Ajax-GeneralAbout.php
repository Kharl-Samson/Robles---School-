<?php
session_start();
require_once "Z-connection.php";
$aAbout= trim($_POST['a_about']);



if(mysqli_query($conn, "UPDATE `general_tb` SET a_about='$aAbout' WHERE g_id='1'")) {
        echo 'success';
} 
else 
{
echo "Error: " . $sql . "" . mysqli_error($conn);
}

mysqli_close($conn);
?>


