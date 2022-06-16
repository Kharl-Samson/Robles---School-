<?php
session_start();
$_SESSION['theme'] = "default";
echo "<script>history.back()</script>";
exit();
?>