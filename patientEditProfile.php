<?php
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
     <link rel="stylesheet" href="css/Desktop/Patient-patientEditProfile.css">

     <link rel="shortcut icon" type="image/png" href="upload_img_generic/<?php echo $row_g['g_LogoDark']; ?>"> 

     <link rel="stylesheet" href="AnimBackend/jquery.css">
     <script src="AnimBackend/jquery.js"></script>
     <script src="AnimBackend/jquery1.js"></script>
     <script type="text/javascript" src="AnimBackend/location.js"></script>
  </head>

<body>

<div class="for_desktop"><!--For Descktop div-->

    <div id="left" class="side_navbar"><!-- Left part-->
            <div id="left_bar">
                    <div id="logo_bar" class="left_bar1">
                        <img src="upload_img_generic/<?php echo $row_g['g_LogoLight']; ?>" id="logo_img">
                        <img src="images/icons/dashboard/hamburger_dashboard.png" id="burger_img" title="Maximize" onclick="maximize_navbar()">
                    </div>

                    <div id="icons_navbar" class="left_bar2"><!-- icons navbar container -->
                        <div id="icons_container" class="dash_navbar" onmouseover="hover_navbar('dash_navbar')" onmouseout="mouseout_navbar('dash_navbar')" ><img src="images/icons/dashboard/dashboard.png" title="Dashboard"></div>
                        <div id="icons_container" class="profile_navbar" style="background-color: #5B8DFF;"><img src="images/icons/dashboard/profile.png" title="Profile"></div>
                        <div id="icons_container" class="staff_navbar" onmouseover="hover_navbar('staff_navbar')" onmouseout="mouseout_navbar('staff_navbar')"><img src="images/icons/dashboard/staff.png" title="Staff"></div>
                        <div id="icons_container" class="appointment_navbar" onmouseover="hover_navbar('appointment_navbar')" onmouseout="mouseout_navbar('appointment_navbar')"><img src="images/icons/dashboard/appointment.png" title="Appointment"></div>
                    
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
                        <div id="icons_container" class="profile_navbar" style="background-color: #5B8DFF;">Profile</div>
                        <div id="icons_container" class="staff_navbar" onmouseover="hover_navbar('staff_navbar')" onmouseout="mouseout_navbar('staff_navbar')">Staff</div>
                        <div id="icons_container" class="appointment_navbar" onmouseover="hover_navbar('appointment_navbar')" onmouseout="mouseout_navbar('appointment_navbar')">Appointment</div>
                   
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


    <div id="right" class="right_content_dashboard">
            <div id="dashboard_top">
                <div id="dash_left">Edit Profile</div>
                <div id="dash_right">
                    <?php  //php for displaying the hover icon 
                        $row = mysqli_fetch_array($search_resulthover);   
                    ?>
                    <div id="profile_container" title="Visit Profile" onclick="profile()" class="reload_img_admin_editprofile1">
                        <img src="upload_img/<?php echo $row['profile_photo']; ?>" id="profile_img" onerror="this.src='upload_img/account.png'">
                        <div id="name_profile">
                            <p id="name_text"><?php echo $row['fname']; ?></p>
                            <p id="role_text">Patient Account</p>
                        </div>
                    </div><!-- End of profile container -->
                </div>
            </div><!-- End of dashboard top -->

            <div id="profile_content">
             
                    <div id="layer1" class="reload_img_admin_editprofile">
                    <form enctype="multipart/form-data" action="javascript:void(0)" method="post" id="ajax-form_patient_editprofilephoto">
                        <div id="left_part">
                            <div id="img_cont">
                                <div id="img">
                                    <img src="upload_img/<?php echo $row['profile_photo']; ?>" id="profile_photo" onerror="this.src='upload_img/account.png'">
                                    <label for="file-input">
                                    <img src="images/icons/upload_file_icon.png" id="file_icon" title="Upload Photo" onclick="open_profile_photo_btn()">
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

                        <form action="javascript:void(0)" method="post" id="ajax-form_patient_editprofile">
                        <input type="hidden" id="secret_id" name="secrect_id" value="<?php echo $row['id']; ?>">
                        <div class="for_inp"><!--Name -->
                            <div id="inp_cont">
                                    <label>First Name :</label>        
                                    <input type="text" value="<?php echo $row['fname']; ?>" name="fname" id="fname" onkeyup="removeborder_adminEditProfile('fname')" placeholder="First name here...">     
                            </div>
                           <div id="inp_cont">
                                    <label>Middle Name :</label>        
                                    <input type="text" value="<?php echo $row['mname']; ?>" name="mname" id="mname" placeholder="Optional">     
                            </div> 
                            <div id="inp_cont">
                                    <label>Last Name :</label>        
                                    <input type="text" value="<?php echo $row['lname']; ?>" name="lname" id="lname" onkeyup="removeborder_adminEditProfile('lname')" placeholder="Last name here...">     
                            </div> 
                        </div>


                        <div class="for_inp"><!-- Address-->
                            <div id="inp_cont">
                                    <label>Region : <span style="color:red; font-size:2.5vh;">*</span></label>     
                                    <select id="reg_op"><option value="" disabled selected hidden><?php echo $row['region']; ?></option></select>   
                                    <select id="region" onchange="test();removeborder_adminEditProfile('reg')" style="margin-top:-6.5vh; opacity:0%;" onclick="regiondropdown()"></select>
                                    <input type="hidden" value="<?php echo $row['region']; ?>" name="reg" id="reg">     
                            </div>
                           <div id="inp_cont">
                                    <label>Province : <span style="color:red; font-size:2.5vh;">*</span></label>    
                                    <select id="province" onchange="removeborder_adminEditProfile('prov')"><option value="" disabled selected hidden><?php echo $row['province']?></option></select>    
                                    <input type="hidden" value="<?php echo $row['province']; ?>" name="prov" id="prov">    
                            </div> 
                            <div id="inp_cont">
                                    <label>Municipality : <span style="color:red; font-size:2.5vh;">*</span></label>   
                                    <select id="city" onchange="removeborder_adminEditProfile('mun')"><option id="" value="" disabled selected hidden><?php echo $row['municipality']?></option></select>     
                                    <input type="hidden" value="<?php echo $row['municipality']; ?>" name="mun" id="mun">  
                            </div> 
                        </div>

                        <div class="for_inp"><!-- Address-->
                            <div id="inp_cont">
                                    <label>Barangay : <span style="color:red; font-size:2.5vh;">*</span></label>        
                                    <select id="barangay" onchange="removeborder_adminEditProfile('bar')"><option value="" disabled selected hidden><?php echo $row['barangay']?></option></select>
                                    <input type="hidden" value="<?php echo $row['bararngay']; ?>" name="bar" id="bar">     
                            </div>
                           <div id="inp_cont">
                                    <label>Street :</label>   
                                    <input type="text" value="<?php echo $row['street']; ?>" name="street" id="street" onkeyup="removeborder_adminEditProfile('street')" placeholder="Street here...">     
                            </div> 
                        </div>

                        <div class="for_inp"><!--Contact-->
                            <div id="inp_cont">
                                    <label>Username :</label>        
                                    <input type="text" value="<?php echo $row['username']; ?>" name="username" id="username" onkeyup="removeborder_adminEditProfile('username')" placeholder="Username here...">     
                            </div>

                            <div id="inp_cont">
                                    <label>Phone No. :</label>        
                                    <input type="text" value="<?php echo $row['contact']; ?>" name="phone" id="phone" onkeyup="removeborder_adminEditProfile('phone')" placeholder="Phone no. here...">     
                            </div> 
                            <div id="inp_cont">
                                    <label>Email :</label>        
                                    <input type="text" value="<?php echo $row['email']; ?>" name="email" id="email"
                                    onkeyup="removeborder_adminEditProfile('email')" placeholder="Email here...">     
                            </div> 
                        </div>

                        <div class="for_inp"><!--Contact-->
                            <div id="inp_cont_bday">
                                    <label>Birthday :</label>        
                                    <div>
                                        <input type="date" value="<?php echo $row['bday']; ?>" id="datepicker"  onchange="ageGenerator();removeborder_adminEditProfile('datepicker')" name="birthday">
                                    </div>   
                            </div>
                            
                            <div id="inp_cont">
                                    <label>Age :</label>        
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
<script src="js/sidenavbar_Patient.js"></script>

<!--ajax for logut-->
<script src="ajax/logoutAdmin.js"></script>
<!--ajax for admin edit profile pic-->
<script src="ajax/patientEditProfilePic.js"></script>
<!--ajax for admin edit profile-->
<script src="ajax/patientEditProfile.js"></script>



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