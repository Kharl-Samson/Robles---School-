<?php
session_start();
date_default_timezone_set('Asia/Manila');
if(!isset($_SESSION["user_active"])){
    header("location: adminLogin.php");
    exit;
}
require 'php/adminActivelogin.php';

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
     <link rel="stylesheet" href="css/Desktop/Admin-adminEditPatientInfo.css">
  
     <link rel="shortcut icon" type="image/png" href="upload_img_generic/<?php echo $row_g['g_LogoDark']; ?>"> 

     <link rel="stylesheet" href="AnimBackend/jquery.css">
     <script src="AnimBackend/jquery.js"></script>
     <script src="AnimBackend/jquery1.js"></script>
     <script src="js/table2excel.js"></script>
     <script type="text/javascript" src="AnimBackend/location.js"></script>
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
                        <div id="icons_container" class="dash_navbar" onmouseover="hover_navbar('dash_navbar')" onmouseout="mouseout_navbar('dash_navbar')"><img src="images/icons/dashboard/dashboard.png" title="Dashboard"></div>
                        <div id="icons_container" class="profile_navbar" onmouseover="hover_navbar('profile_navbar')" onmouseout="mouseout_navbar('profile_navbar')"><img src="images/icons/dashboard/profile.png" title="Profile"></div>
                        <div id="icons_container" class="patient_navbar" style="background-color: #5B8DFF;" ><img src="images/icons/dashboard/patient.png" title="Patient"></div>
                        <div id="icons_container" class="staff_navbar" onmouseover="hover_navbar('staff_navbar')" onmouseout="mouseout_navbar('staff_navbar')"><img src="images/icons/dashboard/staff.png" title="Staff"></div>
                        <div id="icons_container" class="inventory_navbar" onmouseover="hover_navbar('inventory_navbar')" onmouseout="mouseout_navbar('inventory_navbar')"><img src="images/icons/dashboard/inventory.png" title="Inventory"></div>
                        <div id="icons_container" class="appointment_navbar"><img src="images/icons/dashboard/appointment.png" title="Appointment"></div>
                        <div id="icons_container" class="inquiry_navbar" onmouseover="hover_navbar('inquiry_navbar')" onmouseout="mouseout_navbar('inquiry_navbar')"><img src="images/icons/dashboard/inquiries.png" title="Inquiries"></div>
                    </div><!-- End icons navbar container -->

                    <div id="profile_navbar" class="left_bar3"><!-- profile navbar container -->
                        <div id="profile_container" title="Sign out" onclick="logoutAdmin()">
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
                        <div id="icons_container" class="appointment_navbar" >Appointment</div>
                        <div id="icons_container" class="inquiry_navbar" onmouseover="hover_navbar('inquiry_navbar')" onmouseout="mouseout_navbar('inquiry_navbar')">Inquiries</div>
                    </div><!-- End icons navbar container -->

                    <div id="profile_navbar" class="right_navbar"><!-- profile navbar container -->
                        <div id="profile_container" class="profile_right_cont" onclick="logoutAdmin()">
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

                <form action="javascript:void(0)" method="post" id="ajax-form_admin_editpatientIfnfo">
                <div id="addpatient_div" class="viewPatientContainer">

                    <div id="info_header">
                        <img src="images/icons/dashboard/employee_icon.png">
                        Patient Information
                    </div>

                    <div id="row1_inp"><!--Name input-->
                        <div class="col">
                            <label>First Name <span style="color:red; font-size:2.5vh;">*</span></label>
                            <input type="text"  value="<?php echo $row1['fname']?>" id="fname" name="fname" onkeyup="removeborder_adminEditPatientInfo()"> 
                        </div>
                        <div class="col">
                            <label>Middle Name <span style="color:red; font-size:2.5vh;">*</span></label>
                            <input type="text"  value="<?php echo $row1['mname']?>" id="mname" name="mname">
                        </div>
                        <div class="col">
                            <label>Last Name <span style="color:red; font-size:2.5vh;">*</span></label>
                            <input type="text"  value="<?php echo $row1['lname']?>" id="lname" name="lname" onkeyup="removeborder_adminEditPatientInfo()">
                        </div>
                    </div>

                    <div id="row1_inp"><!--Address input-->
                        <div class="col">
                            <label>Region <span style="color:red; font-size:2.5vh;">*</span></label>
                            <select id="reg_op"><option value="" disabled selected hidden><?php echo $row1['region']?></option></select>
                            <select id="region"  onchange="removeborder_adminEditPatientInfo(); test()" style="margin-top:-6vh; opacity:0%;" onclick="regiondropdown()"></select>
                            <input type="hidden" placeholder="Ex. Pampanga" name="reg" id="reg" value="<?php echo $row1['region']?>">
                        </div>
                        <div class="col">
                            <label>Province <span style="color:red; font-size:2.5vh;">*</span></label>
                            <select id="province" onchange="removeborder_adminEditPatientInfo()"> <option value="" disabled selected hidden><?php echo $row1['province']?></option></select>
                            <input type="hidden" placeholder="Ex. Pampanga" name="prov" id="prov" >
                        </div>
                        <div class="col">
                            <label>Municipality <span style="color:red; font-size:2.5vh;">*</span></label>
                            <select id="city"  onchange="removeborder_adminEditPatientInfo()"><option value="" disabled selected hidden><?php echo $row1['municipality']?></option></select>
                            <input type="hidden" placeholder="Ex. Apalit" name="mun" id="mun" onkeyup="removeborder_adminEditPatientInfo()">
                        </div>
                    </div>

                    <div id="row1_inp"><!--Address input-->
                        <div class="col">
                            <label>Barangay <span style="color:red; font-size:2.5vh;">*</span></label>
                            <select id="barangay"  onchange="hide_addpatientValidation()"><option value="" disabled selected hidden><?php echo $row1['barangay']?></option></select>
                            <input type="hidden" placeholder="Ex. Sulipan" name="bar" id="bar" onkeyup="removeborder_adminEditPatientInfo()">
                        </div>
                        <div class="col">
                            <label>Street</label>
                            <input type="text" placeholder="Ex. #721 Kalye Onse" name="street" id="street" onkeyup="removeborder_adminEditPatientInfo()" value="<?php echo $row1['street']?>">
                        </div>
                    </div>

                    <div id="row2_inp"><!--Birthday input-->
                        <div class="col">
                            <label>Birthday <span style="color:red; font-size:2.5vh;">*</span></label>
                            <input type="date" value="<?php echo $row1['bday']; ?>" id="bday"  onchange="ageGenerator();removeborder_adminEditPatientInfo()" name="birthday">
                        </div>
                        <div class="col_age">
                            <label>Age <span style="color:red; font-size:2.5vh;">*</span></label>
                            <input type="text"  id="age"  value="<?php echo $row1['age']?>" name="age" readonly>
                        </div>
                        <div class="col_weight">
                            <label>Weight <span style="color:red; font-size:2.5vh;">*</span></label>
                            <div id="weight_inp">
                                <input type="number"  value="<?php echo $row1['weight']?>" id="weight" name="weight" onkeyup="removeborder_adminEditPatientInfo()" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==3) return false;" />
                                <div>kg</div>
                            </div>
                        </div>
                    </div>

                    <div id="row1_inp"><!--Religion input-->
                        <div class="col">
                            <label>Religion <span style="color:red; font-size:2.5vh;">*</span></label>
                            <input type="text"  value="<?php echo $row1['religion']?>" id="religion" name="religion" onkeyup="removeborder_adminEditPatientInfo()">
                        </div>
                        <div class="col">
                            <label>Civil Status <span style="color:red; font-size:2.5vh;">*</span></label>
                            <select name="civil_status">
                                <option value="Singe"<?php if ($row1['civilstatus'] == 'Single') echo ' selected="selected"'; ?>>Single</option>
                                <option value="Married"<?php if ($row1['civilstatus'] == 'Married') echo ' selected="selected"'; ?>>Married</option>
                                <option value="Divorce"<?php if ($row1['civilstatus'] == 'Divorce') echo ' selected="selected"'; ?>>Divorce</option>      
                            </select>
                        </div>
                    </div>

                    <div id="validation_admin_editPatientInfo">
                            <img src="images/icons/error_input.png">
                            <span id="adminEditPatientInfo_validation">All fields are required</span>
                    </div>

                    <input type="hidden" value="<?php echo $row1['id']?>" name="id_key">
                    <div id="button_div">
                        <button id="cancel_btn" type="button" onclick="backEditPatient()">Back</button>
                        <button id="add_btn" type="submit"><img src="images/icons/dashboard/edit_icon.png">Update</button>
                    </div>

                </div>
                </form>

            </div><!-- End of dashboard_content -->

    </div><!-- right_content_dashboard -->

