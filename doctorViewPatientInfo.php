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
     <link rel="stylesheet" href="css/Desktop/Doctor-patientviewDoctor.css">
  
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
                           <p class="content" id="fnameI"><?php echo $row1['fname']?></p>
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
                            <p class="content" id="ageI"><?php echo $row1['age']?> yr/s old</p>
                       </div>
                   </div>

                   <div class="col">
                       <div id="left">
                           <p class="label">Last Name</p>
                           <p class="content" id="lnameI"><?php echo $row1['lname']?></p>
                       </div>
                       <div id="right">
                           <p class="label">Weight</p>
                           <p class="content"><?php echo $row1['weight']." kg/s";?></p>
                       </div>
                   </div>

         

                   <div class="col">
                       <div id="left">
                           <p class="label">Barangay</p>
                           <p class="content" id="barI"><?php echo $row1['barangay']?></p>
                       </div>
                       <div id="right">
                           <p class="label">Religion</p>
                           <p class="content"><?php echo $row1['religion'];?></p>
                       </div>
                   </div>

                   <div class="col">
                       <div id="left">
                           <p class="label">Municipality</p>
                           <p class="content" id="munI"><?php echo $row1['municipality']?></p>
                       </div>
                       <div id="right">
                           <p class="label">Civil Status</p>
                           <p class="content"><?php echo $row1['civilstatus'];?></p>
                       </div>
                   </div>

                   <div class="col">
                       <div id="left">
                           <p class="label">Province</p>
                           <p class="content" id="provI"><?php echo $row1['province']?></p>
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
<!--------------------------------------------------------------------->
                <?php
                  $keyMail = $row1['email'];
                  $sql_general_service = "SELECT * FROM `patientinfo_db` WHERE email='$keyMail'";
                  $search_General_service = filterObHist($sql_general_service);
                  function filterObHist($sql_general_service){  
                      $con1=mysqli_connect('localhost','root','','robles_db');
                      $filter_service = mysqli_query($con1, $sql_general_service);
                  return $filter_service; 
                  }
                  while($row_general = mysqli_fetch_array($search_General_service)){
                        if($row_general['gender_ob'] != ""){
                   ?>
                    <div id="info_header" style="margin-top:2%;">
                        <img src="images/icons/dashboard/ob_history.png">
                        Obstestrical History
                    </div>
                   <?php
                      $strgender_ob = $row_general['gender_ob'];
                      $strbday_ob = $row_general['bday_ob'];
                      $strbplace_ob = $row_general['bplace_ob'];
                      $strweight_ob = $row_general['weight_ob'];
                      $strdelivery_ob = $row_general['delivery_ob'];
                      $strbirth_ob = $row_general['birth_ob'];
      
                      $arraygender_ob = explode(',', $strgender_ob);
                      $arraybday_ob = explode(',', $strbday_ob);
                      $arraybplace_ob = explode('|', $strbplace_ob); 
                      $arrayweight_ob = explode(',', $strweight_ob);
                      $arraydelivery_ob = explode(',', $strdelivery_ob);
                      $arraybirth_ob = explode(',', $strbirth_ob);
                      $z = 0;
                     
                      while($z<count($arraygender_ob)){
                ?>
                   <p style="font-family: 'Poppins', sans-serif;font-size:3vh;font-weight:bold;margin:0;margin-left:5%;margin-top:4%;">Child <?php echo $z+1; ?></p>
                   <div class="col">
                       <div id="left">
                           <p class="label">Gender</p>
                           <p class="content" id="fnameI"><?php echo $arraygender_ob[$z]; ?></p>
                       </div>
                       <div id="right">
                           <div id="one">
                                <p class="label">Birthday</p>
                                <p class="content"><?php echo $arraybday_ob[$z]; ?></p>
                           </div>
                       </div>
                   </div>
                   <div class="col">
                       <div id="left">
                           <p class="label">Birthplace</p>
                           <p class="content" id="fnameI"><?php echo $arraybplace_ob[$z]; ?></p>
                       </div>
                       <div id="right">
                           <div id="one">
                                <p class="label">Weight</p>
                                <p class="content"><?php echo $arrayweight_ob[$z]; ?> kgs.</p>
                           </div>
                       </div>
                   </div>
                   <div class="col">
                       <div id="left">
                           <p class="label">Type of Delivery</p>
                           <p class="content" id="fnameI"><?php echo $arraydelivery_ob[$z]; ?></p>
                       </div>
                       <div id="right">
                           <div id="one">
                                <p class="label">Type of Birth</p>
                                <p class="content"><?php echo $arraybirth_ob[$z]; ?></p>
                           </div>
                       </div>
                   </div>
                <?php
                    $z++;
                    }
                     }
                    }
                ?>
        <!--------------------------------------------------------------------->
                    <div id="info_header" style="margin-top:2%;">
                        <img src="images/icons/dashboard/appointment_history.png">
                        Patient | Appointment History
                    </div>

                    <div id="history_header">
                        <div class="column column1">Doctor’s Name</div>
                        <div class="column column2">Date</div>
                        <div class="column column3">Blood Pressure</div>
                        <div class="column column4">Prescribe Medicine</div>
                        <div class="column column5">Diagnostic</div>
                    </div>

                    <?php  //php for displaying all items
                        require_once "Z-connection.php";
                        $patient_id = $row1['id'];

                        //checking if email already exist
                        $s_report = "SELECT * FROM doctorreport_tb WHERE patient_id='$patient_id'";
                        $result_report = mysqli_query($conn, $s_report);
                        $num_report = mysqli_num_rows($result_report); 

                        $sql = "SELECT * FROM doctorreport_tb WHERE patient_id='$patient_id' order by date desc"; 
                        $patientLog_tb = filterLog($sql);
                        function filterLog($sql){  
                            $con=mysqli_connect('localhost','root','','robles_db');
                            $filter_log = mysqli_query($con, $sql);
                            return $filter_log; 
                        }
                        $sr = 0; 
  
                        if($num_report == 0){
                    ?>
                         <div id="no_record">
                            <img src="images/icons/dashboard/no_record_found.png" alt="">
                            NO RECORDS
                         </div>

                    <?php    
                        }
                        else{
                            while($row = mysqli_fetch_array($patientLog_tb)){     
                    ?>  
                            <div id="history_content">
                                <div id="history_row">
                                    <div class="column column1"><?php echo $row['doctor']; ?></div>
                                    <div class="column column2"><?php echo $row['date']; ?></div>
                                    <div class="column column3"><?php echo $row['bp']; ?></div>
                                    <div class="column column4"><?php echo $row['prescribe']; ?></div>
                                    <div class="column column5"><?php echo $row['diagnostic']; ?></div>
                                </div>
                            </div>
                    <?php
                        $sr++; 
                        }  
                            }
                    ?> <!--End of Php -->

                    <div style="width:95%; display:flex; justify-content: flex-end; padding-right:5%;">
                        <Button onclick="goBackViewPatient()">
                            <img src="images/icons/dashboard/submit.png" style="transform: rotate(180deg); margin-right:20%;">
                            Back
                        </Button>
                        <Button type="button" onclick="show_IssueMed()">
                            <img src="images/icons/dashboard/medical_pres.png" style="margin-right:3%;">
                            Issue Medical Certificate
                        </Button>
                    </div>
                </div>


            </div><!-- End of dashboard_content -->

    </div><!-- right_content_dashboard -->



