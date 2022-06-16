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
     <link rel="stylesheet" href="css/Desktop/Admin-adminInquiry.css">
  
     <link rel="shortcut icon" type="image/png" href="upload_img_generic/<?php echo $row_g['g_LogoDark']; ?>"> 

     <link rel="stylesheet" href="AnimBackend/jquery.css">
     <script src="AnimBackend/jquery.js"></script>
     <script src="AnimBackend/jquery1.js"></script>
     <script src="js/table2excel.js"></script>

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
                        <div id="icons_container" class="inventory_navbar"  onmouseover="hover_navbar('inventory_navbar')" onmouseout="mouseout_navbar('inventory_navbar')"><img src="images/icons/dashboard/inventory.png" title="Inventory"></div>
                        <div id="icons_container" class="appointment_navbar" onmouseover="hover_navbar('appointment_navbar')" onmouseout="mouseout_navbar('appointment_navbar')" ><img src="images/icons/dashboard/appointment.png" title="Appointment"></div>
                        <div id="icons_container" class="inquiry_navbar" style="background-color: #5B8DFF;"><img src="images/icons/dashboard/inquiries.png" title="Inquiries"></div>
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
                        <div id="icons_container" class="inventory_navbar" onmouseover="hover_navbar('inventory_navbar')" onmouseout="mouseout_navbar('inventory_navbar')" >Inventory</div>
                        <div id="icons_container" class="appointment_navbar"  onmouseover="hover_navbar('appointment_navbar')" onmouseout="mouseout_navbar('appointment_navbar')" >Appointment</div>
                        <div id="icons_container" class="inquiry_navbar" style="background-color: #5B8DFF;">Inquiries</div>
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
                <div id="dash_left">Inquiries</div>
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

            <?php
                require_once "Z-connection.php";
                $sqlcount = "SELECT COUNT(id) AS total From `inquiry_tb` where archive='off' ";
                $count=mysqli_query($conn, $sqlcount);
                $total_count = mysqli_fetch_assoc($count);
                $total= $total_count['total'];

                $sqlcount_deact = "SELECT COUNT(id) AS total From `inquiry_tb` where status='read' and archive='off' ";
                $count_deact=mysqli_query($conn, $sqlcount_deact);
                $total_count_deact = mysqli_fetch_assoc($count_deact);
                $total_deact= $total_count_deact['total'];

                $sqlcount_crits  = "SELECT COUNT(id) AS total From `inquiry_tb` where archive='on' ";
                $count_crit=mysqli_query($conn, $sqlcount_crits);
                $total_count_crit = mysqli_fetch_assoc($count_crit);
                $total_crit= $total_count_crit['total'];
            ?>

                <div id="top_dashboard_content">
                        <div id="left_top_dashboard_content">
                            <div class="appointment_choices" style="box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px; background-color: rgb(248, 248, 248);" id="Inq_inbox" onclick="go_Allmessage()">
                                <img src="images/icons/dashboard/read_inq.png" alt="">
                                All Inbox&nbsp;<span id="Inq_inbox_span">(<?php echo $total; ?>)</span>
                            </div>

                            <div class="appointment_choices" id="Inq_unread" onclick="go_Unreadmessage()">
                                <img src="images/icons/dashboard/unread_inq.png" alt="">
                                Read&nbsp;<span id="Inq_unread_span"> (<?php echo $total_deact; ?>)</span>
                            </div>

                            <div class="appointment_choices" id="Inq_archive" onclick="go_Archivemessage()">
                                <img src="images/icons/dashboard/archive_inq.png" alt="">
                                Archive&nbsp;<span id="Inq_archive_span">(<?php echo $total_crit; ?>)</span>
                            </div>
                        </div>
                </div><!-- End of top_dashboard_content -->

                <div id="semi_top_content">
                    <div id="check_box_top">
                        <div id="all_forRead" style="display:flex; width:15vh;">
                            <input type="checkbox" id="checkbox_allRead" onclick="validate_check_all_read()">
                            <span class="checkbox_text"></span>
                            All
                        </div>

                        <div id="all_forUnread" style="display:none; width:15vh;">
                            <input type="checkbox" id="checkbox_allUnread" onclick="validate_check_all_unread()">
                            <span class="checkbox_text"></span>
                            All
                        </div>

                        <div id="all_forArchive" style="display:none; width:15vh;">
                            <input type="checkbox" id="checkbox_allArchive" onclick="validate_check_all_archive()">
                            <span class="checkbox_text"></span>
                            All
                        </div>
                    </div>     

                    <div id="right">
                        <div class="choice_all" title="Reload" id="reload_inq_content">
                            <img src="images/icons/dashboard/reload_inq.png">
                        </div>
                        <div class="choice_all" title="Delete" onclick="show_deleteModal()">
                            <img src="images/icons/dashboard/delete_inq.png">    
                        </div>                         
                        <div class="choice_all" title="Archive" id="archive_all_btn" onclick="show_archiveModal()">
                            <img src="images/icons/dashboard/archive_inq.png">
                        </div>
                        <div class="choice_all" title="Unarchive" id="unarchive_all_btn" style="display:none;" onclick="show_unarchiveModal()">
                            <img src="images/icons/dashboard/unarchive_inq.png">
                        </div>
                    </div>
                </div><!-- End of semi_top_content -->

                <div id="inquiry_content">
                    <form action="javascript:void(0)" method="post" id="ajax-form_admin_archiveMessage">
                    
                    <!---------------------------------------------------------------------------------------------------------------->
                    <div id="read_inquiry">
                    <?php  //php for displaying all items
                        $sql = "SELECT * FROM inquiry_tb WHERE status='unread' and archive='off' ORDER BY id DESC;"; 
                        $inq_tb = filterinq($sql);
                        function filterinq($sql){  
                            $con=mysqli_connect('localhost','root','','robles_db');
                            $filter_inq = mysqli_query($con, $sql);
                            return $filter_inq; 
                            }
                        $sr1 = 0; 
                        while($row_inq = mysqli_fetch_array($inq_tb)): 
                    ?>  
                    <div id="each_messageR<?php echo $sr1; ?>" class="each_message em_read" onmouseover="hover_inq('<?php echo $sr1; ?>')" onmouseout="hoverout_inq('<?php echo $sr1; ?>')">
                        <div id="one">
                            <div id="l">
                            <input type="checkbox"  onclick="validate_check_all_eachRead('<?php echo $sr1; ?>')"  id="checkbox<?php echo $sr1; ?>" class="checkbox_all_eachRead1" name="each_cb[]" value="<?php echo $row_inq['id'];?>">
                            </div>
                            <div id="r"  onclick="view_inq('<?php echo $row_inq['id']; ?>')">
                            <p id="name_each"><?php echo $row_inq['fname']; ?></p>
                            <p id="msg_each"><?php echo $row_inq['question']; ?></p>
                            <p id="date_each"><?php echo $row_inq['date']; ?></p>
                            <p id="time_each" class="time_each<?php echo $sr1; ?>"><?php echo $row_inq['time']; ?></p>
                            </div>
                        </div>

                        <div id="two" class="hoverinc<?php echo $sr1; ?> hoverinc">
                            <div class="" title="Delete" onclick="delete_indivInqRead('<?php echo $sr1;?>')">
                                <img src="images/icons/dashboard/delete_inq.png" >    
                            </div>                         
                            <div class="" title="Archive" onclick="archive_indivInqRead('<?php echo $sr1;?>')">
                                <img src="images/icons/dashboard/archive_inq.png" >
                            </div>
                        </div>
                    </div>
                    <?php $sr1++; endwhile;  
                    ?>

                        <?php  //php for displaying all items
                        $sql = "SELECT * FROM inquiry_tb WHERE archive='off' and status='read'  ORDER BY id DESC;"; 
                        $inq_tb = filterinq1test($sql);
                        function filterinq1test($sql){  
                            $con=mysqli_connect('localhost','root','','robles_db');
                            $filter_inq = mysqli_query($con, $sql);
                            return $filter_inq; 
                            }
                        $sr = 0; 
                        while($row_inq = mysqli_fetch_array($inq_tb)): 
                    ?>  
                    <div id="each_messageU<?php echo $sr; ?>" class="each_message em_unread" onmouseover="hover_inq1('<?php echo $sr; ?>')" onmouseout="hoverout_inq1('<?php echo $sr; ?>')">
                        <div id="one">
                            <div id="l">
                            <input type="checkbox" onclick="validate_check_all_eachUnread('<?php echo $sr; ?>')"  id="checkboxU<?php echo $sr; ?>" class="checkbox_all_eachRead1" name="each_cb[]" value="<?php echo $row_inq['id'];?>">
                            </div>
                            <div id="r" onclick="view_inq('<?php echo $row_inq['id']; ?>')">
                            <p id="name_each" style="color: rgb(175, 175, 175);"><?php echo $row_inq['fname']; ?></p>
                            <p id="msg_each" style="color: rgb(175, 175, 175);"><?php echo $row_inq['question']; ?></p>
                            <p id="date_each" style="color: rgb(175, 175, 175);"><?php echo $row_inq['date']; ?></p>
                            <p id="time_each" style="color: rgb(175, 175, 175);" class="time_each1<?php echo $sr; ?>"><?php echo $row_inq['time']; ?></p>
                            </div>
                        </div>

                        <div id="two" class="hoverinc1<?php echo $sr; ?> hoverinc">
                            <div class="" title="Delete" onclick="delete_indivInqUnread('<?php echo $sr;?>')">
                                <img src="images/icons/dashboard/delete_inq.png" >    
                            </div>                         
                            <div class="" title="Archive" onclick="archive_indivInqUnread('<?php echo $sr;?>')">
                                <img src="images/icons/dashboard/archive_inq.png" >
                            </div>
                        </div>
                    </div>
                    <?php $sr++; endwhile;  
                    if($total == 0){
                    ?>
                    <div id="inbox_empty"><img src="images/icons/dashboard/inbox_empty.png">YOUR INBOX IS EMPTY</div>
                    <?php
                    }
                    ?>
                    </div>
                    <!---------------------------------------------------------------------------------------------------------------->


                    <!---------------------------------------------------------------------------------------------------------------->
                    <div id="unread_inquiry">
                    <?php  //php for displaying all items
                        $sql = "SELECT * FROM inquiry_tb WHERE archive='off' and status='read'  ORDER BY id DESC;"; 
                        $inq_tb = filterinq1($sql);
                        function filterinq1($sql){  
                            $con=mysqli_connect('localhost','root','','robles_db');
                            $filter_inq = mysqli_query($con, $sql);
                            return $filter_inq; 
                            }
                        $sr = 0; 
                        while($row_inq = mysqli_fetch_array($inq_tb)): 
                    ?>  
                    <div id="each_messageU<?php echo $sr; ?>" class="each_message em_unread" onmouseover="hover_inq('<?php echo $sr; ?>')" onmouseout="hoverout_inq('<?php echo $sr; ?>')">
                        <div id="one">
                            <div id="l">
                            <input type="checkbox" onclick="validate_check_all_eachUnread('<?php echo $sr; ?>')"  id="checkboxU<?php echo $sr; ?>" class="checkbox_all_eachUnread1" name="each_cb[]" value="<?php echo $row_inq['id'];?>">
                            </div>
                            <div id="r" onclick="view_inq('<?php echo $row_inq['id']; ?>')">
                            <p id="name_each" style="color: rgb(175, 175, 175);"><?php echo $row_inq['fname']; ?></p>
                            <p id="msg_each" style="color: rgb(175, 175, 175);"><?php echo $row_inq['question']; ?></p>
                            <p id="date_each" style="color: rgb(175, 175, 175);"><?php echo $row_inq['date']; ?></p>
                            <p id="time_each" style="color: rgb(175, 175, 175);" class="time_each<?php echo $sr; ?>"><?php echo $row_inq['time']; ?></p>
                            </div>
                        </div>

                        <div id="two" class="hoverinc<?php echo $sr; ?> hoverinc">
                            <div class="" title="Delete" onclick="delete_indivInqUnread('<?php echo $sr;?>')">
                                <img src="images/icons/dashboard/delete_inq.png" >    
                            </div>                         
                            <div class="" title="Archive" onclick="archive_indivInqUnread('<?php echo $sr;?>')">
                                <img src="images/icons/dashboard/archive_inq.png" >
                            </div>
                        </div>
                    </div>
                    <?php $sr++; endwhile;  
                    if($total_deact == 0){
                    ?>
                    <div id="inbox_empty"><img src="images/icons/dashboard/inbox_empty.png">YOUR INBOX IS EMPTY</div>
                    <?php
                    }
                    ?>
                    </div>
                    <!---------------------------------------------------------------------------------------------------------------->

                    <!---------------------------------------------------------------------------------------------------------------->
                    <div id="archive_inquiry">
                    <?php  //php for displaying all items
                        $sql = "SELECT * FROM inquiry_tb WHERE archive='on' ORDER BY id DESC;"; 
                        $inq_tb = filterinq2($sql);
                        function filterinq2($sql){  
                            $con=mysqli_connect('localhost','root','','robles_db');
                            $filter_inq = mysqli_query($con, $sql);
                            return $filter_inq; 
                            }
                        $sr2 = 0; 
                        while($row_inq = mysqli_fetch_array($inq_tb)): 
                    ?>  
                    <div id="each_messageA<?php echo $sr2; ?>" class="each_message em_archive" onmouseover="hover_inq('<?php echo $sr2; ?>')" onmouseout="hoverout_inq('<?php echo $sr2; ?>')">
                        <div id="one">
                            <div id="l">
                            <input type="checkbox"  onclick="validate_check_all_eachArchive('<?php echo $sr2; ?>')"  id="checkboxA<?php echo $sr2; ?>" class="checkbox_all_EachArchive1" name="each_cb[]" value="<?php echo $row_inq['id'];?>">
                            </div>
                            <div id="r"  onclick="view_inq('<?php echo $row_inq['id']; ?>')">
                            <p id="name_each"><?php echo $row_inq['fname']; ?></p>
                            <p id="msg_each"><?php echo $row_inq['question']; ?></p>
                            <p id="date_each"><?php echo $row_inq['date']; ?></p>
                            <p id="time_each" class="time_each<?php echo $sr2; ?>"><?php echo $row_inq['time']; ?></p>
                            </div>
                        </div>

                        <div id="two" class="hoverinc<?php echo $sr2; ?> hoverinc">
                            <div class="" title="Delete" onclick="delete_indivInqArchive('<?php echo $sr2;?>')">
                                <img src="images/icons/dashboard/delete_inq.png" >    
                            </div>                         
                            <div class="" title="Unrchive" onclick="archive_indivInqUnarchive('<?php echo $sr2;?>')">
                                <img src="images/icons/dashboard/unarchive_inq.png" >
                            </div>
                        </div>
                    </div>
                    <?php $sr2++; endwhile;  
                    if($total_crit == 0){
                    ?>
                    <div id="inbox_empty"><img src="images/icons/dashboard/inbox_empty.png">YOUR INBOX IS EMPTY </div>
                    <?php
                    }
                    ?>
                    </div>
                    <!---------------------------------------------------------------------------------------------------------------->

                    <!--Archive modal-->
                    <div id="archive_container">
                        <div id="deact_content">
                            <p>Do you want this message to move to archive?</p> 
                            <div id="accept_bot">
                                <button id="accept_no" type="button" onclick="close_archiveModal()">No</button>
                                <button id="accept_yes" type="submit"  onclick="archiveForm('z-Ajax-AdminArchiveInquiry.php')">Yes</button>
                            </div>
                        </div><!--End of deact_content-->
                    </div><!--End of archive_container"-->

                    <!--Delete modal-->
                    <div id="Delete_container">
                        <div id="deact_content">
                            <p>Do you want to delete this messages?</p> 
                            <div id="accept_bot">
                                <button id="accept_no" type="button" onclick="close_deleteModal()">No</button>
                                <button id="accept_yes" type="submit" onclick="deleteForm('z-Ajax-AdminDeleteInquiry.php')">Yes</button>
                            </div>
                        </div><!--End of deact_content-->
                    </div><!--End of archive_container"-->

                    <!--Unrchive modal-->
                    <div id="unarchive_container">
                        <div id="deact_content">
                            <p>Do you want this message to remove from archive?</p> 
                            <div id="accept_bot">
                                <button id="accept_no" type="button" onclick="close_unarchiveModal()">No</button>
                                <button id="accept_yes" type="submit" onclick="unarchiveForm('z-Ajax-AdminUnarchiveInquiry.php')">Yes</button>
                            </div>
                        </div><!--End of deact_content-->
                    </div><!--End of unarchive_container"-->


                    </form>
                </div><!--End of inquiry content-->

                <div id="reload_animation"><!--Reload animation-->
                    <div id="top">
                    <img src="images/gif/email.gif" alt="">
                    <div class="loading loading05">
                        <span>L</span>
                        <span>O</span>
                        <span>A</span>
                        <span>D</span>
                        <span>I</span>
                        <span>N</span>
                        <span>G</span>
                        <span>.</span>
                        <span>.</span>
                        <span>.</span>
                    </div>
                    </div>
                </div><!--End of Reload animation-->
                

                

            </div><!-- End of dashboard_content -->

    </div><!-- right_content_dashboard -->

