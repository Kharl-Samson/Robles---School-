<?php
session_start();
require_once "Z-connection.php";
date_default_timezone_set('Asia/Manila');
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
     <link rel="stylesheet" href="css/Desktop/Doctor-settings.css">
  
     <link rel="shortcut icon" type="image/png" href="upload_img_generic/<?php echo $row_g['g_LogoDark']; ?>"> 

     <link rel="stylesheet" href="AnimBackend/jquery.css">
     <script src="AnimBackend/jquery.js"></script>
     <script src="AnimBackend/jquery1.js"></script>
     <script src="js/table2excel.js"></script>

    <!-- To test -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
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
                        <div id="icons_container" class="patient_navbar" onmouseover="hover_navbar('patient_navbar')" onmouseout="mouseout_navbar('patient_navbar')" ><img src="images/icons/dashboard/patient.png" title="Patient"></div>
                        <div id="icons_container" class="staff_navbar" onmouseover="hover_navbar('staff_navbar')" onmouseout="mouseout_navbar('staff_navbar')"><img src="images/icons/dashboard/staff.png" title="Staff"></div>
                        <div id="icons_container" class="inventory_navbar"  onmouseover="hover_navbar('inventory_navbar')" onmouseout="mouseout_navbar('inventory_navbar')"><img src="images/icons/dashboard/inventory.png" title="Inventory"></div>
                        <div id="icons_container" class="appointment_navbar" onmouseover="hover_navbar('appointment_navbar')" onmouseout="mouseout_navbar('appointment_navbar')"><img src="images/icons/dashboard/appointment.png" title="Appointment"></div>
                        <div id="icons_container" class="setting_navbar" style="background-color: #5B8DFF;"><img src="images/icons/dashboard/settings.png" title="Settings"></div>
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
                        <div id="icons_container" class="profile_navbar" onmouseover="hover_navbar('profile_navbar')" onmouseout="mouseout_navbar('profile_navbar')" >Profile</div>
                        <div id="icons_container" class="patient_navbar" onmouseover="hover_navbar('patient_navbar')" onmouseout="mouseout_navbar('patient_navbar')">Patient</div>
                        <div id="icons_container" class="staff_navbar" onmouseover="hover_navbar('staff_navbar')" onmouseout="mouseout_navbar('staff_navbar')">Staff</div>
                        <div id="icons_container" class="inventory_navbar" onmouseover="hover_navbar('inventory_navbar')" onmouseout="mouseout_navbar('inventory_navbar')">Inventory</div>
                        <div id="icons_container" class="appointment_navbar" onmouseover="hover_navbar('appointment_navbar')" onmouseout="mouseout_navbar('appointment_navbar')">Appointment</div>
                        <div id="icons_container" class="setting_navbar" style="background-color: #5B8DFF;">Settings</div>
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
                <div id="dash_left">Settings</div>
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

                <div id="top_dashboard_content">
                        <div id="left_top_dashboard_content">
                            <div class="appointment_choices" style="box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px; background-color: rgb(248, 248, 248);" id="act_General" onclick="go_General()"> 
                                <img src="images/icons/generalSettings.png">
                                General
                            </div>

                            <div class="appointment_choices" id="act_Home" onclick="go_home_setting()">
                                <img src="images/icons/aboutSettings.png">    
                                Home
                            </div>

                            <div class="appointment_choices" id="act_About" onclick="go_about_setting()">        
                                <img src="images/icons/about_appointment1.png">    
                                About us
                            </div>

                            <div class="appointment_choices" id="act_Employee" onclick="go_employee_setting()">
                                <img src="images/icons/employeeSetting.png">    
                                Employees
                            </div>

                            <div class="appointment_choices" id="act_Service" onclick="go_service_setting()">
                                <img src="images/icons/servicesSetting.png">    
                                Services
                            </div>

                            <div class="appointment_choices" id="act_Appointment" onclick="go_appointment_setting()">
                                <img src="images/icons/holidaySetting.png">    
                                Office Holidays
                            </div>
                            <div class="appointment_choices" id="act_Audit" onclick="go_audit_setting()">
                                <img src="images/icons/auditSetting.png">     
                                Audit Log
                            </div>

                            <div class="appointment_choices" id="act_Backup" onclick="go_backup_setting()">
                                <img src="images/icons/backupSetting.png">    
                                Backup
                            </div>
                        </div>
                </div><!-- End of top_dashboard_content -->


                <?php
                    $sql = "SELECT * FROM `general_tb`";
                    $search_general = filterTableGeneral($sql);
                    function filterTableGeneral($sql){  
                    $con=mysqli_connect('localhost','root','','robles_db');
                    $filter_General = mysqli_query($con, $sql);
                    return $filter_General; 
                    }
                    $row_g = mysqli_fetch_array($search_general);
                ?>
                <form action="javascript:void(0)" method="post" id="ajax-form_admin_obGeneral">
                <div id="general_setting">
                    <div id="site_title" class="div_box_liteImg">
                        <div id="left" style="width:35%;">Company Logo (Light Version)</div>
                        <div id="right" style="width:40%;">
                            <div id="img_container" class="img_containerL">
                                <img src="upload_img_generic/<?php echo $row_g['g_LogoLight']; ?>" id="image_lightVersion">
                                <div id="for_button">
                                    <input type="file" id="img_light_v" onchange="loadfileLightLogo(event)" name="img_light_v" hidden>
                                    <button style="color:#7D8790; visibility:hidden;" onclick="deleteimg()" id="delete_btn_light" type="button">Cancel</button>
                                    <button style="color:#35927B;" onclick="openFileLightimg()" type="button">Update</button>
                                    <button style="color:#215EE9; visibility:hidden;" id="save_btn_light" type="button" name="lite_img">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="site_title" class="div_box_darkImg">
                        <div id="left" style="width:35%;">Company Logo (Dark Version)</div>
                        <div id="right" style="width:40%;">
                            <div id="img_container" class="img_containerD">
                                <img src="upload_img_generic/<?php echo $row_g['g_LogoDark']; ?>" style="background-color:#ffff;" id="image_DarkVersion">
                                <div id="for_button">
                                    <input type="file" id="img_dark_v" onchange="loadfileDarkLogo(event)" name="img_dark_v" hidden>
                                    <button style="color:#7D8790; visibility:hidden;" onclick="deleteimg1()" id="delete_btn_dark" type="button">Cancel</button>
                                    <button style="color:#35927B;" onclick="openFileDarkimg()" type="button">Update</button>
                                    <button style="color:#215EE9; visibility:hidden;" id="save_btn_dark" type="button">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="site_title">
                        <div id="left" style="width:35%;">Site Title</div>
                        <div id="right" style="width:40%;"><input type="text" placeholder="Your site title here..." value="<?php echo $row_g['g_Sitename']; ?>" name="g_Sitename" id="g_Sitename" onkeyup="remove_val_general('g_Sitename')"></div>
                    </div>

                    <div id="site_title" style="align-items:flex-start;">
                        <div id="left" style="width:35%;">Company Vision</div>
                        <div id="right" style="width:40%;">
                            <textarea  id="g_vision" placeholder="Your vision here..." onkeyup="getCharLength();remove_val_general('g_vision')" maxlength="250" name="g_Vision"><?php echo $row_g['g_Vision']; ?></textarea>
                            <div style="float:right; font-family: 'Poppins', sans-serif; font-size: 1.8vh; font-weight: bold; color: #7D8790;"><span id="char_ctr"></span> / <span>250</span></div>
                        </div>
                    </div>

                    <div id="site_title">
                        <div id="left" style="width:35%;">Contact #</div>
                        <div id="right" style="width:40%;"><input type="text" placeholder="Your contact # here..." value="<?php echo $row_g['g_Contact']; ?>"  name="g_Contact" id="g_Contact" onkeyup="remove_val_general('g_Contact')"></div>
                    </div>

                    <div id="site_title">
                        <div id="left" style="width:35%;">Location</div>
                        <div id="right" style="width:40%;"><input type="text" placeholder="Your location here..." value="<?php echo $row_g['g_Location']; ?>" name="g_Location" id="g_Location" onkeyup="remove_val_general('g_Location')"></div>
                    </div>

                    <div id="site_title">
                        <div id="left" style="width:35%;">Email</div>
                        <div id="right" style="width:40%;"><input type="text" placeholder="Your email here..." value="<?php echo $row_g['g_Email']; ?>" style="text-transform:none;" name="g_Email" id="g_Email" onkeyup="remove_val_general('g_Email')"></div>
                    </div>

                    <div id="site_title">
                        <div id="left" style="width:35%;">Working Hours</div>
                        <div id="right" style="width:40%;"><input type="text" placeholder="Your working hours here..." value="<?php echo $row_g['g_WorkingHours']; ?>" name="g_WorkingHours" id="g_WorkingHours" onkeyup="remove_val_general('g_WorkingHours')"></div>
                    </div>         
                    
                    <div id="site_title">
                        <div id="left" style="width:35%;">Company Code</div>
                        <div id="right" style="width:40%;"><input type="text" placeholder="Your company code here..." value="<?php echo $row_g['companyCode']; ?>" name="companyCode" id="companyCode" onkeyup="remove_val_general('companyCode')" maxlength="6"></div>
                    </div>  

                    <div id="site_title">
                        <div id="left" style="width:35%;">Google Map Embed Code</div>
                        <div id="right" style="width:40%;"><input type="text" style="text-transform:none;" placeholder="Your Link here..." value="<?php echo $row_g['googlemap']; ?>" name="googlemap" id="googlemap" onkeyup="remove_val_general('googlemap')"></div>
                    </div>  

                    <div id="site_title">
                        <div id="left" style="width:35%;">Facebook Page Link</div>
                        <div id="right" style="width:40%;"><input type="text" style="text-transform:none;" placeholder="Your Link here..." value="<?php echo $row_g['facebook']; ?>" name="facebook" id="facebook" onkeyup="remove_val_general('facebook')"></div>
                    </div>  
                </div>


                <div id="home_setting">

                    <div id="site_title" style="align-items:flex-start;">
                        <div id="left">Tagline</div>
                        <div id="right">
                            <textarea  id="h_Tagline" placeholder="Your vision here..." onkeyup="getCharLength1();remove_val_general('h_Tagline')" maxlength="250" name="h_Tagline"><?php echo $row_g['h_Tagline']; ?></textarea>
                            <div style="float:right; font-family: 'Poppins', sans-serif; font-size: 1.8vh; font-weight: bold; color: #7D8790;"><span id="char_ctr1"></span> / <span>250</span></div>
                        </div>
                        <div id="preview_side" style="height:14.5vh;">
                            <img src="images/icons/show.gif" title="Content to edit" onmouseover="preview_Content('preview_ht','p_tagline.png','image_previewpT')" onmouseout="mouseout_Preview('preview_ht','p_tagline.png','image_previewpT')">
                            <div id="preview_img" class="preview_ht">
                                <img src="" id="image_previewpT">
                            </div>
                        </div>
                    </div>

                    <div id="site_title" class="div_box_darkImg">
                        <div id="left">Layout Image</div>
                        <div id="right">
                            <div id="img_container" class="img_containerI">
                                <img src="upload_img_generic/<?php echo $row_g['h_Layoutimg']; ?>" style="background-color:#ffff;" id="image_Ilay">
                                <div id="for_button">
                                    <input type="file" id="img_hLayout" onchange="loadfileIlayLogo(event)" name="img_hLayout" hidden>
                                    <button style="color:#7D8790; visibility:hidden;" onclick="deleteimgIlay()" id="delete_btn_Ilay" type="button">Cancel</button>
                                    <button style="color:#35927B;" onclick="openFileLayoutimg()" type="button">Update</button>
                                    <button style="color:#215EE9; visibility:hidden;" id="save_btn_Ilay" type="button">Save</button>
                                </div>
                            </div>
                        </div>
                        <div id="preview_side">
                            <img src="images/icons/show.gif" title="Content to edit" onmouseover="preview_Content('preview_Il','p_ilayout.png','image_previewIL')" onmouseout="mouseout_Preview('preview_Il','p_ilayout.png','image_previewIL')">
                            <div id="preview_img" class="preview_Il">
                                <img src="" id="image_previewIL">
                            </div>
                        </div>
                    </div>


                    <div id="site_title" class="div_box_darkImg">
                        <div id="left">Slideshow 1</div>
                        <div id="right">
                            <div id="img_container" class="img_containerIsl1">
                                <img src="upload_img_generic/<?php echo $row_g['h_slide1']; ?>" style="background-color:#ffff; width:13vh;" id="image_Sl1">
                                <div id="for_button">
                                    <input type="file" id="file-imgSl1" onchange="loadfileIsl1(event)" name="file-imgSl1" hidden>
                                    <button style="color:#7D8790; visibility:hidden;" onclick="deleteSl1()" id="delete_btn_Isl1" type="button">Cancel</button>
                                    <button style="color:#35927B;" onclick="openFilesl1()" type="button">Update</button>
                                    <button style="color:#215EE9; visibility:hidden;" id="save_btn_Isl1" type="button">Save</button>
                                </div>
                            </div>
                        </div>
                        <div id="preview_side">
                            <img src="images/icons/show.gif" title="Content to edit" onmouseover="preview_Content('preview_sl1','p_slideshow1.png','image_previewSl1')" onmouseout="mouseout_Preview('preview_sl1','p_slideshow1.png','image_previewSl1')">
                            <div id="preview_img" class="preview_sl1">
                                <img src="" id="image_previewSl1">
                            </div>
                        </div>
                    </div>

                    <div id="site_title" class="div_box_darkImg">
                        <div id="left">Slideshow 2</div>
                        <div id="right">
                            <div id="img_container" class="img_containerIsl2">
                                <img src="upload_img_generic/<?php echo $row_g['h_slide2']; ?>" style="background-color:#ffff; width:13vh;" id="image_Sl2">
                                <div id="for_button">
                                    <input type="file" id="file-imgSl2" onchange="loadfileIsl2(event)" name="file-imgSl2" hidden>
                                    <button style="color:#7D8790; visibility:hidden;" onclick="deleteSl2()" id="delete_btn_Isl2" type="button">Cancel</button>
                                    <button style="color:#35927B;" onclick="openFilesl2()" type="button">Update</button>
                                    <button style="color:#215EE9; visibility:hidden;" id="save_btn_Isl2" type="button">Save</button>
                                </div>
                            </div>
                        </div>
                        <div id="preview_side">
                            <img src="images/icons/show.gif" title="Content to edit" onmouseover="preview_Content('preview_sl2','p_slideshow2.png','image_previewSl2')" onmouseout="mouseout_Preview('preview_sl2','p_slideshow2.png','image_previewSl2')">
                            <div id="preview_img" class="preview_sl2">
                                <img src="" id="image_previewSl2">
                            </div>
                        </div>
                    </div>

                    <div id="site_title" class="div_box_darkImg">
                        <div id="left">Slideshow 3</div>
                        <div id="right">
                            <div id="img_container" class="img_containerIsl3">
                                <img src="upload_img_generic/<?php echo $row_g['h_slide3']; ?>" style="background-color:#ffff; width:13vh;" id="image_Sl3">
                                <div id="for_button">
                                    <input type="file" id="file-imgSl3" onchange="loadfileIsl3(event)" name="file-imgSl3" hidden>
                                    <button style="color:#7D8790; visibility:hidden;" onclick="deleteSl3()" id="delete_btn_Isl3" type="button">Cancel</button>
                                    <button style="color:#35927B;" onclick="openFilesl3()" type="button">Update</button>
                                    <button style="color:#215EE9; visibility:hidden;" id="save_btn_Isl3" type="button">Save</button>
                                </div>
                            </div>
                        </div>
                        <div id="preview_side">
                            <img src="images/icons/show.gif" title="Content to edit" onmouseover="preview_Content('preview_sl3','p_slideshow3.png','image_previewSl3')" onmouseout="mouseout_Preview('preview_sl3','p_slideshow3.png','image_previewSl3')">
                            <div id="preview_img" class="preview_sl3">
                                <img src="" id="image_previewSl3">
                            </div>
                        </div>
                    </div>

                </div>

                <div id="about_setting">

                    <div id="site_title" style="align-items:flex-start;">
                        <div id="left">About Company</div>
                        <div id="right">
                            <textarea  id="a_about" placeholder="Your vision here..." onkeyup="getCharLength2();remove_val_general('a_about')" maxlength="500" name="a_about" style="height:25vh;"><?php echo $row_g['a_about']; ?></textarea>
                            <div style="float:right; font-family: 'Poppins', sans-serif; font-size: 1.8vh; font-weight: bold; color: #7D8790;"><span id="char_ctr2"></span> / <span>500</span></div>
                        </div>
                        <div id="preview_side" style="height:28vh;">
                            <img src="images/icons/show.gif" title="Content to edit" onmouseover="preview_Content('preview_aAc','p_about.png','image_previewAac')" onmouseout="mouseout_Preview('preview_aAc','p_about.png','image_previewAac')">
                            <div id="preview_img" class="preview_aAc">
                                <img src="" id="image_previewAac">
                            </div>
                        </div>
                    </div>

                    <div id="site_title" class="div_box_darkImg">
                        <div id="left">Layout Image</div>
                        <div id="right">
                            <div id="img_container" class="img_containerAl">
                                <img src="upload_img_generic/<?php echo $row_g['a_layoutimg']; ?>" style="background-color:#ffff; width:13vh;" id="image_aLI">
                                <div id="for_button">
                                    <input type="file" id="file-imgAli" onchange="loadfileali(event)" name="file-imgAli" hidden>
                                    <button style="color:#7D8790; visibility:hidden;" onclick="deleteali()" id="delete_btn_Iali" type="button">Cancel</button>
                                    <button style="color:#35927B;" onclick="openFileal3()" type="button">Update</button>
                                    <button style="color:#215EE9; visibility:hidden;" id="save_btn_Iali" type="button">Save</button>
                                </div>
                            </div>
                        </div>
                        <div id="preview_side">
                            <img src="images/icons/show.gif" title="Content to edit" onmouseover="preview_Content('preview_aIL','p_aboutIL.png','image_previewIAL')" onmouseout="mouseout_Preview('preview_aIL','p_aboutIL.png','image_previewIAL')">
                            <div id="preview_img" class="preview_aIL">
                                <img src="" id="image_previewIAL">
                            </div>
                        </div>
                    </div>

                </div>


                <div id="employee_setting">

                    <div id="site_title" style="align-items:flex-start;">
                        <div id="left">Our Team Content</div>
                        <div id="right">
                            <textarea  id="e_content" placeholder="Your vision here..." onkeyup="getCharLength3();remove_val_general('e_content')" maxlength="400" name="e_content" style="height:20vh;"><?php echo $row_g['e_content']; ?></textarea>
                            <div style="float:right; font-family: 'Poppins', sans-serif; font-size: 1.8vh; font-weight: bold; color: #7D8790;"><span id="char_ctr3"></span> / <span>400</span></div>
                        </div>
                        <div id="preview_side" style="height:23vh;">
                            <img src="images/icons/show.gif" title="Content to edit" onmouseover="preview_Content('preview_eEC','p_econtent.png','image_previeweEC')" onmouseout="mouseout_Preview('preview_eEC','p_econtent.png','image_previeweEC')">
                            <div id="preview_img" class="preview_eEC">
                                <img src="" id="image_previeweEC">
                            </div>
                        </div>
                    </div>

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
                        ?>
                    <div id="site_title" style="align-items:flex-start;">
                        <div id="left">Employee <?php echo $x+1; ?></div>
                        <div id="right">
                            <div id="img_container" class="img_containerEm<?php echo $x; ?>">
                                <img src="upload_img_generic/<?php echo $arraySubImage[$x]; ?>" style="background-color:#ffff; width:8.5vh;" id="image_Emp<?php echo $x;?>" class="emp_imgG" onerror="this.src='images/services/default.png'">
                                <div id="for_button">
                                    <input type="file" id="file-imgEmp<?php echo $x; ?>" onchange="loadfileEmp(event,'image_Emp<?php echo $x;?>','file-imgEmp<?php echo $x; ?>','key_eachemp<?php echo $x; ?>')" name="file-imgEmp<?php echo $x; ?>" class="file_empClass" hidden>

                                    <button style="color:#7D8790; visibility:hidden;" onclick="deleteEmp('save_btn_EMP<?php echo $x;?>','delete_btn_EMP<?php echo $x;?>','img_containerEm<?php echo $x; ?>','image_Emp<?php echo $x;?>')" id="delete_btn_EMP<?php echo $x;?>" type="button">Cancel</button>

                                    <button style="color:#35927B;" onclick="openFileEmp('file-imgEmp<?php echo $x;?>','save_btn_EMP<?php echo $x;?>','delete_btn_EMP<?php echo $x;?>')" type="button">Update</button>

                                    <button style="color:#215EE9; visibility:hidden;" id="save_btn_EMP<?php echo $x;?>" type="button" onclick="emp1_upIMG('file-imgEmp<?php echo $x; ?>','save_btn_EMP<?php echo $x;?>','delete_btn_EMP<?php echo $x;?>','img_containerEm<?php echo $x; ?>'); saveChangesEmp('z-Ajax-GeneralEmployeeData.php','file-imgEmp<?php echo $x;?>')">Save</button>
                                </div>
                            </div>
                            <div id="emp_edit_generic">
                                <p style="margin-bottom:5%;"><b><?php echo $row_e['fname']." ".$row_e['lname'];?>&nbsp;&nbsp;/&nbsp;&nbsp;<span style="text-transform:uppercase;font-size: 2.3vh;color:black;"><?php echo $row_e['role'];?></span></b></p>
                                <p>Favorite Quote :</p>
                                <textarea  id="e_Quote" placeholder="Your quote here..." onkeyup="getCharLength3();remove_val_general('e_Quote')" maxlength="300" class="e_Quote" name="e_Quote" style="height:10vh;"><?php echo $arraySubQuote[$x]; ?></textarea>
                                <p style="margin-top:5%;">Quoted by :</p>
                                <input type="text" placeholder="Quote author..." value="<?php echo $arraySubQuotedBy[$x]; ?>" style="text-transform:none;" name="e_QuotedBy" id="e_QuotedBy" onkeyup="remove_val_general('e_QuotedBy')">
                            </div>
                        </div>
                        <div id="preview_side" style="height:50vh;" >
                            <img src="images/icons/show.gif" title="Content to edit" onmouseover="preview_Content('preview_EMP<?php echo $x;?>','p_eImg.png','image_previeweEMP<?php echo $x;?>')" onmouseout="mouseout_Preview('preview_EMP','p_eImg.png','image_previeweEMP<?php echo $x;?>')">
                            <div id="preview_img" class="preview_EMP<?php echo $x;?>">
                                <img src="" id="image_previeweEMP<?php echo $x;?>">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" class="key_eachemp" id="key_eachemp<?php echo $x; ?>" value="<?php echo $arraySubImage[$x]; ?>" style="text-transform:none;">
                    <?php
                    $x++;
                 }
                ?>
               <input type="hidden" id="key_allemp" name="key_allemp" style="text-transform:none;">
               <input type="hidden" id="key_allQuote" name="key_allQuote" style="text-transform:none;">
               <input type="hidden" id="key_allQuotedBy" name="key_allQuotedBy" style="text-transform:none;">
                </div>

                <div id="service_setting">
                <?php
                  $sql_general_service = "SELECT * FROM `general_tb`";
                  $search_General_service = filterGeneral_services($sql_general_service);
                  function filterGeneral_services($sql_general_service){  
                      $con1=mysqli_connect('localhost','root','','robles_db');
                      $filter_service = mysqli_query($con1, $sql_general_service);
                  return $filter_service; 
                  }
                  while($row_general = mysqli_fetch_array($search_General_service)){
                      $strSubImg = $row_general['s_img'];
                      $strSubHeader = $row_general['s_Sheader'];
                      $strSubText = $row_general['s_sDesc'];
      
                      $arraySubImage = explode(',', $strSubImg);
                      $arraySubHeader = explode(',', $strSubHeader);
                      $arraySubText = explode('|()|', $strSubText);
                      $z = 0;
                     
                      while($z<count($arraySubHeader)){
                ?>

                    <div id="site_title" style="align-items:flex-start;" class="servicesCount<?php echo $z; ?>">
                        <div id="left">Services</div>
                        <div id="right">
                            <div id="img_container" class="img_containerServ<?php echo $z; ?>">
                                <img src="images/services/<?php echo $arraySubImage[$z]; ?>" style="background-color:#ffff; width:8.5vh;" id="image_Serv<?php echo $z;?>" class="emp_imgG"  onerror="this.src='images/services/default.png'">
                                <div id="for_button">
                                    <input type="file" id="file-imgServ<?php echo $z;?>" onchange="loadfileServ(event,'image_Serv<?php echo $z;?>','file-imgServ<?php echo $z; ?>','key_eachServ<?php echo $z; ?>')"  name="file-imgServ<?php echo $z;?>" class="file_empClass" hidden>

                                    <button style="color:#7D8790; visibility:hidden;" onclick="deleteServ('save_btn_Serv<?php echo $z;?>','delete_btn_Serv<?php echo $z;?>','img_containerServ<?php echo $z; ?>')" id="delete_btn_Serv<?php echo $z;?>" type="button">Cancel</button>

                                    <button style="color:#35927B;" onclick="openFileEmp('file-imgServ<?php echo $z;?>','save_btn_Serv<?php echo $z;?>','delete_btn_Serv<?php echo $z;?>')" type="button">Update</button>

                                    <button style="color:#215EE9; visibility:hidden;" id="save_btn_Serv<?php echo $z;?>" type="button" onclick="serv_upIMG('file-imgServ<?php echo $z; ?>','save_btn_Serv<?php echo $z;?>','delete_btn_Serv<?php echo $z;?>','img_containerServ<?php echo $z; ?>'); saveChangesServ('z-Ajax-GeneralServicesImage.php','file-imgServ<?php echo $z; ?>')">Save</button>
                                </div>
                            </div>
                            <div id="emp_edit_generic">
                                <p style="margin-top:5%;">Service Name</p>
                                <input type="text" placeholder="Service name here..." value="<?php echo $arraySubHeader[$z]; ?>" style="text-transform:none;" name="s_Sserv" id="s_Sserv" onkeyup="remove_val_general('s_Sserv')">
                                <p style="margin-top:5%;">Service Description</p>
                                <textarea  id="s_Sdesc" placeholder="Service Description here..." onkeyup="getCharLength3();remove_val_general('s_Sdesc')" maxlength="2000" class="s_Sdesc" name="s_Sdesc" style="height:40vh;"><?php echo $arraySubText[$z]; ?></textarea>
                            </div>
                        </div>
                        <div id="preview_side1">
                                <div id="minimize" title="Remove" onclick="removeService('servicesCount<?php echo $z; ?>')">&#215;</div>
                                <div id="preview_side" style="height:70vh;" >
                                    <img src="images/icons/show.gif" title="Content to edit" onmouseover="preview_Content('preview_Serv<?php echo $z;?>','s_serv.png','image_previeweServ<?php echo $z;?>')" onmouseout="mouseout_Preview('preview_Serv','s_serv.png','image_previeweServ<?php echo $z;?>')">
                                    <div id="preview_img" class="preview_Serv<?php echo $z;?>">
                                        <img src="" id="image_previeweServ<?php echo $z;?>" style="margin-left:5%;">
                                    </div>
                                </div>
                        </div>
                        <input type="hidden" class="key_eachServ" id="key_eachServ<?php echo $z; ?>" value="<?php echo $arraySubImage[$z]; ?>" style="text-transform:none;">
                    </div>
                <?php
                    $z++;
                    }
                    }
                ?>

                </div>
                    <input type="hidden" id="key_allservName" name="key_allservName" style="text-transform:none;">
                    <input type="hidden" id="key_allservDesc" name="key_allservDesc" style="text-transform:none;">
                    <input type="hidden" id="key_allservImage" name="key_allservImage" style="text-transform:none;">

                    <div id="incre_decre_Service">
                        <div id="btn">
                            <div class="bx bx1 bxl" title="Double click to remove" onclick="decrease_Service()">-</div>
                            <div class="bx" id="total_service"></div>
                            <div class="bx bx1 bxr" title="Add service" onclick="add_Services()">+</div>
                        </div>
                    </div>



                <div id="appointment_setting">
                <?php
                  $sql_general_service = "SELECT * FROM `general_tb`";
                  $search_General_service = filterGeneral_Hoilday($sql_general_service);
                  function filterGeneral_Hoilday($sql_general_service){  
                      $con1=mysqli_connect('localhost','root','','robles_db');
                      $filter_service = mysqli_query($con1, $sql_general_service);
                  return $filter_service; 
                  }
                  while($row_general = mysqli_fetch_array($search_General_service)){
                      $strholidayDate = $row_general['holidays'];
                      $strholidayName = $row_general['holiday_name'];
    
                      $arraySubDate = explode('(|)', $strholidayDate );
                      $arraySubHOLname = explode('(|)', $strholidayName);
                      $zH = 0;
                     
                      while($zH<count($arraySubDate)){
                ?>
                    <div id="site_title" style="align-items:flex-start;" class="servicesCount<?php echo $zH+1; ?>">
                        <div id="left">Date</div>
                        <div id="right">
                            <div id="emp_edit_generic" style="margin-top:0%;">
                                <p>Notes</p>
                                <input type="text" placeholder="ex. Holiday" style="text-transform:Capitalize;" id="holiday_name" value="<?php echo $arraySubHOLname[$zH]; ?>">
                                <p style="margin-top:5%;">Date</p>
                                <input type="date"  style="text-transform:none; width:54%;" id="holiday_date" value="<?php echo $arraySubDate[$zH]; ?>">
                            </div>
                        </div>
                        <div id="preview_side1" style="height:auto;">
                            <div id="minimize" onclick="removeHoliday('servicesCount<?php echo $zH+1; ?>')">&#215;</div>
                        </div>
                    </div>
                    <?php
                    $zH++;
                    }
                    }
                ?>
                </div>
                <input type="hidden" id="key_allholidayName" name="key_allholidayName" style="text-transform:none;">
                <input type="hidden" id="key_allholidayDate" name="key_allholidayDate" style="text-transform:none;">

                <div id="incre_decre_Service1" style="display:none;">
                        <div id="btn">
                            <div class="bx bx1 bxl" title="Double click to remove" onclick="decrease_Holiday()">-</div>
                            <div class="bx" id="total_Holiday"></div>
                            <div class="bx bx1 bxr" title="Add office holidays" onclick="add_Holiday()">+</div>
                        </div>
                </div>
    
                    <div id="for_button1"> 
                        <button id="save_setting" style="background-color:red;" type="button"  onclick="showRestoreDefault()">Restore Default</button>
                        <button id="save_setting1" type="button"  onclick="saveChangesGeneral('z-Ajax-General.php')">Save Changes</button>
                        <button id="save_setting2" type="button" onclick="saveChangesHome('z-Ajax-GeneralHome.php')" style="display:none;">Save Changes</button>

                        <button id="save_setting3" type="button" onclick="saveChangesAbout('z-Ajax-GeneralAbout.php')" style="display:none;">Save Changes</button>

                        <button id="save_setting4" type="button" onclick="saveChangesEmpAll('z-Ajax-GeneralEmployeeData1.php')" style="display:none;">Save Changes</button>

                        <button id="save_setting5" type="button" onclick="saveChangesServAll('z-Ajax-GeneralServiceData1.php')" style="display:none;">Save Changes</button>
                        
                        <button id="save_setting6" type="button" onclick="saveChangesholidayAll('z-Ajax-GeneralHoliday.php')" style="display:none;">Save Changes</button>
                    </div>


                </form>

                <div id="audit_setting">
                    <div id="top">
                        <div id="reportrange">
                            <span id="span_edit">Click to filter by date range</span>
                            <img src="images/icons/dashboard/calendar_inq.png">
                            <input type="hidden" name="filterStart" id="filterStart">
                            <input type="hidden" name="filterEnd" id="filterEnd">
                        </div>
                        <div id="excel_btn" title="Export as .pdf" class="export_pdf_btn">
                            <img src="images/icons/dashboard/pdf_icon.png">
                        </div>
                    </div>

                    <div id="table_patient_div">
                    <table id="table_header" class="table_header_patient">
                        <thead>
                            <tr> 
                                <th>Date & Time</th>
                                <th>Username</th>
                                <th style="text-align:left;">Event Description</th>                     
                            </tr>
                        </thead>
                    </table>

                    <div id="table_patient_container">
                        <table id="table_patientInfo">
                        <thead>
                            <tr> 
                                <th></th>
                                <th></th>
                                <th></th>                     
                            </tr>
                        </thead>

                        <?php  //php for displaying all items
                        $sql = "SELECT * FROM audit_tb order by id desc"; 
                        $search_Audit = filterTable($sql);
                        function filterTable($sql){  
                            $con=mysqli_connect('localhost','root','','robles_db');
                            $filter_patientinfo = mysqli_query($con, $sql);
                             return $filter_patientinfo; 
                            }
                        $sr = 0; 
                        while($rowAud = mysqli_fetch_array($search_Audit)): 
                            echo "<tr>";   
                        ?>      
                                    <td><?php echo $rowAud['date']; ?></td>    
                                    <td><?php echo $rowAud['name']; ?></td>  
                                    <td style="text-align:left;"><?php echo $rowAud['description']; ?></td>              
                        <?php
                            echo "</tr>";
                        $sr++; endwhile;  ?> <!--End of Php -->

                        </table>
                    </div>       
                    <!--No data verifyer-->
                    <div id="no_dataVerifyer">
                        <img src="images/icons/dashboard/no_data_found.png" alt="">
                        NO DATA FOUND
                    </div> 
                </div><!--End of table_patient_div -->
                </div>
      
                <div id="backup_setting">
                        <div class="backupCont">
                            <img src="images/gif/backup.gif">
                            <p id="restore">Restore Everything</p>
                            <p id="subrestore">Restore all system records and database</p>
                            <button onclick="show_validBackupImport()">Import</button>
                        </div>            

                        <div class="backupCont">
                            <img src="images/gif/backup1.gif">
                            <p id="restore">Generate Backup</p>
                            <p id="subrestore">Dowload datebase records and backups</p>
                            <button onclick="show_validBackup()">Download</button>
                        </div>
                </div>

            </div><!-- End of dashboard_content -->

    </div><!-- right_content_dashboard -->


