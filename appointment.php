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
        <link rel="stylesheet" href="css/Desktop/appointment.css">
    <?php
        }
        else if($theme == "dark"){
    ?>
        <link rel="stylesheet" href="css/Desktop/globalDark.css">
        <link rel="stylesheet" href="css/Desktop/appointmentDark.css">
    <?php   
        }
        else if($theme == "light"){
    ?>
        <link rel="stylesheet" href="css/Desktop/globalLight.css">
        <link rel="stylesheet" href="css/Desktop/appointmentLight.css">
    <?php     
        }
        else{
    ?>
        <link rel="stylesheet" href="css/Desktop/global.css">
        <link rel="stylesheet" href="css/Desktop/appointment.css">
    <?php
        }
    ?>

     <link rel="stylesheet" href="css/Mobile/global.css">
     <link rel="stylesheet" href="css/Mobile/appointment.css">
  
     <link rel="shortcut icon" type="image/png" href="upload_img_generic/<?php echo $row_g['g_LogoDark']; ?>"> 

     <link rel="stylesheet" href="AnimBackend/jquery.css">
     <script src="AnimBackend/jquery.js"></script>
     <script src="AnimBackend/jquery1.js"></script>

  </head>

<body onload="renderDate();renderDate_mobile();">
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

<input type="hidden" value="<?php echo $row_g['holidays']; ?>" id="hidden_holiday">

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
                    <a href="appointment.php" style="color:#929292;" class="navbar_a navbar_a_active">Appointment</a>
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
     
        <p id="apppointment_text">Book an Appointment</p>
        <div id="content">    
            
            <div id="calendar_time_content">
                <div id="left">
                    <p id="select_date_text">Select Date</p>
                    <!-- Calendar -->
                    <div class="calendar_appointment">
                  
                        <div class="month_appointment">
                            <div class="prev_appointment" onclick="moveDate_appointment('prev_appointment')">
                                <span>&#10094;</span>
                            </div>
                            <div id="header_calendar">
                                <p id="month_appointment"></p>
                                <p id="date_str_appointment"></p>
                            </div>
                            <div class="next_appointment" onclick="moveDate_appointment('next_appointment')">
                                <span>&#10095;</span>
                            </div>
                        </div>

                        <div class="weekdays_appointment">   
                            <div>Sun</div>     
                            <div>Mon</div>
                            <div>Tue</div>
                            <div>Wed</div>
                            <div>Thu</div>
                            <div>Fri</div>
                            <div>Sat</div>
                        </div>

                        <div class="days_appointment"></div>
                    </div>


                </div><!-- End of left div-->

                <div id="right">

                    <p id="select_time_text">Select Time</p>

                    <div id="time_content">
                        <div id="available_time">
                            <table id="table_app"> 
                                <?php
                                error_reporting(0);
                                $flag = true;
                                $ctrr = 1;
                                $time = array("10:00 am - 10:30 am", "10:30 am - 11:00 am", "11:00 am - 11:30 am",
                                "11:30 am - 12:00 pm", "12:00 pm - 12:30 pm", "12:30 pm - 1:00 pm",
                                "1:00 pm - 1:30 pm", "1:30 pm - 2:00 pm", "2:00 pm - 2:30 pm",
                                "2:30 pm - 3:00 pm", "3:00 pm - 3:30 pm", "3:30 pm - 4:00 pm");
                                $sr = 0; 
                                ?>

                                <?php
                                for ($x = 0; $x < count($time) ; $x++) {
                                    if($sr%2 == 0){
                                        echo "<tr>";
                                    }  
                                ?>

                                <td onclick="getTime('<?php echo $time[$x]; ?>')" class="td_time_app" id='time"<?php echo $x; ?>"'>
                                    <p id='val_p"<?php echo $x; ?>"' class="val_time_appoint_class"><?php echo $time[$x]; ?></p>
                                </td>  

                                <?php
                                    if($sr% 2 == 2){
                                        echo "</tr>";
                                    }
                                    $sr++;
                                }
                                unset($_SESSION["date_appointment"]);
                                ?>        
                            </table>
                        </div><!-- end of available_time div -->

                        <div id="slc_time">
                                <img src="images/icons/close_white.png" title="Close" onclick="close_boxTime()">
                                <div>
                                    <p id="time_box">.</p>
                                </div>
                        </div>
                    </div><!-- end of time_content div-->  

                    <div id="info_box">
                        <img src="images/icons/info.png">
                        This is all the available slots
                    </div>

                    <div id="top">
                        <div id="one" style="width:40%;">
                            <img src="images/icons/calendar_3d.png" alt="">
                            <p> -&nbsp;</p>
                            <p id="date_appoint_p">00/00/00</p>
                        </div>

                        <div id="one" style="width:60%;">
                            <img src="images/icons/clock_3d.png" alt="">
                            <p> -&nbsp;</p>
                            <p id="time_appoint_p">00:00 - 00:00</p>
                        </div>
                        <input type="hidden" name="date" id="sched_appointment_input">
                        <input type="hidden" name="time" id="time_appointment_input">
                    </div><!-- End of top div-->

                    <div id="warning_validation_appointment">
                        <img src="images/icons/error_input.png">
                        <p id="error_validation_text_app">.</p>
                    </div>
                </div><!-- End of right div-->
            </div>

            <div id="for_button_app">
                        <button onclick="next_btn_appointment()">Schedule an Appointment</button>
            </div>
        </div><!--End of content div-->
        
    </div><!--End of up div-->

    <div id="color_legends">
        <div id="legend_box">
            <p>Color Legends</p>
            <div class="box_cont">
                <div style="background-color:#aacdf8;"></div> - Date Today
            </div>
            <div class="box_cont">
                <div style="background-color:rgb(175, 134, 170)"></div> - Date is fully Scheduled
            </div>
            <div class="box_cont">
                <div style="background-color:pink"></div> - Date Selected
            </div>
        </div>
    </div>
    

    <div id="form_appointment">
        <div id="form_content">
        <form action="javascript:void(0)" method="POST" id="ajax-form-appointment">
            <p id="head_text">You requested an appointment at <strong><?php echo $row_g['g_Sitename']; ?></strong> on <strong><span id="form_date_span"></span> at <span id="form_time_span"></span>.</strong></p>
            <p id="head_text">Please complete this form to finish your request.</p>

            <div id="container_name">
                    <div class="for_input_appointment">
                        <label for="fname">First Name :</label>
                        <input type="text" name="firstname" id="firstname" class="allInp_appoint1" placeholder="ex. Jane " onkeyup="removeborder('firstname')"> 
                    </div>

                    <div class="for_input_appointment">
                        <label for="mname">Middle Name :</label>
                        <input type="text" name="middlename" id="middlename" class="allInp_appoint2" placeholder="(Optional)"> 
                    </div>

                    <div class="for_input_appointment">
                        <label for="lname">Last Name :</label>
                        <input type="text" name="lastname" id="lastname" class="allInp_appoint3" placeholder="ex. Dela Cruz" onkeyup="removeborder('lastname')"> 
                    </div>
            </div>

            <div id="container_address" class="reload2">
                    <div class="for_input_appointment">
                        <label for="address">Address :</label>
                        <input type="text" name="address" id="address" class="allInp_appoint4" placeholder="ex. Sulipan, Apalit, Pampanga" onkeyup="removeborder('address')"> 
                    </div>
                    <div class="for_input_appointment">
                        <label for="Contact">Contact No. :</label>
                        <input type="number" name="contact" id="contact" class="allInp_appoint5" placeholder="11 digits mobile number" onkeyup="removeborder('contact')"> 
                    </div>
            </div>


            <div id="container_address" class="reload3" style="width:100%;">
                    <div class="for_input_appointment" style="width:100%;">
                        <label for="Sevices">Select a Service:</label>
                                <select name="select_service" class="form-select selectserv" id="select_box">
                                    <?php
                                        $sql_general_service11 = "SELECT * FROM `general_tb`";
                                        $search_General_service11 = filterGeneral11($sql_general_service11);
                                        function filterGeneral11($sql_general_service11){  
                                            $con11=mysqli_connect('localhost','root','','robles_db'); 
                                            $filter_service11 = mysqli_query($con11, $sql_general_service11);
                                        return $filter_service11; 
                                        }
                                        while($row_general11 = mysqli_fetch_array($search_General_service11)){
                                            $strSubHeader1 = $row_general11['s_Sheader'];
                                            $arraySubHeader1 = explode(',', $strSubHeader1);
                                            $z1 = 0 ;           
                                            while($z1<count($arraySubHeader1)){
                                                echo '<option value="'.$arraySubHeader1[$z1].'">'.$arraySubHeader1[$z1].'</option>';
                                                $z1++;
                                             }
                                        }
                                     ?>  
                                </select>
                    </div>  
            </div>

            <div id="container_address" class="reload3">
                    <div class="for_input_appointment">
                        <label for="address">Email :</label>
                        <input type="text" name="email" id="email" class="allInp_appoint6" placeholder="ex. janedelacruz@gmail.com" onkeyup="removeborder('email')"> 
                    </div>

                    <div class="for_input_appointment">
                        <label for="vercode">Verification Code :</label>
                        <div id="ver_code">
                            <input type="number" placeholder="Enter verification code" id="verification_email" name="verification_email" onkeyup="removeborder('verification_email')">
                            <button type="button" id="getCode" form='form-is-not-exist'>Get Code</button>
                        </div> 
                    </div>
            </div>
                        <input type="hidden" name="date1" id="sched_appointment_input1">
                        <input type="hidden" name="time1" id="time_appointment_input1">

                        <div id="validation_error_form_app">
                            <img src="images/icons/error_input.png" title="" id="error_time">
                            <span id="span_validation_error_form_app">.</span>
                        </div>

                        <button id="submit_appointment" type="submit">Submit</button>
                        <button type="button" id="close_appointment" onclick="close_appointment()">Cancel</button>
        </form>
        </div><!--End of form_content div-->
    </div><!--End of form_appointment div-->


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


