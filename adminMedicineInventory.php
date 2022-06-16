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
     <link rel="stylesheet" href="css/Desktop/Admin-adminMedicineInventory.css">
  
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

<div id="reloading_activeMed" style="display:none;">
    <?php
    $s = 0;
    date_default_timezone_set('Asia/Manila');
    $date2 = new DateTime('now');
    $date2->modify('+5 month'); // or you can use '-90 day' for deduct
    $effectiveDate2 = $date2->format('Y-m-d');

    $sql_top = "SELECT * FROM medicine_tb ORDER BY name DESC"; 
    $search_pendingApp_top = filterTable_top($sql_top);
    function filterTable_top($sql_top){  
        $con_top=mysqli_connect('localhost','root','','robles_db');
        $filter_pendingApp_top = mysqli_query($con_top, $sql_top);
        return $filter_pendingApp_top; 
    }
    $sr_top = 0; 
    while($row_top = mysqli_fetch_array($search_pendingApp_top)):;
    $rowStat = $row_top['status'];
    $test = $row_top['name'];
    $sqli = "UPDATE `medicine_tb` SET main_stat='deactivated' WHERE !FIND_IN_SET('activated','$rowStat') and name='$test'";
    $results=mysqli_query($conn, $sqli);

    $sqli1 = "UPDATE `medicine_tb` SET main_stat='activated' WHERE !FIND_IN_SET('deactivated','$rowStat') and name='$test'";
    $results1=mysqli_query($conn, $sqli1);

    $strSubname = $row_top['subname'];
    $strSubstock = $row_top['substock'];
    $strSubcategory = $row_top['category'];
    $strSubexpdate = $row_top['expiration_date'];
    $strSubmfgdate = $row_top['mfg_date'];
    $strSubbrand = $row_top['type'];
    $strSubStat = $row_top['status'];
    $strSubEditDelete = $row_top['edit_delete'];

    $arraySubname = explode(',', $strSubname );
    $arraySubstock = explode(',', $strSubstock );
    $arrayCategory = explode(',', $strSubcategory );
    $arrayExpdate = explode(',', $strSubexpdate );
    $arrayMfgdate = explode(',', $strSubmfgdate );
    $arrayBrand = explode(',', $strSubbrand );
    $arrayStat = explode(',', $strSubStat );
    $arrayEditDelete = explode(',', $strSubEditDelete);

    for($x = 0 ; $x<count($arraySubname); $x++){
        if($arrayStat[$x] == "activated"){
           $dates = date('Y-m-d');
           $earlier = new DateTime($dates);
           $later = new DateTime($arrayExpdate[$x]);     
           if($earlier>$later){
                unset($arrayEditDelete[$x]);
                unset($arraySubname[$x]);
                unset($arrayCategory[$x]);
                unset($arrayBrand[$x]);
                unset($arraySubstock[$x]);
                unset($arrayMfgdate[$x]);
                unset($arrayExpdate[$x]);
                unset($arrayStat[$x]);

                $convertedEditDelete = implode(",",$arrayEditDelete);    
                $convertedSubname = implode(",",$arraySubname);  
                $convertedCategory = implode(",",$arrayCategory);  
                $convertedBrand = implode(",",$arrayBrand); 
                $convertedStock= implode(",",$arraySubstock); 
                $convertedMFG= implode(",",$arrayMfgdate); 
                $convertedEXP= implode(",",$arrayExpdate); 
                $convertedStat= implode(",",$arrayStat); 
                
                mysqli_query($conn, "UPDATE `medicine_tb` SET edit_delete ='$convertedEditDelete', subname ='$convertedSubname',category ='$convertedCategory',type='$convertedBrand',substock='$convertedStock', mfg_date='$convertedMFG', expiration_date='$convertedEXP', status='$convertedStat'");
   
           }
        }
    }

    $sr_top++; endwhile; 
    ?>
