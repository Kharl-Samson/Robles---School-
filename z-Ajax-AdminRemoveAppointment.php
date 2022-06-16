<?php
session_start();
    //estalishing connection to database 
    require_once "Z-connection.php";
    $id = mysqli_real_escape_string($conn, $_POST['key_removeApp']);
    $stat = "on";

    $sql = "UPDATE `acceptedappointment_tb` SET archive='$stat' WHERE id='$id'";
    $results=mysqli_query($conn, $sql);

$key_nameAudit =$_SESSION["auditname"];
$dateTodayAudit = date("Y-m-d");
$timeAudit = date("h:i A");
$dateTimeAudit = $dateTodayAudit." ".$timeAudit;
$descriptionAudit = $key_nameAudit." moved appointment to archive.";

mysqli_query($conn, "INSERT INTO audit_tb (date, name, description) VALUES('".$dateTimeAudit."', '".$key_nameAudit."', '".$descriptionAudit."')");
    if($results)
    {
        echo "success";
    }
    else{
        echo "failed";
     }

    mysqli_close($conn);

?>