<?php
session_start();
if(!isset($_SESSION["ob_active"])){
    header("location: adminLogin.php");
    exit;
}
require 'php/obActivelogin.php';
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
     <link rel="stylesheet" href="css/Desktop/Admin-adminEditProfile.css">

     <link rel="shortcut icon" type="image/png" href="images/icons/webIcon.png"> 

     <link rel="shortcut icon" type="image/png" href="upload_img_generic/<?php echo $row_g['g_LogoDark']; ?>"> 
     <script src="AnimBackend/jquery.js"></script>
     <script src="AnimBackend/jquery1.js"></script>
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
                        <div id="icons_container"  class="dash_navbar" onmouseover="hover_navbar('dash_navbar')" onmouseout="mouseout_navbar('dash_navbar')"><img src="images/icons/dashboard/dashboard.png" title="Dashboard"></div>
                        <div id="icons_container" class="profile_navbar" style="background-color: #5B8DFF;"><img src="images/icons/dashboard/profile.png" title="Profile"></div>
                        <div id="icons_container" class="patient_navbar" onmouseover="hover_navbar('patient_navbar')" onmouseout="mouseout_navbar('patient_navbar')" ><img src="images/icons/dashboard/patient.png" title="Patient"></div>
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
                        <div id="icons_container" class="profile_navbar" style="background-color: #5B8DFF;">Profile</div>
                        <div id="icons_container" class="patient_navbar" onmouseover="hover_navbar('patient_navbar')" onmouseout="mouseout_navbar('patient_navbar')">Patient</div>
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


    <div id="right" class="right_content_dashboard">
            <div id="dashboard_top">
                <div id="dash_left">Edit Profile</div>
                <div id="dash_right">
                    <div id="notification_container">
                        <img src="images/icons/dashboard/notification.png" title="Notification" id="notif_img">
                        <div id="notif_count"><?php echo $notifCount1+$notifCount2; ?></div>
                    </div><!-- End of notification container -->

                    <?php  //php for displaying the hover icon 
                        $row = mysqli_fetch_array($search_resulthover);   
                    ?>
                    <div id="profile_container" title="Visit Profile" onclick="profile()" class="reload_img_admin_editprofile1">
                        <img src="upload_img/<?php echo $row['profile_photo']; ?>" id="profile_img" onerror="this.src='upload_img/account.png'">
                        <div id="name_profile">
                            <p id="name_text"><?php echo $row['fname']; ?></p>
                            <p id="role_text"><?php echo $row['role']; ?> Account</p>
                        </div>
                    </div><!-- End of profile container -->
                </div>
            </div><!-- End of dashboard top -->

            <div id="profile_content">
             
                    <div id="layer1" class="reload_img_admin_editprofile">
                    <form enctype="multipart/form-data" action="javascript:void(0)" method="post" id="ajax-form_admin_editprofilephoto">
                        <div id="left_part">
                            <div id="img_cont">
                                <div id="img">
                                    <img src="upload_img/<?php echo $row['profile_photo']; ?>" id="profile_photo" onerror="this.src='upload_img/account.png'">
                                    <label for="file-input">
                                    <img src="images/icons/upload_file_icon.png" id="file_icon" onclick="open_profile_photo_btn()">
                                    </label>
                                </div>
                            </div><!--End of img_cont -->

                            <div id="edit_content">
                                    <div id="top">
                                        <p id="edit_header">Upload a New Photo</p>
                                        <input type="hidden" id="secret_id1" name="secrect_id1" value="<?php echo $row['id']; ?>">
                                        <input type="hidden" id="key_profile_pic" value="upload_img/<?php echo $row['profile_photo']; ?>">
                                        <input id="file-input" type="file" onchange="loadfile(event)" name="file-input"/>
                                        <script type="text/javascript">
                                            function loadfile(event){
                                                var output=document.getElementById("profile_photo");
                                                output.src=URL.createObjectURL(event.target.files[0]);
                                            };
                                        </script>
                                    </div><!--End of top -->
                                    <div id="bot">
                                        <button id="cancel" class="btn_photo_profile" onclick="cancel_prof_btn()" type="button">Cancel</button>
                                        <button id="save" class="btn_photo_profile" type="submit">Save</button>
                                    </div>    
                            </div>
                        </form>
                        </div><!-- End of left_part-->
                 
                        <?php
                            $apiKey = "dadee94a86d93919d257e4735ca6aa92";
                            $cityId = "CITY ID";
                            $googleApiUrl = "http://api.openweathermap.org/data/2.5/weather?id=1723066&lang=en&units=metric&APPID=" . $apiKey;

                            $ch = curl_init();

                            curl_setopt($ch, CURLOPT_HEADER, 0);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
                            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                            curl_setopt($ch, CURLOPT_VERBOSE, 0);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            $response = curl_exec($ch);

                            curl_close($ch);
                            $data = json_decode($response);
                            $currentTime = time();
                            $temp_current = round($data->main->temp);
                            date_default_timezone_set('Asia/Manila');
                        ?>
               
                        <div id="layer2_r" class="to_change_bg_layer1">
                            <div id="left1">
                                <p><?php echo $temp_current; ?>&deg;</p>
                            </div>
                            <div id="right">
                                <p id="date"><?php echo date("F j, Y") ?></p>
                                <p id="time"><?php echo date("h:i A") ?></p>
                            </div>
                        </div>

                        <div id="layer2_r_night">
                            <div id="left1">
                                <p><?php echo $temp_current; ?>&deg;</p>
                            </div>
                            <div id="right">
                                <p id="date"><?php echo date("F j, Y") ?></p>
                                <p id="time"><?php echo date("h:i A") ?></p>
                            </div>
                        </div>
                    </div><!--End of layer1 -->

                    <div id="edit_content1" class="edit_basic_info">
                        <p id="edit_header">Edit Basic Information</p>

                        <form action="javascript:void(0)" method="post" id="ajax-form_admin_editprofile">
                        <input type="hidden" id="secret_id" name="secrect_id" value="<?php echo $row['id']; ?>">
                        <div class="for_inp"><!--Name -->
                            <div id="inp_cont">
                                    <label>First Name : <span style="color:red; font-size:2.5vh;">*</span></label>        
                                    <input type="text" value="<?php echo $row['fname']; ?>" name="fname" id="fname" onkeyup="removeborder_adminEditProfile('fname')">     
                            </div>
                           <div id="inp_cont">
                                    <label>Middle Name : </label>        
                                    <input type="text" value="<?php echo $row['mname']; ?>" name="mname" id="mname" placeholder="Optional">     
                            </div> 
                            <div id="inp_cont">
                                    <label>Last Name : <span style="color:red; font-size:2.5vh;">*</span></label>        
                                    <input type="text" value="<?php echo $row['lname']; ?>" name="lname" id="lname" onkeyup="removeborder_adminEditProfile('lname')">     
                            </div> 
                        </div>


                        <div class="for_inp"><!-- Address-->
                            <div id="inp_cont">
                                    <label>Region : <span style="color:red; font-size:2.5vh;">*</span></label>     
                                    <select id="reg_op"><option value="" disabled selected hidden><?php echo $row['reg']; ?></option></select>   
                                    <select id="region"  onchange="test();removeborder_adminEditProfile('mun')" style="margin-top:-6.5vh; opacity:0%;" onclick="regiondropdown()"></select>
                                    <input type="hidden" value="<?php echo $row['reg']; ?>" name="reg" id="reg" onkeyup="removeborder_adminEditProfile('reg')">     
                            </div>
                           <div id="inp_cont">
                                    <label>Province : <span style="color:red; font-size:2.5vh;">*</span></label>    
                                    <select id="province"  onchange="removeborder_adminEditProfile('mun')"> <option value="" disabled selected hidden><?php echo $row['prov']?></option></select>    
                                    <input type="hidden" value="<?php echo $row['prov']; ?>" name="prov" id="prov">    
                            </div> 
                            <div id="inp_cont">
                                    <label>Municipality : <span style="color:red; font-size:2.5vh;">*</span></label>   
                                    <select id="city" onchange="removeborder_adminEditProfile('mun')"><option value="" disabled selected hidden><?php echo $row['mun']?></option></select>     
                                    <input type="hidden" value="<?php echo $row['mun']; ?>" name="mun" id="mun">  
                            </div> 
                        </div>

                        <div class="for_inp"><!-- Address-->
                            <div id="inp_cont">
                                    <label>Barangay : <span style="color:red; font-size:2.5vh;">*</span></label>        
                                    <select id="barangay"  onchange="removeborder_adminEditProfile('mun')"><option value="" disabled selected hidden><?php echo $row['bar']?></option></select>
                                    <input type="hidden" value="<?php echo $row['bar']; ?>" name="bar" id="bar" onkeyup="removeborder_adminEditProfile('bar')">     
                            </div>
                           <div id="inp_cont">
                                    <label>Street :</label>   
                                    <input type="text" value="<?php echo $row['street']; ?>" name="street" id="street" onkeyup="removeborder_adminEditProfile('street')">     
                            </div> 
                        </div>

                        <div class="for_inp"><!--Contact-->
                            <div id="inp_cont">
                                    <label>Username : <span style="color:red; font-size:2.5vh;">*</span></label>        
                                    <input type="text" value="<?php echo $row['username']; ?>" name="username" id="username" onkeyup="removeborder_adminEditProfile('username')">     
                            </div>

                            <div id="inp_cont">
                                    <label>Phone No. : <span style="color:red; font-size:2.5vh;">*</span></label>        
                                    <input type="text" value="<?php echo $row['phone']; ?>" name="phone" id="phone" onkeyup="removeborder_adminEditProfile('phone')">     
                            </div> 
                            <div id="inp_cont">
                                    <label>Email : <span style="color:red; font-size:2.5vh;">*</span></label>        
                                    <input type="text" value="<?php echo $row['email']; ?>" name="email" id="email"
                                    onkeyup="removeborder_adminEditProfile('email')">     
                            </div> 
                        </div>

                        <div class="for_inp"><!--Contact-->
                            <div id="inp_cont_bday">
                                    <label>Birthday : <span style="color:red; font-size:2.5vh;">*</span></label>        
                                    <div>
                                        <input type="date" value="<?php echo $row['birthday']; ?>" id="datepicker"  onchange="ageGenerator();removeborder_adminEditProfile('datepicker')" name="birthday">
                                    </div>   
                            </div>
                            
                            <div id="inp_cont">
                                    <label>Age : <span style="color:red; font-size:2.5vh;">*</span></label>        
                                    <input type="text" value="<?php echo $row['age']; ?>" id="age_inp" readonly name="age"
                                    onkeyup="removeborder_adminEditProfile('age_inp')">     
                            </div> 
                        </div>

                        <div id="validation_admin_editProf">
                            <img src="images/icons/error_input.png">
                            <span id="adminEditProf_validation">.</span>
                        </div>
                        <center>
                            <button id="back_edit_p" type="button" onclick="back_adminEditProfile()">Back</button>
                            <button id="update_edit_p" type="submit">Update</button>
                        </center>
                        </form>                     
                    </div>
            </div>


    </div><!-- right_content_dashboard -->

