<?php
session_start();
date_default_timezone_set('Asia/Manila');
require_once "Z-connection.php";
$doctor = mysqli_real_escape_string($conn, $_POST['doctor_report']);
$mw1 = mysqli_real_escape_string($conn, $_POST['mw1']);
$mw2 = mysqli_real_escape_string($conn, $_POST['mw2']);
$date = mysqli_real_escape_string($conn, $_POST['date_report']);
$bp = mysqli_real_escape_string($conn, $_POST['bp_report']);
$prescribe = trim($_POST['pm_report']);
$diagnostic = trim($_POST['d_report']);
$service = mysqli_real_escape_string($conn, $_POST['select_service']);


$name = mysqli_real_escape_string($conn, $_POST['patient_name_key']);
$img = mysqli_real_escape_string($conn, $_POST['patient_img_key']);
$id = mysqli_real_escape_string($conn, $_POST['patient_id_key']);
$time = date("h:i A");

if(mysqli_query($conn, "INSERT INTO `doctorreport_tb` (`patient_id`, `doctor`, `mw1`, `mw2`, `date`, `bp`, `prescribe`, `diagnostic`, `img`, `name`, `time` , `service`) VALUES('" . $id . "', '" . $doctor . "', '" . $mw1 . "', '" . $mw2 . "' , '" . $date . "', '" . $bp . "' , '" . $prescribe . "' , '" . $diagnostic . "' , '" . $img . "', '" . $name . "', '" . $time . "' , '" . $service . "')")) {
echo 'success';

$key_nameAudit = $_SESSION["auditname"];
$dateTodayAudit = date("Y-m-d");
$timeAudit = date("h:i A");
$dateTimeAudit = $dateTodayAudit." ".$timeAudit;
$descriptionAudit = $key_nameAudit." made a patient report.";

mysqli_query($conn, "INSERT INTO audit_tb (date, name, description) VALUES('".$dateTimeAudit."', '".$key_nameAudit."', '".$descriptionAudit."')");
} 
else {
    echo 'failed';
}
mysqli_close($conn);
?>