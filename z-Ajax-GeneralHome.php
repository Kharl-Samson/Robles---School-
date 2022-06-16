<?php
session_start();
require_once "Z-connection.php";
$hTagline= trim($_POST['h_Tagline']);



if(mysqli_query($conn, "UPDATE `general_tb` SET h_Tagline='$hTagline' WHERE g_id='1'")) {
        echo 'success';
} 
else 
{
echo "Error: " . $sql . "" . mysqli_error($conn);
}

mysqli_close($conn);
?>


