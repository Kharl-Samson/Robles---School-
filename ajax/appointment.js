$(document).ready(function(){ 
       
    function validateEmail($email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailReg.test( $email );
    }

    $(document).on('submit', '#ajax-form-appointment', function(){

            var fname = $("input#firstname").val();
            var mname = $("input#middlename").val();
            var lname = $("input#lastname").val();
            var address = $("input#address").val();
            var contact = $("input#contact").val();
            var email = $("input#email").val();
            var date = $("input#sched_appointment_input1").val();
            var time = $("input#time_appointment_input1").val();
            var verification_email = $("input#verification_email").val();
         
             
            //phone number verifyer
            var phoneno = /^(09|\+639)\d{9}$/;

        if(fname === ""  && lname === "" && address === "" && contact === "" && email === "" && verification_email === "" ){
            document.getElementById("validation_error_form_app").style.visibility = "visible"
            document.getElementById("span_validation_error_form_app").innerHTML = "All fields are required!"

            document.getElementById("firstname").style.border = "1px solid red"
            document.getElementById("lastname").style.border = "1px solid red"
            document.getElementById("address").style.border = "1px solid red"
            document.getElementById("contact").style.border = "1px solid red"
            document.getElementById("email").style.border = "1px solid red"
            document.getElementById("verification_email").style.border = "1px solid red"
            return false;
        }
        else if(fname === ""){
            document.getElementById("validation_error_form_app").style.visibility = "visible"
            document.getElementById("span_validation_error_form_app").innerHTML = "First name is required!"
            document.getElementById("firstname").style.border = "1px solid red"
            return false;
        }
        else if(lname === ""){
            document.getElementById("validation_error_form_app").style.visibility = "visible"
            document.getElementById("span_validation_error_form_app").innerHTML = "Last name is required!"
            document.getElementById("lastname").style.border = "1px solid red"
            return false;
        }
        else if(address === ""){
            document.getElementById("validation_error_form_app").style.visibility = "visible"
            document.getElementById("span_validation_error_form_app").innerHTML = "Address is required!"
            document.getElementById("address").style.border = "1px solid red"
            return false;
        }
        else if(contact === ""){
            document.getElementById("validation_error_form_app").style.visibility = "visible"
            document.getElementById("span_validation_error_form_app").innerHTML = "Contact number is required!"
            document.getElementById("contact").style.border = "1px solid red"
            return false;
        }
        else if(email === ""){
            document.getElementById("validation_error_form_app").style.visibility = "visible"
            document.getElementById("span_validation_error_form_app").innerHTML = "Email is required!"
            document.getElementById("email").style.border = "1px solid red"
            return false;
        }
        else if(verification_email === ""){
        document.getElementById("validation_error_form_app").style.visibility = "visible"
        document.getElementById("span_validation_error_form_app").innerHTML = "Verification Code is Required"
        document.getElementById("verification_email").style.border = "1px solid red"
        return false;
        }
        else if (date === ""){
            alert("date is required")
            return false;
        }
        else if (time === ""){
            alert("time is required")
            return false;
        }
        else if( !validateEmail(email)) {    
            document.getElementById("validation_error_form_app").style.visibility = "visible"
            document.getElementById("span_validation_error_form_app").innerHTML = "Email is invalid!"
            document.getElementById("email").style.border = "1px solid red"
            return false;
        }
        else if(!contact.match(phoneno)){
            document.getElementById("validation_error_form_app").style.visibility = "visible"
            document.getElementById("span_validation_error_form_app").innerHTML = "Contact number is invalid!"
            document.getElementById("contact").style.border = "1px solid red"
            return false;
        }

        var data = $(this).serialize();
            $.ajax({
                type : 'POST',
                url  : 'z-Ajax-Appointment.php',
                data : data,
                success :  function(response){
                //alert(response)
                if($.trim(response) === "success"){
                // location.reload();
                $("#container_name").load(location.href+" #container_name>*","");
                $(".reload2").load(location.href+" .reload2>*","");
                $(".reload3").load(location.href+" .reload3>*","");
                $("#time_content").load(location.href+" #time_content>*","");
 
                
                document.getElementById("form_appointment").style.display = "none";
                 $("#newvalidation_Appointment").animate({
                     right: "2.5%",
                 },500)      
         
                 $("#text_validationHeader").text('Thank You!!');
                 $("#text_validationHeader").css({color: "#93C1F9"})
                 $("#newclose_validationAppoinment").css({color: "#93C1F9"})
                 $("#text_validationContent").text('Expect a feedback from us later, Kindly check your email in a few hours to see if your appointment is accepted.');
                 $("#validationAppointment_img").attr("src","images/gif/succes.gif");
         
                 setTimeout(function(){
                     //animation for edit profile
                     $("#newvalidation_Appointment").animate({
                         right: "-56%",
                     },500)    
                 }, 5000);
             }
             else if($.trim(response) === "email failed"){
                 document.getElementById("validation_error_form_app").style.visibility = "visible"
                 document.getElementById("span_validation_error_form_app").innerHTML = "The email you been using is already have an pending appointment. Wait for the clinic to review it!"
                 document.getElementById("email").style.border = "1px solid red"
             }
             else if($.trim(response) === "failed"){
                 document.getElementById("validation_error_form_app").style.visibility = "visible"
                 document.getElementById("span_validation_error_form_app").innerHTML = "The email you been using is already have an account. Login first to make an appointment!"
                 document.getElementById("email").style.border = "1px solid red"
             }
             else if($.trim(response) === "invalid code"){
                 document.getElementById("validation_error_form_app").style.visibility = "visible"
                 document.getElementById("span_validation_error_form_app").innerHTML = "Verification code is invalid"
                 document.getElementById("verification_email").style.border = "1px solid red"
             }
                    }
                });
                return false;
            });
            


            $(document).on('click', '#getCode', function(){
                var fname = $("input#firstname").val();
                var mname = $("input#middlename").val();
                var lname = $("input#lastname").val();
                var address = $("input#address").val();
                var contact = $("input#contact").val();
                var email = $("input#email").val();
                var date = $("input#sched_appointment_input1").val();
                var time = $("input#time_appointment_input1").val();
                var verification_email = $("input#verification_email").val();
             
                 
                //phone number verifyer
                var phoneno = /^(09|\+639)\d{9}$/;
    
            if(fname === ""  && lname === "" && address === "" && contact === "" && email === "" && verification_email === "" ){
                document.getElementById("validation_error_form_app").style.visibility = "visible"
                document.getElementById("span_validation_error_form_app").innerHTML = "All fields are required!"
    
                document.getElementById("firstname").style.border = "1px solid red"
                document.getElementById("lastname").style.border = "1px solid red"
                document.getElementById("address").style.border = "1px solid red"
                document.getElementById("contact").style.border = "1px solid red"
                document.getElementById("email").style.border = "1px solid red"
                document.getElementById("verification_email").style.border = "1px solid red"
                return false;
            }
            else if(fname === ""){
                document.getElementById("validation_error_form_app").style.visibility = "visible"
                document.getElementById("span_validation_error_form_app").innerHTML = "First name is required!"
                document.getElementById("firstname").style.border = "1px solid red"
                return false;
            }
            else if(lname === ""){
                document.getElementById("validation_error_form_app").style.visibility = "visible"
                document.getElementById("span_validation_error_form_app").innerHTML = "Last name is required!"
                document.getElementById("lastname").style.border = "1px solid red"
                return false;
            }
            else if(address === ""){
                document.getElementById("validation_error_form_app").style.visibility = "visible"
                document.getElementById("span_validation_error_form_app").innerHTML = "Address is required!"
                document.getElementById("address").style.border = "1px solid red"
                return false;
            }
            else if(contact === ""){
                document.getElementById("validation_error_form_app").style.visibility = "visible"
                document.getElementById("span_validation_error_form_app").innerHTML = "Contact number is required!"
                document.getElementById("contact").style.border = "1px solid red"
                return false;
            }
            else if(email === ""){
                document.getElementById("validation_error_form_app").style.visibility = "visible"
                document.getElementById("span_validation_error_form_app").innerHTML = "Email is required!"
                document.getElementById("email").style.border = "1px solid red"
                return false;
            }
            else if (date === ""){
                alert("date is required")
                return false;
            }
            else if (time === ""){
                alert("time is required")
                return false;
            }
            else if( !validateEmail(email)) {    
                document.getElementById("validation_error_form_app").style.visibility = "visible"
                document.getElementById("span_validation_error_form_app").innerHTML = "Email is invalid!"
                document.getElementById("email").style.border = "1px solid red"
                return false;
            }
            else if(!contact.match(phoneno)){
                document.getElementById("validation_error_form_app").style.visibility = "visible"
                document.getElementById("span_validation_error_form_app").innerHTML = "Contact number is invalid!"
                document.getElementById("contact").style.border = "1px solid red"
                return false;
            }
  
            
                var data1 = $("#ajax-form-appointment #email").serialize();
                //alert(data1);
                $.ajax({
                    type : 'POST',
                    url  : 'z-ajax-AppointmentGenerateCode.php',
                    data : data1,
                    beforeSend: function() {
                        document.getElementById("loading_succes").style.display = "flex";
                    },
                    success :  function(response){
                        //animation for edit profile
                        document.getElementById("loading_succes").style.display = "none";
                        $("#newvalidation_Appointment").animate({
                            right: "2.5%",
                        },500)      

                        $("#text_validationHeader").text('Email Sent!');
                        $("#text_validationHeader").css({color: "#93C1F9"})
                        $("#newclose_validationAppoinment").css({color: "#93C1F9"})
                        $("#text_validationContent").text('Kindly check your inbox to get the verification code!');
                        $("#validationAppointment_img").attr("src","images/gif/succes.gif");

                        setTimeout(function(){
                            //animation for edit profile
                            $("#newvalidation_Appointment").animate({
                                right: "-56%",
                            },500)    
                        }, 5000);
                    }
                    });
                    return false;
                });
         
 });



  
 function close_appointment(){
    document.getElementById("form_appointment").style.display = "none";
 }

   //close sweet alert
function close_alertAppoint(){
    $("#newvalidation_Appointment").animate({
        right: "-56%",
    },500)     
}