<!--Validation-->
<div id="newvalidation_Appointment">
     <div class="left">
         <img src="" alt="" id="validationAppointment_img">
     </div>
     <div class="center">
         <p id="text_validationHeader"></p>
         <p id="text_validationContent"></p>
     </div>
     <div class="right">  <p id="newclose_validationAppoinment" onclick="close_alertAppoint()">OK</p>   </div>
</div> 

<div id="loading_succes">
        <div id="cont">
             <p>The information is processing....</p>
             <img src="images/gif/loading.gif" alt="">
        </div>
</div>

    
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

        <div id="content_mobile">
                <p id="header_appointment_text">Make appointment with us</p>

                <form action="javascript:void(0)" method="get" id="ajax-form-appointment-mobile">
                    <div class="for_input_appointment">
                        <label for="fname">First Name :</label>
                        <input type="text" style="text-transform:capitalize;" name="firstnameM" id="firstnameM" placeholder="ex. Jane " onkeyup="removeborderM()"> 
                    </div>

                    <div class="for_input_appointment">
                        <label for="mname">Middle Name :</label>
                        <input type="text" style="text-transform:capitalize;" name="middlenameM" id="middlename" placeholder="(Optional)"> 
                    </div>

                    <div class="for_input_appointment">
                        <label for="lname">Last Name :</label>
                        <input type="text" style="text-transform:capitalize;" name="lastnameM" id="lastnameM" placeholder="ex. Dela Cruz" onkeyup="removeborderM()"> 
                    </div>

                    <div class="for_input_appointment">
                        <label for="address">Address :</label>
                        <input type="text" style="text-transform:capitalize;" name="addressM" id="addressM" placeholder="ex. Sulipan, Apalit, Pampanga" onkeyup="removeborderM()"> 
                    </div>

                    <div class="for_input_appointment">
                        <label for="Contact">Contact No. :</label>
                        <input type="number" name="contactM" id="contactM" placeholder="11 digits mobile number" onkeyup="removeborderM()"> 
                    </div>

                    <div class="for_input_appointment">
                        <label for="Contact">Select a service :</label>
                        <select name="select_serviceM" class="form-select selectserv" id="select_box">
                                    <?php
                                        $sql_general_service11 = "SELECT * FROM `general_tb`";
                                        $search_General_service11 = filterGeneral111($sql_general_service11);
                                        function filterGeneral111($sql_general_service11){  
                                            $con11=mysqli_connect('localhost','root','','robles_db');
                                            $filter_service11 = mysqli_query($con11, $sql_general_service11);
                                        return $filter_service11; 
                                        }
                                        while($row_general11 = mysqli_fetch_array($search_General_service11)){
                                            $strSubHeader1 = $row_general11['s_Sheader'];
                                            $arraySubHeader1 = explode(',', $strSubHeader1);
                                            $z1 = 0 ;           
                                            while($z1<count($arraySubHeader1)){
                                                echo '<option value="'.$arraySubHeader1[$z1].'">'.$arraySubHeader1[$z1].'</option>';
                                                $z1++;
                                             }
                                        }
                                     ?>  
                            </select>
                    </div>
    
                    <div class="for_input_appointment">
                        <label for="address">Email :</label>
                        <input type="text" name="emailM" id="emailM" placeholder="ex. janedelacruz@gmail.com" onkeyup="removeborderM()"> 
                    </div>
        

                        <div id="validation_error_form_appMobile">
                            <img src="images/icons/error_input.png" title="" id="error_time">
                            <span id="span_validation_error_form_appMobile">.</span>
                        </div>

                        <center><button id="next_btn_appointment" type="button" onclick="nextStepM('z-ajax-AppointmentGenerateCodeM.php')">Next Step</button></center>
                        
                        <div id="email_verifyer">

                        <div>
                                <p id="head">Verify your email</p>
                               <center><img src="images/emailPhone.png" id="img_hd"></center> 
                               <p id="subtxt" class="verf_email_class"></p>

                               <div id="input_box">
                                   <input type="text" class="inpCodem inpCodem1"  maxlength="1" />
                                   <input type="text" class="inpCodem inpCodem2"  maxlength="1" />
                                   <input type="text" class="inpCodem inpCodem3"  maxlength="1" />
                                   <input type="text" class="inpCodem inpCodem4"  maxlength="1" />
                                   <input type="text" class="inpCodem inpCodem5"  maxlength="1" />
                                   <input type="text" class="inpCodem inpCodem6"  maxlength="1" />
                               </div>
                               <input type="hidden" id="final_code" name="final_codeM">
                        </div>

                        <div id="bot">
                            <button id="resend" type="button" onclick="resendCode('z-ajax-AppointmentGenerateCodeM.php')">Resend Code</button>
                            <button id="submit" type="button" onclick="sendCode('z-Ajax-AppointmentM.php')">Submit</button>
                            <button id="resend"  type="button" onclick="cancelVerifyerPhone()">Cancel</button>
                        </div>

                        </div>

                        <!--Calendar and time-->
                        <div id="calendarAndtime_container">
                            <div id="calendarAndtime_header">
                                    <p id="back_dateAndtime">&#x2190;</p>
                                    <p class="p_dateAndtime_header"><b>Select date and time</b></p>
                                    <p class="p_dateAndtime_header" id="p_dateAndtime_header2"><?php echo $row_g['g_Sitename']; ?></p>
                            </div>

                            <div class="calendar_appointment_mobile">
                                <div class="month_appointment_mobile">
                                    <div class="prev_appointment_mobile" onclick="moveDate_appointment_mobile('prev_appointment')">
                                        <span>&#10094;</span>
                                    </div>
                                    <div id="header_calendar">
                                        <p id="month_appointment_mobile"></p>
                                        <p id="date_str_appointment_mobile"></p>
                                    </div>
                                    <div class="next_appointment_mobile" onclick="moveDate_appointment_mobile('next_appointment')">
                                        <span>&#10095;</span>
                                    </div>
                                </div>

                                <div class="weekdays_appointment_mobile">   
                                    <div>Sun</div>     
                                    <div>Mon</div>
                                    <div>Tue</div>
                                    <div>Wed</div>
                                    <div>Thu</div>
                                    <div>Fri</div>
                                    <div>Sat</div>
                                </div>
                                <div class="days_appointment_mobile"></div>
                            </div>

                            <div id="time_contentM">

                                <div id="available_time">
                                <table id="table_app"> 
                                    <?php
                                    error_reporting(0);
                                    $flag = true;
                                    $session_date_appointments = $_SESSION["date_appointmentM"];     

                                    $ctrr = 1;
                                    $time = array("10:00 am - 10:30 am", "10:30 am - 11:00 am", "11:00 am - 11:30 am",
                                    "11:30 am - 12:00 pm", "12:00 pm - 12:30 pm", "12:30 pm - 1:00 pm",
                                    "1:00 pm - 1:30 pm", "1:30 pm - 2:00 pm", "2:00 pm - 2:30 pm",
                                    "2:30 pm - 3:00 pm", "3:00 pm - 3:30 pm", "3:30 pm - 4:00 pm");
                                    $sr = 0; 
                                    ?>

                                    <?php
                                    for ($x = 0; $x < count($time) ; $x++) {
                                        if($sr%2 == 0){
                                         echo "<tr>";
                                        }  
                                    ?>

                                    <td onclick="getTimeM('<?php echo $time[$x]; ?>')" class="td_time_app" id='time"<?php echo $x; ?>"'>
                                        <div class="radio">
                                            <input id="radio-<?php echo $sr; ?>" name="radioM" type="radio">
                                            <label for="radio-<?php echo $sr; ?>" class="radio-label radioM"><?php echo $time[$x]; ?></label>
                                        </div>
                                    </td>  

                                    <?php
                                        if($sr% 2 == 2){
                                            echo "</tr>";
                                        }
                                        $sr++;
                                    }
                                    unset($_SESSION["date_appointment"]);
                                    ?>        
                                    </table>
                                    </div><!-- end of available_time div -->
                            </div>

                            <div id="button">
                                    <input type="hidden" name="date1M" id="sched_appointment_inputM">
                                    <input type="hidden" name="time1M" id="time_appointment_inputM">
                                    <button type="button" id="close_appointment" style="margin-right:2%;">Cancel</button>
                                    <button id="submit_appointment" type="button" onclick="submitAppointment('z-Ajax-AppointmentMFinal.php')">Submit</button>
                            </div>

                        </div>
                 </form>
        </div><!--End of content div-->

    </div><!--End of up div-->


    <!--FOOTER-->
    <div id="bot">
       <div id="f1">
           <p id="f1_text">Company</p>
           <img src="images/icons/minus.png" id="minus_btn1">
           <img src="images/icons/plus.png" id="plus_btn1">
       </div>
       <p class="f1_subtext">About</p>
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

            <div id="home_burger" class="burger">Home</div>
            <div id="about_burger" class="burger">About</div>
            <div id="employee_burger" class="burger">Employee</div>
            <div id="service_burger" class="burger">Services</div>
            <div id="inquiry_burger" class="burger">Inquiry</div>
            <div id="appointment_burger" class="burger"  style="background:#78CCF2;">Appointment</div>
            
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
<center><button id="accept_ck" style="color:black; border-radius:0;">Continue</button></center>
</div><!--End of cookie_containerM-->

