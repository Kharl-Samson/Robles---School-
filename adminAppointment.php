<?php
session_start();
require_once "Z-connection.php";
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
     <link rel="stylesheet" href="css/Desktop/Admin-adminAppointment.css">
  
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
                        <div id="icons_container" class="dash_navbar" onmouseover="hover_navbar('dash_navbar')" onmouseout="mouseout_navbar('dash_navbar')"><img src="images/icons/dashboard/dashboard.png" title="Dashboard"></div>
                        <div id="icons_container" class="profile_navbar" onmouseover="hover_navbar('profile_navbar')" onmouseout="mouseout_navbar('profile_navbar')"><img src="images/icons/dashboard/profile.png" title="Profile"></div>
                        <div id="icons_container" class="patient_navbar" onmouseover="hover_navbar('patient_navbar')" onmouseout="mouseout_navbar('patient_navbar')" ><img src="images/icons/dashboard/patient.png" title="Patient"></div>
                        <div id="icons_container" class="staff_navbar" onmouseover="hover_navbar('staff_navbar')" onmouseout="mouseout_navbar('staff_navbar')"><img src="images/icons/dashboard/staff.png" title="Staff"></div>
                        <div id="icons_container" class="inventory_navbar" onmouseover="hover_navbar('inventory_navbar')" onmouseout="mouseout_navbar('inventory_navbar')"><img src="images/icons/dashboard/inventory.png" title="Inventory"></div>
                        <div id="icons_container" class="appointment_navbar" style="background-color: #5B8DFF;" ><img src="images/icons/dashboard/appointment.png" title="Appointment"></div>
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
                        <div id="icons_container" class="patient_navbar" onmouseover="hover_navbar('patient_navbar')" onmouseout="mouseout_navbar('patient_navbar')">Patient</div>
                        <div id="icons_container" class="staff_navbar" onmouseover="hover_navbar('staff_navbar')" onmouseout="mouseout_navbar('staff_navbar')">Staff</div>
                        <div id="icons_container" class="inventory_navbar" onmouseover="hover_navbar('inventory_navbar')" onmouseout="mouseout_navbar('inventory_navbar')">Inventory</div>
                        <div id="icons_container" class="appointment_navbar" style="background-color: #5B8DFF;">Appointment</div>
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
                <div id="dash_left">Appointment List</div>
                <div id="dash_right">
                    <div id="notification_container">
                        <img src="images/icons/dashboard/notification.png" title="Notification" id="notif_img">
                        <div id="notif_count"><?php echo $notifCount1+$notifCount2; ?></div>
                    </div><!-- End of notification container -->

                    <?php  //php for displaying the hover icon 
                        $row = mysqli_fetch_array($search_resulthover);   
                        $_SESSION["auditname"] = $row['username'];
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

            <?php
                require_once "Z-connection.php";
                $sqlcount = "SELECT COUNT(id) AS total From `acceptedappointment_tb` where archive!='on'";
                $count=mysqli_query($conn, $sqlcount);
                $total_count = mysqli_fetch_assoc($count);
                $total= $total_count['total'];

                $sqlcountPending = "SELECT COUNT(id) AS total From `pendingappointment_tb`";
                $countPending = mysqli_query($conn, $sqlcountPending);
                $total_countPending = mysqli_fetch_assoc($countPending);
                $totalPending= $total_countPending['total'];

            ?>

                <div id="top_dashboard_content">
                        <div id="left_top_dashboard_content">
                            <div class="appointment_choices" style="box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px; background-color: rgb(248, 248, 248);" onclick="appointment_table_show()" id="appointment_accept">
                            <img src="images/icons/holidaySetting.png" alt="">
                            List of all Appointments&nbsp;<span id="acceptAppoint_span">(<?php echo $total; ?>)</span></div>

                            <div class="appointment_choices" onclick="pending_table_show()" id="appointment_pending">
                            <img src="images/icons/pendingApp.png" alt="">
                            Pending Appointment&nbsp;(<?php echo $totalPending; ?>)</div>

                            <div class="appointment_choices"  onclick="history_table_show()" id="appointment_history">
                            <img src="images/icons/auditSetting.png" alt="">
                            Appointment History&nbsp;</div>

                            <div class="appointment_choices"  onclick="archive_table_show()" id="appointment_archive">
                            <img src="images/icons/backupSetting.png" alt="">
                            Archive</div>
                        </div>
                </div><!-- End of top_dashboard_content -->

                <div id="semitop_dashboard_content">
                    <div id="left_semitop_dashboard_content">
                        <div id="date_text">Filter by Date</div>

                        <div id="date_inp">
                            <div id="date_inp_left">
                                <div id="reportrange" class="range_accept">
                                    <span id="span_edit_Accept">Click to filter by date range</span>
                                    <img src="images/icons/dashboard/calendar_inq.png">
                                </div>
                                <div id="reportrange" class="range_pending" style="display:none;">
                                    <span id="span_edit_Pending">Click to filter by date range</span>
                                    <img src="images/icons/dashboard/calendar_inq.png">
                                </div>
                                <div id="reportrange" class="range_history" style="display:none;">
                                    <span id="span_edit_History">Click to filter by date range</span>
                                    <img src="images/icons/dashboard/calendar_inq.png">
                                </div>
                                <div id="reportrange" class="range_archive" style="display:none;">
                                    <span id="span_edit_Archive">Click to filter by date range</span>
                                    <img src="images/icons/dashboard/calendar_inq.png">
                                </div>
                                <div id="search_btn" title="Export as .xlsx"  class="downloadxlsx_Accepted">
                                    <img src="images/icons/dashboard/sheets.png">
                                </div>
                                <div id="search_btn" title="Export as .pdf" class="export_pdf_Accept">
                                    <img src="images/icons/dashboard/pdf_icon.png">
                                </div>
                                <div id="search_btn" title="Export as .xlsx"  class="downloadxlsx_Pending" style="display:none;">
                                    <img src="images/icons/dashboard/sheets.png">
                                </div>
                                <div id="search_btn" title="Export as .pdf" class="export_pdf_Pending" style="display:none;">
                                    <img src="images/icons/dashboard/pdf_icon.png">
                                </div>
                                <div id="search_btn" title="Export as .xlsx"  class="downloadxlsx_history" style="display:none;">
                                    <img src="images/icons/dashboard/sheets.png">
                                </div>
                                <div id="search_btn" title="Export as .pdf" class="export_pdf_History" style="display:none;">
                                    <img src="images/icons/dashboard/pdf_icon.png">
                                </div>
                                <div id="search_btn" title="Export as .xlsx"  class="downloadxlsx_archive" style="display:none;">
                                    <img src="images/icons/dashboard/sheets.png">
                                </div>
                                <div id="search_btn" title="Export as .pdf" class="export_pdf_Archive" style="display:none;">
                                    <img src="images/icons/dashboard/pdf_icon.png">
                                </div>
                            </div>
                            
                            <div id="date_inp_right">
                                <select id="filter_category">
                                    <option value="All" selected>All</option>
                                    <option value="Patient Name">Patient Name</option>
                                    <option value="Address">Address</option>
                                    <option value="Email Address">Email Address</option>
                                    <option value="Phone Number">Phone Number</option>
                                    <option value="Appointment Date">Appointment Date</option>
                                    <option value="Appointment Time">Appointment Time</option>
                                </select>
                                <select id="filter_category1" style="display:none;">
                                    <option value="All" selected>All</option>
                                    <option value="Appointment#">Appointment#</option>
                                    <option value="Patient Name">Patient Name</option>
                                    <option value="Doctors Duty">Doctors Duty</option>
                                    <option value="Midwifes Duty">Midwifes Duty</option>
                                    <option value="Date">Date</option>
                                </select>
                                <input type="text" placeholder="Search here....." id="search_table_Acceptedappointment">
                                <input type="text" placeholder="Search here....." id="search_table_Pendingappointment" style="display:none;">
                                <input type="text" placeholder="Search here....." id="search_table_Historyappointment" style="display:none;">
                                <input type="text" placeholder="Search here....." id="search_table_Archiveappointment" style="display:none;">
                                <img src="images/icons/search_gif.gif">
                            </div>                         

                            
                        </div>

                    </div><!--End of left_semitop_dashboard_content-->
                    
                </div><!-- End of semitop_dashboard_content -->

            <!------------------------------------------------------------------------------------------->

            <div class="table_appointment" id="table_accepted_appointment">
                    <table id="table_header" class="table_header_pending_appointment">
                        <thead>
                            <tr> 
                                <th>Patient Name</th>
                                <th>Address</th>
                                <th>Email Address</th>
                                <th>Phone Number</th>
                                <th>Appointment Date</th>    
                                <th>Appointment Time</th>                                 
                            </tr>
                        </thead>
                    </table>

                    <div id="table_content">
                        <table id="table_Accept">
                        <thead>
                            <tr> 
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>                                     
                            </tr>
                        </thead>

                        <?php  //php for displaying all items
                        $sql = "SELECT * FROM acceptedappointment_tb where archive!='on'"; 
                        $search_pendingApps = filterTable1($sql);
                        function filterTable1($sql){  
                            $con=mysqli_connect('localhost','root','','robles_db');
                            $filter_pendingApp = mysqli_query($con, $sql);
                             return $filter_pendingApp; 
                            }
                        $sr = 0; 
                        while($row = mysqli_fetch_array($search_pendingApps)): 
                            echo "<tr onmouseover='hover_table_report_doctor_app($sr)' onmouseout='close_table_accept_app($sr)'>";   
                        ?>  
                                    <td style="text-transform:capitalize;" class="td_block1<?php echo $sr; ?>"><?php echo $row['fname']." ".$row['lname']; ?></td>
                                    <td class="td_block1<?php echo $sr; ?>"><?php echo $row['address']; ?></td>
                                    <td class="td_block1<?php echo $sr; ?>"><?php echo $row['email']; ?></td>
                                    <td class="td_block1<?php echo $sr; ?>"><?php echo $row['contact']; ?></td>
                                    <td class="td_block1<?php echo $sr; ?>"><?php echo $row['date']; ?></td>     
                                    <td class="td_block1<?php echo $sr; ?>"><?php echo $row['time']; ?></td>   
                                    <td id="hover_table_accepted<?php echo $sr; ?>" class="hover_table_accepted" colspan="6">
                                        <center>
                                        <button id="delete_btn" style="display:flex;align-items:center;justify-content:center;" onclick="showRemoveApp_modal('<?php echo $row['id']; ?>')"></button>
                                        </center>
                                    </td>               
                        <?php
                            echo "</tr>";
                        $sr++; endwhile;  ?> <!--End of Php -->

                        </table>

                        <!--No data verifyer-->
                        <div id="no_dataVerifyer">
                             <img src="images/icons/dashboard/no_data_found.png" alt="">
                             NO DATA FOUND
                        </div>

                        <script>
                                var table = document.getElementById("table_Accept");
                                var totalRowCount = table.rows.length; 
                                if(totalRowCount === 1){          
                                    document.getElementById("no_dataVerifyer").innerHTML ='<img src="images/icons/dashboard/no_data_found.png" alt=""> Record is empty'         
                                    document.getElementById("no_dataVerifyer").style.display = "flex"
                                }
                        </script>
                    </div>
                </div>

                <!------------------------------------------------------------------------------------------------------>

                <!------------------------------------------------------------------------------------------->

                 <div class="table_appointment" id="table_pending_appointment">
                    <table id="table_header" class="table_header_pending_appointment">
                        <thead>
                            <tr> 
                                <th>Patient Name</th>
                                <th>Address</th>
                                <th>Email Address</th>
                                <th>Phone Number</th>
                                <th>Appointment Date</th>    
                                <th>Appointment Time</th>                                 
                            </tr>
                        </thead>
                    </table>

                    <div id="table_content">
                        <table id="table_pendingApp">
                        <thead>
                            <tr> 
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>                                     
                            </tr>
                        </thead>

                        <?php  //php for displaying all items
                        $sql = "SELECT * FROM pendingappointment_tb"; 
                        $search_pendingApp = filterTable($sql);
                        function filterTable($sql){  
                            $con=mysqli_connect('localhost','root','','robles_db');
                            $filter_pendingApp = mysqli_query($con, $sql);
                             return $filter_pendingApp; 
                            }
                        $sr = 0; 
                        while($row = mysqli_fetch_array($search_pendingApp)): 
                            echo "<tr onmouseover='hover_table_pending_app($sr)' onmouseout='close_table_pending_app($sr)'>";   
                        ?>  
                                    <td style="text-transform:capitalize;" class="td_block td_block<?php echo $sr; ?>"><?php echo $row['fname']." ".$row['lname']; ?></td>
                                    <td class="td_block td_block<?php echo $sr; ?>"><?php echo $row['address']; ?></td>
                                    <td class="td_block td_block<?php echo $sr; ?>"><?php echo $row['email']; ?></td>
                                    <td class="td_block td_block<?php echo $sr; ?>"><?php echo $row['contact']; ?></td>
                                    <td class="td_block td_block<?php echo $sr; ?>"><?php echo $row['date']; ?></td>     
                                    <td class="td_block td_block<?php echo $sr; ?>"><?php echo $row['time']; ?></td>
                                    <td id="hover_table_pending<?php echo $sr; ?>" class="hover_table_pending" colspan="6">
                                        <center>
                                        <button id="reject_btn" onclick="reject_pendtingApp_tb('<?php echo $row['fname'].' '.$row['lname']; ?>','<?php echo $row['email']; ?>','<?php echo $row['contact']; ?>','<?php echo $row['date']; ?>','<?php echo $row['time']; ?>','<?php echo $row['id']; ?>')"></button>
                                        <button id="accept_btn" onclick="accept_pendtingApp_tb('<?php echo $row['fname']; ?>','<?php echo $row['mname']; ?>','<?php echo $row['lname']; ?>','<?php echo $row['address']; ?>','<?php echo $row['email']; ?>','<?php echo $row['contact']; ?>','<?php echo $row['date']; ?>','<?php echo $row['time']; ?>','<?php echo $row['patient_id']; ?>','<?php echo $row['service']; ?>')"></button>
                                        </center>
                                    </td>                   
                        <?php
                            echo "</tr>";
                        $sr++; endwhile;  ?> <!--End of Php -->

                        </table>

                        <!--No data verifyer-->
                         <div id="no_dataVerifyer1">
                             <img src="images/icons/dashboard/no_data_found.png" alt="">
                             NO DATA FOUND
                        </div>
                    </div>

                </div><!-- End of Table Pending appointment -->

                <!------------------------------------------------------------------------------------------------>
                
                <!------------------------------------------------------------------------------------------------>

                  <div class="table_appointment" id="table_history_appointment">
                    <table id="table_header" class="table_header_history_appointment">
                        <thead>
                            <tr> 
                                <th>Appointment #</th>
                                <th>Patient Name</th>
                                <th>Type of Service</th>
                                <th>Doctors Duty</th>
                                <th>Midwifes Duty</th>
                                <th>Date</th>                                 
                            </tr>
                        </thead>
                    </table>

                    <div id="table_content">
                        <table id="table_History">
                        <thead>
                            <tr> 
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>                                     
                            </tr>
                        </thead>

                        <?php  //php for displaying all items
                        $sql = "SELECT * FROM doctorreport_tb order by report_id desc"; 
                        $search_pendingApps = filterTable2($sql);
                        function filterTable2($sql){  
                            $con=mysqli_connect('localhost','root','','robles_db');
                            $filter_pendingApp = mysqli_query($con, $sql);
                             return $filter_pendingApp; 
                            }
                        $sr = 0; 
                        while($row = mysqli_fetch_array($search_pendingApps)): 
                            echo "<tr>";   
                        ?>  
                                    <td class="td_block"><?php echo $row['report_id']; ?></td>
                                    <td class="td_block" style="text-transform:capitalize;"><?php echo $row['name']; ?></td>
                                    <td class="td_block" style="text-transform:capitalize;"><?php echo $row['service']; ?></td>
                                    <td class="td_block" style="text-transform:capitalize;"><?php echo $row['doctor']; ?></td>
                                    <td class="td_block" style="text-transform:capitalize;"><?php echo $row['mw1']." & ".$row['mw2']; ?></td>  
                                    <td class="td_block"><?php echo $row['date']; ?></td>                
                        <?php
                            echo "</tr>";
                        $sr++; endwhile;  ?> <!--End of Php -->

                        </table>

                        <!--No data verifyer-->
                        <div id="no_dataVerifyer2">
                             <img src="images/icons/dashboard/no_data_found.png" alt="">
                             NO DATA FOUND
                        </div>
                    </div>
                </div>

                <!------------------------------------------------------------------------------------------------------>

                <!------------------------------------------------------------------------------------------------>

 
                <div class="table_appointment" id="table_archive_appointment">
                    <table id="table_header" class="table_header_pending_appointment">
                        <thead>
                            <tr> 
                                <th>Patient Name</th>
                                <th>Address</th>
                                <th>Email Address</th>
                                <th>Phone Number</th>
                                <th>Appointment Date</th>    
                                <th>Appointment Time</th>                                 
                            </tr>
                        </thead>
                    </table>

                    <div id="table_content">
                        <table id="table_Archive">
                        <thead>
                            <tr> 
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>                                     
                            </tr>
                        </thead>

                        <?php  //php for displaying all items
                        $sql = "SELECT * FROM acceptedappointment_tb where archive='on'"; 
                        $search_pendingApp = filterTableArchive($sql);
                        function filterTableArchive($sql){  
                            $con=mysqli_connect('localhost','root','','robles_db');
                            $filter_pendingApp = mysqli_query($con, $sql);
                             return $filter_pendingApp; 
                            }
                        $sr = 0; 
                        while($row = mysqli_fetch_array($search_pendingApp)): 
                            echo "<tr>";   
                        ?>  
                                    <td style="text-transform:capitalize;" class="td_block td_block<?php echo $sr; ?>"><?php echo $row['fname']." ".$row['lname']; ?></td>
                                    <td class="td_block td_block<?php echo $sr; ?>"><?php echo $row['address']; ?></td>
                                    <td class="td_block td_block<?php echo $sr; ?>"><?php echo $row['email']; ?></td>
                                    <td class="td_block td_block<?php echo $sr; ?>"><?php echo $row['contact']; ?></td>
                                    <td class="td_block td_block<?php echo $sr; ?>"><?php echo $row['date']; ?></td>     
                                    <td class="td_block td_block<?php echo $sr; ?>"><?php echo $row['time']; ?></td>              
                        <?php
                            echo "</tr>";
                        $sr++; endwhile;  ?> <!--End of Php -->

                        </table>

                        <!--No data verifyer-->
                         <div id="no_dataVerifyer3">
                             <img src="images/icons/dashboard/no_data_found.png" alt="">
                             NO DATA FOUND
                        </div>
                    </div>

                </div><!-- End of Table Pending appointment -->

                <!------------------------------------------------------------------------------------------------------>

            </div><!-- End of dashboard_content -->

    </div><!-- right_content_dashboard -->

