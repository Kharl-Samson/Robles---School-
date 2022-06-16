<?php
session_start();
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
     <link rel="stylesheet" href="css/Desktop/Admin-dashboardAdmin.css">

  
     <link rel="shortcut icon" type="image/png" href="upload_img_generic/<?php echo $row_g['g_LogoDark']; ?>"> 

     <link rel="stylesheet" href="AnimBackend/jquery.css">
     <script src="AnimBackend/jquery.js"></script>
     <script src="AnimBackend/jquery1.js"></script>

  </head>

<body onload = "renderDate_dashboard()">

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
                        <div id="icons_container" style="background-color: #5B8DFF;" class="dash_navbar"><img src="images/icons/dashboard/dashboard.png" title="Dashboard"></div>
                        <div id="icons_container" class="profile_navbar" onmouseover="hover_navbar('profile_navbar')" onmouseout="mouseout_navbar('profile_navbar')"><img src="images/icons/dashboard/profile.png" title="Profile"></div>
                        <div id="icons_container" class="patient_navbar" onmouseover="hover_navbar('patient_navbar')" onmouseout="mouseout_navbar('patient_navbar')" ><img src="images/icons/dashboard/patient.png" title="Patient"></div>
                        <div id="icons_container" class="staff_navbar" onmouseover="hover_navbar('staff_navbar')" onmouseout="mouseout_navbar('staff_navbar')"><img src="images/icons/dashboard/staff.png" title="Staff"></div>
                        <div id="icons_container" class="inventory_navbar" onmouseover="hover_navbar('inventory_navbar')" onmouseout="mouseout_navbar('inventory_navbar')"><img src="images/icons/dashboard/inventory.png" title="Inventory"></div>
                        <div id="icons_container" class="appointment_navbar" onmouseover="hover_navbar('appointment_navbar')" onmouseout="mouseout_navbar('appointment_navbar')"><img src="images/icons/dashboard/appointment.png" title="Appointment"></div>
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
                        <div id="icons_container" class="dash_navbar" style="background-color: #5B8DFF;">Dashboard</div>
                        <div id="icons_container" class="profile_navbar" onmouseover="hover_navbar('profile_navbar')" onmouseout="mouseout_navbar('profile_navbar')">Profile</div>
                        <div id="icons_container" class="patient_navbar" onmouseover="hover_navbar('patient_navbar')" onmouseout="mouseout_navbar('patient_navbar')">Patient</div>
                        <div id="icons_container" class="staff_navbar" onmouseover="hover_navbar('staff_navbar')" onmouseout="mouseout_navbar('staff_navbar')">Staff</div>
                        <div id="icons_container" class="inventory_navbar" onmouseover="hover_navbar('inventory_navbar')" onmouseout="mouseout_navbar('inventory_navbar')">Inventory</div>
                        <div id="icons_container" class="appointment_navbar" onmouseover="hover_navbar('appointment_navbar')" onmouseout="mouseout_navbar('appointment_navbar')">Appointment</div>
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

    <div id="right" class="right_content_dashboard">
            <div id="dashboard_top">
                <div id="dash_left">Dashboard</div>
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
                    <div id="left">
                        <div id="layer1">
                            <p id="welcome">Welcome</p>
                            <p id="name"><?php echo $row['fname']." ".$row['lname'] ; ?></p>
                            <div id="line"></div>
                            <p id="quote1">To keep the body in a good health is a duty.. otherwise</p>
                            <p id="quote2">we shall not be able to keep our mind strong and clear.</p>
                        </div>
                        <?php
                                require_once "Z-connection.php";
                                $sqlcount = "SELECT COUNT(id) AS total From `patientinfo_db`";
                                $count=mysqli_query($conn, $sqlcount);
                                $total_count = mysqli_fetch_assoc($count);
                                $total_patient= $total_count['total'];

                                $sqlcount_appointment = "SELECT COUNT(id) AS total From `acceptedappointment_tb` where archive='off'";
                                $count_appointment=mysqli_query($conn, $sqlcount_appointment);
                                $total_countappointment = mysqli_fetch_assoc($count_appointment);
                                $total_appointment= $total_countappointment['total'];

                                $prev = date('Y-m-d',strtotime("-1 days"));
                                $curr = date('Y-m-d',);
                                $sqlnewPatient = "SELECT COUNT(id) AS total From `patientinfo_db` where date_added = '$prev' or date_added = '$curr' ";
                                $countNew=mysqli_query($conn, $sqlnewPatient);
                                $total_countNew = mysqli_fetch_assoc($countNew);
                                $total_New= $total_countNew['total'];
                        ?>

                        <div id="layer2">
                            <div id="box1" title="View appointments" class="view_appointment_dashboard">
                                <div id="left_box">
                                    <img src="images/icons/dashboard/appointments_icon.png" alt="">
                                </div>
                                <div id="right_box">
                                    <p id="count"><?php echo $total_appointment; ?></p>
                                    <p id="text_rbox">Appointments</p>
                                </div>
                            </div>

                            <div id="box2" title="View patients"  class="view_patient_dashboard">
                                <div id="left_box">
                                    <img src="images/icons/dashboard/total_patient_icon.png" alt="">
                                </div>
                                <div id="right_box">
                                    <div id="for_plus_patient">
                                        <p id="count"><?php echo $total_patient; ?></p>
                                        <div id="plus_container">
                                            <div>+<?php echo $total_New; ?></div>
                                        </div>
                                    </div>
                                    <p id="text_rbox">Total Patients</p>
                                </div>
                            </div>

                            <div id="box3" title="Open inventory" class="view_med_inventory_dashboard">
                                <div id="left_box">
                                    <img src="images/icons/dashboard/medicine.png" alt="">
                                </div>
                                <div id="right_box">
                                    <p>Medicine</p>
                                    <p>Inventory</p>
                                </div>
                            </div>

                        </div>

                        <div id="layer3">
                            <div id="today_duty">Today's Duty</div>
                            <div id="duty_container">
                          
                                    <table>                           
                                        <tr>
                                        <?php
                                         date_default_timezone_set('Asia/Manila');
                                         $date_today = date("l");  
                                          $con=mysqli_connect('localhost','root','','robles_db');
                                          $fetchQuerys ="SELECT * FROM staff_db  WHERE schedule LIKE '%$date_today%' and status='Active'";
                                          $result_todays_duty= mysqli_query($con, $fetchQuerys);  
                                          $ctr = 0;              
                                          while($row1 = mysqli_fetch_array($result_todays_duty)){
                                          ?>
                                            <td>
                                            <div class="emp_container">
                                                <div id="employee">
                                                    <img src="upload_img/<?php echo $row1['profile_photo']?>" onerror="this.src='upload_img/account.png'">
                                                    <p id="name"><?php echo $row1['fname']." ".$row1['lname']?></p>
                                                    <p id="role"><?php echo $row1['role']?></p>
                                                </div>
                                                <div id="time">
                                                    <img src="images/icons/dashboard/clock_icon.png">
                                                    <?php echo $row1['time']?>
                                                </div>
                                            </div>
                                            </td>
                                        <?php
                                        $ctr++;
                                        }
                                        if($ctr != 3){
                                        ?>
                                        <style>
                                            .right_content_dashboard #dashboard_content #left #duty_container{
                                                overflow-x:  scroll;
                                                overflow-y: hidden;
                                            }
                                            .right_content_dashboard #dashboard_content #left #duty_container table tr td{
                                                margin-right: 6vh;
                                                width: 29vh;
                                            }
                                            .right_content_dashboard #dashboard_content #left #duty_container .emp_container{
                                                height: 95%;
                                            }
                                        </style>
                                        <?php
                                        }
                                        ?>
                                        </tr>
                                    </table>
                            </div>
                        </div>
                    </div><!--End of left div-->

                    <div id="right">
                        <!-- Calendar -->
                        <div class="calendar_appointment">
                  
                            <div class="month_appointment">
                                <div id="header_calendar">
                                    <p id="month_appointment"></p>
                                    <p id="date_str_appointment"></p>
                                </div>
                                <div id="move_calendar">
                                    <div class="prev_appointment" onclick="moveDate_appointment('prev_appointment')">
                                        <span>&#10094;</span>
                                    </div>
                                    <div class="next_appointment" onclick="moveDate_appointment('next_appointment')">
                                        <span>&#10095;</span>
                                    </div>
                                </div>
                            </div>

                            <div class="weekdays_appointment">   
                                <div>Sun</div>     
                                <div>Mon</div>
                                <div>Tue</div>
                                <div>Wed</div>
                                <div>Thu</div>
                                <div>Fri</div>
                                <div>Sat</div>
                            </div>

                            <div class="days_appointment"></div>
                        </div><!--End Calendar -->

                        <div id="recent_container">
                            <div id="recent">Recent Patients</div>
                            <div id="container_patient">
                                <table id="table_cont_p">
                                    <tr>
                                        <?php
                                            $sql = "SELECT * FROM doctorreport_tb  order by date desc"; 
                                            $patientLog_tb = filterLog($sql);
                                            function filterLog($sql){  
                                                $con=mysqli_connect('localhost','root','','robles_db');
                                                $filter_log = mysqli_query($con, $sql);
                                                return $filter_log; 
                                            }
                                            $sr = 0; 
                                        while($row = mysqli_fetch_array($patientLog_tb)){ 
                                            if($sr<15){
                                        ?>
                                        <td>
                                            <div id="patient">
                                                <div id="left_patient">
                                                    <img src="upload_img/<?php echo $row['img']; ?>" onerror="this.src='upload_img/account.png'">
                                                </div>
                                                <div id="right_patient">
                                                    <p id="name_patient"><?php echo $row['name']; ?></p>
                                                    <p id="date_time"><span id="date"><?php echo $row['date']; ?></span> | <span id="time"><?php echo $row['time']; ?></span></p>
                                                </div>
                                                <div title="View Patient" onclick="viewPatient('<?php echo $row['patient_id']; ?>')" id="view_recent"><img src="images/icons/dashboard/view_blue.png">&nbsp;View</div>
                                            </div>
                                        </td>  
                                        <?php
                                                }
                                            $sr++; 
                                            } 
                                        ?>    
                                    </tr>
                                </table>

                                    <!--No Rerords-->
                                    <div id="no_dataVerifyer">
                                        <img src="images/icons/dashboard/no_data_found.png">
                                        NO RECORDS AVAILABLE
                                    </div>
                                    <script>
                                            var totalRowCount = $("#table_cont_p tr:first > td").length;
                                            if(totalRowCount === 0){                
                                                document.getElementById("no_dataVerifyer").style.display = "flex"
                                            }
                                     </script>

                            </div>
                        </div><!--End of recent_container-->

                    </div><!--End of right div-->


            </div><!-- End of dashboard_content -->

    </div><!-- right_content_dashboard -->

