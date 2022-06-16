function validateEmail($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test( $email );
}

function nextStepM(url){
    var fname = $("input#firstnameM").val();
    var lname = $("input#lastnameM").val();
    var address = $("input#addressM").val();
    var contact = $("input#contactM").val();
    var email = $("input#emailM").val();

    var phoneno = /^(09|\+639)\d{9}$/;

    if(fname == ""){
         document.getElementById("validation_error_form_appMobile").style.visibility = "visible"
         document.getElementById("span_validation_error_form_appMobile").innerHTML="First name is required!"
    }
    else if(lname == ""){
        document.getElementById("validation_error_form_appMobile").style.visibility = "visible"
        document.getElementById("span_validation_error_form_appMobile").innerHTML="Last name is required!"
    }
    else if(address == ""){
        document.getElementById("validation_error_form_appMobile").style.visibility = "visible"
        document.getElementById("span_validation_error_form_appMobile").innerHTML="Address is required!"
    }
    else if(contact == ""){
        document.getElementById("validation_error_form_appMobile").style.visibility = "visible"
        document.getElementById("span_validation_error_form_appMobile").innerHTML="Contact number is required!"
    }
    else if(!contact.match(phoneno)){
        document.getElementById("validation_error_form_appMobile").style.visibility = "visible"
        document.getElementById("span_validation_error_form_appMobile").innerHTML="Contact number is invalid!"
    }
    else if(email == ""){
        document.getElementById("validation_error_form_appMobile").style.visibility = "visible"
        document.getElementById("span_validation_error_form_appMobile").innerHTML="Email is required!"
    }
    else if( !validateEmail(email)) {    
        document.getElementById("validation_error_form_appMobile").style.visibility = "visible"
        document.getElementById("span_validation_error_form_appMobile").innerHTML="Email is invalid!"
    }
    else if(fname !== "" || lname !== "" || address !== "" || contact !== "" || email !== ""){
        var data = $("#ajax-form-appointment-mobile").serialize();
        $.ajax({
            type : 'GET',
            url  : url,
            data : data,
            beforeSend: function() {
                document.getElementById("loading_succesM").style.display = "flex";
            },
            success :  function(response){
                document.getElementById("loading_succesM").style.display = "none";
                $("#email_verifyer").css({
                    display: "flex",
                })    
                $("#email_verifyer").animate({
                    left: "0%",
                },500)   
                document.getElementsByClassName("verf_email_class")[0].innerHTML = "Please enter the 6 digit code sent to "+email 
            }   
        });
    }
}



function resendCode(url){
        var data = $("#ajax-form-appointment-mobile").serialize();
        $.ajax({
            type : 'GET',
            url  : url,
            data : data,
            beforeSend: function() {
                document.getElementById("loading_succesM").style.display = "flex";
            },
            success :  function(response){
                document.getElementById("loading_succesM").style.display = "none"; 
                document.getElementsByClassName("inpCodem1")[0].value=""
                document.getElementsByClassName("inpCodem2")[0].value=""
                document.getElementsByClassName("inpCodem3")[0].value=""
                document.getElementsByClassName("inpCodem4")[0].value=""
                document.getElementsByClassName("inpCodem5")[0].value=""
                document.getElementsByClassName("inpCodem6")[0].value=""
            }   
        });
}

function sendCode(url){
    var data = $("#ajax-form-appointment-mobile").serialize();
    $.ajax({
        type : 'GET',
        url  : url,
        data : data,
        success :  function(response){
            if($.trim(response) === "success"){
                $("#email_verifyer").animate({
                    left: "-100%",
                },500)   
                $('#email_verifyer').delay(700).queue(function (next) { 
                    $(this).css('display', 'none'); 
                    next(); 
                });

                $("#calendarAndtime_container").css({
                    display: "flex",
                })   
             }
             else if($.trim(response) === "invalid code"){
                document.getElementById("sweetalert_container_Mobile").style.display = "flex";
                document.getElementById("gif_alertClass1").src="images/gif/error_validation.gif";
                document.querySelector(".header_text_validation_appointmentM1").innerHTML = "Error!"
                document.querySelector(".header_text_validation_appointmentM1").style.color = "red"
                document.querySelector("#message_alertM").innerHTML="Invalid Code!"
                document.getElementById("close_alert_Mobile").style.backgroundColor = "black"
             }
        }   
    });
}


function submitAppointment(url){
    var sched_appointment_inputM = $("input#sched_appointment_inputM").val();
    var time_appointment_inputM = $("input#time_appointment_inputM").val();

    if(sched_appointment_inputM === ""){
        document.getElementById("sweetalert_container_Mobile").style.display = "flex";
        document.getElementById("gif_alertClass1").src="images/gif/error_validation.gif";
        document.querySelector(".header_text_validation_appointmentM1").innerHTML = "Error!"
        document.querySelector(".header_text_validation_appointmentM1").style.color = "red"
        document.querySelector("#message_alertM").innerHTML="You must select a date to book an appointment!"
        document.getElementById("close_alert_Mobile").style.backgroundColor = "black"
    }
    else if(time_appointment_inputM === ""){
        document.getElementById("sweetalert_container_Mobile").style.display = "flex";
        document.getElementById("gif_alertClass1").src="images/gif/error_validation.gif";
        document.querySelector(".header_text_validation_appointmentM1").innerHTML = "Error!"
        document.querySelector(".header_text_validation_appointmentM1").style.color = "red"
        document.querySelector("#message_alertM").innerHTML="You must select a time to book an appointment!"
        document.getElementById("close_alert_Mobile").style.backgroundColor = "black"
    }
    else{
        var data = $("#ajax-form-appointment-mobile").serialize();
        $.ajax({
            type : 'GET',
            url  : url,
            data : data,
            success :  function(response){
                if($.trim(response) === "success"){
                    document.getElementById("sweetalert_container1").style.display = "flex";
                 }
                 else if(response === "email failed"){
                    document.getElementById("sweetalert_container_Mobile").style.display = "flex";
                    document.getElementById("gif_alertClass1").src="images/gif/error_validation.gif";
                    document.querySelector(".header_text_validation_appointmentM1").innerHTML = "Error!"
                    document.querySelector(".header_text_validation_appointmentM1").style.color = "red"
                    document.querySelector("#message_alertM").innerHTML="The email you been using is already have an pending appointment. Wait for the clinic to review it!"
                    document.getElementById("close_alert_Mobile").style.backgroundColor = "black"
                 }
                 else if($.trim(response) === "failed"){
                    document.getElementById("sweetalert_container_Mobile").style.display = "flex";
                    document.getElementById("gif_alertClass1").src="images/gif/error_validation.gif";
                    document.querySelector(".header_text_validation_appointmentM1").innerHTML = "Error!"
                    document.querySelector(".header_text_validation_appointmentM1").style.color = "red"
                    document.querySelector("#message_alertM").innerHTML="The email you been using is already have an account. Login first to make an appointment"
                    document.getElementById("close_alert_Mobile").style.backgroundColor = "black"
                 }
            }   
        });
    }
}

function closeSwal1(){
    location.reload();
}