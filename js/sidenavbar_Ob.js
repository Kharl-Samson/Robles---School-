function minimize_navbar(){
    $(document).ready(function(){
        $("#logo_img").css({
            display: "none",
        }); 
        $("#burger_img").css({
            display: "block",
        }); 


        $("#right_bar").css({
            display: "none",
            width: "0%",
       }); 
        $(".left_bar1").css({
            justifyContent: "center",
        }); 
        $(".left_bar2").css({
            alignItems: "center",
        }); 
        $(".left_bar3").css({
            justifyContent: "center",
        }); 

        $("#profile_container").css({
            borderRadius: "10px",
            paddingLeft: "0%",
        }); 

        $("#logout_btn").css({
            display: "block",
        });       

        $(".right_content_dashboard").animate({
            width: "93%",
            marginLeft: "7%",
       },500); 
        
    });
}


function maximize_navbar(){
$(document).ready(function(){
    $("#logo_img").css({
        display: "block",
    }); 
    $("#burger_img").css({
        display: "none",
    }); 

    $("#right_bar").css({
        display: "block",
    }); 

    $("#right_bar").animate({
        width: "14vw",
   },500); 

   $(".left_bar1").css({
        justifyContent: "flex-end",
   }); 
   $(".left_bar2").css({
        alignItems: "flex-end",
   }); 
   $(".left_bar3").css({
        justifyContent: "flex-end",
   }); 

    $("#profile_container").css({
        borderRadius: "0px",
        paddingLeft: "5%",
        borderTopLeftRadius: "10px",
        borderBottomLeftRadius: "10px",
    }); 

    $("#logout_btn").css({
        display: "none",
    }); 

    $('.profile_right_cont').delay(500).queue(function (next) { 
        $(this).css('display', 'flex'); 
        next(); 
    });

    $(".right_content_dashboard").animate({
        width: "79%",
        marginLeft: "21%",
   },500); 
});
}



//hover
function hover_navbar(value_navhover){
document.querySelectorAll("."+value_navhover).forEach(st => {
    st.style.backgroundColor = "#a1c6cf";
    st.style.borderRadius = "0px"
  });
}

function mouseout_navbar(value_navhover){
document.querySelectorAll("."+value_navhover).forEach(st => {
    st.style.backgroundColor = "transparent";
  });  
}


//linking icons
function edit_profile(){
window.location.href = "doctorEditProfile.php";
};
function edit_password(){
window.location.href = "doctorEditPassword.php";
};
function profile(){
window.location.href = "doctorProfile.php";
};

document.getElementsByClassName("dash_navbar")[0].onclick = function() {
window.location.href = "doctorDashboard.php";
};
document.getElementsByClassName("dash_navbar")[1].onclick = function() {
window.location.href = "doctorDashboard.php";
};


document.getElementsByClassName("profile_navbar")[0].onclick = function() {
window.location.href = "doctorProfile.php";
};
document.getElementsByClassName("profile_navbar")[1].onclick = function() {
window.location.href = "doctorProfile.php";
};

document.getElementsByClassName("staff_navbar")[0].onclick = function() {
window.location.href = "doctorStaff.php";
};
document.getElementsByClassName("staff_navbar")[1].onclick = function() {
window.location.href = "doctorStaff.php";
};

document.getElementsByClassName("appointment_navbar")[0].onclick = function() {
window.location.href = "doctorAppointment.php";
};
document.getElementsByClassName("appointment_navbar")[1].onclick = function() {
window.location.href = "doctorAppointment.php";
};

document.getElementsByClassName("patient_navbar")[0].onclick = function() {
window.location.href = "doctorPatient.php";
};
document.getElementsByClassName("patient_navbar")[1].onclick = function() {
window.location.href = "doctorPatient.php";
};

document.getElementsByClassName("inventory_navbar")[0].onclick = function() {
window.location.href = "doctorMedicineInventory.php";
};
document.getElementsByClassName("inventory_navbar")[1].onclick = function() {
window.location.href = "doctorMedicineInventory.php";
};

document.getElementsByClassName("setting_navbar")[0].onclick = function() {
    window.location.href = "doctorSettings.php";
};
document.getElementsByClassName("setting_navbar")[1].onclick = function() {
    window.location.href = "doctorSettings.php";
};


//notif shower
document.getElementById("notification_container").onclick = function() {
    document.getElementById("for_notif_hide").style.display = "block"
    var valcount = document.getElementById("notif_count").innerHTML;
    document.getElementById("notif_bilang").innerHTML = valcount;
    document.getElementById("notif_img").src = "images/icons/dashboard/notification1.png"
};

document.getElementById("for_notif_hide").onclick = function() {
    document.getElementById("for_notif_hide").style.display = "none"
    document.getElementById("notif_img").src = "images/icons/dashboard/notification.png"
};



document.getElementsByClassName("notif_boxMidwife")[0].onclick = function() {
    window.location.href = "doctorMedicineInventory.php";
};
document.getElementsByClassName("notif_boxMidwife")[1].onclick = function() {
    window.location.href = "doctorMedicineInventory.php";
};