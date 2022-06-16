<?php
session_start();
require 'php/generic.php';
require_once "Z-connection.php";
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
        <link rel="stylesheet" href="css/Desktop/index.css">
    <?php
        }
        else if($theme == "dark"){
    ?>
        <link rel="stylesheet" href="css/Desktop/globalDark.css">
        <link rel="stylesheet" href="css/Desktop/indexDark.css">
    <?php   
        }
        else if($theme == "light"){
    ?>
        <link rel="stylesheet" href="css/Desktop/globalLight.css">
        <link rel="stylesheet" href="css/Desktop/indexLight.css">
    <?php     
        }
        else{
    ?>
        <link rel="stylesheet" href="css/Desktop/global.css">
        <link rel="stylesheet" href="css/Desktop/index.css">
    <?php
        }
    ?>


     <link rel="stylesheet" href="css/Mobile/global.css">
     <link rel="stylesheet" href="css/Mobile/index.css">
     <link rel="shortcut icon" type="image/png" href="upload_img_generic/<?php echo $row_g['g_LogoDark']; ?>"> 
     <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

     <link rel="stylesheet" href="AnimBackend/jquery.css">
     <script src="AnimBackend/jquery.js"></script>
     <script src="AnimBackend/jquery1.js"></script>
   

  </head>

<body>
<!-- Messenger Chat Plugin Code -->
<div id="fb-root"></div>

<!-- Your Chat Plugin code -->
<div id="fb-customer-chat" class="fb-customerchat">
</div>

<script>
  var chatbox = document.getElementById('fb-customer-chat');
  chatbox.setAttribute("page_id", "105418682035506");
  chatbox.setAttribute("attribution", "biz_inbox");
</script>

<!-- Your SDK code -->
<script>
  window.fbAsyncInit = function() {
    FB.init({
      xfbml            : true,
      version          : 'v12.0'
    });
  };

  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
</script>



<div id="for_codeUpdater" style="opacity:0%; position:fixed; inset:0; z-index:-40;">
<?php
    date_default_timezone_set('Asia/Manila');
    $TimeX = date("Y-m-d H:i");
    mysqli_query($conn, "DELETE FROM `appoinment_verification_tb` WHERE time_expire<='$TimeX' ");
?>
</div>
<script>
setInterval(function(){
    $("#for_codeUpdater").load(window.location + " #for_codeUpdater");
}, 100);
</script>