</div> <!-- End of for_desktop div -->

</body>

</html>


<!-- Jquery for tooltips-->
<script src="jquery/tooltip.js"></script>
<!-- Jquery for termsAndprivacy-->
<script src="jquery/termsAndprivacy.js"></script>


<!-- Script for side navbar -->
<script src="js/sidenavbar_admin.js"></script>

<!--ajax for logut-->
<script src="ajax/logoutAdmin.js"></script>

<!-- Ajax for making appointment -->
<script src="ajax/appointment.js"></script>
<!-- Ajax for view patient -->
<script src="ajax/adminEditViewPatient.js"></script>


<script>
    //for calendar in appointment
var dt = new Date();
function renderDate_dashboard() {
    dt.setDate(1);
    var day = dt.getDay();
    var today = new Date();
    var endDate = new Date(
        dt.getFullYear(),
        dt.getMonth() + 1,
        0
    ).getDate();

    var prevDate = new Date(
        dt.getFullYear(),
        dt.getMonth(),
        0
    ).getDate();
    var months = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December"
    ]

    document.getElementById("month_appointment").innerHTML = months[dt.getMonth()];
    document.getElementById("date_str_appointment").innerHTML = dt.getFullYear();
    var cells = "";
    for (x = day; x > 0; x--) {
        cells += "<div class='prev_date_appointment'>" + (prevDate - x + 1) + "</div>";
    }

    for (i = 1; i <= endDate; i++) {
        if (i == today.getDate() && dt.getMonth() == today.getMonth()) cells += "<div class='today_appointment'>" + i + "</div>";
        else
            cells += "<div id='day\"" + i + "\"'>" + i + "</div>";
    }
    document.getElementsByClassName("days_appointment")[0].innerHTML = cells;    
}

//moving the month in appointment calendar
function moveDate_appointment(para) {
    if(para == "prev_appointment") {
        dt.setMonth(dt.getMonth() - 1);
    } else if(para == 'next_appointment') {
        dt.setMonth(dt.getMonth() + 1);
    }
    renderDate_dashboard();
}


document.getElementsByClassName("view_appointment_dashboard")[0].onclick = function() {
    window.location.href = "adminAppointment.php";
};
document.getElementsByClassName("view_patient_dashboard")[0].onclick = function() {
    window.location.href = "adminPatient.php";
};
document.getElementsByClassName("view_med_inventory_dashboard")[0].onclick = function() {
    window.location.href = "adminMedicineInventory.php";
};
</script>