</div>

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
                        <div id="icons_container" class="inventory_navbar" style="background-color: #5B8DFF;"><img src="images/icons/dashboard/inventory.png" title="Inventory"></div>
                        <div id="icons_container" class="appointment_navbar" onmouseover="hover_navbar('appointment_navbar')" onmouseout="mouseout_navbar('appointment_navbar')" ><img src="images/icons/dashboard/appointment.png" title="Appointment"></div>
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
                        <div id="icons_container" class="inventory_navbar" style="background-color: #5B8DFF;">Inventory</div>
                        <div id="icons_container" class="appointment_navbar"  onmouseover="hover_navbar('appointment_navbar')" onmouseout="mouseout_navbar('appointment_navbar')" >Appointment</div>
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
                <div id="dash_left">Medicine Inventory</div>
                <div id="dash_right">
                    <div id="notification_container">
                        <img src="images/icons/dashboard/notification.png" title="Notification" id="notif_img">
                        <div id="notif_count"><?php echo $notifCount1+$notifCount2; ?></div>
                    </div><!-- End of notification container -->

                    <?php  //php for displaying the hover icon 
                        $row_active = mysqli_fetch_array($search_resulthover);   
                        $_SESSION["auditname"] = $row_active['username']
                    ?>
                    <div id="profile_container" title="Visit Profile" onclick="profile()">
                        <img src="upload_img/<?php echo $row_active['profile_photo']; ?>" id="profile_img" onerror="this.src='upload_img/account.png'">
                        <div id="name_profile">
                            <p id="name_text"><?php echo $row_active['fname']; ?></p>
                            <p id="role_text"><?php echo $row_active['role']; ?> Account</p>
                        </div>
                    </div><!-- End of profile container -->
                </div>
            </div><!-- End of dashboard top -->

            <div id="dashboard_content">

            <?php
                require_once "Z-connection.php";       
                $date1 = new DateTime('now');
                $effectiveDate1 = $date1->format('Y-m-d');

                $date = new DateTime('now');
                $date->modify('+5 month'); // or you can use '-90 day' for deduct
                $effectiveDate = $date->format('Y-m-d');

                $sql = "SELECT * FROM medicine_tb" ; 
                $search_pendingApp_total = filterTableTotal_count($sql);
                function filterTableTotal_count($sql){                 
                    $con=mysqli_connect('localhost','root','','robles_db');
                    $filter_pendingApp = mysqli_query($con, $sql);
                    return $filter_pendingApp; 
                }
                $sr = 0; 
                
                $total = 0;
                $total_deact = 0;
                $total_stock = 0;
                $total_exp = 0;
                while($rowss = mysqli_fetch_array($search_pendingApp_total)){
                    $strSubStat = $rowss['status'];
                    $strSubExp = $rowss['expiration_date'];
                    $strSubStock = $rowss['substock'];
                    $strSubcr = $rowss['critStock'];
                    $arrayStat = explode(',', $strSubStat );
                    $arrayExpdate = explode(',', $strSubExp );
                    $arraySubstock = explode(',', $strSubStock );
                    $arraycr = explode(',', $strSubcr);

                    for($z = 0 ; $z<count($arrayStat); $z++){
                        if($arrayStat[$z] == "activated" && $effectiveDate1 != $arrayExpdate[$z]){
                            $total++;
                        }
                        if($arrayStat[$z] == "deactivated"){
                            $total_deact++;
                        }
                        if($arrayStat[$z] == "activated" && $arraySubstock[$z] <= $arraycr[$z]){
                            $total_stock++;
                        }
                        if($arrayStat[$z] == "activated" && $arrayExpdate[$z] <= $effectiveDate ){
                            $total_exp++;
                        }
                    }
                $sr++; }
            ?>

                <div id="top_dashboard_content">
                        <div id="left_top_dashboard_content">
                            <div class="appointment_choices" style="box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px; background-color: rgb(248, 248, 248);" id="act_medDiv" onclick="go_ActiveMed()">
                                <img src="images/icons/dashboard/active_medicine.png" alt="">
                                Active&nbsp;<span id="activeMed_Count_span">(<?php echo $total; ?>)</span>
                            </div>

                            <div class="appointment_choices" id="deact_medDiv" onclick="go_DeactiveMed()">
                                <img src="images/icons/dashboard/notactive_medicine.png" alt="">
                                Not Active&nbsp;<span id="deactiveMed_Count_span">(<?php echo $total_deact; ?>)</span>
                            </div>

                            <div class="appointment_choices" id="crit_medDiv" onclick="go_CritStocKsMed()">
                                <img src="images/icons/dashboard/critical_stocks.png" alt="">
                                Critical Stocks&nbsp;<span id="critMed_Count_span">(<?php echo $total_stock; ?>)</span>
                            </div>

                            <div class="appointment_choices" id="exp_medDiv" onclick="go_expirationDate()">
                                <img src="images/icons/dashboard/expiration_stock.png" alt="">
                                Expiration Report&nbsp;<span id="expDate_Count_span">(<?php echo $total_exp; ?>)</span>
                            </div>

                            <div class="appointment_choices" id="hist_medDiv" onclick="go_presHist()">
                                <img src="images/icons/dashboard/medExp.png" alt="">
                                Presc. History
                            </div>
                        </div>
                </div><!-- End of top_dashboard_content -->

                <div id="input_container">
                            <div id="left">
                                <div id="search_inp">
                                    <img src="images/icons/search_gif.gif">
                                    <input type="text" placeholder="Search here....." id="search_medInfo">
                                </div>

                                <div id="excel_btn" title="Export as .xlsx" class="export_active_excel">
                                    <img src="images/icons/dashboard/sheets.png">
                                </div>

                                <div id="excel_btn" title="Export as .pdf" class="export_active_pdf">
                                    <img src="images/icons/dashboard/pdf_icon.png">
                                </div>

                                <div id="excel_btn" title="Export as .xlsx" class="export_inactive_excel" style="display:none;">
                                    <img src="images/icons/dashboard/sheets.png">
                                </div>

                                <div id="excel_btn" title="Export as .pdf" class="export_inactive_pdf" style="display:none;">
                                    <img src="images/icons/dashboard/pdf_icon.png">
                                </div>

                                <div id="excel_btn" title="Export as .xlsx" class="export_critical_excel" style="display:none;">
                                    <img src="images/icons/dashboard/sheets.png">
                                </div>

                                <div id="excel_btn" title="Export as .pdf" class="export_critical_pdf" style="display:none;">
                                    <img src="images/icons/dashboard/pdf_icon.png">
                                </div>

                                <div id="excel_btn" title="Export as .xlsx" class="export_exp_excel" style="display:none;">
                                    <img src="images/icons/dashboard/sheets.png">
                                </div>

                                <div id="excel_btn" title="Export as .pdf" class="export_exp_pdf" style="display:none;">
                                    <img src="images/icons/dashboard/pdf_icon.png">
                                </div>

                                <div id="excel_btn" title="Export as .xlsx" class="export_history_excel" style="display:none;">
                                    <img src="images/icons/dashboard/sheets.png">
                                </div>

                                <div id="excel_btn" title="Export history as .pdf" class="export_history_pdf" style="display:none;">
                                    <img src="images/icons/dashboard/pdf_icon.png">
                                </div>

                            </div><!-- End of left -->
                            <div id="add_medicine_btn" onclick="show_addmed()">
                                <img src="images/icons/dashboard/add_icon.png">
                                Add Medicine
                            </div>
                </div><!-- End of input container -->

                <div id="medicine_content">
                    <div id="medicine_header">
                        <img src="images/icons/dashboard/medicine1.png">
                        Medicine Information
                    </div>

                    <table id="table_header" class="table_header_medicine">
                        <thead>
                            <tr> 
                                <th style="width:5%;" class="th1"></th>
                                <th style="width:15%; text-align:left;" class="th2">Medicine Name</th>
                                <th style="width:15%;" class="th3">Medicine ID</th>
                                <th style="width:15%;" id="edit_stocks_daysleft" class="th4">Stocks</th>
                                <th style="width:15%;" class="th5">Category</th>
                                <th style="width:15%;" class="th6">Epiration Date<th>   
                                <th style="width:20%;" class="th7">Actions</th>                                                           
                            </tr>
                        </thead>
                    </table>    
         
      <!---------Active medicine ------------------------------------>
      <div id="med_cont_tb" class="med_cont_tb">
                    <table class="table_med_search" id="table_active_med">
                        <?php  //php for displaying all items
                                date_default_timezone_set('Asia/Manila');
                                $date = new DateTime('now');
                                $effectiveDate1 = $date->format('Y-m-d');
                                $sql = "SELECT * FROM medicine_tb ORDER BY name DESC " ; 
                                $search_pendingApp = filterTable($sql);
                                function filterTable($sql){  
                                    $con=mysqli_connect('localhost','root','','robles_db'); 
                                    $filter_pendingApp = mysqli_query($con, $sql);
                                    return $filter_pendingApp; 
                                }
                                $sr = 0; 
                                while($row = mysqli_fetch_array($search_pendingApp)):

                                    $strSubname = $row['subname'];
                                    $strSubstock = $row['substock'];
                                    $strSubcategory = $row['category'];
                                    $strSubexpdate = $row['expiration_date'];
                                    $strSubmfgdate = $row['mfg_date'];
                                    $strSubbrand = $row['type'];
                                    $strSubStat = $row['status'];
                                    $strSubEditDelete = $row['edit_delete'];
                                    $strSubCritStock = $row['critStock'];

                                    $arraySubname = explode(',', $strSubname );
                                    $arraySubstock = explode(',', $strSubstock );
                                    $arrayCategory = explode(',', $strSubcategory );
                                    $arrayExpdate = explode(',', $strSubexpdate );
                                    $arrayMfgdate = explode(',', $strSubmfgdate );
                                    $arrayBrand = explode(',', $strSubbrand );
                                    $arrayStat = explode(',', $strSubStat );
                                    $arrayEditDelete = explode(',', $strSubEditDelete);
                                    $arrayCritStocks = explode(',', $strSubCritStock);

                                    $totalStock = 0;
                                    for($z = 0 ; $z<count($arraySubname); $z++){
                                        if($arrayStat[$z] == "activated" && $effectiveDate1 != $arrayExpdate[$z]){
                                        $totalStock+=$arraySubstock[$z];
                                        }
                                    }
                                    if($totalStock!== 0){
                                    echo "<tr style='background:#e4f5fc;'>";   
                        ?>  
                                <td style="width:5%;">
                                    <center>
                                    <img src="images/icons/dashboard/dropright.png" id="dropright<?php echo $sr; ?>" class="dropright" title="See more" onclick="seeMoremed_Act(<?php echo $sr; ?>)">
                                    <img src="images/icons/dashboard/dropdown.png" id="dropdown<?php echo $sr; ?>" class="dropdown" title="See less" onclick="seeLessmed_Act(<?php echo $sr; ?>)">
                                    </center>
                                </td>
                                <td style="width:15%; text-align:left;" class="td_none<?php echo $sr; ?> td_none"><?php echo $row['name']; ?></td>
                                <td style="width:15%;" class="td_none<?php echo $sr; ?> td_none"><?php echo $row['main_id']; ?></td>
                                <td style="width:15%; text-transform:lowercase;" class="td_none<?php echo $sr; ?> td_none"><?php echo $totalStock; ?> pcs</td>
                                <td style="width:15%;" class="td_none<?php echo $sr; ?> td_none"></td>
                                <td style="width:15%;" class="td_none<?php echo $sr; ?> td_none"></td>    
                                <td style="width:20%;" class="td_none<?php echo $sr; ?> td_none"></td>           
                        <?php
                                    echo "</tr>";
                                }
                             for($x = 0 ; $x<count($arraySubname); $x++){
                                 if($arrayStat[$x] == "activated" && $arraySubstock[$x] != "0"  && $effectiveDate1 != $arrayExpdate[$x]){
                        ?>
                        
                            <tr id="sub_tr<?php echo $sr; ?>" class="sub_tr">
                                <td style="width:5%;" id="dropdown"></td>
                                <td style="width:15%; text-align:left;" class="td_none<?php echo $sr; ?> td_none"><?php echo $arraySubname[$x] ; ?></td>
                                <td style="width:15%;" class="td_none<?php echo $sr; ?> td_none"><?php echo $row['main_id'].".".$x+1; ?></td>
                                <td style="width:15%; text-transform:lowercase;" class="td_none<?php echo $sr; ?> td_none"><?php echo $arraySubstock[$x]; ?> pcs</td>
                                <td style="width:15%;" class="td_none<?php echo $sr; ?> td_none"><?php echo $arrayCategory[$x]; ?></td>
                                <td style="width:15%;" class="td_none<?php echo $sr; ?> td_none"><?php echo $arrayExpdate[$x]; ?></td>
                                <td style="width:20%;" class="td_none<?php echo $sr; ?> td_none" id="td_str">     
                                     <div> 
                                     <button class="button_subtstr" style="background:#fece00;" title="Prescribe" onclick="prescribeMed('<?php echo $row['name']; ?>','<?php echo $arrayEditDelete[$x]; ?>','<?php echo $arraySubname[$x] ; ?>','<?php echo $arraySubstock[$x]; ?>','<?php echo $row['description']; ?>','<?php echo $arrayCategory[$x]; ?>')">
                                        <img src="images/icons/dashboard/prescribe.png">
                                     </button>

                                     <button class="button_subtstr" style="background:#4C5861;" title="View" onclick="viewMed('<?php echo $row['main_id'].'.'.$x+1; ?>', '<?php echo $arraySubname[$x] ; ?>', '<?php echo $arrayCategory[$x]; ?>', '<?php echo $arrayBrand[$x]; ?>', '<?php echo $row['description']; ?>','<?php echo $arrayMfgdate[$x]; ?>', '<?php echo $arrayExpdate[$x]; ?>', '<?php echo $arraySubstock[$x]; ?>')">
                                        <img src="images/icons/dashboard/view_icon.png">
                                     </button>   

                                     <button class="button_subtstr" style="background:#5FB1F2;" title="Edit" onclick="editMedicine('<?php echo $row['id']; ?>','<?php echo $arrayEditDelete[$x]; ?>', '<?php echo $row['name']; ?>', '<?php echo $arrayBrand[$x]; ?>', '<?php echo $arrayCategory[$x]; ?>', '<?php echo $arraySubstock[$x]; ?>', '<?php echo $row['description']; ?>','<?php echo $arrayMfgdate[$x]; ?>', '<?php echo $arrayExpdate[$x]; ?>' ,'<?php echo $arraySubname[$x] ; ?>', '<?php echo $arrayCritStocks[$x]; ?>')">
                                        <img src="images/icons/dashboard/edit_icon.png">
                                     </button>

                                     <button class="button_subtstr" style="background:#F25F5F;" title="Deactivate" onclick="deactMedicine('<?php echo $arrayEditDelete[$x]; ?>', '<?php echo $row['name']; ?>')">
                                        <img src="images/icons/close_white.png">
                                     </button> 
                                     </div>   
                                </td>  
                            </tr>
                        <?php
                        }
                        }  
                        $sr++; endwhile;  ?> <!--End of Php -->
                    </table>
                    </div>
          
                    <!--------------------------------------------------------------------->
                    

                    <!--------Deactivate medicine------------------------------------------>
                    <div id="deactmed_cont_tb" class="med_cont_tb">
                    <table class="table_med_search" id="table_deactive_med">
                        <?php  //php for displaying all items
                                $sql_deact = "SELECT * FROM medicine_tb ORDER BY name DESC " ; 
                                $search_pendingApp_deact = filterTable_deact($sql_deact);
                                function filterTable_deact($sql_deact){  
                                    $con_deact=mysqli_connect('localhost','root','','robles_db');
                                    $filter_pendingApp = mysqli_query($con_deact, $sql_deact);
                                    return $filter_pendingApp; 
                                }
                                $sr = 0; 
                                while($row = mysqli_fetch_array($search_pendingApp_deact)):

                                    $strSubname = $row['subname'];
                                    $strSubstock = $row['substock'];
                                    $strSubcategory = $row['category'];
                                    $strSubexpdate = $row['expiration_date'];
                                    $strSubmfgdate = $row['mfg_date'];
                                    $strSubbrand = $row['type'];
                                    $strSubStat = $row['status'];
                                    $strSubEditDelete = $row['edit_delete'];

                                    $arraySubname = explode(',', $strSubname );
                                    $arraySubstock = explode(',', $strSubstock );
                                    $arrayCategory = explode(',', $strSubcategory );
                                    $arrayExpdate = explode(',', $strSubexpdate );
                                    $arrayMfgdate = explode(',', $strSubmfgdate );
                                    $arrayBrand = explode(',', $strSubbrand );
                                    $arrayStat = explode(',', $strSubStat );
                                    $arrayEditDelete = explode(',', $strSubEditDelete);

                                    $totalStock1 = 0;
                                    for($z = 0 ; $z<count($arraySubname); $z++){
                                        if($arrayStat[$z] == "deactivated"){
                                        $totalStock1+=$arraySubstock[$z];
                                        }
                                    }
                                    if($totalStock1!== 0){
                                    echo "<tr style='background:#e4f5fc;'>";   
                        ?>  
                                <td style="width:5%;">
                                    <center>
                                    <img src="images/icons/dashboard/dropright.png" id="dropright<?php echo $sr; ?>" class="dropright" title="See more" onclick="seeMoremed_Act(<?php echo $sr; ?>)">
                                    <img src="images/icons/dashboard/dropdown.png" id="dropdown<?php echo $sr; ?>" class="dropdown" title="See less" onclick="seeLessmed_Act(<?php echo $sr; ?>)">
                                    </center>
                                </td>
                                <td style="width:15%; text-align:left;" class="td_none<?php echo $sr; ?> td_none"><?php echo $row['name']; ?></td>
                                <td style="width:15%;" class="td_none<?php echo $sr; ?> td_none"><?php echo $row['main_id']; ?></td>
                                <td style="width:15%; text-transform:lowercase;" class="td_none<?php echo $sr; ?> td_none"><?php echo $totalStock1; ?> pcs</td>
                                <td style="width:15%;" class="td_none<?php echo $sr; ?> td_none"></td>
                                <td style="width:15%;" class="td_none<?php echo $sr; ?> td_none"></td>    
                                <td style="width:20%;" class="td_none<?php echo $sr; ?> td_none"></td>           
                        <?php
                                    echo "</tr>";
                                    }
                             for($x = 0 ; $x<count($arraySubname); $x++){
                                 if($arrayStat[$x] == "deactivated" && $arraySubstock[$x] != "0"){
                        ?>
                        
                            <tr id="sub_tr<?php echo $sr; ?>" class="sub_tr">
                                <td style="width:5%;" id="dropdown"></td>
                                <td style="width:15%; text-align:left;" class="td_none<?php echo $sr; ?> td_none"><?php echo $arraySubname[$x] ; ?></td>
                                <td style="width:15%;" class="td_none<?php echo $sr; ?> td_none"><?php echo $row['main_id'].".".$x+1; ?></td>
                                <td style="width:15%; text-transform:lowercase;" class="td_none<?php echo $sr; ?> td_none"><?php echo $arraySubstock[$x]; ?> pcs</td>
                                <td style="width:15%;" class="td_none<?php echo $sr; ?> td_none"><?php echo $arrayCategory[$x]; ?></td>
                                <td style="width:15%;" class="td_none<?php echo $sr; ?> td_none"><?php echo $arrayExpdate[$x]; ?></td>
                                <td style="width:20%;" class="td_none<?php echo $sr; ?> td_none" id="td_str">     
                                     <div> 

                                     <button class="button_subtstr" style="background:#4C5861;" title="View" onclick="viewMed('<?php echo $row['main_id'].'.'.$x+1; ?>', '<?php echo $arraySubname[$x] ; ?>', '<?php echo $arrayCategory[$x]; ?>', '<?php echo $arrayBrand[$x]; ?>', '<?php echo $row['description']; ?>','<?php echo $arrayMfgdate[$x]; ?>', '<?php echo $arrayExpdate[$x]; ?>', '<?php echo $arraySubstock[$x]; ?>')">
                                        <img src="images/icons/dashboard/view_icon.png">
                                     </button>   

                                     <button class="button_subtstr" style="background:#5FB1F2;" title="Edit" onclick="editMedicine('<?php echo $row['id']; ?>','<?php echo $arrayEditDelete[$x]; ?>', '<?php echo $row['name']; ?>', '<?php echo $arrayBrand[$x]; ?>', '<?php echo $arrayCategory[$x]; ?>', '<?php echo $arraySubstock[$x]; ?>', '<?php echo $row['description']; ?>','<?php echo $arrayMfgdate[$x]; ?>', '<?php echo $arrayExpdate[$x]; ?>' ,'<?php echo $arraySubname[$x] ; ?>')">
                                        <img src="images/icons/dashboard/edit_icon.png">
                                     </button>

                                     <button class="button_subtstr" style="background:green;" title="Activate" onclick="activateMedicine('<?php echo $arrayEditDelete[$x]; ?>', '<?php echo $row['name']; ?>')">
                                        <img src="images/icons/dashboard/check_icon_white.png">
                                     </button> 
                                     </div>   
                                </td>  
                            </tr>
                        <?php
                        }
                        }  
                        $sr++; endwhile;  ?> <!--End of Php -->
                    </table>
                    </div>
                    <!--------------------------------------------------------------------->


                    <!--------Critical Stocks------------------------------------------>
                    <div id="critstockmed_cont_tb" class="med_cont_tb">
                    <table class="table_med_search" id="table_crit_med">
                        <?php  //php for displaying all items
                                $sql_crit = "SELECT * FROM medicine_tb ORDER BY name DESC "; 
                                $search_pendingApp_crit = filterTable_crit($sql_crit);
                                function filterTable_crit($sql_crit){  
                                    $con_crit=mysqli_connect('localhost','root','','robles_db');
                                    $filter_pendingAppCrit = mysqli_query($con_crit, $sql_crit);
                                    return $filter_pendingAppCrit; 
                                }
                                $sr = 0; 
                                while($row = mysqli_fetch_array($search_pendingApp_crit)):

                                    $strSubname = $row['subname'];
                                    $strSubstock = $row['substock'];
                                    $strSubcategory = $row['category'];
                                    $strSubexpdate = $row['expiration_date'];
                                    $strSubmfgdate = $row['mfg_date'];
                                    $strSubbrand = $row['type'];
                                    $strSubStat = $row['status'];
                                    $strSubEditDelete = $row['edit_delete'];
                                    $strCrit= $row['critStock'];

                                    $arraySubname = explode(',', $strSubname );
                                    $arraySubstock = explode(',', $strSubstock );
                                    $arrayCategory = explode(',', $strSubcategory );
                                    $arrayExpdate = explode(',', $strSubexpdate );
                                    $arrayMfgdate = explode(',', $strSubmfgdate );
                                    $arrayBrand = explode(',', $strSubbrand );
                                    $arrayStat = explode(',', $strSubStat );
                                    $arrayEditDelete = explode(',', $strSubEditDelete);
                                    $arrayCrit = explode(',', $strCrit);

                                    $totalStock2 = 0;
                                    for($z = 0 ; $z<count($arraySubname); $z++){
                                        if($arrayStat[$z] == "activated" && $arraySubstock[$z] <=$arrayCrit[$z] ){
                                        $totalStock2+=$arraySubstock[$z];
                                        }
                                    }
                                    if($totalStock2!== 0){
                                    echo "<tr style='background:#e4f5fc;'>";   
                        ?>  
                                <td style="width:5%;">
                                    <center>
                                    <img src="images/icons/dashboard/dropright.png" id="dropright<?php echo $sr; ?>" class="dropright" title="See more" onclick="seeMoremed_Act(<?php echo $sr; ?>)">
                                    <img src="images/icons/dashboard/dropdown.png" id="dropdown<?php echo $sr; ?>" class="dropdown" title="See less" onclick="seeLessmed_Act(<?php echo $sr; ?>)">
                                    </center>
                                </td>
                                <td style="width:15%; text-align:left;" class="td_none<?php echo $sr; ?> td_none"><?php echo $row['name']; ?></td>
                                <td style="width:15%;" class="td_none<?php echo $sr; ?> td_none"><?php echo $row['main_id']; ?></td>
                                <td style="width:15%; text-transform:lowercase;" class="td_none<?php echo $sr; ?> td_none"><?php echo $totalStock2; ?> pcs</td>
                                <td style="width:15%;" class="td_none<?php echo $sr; ?> td_none"></td>
                                <td style="width:15%;" class="td_none<?php echo $sr; ?> td_none"></td>    
                                <td style="width:20%;" class="td_none<?php echo $sr; ?> td_none"></td>           
                        <?php
                                    echo "</tr>";
                                    }
                             for($x = 0 ; $x<count($arraySubname); $x++){
                                 if($arrayStat[$x] == "activated" && $arraySubstock[$x] <= $arrayCrit[$x]){
                        ?>
                        
                            <tr id="sub_tr<?php echo $sr; ?>" class="sub_tr">
                                <td style="width:5%;" id="dropdown"></td>
                                <td style="width:15%; text-align:left; color:red; font-weight:bold;" class="td_none<?php echo $sr; ?> td_none"><?php echo $arraySubname[$x] ; ?></td>
                                <td style="width:15%; color:red; font-weight:bold;" class="td_none<?php echo $sr; ?> td_none"><?php echo $row['main_id'].".".$x+1; ?></td>
                                <td style="width:15%; text-transform:lowercase; color:red; font-weight:bold;" class="td_none<?php echo $sr; ?> td_none"><?php echo $arraySubstock[$x]; ?> pcs</td>
                                <td style="width:15%; color:red; font-weight:bold;" class="td_none<?php echo $sr; ?> td_none"><?php echo $arrayCategory[$x]; ?></td>
                                <td style="width:15%; color:red; font-weight:bold;" class="td_none<?php echo $sr; ?> td_none"><?php echo $arrayExpdate[$x]; ?></td>
                                <td style="width:20%; color:red; font-weight:bold;" class="td_none<?php echo $sr; ?> td_none" id="td_str">     
                                     <div> 
                                     <button class="button_subtstr" style="background:#4C5861;" title="View" onclick="viewMed('<?php echo $row['main_id'].'.'.$x+1; ?>', '<?php echo $arraySubname[$x] ; ?>', '<?php echo $arrayCategory[$x]; ?>', '<?php echo $arrayBrand[$x]; ?>', '<?php echo $row['description']; ?>','<?php echo $arrayMfgdate[$x]; ?>', '<?php echo $arrayExpdate[$x]; ?>', '<?php echo $arraySubstock[$x]; ?>')">
                                        <img src="images/icons/dashboard/view_icon.png">
                                     </button>   

                                     <button class="button_subtstr" style="background:#5FB1F2;" title="Restock" onclick="restockMed('<?php echo $row['name']; ?>', '<?php echo $arraySubname[$x] ; ?>', '<?php echo $arrayBrand[$x]; ?>', '<?php echo $arrayCategory[$x]; ?>', '<?php echo $arrayMfgdate[$x]; ?>', '<?php echo $arrayExpdate[$x]; ?>', '<?php echo $arraySubstock[$x]; ?>')">
                                        <img src="images/icons/dashboard/add_icon.png">
                                     </button>     
                                                                  
                                     </div>   
                                </td>  
                            </tr>
                        <?php
                        }
                        }  
                        $sr++; endwhile;  ?> <!--End of Php -->
                    </table>
                    </div>
                    <!--------------------------------------------------------------------->

                    <!--------Expiration Date------------------------------------------>
                    <div id="expReport_cont_tb" class="med_cont_tb">
                    <table class="table_med_search" id="table_exp_med">
                        <?php  //php for displaying all items
                                date_default_timezone_set('Asia/Manila');
                                $date = new DateTime('now');
                                $date->modify('+5 month'); // or you can use '-90 day' for deduct
                                $effectiveDate = $date->format('Y-m-d');
                                           
                                $sql_exp = "SELECT * FROM medicine_tb ORDER BY name DESC "; 
                                $search_pendingApp_exp = filterTable_exp1($sql_exp);
                                function filterTable_exp1($sql_exp){  
                                    $con_crit=mysqli_connect('localhost','root','','robles_db');
                                    $filter_pendingAppExp = mysqli_query($con_crit, $sql_exp);
                                    return $filter_pendingAppExp; 
                                }
                                $sr = 0; 
                                while($row = mysqli_fetch_array($search_pendingApp_exp)):

                                    $strSubname = $row['subname'];
                                    $strSubstock = $row['substock'];
                                    $strSubcategory = $row['category'];
                                    $strSubexpdate = $row['expiration_date'];
                                    $strSubmfgdate = $row['mfg_date'];
                                    $strSubbrand = $row['type'];
                                    $strSubStat = $row['status'];
                                    $strSubEditDelete = $row['edit_delete'];

                                    $arraySubname = explode(',', $strSubname );
                                    $arraySubstock = explode(',', $strSubstock );
                                    $arrayCategory = explode(',', $strSubcategory );
                                    $arrayExpdate = explode(',', $strSubexpdate );
                                    $arrayMfgdate = explode(',', $strSubmfgdate );
                                    $arrayBrand = explode(',', $strSubbrand );
                                    $arrayStat = explode(',', $strSubStat );
                                    $arrayEditDelete = explode(',', $strSubEditDelete);

                                    $totalStock2 = 0;
                                    for($z = 0 ; $z<count($arraySubname); $z++){
                                        if($arrayStat[$z] == "activated" && $arrayExpdate[$z] <= $effectiveDate ){
                                        $totalStock2+=$arraySubstock[$z];
                                        }
                                    }
                                    if($totalStock2!== 0){
                                    echo "<tr style='background:#e4f5fc;'>";   
                        ?>  
                                <td style="width:5%;">
                                    <center>
                                    <img src="images/icons/dashboard/dropright.png" id="dropright<?php echo $sr; ?>" class="dropright" title="See more" onclick="seeMoremed_Act(<?php echo $sr; ?>)">
                                    <img src="images/icons/dashboard/dropdown.png" id="dropdown<?php echo $sr; ?>" class="dropdown" title="See less" onclick="seeLessmed_Act(<?php echo $sr; ?>)">
                                    </center>
                                </td>
                                <td style="width:15%; text-align:left;" class="td_none<?php echo $sr; ?> td_none"><?php echo $row['name']; ?></td>
                                <td style="width:15%;" class="td_none<?php echo $sr; ?> td_none"><?php echo $row['main_id']; ?></td>
                                <td style="width:15%; text-transform:lowercase;" class="td_none<?php echo $sr; ?> td_none"></td>
                                <td style="width:15%;" class="td_none<?php echo $sr; ?> td_none"></td>
                                <td style="width:15%;" class="td_none<?php echo $sr; ?> td_none"></td>    
                                <td style="width:20%;" class="td_none<?php echo $sr; ?> td_none"></td>           
                        <?php
                                    echo "</tr>";
                                    }
                             for($x = 0 ; $x<count($arraySubname); $x++){
                                 if($arrayStat[$x] == "activated" && $arrayExpdate[$x] <= $effectiveDate){
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
                        
                            <tr id="sub_tr<?php echo $sr; ?>" class="sub_tr">
                                <td style="width:5%;" id="dropdown"></td>
                                <td style="width:15%; text-align:left; color:red; font-weight:bold;" class="td_none<?php echo $sr; ?> td_none"><?php echo $arraySubname[$x] ; ?></td>
                                <td style="width:15%; color:red; font-weight:bold;" class="td_none<?php echo $sr; ?> td_none"><?php echo $row['main_id'].".".$x+1; ?></td>
                                <td style="width:15%; text-transform:none; color:red; font-weight:bold;" class="td_none<?php echo $sr; ?> td_none"><?php echo $abs_diff; ?></td>
                                <td style="width:15%; color:red; font-weight:bold;" class="td_none<?php echo $sr; ?> td_none"><?php echo $arrayCategory[$x]; ?></td>
                                <td style="width:15%; color:red; font-weight:bold;" class="td_none<?php echo $sr; ?> td_none"><?php echo $arrayExpdate[$x]; ?></td>
                                <td style="width:20%; color:red; font-weight:bold;" class="td_none<?php echo $sr; ?> td_none" id="td_str">     
                                     <div> 
                                     <button class="button_subtstr" style="background:#4C5861;" title="View" onclick="viewMed('<?php echo $row['main_id'].'.'.$x+1; ?>', '<?php echo $arraySubname[$x] ; ?>', '<?php echo $arrayCategory[$x]; ?>', '<?php echo $arrayBrand[$x]; ?>', '<?php echo $row['description']; ?>','<?php echo $arrayMfgdate[$x]; ?>', '<?php echo $arrayExpdate[$x]; ?>', '<?php echo $arraySubstock[$x]; ?>')">
                                        <img src="images/icons/dashboard/view_icon.png">
                                     </button>   

                                     <button class="button_subtstr" style="background:#5FB1F2;" title="Restock" onclick="restockMed('<?php echo $row['name']; ?>', '<?php echo $arraySubname[$x] ; ?>', '<?php echo $arrayBrand[$x]; ?>', '<?php echo $arrayCategory[$x]; ?>', '<?php echo $arrayMfgdate[$x]; ?>', '<?php echo $arrayExpdate[$x]; ?>', '<?php echo $arraySubstock[$x]; ?>')">
                                        <img src="images/icons/dashboard/add_icon.png">
                                     </button>     
                                                                  
                                     </div>   
                                </td>  
                            </tr>
                        <?php
                        }
                        }  
                        $sr++; endwhile;  ?> <!--End of Php -->
                    </table>
                    </div>
                    <!--------------------------------------------------------------------->

                    <!--------Presccribe History------------------------------------------>
                    <div id="preHistory_cont_tb" class="med_cont_tb">
                    <table class="table_med_search" id="table_hist_med">
                        <?php  //php for displaying all items
                                $sql_crit = "SELECT * FROM prescribemedhistory_tb"; 
                                $search_pendingApp_crit = filterTable_History($sql_crit);
                                function filterTable_History($sql_crit){  
                                    $con_crit=mysqli_connect('localhost','root','','robles_db');
                                    $filter_pendingAppCrit = mysqli_query($con_crit, $sql_crit);
                                    return $filter_pendingAppCrit; 
                                }
                                $sr = 0; 
                                while($row = mysqli_fetch_array($search_pendingApp_crit)):
                       ?>
                        
                            <tr>
                                <td style="width:20%;"><?php echo $row['patient_name']; ?></td>
                                <td style="width:15%;"><?php echo $row['issuedby']; ?></td>
                                <td style="width:15%; padding-left:1%;"><?php echo $row['date']; ?></td>
                                <td style="width:30%; text-align:left; padding-left:2%;"><?php echo $row['meds_name']; ?></td>
                                <td style="width:19%;">
                                    <button class="button_subtstr" style="background:#5FB1F2;" title="Generate Receipt" onclick="generateReceipt('<?php echo $row['patient_name']; ?>','<?php echo $row['issuedby']; ?>','<?php echo $row['date']; ?>','<?php echo $row['meds_name']; ?>')">
                                        <img src="images/icons/dashboard/report.png">
                                     </button>    
                                </td>
                            </tr>
                        <?php
                        $sr++; endwhile;  ?> <!--End of Php -->
                    </table>
                    </div>
                    <!--------------------------------------------------------------------->

                    <!--No data verifyer-->
                    <div id="no_dataVerifyer">
                        <img src="images/icons/dashboard/no_data_found.png" alt="">
                        NO DATA FOUND
                    </div>

                    <script>
                        var table = document.getElementById("table_active_med");
                        var totalRowCount = table.rows.length; 
                        if(totalRowCount === 0){          
                            document.getElementById("no_dataVerifyer").innerHTML ='<img src="images/icons/dashboard/no_data_found.png" alt=""> Record is empty'         
                            document.getElementById("no_dataVerifyer").style.display = "flex"
                        }
                    </script>

                </div>

            </div><!-- End of dashboard_content -->

    </div><!-- right_content_dashboard -->

