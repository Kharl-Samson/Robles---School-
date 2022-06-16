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
    window.location.href = "patientEditProfile.php";
};
function edit_password(){
    window.location.href = "patientEditPassword.php";
};
function profile(){
    window.location.href = "patientProfile.php";
};



document.getElementsByClassName("dash_navbar")[0].onclick = function() {
    window.location.href = "patientDashboard.php";
};
document.getElementsByClassName("dash_navbar")[1].onclick = function() {
    window.location.href = "patientDashboard.php";
};


document.getElementsByClassName("profile_navbar")[0].onclick = function() {
    window.location.href = "patientProfile.php";
};
document.getElementsByClassName("profile_navbar")[1].onclick = function() {
    window.location.href = "patientProfile.php";
};

document.getElementsByClassName("staff_navbar")[0].onclick = function() {
    window.location.href = "patientStaff.php";
};
document.getElementsByClassName("staff_navbar")[1].onclick = function() {
    window.location.href = "patientStaff.php";
};

document.getElementsByClassName("appointment_navbar")[0].onclick = function() {
    window.location.href = "patientAppointment.php";
};
document.getElementsByClassName("appointment_navbar")[1].onclick = function() {
    window.location.href = "patientAppointment.php";
};
    
    