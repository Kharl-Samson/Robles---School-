<?php
session_start();
require_once "Z-connection.php";
$gSiteName = mysqli_real_escape_string($conn, $_POST['g_Sitename']);
$gVision = trim($_POST['g_Vision']);
$gContact = mysqli_real_escape_string($conn, $_POST['g_Contact']);
$gLocation = mysqli_real_escape_string($conn, $_POST['g_Location']);
$gEmail = mysqli_real_escape_string($conn, $_POST['g_Email']);
$gWorkingHours = mysqli_real_escape_string($conn, $_POST['g_WorkingHours']);

$gSiteName = ucwords($gSiteName);

$compCode = mysqli_real_escape_string($conn, $_POST['companyCode']);
$gMap = mysqli_real_escape_string($conn, $_POST['googlemap']);
$facebook = mysqli_real_escape_string($conn, $_POST['facebook']);

if(mysqli_query($conn, "UPDATE `general_tb` SET g_Sitename='$gSiteName', g_Vision='$gVision', g_Contact='$gContact', g_Location='$gLocation', g_Email='$gEmail', g_WorkingHours='$gWorkingHours', companyCode='$compCode', googlemap='$gMap', facebook='$facebook' WHERE g_id='1'")) {
        echo 'success';
} 
else 
{
echo "Error: " . $sql . "" . mysqli_error($conn);
}

mysqli_close($conn);
?>


