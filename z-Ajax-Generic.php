<?php
session_start();
require_once "Z-connection.php";
//image file is uploading
if($_FILES["img_light_v"]["name"] != '')
{
 $test = explode('.', $_FILES["img_light_v"]["name"]);
 $ext = end($test);
 $name = rand(100, 999) .'.'.$ext;
 $location = 'upload_img_generic/'.$name;  
 move_uploaded_file($_FILES["img_light_v"]["tmp_name"], $location);
 $results=mysqli_query($conn,"UPDATE `general_tb` SET g_LogoLight='$name' WHERE g_id='1'");
}

if($_FILES["img_dark_v"]["name"] != '')
{
 $test = explode('.', $_FILES["img_dark_v"]["name"]);
 $ext = end($test);
 $name = rand(100, 999) .'.'.$ext;
 $location = 'upload_img_generic/'.$name;  
 move_uploaded_file($_FILES["img_dark_v"]["tmp_name"], $location);
 $results=mysqli_query($conn, "UPDATE `general_tb` SET g_LogoDark='$name' WHERE g_id='1'");
}

if($_FILES["img_hLayout"]["name"] != '')
{
 $test = explode('.', $_FILES["img_hLayout"]["name"]);
 $ext = end($test);
 $name = rand(100, 999) .'.'.$ext;
 $location = 'upload_img_generic/'.$name;  
 move_uploaded_file($_FILES["img_hLayout"]["tmp_name"], $location);
 $results=mysqli_query($conn, "UPDATE `general_tb` SET h_Layoutimg='$name' WHERE g_id='1'");
}

if($_FILES["file-imgSl1"]["name"] != '')
{
 $test = explode('.', $_FILES["file-imgSl1"]["name"]);
 $ext = end($test);
 $name = rand(100, 999) .'.'.$ext;
 $location = 'upload_img_generic/'.$name;  
 move_uploaded_file($_FILES["file-imgSl1"]["tmp_name"], $location);
 $results=mysqli_query($conn, "UPDATE `general_tb` SET h_slide1='$name' WHERE g_id='1'");
}

if($_FILES["file-imgSl2"]["name"] != '')
{
 $test = explode('.', $_FILES["file-imgSl2"]["name"]);
 $ext = end($test);
 $name = rand(100, 999) .'.'.$ext;
 $location = 'upload_img_generic/'.$name;  
 move_uploaded_file($_FILES["file-imgSl2"]["tmp_name"], $location);
 $results=mysqli_query($conn, "UPDATE `general_tb` SET h_slide2='$name' WHERE g_id='1'");
}

if($_FILES["file-imgSl3"]["name"] != '')
{
 $test = explode('.', $_FILES["file-imgSl3"]["name"]);
 $ext = end($test);
 $name = rand(100, 999) .'.'.$ext;
 $location = 'upload_img_generic/'.$name;  
 move_uploaded_file($_FILES["file-imgSl3"]["tmp_name"], $location);
 $results=mysqli_query($conn, "UPDATE `general_tb` SET h_slide3='$name' WHERE g_id='1'");
}

if($_FILES["file-imgAli"]["name"] != '')
{
 $test = explode('.', $_FILES["file-imgAli"]["name"]);
 $ext = end($test);
 $name = rand(100, 999) .'.'.$ext;
 $location = 'upload_img_generic/'.$name;  
 move_uploaded_file($_FILES["file-imgAli"]["tmp_name"], $location);
 $results=mysqli_query($conn, "UPDATE `general_tb` SET a_layoutimg='$name' WHERE g_id='1'");
}




mysqli_close($conn);
?>