<!--Validation for backup-->
<div id="validate_backup">
    <div id="validateB">
        <p>Please input the company code first.</p>
        <input type="text" id="C_code" placeholder="Company Code" maxlength="6">
        <input type="hidden" id="baseCodeOnly"  value="<?php echo $row_g['companyCode']; ?>">
    
        <button style="background-color: #5fb1f2;" onclick="download_database()">Ok</button>
        <button style="background-color: rgb(155, 155, 155);" onclick="close_validBackup()">Cancel</button>
    </div>
</div>


<!--Validation for import backup-->
<form action="javascript:void(0)" enctype="multipart/form-data" method="post" id="ajax-form_admin_importBackup">
<div id="validate_backupImport">
    <div id="validateImport">
        <p>Please choose database file.</p>
        <input type="file" id="fileBackup" name="file">
        <input type="text" id="C_code1" placeholder="Company Code" maxlength="6">
        <input type="hidden" id="baseCodeOnly1"  value="<?php echo $row_g['companyCode']; ?>">
        <button style="background-color: #5fb1f2;" type="button" id="import_backup">Ok</button>
        <button style="background-color: rgb(155, 155, 155);" onclick="close_validBackupImport()" type="button">Cancel</button>
    </div>
</div>
</form>


<div id="loading_succes">
    <div id="cont">
            <p>The information is being process....</p>
            <img src="images/gif/loading.gif" alt="">
    </div>
