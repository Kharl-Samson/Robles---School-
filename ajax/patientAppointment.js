$(document).ready(function($){

    // on submit...
    $('#ajax-form-Patientappointment').submit(function(e){
    e.preventDefault();

    //input values
    var time = $("input#time_appointment_input").val();

    if (time === ""){
        $(".td_time_app").css({
            border: "1px solid red",
        })
        
        $("#validation_appointment").css({
            display: "flex",
            borderLeft: "10px solid #DB6F3D",
        })
        //animation for edit profile
        $("#validation_appointment").animate({
            right: "2.5%",
        },500)      

        $("#text_validationHeader").text('Error!');
        $("#text_validationHeader").css({color: "red"})
        $("#close_validationAppointment").css({color: "red"})
        $("#text_validationContent").text('You must select a time to make an appointment!');
        $("#validationAppointment_img").attr("src","images/gif/error_validation.gif");

        
        setTimeout(function(){
                //animation for edit profile
                $("#validation_appointment").animate({
                    right: "-56%",
                },500)    
        }, 5000);
        return false;
    }


// ajax
$.ajax({
    type:"GET",
    url: 'z-Ajax-PatientAppointment.php',
    data: $(this).serialize(), // get all form field value in serialize form
    success: function(response){

        if($.trim(response) === "success"){
            $(".making_appointment_form").load(".making_appointment_form > *");
            $('#form_App').delay(500).queue(function (next) { 
                $(this).css('display', 'none'); 
                next(); 
              });
            //animation for edit profile
            $("#form_content").animate({
                    marginRight: "-35%",
            },500)
                
    
                $("#validation_appointment").css({
                display: "flex",
                borderLeft: "10px solid #93C1F9",
                })
                //animation for edit profile
                $("#validation_appointment").animate({
                    right: "2.5%",
                },500)      
    
                $("#text_validationHeader").text('Thank You!');
                $("#text_validationHeader").css({color: "#93C1F9"})
                $("#close_validationAppointment").css({color: "#93C1F9"})
                $("#text_validationContent").text('Expect a feedback us later, Kindly check your email in a few to see if your appointment is accepted.');
                $("#validationAppointment_img").attr("src","images/gif/succes.gif");
    
                setTimeout(function(){
                    //animation for edit profile
                    $("#validation_appointment").animate({
                        right: "-56%",
                    },500)    
                }, 5000);
        }
        else if($.trim(response) === "failed"){
            $("#validation_appointment").css({
                display: "flex",
                borderLeft: "10px solid #DB6F3D",
            })
            //animation for edit profile
            $("#validation_appointment").animate({
                right: "2.5%",
            },500)      
            $("#text_validationHeader").text('Error!');
            $("#text_validationHeader").css({color: "red"})
            $("#close_validationAppointment").css({color: "red"})
            $("#text_validationContent").text('Sorry, you still have a pending appointment. Just wait for the admin to check it!');
            $("#validationAppointment_img").attr("src","images/gif/error_validation.gif");
    
            
            setTimeout(function(){
                    //animation for edit profile
                    $("#validation_appointment").animate({
                        right: "-56%",
                    },500)    
            }, 5000);
        }
        else if($.trim(response) === "failed1"){
            $("#validation_appointment").css({
                display: "flex",
                borderLeft: "10px solid #DB6F3D",
            })
            //animation for edit profile
            $("#validation_appointment").animate({
                right: "2.5%",
            },500)      
            $("#text_validationHeader").text('Error!');
            $("#text_validationHeader").css({color: "red"})
            $("#close_validationAppointment").css({color: "red"})
            $("#text_validationContent").text('Sorry, but you can\'t make a multiple appointment!');
            $("#validationAppointment_img").attr("src","images/gif/error_validation.gif");
    
            
            setTimeout(function(){
                    //animation for edit profile
                    $("#validation_appointment").animate({
                        right: "-56%",
                    },500)    
            }, 5000);
        }


    }
});
});  
return false;
});




//view history
function viewPatientHistory(date,doctor,staff,bp,diag,presc){
    document.getElementById("view_dateH").innerHTML = date;
    document.getElementById("view_doctorH").innerHTML = doctor;
    document.getElementById("view_dutyH").innerHTML = staff;
    document.getElementById("view_bpH").innerHTML = bp;
    document.getElementById("viewDiag_h").value= diag;
    document.getElementById("viewPres_h").value= presc;
    $(document).ready(function($){
        $("#show_history_content").css({
            display: "flex",
        })    
        $("#content_hist").animate({
            marginRight: "0%",
        },500)    
    });
}

function closePatientHistory(){
    $(document).ready(function($){
        $('#show_history_content').delay(500).queue(function (next) { 
            $(this).css('display', 'none'); 
            next(); 
        });
        $("#content_hist").animate({
            marginRight: "-100%",
        },500)    
    });
}