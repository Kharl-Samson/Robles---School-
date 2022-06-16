<?php
session_start();
unset($_SESSION['patient_active']);
header("Location: index.php");
exit();
?>