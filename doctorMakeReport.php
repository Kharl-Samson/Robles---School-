<?php
session_start();
date_default_timezone_set('Asia/Manila');
if(!isset($_SESSION["ob_active"])){
    header("location: adminLogin.php");
    exit;
}
require 'php/obActivelogin.php';

$key_patient=$_SESSION['patient_edit_view'];
$sql1 = "SELECT * FROM `patientinfo_db` WHERE id='$key_patient'";
$search_resultPatient = filterTablePatient($sql1);
function filterTablePatient($sql1){  
$con=mysqli_connect('localhost','root','','robles_db');
$filter_Patient = mysqli_query($con, $sql1);
return $filter_Patient; 
}
$row1 = mysqli_fetch_array($search_resultPatient);   

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
     <link rel="stylesheet" href="css/Desktop/Doctor-makereportDoctor.css">
  
     <link rel="shortcut icon" type="image/png" href="upload_img_generic/<?php echo $row_g['g_LogoDark']; ?>"> 

     <link rel="stylesheet" href="AnimBackend/jquery.css">
     <script src="AnimBackend/jquery.js"></script>
     <script src="AnimBackend/jquery1.js"></script>
     <script src="js/table2excel.js"></script>
  </head>

<body>

<div class="for_desktop"><!--For Descktop div-->

<div id="for_notif_hide">
<div id="notification_content">
    <div id="top_notif"><span>Notifications</span> <span id="notif_bilang"></span></div>
    <div id="notif_content">
    <?php  //php for displaying all items
    $notifCount1 = 0;
    $notifCount2 = 0;
        $sql_crit = "SELECT * FROM medicine_tb ORDER BY name DESC "; 
        $search_pendingApp_crit = filterTableNOTIFstock($sql_crit);
        function filterTableNOTIFstock($sql_crit){  
            $con_crit=mysqli_connect('localhost','root','','robles_db');
            $filter_pendingAppCrit = mysqli_query($con_crit, $sql_crit);
                                    return $filter_pendingAppCrit; 
        }
        $sr = 0; 
        while($rowNotif = mysqli_fetch_array($search_pendingApp_crit)):

            $strSubname = $rowNotif['subname'];
            $strSubstock = $rowNotif['substock'];
            $strSubcategory = $rowNotif['category'];
            $strSubexpdate = $rowNotif['expiration_date'];
            $strSubStat = $rowNotif['status'];
            $strStCRIT= $rowNotif['critStock'];

            $arraySubname = explode(',', $strSubname );
            $arraySubstock = explode(',', $strSubstock );
            $arrayCategory = explode(',', $strSubcategory );
            $arrayExpdate = explode(',', $strSubexpdate );
            $arrayStat = explode(',', $strSubStat );
            $arraySTCrit = explode(',', $strStCRIT );

            $totalStock2 = 0;
            for($z = 0 ; $z<count($arraySubname); $z++){
                if($arrayStat[$z] == "activated" && $arraySubstock[$z] <=$arraySTCrit[$z] ){
                    $totalStock2+=$arraySubstock[$z];
                }
            }
            for($x = 0 ; $x<count($arraySubname); $x++){
                if($arrayStat[$x] == "activated" && $arraySubstock[$x] <= $arraySTCrit[$x]){
                    $notifCount1++;
        ?>
            <div id="notif_box" class="notif_boxMidwife">
                <div id="left"><img src="images/icons/dashboard/medicine2.png" alt=""></div>
                <div id="right">
                    <p id="exp">Stocks Report</p>
                    <p id="mid"><span style="text-transform: Capitalize;"><?php echo $arraySubname[$x]; ?></span> | <span><?php echo $arraySubstock[$x]; ?> pcs</span></p>
                    <p id="cat"><?php echo $arrayCategory[$x]; ?></p>
                </div>
            </div>
        <?php
            }
         }  
     $sr++; endwhile;  
     ?> <!--End of Php -->
    <?php  //php for displaying all items
        date_default_timezone_set('Asia/Manila');
        $date = new DateTime('now');
        $date->modify('+5 month'); // or you can use '-90 day' for deduct
        $effectiveDate = $date->format('Y-m-d');
                                           
        $sql_exp = "SELECT * FROM medicine_tb ORDER BY name DESC "; 
        $search_pendingApp_exp = filterTableNotifExp($sql_exp);
        function filterTableNotifExp($sql_exp){  
            $con_crit=mysqli_connect('localhost','root','','robles_db');
            $filter_pendingAppExp = mysqli_query($con_crit, $sql_exp);
            return $filter_pendingAppExp; 
        }
        $sr = 0; 
        while($row_Notif = mysqli_fetch_array($search_pendingApp_exp)):

            $strSubname = $row_Notif['subname'];
            $strSubstock = $row_Notif['substock'];
            $strSubcategory = $row_Notif['category'];
            $strSubexpdate = $row_Notif['expiration_date'];
            $strSubStat = $row_Notif['status'];

            $arraySubname = explode(',', $strSubname );
            $arraySubstock = explode(',', $strSubstock );
            $arrayCategory = explode(',', $strSubcategory );
            $arrayExpdate = explode(',', $strSubexpdate );
            $arrayStat = explode(',', $strSubStat );

            $totalStock2 = 0;
            for($z = 0 ; $z<count($arraySubname); $z++){
                if($arrayStat[$z] == "activated" && $arrayExpdate[$z] <= $effectiveDate ){
                     $totalStock2+=$arraySubstock[$z];
                }
            }
                    
            for($x = 0 ; $x<count($arraySubname); $x++){
                if($arrayStat[$x] == "activated" && $arrayExpdate[$x] <= $effectiveDate){
                    $notifCount2++;
                    $date = date('Y-m-d');
                    $earlier = new DateTime($date);
                    $later = new DateTime($arrayExpdate[$x]);
                                    
                    if($earlier>=$later){
                        $abs_diff = "Already expired";
                    }
                    else{
                        $abs_diff = $later->diff($earlier)->format("%a")." day/s to expire"; //3 
                    }
            ?>
            <div id="notif_box" class="notif_boxMidwife">
                <div id="left"><img src="images/icons/dashboard/medicine2.png" alt=""></div>
                <div id="right">
                    <p id="exp">Expiration Report</p>
                    <p id="mid"><span style="text-transform: Capitalize;"><?php echo $arraySubname[$x]; ?></span> | <span><?php echo $abs_diff; ?></span></p>
                    <p id="cat"><?php echo $arrayCategory[$x]; ?></p>
                </div>
            </div>
        <?php
         }
        }  
        $sr++; endwhile; 
        ?> <!--End of Php -->
    </div>
