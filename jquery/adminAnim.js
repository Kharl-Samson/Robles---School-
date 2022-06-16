$(document).ready(function(){

    //animation for profile
    $(".right_content_dashboard").animate({
            marginLeft: "21%",
    },800)

    //animation for edit profile
    $(".edit_basic_info").animate({
            marginTop: "0%",
    },800)
    

    //clicking hamburger menu
    $("#add_patient_btn").click(function() {   
        $("#table_patient_div").css({
            display: "none",
        })
        $("#input_container").css({
            display: "none",
        })
        $("#addpatient_div").css({
            display: "block",
        })    
        $("#addpatient_div").animate({
            marginTop: "1.5%",
        },800)
    });

});



function open_profile_photo_btn(){
    document.querySelectorAll('.btn_photo_profile').forEach(st => {
        st.style.display="block";
      });
}

function cancel_prof_btn(){
    var x = document.getElementById("key_profile_pic").value;
    document.getElementById("profile_photo").src = x;
    document.querySelectorAll('.btn_photo_profile').forEach(st => {
        st.style.display="none";
      });
}





//table hover appointment
function hover_table_pending_app(key_val){
document.querySelectorAll(".td_block"+key_val).forEach(st => {
    st.style.display="none";
});
document.getElementById("hover_table_pending"+key_val).style.display = "table-cell";
document.querySelectorAll("#reject_btn").forEach(st => {
    st.innerHTML = "Reject"
});
document.querySelectorAll("#accept_btn").forEach(st => {
    st.innerHTML = "Accept"
});
}

function close_table_pending_app(key_val){
document.querySelectorAll(".td_block"+key_val).forEach(st => {
    st.style.display="table-cell";
});
document.getElementById("hover_table_pending"+key_val).style.display = "none";
}



//table hover appointment
function hover_table_accept_app(key_val){
    document.querySelectorAll(".td_block1"+key_val).forEach(st => {
        st.style.display="none";
    });
    document.getElementById("hover_table_accepted"+key_val).style.display = "table-cell";
    document.querySelectorAll("#delete_btn").forEach(st => {
        st.innerHTML = "Remove"
    });
}

function close_table_accept_app(key_val){
    document.querySelectorAll(".td_block1"+key_val).forEach(st => {
        st.style.display="table-cell";
    });
    document.getElementById("hover_table_accepted"+key_val).style.display = "none";
}


//table hover appointment
function hover_table_report_doctor_app(key_val){
    document.querySelectorAll(".td_block1"+key_val).forEach(st => {
        st.style.display="none";
    });
    document.getElementById("hover_table_accepted"+key_val).style.display = "table-cell";
    document.querySelectorAll("#delete_btn").forEach(st => {
        st.innerHTML = "<img src='images/icons/close_white.png' style='height:2vh;margin-right:5%;'/> Archive"
    });
    document.querySelectorAll("#report_btn").forEach(st => {
        st.innerHTML  = "<img src='images/icons/dashboard/report.png' style='height:2vh;margin-right:5%;'/> Make Report"
    });
}


//show remove appoointment modal
function showRemoveApp_modal(key){
    document.getElementById("remove_container").style.display = "flex";
    document.getElementById("key_removeApp").value = key
}
    
function closeRemoveApp_modal(){
    document.getElementById("remove_container").style.display = "none";
    document.getElementById("key_removeApp").value = ""
}
    
    

//close add patient div
function close_addpatientdiv(){
    $(document).ready(function(){
        $("#table_patient_div").css({
            display: "block",
        })
        $("#input_container").css({
            display: "flex",
        })
        $("#addpatient_div").css({
            display: "none",
            marginTop: "100%",
        })    
    });
}




//hover active medicine table
function hover_table_medicine(key_val){
    document.querySelectorAll(".td_none"+key_val).forEach(st => {
        st.style.display="none";
    });
    document.getElementById("hover_table_medicine"+key_val).style.display = "table-cell";

    document.querySelectorAll("#view_med").forEach(st => {
        st.innerHTML  = "<img src='images/icons/dashboard/view_icon.png' /> View"
    });

    document.querySelectorAll("#edit_med").forEach(st => {
        st.innerHTML  = "<img src='images/icons/dashboard/edit_icon.png' /> Edit"
    });

    document.querySelectorAll("#deact_med").forEach(st => {
        st.innerHTML  = "<img src='images/icons/close_white.png' /> Deactivate"
    });
}

