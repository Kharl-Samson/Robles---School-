<?php
session_start();
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

     <link rel="stylesheet" href="css/Desktop/theme.css">

<?php
    $theme = $_SESSION['theme'];
    if ($theme == "default"){
?>  
    <link rel="stylesheet" href="css/Desktop/global.css">
<?php
    }
    else if($theme == "dark"){
?>
    <link rel="stylesheet" href="css/Desktop/globalDark.css">
<?php   
    }
    else if($theme == "light"){
?>
    <link rel="stylesheet" href="css/Desktop/globalLight.css">
<?php     
    }
    else{
?>
    <link rel="stylesheet" href="css/Desktop/global.css">
<?php
    }
?>

     <link rel="stylesheet" href="css/Mobile/global.css">


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

        <div id="adminLogin">

                <div id="right">

                    <div id="r1">
                        <img src="images/login_welcome.png">
                        <p>Login as a Admin User</p>
                    </div><!--End of r1 div-->
                    <form action="javascript:void(0)" method="post" id="ajax-form_admin_login">
                    <div id="inputs">
                       <input type="text" id="username_lA" placeholder="Username or Email" name="username_l" onkeyup="removeValidationAdminLogin()">
                       <div id="for_pass">
                         <img src="images/icons/show.gif" title="Show Password" id="hide_pass" onclick="togglePassword1()" class="inp_img">
                         <img  src="images/icons/hide.gif" title="Hide Password" id="show_pass" onclick="togglePassword1()" class="inp_img">
                         <input type="password" id="password_lA" placeholder="Password" name="password_l" onkeyup="removeValidationAdminLogin()">
                       </div>
                    </div><!--End of inputs div-->

                    <div id="keepMe_log">
                        <input type="checkbox" id="keep_logA">
                        <p>Remember me</p>
                    </div><!--End of keepMe_log div-->
                    <div id="validation" class="validation_forAdminLogin"><img src="images/icons/error_input.png"><span></span></div>

                   <!--Login submit button-->
                   <center><button  type="submit" id="login_submit" onclick="lsRememberMe1()">Login</button></center>
                </form>                 
                   <!--<p id="dont_have_acc">Don’t have an account yet? <b class="for_pointer" style="color:#17B6FE; text-decoration:underline;">Sign Up</b></p>-->
                   <p id="forgot_pass" class="for_pointer" onclick="showForgotAdmin()">Forgot my password?</p>

                   <div id="data_act">
                        <p><b style="color:#17B6FE;" title="See terms of service" class="for_pointer" id="terms_button">Terms of Service</b> and <b style="color:#17B6FE;" title="See privacy policy" class="for_pointer" id="privacy_button">Privacy Policy</b></p>
                   </div><!--End of data_act div-->

                </div>
        </div><!-- adminLogin -->

    </div><!--End of adminLogin_ContainerM div-->


    <!--Terms and privacy Container-->
    <div id="terms_privacy_container">

        <div id="terms">

            <img src="images/icons/close.png" id="close_terms" title="Close" onclick="closeTerms()">

            <div id="terms_content">
                 <p id="terms_header">Our Terms of Service</p>

                 <div id="terms_container">
                       <p id="welcome">Welcome to Robles Maternity Clinic!</p>
                       <p id="text1">This website provides you with clinic information and maternity services. We shall make every effort to ensure that the information on the Site is correct and up to date.</p>

                       <p id="text2">By accessing this website, you agree to the following terms and conditions:</p>

                       <li>You acknowledge that you have read and understood the terms and conditions. We have the right to revise these terms and conditions and privacy policy at any moment. We will do our utmost to notify you when there are significant changes. It is best to review our privacy policy and terms from time to time.</li>

                       <li>You acknowledge that if you are dissatisfied with this website, you are free to cease using it. Although Robles Maternity Clinic has made every effort to ensure the accuracy of the material on this website, we cannot guarantee its correctness, and it is offered without warranty or guarantee of any kind.</li>

                       <li>You acknowledge that we expressly disclaim any and all liability for any damages arising out of or in any way related to your use of the website.</li>

                       <li>You acknowledge and agree that your use of the website is at your own risk</li>

                       <p id="text2">For other complaints, concerns, and questions regarding the Terms and Privacy Policy, you can contact us:</p>

                       <li>You can call 0923 020 1174 or message the maternity clinic @ https://www.facebook.com/RmClinic2000</li>
                       <li>You can refer to the Contact/Inquiry page.</li>

                       <p id="text3">If your issues are not being addressed or if we are unable to resolve your issue, you have the option of filing a complaint with the National Privacy Commission.</p> 
                 </div><!--End of terms_container-->

            </div><!--End of terms_content div-->

            <div id="for_terms_btn">
                <button id="btn_accept_terms" onclick="closeTerms()">Accept</button>
                <button id="btn_cancel_terms" onclick="closeTerms()">Cancel</button>
            </div><!--end of for_terms_btn-->
               
        </div><!--End of terms div-->

    </div><!--End of terms_privacy_container div-->


    <!--Privacy policy Container-->
    <div id="privacy_policy_container">

        <div id="privacy">

            <img src="images/icons/close.png" id="close_privacy" title="Close" onclick="closePrivacy()">

            <div id="privacy_content">
                <p id="privacy_header">Our Privacy Policy</p>

                <div id="privacy_container">
                    <p id="welcome">Welcome to Robles Maternity Clinic!</p>

                    <p id="text1">Robles Maternity Clinic Website values and respects your right to privacy. </p>
                    <p id="text1">The website of Robles Maternity Clinic is committed to protecting user privacy. We will only collect, record, store, process, and use your personal information in accordance with the Data Privacy Act of 2012, its Implementing Rules and Regulations, the issuances by the National Privacy Commission, and other pertinent laws.</p>
                    <p id="text1">As a result, we would like to inform you regarding the way we would use your personal data. We will only use your information within the parameters set out in this policy.</p>
                    <p id="text1">We kindly recommend you to read the privacy policy so that you can understand our approach towards the use of your personal data.</p>
                    <p id="text1">By submitting your personal data to us, you will be treated as having given your permission where necessary and appropriate for disclosures referred to in this policy.</p>

                    <p id="text2">The following overview explains how we handle the personal information we collect from you when you visit our website.</p>

                    <p id="text4">Personal Information</p>

                    <p id="text1">In accordance with the Data Privacy Act of 2012, you have the following rights :</p>   
                    <p id="text1"><b>1. Right to be informed -</b>  this is your right to know the details as to how your personal information will be used by Robles Maternity Clinic.</p>
                    <p id="text1"><b>2. Right to access -</b> this is your right to reasonable access to your personal information. Upon written request, which may include the contents of your processed personal information, the method in which it was processed, the sources from which it was collected, the recipients, and the purpose for the disclosure.</p>
                    <p id="text1"><b>3. Right to object -</b> this is your right to withhold your consent, and the organization should no longer process or remove your personal information. </p>
                    <p id="text1"><b>4. Right to data erasure -</b> this is your right to remove or withdraw your personal information if it is unlawfully obtained, disclosed, etc.</p>
                    <p id="text1"><b>5. Right to damages -</b> this is your right to be compensated for any damages incurred as a result of a violation of your right to privacy resulting from false, incorrect, illegally obtained, or unauthorized use of your data</p>
                    <p id="text1"><b>6. Right to rectify -</b> this is your right to rectify inaccuracies in your personal information stored in the system through contacting the staff of Robles Maternity Clinic.</p>
                    <p id="text1"><b>7. Right to data portability -</b> this is your right to acquire your personal information from Robles Maternity Clinic in any platform in a secure manner.</p>
                    <p id="text1"><b>8. Right to file a complaint -</b> this is your right to file your complaint with Robles Maternity Clinic regarding your personal information.</p>

                    <p id="text4" style="margin-top: 5%;">What personal data do we collect from you?</p>
                    <p id="text1">On our website, Robles Maternity Clinic has online forms that may require personal information. For marketing or non-medical purposes, we will not disclose this information with other partners, affiliates, other individuals or organizations.</p>

                    <p id="text1">The doctors and midwives of Robles Maternity CLinic may document and utilize your personal and health information in order to provide you better and high-quality clinic services. </p>
    
                    <p id="text4" style="margin-top: 5%;">The following types of  data may be collected:</p>
    
                    <li>Basic Personal Information</li>
                    <li>Medical History (existing illness, medication intake)</li>
                    <li>EMR (Electronic Medical Records)</li>
                    <li>Relevant Contact Information</li>

                    <p id="text1">You may rest certain that these details are stored in a safe database.</p>

                    <p id="text4" style="margin-top: 5%;">What is the purpose of collecting your personal data?</p>
                    <li>For Admission and Medical Appointment</li>
                    <li>For Maternity Service/ Treatment</li>
                    <li>For Reporting Requirements (Health information may be disclosed with the Philippine Health Insurance Corporation, as stipulated by the law.)</li>
    
                    <p id="text4" style="margin-top: 5%;">Security of your Personal and Health Information</p>
                    <p id="text1">Robles Maternity Clinic ensures in protecting your privacy through implementing technical and security measures to prevent unauthorized access and disclosure of your information. We keep your personal information in compliance with the Department of Health's medical record retention rules and limits.</p>

                    <p id="text4" style="margin-top: 5%;">Who is in charge and responsible for all of the collected data?</p>
                    <p id="text1">All data gathered will be controlled by Robles Maternity Clinic, a maternity clinic located at Apalit City 2016, Pampanga, Philippines.</p>

                    <p id="text4" style="margin-top: 5%;">Cookies Policy</p>
                    <li>When you visit our website, we use cookies to collect information about your usage patterns.</li>
                    <li>Cookies are data packets transferred to a user's computer by a website for record-keeping purposes.</li>
                    <li>It is used to tailor your experience and to understand usage trends so that we can improve our services.</li>
                    <li style="margin-bottom:5%;">Website cookies are used on the Robles Maternity Clinic website. These are simply used to make our websites more user-friendly. On our website or database, we do not keep any personal information.</li>
                </div><!--End of privacy_container-->

            </div><!--End of privacy_content div-->

            <div id="for_privacy_btn">
                <button id="btn_accept_privacy" onclick="closePrivacy()">Accept</button>
                <button id="btn_cancel_privacy" onclick="closePrivacy()">Cancel</button>
            </div><!--end of for_privacy_btn-->

        </div><!--End of privacy div-->

    </div><!--End of privacy_policy_container-->


 <!--Forgot Password-->
 <form action="javascript:void(0)" method="post" id="ajax-form_admin_forgot">
    <div id="forgotPass_Container">
        <div id="forgotPass"> 
           <img src="images/icons/close.png" id="close_forgot_btn"  title="Close" onclick="closeForgot()">
             
             <div id="p1"><img src="images/icons/padlock.png" id="padlock_img"></div>

             <p id="p2">Recover Password</p>
             <p id="p3">Don’t worry, happens to the best of us.</p>

             <div id="forgot_form">
                 <p>Enter your email or username</p>
                 <input type="text" placeholder="Ex. Juandelacruz@gmail.com" id="recovery_email" name="recovery_email">
             </div>

             <div id="validationRecover"><img src="images/icons/error_input.png"><span>All fields required</span></div>
             <center><button id="forgot_submit">Email me a verification code</button></center>
        </div><!--End of forgotPass div-->
    </div><!--End of forgotPass_Container div-->
    </form>