</div>
</div>

<div id="left" class="side_navbar"><!-- Left part-->
            <div id="left_bar">
                    <div id="logo_bar" class="left_bar1">
                        <img src="upload_img_generic/<?php echo $row_g['g_LogoLight']; ?>" id="logo_img">
                        <img src="images/icons/dashboard/hamburger_dashboard.png" id="burger_img" title="Maximize" onclick="maximize_navbar()">
                    </div>

                    <div id="icons_navbar" class="left_bar2"><!-- icons navbar container -->
                        <div id="icons_container"  class="dash_navbar" onmouseover="hover_navbar('dash_navbar')" onmouseout="mouseout_navbar('dash_navbar')"><img src="images/icons/dashboard/dashboard.png" title="Dashboard"></div>
                        <div id="icons_container" class="profile_navbar" onmouseover="hover_navbar('profile_navbar')" onmouseout="mouseout_navbar('profile_navbar')" ><img src="images/icons/dashboard/profile.png" title="Profile"></div>
                        <div id="icons_container" class="patient_navbar" style="background-color: #5B8DFF;"><img src="images/icons/dashboard/patient.png" title="Patient"></div>
                        <div id="icons_container" class="staff_navbar" onmouseover="hover_navbar('staff_navbar')" onmouseout="mouseout_navbar('staff_navbar')"><img src="images/icons/dashboard/staff.png" title="Staff"></div>
                        <div id="icons_container" class="inventory_navbar" onmouseover="hover_navbar('inventory_navbar')" onmouseout="mouseout_navbar('inventory_navbar')"><img src="images/icons/dashboard/inventory.png" title="Inventory"></div>
                        <div id="icons_container" class="appointment_navbar" onmouseover="hover_navbar('appointment_navbar')" onmouseout="mouseout_navbar('appointment_navbar')"><img src="images/icons/dashboard/appointment.png" title="Appointment"></div>
                        <div id="icons_container" class="setting_navbar" onmouseover="hover_navbar('setting_navbar')" onmouseout="mouseout_navbar('setting_navbar')"><img src="images/icons/dashboard/settings.png" title="Settings"></div>
                    </div><!-- End icons navbar container -->

                    <div id="profile_navbar" class="left_bar3"><!-- profile navbar container -->
                        <div id="profile_container" title="Sign out" onclick="logoutOb()">
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
                        <div id="icons_container" class="patient_navbar" style="background-color: #5B8DFF;">Patient</div>
                        <div id="icons_container" class="staff_navbar" onmouseover="hover_navbar('staff_navbar')" onmouseout="mouseout_navbar('staff_navbar')">Staff</div>
                        <div id="icons_container" class="inventory_navbar" onmouseover="hover_navbar('inventory_navbar')" onmouseout="mouseout_navbar('inventory_navbar')">Inventory</div>
                        <div id="icons_container" class="appointment_navbar" onmouseover="hover_navbar('appointment_navbar')" onmouseout="mouseout_navbar('appointment_navbar')">Appointment</div>
                        <div id="icons_container" class="setting_navbar" onmouseover="hover_navbar('setting_navbar')" onmouseout="mouseout_navbar('setting_navbar')">Settings</div>
                    </div><!-- End icons navbar container -->

                    <div id="profile_navbar" class="right_navbar"><!-- profile navbar container -->
                        <div id="profile_container" class="profile_right_cont" onclick="logoutOb()">
                                <div id="name_profile">
                                    <p id="name_text">Sign Out</p>
                                </div>
                                
                        </div>
                    </div><!-- End profile navbar container -->
            </div>
    </div><!-- End of Left part-->

    <div id="right" class="right_content_dashboard for_reload_right_table">
            <div id="dashboard_top">
                <div id="dash_left">Patient Records</div>
                <div id="dash_right">
                    <div id="notification_container">
                        <img src="images/icons/dashboard/notification.png" title="Notification" id="notif_img">
                        <div id="notif_count"><?php echo $notifCount1+$notifCount2; ?></div>
                    </div><!-- End of notification container -->

                    <?php  //php for displaying the hover icon 
                        $row = mysqli_fetch_array($search_resulthover);   
                        $_SESSION["auditname"] = $row['username']
                    ?>
                    <div id="profile_container" title="Visit Profile" onclick="profile()">
                        <img src="upload_img/<?php echo $row['profile_photo']; ?>" id="profile_img" onerror="this.src='upload_img/account.png'">
                        <div id="name_profile">
                            <p id="name_text"><?php echo $row['fname']; ?></p>
                            <p id="role_text"><?php echo $row['role']; ?> Account</p>
                        </div>
                    </div><!-- End of profile container -->
                </div>
            </div><!-- End of dashboard top -->

            <div id="dashboard_content">

                <div id="top_Patient">
                    <div id="left">Patient id : <?php echo $row1['id']?> </div>
                    <div id="right">
                        <p id="date"><?php echo date("F j, Y") ?></p>
                        <p id="time"><?php echo date("h:i A") ?></p>
                    </div>
                </div><!-- End of top staff -->

                <div id="info_profile"> 
                    <img src="upload_img/<?php echo $row1['profile_photo'];?>"  onerror="this.src='upload_img/account.png'">
                    <div id="right">
                        <p id="name_inf"><?php echo $row1['fname']." ".$row1['mname']." ".$row1['lname']; ?></p>
                        <p id="email_inf"><?php echo $row1['email']; ?></p>
                    </div>
                </div>

                <div id="addpatient_div" class="viewPatientContainer">
                    <div id="info_header">
                        <img src="images/icons/dashboard/employee_icon.png">
                        Patient Information
                    </div>

                   <div class="col">
                       <div id="left">
                           <p class="label">First Name</p>
                           <p class="content" id="getFName_1"><?php echo $row1['fname']?></p>
                       </div>
                       <div id="right">
                           <div id="one">
                                <p class="label">Birthday</p>
                                <p class="content"><?php echo $row1['bday']?></p>
                           </div>
                       </div>
                   </div>

                   <div class="col">
                       <div id="left">
                           <p class="label">Middle Name</p>
                           <p class="content"><?php echo $row1['mname']?></p>
                       </div>
                       <div id="right">
                            <p class="label">Age</p>
                            <p class="content" id="getAge_1"><?php echo $row1['age']?> yr/s old</p>
                       </div>
                   </div>

                   <div class="col">
                       <div id="left">
                           <p class="label">Last Name</p>
                           <p class="content" id="getLName_1"><?php echo $row1['lname']?></p>
                       </div>
                       <div id="right">
                           <p class="label">Weight</p>
                           <p class="content"><?php echo $row1['weight']." kg/s";?></p>
                       </div>
                   </div>

         

                   <div class="col">
                       <div id="left">
                           <p class="label">Barangay</p>
                           <p class="content" id="getBar_1"><?php echo $row1['barangay']?></p>
                       </div>
                       <div id="right">
                           <p class="label">Religion</p>
                           <p class="content"><?php echo $row1['religion'];?></p>
                       </div>
                   </div>

                   <div class="col">
                       <div id="left">
                           <p class="label">Municipality</p>
                           <p class="content" id="getMun_1"><?php echo $row1['municipality']?></p>
                       </div>
                       <div id="right">
                           <p class="label">Civil Status</p>
                           <p class="content"><?php echo $row1['civilstatus'];?></p>
                       </div>
                   </div>

                   <div class="col">
                       <div id="left">
                           <p class="label">Province</p>
                           <p class="content" id="getProv_1"><?php echo $row1['province']?></p>
                       </div>
                       <div id="right">
                           <p class="label">Email</p>
                           <p class="content"><?php echo $row1['email'];?></p>
                       </div>
                   </div>

                   <div class="col" style="margin-bottom:5%;">
                       <div id="left">
                           <p class="label">Street</p>
                           <p class="content"><?php echo $row1['street']?></p>
                       </div>
                       <div id="right">
                           <p class="label">Contact</p>
                           <p class="content"><?php echo $row1['contact'];?></p>
                       </div>
                   </div>

                    <div id="info_header" style="margin-top:2%;">
                        <img src="images/icons/dashboard/appointment_history.png">
                        Doctor's Report
                    </div>


                    <form action="javascript:void(0)" method="post" id="ajax-form_Ob_makereport">
                    <input type="hidden" name="patient_id_key" value="<?php echo $row1['id'];?>">
                    <input type="hidden" name="patient_name_key" value="<?php  echo $row1['fname'].' '.$row1['lname']; ?>">
                    <input type="hidden" name="patient_img_key" value="<?php echo $row1['profile_photo'];?>">
                    <div id="report_content">
                        <div id="left">
                            <div id="input_content">
                                <label>Doctor's Name <span style="color:red; font-size:2.5vh;">*</span></label>
                                <select name="doctor_report" id="doctor_report">
                                    <?php
                                        $sql = "SELECT * FROM staff_db WHERE status='Active' and id!='0' and role='Ob-Gyne' " ; 
                                        $search_staff = filterStaff($sql);
                                        function filterStaff($sql){                 
                                            $con=mysqli_connect('localhost','root','','robles_db');
                                            $filter_Staff = mysqli_query($con, $sql);
                                            return $filter_Staff; 
                                        }
                                        $sr = 0; 
                                        while($row = mysqli_fetch_array($search_staff)):
                                    ?>
                                    <option value="<?php echo $row['fname'].' '.$row['lname']; ?>"><?php echo $row['fname'].' '.$row['lname']; ?></option>
                                    <?php
                                    $sr++; endwhile;  ?>
                                    ?>
                                </select>
                            </div>

                            <div id="input_content">
                                <label>Midwife Today <span style="color:red; font-size:2.5vh;">*</span></label>
                                <select name="mw1">
                                <?php
                                    $sql = "SELECT * FROM staff_db WHERE status='Active' and id!='0' and role='Midwife' order by lname asc" ; 
                                    $search_staff = filterStaffMw($sql);
                                    function filterStaffMw($sql){                 
                                         $con=mysqli_connect('localhost','root','','robles_db');
                                        $filter_Staff = mysqli_query($con, $sql);
                                        return $filter_Staff; 
                                    }
                                    $sr = 0; 
                                    while($row = mysqli_fetch_array($search_staff)):
                                    ?>
                                    <option value="<?php echo $row['fname'].' '.$row['lname']; ?>"><?php echo $row['fname'].' '.$row['lname']; ?></option>
                                    <?php
                                    $sr++; endwhile;  ?>
                                    ?>
                                </select>
                            </div>

                            <div id="input_content">
                                <label>Midwife Today <span style="color:red; font-size:2.5vh;">*</span></label>
                                <select name="mw2">
                                <?php
                                    $sql = "SELECT * FROM staff_db WHERE status='Active' and id!='0' and role='Midwife' order by lname desc" ; 
                                    $search_staff = filterStaffMw1($sql);
                                    function filterStaffMw1($sql){                 
                                        $con=mysqli_connect('localhost','root','','robles_db');
                                        $filter_Staff = mysqli_query($con, $sql);
                                        return $filter_Staff; 
                                    }
                                    $sr = 0; 
                                    while($row = mysqli_fetch_array($search_staff)):
                                    ?>
                                    <option value="<?php echo $row['fname'].' '.$row['lname']; ?>"><?php echo $row['fname'].' '.$row['lname']; ?></option>
                                    <?php
                                    $sr++; endwhile;  ?>
                                    ?>
                                </select>
                            </div>

                            <div id="input_content">
                                <label>Date Today <span style="color:red; font-size:2.5vh;">*</span></label>
                                <input type="date" value="<?php echo date('Y-m-d'); ?>" name="date_report" id="date_report" onchange="removeValreport('date_report')" readonly>
                            </div>

                            <div id="input_content">
                                <label>Blood Pressure <span style="color:red; font-size:2.5vh;">*</span></label>
                                <input type="text" placeholder="Ex. 120/80" id="bp_report" name="bp_report" onkeyup="removeValreport('bp_report')">
                            </div>

                            <div id="input_content">
                                <label>Type of Service <span style="color:red; font-size:2.5vh;">*</span></label>
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


                        <div id="right">
                            <div id="input_content1">
                                <label>Prescribe Medicine</label>
                                <textarea placeholder="Ex. Warfarin 10mg Capsule" id="pm_report" name="pm_report" onkeyup="removeValreport('pm_report')"></textarea>
                            </div>

                            <div id="input_content1">
                                <label>Diagnostic <span style="color:red; font-size:2.5vh;">*</span></label>
                                <textarea placeholder="Ex. 5 weeks pregnant" id="d_report" name="d_report" onkeyup="removeValreport('d_report')"></textarea>
                            </div>

                        </div>
                    </div>

                    <div style="width:95%; display:flex; justify-content: flex-end; padding-right:5%;">
                        <Button onclick="goBackViewPatient()" type="button">
                            <img src="images/icons/dashboard/submit.png" style="transform: rotate(180deg); margin-right:20%;">
                            Back
                        </Button>
                        <Button type="button" onclick="showMedPresModal()">
                            <img src="images/icons/dashboard/medical_pres.png" style="margin-right:5%;">
                            Issue Medical Prescription
                        </Button>
                        <Button type="submit">
                            Submit
                            <img src="images/icons/dashboard/submit.png" style="margin-left:20%;">
                        </Button>
                    </div>
                    </form>
                </div>


            </div><!-- End of dashboard_content -->

    </div><!-- right_content_dashboard -->


