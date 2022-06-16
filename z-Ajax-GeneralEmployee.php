<?php
session_start();
require_once "Z-connection.php";
$key_allemp= mysqli_real_escape_string($conn, $_POST['key_allemp']);

for($x = 0 ; $x<100 ; $x++){
    if($_FILES["file-imgEmp$x"]["name"] != '')
    {
        move_uploaded_file($_FILES["file-imgEmp$x"]['tmp_name'], "upload_img_generic/".$_FILES["file-imgEmp$x"]['name']);
        $img = $_FILES["file-imgEmp$x"]['name'];
    }
}

mysqli_close($conn);
?>