</div> <!-- End of for_desktop div -->



<!--- Reject appointment Reason -->
<div id="reject_container">
    <div id="reject_content">

        <div id="close">
            <img src="images/close_hamburger.png" title="Close" onclick="close_reject_pendtingApp_tb()">
        </div>

        <div id="header_text">
            <div id="left">
                <p>To : <b id="reason_name"></b></p>
                <p id="reason_email"></p>
                <p id="reason_contact"></p>
            </div>

            <div id="right">
                <p id="reason_date"></p>
                <p id="reason_time"></p>
            </div>
        </div><!--End of header_text -->
        
        <form action="javascript:void(0)" method="post" id="ajax-form_admin_rejectAppoint">
            <center>
            <textarea id="reasons_reject" placeholder="State your reason of rejection here...." name="reasons_reject" onkeyup="remove_reasonVal()"></textarea>
            </center>

            <div id="reason_validation">
                <img src="images/icons/error_input.png" alt="">
                You must input a reason to reject an appointment!
            </div>

            <input type="hidden" id="reason_date_inp" name="date_inp">
            <input type="hidden" id="reason_time_inp" name="time_inp">
            <input type="hidden" id="reason_email_inp" name="email_inp">
            <input type="hidden" id="reason_name_inp" name="name_inp">
            <input type="hidden" id="reason_id_inp" name="id_inp">

            <div id="bottom">
                <button id="cancel" onclick="close_reject_pendtingApp_tb()" type="button">Cancel</button>
                <button id="send" type="submit" onclick="accept_reject_pendtingApp_tb()">Send</button>
            </div>
        </form>

    </div>
