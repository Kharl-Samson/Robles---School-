<?php
session_start();
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
     <link rel="stylesheet" href="css/Desktop/Doctor-doctorStaff.css">

  
     <link rel="shortcut icon" type="image/png" href="upload_img_generic/<?php echo $row_g['g_LogoDark']; ?>"> 

     <link rel="stylesheet" href="AnimBackend/jquery.css">
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
                        <div id="icons_container" class="profile_navbar"  onmouseover="hover_navbar('profile_navbar')" onmouseout="mouseout_navbar('profile_navbar')"><img src="images/icons/dashboard/profile.png" title="Profile"></div>
                        <div id="icons_container" class="patient_navbar" onmouseover="hover_navbar('patient_navbar')" onmouseout="mouseout_navbar('patient_navbar')" ><img src="images/icons/dashboard/patient.png" title="Patient"></div>
                        <div id="icons_container" class="staff_navbar" style="background-color: #5B8DFF;"><img src="images/icons/dashboard/staff.png" title="Staff"></div>
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
                        <div id="icons_container" class="profile_navbar"  onmouseover="hover_navbar('profile_navbar')" onmouseout="mouseout_navbar('profile_navbar')">Profile</div>
                        <div id="icons_container" class="patient_navbar" onmouseover="hover_navbar('patient_navbar')" onmouseout="mouseout_navbar('patient_navbar')">Patient</div>
                        <div id="icons_container" class="staff_navbar" style="background-color: #5B8DFF;">Staff</div>
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
                <div id="dash_left">Staff Record</div>
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
                <div id="top_dashboard_content">
                        <div id="left_top_dashboard_content">
                            <div class="appointment_choices" style="box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px; background-color: rgb(248, 248, 248);" onclick="goActiveStaff()" id="staff_active">
                                <img src="images/icons/done_reading.png" style="height:40%;">
                                Active
                            </div>
                            <div class="appointment_choices" onclick="goInactiveStaff()" id="staff_inactive">
                                <img src="images/icons/dashboard/ob_history.png">
                                Records</div>
                            </div>
                        <div id="right_top_dashboard_content">
                            <p id="date"><?php echo date("F j, Y") ?></p>
                            <p id="time"><?php echo date("h:i A") ?></p>
                        </div>
                </div><!-- End of top_dashboard_content -->

                <div id="header_top_table">
                    <div id="left">
                        <div id="header_staff">
                            <img src="images/icons/dashboard/employee_icon.png">
                            Staff Information
                        </div>
                    </div>
                    <div id="right">               
                        <div id="search_emp" class="search_act">
                            <input type="text" placeholder="Search here...." id="srch_input_emp_obPage">
                            <div id="srch_btn" title="Search" class="search_emp_obPage">
                                <img src="images/icons/search_gif.gif" id="search_img_obPage">
                            </div>
                        </div>

                        <div id="search_emp" class="search_inact" style="display:none;">
                            <input type="text" placeholder="Search here...." id="srch_input_emp_obPage_Inactive">
                            <div id="srch_btn" title="Search" class="search_img_obPage_Inactive">
                                <img src="images/icons/search_gif.gif" id="search_img_obPage">
                            </div>
                        </div>

                        <div id="add_emp" onclick="show_addemployee()">
                            <img src="images/icons/dashboard/add_icon.png">
                            Add Staff
                        </div>
                    </div>
                </div>

                <div id="table_div">
                        <div id="top">
                            <div id="col1">Staff</div>
                            <div id="col2">Position</div>
                            <div id="col3">Contact No.</div>
                            <div id="col4">Email</div>
                            <div id="col5">Actions</div>
                        </div>

                        <div id="row_table" class="container table_active_employee">

                                <div id="active_searchFor">
                                <?php  //php for displaying all items
                                $sql = "SELECT * FROM staff_db WHERE schedule!='Sunday' and status='Active' ORDER BY role DESC"; 
                                $staff_tb = filterStaff($sql);
                                function filterStaff($sql){  
                                    $con=mysqli_connect('localhost','root','','robles_db');
                                    $filter_pendingApp = mysqli_query($con, $sql);
                                    return $filter_pendingApp; 
                                    }
                                $sr = 0; 
                                while($row = mysqli_fetch_array($staff_tb)): 
                                ?>  
                            <div id="row" class="draggable row_content_emp" draggable="true">
                                <div id="col1">
                                    <img src="upload_img/<?php echo $row['profile_photo']; ?>" id="staff_img" onerror="this.src='upload_img/account.png'">
                                    <div id="name">
                                        <p><?php echo $row['fname'].' '.$row['lname']; ?></p>
                                        <p id="age"><?php echo $row['age']; ?> years old</p>
                                    </div>
                                </div>
                                <div id="col2"><?php echo $row['role']; ?></div>
                                <div id="col3"><?php echo $row['phone']; ?></div>
                                <div id="col4" style="font-size:1.8vh;"><?php echo $row['email']; ?></div>
                                <div id="col5">
                                    <?php
                                    if($row['username'] == $_SESSION["ob_active"]){
                                    ?> 
                                    <button class="button_subtstr" style="background:#4C5861;" title="View Staff" onclick="show_staffProfile('<?php echo $row['profile_photo']; ?>','<?php echo $row['id']; ?>', '<?php echo $row['fname'].' '.$row['mname'].' '.$row['lname']; ?>', '<?php echo $row['role']; ?>', '<?php echo $row['birthday']; ?>', '<?php echo $row['bar'].', '.$row['mun'].', '.$row['prov']; ?>', '<?php echo $row['age']; ?>', '<?php echo $row['phone']; ?>', '<?php echo $row['email']; ?>', '<?php echo $row['date_start']; ?>', '<?php echo $row['date_end']; ?>')">
                                        <img src="images/icons/dashboard/view_icon.png">
                                    </button>
                                    <button class="button_subtstr" style="background:#5FB1F2;" title="Manage Schedule" onclick="edit_sched('<?php echo $row['id']; ?>', '<?php echo $row['profile_photo']; ?>', '<?php echo $row['fname'].' '.$row['lname']; ?>', '<?php echo $row['email']; ?>', '<?php echo $row['role']; ?>', '<?php echo $row['schedule']; ?>', '<?php echo $row['time']; ?>')">
                                        <img src="images/icons/dashboard/edit_icon.png">
                                    </button>

                                    <button class="button_subtstr" style="visibility:hidden;" title="View Staff">
                                        <img src="images/icons/dashboard/edit_icon.png">
                                    </button>
                                    <?php
                                    }
                                    else{
                                    ?>
                                    <button class="button_subtstr" style="background:#4C5861;" title="View Staff" onclick="show_staffProfile('<?php echo $row['profile_photo']; ?>', '<?php echo $row['id']; ?>', '<?php echo $row['fname'].' '.$row['mname'].' '.$row['lname']; ?>', '<?php echo $row['role']; ?>', '<?php echo $row['birthday']; ?>', '<?php echo $row['bar'].', '.$row['mun'].', '.$row['prov']; ?>', '<?php echo $row['age']; ?>', '<?php echo $row['phone']; ?>', '<?php echo $row['email']; ?>', '<?php echo $row['date_start']; ?>', '<?php echo $row['date_end']; ?>')">
                                        <img src="images/icons/dashboard/view_icon.png">
                                    </button>
                                     <button class="button_subtstr" style="background:#5FB1F2;" title="Manage Schedule" onclick="edit_sched('<?php echo $row['id']; ?>', '<?php echo $row['profile_photo']; ?>', '<?php echo $row['fname'].' '.$row['lname']; ?>', '<?php echo $row['email']; ?>', '<?php echo $row['role']; ?>', '<?php echo $row['schedule']; ?>', '<?php echo $row['time']; ?>')">
                                        <img src="images/icons/dashboard/edit_icon.png">
                                    </button>
                                    <button class="button_subtstr" style="background:#F25F5F;" title="Remove" onclick="removeEmp('<?php echo $row['id']; ?>')">
                                        <img src="images/icons/close_white.png">
                                    </button>                               
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>

                                <?php
                                $sr++; endwhile;  ?> <!--End of Php -->
                            </div> 

                            <div id="inactive_searchFor">
                            <?php  //php for displaying all items
                            $sql1 = "SELECT * FROM staff_db WHERE schedule!='Sunday' and status='Inactive' ORDER BY role DESC"; 
                            $staff_tb1 = filterStaff1($sql1);
                            function filterStaff1($sql1){  
                                $con1=mysqli_connect('localhost','root','','robles_db');
                                $filter_pendingApp1 = mysqli_query($con1, $sql1);
                                return $filter_pendingApp1; 
                                }
                            $sr = 0; 
                            while($row = mysqli_fetch_array($staff_tb1)): 
                            ?>  
                            <div id="row" class="draggable row_content_emp row_content_empInactive" draggable="true">
                                <div id="col1">
                                    <img src="upload_img/<?php echo $row['profile_photo']; ?>" id="staff_img" onerror="this.src='upload_img/account.png'" onerror="this.src='upload_img/account.png'">
                                    <div id="name">
                                        <p><?php echo $row['fname'].' '.$row['lname']; ?></p>
                                        <p id="age"><?php echo $row['age']; ?> years old</p>
                                    </div>
                                </div>
                                <div id="col2"><?php echo $row['role']; ?></div>
                                <div id="col3"><?php echo $row['phone']; ?></div>
                                <div id="col4" style="font-size:1.8vh;"><?php echo $row['email']; ?></div>
                                <div id="col5">
                                    <button class="button_subtstr" style="background:#4C5861;" title="View Staff" onclick="show_staffProfile('<?php echo $row['profile_photo']; ?>', '<?php echo $row['id']; ?>','<?php echo $row['fname'].' '.$row['mname'].' '.$row['lname']; ?>', '<?php echo $row['role']; ?>', '<?php echo $row['birthday']; ?>', '<?php echo $row['bar'].', '.$row['mun'].', '.$row['prov']; ?>', '<?php echo $row['age']; ?>', '<?php echo $row['phone']; ?>', '<?php echo $row['email']; ?>', '<?php echo $row['date_start']; ?>', '<?php echo $row['date_end']; ?>')">
                                        <img src="images/icons/dashboard/view_icon.png">
                                    </button>                  
                            
                                </div>
                            </div>

                                <?php
                                $sr++; endwhile;  ?> <!--End of Php -->
                                </div>

                                <!--No data verifyer-->
                                <div id="no_dataVerifyer">
                                    <img src="images/icons/dashboard/no_data_found.png" alt="">
                                    NO DATA FOUND
                                </div>

                        </div>
                </div>

            </div><!-- End of dashboard_content -->

    </div><!-- right_content_dashboard -->

<!--Deactivate modal-->
<div id="remove_container">
    <div id="remove_content">
    <form action="javascript:void(0)" method="post" id="ajax-form_ob_removeStaff">
        <center><img src="images/removeEmp.png" alt=""></center>
        <p id="one">Are you sure you want to remove this staff?</p> 
        <p id="two">After you delete this record it will move to record history</p> 
            <div id="accept_bot">
            <button id="accept_no"  type="button" onclick="close_removeEmp()">No</button>
            <button id="accept_yes" type="submit">Yes</button>
            <input type="hidden" id="key_empRemove" name="key_empRemove">
        </div>
    </form>
    </div><!--End of remove_content-->
</div><!--End of remove_container-->


<!--Validation-->
<div id="validation_emp">
     <div class="left">
         <img src="" alt="" id="validationEmp_img">
     </div>
     <div class="center">
         <p id="text_validationHeader"></p>
         <p id="text_validationContent"></p>
     </div>
     <div class="right">  <p id="close_validationEmp" onclick="close_swalEmp()">OK</p>   </div>
</div>


<!--Add new employee-->
<div id="addEmp_container">
    <div id="addEmp_content">
        <div id="top">
            <img src="images/icons/dashboard/doctor_dash.png">
            New Staff
        </div>

        <div id="progress_bar">
            <div class="line step1"></div>
            <div class="circle step1">
                <img src="images/icons/dashboard/step1.png">
            </div>
            <div class="line step2"></div>
            <div class="circle step2">
                <img src="images/icons/dashboard/step2.png">
            </div>
            <div class="line step3"></div>
            <div class="circle step3">
                <img src="images/icons/dashboard/step3.png">
            </div>
            <div class="line step4"></div>
            <div class="circle step4">
                <img src="images/icons/dashboard/step4.png">
            </div>
            <div class="line step4"></div>
        </div>
        <div id="progress_text">
                <p>Personal</p>
                <p>Details</p>
                <p>Photo</p>
                <p>Schedule</p>
        </div>
        

        <form enctype="multipart/form-data" action="javascript:void(0)" method="post" id="ajax-form_admin_addStaff">
        <div id="form_content">
            <p id="header" class="header_form_text">Fill all form fields to go next step</p>

            <div id="step1_input">

                <div class="input_content">
                    <div id="inputs">
                        <label>First Name <span style="color:red; font-size:2.5vh;">*</span></label>
                        <div id="input_container" class="for_val_border fvb_fname">
                            <div id="img"><img src="images/icons/dashboard/name_step.png"></div>
                            <input type="text" placeholder="Ex. Jane" id="fname_addEmp" name="fname_addEmp"  onkeyup="removeBorderAddemp('fvb_fname')">
                        </div>
                    </div>
                    
                    <div id="inputs">
                        <label>Middle Name <span style="visibility:hidden; font-size:2.5vh;">*</span></label>
                        <div id="input_container">
                            <div id="img"><img src="images/icons/dashboard/name_step.png"></div>
                            <input type="text" placeholder="Ex. Garcia" name="mname_addEmp">
                        </div>
                    </div>

                    <div id="inputs">
                        <label>Last Name <span style="color:red; font-size:2.5vh;">*</span></label>
                        <div id="input_container" class="for_val_border fvb_lname">
                            <div id="img"><img src="images/icons/dashboard/name_step.png"></div>
                            <input type="text" placeholder="Ex. Dela Cruz" id="lname_addEmp" name="lname_addEmp" onkeyup="removeBorderAddemp('fvb_lname')">
                        </div>
                    </div>
                </div>

                <div class="input_content">
                    <div id="inputs">
                        <label>Region <span style="color:red; font-size:2.5vh;">*</span></label>
                        <div id="input_container" class="for_val_border fvb_reg">
                            <div id="img"><img src="images/icons/dashboard/location_step.png"></div>
                            <select id="region" onchange="removeBorderAddemp('fvb_reg')"></select>
                            <input type="hidden" placeholder="Ex. Pampanga" name="reg" id="reg">
                        </div>
                    </div>
                    
                    <div id="inputs">
                        <label>Province <span style="color:red; font-size:2.5vh;">*</span></label>
                        <div id="input_container" class="for_val_border fvb_province">
                            <div id="img"><img src="images/icons/dashboard/location_step.png"></div>
                            <select id="province" onchange="removeBorderAddemp('fvb_prob')"><option value="" disabled selected hidden>Select region first</option></select>
                            <input type="hidden" placeholder="Ex. Pampanga" name="prov" id="prov" >
                        </div>
                    </div>

                    <div id="inputs">
                        <label>Municipality <span style="color:red; font-size:2.5vh;">*</span></label>
                        <div id="input_container" class="for_val_border fvb_mun">
                            <div id="img"><img src="images/icons/dashboard/location_step.png"></div>
                            <select id="city" onchange="removeBorderAddemp('fvb_mun')"><option value="" disabled selected hidden>Select province first</option></select>
                            <input type="hidden" placeholder="Ex. Apalit" name="mun" id="mun">
                        </div>
                    </div>
                </div>

                <div class="input_content" style="justify-content:flex-start;">
                    <div id="inputs" style="margin-right:5%;">
                        <label>Barangay <span style="color:red; font-size:2.5vh;">*</span></label>
                        <div id="input_container" class="for_val_border fvb_bar">
                            <div id="img"><img src="images/icons/dashboard/location_step.png"></div>
                            <select id="barangay"  onchange="removeBorderAddemp('fvb_bar')"><option value="" disabled selected hidden>Select municipality first</option></select>
                            <input type="hidden" placeholder="Ex. Sulipan" name="bar" id="bar">
                        </div>
                    </div>           

                    <div id="inputs">
                        <label>Street <span style="visibility:hidden; font-size:2.5vh;">*</span></label>
                        <div id="input_container">
                            <div id="img"><img src="images/icons/dashboard/location_step.png"></div>
                            <input type="text" placeholder="Ex. #134 Kalye onse" name="street">
                        </div>
                    </div>
                </div>

            </div>


            <div id="step2_input">

                <div class="input_content">
                    <div id="inputs">
                        <label>Religion <span style="color:red; font-size:2.5vh;">*</span></label>
                        <div id="input_container" class="for_val_border1 fvb_rel">
                            <div id="img"><img src="images/icons/dashboard/religion_step.png"></div>
                            <input type="text" placeholder="Ex. Catholic" id="religion_addEmp" name="religion_addEmp" onkeyup="removeBorderAddemp('fvb_rel')">
                        </div>
                    </div>
                    
                    <div id="inputs">
                        <label>Birthday <span style="color:red; font-size:2.5vh;">*</span></label>
                        <div id="input_container" class="for_val_border1 fvb_bday">
                            <div id="img"><img src="images/icons/dashboard/bday_step.png"></div>
                            <input type="date" style="text-transform:lowercase; height:99%;" id="bday_addEmp" name="bday_addEmp" onchange="ageGenerator(); removeBorderAddemp('fvb_bday')" >
                        </div>
                    </div>

                    <div id="inputs">
                        <label>Age <span style="color:red; font-size:2.5vh;">*</span></label>
                        <div id="input_container" style="width:50%;">
                            <div id="img" style="width:56%;"><img src="images/icons/dashboard/age_step.png"></div>
                            <input type="text" placeholder="Ex. 45" id="age_addEmp" name="age_addEmp" readonly value="0">
                        </div>
                    </div>
                </div>

                <div class="input_content">
                    <div id="inputs">
                        <label>Civil Status <span style="color:red; font-size:2.5vh;">*</span></label>
                        <div id="input_container">
                            <div id="img"><img src="images/icons/dashboard/civil_step.png"></div>
                            <select id="civil" name="civil_addEmp">
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Divorce">Divorce</option>
                            </select>
                        </div>
                    </div>
                    
                    <div id="inputs">
                        <label>Contact # <span style="color:red; font-size:2.5vh;">*</span></label>
                        <div id="input_container" class="for_val_border1 fvb_contact">
                            <div id="img"><img src="images/icons/dashboard/contact_step.png"></div>
                            <input type="number" placeholder="Ex. 0939616####"  id="contact_addEmp" name="contact_addEmp" onkeyup="removeBorderAddemp('fvb_contact')">
                        </div>
                    </div>

                    <div id="inputs">
                        <label>Email <span style="color:red; font-size:2.5vh;">*</span></label>
                        <div id="input_container" class="for_val_border1 fvb_email">
                            <div id="img"><img src="images/icons/dashboard/email_step.png"></div>
                            <input type="text" placeholder="Ex. jane###@gmail.com" style="text-transform:none;" id="email_addEmp" name="email_addEmp" onkeyup="removeBorderAddemp('fvb_email')">
                        </div>
                    </div>
                </div>

                <div class="input_content" style="justify-content:flex-start;">
                    <div id="inputs" style="margin-right:5%;">
                        <label>Role <span style="color:red; font-size:2.5vh;">*</span></label>
                        <div id="input_container" class="for_val_border1 fvb_role">
                            <div id="img"><img src="images/icons/dashboard/role_step.png"></div>
                            <select id="role_addEmp" name="role_addEmp" onchange="removeBorderAddemp('fvb_role')">
                                <option value="" disabled selected hidden>-Select Option-</option>
                                <option value="Ob-Gyne">Ob-Gyne</option>
                                <option value="Midwife">Midwife</option>
                            </select>
                        </div>
                    </div>           
                </div>

            </div>


            <div id="step3_input">
                <div id="left">
                    Preview:
                    <img src="upload_img/account.png" id="profile_img1">
                </div>

                    <div class="drag-area">
                        <img src="images/icons/dashboard/drag_icon.png" id="drag_logo">
                        <p><button type="button">Choose a file</button></p>
                    </div>
                    <input type="file" id="testing" name="file-input" hidden>
                    <input type="hidden" id="pic_inpkey" name="pic_inpkey">
            </div>            


            <div id="step4_input">
                <div id="left"><img src="images/icons/dashboard/calendar_step.png"></div>
                <div id="right">
                    <p id="text">Availability:</p>
                    
                    <div id="sched_container">
                        <div id="l_sched">

                            <div id="radio">
                                <div id="one" class="Monday">Monday</div>
                                <div id="two">
                                    <label class="switch">
                                        <input type="checkbox" id="cb_date1" value="Monday" onclick="removeErroSched();change_TextDuty('1')">
                                        <span class="slider round"></span>
                                    </label>
                                </div> 
                                <div id="three" class="duty1">Dayoff</div>
                            </div>

                            <div id="radio">
                                <div id="one" class="Wednesday">Wednesday</div>
                                <div id="two">
                                    <label class="switch">
                                        <input type="checkbox" id="cb_date2" value="Wednesday" onclick="removeErroSched();change_TextDuty('2')">
                                        <span class="slider round"></span>
                                    </label>
                                </div> 
                                <div id="three" class="duty2">Dayoff</div>
                            </div>

                            <div id="radio">
                                <div id="one" class="Friday">Friday</div>
                                <div id="two">
                                    <label class="switch">
                                        <input type="checkbox" id="cb_date3" value="Friday" onclick="removeErroSched();change_TextDuty('3')">
                                        <span class="slider round"></span>
                                    </label>
                                </div> 
                                <div id="three" class="duty3">Dayoff</div>
                            </div>

                        </div>
                    
                        <div id="r_sched">

                            <div id="radio">
                                <div id="one" class="Tuesday">Tuesday</div>
                                <div id="two">
                                    <label class="switch">
                                        <input type="checkbox" id="cb_date4" value="Tuesday" onclick="removeErroSched();change_TextDuty('4')">
                                        <span class="slider round"></span>
                                    </label>
                                </div> 
                                <div id="three" class="duty4">Dayoff</div>
                            </div>

                            <div id="radio">
                                <div id="one" class="Thursday">Thursday</div>
                                <div id="two">
                                    <label class="switch">
                                        <input type="checkbox" id="cb_date5" value="Thursday" onclick="removeErroSched();change_TextDuty('5')">
                                        <span class="slider round"></span>
                                    </label>
                                </div> 
                                <div id="three" class="duty5">Dayoff</div>
                            </div>

                            <div id="radio">
                                <div id="one" class="Saturday">Saturday</div>
                                <div id="two">
                                    <label class="switch">
                                        <input type="checkbox" id="cb_date6" value="Saturday" onclick="removeErroSched();change_TextDuty('6')">
                                        <span class="slider round"></span>
                                    </label>
                                </div> 
                                <div id="three" class="duty6">Dayoff</div>
                            </div>

                            <input type="hidden" id="sched_input" name="sched_input">
                        </div>
                    </div>
                    
                    <div id="time_content">
                        <div id="left">
                            <label>From :</label>
                            <div id="input_container" class="time_val fvb_time1">
                                <div id="img"><img src="images/icons/dashboard/clock_step.png"></div>
                                <input type="time" style="text-transform:lowercase;" name="time1" id="time1" pattern="^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$" onkeyup="removeBorderAddemp('fvb_time1')">
                            </div>
                        </div>
                        <div id="left">
                            <label>To :</label>
                            <div id="input_container" class="time_val fvb_time2">
                                <div id="img"><img src="images/icons/dashboard/clock_step.png"></div>
                                <input type="time" style="text-transform:lowercase;" name="time2" id="time2" pattern="^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$" onkeyup="removeBorderAddemp('fvb_time2')">
                            </div>
                        </div>
                    </div>

                </div>
            </div>            

            <div id="validation" class="validation_forAdminLogin"><img src="images/icons/error_input.png"><span id="validation_span"></span></div>

            <div id="button_addemp">
                <button style="background-color:#929292;" id="cancel_step" onclick="close_addemployee()" type="button">Cancel</button>
                <button style="background-color:#929292; display:none;" onclick="backStep()" id="prev_step"  type="button">Previous</button>
                <button style="background-color:#93C1F9;  display:block;" id="next_step_button" onclick="nextStep()"  type="button">Next</button>
                <button style="background-color:#93C1F9;  display:none;" id="upload_step_button"  type="submit">Next</button>
                <button style="background-color:#93C1F9; display:none;" id="submit_step_button" onclick="addStaf('z-Ajax-ObAddStaff.php')" type="button">Submit</button>
            </div>

        </div>
        </form>
    </div>
</div>


<!--Edit Schedule-->
<div id="edit_schedule">
<form action="javascript:void(0)" method="post" id="ajax-form_ob_Editsched">
    <div id="edit_container">
        <div id="top">
            <img src="images/icons/dashboard/calendar_step.png">
            Manage your schedule
        </div>

        <input type="hidden" id="key_sched_edit" name="key_sched_edit">
        <input type="hidden" id="key_Id_Sc_edit" name="key_Id_Sc_edit">

        <div id="semiTop">
            <div id="left">
                <div id="img"><img src="" id="img_editSched"  onerror="this.src='upload_img/account.png'"></div>
                <div id="name">
                    <p id="a" class="name_editSched"></p>
                    <p id="b" class="email_editSched"></p>
                </div>
            </div>
            <div id="right">
                <div id="role">
                    <img src="images/icons/dashboard/role_blue.png">
                    <span class="role_editSched"></span> 
                </div>
            </div>
        </div>

        <div id="content">
            <div id="left">
                <div id="one"></div>
                <div id="circle"></div>
                <div id="two"></div>
            </div>

            <div id="right">
                <p id="avail">Availability:</p>

                <div class="sched">
                    <div id="one">Monday</div>
                    <div id="three" class="dutyF" style="width:20%;">Day off</div>
                    <div id="two">
                        <label class="switch">
                            <input type="checkbox" id="cb_dateA" value="Monday" class="cb1_edit" onclick="edit_cbboxStaff();change_TextDuty1('A')">
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div id="three" class="dutyA">Duty</div>
                </div>

                <div class="sched">
                    <div id="one">Tuesday</div>
                    <div id="three" class="dutyF" style="width:20%;">Day off</div>
                    <div id="two">
                        <label class="switch">
                            <input type="checkbox" id="cb_dateB" value="Tuesday" class="cb1_edit" onclick="edit_cbboxStaff();change_TextDuty1('B')">
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div id="three" class="dutyB">Duty</div>
                </div>

                <div class="sched">
                    <div id="one">Wednesday</div>
                    <div id="three" class="dutyF" style="width:20%;">Day off</div>
                    <div id="two">
                        <label class="switch">
                            <input type="checkbox" id="cb_dateC" value="Wednesday" class="cb1_edit"  onclick="edit_cbboxStaff();change_TextDuty1('C')">
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div id="three" class="dutyC">Duty</div>
                </div>

                <div class="sched">
                    <div id="one">Thursday</div>
                    <div id="three" class="dutyF" style="width:20%;">Day off</div>
                    <div id="two">
                        <label class="switch">
                            <input type="checkbox" id="cb_dateD" value="Thursday" class="cb1_edit"  onclick="edit_cbboxStaff();change_TextDuty1('D')"> 
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div id="three" class="dutyD">Duty</div>
                </div>

                <div class="sched">
                    <div id="one">Friday</div>
                    <div id="three" class="dutyF" style="width:20%;">Day off</div>
                    <div id="two">
                        <label class="switch">
                            <input type="checkbox" id="cb_dateE" value="Friday" class="cb1_edit"  onclick="edit_cbboxStaff();change_TextDuty1('E')">
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div id="three" class="dutyE">Duty</div>
                </div>

                <div class="sched">
                    <div id="one">Saturday</div>
                    <div id="three" class="dutyF" style="width:20%;">Day off</div>
                    <div id="two">
                        <label class="switch">
                            <input type="checkbox" id="cb_dateF" value="Saturday" class="cb1_edit"  onclick="edit_cbboxStaff();change_TextDuty1('F')">
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div id="three" class="dutyF">Duty</div>
                </div>
            </div>
        </div>

        <div id="time_header">
            <div id="left">
                <div id="circle"></div>
                <div id="one"></div>
            </div>
            <div id="right">Time:</div>
        </div>

        <div id="time_content">
            <div id="prog">
                <div id="two"></div>
            </div>
            
            <div id="time_cont">
                <div id="left">
                    <label>From :</label>
                    <div id="input_container" class="time_val fvb_time1">
                         <div id="img"><img src="images/icons/dashboard/clock_step.png"></div>
                          <input type="time" style="text-transform:lowercase;" name="time1" id="time_E_1" pattern="^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$" onkeyup="removeBorderAddemp('fvb_time1')">
                     </div>
                </div>
                <div id="left">
                    <label>To :</label>
                    <div id="input_container" class="time_val fvb_time2">
                        <div id="img"><img src="images/icons/dashboard/clock_step.png"></div>
                        <input type="time" style="text-transform:lowercase;" name="time2" id="time_E_2" pattern="^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$" onkeyup="removeBorderAddemp('fvb_time2')">
                    </div>
                </div>
            </div>
        </div>

        <div id="validation1" class="validation_forAdminLogin"><img src="images/icons/error_input.png"><span id="validation_span1"></span></div>

        <div id="for_btn">
            <button style="background-color:#929292;" type="button" onclick="close_sched()">Cancel</button>
            <button style="background-color:#93C1F9;" type="submit">Submit</button>
        </div>

    </div>
</form>   
</div>


<!-- View staff modal-->
<div id="view_staff_container">
    <div id="Close_view_staff" title="Close" onclick="close_staffProfile()">&#215;</div>
    <div id="view_staff_content">
        <div id="top">
            <img src="" onerror="this.src='upload_img/account.png'" id="image_view">
            <p id="name_view" style="text-transform:capitalize;"></p>
            <p id="id_view"></p>
        </div>

        <div id="content">
            <div id="left">
                <div id="info">
                    <div id="inpWimg"><img src="images/icons/dashboard/role_step.png"><label>Position</label></div>
                    <p id="position_view"></p>
                </div>

                <div id="info">
                    <div id="inpWimg"><img src="images/icons/dashboard/location_step.png"><label>Address</label></div>
                    <p id="add_view" style="text-transform:Uppercase;"></p>
                </div>

                <div id="info">
                    <div id="inpWimg"><img src="images/icons/dashboard/contact_step.png"><label>Contact No.</label></div>
                    <p id="contact_view"></></p>
                </div>

                <div id="info">
                    <div id="inpWimg"><img src="images/icons/dashboard/age_step.png"><label>Date Hired</label></div>
                    <p id="hired_view"></p>
                </div>
            </div>

            <div id="right">
                <div id="info">
                    <div id="inpWimg"><img src="images/icons/dashboard/bday_step.png"><label>Date of Birth</label></div>
                    <p id="bday_view"></p>
                </div>

                <div id="info">
                    <div id="inpWimg"><img src="images/icons/dashboard/age_step.png"><label>Age</label></div>
                    <p id="age_view"></p>
                </div>

                <div id="info">
                    <div id="inpWimg"><img src="images/icons/dashboard/email_step.png"><label>Email</label></div>
                    <p id="email_view" style="font-size:2vh;"></p>
                </div>

                <div id="info">
                    <div id="inpWimg"><img src="images/icons/dashboard/age_step.png"><label>Date Ended</label></div>
                    <p id="ended_view"></p>
                </div>
            </div>
        </div>

    </div>
</div>





</div> <!-- End of for_desktop div -->


</body>

</html>


<!-- Jquery for tooltips-->
<script src="jquery/tooltip.js"></script>
<!-- Jquery for termsAndprivacy-->
<script src="jquery/termsAndprivacy.js"></script>
<!-- Jquery for Ob animation-->
<script src="jquery/obAnim.js"></script>

<!-- Script for side navbar -->
<script src="js/sidenavbar_Ob.js"></script>

<!--ajax for logut-->
<script src="ajax/logoutAdmin.js"></script>

<!-- Ajax for managing staff -->
<script src="ajax/obStaff.js"></script>