<div class="for_desktop"><!--For Descktop div-->

    <div id="up">
        <div id="header" class="navbar_header">
            <div class="one">
                <img src="upload_img_generic/<?php echo $row_g['g_LogoLight']; ?>" id="img1" onclick="goHome()" class="logo_top">   
                <script src="js/redirectPage.js"></script>
                    <div>
                        <p class="a p_title" style="margin-top:10%; text-transform:uppercase;"><?php echo $rowNameFirst; ?></p>
                        <P class="b p_title" style="text-transform:uppercase;"><?php echo $rowSecondName; ?></P>
                    </div>
            </div>

            <div class="two">
                    <a href="index.php" style="color:#929292;" class="navbar_a navbar_a_active">Home</a>
                    <a href="appointment.php" class="navbar_a">Appointment</a>
                    <a href="services.php" class="navbar_a">Services</a>
                    <a href="employee.php" class="navbar_a">Employees</a>
                    <a href="inquiry.php" class="navbar_a">Inquiry</a>
                    <a href="about.php" class="navbar_a">About Us</a>         
            </div>

            <div class="three">
                    <button id="login_btn" onclick="showLogin()">Log In</button>
                    <!--<button id="register_btn" title="Create account">Register</button>-->
            </div>

        </div><!--End of header div-->


        <div id="content">
                <div id="left" class="left_content_index">
                    <p class="ourVision">Welcome to</p>
                    <p class="ourVision1" style="text-transform:Capitalize;"><?php echo $rowNameFirst; ?></p>
                    <p class="ourVision2" style="text-transform:Capitalize;"><?php echo $rowSecondName; ?></p>
                    <p id="text" class="visionText"><?php echo $row_g['h_Tagline']; ?></p>

                    <button id="appointment_btn">Book an Appointment</button>
                    <script>
                        document.querySelector("#appointment_btn").onclick = function() {
                             window.location.href = "appointment.php";
                        };
                    </script>
                </div>

                <div id="right">
                    <img src="upload_img_generic/<?php echo $row_g['h_Layoutimg']; ?>" id="index_right_img">
                </div>
                
        </div><!--End of content div-->
        
    </div><!--End of up div-->

 

    <div id="sub_content">
            <p id="Ourbest">Our Best Services</p>

            <div id="best_ser_content"  data-aos="fade-up-right" data-aos-duration="500">
                <div class="box" onclick="goService()">
                    <img src="images/pt_index.png">
                    Pregnancy Test
                </div>
                <div class="box"  data-aos="fade-up-right" data-aos-duration="500" onclick="goService()">
                    <img src="images/pn_index.png">
                    Pre-natal Checkup
                </div>
                <div class="box" data-aos="fade-up-left" data-aos-duration="500" onclick="goService()">
                    <img src="images/post_index.png">
                    Post-natal Checkup
                </div>
                <div class="box" data-aos="fade-up-left" data-aos-duration="500" onclick="goService()">
                    <img src="images/fp_index.png">
                    Family Planning
                </div>
            </div>
    </div>

    <div id="sub_content_1">
        <div id="left" data-aos="zoom-in-down" data-aos-duration="500" class="slideshow">
            <div id="carousel_container" data-aos="fade-right" data-aos-duration="500">
                <img src="upload_img_generic/<?php echo $row_g['h_slide1']; ?>" alt="">
            </div>
            <div id="carousel_container" data-aos="fade-right" data-aos-duration="500">
                <img src="upload_img_generic/<?php echo $row_g['h_slide2']; ?>" alt="">
            </div>
            <div id="carousel_container" data-aos="fade-right" data-aos-duration="500">
                <img src="upload_img_generic/<?php echo $row_g['h_slide3']; ?>" alt="">
            </div>
        </div>

        <div id="right">
            <p id="vision_header">Our Vision</p>
            <p id="vision_content"><?php echo $row_g['g_Vision']; ?></p>
        </div>
    </div>

    <div id="getInTouch">
        <div id="top">
            <p id="a">GET IN TOUCH</p>
            <P id="b">Contact</P>
        </div>

        <div id="bot">
            <div class="box" data-aos="zoom-in" data-aos-duration="500">
            <a href="tel:+639230201174" target="_blank" style="text-decoration:none;">
                <img src="images/index_contact.png" alt="">
                <p id="a">Contact</p>
                <p id="b"><?php echo $row_g['g_Contact']; ?></p>
            </a>
            </div>
            <div class="box" data-aos="zoom-in-up" data-aos-duration="500">
                <img src="images/index_loc.png" alt="">
                <p id="a">Location</p>
                <p id="b"><?php echo $row_g['g_Location']; ?></p>
            </div>

            <div class="box" data-aos="zoom-in"data-aos-duration="500">
            <a href="mailto:roblesmaternityclinic@gmail.com" target="_blank" style="text-decoration:none;">
                <img src="images/index_email.png" alt="">
                <p id="a">Email</p>
                <p id="b" style="word-break: break-all;"><?php echo $row_g['g_Email']; ?></p>
            </a>
            </div>
            <div class="box" data-aos="zoom-in-up" data-aos-duration="500">
                <img src="images/index_working.png" alt="">
                <p id="a">WORKING HOURS</p>
                <p id="b"><?php echo $row_g['g_WorkingHours']; ?></p>
            </div>
        </div>
    </div>
     

    <!--FOOTER-->
    <div id="bot">
        <div id="top">
                <img src="upload_img_generic/<?php echo $row_g['g_LogoLight']; ?>" id="img1" onclick="goHome()" class="logo_top">   
                <div>
                    <p class="a p_title" style="margin-top:10%; text-transform:Uppercase;"><?php echo $rowNameFirst; ?></p>
                    <P class="b p_title" style="text-transform:Uppercase;"><?php echo $rowSecondName; ?></P>
                </div>
        </div>

        <div id="footer_link">
                <a href="about.php" class="navbar_a">About Us</a>
                <a href="services.php" class="navbar_a">Services</a>
                <a href="inquiry.php" class="navbar_a">Inquiry</a>
                <a class="navbar_a" id="privacy_button">Privacy Policy</a>
        </div>

        <div id="footer_line"></div>

        <div id="bottom_footer">
            <div id="left">© <?php echo $row_g['g_Sitename']; ?> 2022. All rights reserved</div>
            <div id="right">
                    <a href="<?php echo $row_g['facebook']; ?>" target="_blank"><img src="images/icons/fb.png"></a>
                    <a href="mailto:<?php echo $row_g['g_Email']; ?>" target="_blank"><img src="images/icons/email.png"></a>
                    <a href="tel:<?php echo $row_g['g_Contact']; ?>" target="_blank"><img src="images/icons/phone.png"></a>
            </div>
        </div>
    </div><!--end of bot div-->


 

    <!--Login Container-->
    <form action="javascript:void(0)" method="post" id="ajax-form_patient_login">
    <div id="login_container">
            <div id="login">
                <img src="images/icons/close.png" id="close_btn"  title="Close" onclick="closeLogin()">

                <div id="welcome_container">
                    <img src="images/login_welcome.png">
                    <p>Welcome back!</p>
                </div><!--End of welcome_container-->
                
                <p id="log_subtext">Kindly fill in your login details to proceed</p>

                <div id="inputs">
                    <input type="text" id="username_l" placeholder="Username or Email" onkeyup="removeValidationPatientLogin()" name="username_l">
                    <div id="for_pass">
                         <img src="images/icons/show.gif" title="Show Password" id="hide_pass" onclick="togglePassword()">
                         <img src="images/icons/hide.gif" title="Hide Password" id="show_pass" onclick="togglePassword()">
                         <input type="password" id="password_l" placeholder="Password" onkeyup="removeValidationPatientLogin()" name="password_l">
                    </div>
                </div><!--End of inputs div-->

                <div id="keepMe_log">
                    <input type="checkbox" id="keep_log" name="keep_log" value="lsRememberMe">
                    <p>Remember me</p>
                </div><!--End of keepMe_log div-->
                <div id="validation" class="validation_forPatientLogin"><img src="images/icons/error_input.png"><span>Tot test</span></div>

                <!--Loging submit button-->
                <center><button id="login_submit" type="submit" onclick="lsRememberMe()">Login</button></center>

                <!--<p id="dont_have_acc">Don’t have an account yet? <b class="for_pointer" style="color:#17B6FE; text-decoration:underline;">Sign Up</b></p>-->
                <p id="forgot_pass" class="for_pointer" onclick="showForgot()">Forgot my password?</p>

                <div id="data_act">
                    <p><b style="color:#17B6FE;" title="See terms of service" class="for_pointer" id="terms_button">Terms of Service</b> and <b style="color:#17B6FE;" title="See privacy policy" class="for_pointer" id="privacy_button1">Privacy Policy</b></p>
                </div><!--End of data_act div-->
                
            </div>
    </div><!--End of login_container div-->
    </form>




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
                       <button id="btn_accept_privacy">Accept</button>
                       <button id="btn_cancel_privacy" onclick="closePrivacy()">Cancel</button>
            </div><!--end of for_privacy_btn-->
           
      </div><!--End of privacy div-->

    </div><!--End of privacy_policy_container-->


    <!--Forgot Password-->
    <form action="javascript:void(0)" method="post" id="ajax-form_patient_forgot">
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





    <!--Cookie popup-->
    <div id="cookie_container">
        <p>We use cookies on our website. By continuing to use our site, you agree to our use of cookies based on our Privacy Policy.</p>
        <center><button id="accept_ck1">Ok</button></center>
        <center><button id="ck_privacyP">Privacy Policy</button></center>
    </div><!--End of cookie_containerM-->

   