</div>


<!--Validation-->
<div id="validation_general">
     <div class="left">
         <img src="" alt="" id="validationGeneral_img">
     </div>
     <div class="center">
         <p id="text_validationHeader"></p>
         <p id="text_validationContent"></p>
     </div>
     <div class="right"><p id="close_general" onclick="close_alertGeneral()">OK</p></div>
</div>



<div id="heigtlimiter">
    <table id="table_patientInfo_topPrint">
                        <thead>
                            <tr> 
                                <th>Date & Time&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th>Username&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th style="text-align:left;">Event Description&nbsp;&nbsp;&nbsp;&nbsp;</th>                         
                            </tr>
                        </thead>
                        <?php  //php for displaying all items
                        $sql = "SELECT * FROM `audit_tb` order by id desc"; 
                        $search_patient = filterTable12($sql);
                        function filterTable12($sql){  
                            $con=mysqli_connect('localhost','root','','robles_db');
                            $filter_patientinfo = mysqli_query($con, $sql);
                             return $filter_patientinfo; 
                            }
                        $sr = 0; 
                        while($rowAd = mysqli_fetch_array($search_patient)): 
                            echo "<tr>";   
                        ?>      
                                    <td><?php echo $rowAd['date']; ?>&nbsp;&nbsp;&nbsp;&nbsp;</td>    
                                    <td><?php echo $rowAd['name']; ?>&nbsp;&nbsp;&nbsp;&nbsp;</td>  
                                    <td><?php echo $rowAd['description']; ?>&nbsp;&nbsp;&nbsp;&nbsp;</td>           
                        <?php
                            echo "</tr>";
                        $sr++; endwhile;  ?> <!--End of Php -->
    </table>
