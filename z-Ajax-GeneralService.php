<?php
session_start();
require_once "Z-connection.php";

for($x = 0 ; $x<100 ; $x++){
    if($_FILES["file-imgServ$x"]["name"] != '')
    {
        move_uploaded_file($_FILES["file-imgServ$x"]['tmp_name'], "images/services/".$_FILES["file-imgServ$x"]['name']);
        $img = $_FILES["file-imgServ$x"]['name'];
    }
}

mysqli_close($conn);
?>