</div><!--End of Reject Container-->

<!--Accept Container-->
<div id="accept_container">

    <div id="accept_content">
    <form action="javascript:void(0)" method="post" id="ajax-form_admin_acceptAppoint">
        <p>Do you want to confirm this appointment?</p> 
            <input type="hidden" id="accept_fname" name="accept_fname">
            <input type="hidden" id="accept_mname" name="accept_mname">
            <input type="hidden" id="accept_lname" name="accept_lname">
            <input type="hidden" id="accept_address" name="accept_address">
            <input type="hidden" id="accept_email" name="accept_email">
            <input type="hidden" id="accept_phone" name="accept_phone">
            <input type="hidden" id="accept_date" name="accept_date">
            <input type="hidden" id="accept_time" name="accept_time">
            <input type="hidden" id="accept_id" name="accept_id">
            <input type="hidden" id="accept_service" name="accept_service">

            <div id="accept_bot">
            <button id="accept_no" onclick="close_accept_pendtingApp_tb()" type="button">No</button>
            <button id="accept_yes" type="submit" onclick="close_accept_pendtingApp_tb()">Yes</button>
        </div>

        </form>

    </div><!--End of accept Content-->

</div><!--End of Accept Container-->


<!--Remove appointment Container-->
<div id="remove_container">
    <div id="remove_content">
    <form action="javascript:void(0)" method="post" id="ajax-form_admin_RemoveAppoint">
        <p>Are you sure you want to move this appointment to archive?</p> 
            <input type="hidden" id="key_removeApp" name="key_removeApp">
            <div id="accept_bot">
            <button id="accept_no" onclick="closeRemoveApp_modal()" type="button">No</button>
            <button id="accept_yes" type="submit">Yes</button>
        </div>
        </form>
    </div><!--End of accept Content-->