</div> <!-- End of for_desktop div -->


<!-- Add medicine modal -->
<form action="javascript:void(0)" method="post" id="ajax-form_admin_addmed">
<div id="addmed_background" class="modal_med">
    <div id="addmed_content" class="addmed_class med_box_container">
        <div id="top">Add Medicine</div>
        <div id="header"><img src="images/icons/dashboard/medicine1.png">Medicine Information</div>

        <div class="input_content">
            <label>Medicine Name <span style="color:red; font-size:2.5vh;">*</span></label>
            <input type="text" placeholder="Ex. Warfarin" id="med_name" name="med_name"  class="for_verf_add" onkeyup="remove_validation_addmed('med_name')"  onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)">
        </div>
                    
        <div class="input_content1">
            <div id="left">
                <label>Brand <span style="color:red; font-size:2.5vh;">*</span></label>
                <input type="text" placeholder="Ex. Johnson" id="med_type" name="med_type"  class="for_verf_add" onkeyup="remove_validation_addmed('med_type')">
            </div>
            <div id="right">
                <label>Dosage <span style="color:red; font-size:2.5vh;">*</span></label>
                <div>
                    <input type="number" placeholder="Ex. 25" id="med_dosage" name="med_dosage" class="for_verf_add" onkeyup="remove_validation_addmed('med_dosage')" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==4) return false;" />
                    <select name="" id="dosage" onchange="getTypeDosage()">
                        <option value="mg">mg</option>
                        <option value="mg">ml</option>
                    </select>
                </div>
                <input type="hidden" id="dosage_key" name="dosage_key">
            </div>
        </div>

        <div class="input_content1">
            <div id="left" style="width:30%;">
                    <label>Type <span style="color:red; font-size:2.5vh;">*</span></label>
                    <select name="med_category" id="med_category">
                        <option value="Tablet">Tablet</option>
                        <option value="Capsule">Capsule</option>
                        <option value="Liquid">Liquid</option>
                    </select>
            </div>
            <div id="right" style="width:30%;">
                    <label>Stocks <span style="color:red; font-size:2.5vh;">*</span></label>
                    <div id="stocks_cont">
                        <div id="dec" class="dec_btn" onclick="decrease_medstock_input()">-</div>
                        <div id="val_totalChild" class="var_totalmed_stock">30</div>
                        <div id="dec" class="inc_btn" onclick="add_medstock_input()">+</div>
                    </div>
                    <input type="hidden" id="med_stock"  name="med_stock" value="30">
            </div>
            <div id="right" style="width:40%;">
                    <label style="">Low Stocks<span style="color:red; font-size:2.5vh;">*</span></label>
                    <input type="number" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" onKeyDown="if(this.value.length==2 && event.keyCode!=8) return false;" placeholder="40" style="width:50%;" id="crit_Stocks" onkeyup="remove_validation_addmed('crit_Stocks')" class="for_verf_add" name="crit_Stocks">
            </div>
        </div>

        <div class="input_content">
            <label>Description <span style="color:red; font-size:2.5vh;">*</span></label>
            <textarea placeholder="Ex. Chemotherapy agent and immune-system suppressant" id="med_description" name="med_description"  class="for_verf_add"onkeyup="remove_validation_addmed('med_description')"></textarea>
        </div>

        <div id="date_content">
            <div id="left">
                <label>Mfg. Date <span style="color:red; font-size:2.5vh;">*</span></label>
                <input type="date" id="man_date" name="man_date" onchange="remove_validation_addmed('man_date')" class="for_verf_add">
            </div>
            <div id="right">
                <label>Exp. Date <span style="color:red; font-size:2.5vh;">*</span></label>
                <input type="date" id="med_date" name="med_date" onchange="remove_validation_addmed('med_date')" class="for_verf_add">
            </div>
        </div>

        <div id="button_div">
            <button id="cancel_btn" type="button" onclick="close_addmed()">Cancel</button>
            <button id="add_btn" type="submit" style="margin-right:8%;">Submit</button>
        </div>
    </div>
