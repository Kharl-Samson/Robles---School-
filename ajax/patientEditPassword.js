$(document).ready(function($){
    // on submit...
    $('#ajax-form_patient_editpassword').submit(function(e){
    e.preventDefault();

    //name required
    var oldp = $("input#old_pass").val();
    var newp = $("input#new_pass").val();
    var confirmp = $("input#confirm_pass").val();


    if(oldp === "" && newp === "" && confirmp === ""){
        document.getElementById("validation_password").style.visibility = "visible"
        document.getElementById("validation_password_text").innerHTML = "All fields are required!"
        document.querySelector('.old_password').style.border = "1px solid red"
        document.querySelector('.new_password').style.border = "1px solid red"
        document.querySelector('.confirm_password').style.border = "1px solid red"
        return false;
    }
    if (oldp === ""){
        document.getElementById("validation_password").style.visibility = "visible"
        document.getElementById("validation_password_text").innerHTML = "Old password is required!"
        document.querySelector('.old_password').style.border = "1px solid red"
        return false;
    }
    if (newp === ""){
        document.getElementById("validation_password").style.visibility = "visible"
        document.getElementById("validation_password_text").innerHTML = "New password is required!"
        document.querySelector('.new_password').style.border = "1px solid red"
        return false;
    }
    if (confirmp === ""){
        document.getElementById("validation_password").style.visibility = "visible"
        document.getElementById("validation_password_text").innerHTML = "Confirm password is required!"
        document.querySelector('.confirm_password').style.border = "1px solid red"
        return false;
    }
    if (oldp === newp){
        document.getElementById("validation_password").style.visibility = "visible"
        document.getElementById("validation_password_text").innerHTML = "Old password and New password are equal"
        document.querySelector('.confirm_password').style.border = "1px solid red"
        return false;
    }


    if(newp !== confirmp){
        document.getElementById("validation_password").style.visibility = "visible"
        document.getElementById("validation_password_text").innerHTML = "New password and confirm password doesn't match!"
        document.querySelector('.new_password').style.border = "1px solid red"
        document.querySelector('.confirm_password').style.border = "1px solid red"
        return false;
    }
    else if (newp.length <= 7){
        document.getElementById("validation_password").style.visibility = "visible"
        document.getElementById("validation_password_text").innerHTML = "Your password must have atleast 8 characters!"
        document.querySelector('.confirm_password').style.border = "1px solid red"
    }
    else{
        // ajax
        $.ajax({
        type:"POST",
        url: 'z-Ajax-PatientEditPassword.php',
        data: $(this).serialize(), // get all form field value in serialize form
        success: function(response){
            if($.trim(response) == "success"){
                document.getElementById("sweetalert_container").style.display = "flex";
            }
            else if($.trim(response) == "old pass wrong"){
                document.getElementById("validation_password").style.visibility = "visible"
                document.getElementById("validation_password_text").innerHTML = "Old password is wrong!"
                document.querySelector('.old_password').style.border = "1px solid red"
            }
            }
        });
    }

});  
return false;
});




//remove password input border
function remove_adminpassborder(val){
    document.querySelector("."+val).style.border = "1px solid rgb(206, 206, 206)"
    document.getElementById("validation_password").style.visibility = "hidden"
}

//close sweetalert
function close_alertpassword(){
    location.reload();
}