<div id="med_Cert_container">
    <div id="medcert_content">
        <div id="top">
            <img src="images/icons/dashboard/medical_pres.png">
            Issue Medical Certificate
        </div>

        <div id="content">
            <label>Gravida : </label>
            <input type="number" placeholder="Ex. 5" id="gravida">
        </div>

        <div id="content">
            <label>Parity : </label>
            <input type="number" placeholder="Ex. 5" id="parity">
        </div>

        <div id="content1">
            <label>Diagnosis :</label>
            <textarea id="diagnosis" placeholder="Your diagnosis here...."></textarea>
        </div>

        <div id="content1">
            <label>Procedure Done :</label>
            <textarea id="procedure" placeholder="Procedure done here...."></textarea>
        </div>

        <div id="content1">
            <label>Recommendations :</label>
            <textarea id="recommendation" placeholder="Your recommendations here...."></textarea>
        </div>

        <div id="buttonsIssue">
            <Button onclick="close_IssueMed()">
                <img src="images/icons/dashboard/submit.png" style="transform: rotate(180deg); margin-right:20%;">
                Back
            </Button>
            <Button onclick="goIssueMedicalCertificate()">
                Next
                <img src="images/icons/dashboard/submit.png" style="margin-left:20%;">
            </Button>
        </div>
    </div>
</div>   


<div id="medical_certificate">
    <div id="medical_certificate_content">
        <div id="top">
            <p id="a">ROBLES MATERNITY CLINIC</p>
            <p id="b">McArthur Highway, San Vicente, Apalit, Pampanga</p>
            <p id="b">09230201174</p>
        </div>

        <p id="medical_text">MEDICAL CERTIFICATE</p>
        <p id="towhom">TO WHOM IT MAY CONCERN:</p>

        <p id="medical_sentence">This is to certify that <span id="i_name"></span>, <span id="i_age"></span>. Gravida - <span id="i_gravida"></span>, Parity - <span id="i_parity"></span> residing at <span id="i_add"></span> was seen/examined/admitted on <span id="i_date"></span> under my service at Robles Maternity Clinic with the diagnosis of <span id="i_diagnosis"></span></p>

        <p id="procedure_done">Procedure Done: <span id="i_procedure"></span></p>

        <p id="procedure_done">Recommendation/s: <span id="i_recco"></span></p>

        <p id="this_cert">This is to certificate has been issued upon her request for whatever purpose this may serve her and not for any legal purposes.</p>

        <div id="bottom">
            <div id="left">
                <div id="date_cont"></div>
                <p>Date</p>
                <p style="visibility:hidden;">.</p>
            </div>

            <div id="right">
                <div id="d_cont"></div>
                <p>Maria Esperanza T. Robles,M.D.,FPOGS</p>
                <p>Lic. No. 074268</p>
            </div>
        </div>
        
    </div>


    <div id="buttons_Issue">
        <button onclick="cancelPrintMedCert()">Cancel</button>
        <button onclick="printContent('medical_certificate');">
            <img src="images/icons/dashboard/medical_pres.png" style="margin-right:5%;">
            Print
        </button>
    </div>
</div>
    

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
<!-- Script for patient page -->
<script src="js/patientPage.js"></script>
<!-- Script for adminPatient -->
<script src="js/adminPatient.js"></script>


<!--ajax for logut-->
<script src="ajax/logoutAdmin.js"></script>

<script>
function printContent(divName) {
document.getElementById("buttons_Issue").style.display="none"
var printContents = document.getElementById(divName).innerHTML;
w = window.open();

w.document.write(printContents);
w.document.write('<scr' + 'ipt type="text/javascript">' + 'window.onload = function() { window.print(); window.close(); };' + '</sc' + 'ript>');

w.document.close(); // necessary for IE >= 10
w.focus(); // necessary for IE >= 10
 document.getElementById("medical_certificate").style.display = "none";
return true;
}


function cancelPrintMedCert(){
    document.getElementById("medical_certificate").style.display = "none";
}

//close sweet alert
function close_alertReport(){
    $("#validation_report").animate({
        right: "-56%",
    },500)     
}
</script>