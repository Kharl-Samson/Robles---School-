$(document).ready(function($){

    //email verifyer
    function validateEmail($email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailReg.test( $email );
      }


    // on submit...
    $('#ajax-form').submit(function(e){
    e.preventDefault();

    //name required
    var fname = $("input#fname").val();
    var lname = $("input#lname").val();
    var email = $("input#email").val();
    var question = $("textarea#question").val();

    if(fname == "" && lname == "" && email == "" && question == ""){
        $("#validation_inquiry").css({
            visibility: "visible",
         }); 
         $('#validation_inquiry').text('All fields are required!')
        return false;
    }

    if(fname == ""){
        $("#validation_inquiry").css({
            visibility: "visible",
         }); 
         $('#validation_inquiry').text('First Name is required!')
        return false;
    }
 
    if(lname == ""){
        $("#validation_inquiry").css({
            visibility: "visible",
         }); 
         $('#validation_inquiry').text('Last Name is required!')
        return false;
    }

    //email verifyer
    if( !validateEmail(email)) {    
        $("#validation_inquiry").css({
            visibility: "visible",
         }); 
         $('#validation_inquiry').text('Invalid Email!')
    return false;
    }
    // email required
    if(email == ""){
        $("#validation_inquiry").css({
            visibility: "visible",
         }); 
         $('#validation_inquiry').text('Email is required!')
    return false;
    }

   // question number required
    if(question == ""){
        $("#validation_inquiry").css({
            visibility: "visible",
         }); 
         $('#validation_inquiry').text('You must have a question for us!')
    return false;
    }
    

    //to close sweet alert
    $("#close_alert").click(function() {   
        $("#sweetalert_container").css({
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
        $("#validation_inquiry").css({
            visibility: "hidden",
         }); 
        $("#sweetalert_container").css({
            display: "flex",
        }); 
        $("#succes_alert").animate({
            height: "50%",
            width: "35%",
        },100); 
        $("#succes_alert").animate({
            height: "45%",
            width: "30%",
        },100); 
        $("#succes_alert").animate({
            height: "50%",
            width: "35%",
        },100); 
    }
});
});  
return false;
});
