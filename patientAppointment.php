<?php
date_default_timezone_set('Asia/Manila');
session_start();
if(!isset($_SESSION['patient_active'])){
    header("location: index.php");
    exit;
}
require 'php/patientActivelogin.php';
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

     <link rel="stylesheet" href="css/Desktop/Admin-adminGlobal.css">
     <link rel="stylesheet" href="css/Desktop/Patient-patientAppointment.css">
  
     <link rel="shortcut icon" type="image/png" href="upload_img_generic/<?php echo $row_g['g_LogoDark']; ?>"> 
     
     <link rel="stylesheet" href="AnimBackend/jquery.css">
     <script src="AnimBackend/jquery.js"></script>
     <script src="AnimBackend/jquery1.js"></script>
     <script src="js/table2excel.js"></script>

  </head>

<body onload="renderDate()">

<div class="for_desktop"><!--For Descktop div-->
<input type="hidden" value="<?php echo $row_g['holidays']; ?>" id="hidden_holiday">

    <div id="left" class="side_navbar"><!-- Left part-->
            <div id="left_bar">
                    <div id="logo_bar" class="left_bar1">
                        <img src="upload_img_generic/<?php echo $row_g['g_LogoLight']; ?>" id="logo_img">
                        <img src="images/icons/dashboard/hamburger_dashboard.png" id="burger_img" title="Maximize" onclick="maximize_navbar()">
                    </div>

                    <div id="icons_navbar" class="left_bar2"><!-- icons navbar container -->
                        <div id="icons_container" class="dash_navbar" onmouseover="hover_navbar('dash_navbar')" onmouseout="mouseout_navbar('dash_navbar')"><img src="images/icons/dashboard/dashboard.png" title="Dashboard"></div>
                        <div id="icons_container" class="profile_navbar" onmouseover="hover_navbar('profile_navbar')" onmouseout="mouseout_navbar('profile_navbar')"><img src="images/icons/dashboard/profile.png" title="Profile"></div>
                        <div id="icons_container" class="staff_navbar" onmouseover="hover_navbar('staff_navbar')" onmouseout="mouseout_navbar('staff_navbar')"><img src="images/icons/dashboard/staff.png" title="Staff"></div>
                        <div id="icons_container" class="appointment_navbar" style="background-color: #5B8DFF;"><img src="images/icons/dashboard/appointment.png" title="Appointment"></div>
                   
                        <div id="icons_container" style="visibility:hidden;"></div>
                        <div id="icons_container" style="visibility:hidden;"></div>
                    </div><!-- End icons navbar container -->

                    <div id="profile_navbar" class="left_bar3"><!-- profile navbar container -->
                        <div id="profile_container" title="Sign out" onclick="logoutPatient()">
                            <img src="images/icons/dashboard/logout.png">
                        </div>
                    </div><!-- End profile navbar container -->


            </div>
            <div id="right_bar">

                    <div id="logo_bar" class="right_navbar"><!-- Top Logo container -->
                        <div id="logo_text">
                            <p class="a" style="text-transform:uppercase;"><?php echo $rowNameFirst; ?></p>
                            <p class="b"><?php echo $rowSecondName; ?></p>
                        </div>
                        <img src="images/icons/dashboard/largburger_dashboard.png" title="Minimize" onclick="minimize_navbar()">
                    </div><!-- End of for logo container -->

                    <div id="icons_navbar" class="right_navbar"><!-- icons navbar container -->
                        <div id="icons_container" class="dash_navbar" onmouseover="hover_navbar('dash_navbar')" onmouseout="mouseout_navbar('dash_navbar')">Dashboard</div>
                        <div id="icons_container" class="profile_navbar" onmouseover="hover_navbar('profile_navbar')" onmouseout="mouseout_navbar('profile_navbar')">Profile</div>
                        <div id="icons_container" class="staff_navbar" onmouseover="hover_navbar('staff_navbar')" onmouseout="mouseout_navbar('staff_navbar')">Staff</div>
                        <div id="icons_container" class="appointment_navbar" style="background-color: #5B8DFF;">Appointment</div>
                  
                        <div id="icons_container" style="visibility:hidden;"></div>
                        <div id="icons_container" style="visibility:hidden;"></div>
                    </div><!-- End icons navbar container -->

                    <div id="profile_navbar" class="right_navbar"><!-- profile navbar container -->
                        <div id="profile_container" class="profile_right_cont" onclick="logoutPatient()">
                                <div id="name_profile">
                                    <p id="name_text">Sign Out</p>
                                </div>
                                
                        </div>
                    </div><!-- End profile navbar container -->
            </div>
    </div><!-- End of Left part-->

    <div id="right" class="right_content_dashboard for_reload_right_table">
            <div id="dashboard_top">
                <div id="dash_left">Appointment</div>
                <div id="dash_right">
                    <?php  //php for displaying the hover icon 
                        $row = mysqli_fetch_array($search_resulthover);   
                    ?>
                    <div id="profile_container" title="Visit Profile" onclick="profile()">
                        <img src="upload_img/<?php echo $row['profile_photo']; ?>" id="profile_img" onerror="this.src='upload_img/account.png'">
                        <div id="name_profile">
                            <p id="name_text"><?php echo $row['fname']; ?></p>
                            <p id="role_text"><?php echo $row['role']; ?>Patient Account</p>
                        </div>
                    </div><!-- End of profile container -->
                </div>
            </div><!-- End of dashboard top -->

            <div id="dashboard_content">

                <div id="top_dashboard_content">
                        <div id="left_top_dashboard_content">
                            <div class="appointment_choices" id="recentAppDiv" style="box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px; background-color: rgb(248, 248, 248);" onclick="goRecentAppointment()">Recent Appointment</div>
                            <div class="appointment_choices" id="schedAppDiv" onclick="goMakeAppointment()">Schedule Appointment</div>
                        </div>
                        <div id="right_top_dashboard_content">
                            <p id="date"><?php echo date("F j, Y") ?></p>
                            <p id="time"><?php echo date("h:i A") ?></p>
                        </div>
                </div><!-- End of top_dashboard_content -->

        <!------------------------------------------Recent Appointment-------------------------------------------------------->

                <div id="recentAppointmentTable">
                    <div id="recentAppt_header">
                        <img src="images/icons/dashboard/appointment_patient.png">
                        Appointment History
                    </div>

                    <div id="recentAppContent">

                    <?php
                        $patient_id = $row['id'];            
                        $sql = "SELECT * FROM doctorreport_tb  WHERE patient_id='$patient_id' order by date desc"; 
                        $patientLog_tb = filterLog($sql);
                        function filterLog($sql){  
                            $con=mysqli_connect('localhost','root','','robles_db');
                            $filter_log = mysqli_query($con, $sql);
                            return $filter_log; 
                        }
                        $sr = 0; 
                        while($rowD = mysqli_fetch_array($patientLog_tb)){ 
                            $newdate = $rowD['date'];
                            $date = strtotime($newdate)
                    ?>
                        <div class="boxRecentApp" onclick="viewPatientHistory('<?php echo date('F j, Y',$date);?>','<?php echo $rowD['doctor'];?>','<?php echo $rowD['mw1'].' & '.$rowD['mw2']; ?>','<?php echo $rowD['bp'];?>' , '<?php echo $rowD['diagnostic'];?>' , '<?php echo $rowD['prescribe'];?>')">
                            <img src="images/icons/dashboard/recentApp_line.png" alt="">
                            <div id="box">
                                <div class="part" style="border-right:1px solid #bbbbbb;">
                                    <p id="date"><?php echo date('F j, Y',$date);?></p>
                                    <p id="time"><?php echo $rowD['time'];?></p>
                                </div>
                                <div class="part" style="border-right:1px solid #bbbbbb;">
                                    <p class="head">Doctor’s Name</p>
                                    <p class="subhead"><?php echo $rowD['doctor'];?></p>
                                </div>
                                <div class="part" style="border-right:1px solid #bbbbbb;">
                                    <p class="head">Staffs Duty</p>
                                    <p class="subhead"><?php echo $rowD['mw1'];?></p>
                                    <p class="subhead"><?php echo $row['mw2'];?></p>
                                </div>
                                <div class="part">
                                    <p class="head">Type of Service</p>
                                    <p class="subhead"><?php echo $rowD['service'];?></p>
                                </div>
                            </div>
                        </div>
                        <?php
                           $sr++; 
                            } 
                        ?>     

                                    <!--No Rerords-->
                                    <div id="no_dataVerifyer">
                                        <img src="images/icons/dashboard/no_data_found.png">
                                        NO RECORDS AVAILABLE
                                    </div>
                                    <script>
                                            var totalRowCount = document.getElementById("recentAppContent").childElementCount;
                                            if(totalRowCount === 2){                
                                                document.getElementById("no_dataVerifyer").style.display = "flex"
                                            }
                                     </script>
                    </div>
                </div>

    <!-------------------------------------------------------------------------------------------------------------------->

     <!------------------------------------------Schedule Appointment-------------------------------------------------------->

                <div id="scheduleAppointmentTable">
                    <div id="scheduleAppt_header">
                        <img src="images/icons/dashboard/appointment_patient.png">
                        Make an Appointment
                    </div>

                    <div id="left">
                        <img src="images/icons/dashboard/calendar_img.png" alt="">
                        <div id="cont_left">
                                <p id="dayc"><?php echo date("l"); ?></p>
                                <p id="daynum"><?php echo date("d"); ?></p>
                        </div>

                        <div id="color_legends">
                            <div id="bottom">
                                <div id="legends" style="margin-right:15%;">
                                    <div class="boxl" style="background-color:#4DA3D4;"></div>Today
                                </div>
                                <div id="legends">
                                    <div class="boxl"></div>Chosen
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="right">
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
                    </div>

                </div>

                <!-------------------------------------------------------------------------------------------------------------------->
               
            </div><!-- End of dashboard_content -->

    </div><!-- right_content_dashboard -->

