<?php
session_start();
require_once "Z-connection.php";
$quote= mysqli_real_escape_string($conn, $_POST['key_allQuote']);
$quotedBy= mysqli_real_escape_string($conn, $_POST['key_allQuotedBy']);
$e_content = trim($_POST['e_content']);

if(mysqli_query($conn, "UPDATE `general_tb` SET e_content='$e_content' , e_staffQuoute='$quote', e_staffQuoteBy='$quotedBy' WHERE g_id='1'")) {
    echo 'success';
} 
else 
{
echo "Error: " . $sql . "" . mysqli_error($conn);
}


mysqli_close($conn);
?>