</div>
</form>


<!-- View medicine modal -->
<div id="viewmed_background" class="modal_med">
    <div id="view_content" class="viewMed_content">
            <div id="top_content">
                <div id="left"><img src="images/icons/dashboard/default_med.png"></div>
                <div id="right">
                    <p class="top_head_text" style="margin-bottom:1%;">Medicine ID</p>
                    <p class="subtext_top" style="margin-bottom:7%;" id="viewM_id"></p>
                    <p class="top_head_text" style="margin-bottom:1%;">Medicine Name</p>
                    <p class="subtext_top" style="margin-bottom:7%;" id="viewM_name"></p>
                    <p class="top_head_text" style="margin-bottom:1%;">Type</p>
                    <p class="subtext_top" style="margin-bottom:7%;" id="viewM_category"></p>
                </div>
            </div>

            <div id="middle">
                <div id="cont">
                    <div id="left"><img src="images/icons/dashboard/add_iconGray.png" alt=""></div>
                    <div id="right">
                        <p class="head_Text" style="margin-top:5%;">Brand</p>
                        <p class="cont_Text" id="viewM_brand"></p>
                    </div>
                </div>

                <div id="cont">
                    <div id="left"><img src="images/icons/dashboard/medDesc.png" alt=""></div>
                    <div id="right">
                        <p class="head_Text" style="margin-top:5%;">Description</p>
                        <p class="cont_Text" id="viewM_desc"></p>
                    </div>
                </div>

                <div id="cont">
                    <div id="left"><img src="images/icons/dashboard/medMFG.png" alt=""></div>
                    <div id="right">
                        <p class="head_Text" style="margin-top:5%;">Manufacturing date</p>
                        <p class="cont_Text" id="viewM_mfg"></p>
                    </div>
                </div>
           
                <div id="cont">
                    <div id="left"><img src="images/icons/dashboard/medExp.png" alt=""></div>
                    <div id="right">
                        <p class="head_Text" style="margin-top:5%;">Date of Expiration</p>
                        <p class="cont_Text" id="viewM_exp"></p>
                    </div>
                </div>

                <div id="cont">
                    <div id="left"><img src="images/icons/dashboard/medStock.png" alt=""></div>
                    <div id="right">
                        <p class="head_Text" style="margin-top:5%;">Stocks</p>
                        <p class="cont_Text" id="viewM_stock" style="text-transform:lowercase;"></p>
                    </div>
                </div>
            </div>

            <div id="bottom"><button onclick="closeMedicine()">Close</button></div>
    </div>