</div><!--End of Accept Container-->


<div id="loading_succes">
        <div id="cont">
             <p>The information is processing....</p>
             <img src="images/gif/loading.gif" alt="">
        </div>
</div>

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



<!--For printing file ------------------------------------------------------->
<div id="heigtlimiter">
    <table id="table_patientInfo_topPrint" class="print_accepted_file">
        <thead>
            <tr> 
                <th>Name&nbsp;&nbsp;</th>
                <th>Address&nbsp;&nbsp;</th>
                <th>Email&nbsp;&nbsp;</th>
                <th>Contact&nbsp;&nbsp;</th>
                <th>Date&nbsp;&nbsp;</th>    
                <th>Time&nbsp;&nbsp;</th>                           
            </tr>
        </thead>
        <?php  //php for displaying all items
        $sql = "SELECT * FROM acceptedappointment_tb where archive!='on'"; 
        $search_pendingApps = filterTableFileAccept($sql);
        function filterTableFileAccept($sql){  
            $con=mysqli_connect('localhost','root','','robles_db');
            $filter_pendingApp = mysqli_query($con, $sql);
                return $filter_pendingApp; 
            }
        $sr = 0; 
        while($rowPA = mysqli_fetch_array($search_pendingApps)): 
            echo "<tr>";   
        ?>  
                    <td style="text-transform:capitalize;" class="td_block1<?php echo $sr; ?>"><?php echo $rowPA['fname']." ".$rowPA['lname']; ?></td>
                    <td class="td_block1<?php echo $sr; ?>"><?php echo $rowPA['address']; ?>&nbsp;&nbsp;</td>
                    <td class="td_block1<?php echo $sr; ?>"><?php echo $rowPA['email']; ?>&nbsp;&nbsp;</td>
                    <td class="td_block1<?php echo $sr; ?>"><?php echo $rowPA['contact']; ?>&nbsp;&nbsp;</td>
                    <td class="td_block1<?php echo $sr; ?>"><?php echo $rowPA['date']; ?>&nbsp;&nbsp;</td>     
                    <td class="td_block1<?php echo $sr; ?>"><?php echo $rowPA['time']; ?>&nbsp;&nbsp;</td>                
        <?php
            echo "</tr>";
        $sr++; endwhile;  ?> <!--End of Php -->
    </table>
