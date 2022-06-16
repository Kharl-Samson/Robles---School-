<?php
session_start();
    //estalishing connection to database 
    require_once "Z-connection.php";
    $cb = $_POST['each_cb'];

    $sql = "UPDATE `inquiry_tb` SET archive ='off' WHERE id IN (".implode(",", $cb ) . ")";
    $results=mysqli_query($conn, $sql);
    if($results)
    {
        echo "success";
    }
    else{
        echo "failed";
     }

    mysqli_close($conn);

?>