<!--Validation-->
<div id="validation_report">
     <div class="left">
         <img src="" alt="" id="validationReport_img">
     </div>
     <div class="center">
         <p id="text_validationHeader"></p>
         <p id="text_validationContent"></p>
     </div>
     <div class="right">  <p id="close_validationReport" onclick="close_alertReport()">OK</p>   </div>
</div>



<!--Prescribe medicine modal-->
<div id="prescribe_modal">
    <div id="prescribe_content">
            <div id="top">
                <img src="images/icons/webIcon.png">
                <div>
                    <p id="a">Robles</p>
                    <p id="b">Maternity Clinic</p>
                </div>
            </div>

            <div id="semitop">
                <div id="left">
                    <p id="dr_name"></p>
                    <p id="dr_role">Ob-Gyne</p>
                </div>
                <div id="right">
                    <p id="address1">MacArthur Hwy, Apalit,</p>
                    <p id="address2">Pampanga City 2016, Philippines</p>
                    <p id="contact">+63 923 020 1174</p>
                </div>
            </div>

            <div id="line"></div>

            <div id="info">
                <div id="up">
                    <p id="patient_name">Patient Name :</p>
                    <div id="name_content"></div>
                    <p id="patient_age">Age :</p>
                    <div id="age_content"></div>
                </div>
                <div id="bot">
                    <p id="patient_add">Address :</p>
                    <div id="add_content"></div>
                    <p id="patient_date">Date :</p>
                    <div id="date_content"></div>
                </div>
            </div>

            <p id="rx">Rx</p>

            <div id="medicine_prescribe">
                <pre id="pre_preMed"></pre>
            </div>

            <div id="line"></div>

            <div id="lower">
                <p>Doctor's Signature :</p>
                <div id="line_sig"></div>
            </div>
    </div>

    <div id="buttons_prescribe">
        <button onclick="cancelPrescribemodal()">Cancel</button>
        <button onclick="printContent('prescribe_modal');">
            <img src="images/icons/dashboard/medical_pres.png" style="margin-right:5%;">
            Print
        </button>
    </div>