</div>


<div id="heigtlimiter">
    <table id="table_patientInfo_topPrint" class="print_pending_file">
        <thead>
            <tr> 
                <th>Name&nbsp;&nbsp;</th>
                <th>Address&nbsp;&nbsp;</th>
                <th>Email&nbsp;&nbsp;</th>
                <th>Contact&nbsp;&nbsp;</th>
                <th>Date&nbsp;&nbsp;</th>    
                <th>Time&nbsp;&nbsp;</th>                           
            </tr>
        </thead>
            <?php  //php for displaying all items
            $sql = "SELECT * FROM pendingappointment_tb"; 
            $search_pendingApp = filterTableFilePending($sql);
            function filterTableFilePending($sql){  
                $con=mysqli_connect('localhost','root','','robles_db');
                $filter_pendingApp = mysqli_query($con, $sql);
                    return $filter_pendingApp; 
                }
                        $sr = 0; 
            while($rowPP = mysqli_fetch_array($search_pendingApp)): 
                echo "<tr>";   
            ?>  
                    <td style="text-transform:capitalize;" class="td_block td_block<?php echo $sr; ?>"><?php echo $rowPP['fname']." ".$rowPP['lname']; ?>&nbsp;&nbsp;</td>
                    <td class="td_block td_block<?php echo $sr; ?>"><?php echo $rowPP['address']; ?>&nbsp;&nbsp;</td>
                    <td class="td_block td_block<?php echo $sr; ?>"><?php echo $rowPP['email']; ?>&nbsp;&nbsp;</td>
                    <td class="td_block td_block<?php echo $sr; ?>"><?php echo $rowPP['contact']; ?>&nbsp;&nbsp;</td>
                    <td class="td_block td_block<?php echo $sr; ?>"><?php echo $rowPP['date']; ?>&nbsp;&nbsp;</td>     
                    <td class="td_block td_block<?php echo $sr; ?>"><?php echo $rowPP['time']; ?>&nbsp;&nbsp;</td>               
            <?php
                echo "</tr>";
            $sr++; endwhile;  ?> <!--End of Php -->
    </table>