</div> <!-- End of for_desktop div -->


<!--Sweetalert-->
<div id="sweetalert_container">
    <div id="succes_alert">
        <div id="alert_div">
        <img src="images/gif/succes.gif" id="gif_alert">
        <p id="thankyou" class="header_text_validation_appointment">Thank you!</p>
        <p class="message_alert">Patient profile information has been updated.</p>
        <button id="close_alert" onclick="close_alertadminEditPatientInfo()" class="close_btn_alert">OK</button>
        </div>
    </div>
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
<script src="js/sidenavbar_admin.js"></script>
<!-- Script for patient page -->
<script src="js/patientPage.js"></script>
<!-- Script for adminPatient -->
<script src="js/adminPatient.js"></script>


<!--ajax for logut-->
<script src="ajax/logoutAdmin.js"></script>
<!--ajax for editpatientinfo-->
<script src="ajax/adminEditPatientInfo.js"></script>




<script>
    function ageGenerator(){
       var d =  document.getElementById("bday").value;
       var dob = new Date(d);  
       var month_diff = Date.now() - dob.getTime();  
       var age_dt = new Date(month_diff);      
       var year = age_dt.getUTCFullYear();   
       var age = Math.abs(year - 1970);  
       document.getElementById("age").value=age;
    }   


    var my_handlers = {

fill_provinces:  function(){

    var region_code = $(this).val();
    $('#province').ph_locations('fetch_list', [{"region_code": region_code}]);
    
},

fill_cities: function(){

    var province_code = $(this).val();
    $('#city').ph_locations( 'fetch_list', [{"province_code": province_code}]);
},


fill_barangays: function(){

    var city_code = $(this).val();
    $('#barangay').ph_locations('fetch_list', [{"city_code": city_code}]);
}
};

