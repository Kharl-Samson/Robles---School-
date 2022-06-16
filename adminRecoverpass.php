<?php
$value = $_GET['key'];
require 'php/generic.php';
$row_g = mysqli_fetch_array($search_general);
$rowName = explode(" ",$row_g['g_Sitename']);
$rowNameFirst = $rowName[0];
array_shift($rowName);
$rowSecondName = implode(" ",$rowName);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <title><?php echo $row_g['g_Sitename']; ?></title>

     <link rel="stylesheet" href="css/Desktop/global.css">
     <link rel="stylesheet" href="css/Mobile/global.css">

     <link rel="stylesheet" href="css/Desktop/adminLogin.css">
     <link rel="stylesheet" href="css/Mobile/adminLogin.css">
     <link rel="shortcut icon" type="image/png" href="upload_img_generic/<?php echo $row_g['g_LogoDark']; ?>"> 

     <link rel="stylesheet" href="AnimBackend/jquery.css">
     <script src="AnimBackend/jquery.js"></script>
     <script src="AnimBackend/jquery1.js"></script>

     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="disk/slidercaptcha.min.css" rel="stylesheet" />
  </head>

<body>

<div class="for_desktop"><!--For Descktop div-->
    <div id="adminLogin_ContainerM">
        <div id="adminLogin" style="height:auto;width:40%; padding:3% 0%;">

                <div id="right">

                    <div id="r1">
                        <img src="images/login_welcome.png">
                        <p>Reset Password</p>
                    </div><!--End of r1 div-->
                    <form action="javascript:void(0)" method="post" id="ajax-form_admin_recoverBackend">
           
                    <div id="inputs">
                        <label style="padding-left:5%;margin-top:2%;width:100%;text-align:left; font-size:2vh; font-family: 'Poppins', sans-serif;">New Password</label>
                       <div id="for_pass">
                         <img src="images/icons/show.gif" title="Show Password" id="hide_pass" onclick="togglePassword1()" class="inp_img">
                         <img src="images/icons/hide.gif" title="Hide Password" id="show_pass" onclick="togglePassword1()" class="inp_img">
                         <input type="password" id="password_l" placeholder="Password" name="password_l" onclick="removeValidationPatientPass()">
                       </div>


                    <label style="padding-left:5%;margin-top:5%;width:100%;text-align:left; font-size:2vh; font-family: 'Poppins', sans-serif;">Confirm New Password</label>
                       <div id="for_pass">
                         <img src="images/icons/show.gif" title="Show Password" id="hide_pass1" onclick="togglePassword2()" class="inp_img">
                         <img style="display:none;" src="images/icons/hide.gif" title="Hide Password" id="show_pass1" onclick="togglePassword2()" class="inp_img">
                         <input type="password" id="password_l1" placeholder="Password" name="password_l1" onclick="removeValidationPatientPass()">
                       </div>
                    </div><!--End of inputs div-->
   
                    <div id="validation" class="validation_forRecoverpass"><img src="images/icons/error_input.png"><span></span></div>

                    <input type="hidden" value="<?php echo $value;?>" name="hidden_email">
                   <!--Login submit button-->
                   <center><button  type="submit" id="login_submit" style="margin-top:1%;">Reset Password</button></center>
                </form>                 
               
                </div>
        </div><!-- adminLogin -->

    </div><!--End of adminLogin_ContainerM div-->


<!--Sweetalert-->
<div id="sweetalert_container">
    <div id="succes_alert">
        <div id="alert_div">
        <img src="images/gif/succes.gif" id="gif_alert">
        <p id="thankyou" class="header_text_validation_appointment">Success</p>
        <p class="message_alert">You password has succesfully changed!</p>
        <button id="close_alert" onclick="updatePass()">OK</button>
        </div>
    </div>
</div>  


</div><!--End of for_desktop div -->



<!------------------------------------------------------------------------------------------------------------->




</body>

</html>

<script src="js/YouShallPass.js"></script>
<!--Script for password-->
<script src="js/password.js"></script>
<!--Script for login-->
<script src="js/login.js"></script>


<script src="ajax/adminLogin.js"></script>

<!-- Jquery for tooltips-->
<script src="jquery/tooltip.js"></script>
<!-- Jquery for termsAndprivacy-->
<script src="jquery/termsAndprivacy.js"></script>



<script>
function togglePassword1(){
  var x = document.getElementById("password_l");
  if (x.type === "password") {
    document.getElementById("show_pass").style.display = "inline";
    document.getElementById("hide_pass").style.display = "none";
    x.type = "text";
  } else {
    document.getElementById("show_pass").style.display = "none";
                          document.getElementById("hide_pass").style.display = "inline";
  x.type = "password";
  }
}
function togglePassword2(){
  var x = document.getElementById("password_l1");
  if (x.type === "password") {
    document.getElementById("show_pass1").style.display = "inline";
    document.getElementById("hide_pass1").style.display = "none";
    x.type = "text";
  } else {
    document.getElementById("show_pass1").style.display = "none";
    document.getElementById("hide_pass1").style.display = "inline";
  x.type = "password";
  }
}
function removeValidationPatientPass(){
  document.querySelector('.validation_forRecoverpass').style.visibility="hidden";
}
function updatePass(){
  window.location.replace("adminLogin.php");
}
</script>