</div>

<div id="heigtlimiter">
    <table id="table_patientInfo_topPrint" class="print_history_file">
        <thead>
            <tr> 
                <th>Appointment #&nbsp;&nbsp;</th>
                <th>Patient Name&nbsp;&nbsp;</th>
                <th>Doctors Duty&nbsp;&nbsp;</th>
                <th>Midwifes Duty&nbsp;&nbsp;</th>
                <th>Date&nbsp;&nbsp;</th>                                      
            </tr>
        </thead>
            <?php  //php for displaying all items
            $sql = "SELECT * FROM doctorreport_tb order by report_id desc"; 
            $search_pendingApps = filterTableFileHist($sql);
            function filterTableFileHist($sql){  
                $con=mysqli_connect('localhost','root','','robles_db');
                $filter_pendingApp = mysqli_query($con, $sql);
                    return $filter_pendingApp; 
                }
            $sr = 0; 
            while($rowPH = mysqli_fetch_array($search_pendingApps)): 
                echo "<tr>";   
            ?>  
                <td class="td_block"><?php echo $rowPH['report_id']; ?>&nbsp;&nbsp;</td>
                <td class="td_block" style="text-transform:capitalize;"><?php echo $rowPH['name']; ?>&nbsp;&nbsp;</td>
                <td class="td_block" style="text-transform:capitalize;"><?php echo $rowPH['doctor']; ?>&nbsp;&nbsp;</td>
                <td class="td_block" style="text-transform:capitalize;"><?php echo $rowPH['mw1']." & ".$rowPH['mw2']; ?>&nbsp;&nbsp;</td>  
                <td class="td_block"><?php echo $rowPH['date']; ?>&nbsp;&nbsp;</td>                
            <?php
                echo "</tr>";
            $sr++; endwhile;  ?> <!--End of Php -->
    </table>