</div> <!-- End of for_desktop div -->

<div id="show_history_content">
    <div id="content_hist">
        <div id="head">
            <img src="images/icons/dashboard/medical_pres.png">
            Appointment Record
        </div>

        <div id="content" style="font-size: 3vh;">
            <label>Date : </label>
            <span id="view_dateH"></span>
        </div>

        <div id="content"  style="font-size: 3vh;">
            <label>Doctor : </label>
            <span id="view_doctorH"></span>
        </div>

        <div id="content">
            <label>Duty : </label>
            <span id="view_dutyH"></span>
        </div>

        <div id="content"  style="font-size: 3vh;">
            <label>Blood Pressure : </label>
            <span id="view_bpH"></span>
        </div>

        <div id="content1">
            <label>Diagnosis :</label>
            <textarea id="viewDiag_h"  readonly></textarea>
        </div>

        <div id="content1">
            <label>Medicine Prescribed  :</label>
            <textarea id="viewPres_h"  readonly></textarea>
        </div>

        <div id="buttonsIssue">
            <Button onclick="closePatientHistory()">
                <img src="images/icons/dashboard/submit.png" style="transform: rotate(180deg); margin-right:20%;">
                Close
            </Button>
        </div>

    </div>
</div>


<!--Form appointment-->
<div id="form_App">
        <div id="form_content" class="making_appointment_form">
            <form action="javascript:void(0)" method="GET" id="ajax-form-Patientappointment">
            <div id="top">
                <div id="one">Make new appointment</div>
                <div id="two">
                    <div id="left">
                        <div id="l">
                            <img src="upload_img/<?php echo $row['profile_photo']; ?>" onerror="this.src='upload_img/account.png'">
                        </div>
                        <div id="r" class="to_reloadInput">
                            <p id="name" class=><?php echo $row['fname'].' '.$row['lname']; ?></p>
                            <p id="email"><?php echo $row['email']; ?></p>
                            <input type="hidden" name="firstname" value="<?php echo $row['fname']; ?>">
                            <input type="hidden" name="middlename" value="<?php echo $row['mname']; ?>">
                            <input type="hidden" name="lastname" value="<?php echo $row['lname']; ?>">
                            <input type="hidden" name="address" value="<?php echo $row['barangay'].", ".$row['municipality'].", ".$row['province']; ?>">
                            <input type="hidden" name="contact" value="<?php echo $row['contact']; ?>">
                            <input type="hidden" name="email" value="<?php echo $row['email']; ?>">        
                            <input type="hidden" name="id_key" value="<?php echo $row['id']; ?>">                 
                        </div>
                    </div>

                    <div id="right">
                        <div id="edit_content" onclick="openInNewTabAppointment()">
                            <img src="images/icons/edit_profile.png">
                            Edit Profile
                        </div>
                    </div>
                </div>
            </div><!--End of top-->

            <div id="middle">
                <div id="left">
                    <img src="images/icons/dashboard/recentApp_line.png" alt="">
                    <img src="images/icons/dashboard/recentApp_line.png" alt="">
                </div>
                <div id="right">
                    <p id="select_time_text">Select Time</p>
                    <div id="time_content">
                        <div id="available_time">
                            <table id="table_app"> 
                                <?php
                                error_reporting(0);
                                $flag = true;
                                $session_date_appointment = $_SESSION["date_appointment"];     

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
                                    <div class="radio">
                                        <input id="radio-<?php echo $sr; ?>" name="radioPatient" type="radio">
                                        <label for="radio-<?php echo $sr; ?>" class="radio-label"><?php echo $time[$x]; ?></label>
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
                </div>
            
            </div><!--End of middle-->

            <div id="bottom">
                <div id="left">
                    <img src="images/icons/dashboard/recentApp_line.png" alt="">
                </div>
                <div id="right">
                    <div id="info_box">
                        <img src="images/icons/info.png">
                        This is all the available slots
                    </div>
                </div>
            </div><!--End of bottom-->

            <div id="bottom1">
                <div id="left">
                    <img src="images/icons/dashboard/recentApp_line.png" alt="">
                </div>
                <div id="right">
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
            </div><!--End of bottom-->


            <div id="validator">
                <div id="left">
                    <img src="images/icons/dashboard/recentApp_line.png" alt="">
                </div>

                <div id="right">
                    <div id="dateTime_box">
                        <div id="top1">
                            <img src="images/icons/dashboard/appointment_patient.png">
                            Time & Date
                        </div>
                        <p id="date_text"><span id="span_dateApp"></span>, <span id="span_exactDateApp"></span> | <span id="span_exactTimeApp">00:00 - 00:00</span></p>
                    </div>       
                </div>
            </div><!--End of validator-->

            <div id="button">
                    <input type="hidden" name="date1" id="sched_appointment_input">
                    <input type="hidden" name="time1" id="time_appointment_input">
                    <button type="button" id="close_appointment" style="margin-right:2%;" onclick="close_formContent()">Cancel</button>
                    <button id="submit_appointment" type="sumit">Submit</button>
            </div>
        </form>
        </div>
</div>


<!--Validation-->
<div id="validation_appointment">
     <div class="left">
         <img src="images/gif/succes.gif" alt="" id="validationAppointment_img">
     </div>
     <div class="center">
         <p id="text_validationHeader">Thank You</p>
         <p id="text_validationContent">Expect a feedback us later, Kindly check your email in a few to see if your appointment is accepted.</p>
     </div>
     <div class="right">  <p id="close_validationAppointment" onclick="closeAppointValidation()">OK</p>   </div>
</div>


</body>

</html>


<!-- Jquery for tooltips-->
<script src="jquery/tooltip.js"></script>
<!-- Jquery for termsAndprivacy-->
<script src="jquery/termsAndprivacy.js"></script>
<!-- Jquery for adminAnim-->
<script src="jquery/adminAnim.js"></script>

<!-- Script for side navbar -->
<script src="js/sidenavbar_Patient.js"></script>

<!-- Script for patient appointment -->
<script src="js/patientAppointment.js"></script>

<!--ajax for logut-->
<script src="ajax/logoutAdmin.js"></script>
<!-- Ajax for making appointment -->
<script src="ajax/appointment.js"></script>
<!-- Ajax for making appointment -->
<script src="ajax/patientAppointment.js"></script>





