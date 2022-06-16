$(document).ready(function($){

    //email verifyer
    function validateEmail($email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailReg.test( $email );
      }


    // on submit...
    $('#ajax-form-mobile').submit(function(e){
    e.preventDefault();

    //name required
    var fname = $("input#fnameM").val();
    var lname = $("input#lnameM").val();
    var email = $("input#emailM").val();
    var question = $("textarea#questionM").val();

    if(fname == "" && lname == "" && email == "" && question == ""){
        $("#validation_inquiryM").css({
            visibility: "visible",
         }); 
         $('#validation_inquiryM').text('All fields are required!')
        return false;
    }

    if(fname == ""){
        $("#validation_inquiryM").css({
            visibility: "visible",
         }); 
         $('#validation_inquiryM').text('First Name is required!')
        return false;
    }
 
    if(lname == ""){
        $("#validation_inquiryM").css({
            visibility: "visible",
         }); 
         $('#validation_inquiryM').text('Last Name is required!')
        return false;
    }

    //email verifyer
    if( !validateEmail(email)) {    
        $("#validation_inquiryM").css({
            visibility: "visible",
         }); 
         $('#validation_inquiryM').text('Invalid Email!')
    return false;
    }
    // email required
    if(email == ""){
        $("#validation_inquiryM").css({
            visibility: "visible",
         }); 
         $('#validation_inquiryM').text('Email is required!')
    return false;
    }

   // question required
    if(question == ""){
        $("#validation_inquiryM").css({
            visibility: "visible",
         }); 
         $('#validation_inquiryM').text('You must have a question for us!')
    return false;
    }
    

    //to close sweet alert
    $("#close_alert_Mobile").click(function() {   
        $("#sweetalert_container_Mobile").css({
            display: "none",
        });  
        location.reload();
    });


// ajax
$.ajax({
    type:"POST",
    url: 'z-Ajax-Inquiry.php',
    data: $(this).serialize(), // get all form field value in serialize form
    success: function(){
        $("#validation_inquiryM").css({
            visibility: "hidden",
         }); 
        $("#sweetalert_container_Mobile").css({
            display: "flex",
        }); 
        $("#succes_alert_Mobile").animate({
            height: "50%",
            width: "85%",
        },100); 
        $("#succes_alert_Mobile").animate({
            height: "45%",
            width: "80%",
        },100); 
        $("#succes_alert_Mobile").animate({
            height: "50%",
            width: "85%",
        },100); 
    }
});
});  
return false;
});
