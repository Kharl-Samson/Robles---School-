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
        <link rel="stylesheet" href="css/Desktop/employee.css">
    <?php
        }
        else if($theme == "dark"){
    ?>
        <link rel="stylesheet" href="css/Desktop/globalDark.css">
        <link rel="stylesheet" href="css/Desktop/employeeDark.css">
    <?php   
        }
        else if($theme == "light"){
    ?>
        <link rel="stylesheet" href="css/Desktop/globalLight.css">
        <link rel="stylesheet" href="css/Desktop/employeeLight.css">
    <?php     
        }
        else{
    ?>
        <link rel="stylesheet" href="css/Desktop/global.css">
        <link rel="stylesheet" href="css/Desktop/employee.css">
    <?php
        }
    ?>

     <link rel="stylesheet" href="css/Mobile/global.css">
     <link rel="stylesheet" href="css/Mobile/employee.css">

     <link rel="shortcut icon" type="image/png" href="upload_img_generic/<?php echo $row_g['g_LogoDark']; ?>"> 

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
                    <a href="index.php" class="navbar_a">Home</a>
                    <a href="appointment.php" class="navbar_a">Appointment</a>
                    <a href="services.php" class="navbar_a">Services</a>
                    <a href="employee.php" style="color:#929292;" class="navbar_a navbar_a_active">Employees</a>
                    <a href="inquiry.php" class="navbar_a">Inquiry</a>
                    <a href="about.php" class="navbar_a">About Us</a>    
            </div>

            <div class="three">
                    <button id="login_btn" onclick="showLogin()">Log In</button>
                    <!--<button id="register_btn" title="Create account">Register</button>-->
            </div>

        </div><!--End of header div-->




        <div id="content" class="content_employee">
                <div id="left" class="left_content_index">
                    <p class="ourVision1">Our Team</p>
                    <p id="text" class="visionText"><?php echo $row_g['e_content'];?></p>

                    <button id="learn_more_employee">Learn More</button>
                </div>

                <div id="right">
                    <img src="upload_img_generic/e_layoutimg.png" id="empUp_right_img">
                </div>    
        </div><!--End of content div-->
        
    </div><!--End of up div-->
    

    
    <div id="content1_emp">
            <div id="team_header">Our Medical Staff</div>
            <div id="line"></div>     
    </div><!--End of content1_about div-->


    <div id="content2_emp">
        <?php
            $sql_general_image = "SELECT * FROM `general_tb`";
            $search_General_image = filterGeneral($sql_general_image);
            function filterGeneral($sql_general_image){  
                $con1=mysqli_connect('localhost','root','','robles_db');
                $filter_General1 = mysqli_query($con1, $sql_general_image);
            return $filter_General1; 
            }
            $sr = 0; 
            while($row_general = mysqli_fetch_array($search_General_image)){
                $strSubImage = $row_general['e_staffImage'];
                $strSubQuote = $row_general['e_staffQuoute'];
                $strSubQuotedBy = $row_general['e_staffQuoteBy'];

                $arraySubImage = explode(',', $strSubImage );
                $arraySubQuote = explode('|()|', $strSubQuote );
                $arraySubQuotedBy = explode('|()|', $strSubQuotedBy );
                $sr++;
            }

            $sql = "SELECT * FROM staff_db WHERE schedule!='Sunday' and status='Active'"; 
            $staff_tb = filterStaff($sql);
            function filterStaff($sql){  
                $con=mysqli_connect('localhost','root','','robles_db');
                $filter_pendingApp = mysqli_query($con, $sql);
                return $filter_pendingApp; 
                }
                $x = 0; 
        while($row_e = mysqli_fetch_array($staff_tb)){
            if($x % 2 == 0){
        ?>
            <div class="emp_container_left">
                <div id="img_container">
                    <img src="upload_img_generic/<?php echo $arraySubImage[$x]; ?>" id="emp_img">
                    <img src="images/gif/profile_loading.gif" id="profile_loading">
                </div>


                <div id="right_emp_part">
                    <div id="emp_name"><?php echo $row_e['fname']." ".$row_e['lname'];?>&nbsp;&nbsp;/&nbsp;&nbsp;<span style="text-transform:uppercase;"><?php echo $row_e['role'];?></span></div>
                    <!--For skeleton loading--><div class="skeleton_name"></div>
   
                    <p id="quote">Favorite Quote :</p>
                    <!--For skeleton loading--><div class="skeleton_favQuote"></div>
                                        
                    <p id="quote_content">"<?php echo $arraySubQuote[$x]; ?>"</p>
                    <!--For skeleton loading--><div class="skeleton_quote"></div><div class="skeleton_quote"></div><div class="skeleton_quote"></div>

                    <p id="quoted_by">- <?php echo $arraySubQuotedBy[$x];?></p>
                    <!--For skeleton loading--><div id="quoted_byContainer"><div class="skeleton_quotedby"></div></div>
                </div>
            </div>
        <?php
            }
            else{
        ?>
        
            <div class="emp_container_right">
                <div id="right_emp_part">
                    <div id="emp_name"><?php echo $row_e['fname']." ".$row_e['lname'];?>&nbsp;&nbsp;/&nbsp;&nbsp;<span style="text-transform:uppercase;"><?php echo $row_e['role'];?></span></div>
                    <!--For skeleton loading--><div class="skeleton_name"></div>
   
                    <p id="quote">Favorite Quote :</p>
                    <!--For skeleton loading--><div class="skeleton_favQuote"></div>
                                        
                    <p id="quote_content">"<?php echo $arraySubQuote[$x]; ?>"</p>
                    <!--For skeleton loading--><div class="skeleton_quote"></div><div class="skeleton_quote"></div><div class="skeleton_quote"></div>

                    <p id="quoted_by">- <?php echo $arraySubQuotedBy[$x];?></p>
                    <!--For skeleton loading--><div id="quoted_byContainer"><div class="skeleton_quotedby"></div></div>
                </div>
                <div id="img_container">
                    <img src="upload_img_generic/<?php echo $arraySubImage[$x]; ?>" id="emp_img">      
                    <img src="images/gif/profile_loading.gif" id="profile_loading">      
                </div>
            </div>
        <?php
            }
        $x++; }
        ?>
    </div><!--End of content2_about div-->


    <div id="content3_emp">
            <img src="images/gif/walkingNurse.gif" id="walking_gif">
    </div><!--End of content3_about div-->


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
                <a href="<?php echo $row_g['facebook']; ?>" target="_blank"><img src="images/icons/fb_mobile.png"></a>
                <a href="mailto:<?php echo $row_g['g_Email']; ?>" target="_blank"><img src="images/icons/email_mobile.png"></a>
                <a href="tel:<?php echo $row_g['g_Contact']; ?>" target="_blank"><img src="images/icons/phone_mobile.png"></a>
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


        <div id="contents">

            <p id="header_mob">Our Team</p>
            <p id="text_mob"><?php echo $row_g['e_content'];?></p>
            <img src="upload_img_generic/e_layoutimg.png" id="empUp_right_img">
            <button id="learn_more_employee_mobile">Learn More</button>
    
        </div><!--End of content div-->

    </div><!--End of up div-->

    <div id="content_team_header">
            <div id="team_header">Our Medical Staff</div>
    </div><!--Closing of content_team_header div-->   


        <?php
            $sql_general_image = "SELECT * FROM `general_tb`";
            $search_General_image = filterGeneralPhone($sql_general_image);
            function filterGeneralPhone($sql_general_image){  
                $con1=mysqli_connect('localhost','root','','robles_db');
                $filter_General1 = mysqli_query($con1, $sql_general_image);
            return $filter_General1; 
            }
            $sr = 0; 
            while($row_general = mysqli_fetch_array($search_General_image)){
                $strSubImage = $row_general['e_staffImage'];
                $strSubQuote = $row_general['e_staffQuoute'];
                $strSubQuotedBy = $row_general['e_staffQuoteBy'];

                $arraySubImage = explode(',', $strSubImage );
                $arraySubQuote = explode('|()|', $strSubQuote );
                $arraySubQuotedBy = explode('|()|', $strSubQuotedBy );
                $sr++;
            }

            $sql = "SELECT * FROM staff_db WHERE schedule!='Sunday' and status='Active'"; 
            $staff_tb = filterStaffPhone($sql);
            function filterStaffPhone($sql){  
                $con=mysqli_connect('localhost','root','','robles_db');
                $filter_pendingApp = mysqli_query($con, $sql);
                return $filter_pendingApp; 
                }
                $x = 0; 
        while($row_e = mysqli_fetch_array($staff_tb)){
        ?>
            <div id="content2_emp_mobile">
                <div id="img_container">
                    <img src="upload_img_generic/<?php echo $arraySubImage[$x]; ?>">
                </div>

                <div id="emp_name_mobile"><?php echo $row_e['fname']." ".$row_e['lname'];?><span style="margin-top:1%;"><b>( <?php echo $row_e['role'];?> )</b></span></div>

                <div id="quote_container">
                    <p id="quote_mobile">Favorite Quote :</p>
                    <p id="quote_content_mobile">"<?php echo $arraySubQuote[$x]; ?>"</p>
                    <p id="quoted_by_mobile">- <?php echo $arraySubQuotedBy[$x];?></p></p>
                </div>
            </div><!--End of content2 -->
        <?php
        $x++; }
        ?>

    
  

    
    <!--FOOTER-->
    <div id="bot" style="margin-top:15%;">
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
            <a href="https://www.facebook.com/robles.maternity" target="_blank"><img src="images/icons/fb_mobile.png"></a>
            <a href="mailto:roblesmaternityclinic@gmail.com" target="_blank"><img src="images/icons/email_mobile.png"></a>
            <a href="tel:+639230201174" target="_blank"><img src="images/icons/phone_mobile.png"></a>
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

            <div id="home_burger" class="burger">Home</div>
            <div id="about_burger" class="burger">About Us</div>
            <div id="employee_burger" class="burger"  style="background:#78CCF2;">Employee</div>
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
<!--Script fot tilting services in chatbot-->
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
        scrollIdentifier = 0;
        $('body, html').animate({
        'scrollTop': 0 // <--- How far from the top of the screen?100?
        }, 500);// <---time = 1s
    }
};