</div>


<!-- Edit medicine modal -->
<form action="javascript:void(0)" method="post" id="ajax-form_admin_Editmed">
<div id="editmed_background" class="modal_med">
    <div id="editmed_content" class="addmed_class med_box_container">
        <div id="top">Edit Medicine</div>
        <div id="header"><img src="images/icons/dashboard/medicine1.png">Medicine Information</div>
        <input type="hidden" id="key_edit_delete" name="key_edit_delete">
        <input type="hidden"  name="mainId_edit" id="mainId_edit">
        
        <div class="input_content">
            <label>Medicine Name <span style="color:red; font-size:2.5vh;">*</span></label>
            <input type="text" placeholder="Ex. Warfarin" id="med_name_edit" name="med_name_edit"  class="for_verf_add" readonly style="border:none;">
        </div>
                    
        <div class="input_content1">
            <div id="left">
                <label>Brand <span style="color:red; font-size:2.5vh;">*</span></label>
                <input type="text" placeholder="Ex. Johnson" id="med_type_edit" name="med_type_edit"  class="for_verf_add"onkeyup="remove_validation_addmed('med_type_edit')">
            </div>
            <div id="right">
                <label>Dosage <span style="color:red; font-size:2.5vh;">*</span></label>
                <div>
                    <input type="number" placeholder="Ex. 25" id="med_dosage_edit" name="med_dosage_edit" class="for_verf_add" onkeyup="remove_validation_addmed('med_dosage_edit')" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==4) return false;" />
                    <select name="dosage_edit" id="dosage_edit" onchange="getTypeDosage1()">
                        <option value="mg">mg</option>
                        <option value="ml">ml</option>
                    </select>
                </div>
                <input type="hidden" id="dosage_key_edit" name="dosage_key_edit">
            </div>
        </div>

        <div class="input_content1">
            <div id="left" style="width:30%;">
                    <label>Type <span style="color:red; font-size:2.5vh;">*</span></label>
                    <select name="med_category_edit" id="med_category" class="med_category_edit">
                        <option value="Tablet">Tablet</option>
                        <option value="Capsule">Capsule</option>
                        <option value="Liquid">Liquid</option>
                    </select>
            </div>
            <div id="right" style="width:30%;">
                    <label>Stocks <span style="color:red; font-size:2.5vh;">*</span></label>
                    <div id="stocks_cont">
                        <div id="dec" class="dec_btn" onclick="decrease_medstock_input2()">-</div>
                        <div id="val_totalChild" class="var_totalmed_stock_edit"></div>
                        <div id="dec" class="inc_btn" onclick="add_medstock_input2()">+</div>
                    </div>
                    <input type="hidden" id="med_stock_edit"  name="med_stock_edit" value="30">
            </div>
            <div id="right" style="width:40%;">
                    <label style="">Low Stocks<span style="color:red; font-size:2.5vh;">*</span></label>
                    <input type="number" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" onKeyDown="if(this.value.length==2 && event.keyCode!=8) return false;" placeholder="40" style="width:50%;" id="crit_Stocks_edit" onkeyup="remove_validation_addmed('crit_Stocks_edit')" class="for_verf_add" name="crit_Stocks_edit">
            </div>
        </div>

        <div class="input_content">
            <label>Description <span style="color:red; font-size:2.5vh;">*</span></label>
            <textarea placeholder="Ex. Chemotherapy agent and immune-system suppressant" id="med_description_edit" name="med_description_edit"  class="for_verf_add" onkeyup="remove_validation_addmed('med_description_edit')"></textarea>
        </div>

        <div id="date_content">
            <div id="left">
                <label>Mfg. Date <span style="color:red; font-size:2.5vh;">*</span></label>
                <input type="date" id="man_date_edit" name="man_date_edit" onchange="remove_validation_addmed('man_date_edit')" class="for_verf_add">
            </div>
            <div id="right">
                <label>Exp. Date <span style="color:red; font-size:2.5vh;">*</span></label>
                <input type="date" id="med_date_edit" name="med_date_edit" onchange="remove_validation_addmed('med_date_edit')" class="for_verf_add">
            </div>
        </div>

        <div id="button_div">
            <button id="cancel_btn" type="button" onclick="close_Editmed()">Cancel</button>
            <button id="add_btn" type="submit" style="margin-right:8%;">Submit</button>
        </div>
    </div>
