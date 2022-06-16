<?php
session_start();
$_SESSION['theme'] = "dark";
echo "<script>history.back()</script>";
exit();
?>