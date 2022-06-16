<?php
session_start();
require_once "Z-connection.php";
$id = mysqli_real_escape_string($conn, $_POST['secrect_id1']);
//image uploading
if($_FILES['file-input']['name']){
    move_uploaded_file($_FILES['file-input']['tmp_name'], "upload_img/".$_FILES['file-input']['name']);
    $img = $_FILES['file-input']['name'];
    }
    $sql = "UPDATE `patientinfo_db` SET profile_photo='$img' WHERE id='$id'";
    $results=mysqli_query($conn, $sql);
 
mysqli_query($conn, $sql);
?>