</div>

<div id="heigtlimiter">
    <table id="table_patientInfo_topPrint" class="print_archive_file">
        <thead>
            <tr> 
                <th>Patient Name&nbsp;&nbsp;</th>
                <th>Address&nbsp;&nbsp;</th>
                <th>Email Address&nbsp;&nbsp;</th>
                <th>Phone Number&nbsp;&nbsp;</th>
                <th>Appointment Date&nbsp;&nbsp;</th>    
                <th>Appointment Time&nbsp;&nbsp;</th>                                     
            </tr>
        </thead>
        <?php  //php for displaying all items
        $sql = "SELECT * FROM acceptedappointment_tb where archive='on'"; 
        $search_pendingApp = filterTableFileArchive($sql);
        function filterTableFileArchive($sql){  
            $con=mysqli_connect('localhost','root','','robles_db');
            $filter_pendingApp = mysqli_query($con, $sql);
                return $filter_pendingApp; 
            }
        $sr = 0; 
        while($row = mysqli_fetch_array($search_pendingApp)): 
            echo "<tr>";   
        ?>  
                <td style="text-transform:capitalize;" class="td_block td_block<?php echo $sr; ?>"><?php echo $row['fname']." ".$row['lname']; ?></td>
                <td class="td_block td_block<?php echo $sr; ?>"><?php echo $row['address']; ?>&nbsp;&nbsp;</td>
                <td class="td_block td_block<?php echo $sr; ?>"><?php echo $row['email']; ?>&nbsp;&nbsp;</td>
                <td class="td_block td_block<?php echo $sr; ?>"><?php echo $row['contact']; ?>&nbsp;&nbsp;</td>
                <td class="td_block td_block<?php echo $sr; ?>"><?php echo $row['date']; ?>&nbsp;&nbsp;</td>     
                <td class="td_block td_block<?php echo $sr; ?>"><?php echo $row['time']; ?>&nbsp;&nbsp;</td>              
        <?php
            echo "</tr>";
        $sr++; endwhile;  ?> <!--End of Php -->
    </table>