</div>
</form>


<!--Deactivate modal-->
<div id="deact_container">
    <div id="deact_content">
    <form action="javascript:void(0)" method="post" id="ajax-form_admin_deactMedicine">
        <p>Do you want to deactivate this medicine?</p> 
            <div id="accept_bot">
            <button id="accept_no" onclick="close_deactMedicine()" type="button">No</button>
            <button id="accept_yes" type="submit">Yes</button>
            <input type="hidden" id="key_medDeact" name="key_medDeact">
            <input type="hidden" id="key_medDeactName" name="key_medDeactName">
        </div>
    </form>
    </div><!--End of accept Content-->
</div><!--End of Accept Container-->

<!--Activate modal-->
<div id="activate_container">
    <div id="activate_content">
    <form action="javascript:void(0)" method="post" id="ajax-form_admin_activateMedicine">
        <p>Do you want to activate this medicine?</p> 
            <div id="accept_bot">
            <button id="accept_no" onclick="close_actMedicine()" type="button">No</button>
            <input type="hidden" id="key_medact" name="key_medact">
            <input type="hidden" id="key_medactName" name="key_medactName">
            <button id="accept_yes" type="submit">Yes</button>
        </div>
    </form>
    </div><!--End of accept Content-->
</div><!--End of Accept Container-->


<!--Prescribe modal-->
<form action="javascript:void(0)" method="post" id="ajax-form_admin_prescribeMedicine">
<div id="prescribe_container">
    <div id="prescribe_content">
        <div id="top_content">

        </div>
        <div id="middle_content">
                <input type="hidden" id="main_nameP" name="main_nameP">
                <input type="hidden" id="type_pres" name="type_pres">
                <input type="hidden" id="main_name_pres" name="main_name_pres">
                <input type="hidden" id="actual_Stock" name="actual_Stock">
                <p id="name" class="name_prescribe"></p>
                <p id="dosage" class="dosage_prescribe"></p>

                <div id="stock_quant">
                    <div id="left">
                        <label>Quantity <span style="color:red; font-size:2.5vh;">*</span></label>
                        <div id="quant_cont">
                            <div id="minus" class="inc_dec" onclick="minus_prescribe()">-</div>
                            <div id="quant_box">0</div>
                            <div id="plus" class="inc_dec" onclick="add_prescribe()">+</div>
                        </div>
                        <input type="hidden" id="inp_stck_pres">
                        <input type="hidden" id="edit_delete_pres" name="edit_delete_pres">
                    </div>
                    <div id="right">
                        <label>Stocks</label>
                        <p id="stocks" class="stock_prescribe"></p>
                        <input type="hidden" id="inp_stck_subcont" name="inp_stck_subcont">
                    </div>
                </div>

                <p id="desc">Description</p>
                <p id="desc_cont" class="desc_prescribe"></p>
        </div>

        <div id="middle_content1">
                <label>Patient's Name <span style="color:red; font-size:2.5vh;">*</span></label>
                <input type="text" id="pres_Pname" name="pres_Pname" placeholder="Patient's name here...">
                <label>Issued by <span style="color:red; font-size:2.5vh;">*</span></label>
                <input type="text" name="issuedBy" value="<?php echo $row_active['fname']." ".$row_active['lname']; ?>" readonly style="background-color:#ececec;">
                <label>Date Today <span style="color:red; font-size:2.5vh;">*</span></label>
                <input type="text" name="pres_dateT" value="<?php echo date("Y-m-d");?>" readonly style="background-color:#ececec;width:40%;">
        </div>
        <div id="bottom_content">
            <button id="close" type="button" onclick="close_prescribeMed()">Close</button>
            <button id="back" type="button" onclick="backStepPrescribe()">Back</button>
            <button id="next" type="button" onclick="nextStepPrescribe()">Next</button>
            <button id="prescribe" type="submit">Prescribe</button>
        </div>
    </div>
</div>
</form>


<!-- Activate medicine modal -->
<form action="javascript:void(0)" method="post" id="ajax-form_admin_Activatemed">
<div id="Activemed_background" class="modal_med">
    <div id="addmed_content">
        <div id="top">Activate Medicine</div>
        <div id="header"><img src="images/icons/dashboard/medicine1.png">Medicine Information</div>
        <input type="hidden" value="<?php echo $row_medicine['id']; ?>" name="key_id_act">
        <div class="input_content">
            <label>Medicine Name <span style="color:red; font-size:2.5vh;">*</span></label>
            <input type="text" placeholder="Note: with miligrams Ex. Warfarin 25mg" id="med_name_act" name="med_name_act" onkeyup="remove_validation_actmed()" value="<?php echo $row_medicine['name']; ?>">
        </div>
      
        <div class="input_content1">
            <div id="left">
                <label>Type <span style="color:red; font-size:2.5vh;">*</span></label>
                <input type="text" placeholder="Ex. Anti-Rheumatic" id="med_type_act" name="med_type_act"  onkeyup="remove_validation_actmed()" value="<?php echo $row_medicine['type']; ?>">
            </div>
            <div id="right">
                <label>Dosage <span style="color:red; font-size:2.5vh;">*</span></label>
                <div>
                    <input type="number" placeholder="Ex. 25" id="med_dosage_act" name="med_dosage_act" onkeyup="remove_validation_actmed()" value="<?php echo $row_medicine['dosage']; ?>">
                    <div id="mg">mg/s</div>
                </div>
            </div>
        </div>

        <div class="input_content">
            <label>Description <span style="color:red; font-size:2.5vh;">*</span></label>
            <textarea placeholder="Ex. Chemotherapy agent and immune-system suppressant" id="med_description_act" name="med_description_act" onkeyup="remove_validation_actmed()"><?php echo $row_medicine['description']; ?></textarea>
        </div>

        <div id="date_content">
            <div id="left">
                <label>Date of expiration <span style="color:red; font-size:2.5vh;">*</span></label>
                <input type="date" id="med_date_act" name="med_date_act" onchange="remove_validation_actmed()" value="<?php echo $row_medicine['expiration_date']; ?>">
            </div>
            <div id="right">
                <label>Stocks <span style="color:red; font-size:2.5vh;">*</span></label>
                    <div id="stocks_cont">
                        <div id="dec" class="dec_btn" onclick="decrease_medstock_input2()">-</div>
                        <div id="val_totalChild" class="var_totalmed_stock_act_med"><?php echo $row_medicine['stocks']; ?></div>
                        <div id="dec" class="inc_btn" onclick="add_medstock_input2()">+</div>
                    </div>
                    <input type="hidden" id="med_stock_act"  name="med_stock_act" value="<?php echo $row_medicine['stocks']; ?>">
            </div>
        </div>

        <div id="validation_activemedicine">
            <img src="images/icons/error_input.png">
            <span id="validation_activemedicine_Text">.</span>
        </div>

        <div id="button_div">
            <button id="cancel_btn" type="button" onclick="close_actMed_modal()">Cancel</button>
            <button id="add_btn" type="submit">Activate</button>
        </div>
    </div>
