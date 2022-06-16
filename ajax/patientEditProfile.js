$(document).ready(function($){
    //email verifyer
    function validateEmail($email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailReg.test( $email );
      }


    // on submit...
    $('#ajax-form_patient_editprofile').submit(function(e){
    e.preventDefault();

    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    today = yyyy + '-' + mm + '-' + dd;


    //name required
    var fname = $("input#fname").val();
    var lname = $("input#lname").val();
    var bar = $("input#bar").val();
    var mun = $("input#mun").val();
    var prov = $("input#prov").val();
    var username = $("input#username").val();
    var phone = $("input#phone").val();
    var email = $("input#email").val();
    var bday = $("input#datepicker").val();
    var age = $("input#age_inp").val();

    if(fname === "" && lname === "" && bar === "" && bar === "" && mun === "" && prov === "" && username === "" && phone === "" && email === ""){
        document.getElementById("validation_admin_editProf").style.visibility = "visible";
        document.getElementById("adminEditProf_validation").innerHTML = "All fields are required!"

        document.getElementById("fname").style.border = "1px solid red";
        document.getElementById("lname").style.border = "1px solid red";
        document.getElementById("bar").style.border = "1px solid red";
        document.getElementById("mun").style.border = "1px solid red";
        document.getElementById("prov").style.border = "1px solid red";
        document.getElementById("username").style.border = "1px solid red";
        document.getElementById("phone").style.border = "1px solid red";
        document.getElementById("email").style.border = "1px solid red";
        return false;
    }
    if (fname === ""){
        document.getElementById("validation_admin_editProf").style.visibility = "visible";
        document.getElementById("adminEditProf_validation").innerHTML = "First name is required!"
        document.getElementById("fname").style.border = "1px solid red";
        return false;
    }
    if (lname === ""){
        document.getElementById("validation_admin_editProf").style.visibility = "visible";
        document.getElementById("adminEditProf_validation").innerHTML = "Last name is required!"
        document.getElementById("lname").style.border = "1px solid red";
        return false;
    }
    if (bar === ""){
        document.getElementById("validation_admin_editProf").style.visibility = "visible";
        document.getElementById("adminEditProf_validation").innerHTML = "Complete address is required!"
        document.getElementById("bar").style.border = "1px solid red";
        return false;
    }
    if (mun === ""){
        document.getElementById("validation_admin_editProf").style.visibility = "visible";
        document.getElementById("adminEditProf_validation").innerHTML = "Complete address is required!"
        document.getElementById("mun").style.border = "1px solid red";
        return false;
    }
    if (prov === ""){
        document.getElementById("validation_admin_editProf").style.visibility = "visible";
        document.getElementById("adminEditProf_validation").innerHTML = "Complete address is required!"
        document.getElementById("prov").style.border = "1px solid red";
        return false;
    }
    if (username === ""){
        document.getElementById("validation_admin_editProf").style.visibility = "visible";
        document.getElementById("adminEditProf_validation").innerHTML = "Username is required!"
        document.getElementById("username").style.border = "1px solid red";
        return false;
    }
    if (phone === ""){
        document.getElementById("validation_admin_editProf").style.visibility = "visible";
        document.getElementById("adminEditProf_validation").innerHTML = "Phone number is required!"
        document.getElementById("phone").style.border = "1px solid red";
        return false;
    }

    
    //phone number verifyer
    var phoneno = /^(09|\+639)\d{9}$/;
    if(!phone.match(phoneno)){
        document.getElementById("validation_admin_editProf").style.visibility = "visible";
        document.getElementById("adminEditProf_validation").innerHTML = "Phone number is invalid!"
        document.getElementById("phone").style.border = "1px solid red";
        return false;
    }

    //email verifyer
    if( !validateEmail(email)) {    
        document.getElementById("validation_admin_editProf").style.visibility = "visible";
        document.getElementById("adminEditProf_validation").innerHTML = "Email is invalid!"
        document.getElementById("email").style.border = "1px solid red";
        return false;
    }
    
    if (email === ""){
        document.getElementById("validation_admin_editProf").style.visibility = "visible";
        document.getElementById("adminEditProf_validation").innerHTML = "Email is required!"
        document.getElementById("email").style.border = "1px solid red";
        return false;
    }

    if (bday >= today){
        document.getElementById("validation_admin_editProf").style.visibility = "visible";
        document.getElementById("adminEditProf_validation").innerHTML = "Invalid Birthday date"
        document.getElementById("datepicker").style.border = "1px solid red";
        return false;
    }
    if (age <= 12){
        document.getElementById("validation_admin_editProf").style.visibility = "visible";
        document.getElementById("adminEditProf_validation").innerHTML = "Age is too young!"
        document.getElementById("datepicker").style.border = "1px solid red";
        return false;
    }
    if (age >= 100){
        document.getElementById("validation_admin_editProf").style.visibility = "visible";
        document.getElementById("adminEditProf_validation").innerHTML = "Age is too old!"
        document.getElementById("datepicker").style.border = "1px solid red";
        return false;
    }



// ajax
$.ajax({
    type:"POST",
    url: 'z-Ajax-PatientEditProfile.php',
    data: $(this).serialize(), // get all form field value in serialize form
    success: function(response){
        if($.trim(response) == "success"){
            document.getElementById("sweetalert_container").style.display = "flex";
            document.querySelector(".success_btn_alert").style.display = "block";
            document.querySelector(".close_btn_alert").style.display = "none";
     
            $('#gif_alert').attr('src','images/gif/succes.gif');
            $('.header_text_validation_appointment').text("Success!")
            $('.message_alert').text("Your profile information has been updated.")

            $('.header_text_validation_appointment').css({
                color: "#1ac8db",
            });
            $('#close_alert').css({
                backgroundColor: "#1ac8db",
            });
        }
        else if($.trim(response) == "username already exist"){
            document.getElementById("validation_admin_editProf").style.visibility = "visible";
            document.getElementById("adminEditProf_validation").innerHTML = "Username is already exist!"
            document.getElementById("username").style.border = "1px solid red";
            document.getElementById("sweetalert_container").style.display = "flex";
            document.querySelector(".success_btn_alert").style.display = "none";
            document.querySelector(".close_btn_alert").style.display = "block";

            $('#gif_alert').attr('src','images/gif/error_validation.gif');
            $('.header_text_validation_appointment').text("Error!")
            $('.message_alert').text("Sorry, the username you've been using is already existed. Try another email!")

            $('.header_text_validation_appointment').css({
                color: "red",
            });
            $('#close_alert').css({
                backgroundColor: "black",
            });
        }
        else if($.trim(response) == "email already exist"){
            document.getElementById("validation_admin_editProf").style.visibility = "visible";
            document.getElementById("adminEditProf_validation").innerHTML = "Email is already exist!"
            document.getElementById("email").style.border = "1px solid red";

            document.getElementById("sweetalert_container").style.display = "flex";
            document.querySelector(".success_btn_alert").style.display = "none";
            document.querySelector(".close_btn_alert").style.display = "block";

            $('#gif_alert').attr('src','images/gif/error_validation.gif');
            $('.header_text_validation_appointment').text("Error!")
            $('.message_alert').text("Sorry, the email you've been using is already existed. Try another email!")

            $('.header_text_validation_appointment').css({
                color: "red",
            });
            $('#close_alert').css({
                backgroundColor: "black",
            });
        }
        else if($.trim(response) == "failed"){
            alert("failed");
        }
    }
});
});  
return false;
});



//-------------------
function removeborder_adminEditProfile(val){
    document.getElementById(val).style.border = "1px solid rgb(206, 206, 206)";
    document.getElementById("validation_admin_editProf").style.visibility = "hidden";
}


//close alert
function close_alertadminEditProfile(){
    document.getElementById("sweetalert_container").style.display = "none";
}
function close_alertadminEditProfile_success(){
    location.reload();
}

//back to previous page
function back_adminEditProfile(){
    window.history.back();
}