$(function(){
$('#region').on('change', my_handlers.fill_provinces);
$('#province').on('change', my_handlers.fill_cities);
$('#city').on('change', my_handlers.fill_barangays);

$('#region').ph_locations({'location_type': 'regions'});
$('#province').ph_locations({'location_type': 'provinces'});
$('#city').ph_locations({'location_type': 'cities'});
$('#barangay').ph_locations({'location_type': 'barangays'});

$('#region').ph_locations('fetch_list');
});

function getProv(){
   var reg = document.getElementById("region")
   var regFinal =reg.options[reg.selectedIndex].text;

   var prov = document.getElementById("province")
   var provFinal =prov.options[prov.selectedIndex].text;

   var city = document.getElementById("city")
   var cityFinal =city.options[city.selectedIndex].text;

   var bar = document.getElementById("barangay")
   var barFinal =bar.options[bar.selectedIndex].text;


   document.getElementById("bar").value=barFinal;
   document.getElementById("prov").value=provFinal;
   document.getElementById("mun").value=cityFinal;
}
setInterval(function(){ 
    getProv();
}, 300);


function regiondropdown(){
    document.getElementById("region").style.opacity = "100%";
}

function test(){
    var reg = document.getElementById("region")
    var regFinal =reg.options[reg.selectedIndex].text;
    document.getElementById("reg").value=regFinal;

    document.getElementById("city").value=" ";
    document.getElementById("barangay").value=" ";
    document.getElementById("mun").value="";
    document.getElementById("bar").value="";
}
</script>