</div>
</form>


<!--Add stocks modal -->
<form action="javascript:void(0)" method="post" id="ajax-form_admin_addstockMed">
<div id="addstockmed_background" class="modal_med">
    <div id="addstock_content">
        <div id="top_content">

        </div>

        <div id="middle_content">
            <p id="name_ats"></p>
            <p id="dosage_ats"></p>
            <input type="hidden" id="name_inp_ats" name="name_inp_ats">
            <input type="hidden" id="subname_ats" name="subname_ats">

            <div class="input_content">
                <div id="left">
                    <label>Brand <span style="color:red; font-size:2.5vh;">*</span></label>
                    <input type="text" placeholder="Ex. Johnsons" name="brand_ats" id="brand_ats" onkeyup="remove_validation_ats('brand_ats')">
                </div>
                <div id="right">
                    <label>Category <span style="color:red; font-size:2.5vh;">*</span></label>
                    <select name="category_ats" id="category_ats" class="med_category_edit">
                        <option value="Tablet">Tablet</option>
                        <option value="Capsule">Capsule</option>
                        <option value="Liquid">Liquid</option>
                    </select>
                </div>
            </div>

            <div class="input_content">
                <div id="left">
                    <label>Mfg. Date <span style="color:red; font-size:2.5vh;">*</span></label>
                    <input type="date"  id="mfg_ats" name="mfg_ats" onchange="remove_validation_ats('mfg_ats')">
                </div>
                <div id="right">
                    <label>Exp. Date <span style="color:red; font-size:2.5vh;">*</span></label>
                    <input type="date" id="exp_ats" name="exp_ats" onchange="remove_validation_ats('exp_ats')">
                </div>
            </div>

            <div class="input_content">
                <div id="left">
                    <label>Stocks to add <span style="color:red; font-size:2.5vh;">*</span></label>
                    <div id="quant_cont">
                            <div id="minus" class="inc_dec" onclick="minus_ats()">-</div>
                            <div id="quant_box" class="ats_box">40</div>
                            <div id="plus" class="inc_dec" onclick="add_ats()">+</div>
                            <input type="hidden" name="ats_box_input" id="ats_box_input">
                    </div>
                </div>
            </div>
        </div>

        <div id="bottom_content">
            <button id="close" type="button" onclick="close_restockMed()">Close</button>
            <button id="addtostock" type="submit">Add stock</button>
        </div>

    </div>
</div>
</form>


<div id="medicineslip_container">
    <div id="medicineSlip">
        <center><img src="images/icons/webIcon.png"></center>
        <p id="toedit">Patient Name <span id="name_receipt"></span></p>
        <p id="toedit">Issued Date <span id="date_receipt"></span></p>
        <p id="toedit">Issued by  <span id="issued_receipt"></span></p>

        <p id="list">List of Medicines</p>
        <p id="listmed"></p>

        <div id="line"></div>
        <p id="note">Note: Bring this slip to counter to calculate your medicine fees.</p>
    </div>

    <div id="for_button">
        <button style="background:#5fb1f2;" onclick="cancelPrescribemodal()">Cancel</button>
        <button style="background:#5fb1f2;"  onclick="printDiv('medicineSlip')"><img src="images/icons/dashboard/medical_pres.png" style="margin-right:5%;">Print</button>
    </div>
</div>


<!--Validation-->
<div id="validation_medicine">
     <div class="left">
         <img src="" alt="" id="validationAppointment_img">
     </div>
     <div class="center">
         <p id="text_validationHeader"></p>
         <p id="text_validationContent"></p>
     </div>
     <div class="right">  <p id="close_validationmedicine" onclick="close_alertAddmed()">OK</p>   </div>
</div>




<!--for printing active med-->
<div id="for_print_act_cont">
<table id="for_print_act" class="table_forPrint">
    <th>Medicine Name</th>
    <th>Medicine ID</th>
    <th>Stocks</th>
    <th>Category</th>
    <th>Expiration Date</th>
                        <?php  //php for displaying all items
                                date_default_timezone_set('Asia/Manila');
                                $date = new DateTime('now');
                                $effectiveDate1 = $date->format('Y-m-d');
                                $sql = "SELECT * FROM medicine_tb ORDER BY name DESC " ; 
                                $search_pendingApp = filterTableP1($sql);
                                function filterTableP1($sql){  
                                    $con=mysqli_connect('localhost','root','','robles_db');
                                    $filter_pendingApp = mysqli_query($con, $sql);
                                    return $filter_pendingApp; 
                                }
                                $sr = 0; 
                                while($row = mysqli_fetch_array($search_pendingApp)):

                                    $strSubname = $row['subname'];
                                    $strSubstock = $row['substock'];
                                    $strSubcategory = $row['category'];
                                    $strSubexpdate = $row['expiration_date'];
                                    $strSubmfgdate = $row['mfg_date'];
                                    $strSubbrand = $row['type'];
                                    $strSubStat = $row['status'];
                                    $strSubEditDelete = $row['edit_delete'];

                                    $arraySubname = explode(',', $strSubname );
                                    $arraySubstock = explode(',', $strSubstock );
                                    $arrayCategory = explode(',', $strSubcategory );
                                    $arrayExpdate = explode(',', $strSubexpdate );
                                    $arrayMfgdate = explode(',', $strSubmfgdate );
                                    $arrayBrand = explode(',', $strSubbrand );
                                    $arrayStat = explode(',', $strSubStat );
                                    $arrayEditDelete = explode(',', $strSubEditDelete);

                                    $totalStock = 0;
                                    for($z = 0 ; $z<count($arraySubname); $z++){
                                        if($arrayStat[$z] == "activated" && $effectiveDate1 != $arrayExpdate[$z]){
                                        $totalStock+=$arraySubstock[$z];
                                        }
                                    }
                             for($x = 0 ; $x<count($arraySubname); $x++){
                                 if($arrayStat[$x] == "activated" && $arraySubstock[$x] != "0"  && $effectiveDate1 != $arrayExpdate[$x]){
                        ?>
                        
                            <tr>
                                <td><?php echo $arraySubname[$x] ; ?></td>
                                <td><?php echo $row['main_id'].".".$x+1; ?></td>
                                <td><?php echo $arraySubstock[$x]; ?> pcs</td>
                                <td><?php echo $arrayCategory[$x]; ?></td>
                                <td><?php echo $arrayExpdate[$x]; ?></td>
                            </tr>
                        <?php
                        }
                        }  
                        $sr++; endwhile;  ?> <!--End of Php -->
</table>
</div>


<!--for printing inactive med-->
<div id="for_print_act_cont">
<table id="for_print_inact" class="table_forPrint">
    <th>Medicine Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
    <th>Medicine ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
    <th>Stocks&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
    <th>Category&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
    <th>Expiration Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        <?php  //php for displaying all items
                                date_default_timezone_set('Asia/Manila');
                                $date = new DateTime('now');
                                $effectiveDate1 = $date->format('Y-m-d');
                                $sql = "SELECT * FROM medicine_tb ORDER BY name DESC " ; 
                                $search_pendingApp = filterTableP2($sql);
                                function filterTableP2($sql){  
                                    $con=mysqli_connect('localhost','root','','robles_db');
                                    $filter_pendingApp = mysqli_query($con, $sql);
                                    return $filter_pendingApp; 
                                }
                                $sr = 0; 
                                while($row = mysqli_fetch_array($search_pendingApp)):

                                    $strSubname = $row['subname'];
                                    $strSubstock = $row['substock'];
                                    $strSubcategory = $row['category'];
                                    $strSubexpdate = $row['expiration_date'];
                                    $strSubmfgdate = $row['mfg_date'];
                                    $strSubbrand = $row['type'];
                                    $strSubStat = $row['status'];
                                    $strSubEditDelete = $row['edit_delete'];

                                    $arraySubname = explode(',', $strSubname );
                                    $arraySubstock = explode(',', $strSubstock );
                                    $arrayCategory = explode(',', $strSubcategory );
                                    $arrayExpdate = explode(',', $strSubexpdate );
                                    $arrayMfgdate = explode(',', $strSubmfgdate );
                                    $arrayBrand = explode(',', $strSubbrand );
                                    $arrayStat = explode(',', $strSubStat );
                                    $arrayEditDelete = explode(',', $strSubEditDelete);

                                    $totalStock = 0;
                                    for($z = 0 ; $z<count($arraySubname); $z++){
                                        if($arrayStat[$z] == "deactivated" && $effectiveDate1 != $arrayExpdate[$z]){
                                        $totalStock+=$arraySubstock[$z];
                                        }
                                    }
                             for($x = 0 ; $x<count($arraySubname); $x++){
                                 if($arrayStat[$x] == "deactivated" && $arraySubstock[$x] != "0"  && $effectiveDate1 != $arrayExpdate[$x]){
                        ?>
                        
                            <tr>
                                <td><?php echo $arraySubname[$x] ; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td><?php echo $row['main_id'].".".$x+1; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td><?php echo $arraySubstock[$x]; ?> pcs&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td><?php echo $arrayCategory[$x]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td><?php echo $arrayExpdate[$x]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                            </tr>
                        <?php
                        }
                        }  
                        $sr++; endwhile;  ?> <!--End of Php -->
</table>
</div>