</div>


<!--Deactivate modal-->
<div id="remove_container">
    <div id="remove_content">
    <form action="javascript:void(0)" method="post" id="ajax-form_ob_restore">
        <center><img src="images/reload.png" alt=""></center>
        <p id="one">Restore Default?</p> 
        <p id="two">Are you sure you want to restore the default information?</p> 
            <div id="accept_bot">
            <button id="accept_no"  type="button" onclick="closeRestore()">No</button>
            <button id="accept_yes" type="button" onclick="restoreButton('z-Ajax-AdminRestoreSettings.php')">Yes</button>
        </div>
    </form>
    </div><!--End of remove_content-->
</div><!--End of remove_container-->



</div> <!-- End of for_desktop div -->



</body>

</html>

<!-- Jquery for tooltips-->
<script src="jquery/tooltip.js"></script>
<!-- Jquery for termsAndprivacy-->
<script src="jquery/termsAndprivacy.js"></script>

<!-- Script for side navbar -->
<script src="js/sidenavbar_Ob.js"></script>  
<!-- Jquery for adminAnim-->
<script src="jquery/adminAnim.js"></script>

<!-- Script for pdf -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

<!--ajax for logout-->
<script src="ajax/logoutAdmin.js"></script>
<!--ajax for general settings-->
<script src="ajax/obGeneral.js"></script>

