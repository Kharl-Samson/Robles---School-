<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;

require_once 'vendor/autoload.php';
require_once 'class-db.php';

session_start();
date_default_timezone_set('Asia/Manila');
require_once "Z-connection.php";

$fname = mysqli_real_escape_string($conn, $_POST['accept_fname']);
$mname = mysqli_real_escape_string($conn, $_POST['accept_mname']);
$lname = mysqli_real_escape_string($conn, $_POST['accept_lname']);
$address = mysqli_real_escape_string($conn, $_POST['accept_address']);
$email1 = mysqli_real_escape_string($conn, $_POST['accept_email']);
$phone = mysqli_real_escape_string($conn, $_POST['accept_phone']);
$date = mysqli_real_escape_string($conn, $_POST['accept_date']);
$time = mysqli_real_escape_string($conn, $_POST['accept_time']);
$status = "Accepted";
$id = mysqli_real_escape_string($conn, $_POST['accept_id']);
$service = mysqli_real_escape_string($conn, $_POST['accept_service']);
$archive = "off";

 
$sql = "DELETE FROM `pendingappointment_tb` WHERE email='$email1'";
$results=mysqli_query($conn, $sql);

mysqli_query($conn, "INSERT INTO acceptedappointment_tb (patient_id, fname, mname, lname, address, contact, email, date, time, status, archive,service) VALUES('".$id."', '" . $fname . "', '" . $mname . "', '" . $lname . "', '" . $address . "' , '" . $phone . "', '" . $email1 . "', '" . $date . "', '" . $time . "', '" . $status . "' , '" . $archive . "' , '" . $service . "')");

$key_nameAudit =$_SESSION["auditname"];
$dateTodayAudit = date("Y-m-d");
$timeAudit = date("h:i A");
$dateTimeAudit = $dateTodayAudit." ".$timeAudit;
$descriptionAudit = $key_nameAudit." accepted an appointment.";

mysqli_query($conn, "INSERT INTO audit_tb (date, name, description) VALUES('".$dateTimeAudit."', '".$key_nameAudit."', '".$descriptionAudit."')");

$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465;
 
//Set the encryption mechanism to use:
// - SMTPS (implicit TLS on port 465) or
// - STARTTLS (explicit TLS on port 587)
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
 
$mail->SMTPAuth = true;
$mail->AuthType = 'XOAUTH2';
 
$mail->AddEmbeddedImage('images/icons/webIconWhite.png', 'img_logo');
$mail->AddEmbeddedImage('images/icons/robles_text.png', 'img_text');
$mail->AddEmbeddedImage('images/email_banner.png', 'img_banner');

$email = 'roblesmaternityclinic@gmail.com'; // the email used to register google app
$clientId = '906910378443-kosct6rvnbijn6s50bj9mi5h8gj17jnl.apps.googleusercontent.com';
$clientSecret = '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';
 
$db = new DB();
$refreshToken = $db->get_refersh_token();
 
//Create a new OAuth2 provider instance
$provider = new Google(
    [
        'clientId' => $clientId,
        'clientSecret' => $clientSecret,
    ]
);
 
//Pass the OAuth provider instance to PHPMailer
$mail->setOAuth(
    new OAuth(
        [
            'provider' => $provider,
            'clientId' => $clientId,
            'clientSecret' => $clientSecret,
            'refreshToken' => $refreshToken,
            'userName' => $email,
        ]
    )
);
 
$mail->setFrom($email, 'Robles Maternity Clinic');
$mail->addAddress($email1);
$mail->isHTML(true);
$mail->Subject = 'Appointment';
$mail->Body = '<div style="background-color:#93C1F9;
height:auto;
margin: 0% auto;
width:70%;
padding: 1.5% 0%;">

<center>
<img src="cid:img_logo" style="
margin-top:1%s;
height: 8vh;
width: auto;">
</center>

<center>                                
<img src="cid:img_text" style="
height: 6vh;
width: auto;">
</center>             
</div>

<center>
<img src="cid:img_banner" style="
height: auto;
width: 70%;">
</center>

<div style="background-color:#F2F2F2;
height:auto;
margin: 0% auto;
width:60%;
padding: 1.5% 5%;"><br><br>

<b style=" font-size:2.3vh;">To Mrs/Ms. '.$fname.' '.$lname.',</b> <br><br><br>

<span style="font-size:2vh; ">Congratulations, <br><br><br>
Your appointment at Robles Maternity Clinic has been scheduled on ' .$date.' at '.$time.'. We look forward to seeing you soon!</span> <br><br><br>

<span style="font-size:2vh; ">If you need to cancel or reschedule please reply to this email.</span> <br><br><br>

<p style="font-size:2vh;margin:0%;">For futher assistance, you may reach us via: </p>
<p style="font-size:2vh;margin:0%;">Fb Messenger : <a href="https://www.facebook.com/messages/t/100050629491641" style="text-decoration:underline; color:#7D8790;">Fb.com/RmClinic2000</a> </p>
<p style="font-size:2vh;margin:0%;">Email : <a href="mailto:roblesmaternityclinic@gmail.com" style="text-decoration:underline; color:#7D8790;">roblesmaternityclinic@gmail.com</a></p>
<p style="font-size:2vh;margin:0%;">Contact No. : <a href="tel:+639230201174" style="text-decoration:underline; color:#7D8790;">+639230201174</a></p>
<p style="font-size:2vh;margin:0%;">Website : <a href="https://roblesmaternityclinic.000webhostapp.com/Robles" style="text-decoration:underline; color:#7D8790;">www.roblesmaternityclinic.com</a></p><br><br><br>

<p style="font-size:2vh;margin:0%;">Have a nice day,</p>
<p style="font-size:2vh;margin:0%;">From Robles Maternity Clinic</p><br>

</div>

<div style="background-color:#93C1F9;
height:auto;
margin: 0% auto;
width:70%;
padding: 1.5% 0%;">

<center>
<p style="font-size:2vh;margin:0% 5%;color:white;">&copy; Robles Maternity Clinic  2021. All rights reserved</p>
</center>
</div>';
 
//send the message, check for errors
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message sent!';
}

?>