</div> <!-- End of for_desktop div -->


<!--View Inquiry-->
<?php
$key_inquiry = $_SESSION['view_inq_key'];
$sql_inq1 = "SELECT * FROM `inquiry_tb` WHERE id='$key_inquiry' ";
$search_resultInq = filterInqs($sql_inq1);
function filterInqs($sql_inq1){  
$con=mysqli_connect('localhost','root','','robles_db');
$filter_Inq = mysqli_query($con, $sql_inq1);
return $filter_Inq; 
}
$row_Inqs = mysqli_fetch_array($search_resultInq);   
?>
<form action="javascript:void(0)" method="post" id="ajax-form-replyingInquiries">
<div id="View_inq_content">
    <div id="View_inq_box">
        <div id="top_close"><img src="images/icons/close.png" title="Close" onclick="close_messageInq()"></div>

        <div id="top_header_inq">
            <div id="left"><?php echo $row_Inqs['fname']." ".$row_Inqs['lname']; ?></div>
            <div id="right">
                <div id="timedate">
                    <img src="images/icons/dashboard/calendar_inq.png">
                    <?php echo $row_Inqs['date']." | ".$row_Inqs['time']; ?>
                </div>
            </div>
        </div><!--End of top_header_inq-->

        <div id="semitop_header_inq">
           <span style="color:black; font-weight:bold;">From :</span> <?php echo $row_Inqs['email']; ?>
        </div>

        <div id="message"><?php echo $row_Inqs['question']; ?></div>

        <center>
        <textarea id="question" class="input_two" placeholder="Type A Reply...." name="reply_inq"></textarea>
        <input type="hidden" value="<?php echo $row_Inqs['id']; ?>" name="id_inq">
        <input type="hidden" value="<?php echo $row_Inqs['email']; ?>" name="email_inq">
        <input type="hidden" value="<?php echo $row_Inqs['fname']." ".$row_Inqs['lname']; ?>" name="name_inq">
        <input type="hidden" value="<?php echo $row_Inqs['date']; ?>" name="date_inq">
        <input type="hidden" value="<?php echo $row_Inqs['time']; ?>" name="time_inq">
        <input type="hidden" value="<?php echo $row_Inqs['question']; ?>" name="question_inq">
        </center>

        <div id="bottom_inq"><Button type="submit" onclick="replyFormInq('z-Ajax-AdminReplyInquiries.php')">Send</Button></div>     
    </div>