<!--Scroll down-->
<div id="scroll_cont">
    <img src="images/gif/scroll_down.gif" alt="">
</div>  


<!-- loading for emails-->
<div id="loading_succes">
        <div id="cont">
             <p>The information is processing....</p>
             <img src="images/gif/loading.gif" alt="">
        </div>
</div>


<div id="toggle_forTheme">
    <div class="box default" title="Set theme as default" onclick="goToDefault()"></div>
    <div class="box dark" title="Set theme as dark" onclick="goToDark()"></div>
    <div class="box light" title="Set theme as light" onclick="goToLight()"></div>
</div>
   
</div><!--End of for_desktop div -->


<!------------------------------------------------------------------------------------------------------------->


<div class="for_mobile"><!--For Mobile div-->
    
    <div id="up">
        <div id="header" class="nav_bar_phone">
                <div id="for_left">
                    <img src="upload_img_generic/<?php echo $row_g['g_LogoLight']; ?>" id="open_admin">
                    <div>
                        <p class="a" style="text-transform:uppercase;"><?php echo $rowNameFirst; ?></p>
                        <P class="b" style="text-transform:uppercase;"><?php echo $rowSecondName; ?></P>
                    </div>
                </div> 
            <img src="images/hamburger_menu.png" id="hamburger_menu">
            <img src="images/close_hamburger.png" id="close_hamburger">
        </div><!--End of header div-->

        <div id="content">
            <p id="welcome">Welcome to</p>
            <p id="header_mob"><?php echo $rowNameFirst; ?></p>
            <p id="header_mob" style="margin-top:-3%;"><?php echo $rowSecondName; ?></p>
            <p id="text_mob" class="visionText"><?php echo $row_g['h_Tagline']; ?></p>
            <img src="upload_img_generic/<?php echo $row_g['h_Layoutimg']; ?>" id="index_right_img">
            <button id="appointment_btn" onclick="goAppointmentPhone()">Book an Appointment</button>
        </div><!--End of content div-->
    </div><!--End of up div-->

    <div id="our_best">
            <p id="headT">Our Best Services</p>

            <div id="box_content">
                <div id="box">
                    <img src="images/pt_index.png">
                    Pregnancy Test
                </div>
                <div id="box">
                    <img src="images/pn_index.png">
                    Pre-natal Checkup
                </div>
            </div>
            <div id="box_content">
                <div id="box">
                    <img src="images/post_index.png">
                    Post-natal Checkup
                </div>
                <div id="box">
                    <img src="images/fp_index.png">
                    Family Planning
                </div>
            </div>

            <div id="sub_content_1">
                <div id="left" data-aos="zoom-in-down" data-aos-duration="500" class="slideshow">
                    <div id="carousel_container" data-aos="fade-right" data-aos-duration="500">
                        <img src="upload_img_generic/<?php echo $row_g['h_slide1']; ?>" alt="">
                    </div>
                    <div id="carousel_container" data-aos="fade-right" data-aos-duration="500">
                        <img src="upload_img_generic/<?php echo $row_g['h_slide2']; ?>" alt="">
                    </div>
                    <div id="carousel_container" data-aos="fade-right" data-aos-duration="500">
                        <img src="upload_img_generic/<?php echo $row_g['h_slide3']; ?>" alt="">
                    </div>
                </div>
            </div>

            <p id="Vision">Our Vision</p>
            <p id="vision_content"><?php echo $row_g['g_Vision']; ?></p>

            <div id="getIntouch">
                <p id="a">GET IN TOUCH</p>
                <P id="b">Contact</P>

                <div id="bot">
                    <div class="box" data-aos="zoom-in" data-aos-duration="500">
                        <a href="tel:+639230201174" target="_blank" style="text-decoration:none;">
                        <img src="images/index_contact.png" alt="">
                        <p id="a">Contact</p>
                        <p id="b"><?php echo $row_g['g_Contact']; ?></p>
                        </a>
                    </div>
                    <div class="box" data-aos="zoom-in-up" data-aos-duration="500">
                        <img src="images/index_loc.png" alt="">
                        <p id="a">Location</p>
                        <p id="b"><?php echo $row_g['g_Location']; ?></p>
                    </div>
                </div>

                <div id="bot">
                    <div class="box" data-aos="zoom-in"data-aos-duration="500">
                        <a href="mailto:roblesmaternityclinic@gmail.com" target="_blank" style="text-decoration:none;">
                        <img src="images/index_email.png" alt="">
                        <p id="a">Email</p>
                        <p id="b" style="word-break: break-all;"><?php echo $row_g['g_Email']; ?></p>
                        </a>
                    </div>
                    <div class="box" data-aos="zoom-in-up" data-aos-duration="500">
                        <img src="images/index_working.png" alt="">
                        <p id="a">Office HOURS</p>
                        <p id="b"><?php echo $row_g['g_WorkingHours']; ?></p>
                    </div>
                </div>
            </div>
    </div>

    <!--FOOTER-->
    <div id="bot">
       <div id="f1">
           <p id="f1_text">Company</p>
           <img src="images/icons/minus.png" id="minus_btn1">
           <img src="images/icons/plus.png" id="plus_btn1">
       </div>
       <p class="f1_subtext">About Us</p>
       <p class="f1_subtext" style="border-bottom:1px solid rgb(207, 207, 207); padding-bottom:3%;">Services</p>

       <div id="f1">
           <p id="f1_text">Contact</p>
           <img src="images/icons/minus.png" id="minus_btn2">
           <img src="images/icons/plus.png" id="plus_btn2">
       </div>
       <p class="f2_subtext" style="border-bottom:1px solid rgb(207, 207, 207); padding-bottom:3%;">Inquiry</p>

       <div id="f1">
           <p id="f1_text">Social</p>
       </div>

       <div id="f3">
            <a href="<?php echo $row_g['facebook']; ?>" target="_blank"><img src="images/icons/fb_mobile.png"></a>
            <a href="mailto:<?php echo $row_g['g_Email']; ?>" target="_blank"><img src="images/icons/email_mobile.png"></a>
            <a href="tel:<?php echo $row_g['g_Contact']; ?>" target="_blank"><img src="images/icons/phone_mobile.png"></a>
       </div>

       <p class="f3_subtext">© <?php echo $row_g['g_Sitename']; ?> 2022. All rights reserved</p>
       <p class="f3_subtext" id="terms_buttonM">Terms of Service</p>
       <p class="f3_subtext" id="privacy_buttonM" style="margin-bottom:5%;">Privacy Policy</p>

    </div><!--End of bot div-->



    <!--Haburger Menu-->
    <div id="hamburger_container">
        <div id="hamburger">
            <div id="up_logo">
                <img src="upload_img_generic/<?php echo $row_g['g_LogoLight']; ?>">
                <div>
                        <p class="a" style="text-transform:uppercase;"><?php echo $rowNameFirst; ?></p>
                        <P class="b" style="text-transform:uppercase;"><?php echo $rowSecondName; ?></P>
                </div>
            </div><!--End of up_logo-->

            <div id="home_burger" class="burger" style="background:#78CCF2;">Home</div>
            <div id="about_burger" class="burger">About Us</div>
            <div id="employee_burger" class="burger">Employee</div>
            <div id="service_burger" class="burger">Services</div>
            <div id="inquiry_burger" class="burger">Inquiry</div>
            <div id="appointment_burger" class="burger">Appointment</div>
            
        </div><!--End of hamburger div-->
        
        <div id="for_opacity_burger"></div>

    </div><!--End of hamburger_container div-->




     <!--Terms of service container-->
     <div id="terms_containerM">
         
        <div id="termsM">
            <img src="images/icons/close.png" id="close_btnM" onclick="closeTermsM()">

            <div id="one">
                    <img src="images/icons/terms_icon.png">
                    <div id="terms_header">
                            <p id="a1">Terms of Service</p>
                            <p id="a2">Robles Maternity Clinic</p>
                    </div>
            </div><!--End of one div-->

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

            <div id="for_terms_btnM">
                <button id="btn_accept_termsM" onclick="closeTermsM()">Accept</button>
                <button id="btn_cancel_termsM" onclick="closeTermsM()">Cancel</button>
            </div><!--end of for_terms_btn-->

        </div><!--End of termsM-->

    </div><!--End of terms_containerM div-->



     <!--Privacy Policy container-->
     <div id="privacy_containerM">
         
        <div id="privacyM">
            <img src="images/icons/close.png" id="close_privacyM" onclick="closePrivacyM()">

            <div id="one">
                    <img src="images/icons/privacy_icon.png">
                    <div id="privacy_header">
                            <p id="a1">Privacy Policy</p>
                            <p id="a2">Robles Maternity Clinic</p>
                    </div>
            </div><!--End of one div-->


            <p id="text1" style="margin-top:10%;">Robles Maternity Clinic Website values and respects your right to privacy. </p>
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

            <div id="for_privacy_btnM">
                <button id="btn_accept_privacyM" onclick="closePrivacyM()">Accept</button>
                <button id="btn_cancel_privacyM" onclick="closePrivacyM()">Cancel</button>
            </div><!--end of for_privacy_btn-->

        </div><!--End of privacyM-->

    </div><!--End of privacy_containerM div-->



    <!--Cookie popup-->
    <div id="cookie_containerM">
        <img src="images/icons/close_white.png" onclick="closeCookiesM()">
        <p>We use cookies on our website. By continuing to use our site, you agree to our use of cookies based on our <span id="privacy_buttonM2"><u>Privacy Policy.</u></span></p>
        <center><button id="accept_ck">Continue</button></center>
    </div><!--End of cookie_containerM-->





