<?php
session_start();
date_default_timezone_set('Asia/Manila');
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
     <link rel="stylesheet" href="css/Desktop/Patient-patientStaff.css">

  
     <link rel="shortcut icon" type="image/png" href="upload_img_generic/<?php echo $row_g['g_LogoDark']; ?>"> 
     
     <link rel="stylesheet" href="AnimBackend/jquery.css">
     <script src="AnimBackend/jquery.js"></script>
     <script src="AnimBackend/jquery1.js"></script>

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
                        <div id="icons_container"  class="dash_navbar"  onmouseover="hover_navbar('dash_navbar')" onmouseout="mouseout_navbar('dash_navbar')"><img src="images/icons/dashboard/dashboard.png" title="Dashboard"></div>
                        <div id="icons_container" class="profile_navbar" onmouseover="hover_navbar('profile_navbar')" onmouseout="mouseout_navbar('profile_navbar')"><img src="images/icons/dashboard/profile.png" title="Profile"></div>
                        <div id="icons_container" class="staff_navbar" style="background-color: #5B8DFF;"><img src="images/icons/dashboard/staff.png" title="Staff"></div>
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
                        <div id="icons_container" class="dash_navbar"  onmouseover="hover_navbar('dash_navbar')" onmouseout="mouseout_navbar('dash_navbar')">Dashboard</div>
                        <div id="icons_container" class="profile_navbar" onmouseover="hover_navbar('profile_navbar')" onmouseout="mouseout_navbar('profile_navbar')">Profile</div>
                        <div id="icons_container" class="staff_navbar" style="background-color: #5B8DFF;">Staff</div>
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
                <div id="dash_left">Staff List</div>
                <div id="dash_right">
                    <?php  //php for displaying the hover icon 
                        $row = mysqli_fetch_array($search_resulthover);   
                    ?>
                    <div id="profile_container" title="Visit Profile" onclick="profile()">
                        <img src="upload_img/<?php echo $row['profile_photo']; ?>" id="profile_img" onerror="this.src='upload_img/account.png'">
                        <div id="name_profile">
                            <p id="name_text"><?php echo $row['fname']; ?></p>
                            <p id="role_text"><?php echo $row['role']; ?>Patient Account</p>
                        </div>
                    </div><!-- End of profile container -->
                </div>
            </div><!-- End of dashboard top -->

            <div id="dashboard_content">

                <div id="top_staff">
                    <div id="left">Employees</div>
                    <div id="right">
                        <p id="date"><?php echo date("F j, Y") ?></p>
                        <p id="time"><?php echo date("h:i A") ?></p>
                    </div>
                </div><!-- End of top staff -->

                <div id="content_staff">
                    <div id="header_staff">
                            <img src="images/icons/dashboard/employee_icon.png">
                            Employees Information
                    </div>

                    <div id="table_div">
                        <div id="top">
                            <div id="col1">Staff</div>
                            <div id="col2">Position</div>
                            <div id="col3">Email</div>
                            <div id="col4">Schedule</div>
                        </div>

                        <div id="row_table" class="container">

                                <?php  //php for displaying all items
                                $sql = "SELECT * FROM staff_db WHERE schedule!='Sunday' and status='Active'"; 
                                $staff_tb = filterStaff($sql);
                                function filterStaff($sql){  
                                    $con=mysqli_connect('localhost','root','','robles_db');
                                    $filter_pendingApp = mysqli_query($con, $sql);
                                    return $filter_pendingApp; 
                                    }
                                $sr = 0; 
                                while($row = mysqli_fetch_array($staff_tb)): 
                                ?>  
                            <div id="row" class="draggable" draggable="true">
                                <div id="col1">
                           
                                    <img src="upload_img/<?php echo $row['profile_photo']; ?>" id="staff_img" onclick="getPhoto('<?php echo $row['profile_photo']; ?>')" onerror="this.src='upload_img/account.png'">
                                    <div id="name">
                                        <p><?php echo $row['fname'].' '.$row['lname']; ?></p>
                                        <p id="age"><?php echo $row['age']; ?> years old</p>
                                    </div>
                                </div>
                                <div id="col2"><?php echo $row['role']; ?></div>
                                <div id="col3"><?php echo $row['email']; ?></div>
                                <div id="col4"><?php echo $row['schedule']; ?></div>
                            </div>

                                <?php
                                $sr++; endwhile;  ?> <!--End of Php -->
                        </div>

                    </div>
                </div>


            </div><!-- End of dashboard_content -->

    </div><!-- right_content_dashboard -->

</div> <!-- End of for_desktop div -->

<div id="img_enlarger_container" onclick="closePhoto()">
            <div id="img_cont">
                <img src="" id="enlarge_img">
                <div><img src="images/icons/close_white.png" title="Close" onclick="closePhoto()"></div>
            </div>     
</div>

</body>

</html>


<!-- Jquery for tooltips-->
<script src="jquery/tooltip.js"></script>
<!-- Jquery for termsAndprivacy-->
<script src="jquery/termsAndprivacy.js"></script>

<!-- Script for side navbar -->
<script src="js/sidenavbar_Patient.js"></script>
<!-- Script for drag table staff -->
<script src="js/dragSort_tableStaff.js"></script>

<!--ajax for logut-->
<script src="ajax/logoutAdmin.js"></script>

<!-- Ajax for making appointment -->
<script src="ajax/appointment.js"></script>







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

</script>