</div>
</form>


<!--Sweetalert inq-->
<div id="sweetalert_container_inq">
    <div id="succes_alert">
        <div id="alert_div">
        <img src="images/gif/succes.gif" id="gif_alert">
        <p id="thankyou" class="header_text_validation_appointment">Success!</p>
        <p class="message_alert"></p>
        <button id="close_alert" class="close_btn_alert" onclick="close_alert_archModal()">OK</button>
        </div>
    </div>
</div>  


<div id="loading_succes">
        <div id="cont">
             <p>The information is processing....</p>
             <img src="images/gif/loading.gif" alt="">
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
<!-- Script for adminInquiry page -->
<script src="js/adminInquiry.js"></script>

<!--ajax for logut-->
<script src="ajax/logoutAdmin.js"></script>




<script>
    function validate_check_all_eachRead(key) {
    if (document.getElementById('checkbox'+key).checked == true) {
        document.getElementById("each_messageR"+key).style.backgroundColor = "#c2dbff";  
    } else {
        document.getElementById("each_messageR"+key).style.backgroundColor =  "#ffff";
        document.getElementById('checkbox_allRead').checked = false;
        document.getElementById('checkbox_allUnread').checked = false;
        document.getElementById('checkbox_allArchive').checked = false;
        document.querySelectorAll('checkbox'+key).forEach(st => {
        st.checked = false;
        });  
    }
    }

    function validate_check_all_eachUnread(key1) {
    if (document.getElementById('checkboxU'+key1).checked == true) {
        document.getElementById("each_messageU"+key1).style.backgroundColor = "#c2dbff";  
 
    } else {
        document.getElementById("each_messageU"+key1).style.backgroundColor =  "#ffff";
        document.getElementById('checkbox_allRead').checked = false;
        document.getElementById('checkbox_allUnread').checked = false;
        document.getElementById('checkbox_allArchive').checked = false;
        document.querySelectorAll('checkboxU'+key1).forEach(st => {
        st.checked = false;
        });  
    }
    }

    function validate_check_all_eachArchive(key2) {
    if (document.getElementById('checkboxA'+key2).checked == true) {
        document.getElementById("each_messageA"+key2).style.backgroundColor = "#c2dbff";  
 
    } else {
        document.getElementById("each_messageA"+key2).style.backgroundColor =  "#ffff";
        document.getElementById('checkbox_allRead').checked = false;
        document.getElementById('checkbox_allUnread').checked = false;
        document.getElementById('checkbox_allArchive').checked = false;
        document.querySelectorAll('checkboxA'+key2).forEach(st => {
        st.checked = false;
        });  
    }
    }
</script>


