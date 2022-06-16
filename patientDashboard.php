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
     <link rel="stylesheet" href="css/Desktop/Patient-dashboardPatient.css">

  
     <link rel="shortcut icon" type="image/png" href="upload_img_generic/<?php echo $row_g['g_LogoDark']; ?>"> 

     <link rel="stylesheet" href="AnimBackend/jquery.css">
     <script src="AnimBackend/jquery.js"></script>
     <script src="AnimBackend/jquery1.js"></script>
  </head>

<body onload = "renderDate_dashboard()">

<div class="for_desktop"><!--For Descktop div-->

    <div id="left" class="side_navbar"><!-- Left part-->
            <div id="left_bar">
                    <div id="logo_bar" class="left_bar1">
                        <img src="upload_img_generic/<?php echo $row_g['g_LogoLight']; ?>" id="logo_img">
                        <img src="images/icons/dashboard/hamburger_dashboard.png" id="burger_img" title="Maximize" onclick="maximize_navbar()">
                    </div>

                    <div id="icons_navbar" class="left_bar2"><!-- icons navbar container -->
                        <div id="icons_container" style="background-color: #5B8DFF;" class="dash_navbar"><img src="images/icons/dashboard/dashboard.png" title="Dashboard"></div>
                        <div id="icons_container" class="profile_navbar" onmouseover="hover_navbar('profile_navbar')" onmouseout="mouseout_navbar('profile_navbar')"><img src="images/icons/dashboard/profile.png" title="Profile"></div>
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
                        <div id="icons_container" class="dash_navbar" style="background-color: #5B8DFF;">Dashboard</div>
                        <div id="icons_container" class="profile_navbar" onmouseover="hover_navbar('profile_navbar')" onmouseout="mouseout_navbar('profile_navbar')">Profile</div>
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
                <div id="dash_left">Dashboard</div>
                <div id="dash_right">
                    <?php  //php for displaying the hover icon 
                        $row = mysqli_fetch_array($search_resulthover);   
                    ?>
                    <div id="profile_container" title="Visit Profile" onclick="profile()">
                        <img src="upload_img/<?php echo $row['profile_photo']; ?>" id="profile_img" onerror="this.src='upload_img/account.png'">
                        <div id="name_profile">
                            <p id="name_text"><?php echo $row['fname']; ?></p>
                            <p id="role_text">Patient Account</p>
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
                            <p id="quote1">Motherhood is the only place you can experience</p>
                            <p id="quote2">heaven and hell at the same time.</p>
                        </div>

                        <div id="layer2">
                                <div id="top">
                                    <div id="left_box" class="view_app_hist">
                                        <div id="l_part"><img src="images/icons/dashboard/my_appointments.png" alt=""></div>
                                        <div id="r_part">
                                            <p id="one">My Appointments</p>
                                            <p id="two">View Appoinntment History</p>
                                        </div>
                                    </div>
                                    <div id="right_box" class="book_my_app">
                                        <div id="l_part"><img src="images/icons/dashboard/book_appointment.png" alt=""></div>
                                        <div id="r_part">
                                            <p id="one">Book My Appointment</p>
                                            <p id="two">Make An Appointment</p>
                                        </div>
                                    </div>
                                </div>

                                <div id="bottom">
                                    <div id="left">Contact</div>
                                    <div id="right1">
                                        <div id="up">
                                            <div class="box_content"  id="box1_contentD">
                                                <img src="images/icons/dashboard/contact.png">
                                                <div>
                                                    <p><b>CONTACT</b></p>
                                                    <p style="margin-top:1%; font-size:1.7vh;"><?php echo $row['contact']; ?></p>
                                                </div>
                                            </div>
                                            <div class="box_content" id="box2_contentD">
                                                <img src="images/icons/dashboard/location.png">
                                                <div>
                                                    <p><b>ADDRESS</b></p>
                                                    <p style="margin-top:1%; font-size:1.7vh;"><?php echo $row['municipality'].', '.$row['province']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="down">
                                            <div class="box_content" id="box3_contentD">
                                                <img src="images/icons/dashboard/email.png">
                                                <div>
                                                    <p><b>USERNAME</b></p>
                                                    <p style="margin-top:1%; font-size:1.7vh;"><?php echo $row['username']; ?></p>
                                                </div>
                                            </div>
                                            <div class="box_content" id="box4_contentD">
                                                <img src="images/icons/dashboard/id.png">
                                                <div>
                                                    <p><b>PATIENT ID</b></p>
                                                    <p style="margin-top:1%; font-size:1.7vh;"><?php echo $row['id']; ?></p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
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
                            <div id="recent">Recent Checkups</div>
                            <div id="container_patient">
                                             
                        <?php
                            $patient_id = $row['id'];               
                            $sql = "SELECT * FROM doctorreport_tb  WHERE patient_id='$patient_id' order by date desc"; 
                            $patientLog_tb = filterLog($sql);
                            function filterLog($sql){  
                                $con=mysqli_connect('localhost','root','','robles_db');
                                $filter_log = mysqli_query($con, $sql);
                                return $filter_log; 
                            }
                            $sr = 0; 
                            while($row = mysqli_fetch_array($patientLog_tb)){ 
                                if($sr < 15){
                        ?>
                                <div class="box_recentC">
                                    <div id="bot">
                                        <div id="left"><img src="images/icons/dashboard/recent_appointment.png"></div>
                                        <div id="right1">
                                            <div id="top">
                                                <div title="View" onclick="viewRecent()"><img src="images/icons/dashboard/view_blue.png">&nbsp;View</div>
                                            </div>

                                            <div id="low">
                                                <p id="date">Date :</p>
                                                <p id="time"><?php echo $row['date']; ?> | <?php echo $row['time']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php
                                }
                           $sr++; 
                            } 
                        ?> 
              
                                    <!--No Rerords-->
                                    <div id="no_dataVerifyer">
                                        <img src="images/icons/dashboard/no_data_found.png">
                                        NO RECORDS AVAILABLE
                                    </div>
                                    <script>
                                            var totalRowCount = document.getElementById("container_patient").childElementCount;
                                            if(totalRowCount === 2){                
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
<!-- Jquery for patient anim-->
<script src="jquery/patientAnim.js"></script>

<!-- Script for side navbar -->
<script src="js/sidenavbar_Patient.js"></script>

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


document.getElementsByClassName("view_app_hist")[0].onclick = function() {
    window.location.href = "patientAppointment.php";
};
document.getElementsByClassName("book_my_app")[0].onclick = function() {
    window.location.href = "patientAppointment.php";
};
</script>