</div>
<!--------------------------------------------------------------------------->

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

<!-- Script for pdf -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

<!--ajax for logut-->
<script src="ajax/logoutAdmin.js"></script>
<!-- Ajax for making appointment -->
<script src="ajax/appointment.js"></script>
<!-- Ajax for making appointment -->
<script src="ajax/adminAppointmentTable.js"></script>


<script>
document.querySelector('.downloadxlsx_Accepted').addEventListener('click', function(){
    var table2excel = new Table2Excel();
    table2excel.export(document.querySelectorAll(".print_accepted_file"));
});
document.querySelector('.export_pdf_Accept').addEventListener("click", () => {
    const invoice = document.getElementsByClassName("print_accepted_file")[0];
            var opt = {
                margin: 1,
                filename: 'AppointmentList.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'landscape'}
            };
            html2pdf().from(invoice).set(opt).save();
})
document.querySelector('.downloadxlsx_Pending').addEventListener('click', function(){
    var table2excel = new Table2Excel();
    table2excel.export(document.querySelectorAll(".print_pending_file"));
});
document.querySelector('.export_pdf_Pending').addEventListener("click", () => {
    const invoice = document.getElementsByClassName("print_pending_file")[0];
            var opt = {
                margin: 1,
                filename: 'PendingAppointment.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'landscape'}
            };
            html2pdf().from(invoice).set(opt).save();
})
document.querySelector('.downloadxlsx_history').addEventListener('click', function(){
    var table2excel = new Table2Excel();
    table2excel.export(document.querySelectorAll(".print_history_file"));
});
document.querySelector('.export_pdf_History').addEventListener("click", () => {
    const invoice = document.getElementsByClassName("print_history_file")[0];
            var opt = {
                margin: 1,
                filename: 'AppointmentHistory.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'landscape'}
            };
            html2pdf().from(invoice).set(opt).save();
})
document.querySelector('.downloadxlsx_archive').addEventListener('click', function(){
    var table2excel = new Table2Excel();
    table2excel.export(document.querySelectorAll(".print_archive_file"));
});
document.querySelector('.export_pdf_Archive').addEventListener("click", () => {
    const invoice = document.getElementsByClassName("print_archive_file")[0];
            var opt = {
                margin: 1,
                filename: 'AppointmentArchive.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'landscape'}
            };
            html2pdf().from(invoice).set(opt).save();
})

function accept_reject_pendtingApp_tb(){
    var question = $("textarea#reasons_reject").val();
    
    if( question == "Upon reviewing your scheduled appointment were sorry to inform you that your appointment has been rejected due to" ){
        
    }
    else if (question !== ""){
          document.getElementById("reject_container").style.display = "none";
    }
}
</script>



