<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;

require_once 'vendor/autoload.php';
require_once 'class-db.php';

date_default_timezone_set('Asia/Manila');
require_once "Z-connection.php";

$email1 = mysqli_real_escape_string($conn, $_POST['email']);
$code = mysqli_real_escape_string($conn, $_POST['verification_email']);
$SixDigitRandomNumber = mt_rand(100000,999999);
$newTime = date("Y-m-d H:i",strtotime(date("Y-m-d H:i")." +10 minutes"));


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
$mail->addAddress($email1,'RECIPIENT_NAME');
$mail->isHTML(true);
$mail->Subject = 'Verification Code';


//checking if email already exist
$s_email = "SELECT * FROM `appoinment_verification_tb` WHERE email='$email1'";
$result_email = mysqli_query($conn, $s_email);
$num_email = mysqli_num_rows($result_email); 

if($num_email != 0){
    $sqli = "UPDATE `appoinment_verification_tb` SET code ='$SixDigitRandomNumber', time_expire='$newTime' WHERE email='$email1'";
    $results=mysqli_query($conn, $sqli);

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

<p style="font-size:2vh;margin:0%; font-weight:bold;text-align:center;">Hi! Please use the verification code</p>
<p style="font-size:2vh;margin:0%; font-weight:bold;text-align:center;">for your apointment form:</p><br>

<div style="margin:0% auto; background-color:#97C3F9; width:45%; padding:2% 0%;border-radius:10px;">
<p style="text-align:center;font-size:2vh; font-weight:bold;margin:0%;">Verification Code:</p>
<p style="text-align:center;font-size:4vh; font-weight:bold;letter-spacing: 5px;margin:0%;">'.$SixDigitRandomNumber.'</p>
<p style="text-align:center;font-size:2vh;margin:0%;color:white;">(This code will expire in 10 minutes)</p>
</div><br>
<p style="font-size:2vh;margin:0%; font-weight:bold;text-align:center;">All you have to do is copy the confirmation code and paste it</p>
<p style="font-size:2vh;margin:0%; font-weight:bold;text-align:center;">your form to complete the email verification process.</p><br>

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
}
else{
    //connection to server to update
    $sqli1 = "INSERT INTO appoinment_verification_tb (email, code, time_expire) VALUES('" . $email1 . "', '" . 
    $SixDigitRandomNumber. "', '" . $newTime. "')";
    $results=mysqli_query($conn, $sqli1);   
    
    echo "success";
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

<p style="font-size:2vh;margin:0%; font-weight:bold;text-align:center;">Hi! Please use the verification code</p>
<p style="font-size:2vh;margin:0%; font-weight:bold;text-align:center;">for your apointment form:</p><br>

<div style="margin:0% auto; background-color:#97C3F9; width:45%; padding:2% 0%;border-radius:10px;">
<p style="text-align:center;font-size:2vh; font-weight:bold;margin:0%;">Verification Code:</p>
<p style="text-align:center;font-size:4vh; font-weight:bold;letter-spacing: 5px;margin:0%;">'.$SixDigitRandomNumber.'</p>
<p style="text-align:center;font-size:2vh;margin:0%;color:white;">(This code will expire in 10 minutes)</p>
</div><br>
<p style="font-size:2vh;margin:0%; font-weight:bold;text-align:center;">All you have to do is copy the confirmation code and paste it</p>
<p style="font-size:2vh;margin:0%; font-weight:bold;text-align:center;">your form to complete the email verification process.</p><br><br><br><br>

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
}



//send the message, check for errors
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo.$email1;
} else {
    echo 'Message sent!';
}

?>