<?php
session_start();
date_default_timezone_set('Asia/Manila');
if(!isset($_SESSION["user_active"])){
    header("location: adminLogin.php");
    exit;
}
require 'php/adminActivelogin.php';
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
     <link rel="stylesheet" href="css/Desktop/Admin-adminPatient.css">
  
     <link rel="shortcut icon" type="image/png" href="upload_img_generic/<?php echo $row_g['g_LogoDark']; ?>"> 

     <link rel="stylesheet" href="AnimBackend/jquery.css">
     <script src="AnimBackend/jquery.js"></script>
     <script src="AnimBackend/jquery1.js"></script>
     <script type="text/javascript" src="AnimBackend/location.js"></script>

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
                        <div id="icons_container" class="dash_navbar" onmouseover="hover_navbar('dash_navbar')" onmouseout="mouseout_navbar('dash_navbar')"><img src="images/icons/dashboard/dashboard.png" title="Dashboard"></div>
                        <div id="icons_container" class="profile_navbar" onmouseover="hover_navbar('profile_navbar')" onmouseout="mouseout_navbar('profile_navbar')"><img src="images/icons/dashboard/profile.png" title="Profile"></div>
                        <div id="icons_container" class="patient_navbar"  style="background-color: #5B8DFF;" ><img src="images/icons/dashboard/patient.png" title="Patient"></div>
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
                    <div id="left">
                        <div id="search_inp">
                            <select id="filter_category">
                                <option value="All" selected>All</option>
                                <option value="Patient ID">Patient ID</option>
                                <option value="Last Name">Last Name</option>
                                <option value="First Name">First Name</option>
                                <option value="Middle Name">Middle Name</option>
                                <option value="Date Added">Date Added</option>
                                <option value="Address">Address</option>
                            </select>
                            <input type="text" placeholder="Search here....." id="search_patientInfo">
                            <img src="images/icons/search_gif.gif">
                        </div>

                        <div id="sort_table" onclick="show_sort()">
                            <img src="images/icons/dashboard/sort_icon.png">
                        </div>

                        <div id="excel_btn" title="Export as .xlsx" class="export_patientInfo_btn">
                            <img src="images/icons/dashboard/sheets.png">
                        </div>

                        <div id="excel_btn" title="Export as .pdf" class="export_pdf_btn">
                            <img src="images/icons/dashboard/pdf_icon.png">
                        </div>

                        
                        <!-- Sort container -->
                        <div id="sort">
                            <div id="sort_container">
                                <div id="one">Sort by</div>
                                <div class="choice" onclick="check_sortPatient('check_id')">
                                    Patient ID
                                    <img src="images/icons/dashboard/check_icon.png" class="check_img" id="check_id">
                                </div>
                                <div class="choice" onclick="check_sortPatient('check_lname')">
                                    Last Name
                                    <img src="images/icons/dashboard/check_icon.png" class="check_img" id="check_lname">
                                </div>
                                <div class="choice" onclick="check_sortPatient('check_fname')">
                                    First Name
                                    <img src="images/icons/dashboard/check_icon.png" class="check_img" id="check_fname">
                                </div>
                                <div class="choice" onclick="check_sortPatient('check_address')">
                                    Address
                                    <img src="images/icons/dashboard/check_icon.png" class="check_img" id="check_address">
                                </div>
                                <div class="choice" onclick="check_sortPatient('check_bday')">
                                    Date Added
                                    <img src="images/icons/dashboard/check_icon.png" class="check_img" id="check_bday">
                                </div>
                                <div id="line"></div>
                                <div class="choice" onclick="check_sortPatient1('check_asc'),sortTableAsc()">
                                   <div>Asc <img src="images/icons/dashboard/asc_icon.png"></div>
                                    <img src="images/icons/dashboard/check_icon.png" class="check_img1" id="check_asc">
                                </div>
                                <div class="choice" onclick="check_sortPatient1('check_desc'),sortTableDesc()">
                                   <div>Desc <img src="images/icons/dashboard/desc_icon.png"></div>
                                    <img src="images/icons/dashboard/check_icon.png" class="check_img1" id="check_desc">
                                </div>

                                <input type="hidden" id="sort_value">
                            </div>
                        </div><!-- End of Sort container -->
                    
                    </div>
                    <div id="right">
                        <p id="date"><?php echo date("F j, Y") ?></p>
                        <p id="time"><?php echo date("h:i A") ?></p>
                    </div>
                </div><!-- End of top staff -->

                <div id="input_container">

                    <div id="left">  
                        <div id="reportrange">
                            <span id="span_edit">Click to filter by date range</span>
                            <img src="images/icons/dashboard/calendar_inq.png">
                            <input type="hidden" name="filterStart" id="filterStart">
                            <input type="hidden" name="filterEnd" id="filterEnd">
                        </div>
                    </div><!-- End of left -->
                    
                    <div id="add_patient_btn">
                        <img src="images/icons/dashboard/add_icon.png">
                        Add Patient
                    </div>


                </div><!-- End of input container -->

                <div id="table_patient_div">
                    <table id="table_header" class="table_header_patient">
                        <thead>
                            <tr> 
                                <th>Patient ID</th>
                                <th>Last Name</th>
                                <th>First Name</th>
                                <th>Middle Name</th>    
                                <th>Date Added</th>   
                                <th>Address</th>         
                                <th>Actions</th>                     
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
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>                               
                            </tr>
                        </thead>

                        <?php  //php for displaying all items
                        $sql = "SELECT * FROM patientinfo_db"; 
                        $search_patient = filterTable($sql);
                        function filterTable($sql){  
                            $con=mysqli_connect('localhost','root','','robles_db');
                            $filter_patientinfo = mysqli_query($con, $sql);
                             return $filter_patientinfo; 
                            }
                        $sr = 0; 
                        while($row = mysqli_fetch_array($search_patient)): 
                            echo "<tr>";   
                        ?>  
                                    <td class="td_block1<?php echo $sr; ?>"><?php echo $row['id']; ?></td>    
                                    <td class="td_block1<?php echo $sr; ?>"><?php echo $row['lname']; ?></td>  
                                    <td class="td_block1<?php echo $sr; ?>"><?php echo $row['fname']; ?></td>  
                                    <td class="td_block1<?php echo $sr; ?>"><?php echo $row['mname']; ?></td>  
                                    <td class="td_block1<?php echo $sr; ?>"><?php echo $row['date_added']; ?></td>  
                                    <td class="td_block1<?php echo $sr; ?>"><?php echo $row['barangay'].", ".$row['municipality'].", ".$row['province']; ?></td>  
                                    <td class="hover_table_pending" style="padding-left:10%;"> 
                                            <button id="view_btn" title="View" onclick="viewPatient('<?php echo $row['id']; ?>')"><img src='images/icons/dashboard/view_icon.png' /></button>
                                            <button id="edit_btn" title="Edit" onclick="editPatient('<?php echo $row['id']; ?>')"><img src="images/icons/dashboard/edit_icon.png"></button>
                                    </td>      
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


                <form action="javascript:void(0)" method="post" id="ajax-form_admin_addpatient">
                <div id="addpatient_div">

                    <div id="addpatient_top">
                        <div id="left">
                            <img src="images/icons/dashboard/add_icon_blue.png">
                            <P>Add Patient</P>
                        </div>
                        <img src="images/icons/close.png" title="Close" id="close_top" onclick="close_addpatientdiv()">
                    </div><!-- addpatient_top -->

                    <div id="info_header">
                        <img src="images/icons/dashboard/employee_icon.png">
                        Personal Information
                    </div>

                    <div id="row1_inp"><!--Name input-->
                        <div class="col">
                            <label>First Name <span style="color:red; font-size:2.5vh;">*</span></label>
                            <input type="text" placeholder="Ex. Jane" name="fname" id="fname" onkeyup="hide_addpatientValidation()"> 
                        </div>
                        <div class="col">
                            <label>Middle Name</label>
                            <input type="text" placeholder="Ex. Garcia" name="mname" id="mname" onkeyup="hide_addpatientValidation()">
                        </div>
                        <div class="col">
                            <label>Last Name <span style="color:red; font-size:2.5vh;">*</span></label>
                            <input type="text" placeholder="Ex. Dela Cruz" name="lname" id="lname" onkeyup="hide_addpatientValidation()">
                        </div>
                    </div>

                    <div id="row1_inp"><!--Address input-->
                        <div class="col">
                            <label>Region <span style="color:red; font-size:2.5vh;">*</span></label>
                            <select id="region"  onchange="hide_addpatientValidation()"></select>
                            <input type="hidden" placeholder="Ex. Pampanga" name="reg" id="reg">
                        </div>
                        <div class="col">
                            <label>Province <span style="color:red; font-size:2.5vh;">*</span></label>
                            <select id="province" onchange="hide_addpatientValidation()"> <option value="" disabled selected hidden>Select your option</option></select>
                            <input type="hidden" placeholder="Ex. Pampanga" name="prov" id="prov" >
                        </div>
                        <div class="col">
                            <label>Municipality <span style="color:red; font-size:2.5vh;">*</span></label>
                            <select id="city"  onchange="hide_addpatientValidation()"><option value="" disabled selected hidden>Select your option</option></select>
                            <input type="hidden" placeholder="Ex. Apalit" name="mun" id="mun" onkeyup="hide_addpatientValidation()">
                        </div>
                    </div>

                    <div id="row1_inp"><!--Address input-->
                        <div class="col">
                            <label>Barangay <span style="color:red; font-size:2.5vh;">*</span></label>
                            <select id="barangay"  onchange="hide_addpatientValidation()"><option value="" disabled selected hidden>Select your option</option></select>
                            <input type="hidden" placeholder="Ex. Sulipan" name="bar" id="bar" onkeyup="hide_addpatientValidation()">
                        </div>
                        <div class="col">
                            <label>Street</label>
                            <input type="text" placeholder="Ex. #721 Kalye Onse" name="street" id="street" onkeyup="hide_addpatientValidation()">
                        </div>
                    </div>

                    <div id="row2_inp"><!--Birthday input-->
                        <div class="col">
                            <label>Birthday <span style="color:red; font-size:2.5vh;">*</span></label>
                            <input type="date"  id="bday" name="bday" onchange="ageGenerator();hide_addpatientValidation();">
                        </div>
                        <div class="col_age">
                            <label>Age <span style="color:red; font-size:2.5vh;">*</span></label>
                            <input type="text" readonly id="age" placeholder="Ex. 45" name="age" onkeyup="hide_addpatientValidation()">
                        </div>
                        <div class="col_weight">
                            <label>Weight <span style="color:red; font-size:2.5vh;">*</span></label>
                            <div id="weight_inp">
                                <input type="number" placeholder="Ex. 67" name="weight" id="weight" onkeyup="hide_addpatientValidation()" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==3) return false;" />
                                <div>kg</div>
                            </div>
                        </div>
                    </div>

                    <div id="row1_inp"><!--Religion input-->
                        <div class="col">
                            <label>Religion <span style="color:red; font-size:2.5vh;">*</span></label>
                            <input type="text" placeholder="Ex. Catholic" name="religion" id="religion" onkeyup="hide_addpatientValidation()">
                        </div>
                        <div class="col">
                            <label>Civil Status <span style="color:red; font-size:2.5vh;">*</span></label>
                            <select name="civil_status">
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Divorce">Divorce</option>
                            </select>
                        </div>
                    </div>

                    <div id="row1_inp"><!--Contact input-->
                        <div class="col">
                            <label>Contact # <span style="color:red; font-size:2.5vh;">*</span></label>
                            <input type="number" placeholder="Ex. 09396164116" name="contact" id="contact" onkeyup="hide_addpatientValidation()">
                        </div>
                        <div class="col">
                            <label>Email <span style="color:red; font-size:2.5vh;">*</span></label>
                            <input type="text" placeholder="Ex. jane@gmail.com" name="email" id="email" onkeyup="hide_addpatientValidation()" style="text-transform:none;">
                        </div>
                    </div>

                    <div id="info_header" style="margin-top:2%;">
                        <img src="images/icons/dashboard/ob_history.png">
                        Obstestrical History
                    </div>

                    <div id="total_childDiv">
                        <p>Total Number of Child : </p>
                        <div id="inc_dec_div">
                            <div id="dec" class="dec_btn" onclick="decrease_obHistory()">-</div>
                            <div id="val_totalChild">0</div>
                            <div id="dec" class="inc_btn" onclick="add_obHistory()">+</div>
                        </div>
                    </div>

                    <div id="total_child_container">
                    </div>

                    <div id="validation_addpatient">
                            <img src="images/icons/error_input.png">
                            <span id="validation_addpatient_Text">.</span>
                    </div>

                    <input type="hidden" id="gender_obHist1" name="gender_obHist1">
                    <input type="hidden" id="bday_obHist1" name="bday_obHist1">
                    <input type="hidden" id="bplace_obHist1" name="bplace_obHist1">
                    <input type="hidden" id="weight_obHist1" name="weight_obHist1">
                    <input type="hidden" id="delivery_obHist1" name="delivery_obHist1">
                    <input type="hidden" id="type_obHist1" name="type_obHist1">

                    <div id="button_div">
                        <button id="cancel_btn" type="button" onclick="close_addpatientdiv()">Cancel</button>
                        <button id="add_btn" type="submit">Add</button>
                    </div>

                </div>
                </form>

            </div><!-- End of dashboard_content -->

    </div><!-- right_content_dashboard -->


    <div id="heigtlimiter">
    <table id="table_patientInfo_topPrint">
                        <thead>
                            <tr> 
                                <th>Patient ID</th>
                                <th>Last Name</th>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Date Added</th>
                                <th>Address</th>                        
                            </tr>
                        </thead>
                        <?php  //php for displaying all items
                        $sql = "SELECT * FROM patientinfo_db"; 
                        $search_patient = filterTable1($sql);
                        function filterTable1($sql){  
                            $con=mysqli_connect('localhost','root','','robles_db');
                            $filter_patientinfo = mysqli_query($con, $sql);
                             return $filter_patientinfo; 
                            }
                        $sr = 0; 
                        while($row = mysqli_fetch_array($search_patient)): 
                            echo "<tr>";   
                        ?>      
                                    <td><?php echo $row['id']; ?>&nbsp;&nbsp;</td>    
                                    <td><?php echo $row['lname']; ?>&nbsp;&nbsp;</td>  
                                    <td><?php echo $row['fname']; ?>&nbsp;&nbsp;</td>  
                                    <td><?php echo $row['mname']; ?>&nbsp;&nbsp;</td>  
                                    <td><?php echo $row['date_added']; ?></td>  
                                    <td>&nbsp;&nbsp;<?php echo $row['barangay'].", ".$row['municipality'].", ".$row['province']; ?></td>              
                        <?php
                            echo "</tr>";
                        $sr++; endwhile;  ?> <!--End of Php -->
    </table>
    </div>

