<?php
     session_start();
     $key = $_GET["key"];
     $_SESSION['patient_edit_view'] = $key;
     echo "success"
?>