<script>
function deleteimg1(){
    $(".img_containerD").load(location.href+" .img_containerD>*","");  
    document.getElementById('save_btn_dark').style.visibility = "hidden";
    document.getElementById('delete_btn_dark').style.visibility = "hidden";          
    document.getElementById("image_DarkVersion").src = "upload_img_generic/<?php echo $row_g['g_LogoDark']; ?>"
}
function deleteimg(){
    $(".img_containerL").load(location.href+" .img_containerL>*","");  
    document.getElementById('save_btn_light').style.visibility = "hidden";
    document.getElementById('delete_btn_light').style.visibility = "hidden";
    document.getElementById("image_lightVersion").src = "upload_img_generic/<?php echo $row_g['g_LogoLight']; ?>"
}
function deleteimgIlay(){
    $(".img_containerI").load(location.href+" .img_containerI>*","");  
    document.getElementById('save_btn_Ilay').style.visibility = "hidden";
    document.getElementById('delete_btn_Ilay').style.visibility = "hidden";         
    document.getElementById("image_Ilay").src = "upload_img_generic/<?php echo $row_g['h_Layoutimg']; ?>"
}
function deleteSl1(){
    $(".img_containerIsl1").load(location.href+" .img_containerIsl1>*","");  
    document.getElementById('save_btn_Isl1').style.visibility = "hidden";
    document.getElementById('delete_btn_Isl1').style.visibility = "hidden";         
    document.getElementById("image_Sl1").src = "upload_img_generic/<?php echo $row_g['h_slide1']; ?>"
}
function deleteSl2(){
    $(".img_containerIsl2").load(location.href+" .img_containerIsl2>*","");  
    document.getElementById('save_btn_Isl2').style.visibility = "hidden";
    document.getElementById('delete_btn_Isl2').style.visibility = "hidden";         
    document.getElementById("image_Sl2").src = "upload_img_generic/<?php echo $row_g['h_slide2']; ?>"
}
function deleteSl3(){
    $(".img_containerIsl3").load(location.href+" .img_containerIsl3>*","");  
    document.getElementById('save_btn_Isl3').style.visibility = "hidden";
    document.getElementById('delete_btn_Isl3').style.visibility = "hidden";         
    document.getElementById("image_Sl3").src = "upload_img_generic/<?php echo $row_g['h_slide3']; ?>"
}
function deleteali(){
    $(".img_containerAl").load(location.href+" .img_containerAl>*","");  
    document.getElementById('save_btn_Iali').style.visibility = "hidden";
    document.getElementById('delete_btn_Iali').style.visibility = "hidden";           
    document.getElementById("image_aLI").src = "upload_img_generic/<?php echo $row_g['a_layoutimg']; ?>"
}
function deleteEmp(save,del,rel,img){
    $("."+rel).load(location.href+" ."+rel+">*","");  
    document.getElementById(save).style.visibility = "hidden";
    document.getElementById(del).style.visibility = "hidden";           

}
function deleteServ(save,del,rel){
    $("."+rel).load(location.href+" ."+rel+">*","");  
    document.getElementById(save).style.visibility = "hidden";
    document.getElementById(del).style.visibility = "hidden";           
}