</div><!--End of for_mobile div-->


<!--Page Loader--->
<div id="page_loader_container"></div>

</body>

</html>



<!--Script for typing effect-->
<script src="js/typingEffect.js"></script>
<!--Script for password-->
<script src="js/password.js"></script>
<!--Script for login-->
<script src="js/login.js"></script>

<script type="text/javascript" src="js/vanilla-tilt.js"></script>
<!--Script for directing to pages in mobile-->
<script src="js/mobilePagesLinking.js"></script>
<!--Script for pageloader content-->
<script src="js/pageloaderContent.js"></script>
<!--Script for js theme setter-->
<script src="js/ThemeSetter.js"></script>



<!-- Jquery for hamburger menu-->
<script src="jquery/hamburgerMenu.js"></script>
<!-- Jquery for tooltips-->
<script src="jquery/tooltip.js"></script>
<!-- Jquery for termsAndprivacy-->
<script src="jquery/termsAndprivacy.js"></script>
<!-- Jquert for loginAdmin-->
<script src="jquery/loginAdmin.js"></script>



<?php
    $theme = $_SESSION['theme'];
    if ($theme == "default"){
?>  
    <!-- Jquery for pages Animation-->
    <script src="jquery/pagesAnim.js"></script>
<?php
    }
    else if($theme == "dark"){
?>
    <!-- Jquery for pages Animation-->
    <script src="jquery/pagesAnimDark.js"></script>
<?php   
    }
    else if($theme == "light"){
?>
    <!-- Jquery for pages Animation-->
    <script src="jquery/pagesAnimlight.js"></script>
<?php     
    }
    else{
?>
    <!-- Jquery for pages Animation-->
    <script src="jquery/pagesAnim.js"></script>
<?php
    }