//tilting the container of services in chatbot
	VanillaTilt.init(document.querySelector(".tilting_services"), {
		max: 25,
		speed: 400
	});	
	//It also supports NodeList
	VanillaTilt.init(document.querySelectorAll(".tilting_services"));

    //tilting the container of image in employee page
	VanillaTilt.init(document.querySelector("#meet_our_team_img"), {
	max: 25,
	speed: 400
	});	
	//It also supports NodeList
	VanillaTilt.init(document.querySelectorAll("#meet_our_team_img"));

    //tilting the container of image in employee page
	VanillaTilt.init(document.querySelector("#emp_img"), {
	max: 25,
	speed: 400
	});	
	//It also supports NodeList
	VanillaTilt.init(document.querySelectorAll("#emp_img"));
</script>




<!-- Script for autoplay -->
<script type="text/javascript">
    var slides=document.getElementsByClassName("item");
    var counter = 1;
    var a = 0

        setInterval(function(){

            var check=document.getElementById('radio'+counter).checked = true;  

            slides[a].classList.remove("active");
            slides[counter].classList.add("active"); 
            counter++;   a++;

            if(counter==6){
                counter=1;
                a = 0
            }
        },5000);
  </script>

<script>
    pageloaderContents('<?php echo $row_g['g_LogoLight']; ?>', '<?php echo $rowNameFirst; ?>','<?php echo $rowSecondName; ?>');
</script>