function deleteServ1(save,del,imgID){
    document.getElementById(imgID).src = "images/services/default.png"
    document.getElementById(save).style.visibility = "hidden";
    document.getElementById(del).style.visibility = "hidden";           
}

</script>




<script type="text/javascript">
document.querySelector('.export_pdf_btn').addEventListener("click", () => {
    const invoice = document.getElementById("table_patientInfo_topPrint");

            var opt = {
                margin: 1,
                filename: 'AuditLog.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait'}
            };
            html2pdf().from(invoice).set(opt).save();
 })



var verifyer_patient = 0;
function myFunction() {
  var table, filter,tr, td, i, txtValue;
  var dateRangeVal = document.getElementById("span_edit").innerHTML;
  const myArray = dateRangeVal.split(" to ");

  var start = myArray[0]
  var end1 = myArray[1]

  table = document.getElementById("table_patientInfo");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];   
    if (td) {
      txtValue = td.textContent || td.innerText;
      txtValue.substring(0, txtValue.length - 10);
      var newStr = txtValue.slice(0, -9);
      if (start <= newStr && newStr <= end1) {
        tr[i].style.display = "";
        document.getElementById("table_patientInfo").style.opacity = "100%"
        document.getElementById("no_dataVerifyer").style.display = "none"
      } else {
        tr[i].style.display = "none";
      }
    }       
  }

  var verifyer_patient = $('#table_patientInfo tr:visible').length

    if(verifyer_patient === 0) {
      document.getElementById("no_dataVerifyer").style.display = "flex"
      document.getElementById("table_patientInfo").style.opacity = "0%"
    }
}

$(function() {

var start = moment().subtract(29, 'days');
var end = moment();

function cb(start, end) {
    $('#reportrange #span_edit').html(start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD')); 
}
        

$('#reportrange').daterangepicker({
    startDate: start,
    endDate: end,
    ranges: {
       'Today': [moment(), moment()],
       'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
       'Last 7 Days': [moment().subtract(6, 'days'), moment()],
       'Last 30 Days': [moment().subtract(29, 'days'), moment()],
       'This Month': [moment().startOf('month'), moment().endOf('month')],
       'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    }
}, cb);

$('#reportrange').on('apply.daterangepicker', (e, picker) => {
        var dateRangeVal = document.getElementById("span_edit").innerHTML;
        const myArray = dateRangeVal.split(" to ");
        document.getElementById("filterStart").value = myArray[0]
        document.getElementById("filterEnd").value = myArray[1]
        myFunction();
});

});


</script>
