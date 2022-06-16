<?php
session_start();
    //estalishing connection to database 
    require_once "Z-connection.php";
    date_default_timezone_set('Asia/Manila');
      //declaring variables and gettin the value of input
      $id = mysqli_real_escape_string($conn, $_POST['key_Id_Sc_edit']);
      $sched = mysqli_real_escape_string($conn, $_POST['key_sched_edit']);


        //connection to server to update
        $sqli = "UPDATE `staff_db` SET schedule='$sched' WHERE id='$id'";
        $results=mysqli_query($conn, $sqli);

            if($results)
            {
                $_SESSION["user_active"] = $username;

$key_nameAudit = $_SESSION["auditname"];
$dateTodayAudit = date("Y-m-d");
$timeAudit = date("h:i A");
$dateTimeAudit = $dateTodayAudit." ".$timeAudit;
$descriptionAudit = $key_nameAudit." edited a staff schedule.";

mysqli_query($conn, "INSERT INTO audit_tb (date, name, description) VALUES('".$dateTimeAudit."', '".$key_nameAudit."', '".$descriptionAudit."')");
                echo "success";
            }
      
    mysqli_close($conn);

?>