</div> <!-- End of for_desktop div -->



<!--Sweetalert-->
<div id="sweetalert_container">
    <div id="succes_alert">
        <div id="alert_div">
        <img src="images/gif/succes.gif" id="gif_alert">
        <p id="thankyou" class="header_text_validation_appointment">Success!</p>
        <p class="message_alert">Patient has been added.</p>
        <button id="close_alert" onclick="close_alertAddpatient()" class="close_btn_alert">OK</button>
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

<?php
require 'js/patientPage.php';
?>

<!-- Script for adminPatient -->
<script src="js/adminPatient.js"></script>


<!-- Script for pdf -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

<!--ajax for logut-->
<script src="ajax/logoutAdmin.js"></script>
<!-- Ajax for addpatient -->
<script src="ajax/adminAddPatient.js"></script>
<!-- Ajax for view patient -->
<script src="ajax/adminEditViewPatient.js"></script>





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

//close sort container
var modal = document.getElementById("sort");
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

document.querySelector('.export_patientInfo_btn').addEventListener('click', function(){
    var table2excel = new Table2Excel();
    table2excel.export(document.querySelectorAll("#table_patientInfo_topPrint"));
});


document.querySelector('.export_pdf_btn').addEventListener("click", () => {
    const invoice = document.getElementById("table_patientInfo_topPrint");

            var opt = {
                margin: 1,
                filename: 'patients.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'landscape'}
            };
            html2pdf().from(invoice).set(opt).save();
 })


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

   document.getElementById("reg").value=regFinal;
   document.getElementById("bar").value=barFinal;
   document.getElementById("prov").value=provFinal;
   document.getElementById("mun").value=cityFinal;
}

setInterval(function(){ 
    getProv();
}, 300);
</script>



            
<script type="text/javascript">
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
    td = tr[i].getElementsByTagName("td")[4];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (start <= txtValue && txtValue <= end1) {
        tr[i].style.display = "";
        document.getElementById("table_patientInfo").style.opacity = "100%"
        document.getElementById("no_dataVerifyer").style.display = "none"
      } else {
        tr[i].style.display = "none";
      }
    }       
  }

  var verifyer_patient = $('#table_patientInfo tr:visible').length
    var inplen = $("#search_patientInfo").val();

    if(verifyer_patient === 0) {
      document.getElementById("no_dataVerifyer").style.display = "flex"
      document.getElementById("table_patientInfo").style.opacity = "0%"
    }
    else if(inplen.length === 0){
      document.getElementById("table_patientInfo").style.opacity = "100%"
      document.getElementById("no_dataVerifyer").style.display = "none"
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
