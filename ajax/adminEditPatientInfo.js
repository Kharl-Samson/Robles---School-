$(document).ready(function($){

    // on submit...
    $('#ajax-form_admin_editpatientIfnfo').submit(function(e){
    e.preventDefault();

    //name required
    var fname = $("input#fname").val();
    var lname = $("input#lname").val();
    var street = $("input#street").val();
    var bar = $("input#bar").val();
    var mun = $("input#mun").val();
    var prov = $("input#prov").val();
    var age = $("input#age").val();
    var weight = $("input#weight").val();
    var religion = $("input#religion").val();
    var bday = $("input#bday").val();
        
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    today = yyyy + '-' + mm + '-' + dd;
    


    if(fname === "" && lname === "" && street == "" && bar == "Select your option" && mun == "Select your option" && prov == "Select your option" && age === "" && weight === "" && religion === ""){
        document.getElementById("validation_admin_editPatientInfo").style.visibility = "visible"
        document.getElementById("adminEditPatientInfo_validation").innerHTML = "All fields are required!"
        return false;
    }
    if (fname === ""){
        document.getElementById("validation_admin_editPatientInfo").style.visibility = "visible"
        document.getElementById("adminEditPatientInfo_validation").innerHTML = "First name is required!"
        return false;
    }
    if (lname === ""){
        document.getElementById("validation_admin_editPatientInfo").style.visibility = "visible"
        document.getElementById("adminEditPatientInfo_validation").innerHTML = "Last name is required!"
        return false;
    }
    if (bar === ""){
        document.getElementById("validation_admin_editPatientInfo").style.visibility = "visible"
        document.getElementById("adminEditPatientInfo_validation").innerHTML = "Complete address are required!"
        return false;
    }
    if (mun === ""){
        document.getElementById("validation_admin_editPatientInfo").style.visibility = "visible"
        document.getElementById("adminEditPatientInfo_validation").innerHTML = "Complete address are required!"
        return false;
    }
    if (prov === ""){
        document.getElementById("validation_admin_editPatientInfo").style.visibility = "visible"
        document.getElementById("adminEditPatientInfo_validation").innerHTML = "Complete address are required!"
        return false;
    }
    if (religion === ""){
        document.getElementById("validation_admin_editPatientInfo").style.visibility = "visible"
        document.getElementById("adminEditPatientInfo_validation").innerHTML = "Religion is required!"
        return false;
    }
    if (age === ""){
        document.getElementById("validation_admin_editPatientInfo").style.visibility = "visible"
        document.getElementById("adminEditPatientInfo_validation").innerHTML = "Age is required!"
        return false;
    }
    if(bday > today){
        document.getElementById("validation_admin_editPatientInfo").style.visibility = "visible"
        document.getElementById("adminEditPatientInfo_validation").innerHTML ="You can't input birthday ahead of time!"
        return false;
    }
    if (age <= 10){
        document.getElementById("validation_admin_editPatientInfo").style.visibility = "visible"
        document.getElementById("adminEditPatientInfo_validation").innerHTML = "Patient age is too young!"
        return false;
    }
    if (age >= 150){
        document.getElementById("validation_admin_editPatientInfo").style.visibility = "visible"
        document.getElementById("adminEditPatientInfo_validation").innerHTML = "Patient age is too old"
        return false;
    }
    if (weight === ""){
        document.getElementById("validation_admin_editPatientInfo").style.visibility = "visible"
        document.getElementById("adminEditPatientInfo_validation").innerHTML = "Weight is required!"
        return false;
    }


// ajax
$.ajax({
    type:"POST",
    url: 'z-Ajax-AdminEditPatientInfo.php',
    data: $(this).serialize(), // get all form field value in serialize form
    success: function(response){
        if($.trim(response) == "success"){
            document.getElementById("sweetalert_container").style.display = "flex";
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
function removeborder_adminEditPatientInfo(){
    document.getElementById("validation_admin_editPatientInfo").style.visibility = "hidden";
}


//back to previous page
function backEditPatient(){
    window.history.back();
}

function close_alertadminEditPatientInfo(){
    document.getElementById("sweetalert_container").style.display = "none";
    location.reload();
}