<div id="sweetalert_container_Mobile">
    <div id="succes_alert_Mobile">
        <div id="alert_div">
        <img src="" id="gif_alertClass1">
        <p id="thankyou" class="header_text_validation_appointmentM1"></p>
        <p class="message_alertClass" id="message_alertM"></p>
        <button id="close_alert_Mobile" onclick="close_alert_Mobile()">OK</button>
        </div>
    </div>
</div>  

<!--Sweetalert-->
<div id="sweetalert_container1">
    <div id="succes_alert1">
        <div id="alert_div1">
        <img src="images/gif/succes.gif" id="gif_alertClass12">
        <p id="thankyou">Success!</p>
        <p class="message_alert11">Expect a feedback from us later, Kindly check your email in a few hours to see if your appointment is accepted.</p>
        <button id="close_alert22" onclick="closeSwal1()">OK</button>
        </div>
    </div>
</div>  


<div id="loading_succesM">
        <div id="cont">
             <p>The information is processing....</p>
             <img src="images/gif/loading.gif" alt="">
        </div>
</div>

</div><!--End of for_mobile div-->


<!--Page Loader--->
<div id="page_loader_container"></div>

<!--Sweetalert-->
<div id="sweetalert_container">
    <div id="succes_alert">
        <div id="alert_div">
        <img src="" id="gif_alert">
        <p id="thankyou" class="header_text_validation_appointment">.</p>
        <p class="message_alert">.</p>
        <button id="close_alert">OK</button>
        </div>
    </div>
