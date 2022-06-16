<?php
session_start();
require_once "Z-connection.php";
//image uploading
if($_FILES['file-input']['name']){
    move_uploaded_file($_FILES['file-input']['tmp_name'], "upload_img/".$_FILES['file-input']['name']);
    $img = $_FILES['file-input']['name'];
}
?>