<!--for printing critical med-->
<div id="for_print_act_cont">
<table id="for_print_crit" class="table_forPrint">
<th>Medicine Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Medicine ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Stocks&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Category&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Expiration Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
<?php  //php for displaying all items
                                $sql_crit = "SELECT * FROM medicine_tb ORDER BY name DESC "; 
                                $search_pendingApp_crit = filterTable_P3($sql_crit);
                                function filterTable_P3($sql_crit){  
                                    $con_crit=mysqli_connect('localhost','root','','robles_db'); 
                                    $filter_pendingAppCrit = mysqli_query($con_crit, $sql_crit);
                                    return $filter_pendingAppCrit; 
                                }
                                $sr = 0; 
                                while($row = mysqli_fetch_array($search_pendingApp_crit)):

                                    $strSubname = $row['subname'];
                                    $strSubstock = $row['substock'];
                                    $strSubcategory = $row['category'];
                                    $strSubexpdate = $row['expiration_date'];
                                    $strSubmfgdate = $row['mfg_date'];
                                    $strSubbrand = $row['type'];
                                    $strSubStat = $row['status'];
                                    $strSubEditDelete = $row['edit_delete'];

                                    $arraySubname = explode(',', $strSubname );
                                    $arraySubstock = explode(',', $strSubstock );
                                    $arrayCategory = explode(',', $strSubcategory );
                                    $arrayExpdate = explode(',', $strSubexpdate );
                                    $arrayMfgdate = explode(',', $strSubmfgdate );
                                    $arrayBrand = explode(',', $strSubbrand );
                                    $arrayStat = explode(',', $strSubStat );
                                    $arrayEditDelete = explode(',', $strSubEditDelete);

                                    $totalStock2 = 0;
                                    for($z = 0 ; $z<count($arraySubname); $z++){
                                        if($arrayStat[$z] == "activated" && $arraySubstock[$z] <=30 ){
                                        $totalStock2+=$arraySubstock[$z];
                                        }
                                    }
                             for($x = 0 ; $x<count($arraySubname); $x++){
                                 if($arrayStat[$x] == "activated" && $arraySubstock[$x] <= 30){
                        ?>
                        
                            <tr>
                                <td><?php echo $arraySubname[$x] ; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td><?php echo $row['main_id'].".".$x+1; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td><?php echo $arraySubstock[$x]; ?> pcs&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td><?php echo $arrayCategory[$x]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td><?php echo $arrayExpdate[$x]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                            </tr>
                        <?php
                        }
                        }  
                        $sr++; endwhile;  ?> <!--End of Php -->
</table>
</div>


<!--for printing expiration med-->
<div id="for_print_act_cont">
<table id="for_print_exp" class="table_forPrint">
<th>Medicine Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Medicine ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Days Left&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Category&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Expiration Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
<?php  //php for displaying all items
                                date_default_timezone_set('Asia/Manila');
                                $date = new DateTime('now');
                                $date->modify('+5 month'); // or you can use '-90 day' for deduct
                                $effectiveDate = $date->format('Y-m-d');
                                           
                                $sql_exp = "SELECT * FROM medicine_tb ORDER BY name DESC "; 
                                $search_pendingApp_exp = filterTable_P4($sql_exp);
                                function filterTable_P4($sql_exp){  
                                    $con_crit=mysqli_connect('localhost','root','','robles_db'); 
                                    $filter_pendingAppExp = mysqli_query($con_crit, $sql_exp);
                                    return $filter_pendingAppExp; 
                                }
                                $sr = 0; 
                                while($row = mysqli_fetch_array($search_pendingApp_exp)):

                                    $strSubname = $row['subname'];
                                    $strSubstock = $row['substock'];
                                    $strSubcategory = $row['category'];
                                    $strSubexpdate = $row['expiration_date'];
                                    $strSubmfgdate = $row['mfg_date'];
                                    $strSubbrand = $row['type'];
                                    $strSubStat = $row['status'];
                                    $strSubEditDelete = $row['edit_delete'];

                                    $arraySubname = explode(',', $strSubname );
                                    $arraySubstock = explode(',', $strSubstock );
                                    $arrayCategory = explode(',', $strSubcategory );
                                    $arrayExpdate = explode(',', $strSubexpdate );
                                    $arrayMfgdate = explode(',', $strSubmfgdate );
                                    $arrayBrand = explode(',', $strSubbrand );
                                    $arrayStat = explode(',', $strSubStat );
                                    $arrayEditDelete = explode(',', $strSubEditDelete);

                                    $totalStock2 = 0;
                                    for($z = 0 ; $z<count($arraySubname); $z++){
                                        if($arrayStat[$z] == "activated" && $arrayExpdate[$z] <= $effectiveDate ){
                                        $totalStock2+=$arraySubstock[$z];
                                        }
                                    }
                    
                             for($x = 0 ; $x<count($arraySubname); $x++){
                                 if($arrayStat[$x] == "activated" && $arrayExpdate[$x] <= $effectiveDate){
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
                        
                            <tr>
                                <td><?php echo $arraySubname[$x] ; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td><?php echo $row['main_id'].".".$x+1; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td><?php echo $abs_diff; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td><?php echo $arrayCategory[$x]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td><?php echo $arrayExpdate[$x]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                            </tr>
                        <?php
                        }
                        }  
                        $sr++; endwhile;  ?> <!--End of Php -->
</table>
</div>


<!--for printing expiration med-->
<div id="for_print_act_cont">
<table id="for_print_hist" class="table_forPrint">
<th>Patient Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Issued By&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Date Issue&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>Medicine Information&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
<?php  //php for displaying all items
                        $sql_crit = "SELECT * FROM prescribemedhistory_tb"; 
                        $search_pendingApp_crit = filterTable_P5($sql_crit);
                        function filterTable_P5($sql_crit){  
                                    $con_crit=mysqli_connect('localhost','root','','robles_db');
                                    $filter_pendingAppCrit = mysqli_query($con_crit, $sql_crit);
                                    return $filter_pendingAppCrit; 
                                }
                                $sr = 0; 
                                while($row = mysqli_fetch_array($search_pendingApp_crit)):
                       ?>
                            <tr>
                                <td><?php echo $row['patient_name']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td><?php echo $row['issuedby']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td><?php echo $row['date']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td><?php echo $row['meds_name']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                            </tr>
                        <?php
                        $sr++; endwhile;  ?> <!--End of Php -->
</table>
</div>


</body>

</html>


<!-- Jquery for tooltips-->
<script src="jquery/tooltip.js"></script>
<!-- Jquery for termsAndprivacy-->
<script src="jquery/termsAndprivacy.js"></script>


<!-- Script for medicine page -->
<script src="js/medicinePage.js"></script>
<!-- Script for side navbar -->
<script src="js/sidenavbar_admin.js"></script>  
<!-- Jquery for adminAnim-->
<script src="jquery/adminAnim.js"></script>

<!-- Script for pdf -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

<!--ajax for logut-->
<script src="ajax/logoutAdmin.js"></script>
<!--ajax for add medicine -->
<script src="ajax/adminAddMedicine.js"></script>
<!--ajax for view medicine -->
<script src="ajax/adminEditViewMedicine.js"></script>



<script>
document.querySelector('.export_active_excel').addEventListener('click', function(){
    var table2excel = new Table2Excel();
    table2excel.export(document.querySelectorAll("#for_print_act"));
});

document.querySelector('.export_active_pdf').addEventListener("click", () => {
    const invoice = document.getElementById("for_print_act");

            var opt = {
                margin: 1,
                filename: 'ActiveMedicine.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait'}
            };
            html2pdf().from(invoice).set(opt).save();
 })

 document.querySelector('.export_inactive_excel').addEventListener('click', function(){
    var table2excel = new Table2Excel();
    table2excel.export(document.querySelectorAll("#for_print_inact"));
});


document.querySelector('.export_inactive_pdf').addEventListener("click", () => {
    const invoice = document.getElementById("for_print_inact");

            var opt = {
                margin: 1,
                filename: 'InctiveMedicine.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait'}
            };
            html2pdf().from(invoice).set(opt).save();
 })


document.querySelector('.export_critical_excel').addEventListener('click', function(){
    var table2excel = new Table2Excel();
    table2excel.export(document.querySelectorAll("#for_print_crit"));
});

document.querySelector('.export_critical_pdf').addEventListener("click", () => {
    const invoice = document.getElementById("for_print_crit");

            var opt = {
                margin: 1,
                filename: 'CriticalStocksMedicine.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait'}
            };
            html2pdf().from(invoice).set(opt).save();
})


document.querySelector('.export_exp_excel').addEventListener('click', function(){
    var table2excel = new Table2Excel();
    table2excel.export(document.querySelectorAll("#for_print_exp"));
});


document.querySelector('.export_exp_pdf').addEventListener("click", () => {
    const invoice = document.getElementById("for_print_exp");

            var opt = {
                margin: 1,
                filename: 'ExpirationMedicineReport.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'landscape'}
            };
            html2pdf().from(invoice).set(opt).save();
})


document.querySelector('.export_history_excel').addEventListener('click', function(){
    var table2excel = new Table2Excel();
    table2excel.export(document.querySelectorAll("#for_print_hist"));
});

document.querySelector('.export_history_pdf').addEventListener("click", () => {
    const invoice = document.getElementById("for_print_hist");

            var opt = {
                margin: 1,
                filename: 'PrescriptionHistory.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'landscape'}
            };
            html2pdf().from(invoice).set(opt).save();
})



function printDiv(divName) {
var printContents = document.getElementById(divName).innerHTML;
w = window.open();

w.document.write(printContents);
w.document.write('<scr' + 'ipt type="text/javascript">' + 'window.onload = function() { window.print(); window.close(); };' + '</sc' + 'ript>');

w.document.close(); // necessary for IE >= 10
w.focus(); // necessary for IE >= 10

return true;
}

function cancelPrescribemodal(){
    document.getElementById("medicineslip_container").style.display = "none";
}
</script>