function close_table_medicine(key_val){
    document.querySelectorAll(".td_none"+key_val).forEach(st => {
        st.style.display="table-cell";
    });
    document.getElementById("hover_table_medicine"+key_val).style.display = "none";
}
    


//clicking add medicine button
function show_addmed(){
    $(document).ready(function(){
        $("#addmed_background").css({
            display: "flex",
        })
        $(".addmed_class").animate({
            marginRight: "0vh",
        },300)
    });
}
function close_addmed(){
    $(document).ready(function(){
        $('#addmed_background').delay(500).queue(function (next) { 
            $(this).css('display', 'none'); 
            next(); 
          });
        $(".addmed_class").animate({
            marginRight: "-70vh",
        },500)
    });
}



//clicking add issue medical certificate
function show_IssueMed(){
    $(document).ready(function(){
        $("#med_Cert_container").css({
            display: "flex",
        })
        $("#medcert_content").animate({
            marginRight: "0vh",
        },300)
    });
}

function close_IssueMed(){
    $(document).ready(function(){
        $('#med_Cert_container').delay(500).queue(function (next) { 
            $(this).css('display', 'none'); 
            next(); 
          });
        $("#medcert_content").animate({
            marginRight: "-70vh",
        },500)
    });
}

//issue medical certificate
function goIssueMedicalCertificate(){
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = mm + '/' + dd + '/' + yyyy;
        var gravida = document.getElementById("gravida").value;
        var parity = document.getElementById("parity").value;
        var diagnosis = document.getElementById("diagnosis").value;
        var procedure = document.getElementById("procedure").value;
        var recommendation = document.getElementById("recommendation").value;     
        
        var fname = document.getElementById("fnameI").innerHTML;
        var lname = document.getElementById("lnameI").innerHTML;
        var name = lname+" ,"+fname;
        var age = document.getElementById("ageI").innerHTML;
        var bar = document.getElementById("barI").innerHTML;
        var mun = document.getElementById("munI").innerHTML;
        var prov = document.getElementById("provI").innerHTML;
        var addr = bar+" ,"+mun+" ,"+prov

        if(gravida === "" || parity === "" || diagnosis === "" || procedure === "" || recommendation === "" ){  
            $("#validation_report").css({
                display: "flex",
                borderLeft: "10px solid #DB6F3D",
            })
            $("#validation_report").animate({
                right: "2.5%",
            },500)      
            $("#text_validationHeader").text('Error!');
            $("#text_validationHeader").css({color: "red"})
            $("#close_validationReport").css({color: "red"})
            $("#text_validationContent").text('You must complete all the fields to print this certificate');
            $("#validationReport_img").attr("src","images/gif/error_validation.gif");
    
            setTimeout(function(){
                $("#validation_report").animate({
                    right: "-56%",
                },500)    
            }, 5000);
        }
        else{
            $(document).ready(function(){
                $('#med_Cert_container').delay(0).queue(function (next) { 
                    $(this).css('display', 'none'); 
                    next(); 
                  });
                $("#medcert_content").animate({
                    marginRight: "-70vh",
                },0)
            });

            document.getElementById("medical_certificate").style.display = "flex";
            document.getElementById("i_name").innerHTML = name;
            document.getElementById("i_age").innerHTML = age;
            document.getElementById("i_gravida").innerHTML = gravida;
            document.getElementById("i_parity").innerHTML = parity;
            document.getElementById("i_add").innerHTML = addr;
            document.getElementById("i_date").innerHTML = today;
            document.getElementById("i_diagnosis").innerHTML = diagnosis;
            document.getElementById("i_procedure").innerHTML = procedure;
            document.getElementById("i_recco").innerHTML = recommendation;
            document.getElementById("date_cont").innerHTML = today;
        }
}