</div> <!-- End of for_desktop div -->

<!--Sweetalert-->
<div id="sweetalert_container">
    <div id="succes_alert">
        <div id="alert_div">
        <img src="images/gif/succes.gif" id="gif_alert">
        <p id="thankyou" class="header_text_validation_appointment">Thank you!</p>
        <p class="message_alert">Your profile information has been updated.</p>
        <button id="close_alert" onclick="close_alertadminEditProfile()" class="close_btn_alert">OK</button>
        <button id="close_alert" style="display:none;" class="success_btn_alert" onclick="close_alertadminEditProfile_success()">OK</button>
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
<script src="js/sidenavbar_Ob.js"></script>

<!--ajax for logut-->
<script src="ajax/logoutAdmin.js"></script>
<!--ajax for admin edit profile-->
<script src="ajax/adminEditProfile.js"></script>
<!--ajax for admin edit profile pic-->
<script src="ajax/adminEditProfilePic.js"></script>

<?php
date_default_timezone_set('Asia/Manila');
$hour = date('H', time());

    if($hour >= 18){
?>
        <style>
            .right_content_dashboard #profile_content #layer1 #layer2_r_night{
                display: flex;
            }
            .right_content_dashboard #profile_content #layer1 #layer2_r{
                display: none;
            }
        </style>
 <?php       
    }
    else if($hour <= 17){
 ?>       
         <style>
            .right_content_dashboard #profile_content #layer1 #layer2_r_night{
                display: none;
            }
            .right_content_dashboard #profile_content #layer1 #layer2_r{
                display: flex;
            }
        </style>
<?php 
    }
?>

<script>
    function ageGenerator(){
       var d =  document.getElementById("datepicker").value;
       var dob = new Date(d);  
       var month_diff = Date.now() - dob.getTime();  
       var age_dt = new Date(month_diff);      
       var year = age_dt.getUTCFullYear();   
       var age = Math.abs(year - 1970);  
       document.getElementById("age_inp").value=age;
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
    document.getElementById("reg_op").style.visibility = "hidden";
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