?>



<!-- Ajax for patient login -->
<script src="ajax/patientLogin.js"></script>

<!--Script for scrolling animation-->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>

<script>
var scrollIdentifier = 0;
var screenHeight = $(window).height();

window.onscroll = function(ev) {
    if ((window.innerHeight + window.pageYOffset) >= document.body.offsetHeight) {
        $(document).ready(function(){
            scrollIdentifier = 1;
            $("#scroll_cont").css({
                    display: "flex",
                    transform: "rotate(180deg)",
                }) 
        });
    }
    else if(window.scrollY==0){
        scrollIdentifier = 0;
    }
};

document.getElementById("scroll_cont").onclick = function() {
    if(scrollIdentifier == 0){
        scrollIdentifier = 1;
        $('body, html').animate({
        'scrollTop': screenHeight // <--- How far from the top of the screen?100?
        }, 500);// <---time = 1s
    }
    else{
        $(document).ready(function(){
            scrollIdentifier = 0;
            $('body, html').animate({
                'scrollTop': 0 // <--- How far from the top of the screen?100?
            }, 500);// <---time = 1s 
        });
    }
};

</script>




<script>
$(".slideshow > div:gt(0)").hide();

setInterval(function() {
  $('.slideshow > div:first')
    .fadeOut(1000)
    .next()
    .fadeIn(1000)
    .end()
    .appendTo('.slideshow');
}, 3000);


function goService(){
    window.location.href = "services.php";
}

function goAppointmentPhone(){
    window.location.href = "appointment.php";
}
</script>

<script>
    pageloaderContents('<?php echo $row_g['g_LogoLight']; ?>', '<?php echo $rowNameFirst; ?>','<?php echo $rowSecondName; ?>');
</script>