$(document).ready(function($){

    //email verifyer
    function validateEmail($email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailReg.test( $email );
      }


    // on submit...
    $('#ajax-form_admin_addpatient').submit(function(e){
    e.preventDefault();

    //name required
    var fname = $("input#fname").val();
    var mname = $("input#mname").val();
    var lname = $("input#lname").val();
    var reg = $("input#reg").val();
    var street = $("input#street").val();
    var bar = $("input#bar").val();
    var mun = $("input#mun").val();
    var prov = $("input#prov").val();
    var age = $("input#age").val();
    var weight = $("input#weight").val();
    var religion = $("input#religion").val();
    var contact = $("input#contact").val();
    var email = $("input#email").val();  
    var bday = $("input#bday").val();  
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    today = yyyy + '-' + mm + '-' + dd;
    

    if(fname == ""  && lname == "" && street == "" && bar == "Select your option" && mun == "Select your option" && prov == "Select your option" && age == "" && weight == "" && religion == "" && contact == "" && email == ""){
        document.getElementById("validation_addpatient").style.visibility = "visible";
        document.getElementById("validation_addpatient_Text").innerHTML = "All fields are required!"
        return false;
    }
    if(fname == ""){
        document.getElementById("validation_addpatient").style.visibility = "visible";
        document.getElementById("validation_addpatient_Text").innerHTML = "First name is required!"
        return false;
    }
    if(lname == ""){
        document.getElementById("validation_addpatient").style.visibility = "visible";
        document.getElementById("validation_addpatient_Text").innerHTML = "Middle name is required!"
        return false;
    }
    if(bar == "Select your option" || mun == "Select your option" || prov == "Select your option"){
        document.getElementById("validation_addpatient").style.visibility = "visible";
        document.getElementById("validation_addpatient_Text").innerHTML = "Complete address are required!"
        return false;
    }
    if(weight == ""){
        document.getElementById("validation_addpatient").style.visibility = "visible";
        document.getElementById("validation_addpatient_Text").innerHTML = "Weight is required!"
        return false;
    }
    if(religion == ""){
        document.getElementById("validation_addpatient").style.visibility = "visible";
        document.getElementById("validation_addpatient_Text").innerHTML = "Religion is required!"
        return false;
    }
    if(contact == ""){
        document.getElementById("validation_addpatient").style.visibility = "visible";
        document.getElementById("validation_addpatient_Text").innerHTML = "Contact number is required!"
        return false;
    }
    if(email == ""){
        document.getElementById("validation_addpatient").style.visibility = "visible";
        document.getElementById("validation_addpatient_Text").innerHTML = "Email is required!"
        return false;
    }
    //email verifyer
    if( !validateEmail(email)) {    
        document.getElementById("validation_addpatient").style.visibility = "visible";
        document.getElementById("validation_addpatient_Text").innerHTML = "Invalid Email!"
        return false;
    }
    if(bday == ""){
        document.getElementById("validation_addpatient").style.visibility = "visible";
        document.getElementById("validation_addpatient_Text").innerHTML = "Birthday is required!"
        return false;
    }
    if(bday > today){
        document.getElementById("validation_addpatient").style.visibility = "visible";
        document.getElementById("validation_addpatient_Text").innerHTML = "You can't input birthday ahead of time!"
        return false;
    }
    if (age <= 10){
        document.getElementById("validation_addpatient").style.visibility = "visible";
        document.getElementById("validation_addpatient_Text").innerHTML = "Patient age is too young!"
        document.getElementById("datepicker").style.border = "1px solid red";
        return false;
    }
    if (age >= 150){
        document.getElementById("validation_addpatient").style.visibility = "visible";
        document.getElementById("validation_addpatient_Text").innerHTML = "Patient age is too old!"
        document.getElementById("datepicker").style.border = "1px solid red";
        return false;
    }
    //phone number verifyer
    var phoneno = /^(09|\+639)\d{9}$/;
    if(!contact.match(phoneno)){
        document.getElementById("validation_addpatient").style.visibility = "visible";
        document.getElementById("validation_addpatient_Text").innerHTML = "Invalid Contact Number!"
        return false;
    }



    var bplace= $(".bplace");
    for(var i = 0; i < bplace.length; i++){
        if($(bplace[i]).val() == ""){
            document.getElementById("validation_addpatient").style.visibility = "visible";
            document.getElementById("validation_addpatient_Text").innerHTML = "Child's birthplace are required!"
            return false;
        }
    }
    var weight_child = $(".child_weight");
    for(var x = 0; x < weight_child.length; x++){
        if($(weight_child[x]).val() == ""){
            document.getElementById("validation_addpatient").style.visibility = "visible";
            document.getElementById("validation_addpatient_Text").innerHTML = "Child's weight are required!"
            return false;
        }
    }

// ajax
$.ajax({
    type:"POST",
    url: 'z-Ajax-AdminAddPatient.php',
    data: $(this).serialize(), // get all form field value in serialize form
    success: function(response){
        if($.trim(response) === "success"){
            document.getElementById("sweetalert_container").style.display ="flex";
        }
        else if($.trim(response) === "failed"){
            document.getElementById("validation_addpatient").style.visibility = "visible";
            document.getElementById("validation_addpatient_Text").innerHTML = "Email already been used!"
        }
    }
});
});  
return false;
});


//hide validation
function hide_addpatientValidation(){
    document.getElementById("validation_addpatient").style.visibility = "hidden";
    document.getElementById("validation_addpatient_Text").innerHTML = "."
}

//close sweet alert success
function close_alertAddpatient(){
    document.getElementById("sweetalert_container").style.display ="none";
    location.reload();
}