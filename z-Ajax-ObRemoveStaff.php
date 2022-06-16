<?php
session_start();
date_default_timezone_set('Asia/Manila');
    //estalishing connection to database 
    require_once "Z-connection.php";
    $id = mysqli_real_escape_string($conn, $_POST['key_empRemove']);
    $day = date('Y-m-d');

    $sqli = "UPDATE `staff_db` SET status ='Inactive', date_end ='$day' WHERE id='$id'";
    $results=mysqli_query($conn, $sqli);

    if($results)
    {
echo "success";
$key_nameAudit = $_SESSION["auditname"];
$dateTodayAudit = date("Y-m-d");
$timeAudit = date("h:i A");
$dateTimeAudit = $dateTodayAudit." ".$timeAudit;
$descriptionAudit = $key_nameAudit." removed a staff.";

mysqli_query($conn, "INSERT INTO audit_tb (date, name, description) VALUES('".$dateTimeAudit."', '".$key_nameAudit."', '".$descriptionAudit."')");
    }

    mysqli_close($conn);

?>