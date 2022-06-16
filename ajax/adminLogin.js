$(document).ready(function($){
    // on submit...
    $('#ajax-form_admin_login').submit(function(e){
    e.preventDefault();

    //name required
    var email = $("input#username_lA").val();
    var password = $("input#password_lA").val();


    if(email == "" && password == ""){
        document.querySelector('.validation_forAdminLogin').style.visibility="visible";
        document.querySelector('#username_lA').style.border="1px solid red";
        document.querySelector('#password_lA').style.border="1px solid red";
        $('.validation_forAdminLogin span').text('All fields are required!')
        return false;
    }
    else if(email == ""){
        document.querySelector('.validation_forAdminLogin').style.visibility="visible";
        $('.validation_forAdminLogin span').text('Username or Email are required!')
        document.querySelector('#username_lA').style.border="1px solid red";
        return false;
    }
    else if(password == ""){
        document.querySelector('.validation_forAdminLogin').style.visibility="visible";
        $('.validation_forAdminLogin span').text('Password is required!')
        document.querySelector('#password_lA').style.border="1px solid red";
        return false;
    }
    else{
        // ajax
        $.ajax({
            type:"POST",
            url:'z-Ajax-AdminLogin.php',
            data: $(this).serialize(), // get all form field value in serialize form
            success:function(response){
    
                    if($.trim(response) === "verified"){
                        window.location = "adminDashboard.php";
                        document.querySelector('#password_lA').style.border="1.5px solid #D1D1D1";
                        document.querySelector('#username_lA').style.border="1.5px solid #D1D1D1";
                    }
                    else if($.trim(response) === "verified1"){
                        window.location = "doctorDashboard.php";
                        document.querySelector('#password_lA').style.border="1.5px solid #D1D1D1";
                        document.querySelector('#username_lA').style.border="1.5px solid #D1D1D1";
                    }
                    else{
                        document.querySelector('.validation_forAdminLogin').style.visibility="visible";
                        $('.validation_forAdminLogin span').text('Invalid username or password!')
                    }
            }
        });
    }



});  
return false;
});



function removeValidationAdminLogin(){
    document.querySelector('.validation_forAdminLogin').style.visibility="hidden";
    document.querySelector('#password_lA').style.border="1.5px solid #D1D1D1";
    document.querySelector('#username_lA').style.border="1.5px solid #D1D1D1";
}


//admin recover password
$(document).ready(function($){
    // on submit...
    $('#ajax-form_admin_forgot').submit(function(e){
    e.preventDefault();

    //name required
    var email = $("input#recovery_email").val();

    if(email == ""){
        document.querySelector('#validationRecover').style.visibility="visible";
        $('#validationRecover span').text('Email or Username is required!')
        return false;
    }
    else{
        // ajax
        $.ajax({
            type:"POST",
            url:'z-Ajax-AdminRecoverPass.php',
            data: $(this).serialize(), // get all form field value in serialize form
            beforeSend: function() {
                document.getElementById("loading_succes").style.display = "flex";
            },
            success:function(response){
                if ($.trim(response) === "successMessage sent!"){
                    document.getElementById("loading_succes").style.display = "none";
                    document.getElementById("forgotPass_Container").style.display = "none";
                        $("#validation_forgotPass").css({
                        display: "flex",
                        borderLeft: "10px solid #93C1F9",
                        })
                        //animation for edit profile
                        $("#validation_forgotPass").animate({
                            right: "2.5%",
                        },500)      
            
                        $("#text_validationHeader").text('Success!');
                        $("#text_validationHeader").css({color: "#93C1F9"})
                        $("#close_validationPass").css({color: "#93C1F9"})
                        $("#text_validationContent").text('Your password recovery instruction will be sent to your email that you\'ve been using!');
                        $("#validationForgot_img").attr("src","images/gif/succes.gif");
            
                        setTimeout(function(){
                            //animation for edit profile
                            $("#validation_forgotPass").animate({
                                right: "-56%",
                            },500)    
                        }, 5000);
                }
                else{
                    setTimeout(function() { 
                        document.getElementById("loading_succes").style.display = "none";
                        document.querySelector('#validationRecover').style.visibility="visible";
                     $('#validationRecover span').text('Email or Username is not found!')
                    }, 1000);
                }
            }
        });
    }

});  
return false;
});



//patient recover password backend
$(document).ready(function($){
    // on submit...
    $('#ajax-form_admin_recoverBackend').submit(function(e){
    e.preventDefault();

    //name required
    var pass = $("input#password_l").val();
    var retypepass = $("input#password_l1").val();


    if(pass == "" || retypepass == ""){
        document.querySelector('.validation_forRecoverpass').style.visibility="visible";
        $('.validation_forRecoverpass span').text('All fields are required!')
        return false;
    }
    else if(pass !== retypepass){
        document.querySelector('.validation_forRecoverpass').style.visibility="visible";
        $('.validation_forRecoverpass span').text('Confirm new password doesn\'t match!')
        return false;
    }
    else if(pass.length <= 7){
        document.querySelector('.validation_forRecoverpass').style.visibility="visible";
        $('.validation_forRecoverpass span').text('Your password must have atleast 8 characters!')
        return false;
    }
    else{
        // ajax
        $.ajax({
            type:"POST",
            url:'z-Ajax-AdminRecoverPassBackend.php',
            data: $(this).serialize(), // get all form field value in serialize form
            success:function(response){
                    if($.trim(response) === "success"){
                        document.getElementById("sweetalert_container").style.display = "flex";
                    }
                    else{
                       alert("sql problem")
                    }
            }
        });
    }
});  
return false;
});


const rmCheck1 = document.getElementById("keep_logA"),
emailInput1 = document.getElementById("username_lA");
passInput1 = document.getElementById("password_lA");

if (localStorage.checkbox1 && localStorage.checkbox1 !== "") {
  rmCheck1.setAttribute("checked", "checked");
  emailInput1.value = localStorage.username1;
  passInput1.value = localStorage.password1;
} else {
  rmCheck1.removeAttribute("checked");
  emailInput1.value = "";
  passInput1.value = "";
}

function lsRememberMe1() {
  if (rmCheck1.checked && emailInput1.value !== "") {
    localStorage.username1 = emailInput1.value;
    localStorage.password1 = passInput1.value
    localStorage.checkbox1 = rmCheck1.value;
  } else {
    localStorage.username1 = "";
    localStorage.password1 = "";
    localStorage.checkbox1 = "";
  }
}

//close sweet alert
function close_alertForgot(){
    $("#validation_forgotPass").animate({
        right: "-56%",
    },500)     
}