</div>


</div> <!-- End of for_desktop div -->



</body>

</html>


<!-- Jquery for tooltips-->
<script src="jquery/tooltip.js"></script>
<!-- Jquery for termsAndprivacy-->
<script src="jquery/termsAndprivacy.js"></script>
<!-- Jquery for adminAnim-->
<script src="jquery/adminAnim.js"></script>

<!-- Script for side navbar -->
<script src="js/sidenavbar_Ob.js"></script>


<!-- Script for adminPatient -->
<script src="js/adminPatient.js"></script>



<!--ajax for ob report-->
<script src="ajax/obMakeReport.js"></script>
<!--ajax for logut-->
<script src="ajax/logoutAdmin.js"></script>


<script>
function printContent(idval){
    document.getElementById("buttons_prescribe").style.display="none"
    var restorepage = $('body').html();
    var printcontent = $('#' + idval).clone();
    $('body').empty().html(printcontent);
    setTimeout(function(){
        window.print();  
    }, 3000);
    $('body').html(restorepage);
}

onafterprint = function () {
    location.reload();
    //document.getElementById("prescribe_modal").style.display = "none";
}

function cancelPrescribemodal(){
    document.getElementById("prescribe_modal").style.display = "none";
}

function showMedPresModal(){
    var pm_med = document.getElementById("pm_report").value;
    var doctor = document.getElementById("doctor_report").value;
    var fname = document.getElementById("getFName_1").innerHTML;
    var lname = document.getElementById("getLName_1").innerHTML;
    var age = document.getElementById("getAge_1").innerHTML;
    var bar = document.getElementById("getBar_1").innerHTML;
    var mun = document.getElementById("getMun_1").innerHTML;
    var prov = document.getElementById("getProv_1").innerHTML;
    var date = document.getElementById("date_report").value;
    
    if(pm_med == ""){
        $("#pm_report").css({
            border: "1px solid red",
        })     
        $("#validation_report").css({
            display: "flex",
            borderLeft: "10px solid #DB6F3D",
        })
        $("#validation_report").animate({
            right: "2.5%",
        },500)      
        $("#text_validationHeader").text('Error!');
        $("#text_validationHeader").css({color: "red"})
        $("#close_validationReport").css({color: "red"})
        $("#text_validationContent").text('Prescribe medicine field is required to make a medical prescription!');
        $("#validationReport_img").attr("src","images/gif/error_validation.gif");

        setTimeout(function(){
            $("#validation_report").animate({
                right: "-56%",
            },500)    
        }, 5000);
    }
    else{
        document.getElementById("prescribe_modal").style.display = "flex";
        document.getElementById("dr_name").innerHTML = "Dr/a. "+doctor;
        document.getElementById("name_content").innerHTML = fname+" "+lname;
        document.getElementById("age_content").innerHTML = age;
        document.getElementById("add_content").innerHTML = bar+", "+mun+" ,"+prov;
        document.getElementById("date_content").innerHTML = date;
        document.getElementById("pre_preMed").innerHTML = pm_med; 
    }
}
</script>