</div>  


</body>

</html>



<!--Script for typing effect-->
<script src="js/typingEffect.js"></script>
<!--Script for password-->
<script src="js/password.js"></script>
<!--Script for login-->
<script src="js/login.js"></script>
<!--Script for directing to pages in mobile-->
<script src="js/mobilePagesLinking.js"></script>
<!--Script for pageloader content-->
<script src="js/pageloaderContent.js"></script>
<!--Script for appoiment page -->
<script src="js/appointmentPage.js"></script>
<script src="js/appointmentPageMobile.js"></script>
<!--Script for js theme setter-->
<script src="js/ThemeSetter.js"></script>


<!-- Jquery for hamburger menu-->
<script src="jquery/hamburgerMenu.js"></script>
<!-- Jquery for tooltips-->
<script src="jquery/tooltip.js"></script>
<!-- Jquery for termsAndprivacy-->
<script src="jquery/termsAndprivacy.js"></script>
<!-- Jquery for loginAdmin-->
<script src="jquery/loginAdmin.js"></script>

<!--Ajax for appointment-->
<script src="ajax/appointmentMobile.js"></script>

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

<!-- Ajax for making appointment -->
<script src="ajax/appointment.js"></script>



<script>
    pageloaderContents('<?php echo $row_g['g_LogoLight']; ?>', '<?php echo $rowNameFirst; ?>','<?php echo $rowSecondName; ?>');
</script>
