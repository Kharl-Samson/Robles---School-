<?php
session_start();
$_SESSION['theme'] = "light";
echo "<script>history.back()</script>";
exit();
?>