<!--Validation-->
<div id="validation_forgotPass">
     <div class="left">
         <img src="" alt="" id="validationForgot_img">
     </div>
     <div class="center">
         <p id="text_validationHeader"></p>
         <p id="text_validationContent"></p>
     </div>
     <div class="right">  <p id="close_validationPass" onclick="close_alertForgot()">OK</p>   </div>
</div>


    <div id="authenticator_container">
       <div id="back_auth" onclick="back_auth()">
            <img src="images/back_auth.png">
            Back
       </div> 

        <img src="images/lock_authenticator.png" id="lock"> 
        <p id="a">Enter Company Code</p>
        <p id="b">You were accessing a private content. Enter the company code to go to the next process.</p>
        <div id="for_inp5">
            <input type="password" placeholder="-" maxlength="1" class="input_auth input_auth1">
            <input type="password" placeholder="-" maxlength="1" class="input_auth input_auth2">
            <input type="password" placeholder="-" maxlength="1" class="input_auth input_auth3">
            <input type="password" placeholder="-" maxlength="1" class="input_auth input_auth4">
            <input type="password" placeholder="-" maxlength="1" class="input_auth input_auth5">
            <input type="password" placeholder="-" maxlength="1" class="input_auth input_auth6">
        </div>
        <p id="b">This tab will automatically shutdown in <u><span id="auth_timer">30</span> seconds</u></p>
        
        <input type="hidden" id="comp_codeDis" value="<?php echo $row_g['companyCode']; ?>">
        <input type="hidden" id="final_inp">
    </div>

    <div id="slider_Captcha">
        <div class="container-fluid">
            <div class="form-row">
                <div class="col-12">
                    <div class="slidercaptcha card">
                        <div class="card-header">
                            <span>Complete the security check</span>
                        </div>
                        <div class="card-body">
                            <div id="captcha"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- loading for emails-->
<div id="loading_succes">
        <div id="cont">
             <p>The information is processing....</p>
             <img src="images/gif/loading.gif" alt="">
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


<!-- Jquery for hamburger menu-->
<script src="jquery/hamburgerMenu.js"></script>
<!-- Jquery for tooltips-->
<script src="jquery/tooltip.js"></script>
<!-- Jquery for termsAndprivacy-->
<script src="jquery/termsAndprivacy.js"></script>


<script src="disk/longbow.slidercaptcha.min.js"></script>
<script>
        var captcha = sliderCaptcha({
            id: 'captcha',
            repeatIcon: 'fa fa-redo',
            onSuccess: function () {
                var handler = setTimeout(function () {
                    window.clearTimeout(handler);
                    captcha.reset();
                    document.getElementById("slider_Captcha").style.display = "none";
                    document.getElementById("authenticator_container").style.display = "none";
                }, 500);
            }
        });
</script>