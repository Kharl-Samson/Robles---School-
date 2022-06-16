<?php
session_start();
require_once "Z-connection.php";
//image uploading
if($_FILES['file-input']['name']){
        move_uploaded_file($_FILES['file-input']['tmp_name'], "upload_img_generic/".$_FILES['file-input']['name']);
        $img = $_FILES['file-input']['name'];
        $sql = "UPDATE `general_tb` SET g_LogoLight='$img' WHERE g_id='1'";
        $results=mysqli_query($conn, $sql);
}

if($_FILES['file-input1']['name']){
        move_uploaded_file($_FILES['file-input1']['tmp_name'], "upload_img_generic/".$_FILES['file-input1']['name']);
        $img1 = $_FILES['file-input1']['name'];
        $sql1 = "UPDATE `general_tb` SET g_LogoDark='$img1' WHERE g_id='1'";
        $results1=mysqli_query($conn, $sql1);
}

if($_FILES['img_hLayout']['name']){
        move_uploaded_file($_FILES['img_hLayout']['tmp_name'], "upload_img_generic/".$_FILES['img_hLayout']['name']);
        $i_imgLayout = $_FILES['img_hLayout']['name'];
        $sql2 = "UPDATE `general_tb` SET h_Layoutimg='$i_imgLayout' WHERE g_id='1'";
        $results2=mysqli_query($conn, $sql2);
}

if($_FILES['file-imgSl1']['name']){
        move_uploaded_file($_FILES['file-imgSl1']['tmp_name'], "upload_img_generic/".$_FILES['file-imgSl1']['name']);
        $i_h_slide1 = $_FILES['file-imgSl1']['name'];
        $sql3 = "UPDATE `general_tb` SET h_slide1='$i_h_slide1' WHERE g_id='1'";
        $results3=mysqli_query($conn, $sql3);
}

if($_FILES['file-imgSl2']['name']){
        move_uploaded_file($_FILES['file-imgSl2']['tmp_name'], "upload_img_generic/".$_FILES['file-imgSl2']['name']);
        $i_h_slide2 = $_FILES['file-imgSl2']['name'];
        $sql4 = "UPDATE `general_tb` SET h_slide2='$i_h_slide2' WHERE g_id='1'";
        $results4=mysqli_query($conn, $sql4);
}

if($_FILES['file-imgSl3']['name']){
        move_uploaded_file($_FILES['file-imgSl3']['tmp_name'], "upload_img_generic/".$_FILES['file-imgSl3']['name']);
        $i_h_slide3 = $_FILES['file-imgSl3']['name'];
        $sql5 = "UPDATE `general_tb` SET h_slide3='$i_h_slide3' WHERE g_id='1'";
        $results5=mysqli_query($conn, $sql5);
}

$gSiteName = mysqli_real_escape_string($conn, $_POST['g_Sitename']);
$gVision = trim($_POST['g_Vision']);
$gContact = mysqli_real_escape_string($conn, $_POST['g_Contact']);
$gLocation = mysqli_real_escape_string($conn, $_POST['g_Location']);
$gEmail = mysqli_real_escape_string($conn, $_POST['g_Email']);
$gWorkingHours = mysqli_real_escape_string($conn, $_POST['g_WorkingHours']);

$hTagline = trim($_POST['h_Tagline']);


if(mysqli_query($conn, "UPDATE `general_tb` SET g_Sitename='$gSiteName', g_Vision='$gVision', g_Contact='$gContact', g_Location='$gLocation', g_Email='$gEmail', g_WorkingHours='$gWorkingHours', h_Tagline='$hTagline' WHERE g_id='1'")) {
        echo 'success';
} 
else 
{
echo "Error: " . $sql . "" . mysqli_error($conn);
}

mysqli_close($conn);
?>
