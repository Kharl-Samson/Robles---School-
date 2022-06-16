$(document).ready(function($){
    // on submit...
    $('#ajax-form_Ob_makereport').submit(function(e){
    e.preventDefault();

    var bp = $("input#bp_report").val();
    var diagnostic = $("textarea#d_report").val();
    var date_report = $("input#date_report").val();

    if(date_report == ""){
        $("#date_report").css({
            border: "1px solid red",
        })     
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
        $("#text_validationContent").text('You must fill up the date field to make this report!');
        $("#validationReport_img").attr("src","images/gif/error_validation.gif");

        setTimeout(function(){
            $("#validation_report").animate({
                right: "-56%",
            },500)    
        }, 5000);
        return false;
    }
    if(bp == "" ){
        $("#bp_report").css({
            border: "1px solid red",
        })     
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
        $("#text_validationContent").text('You must fill up the blood pressure field to make this report!');
        $("#validationReport_img").attr("src","images/gif/error_validation.gif");

        setTimeout(function(){
            $("#validation_report").animate({
                right: "-56%",
            },500)    
        }, 5000);
        return false;
    }
    if(diagnostic == ""){
        $("#d_report").css({
            border: "1px solid red",
        })     
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
        $("#text_validationContent").text('You must fill up the diagnostic field to make this report!');
        $("#validationReport_img").attr("src","images/gif/error_validation.gif");

        setTimeout(function(){
            $("#validation_report").animate({
                right: "-56%",
            },500)    
        }, 5000);
        return false;
    }


// ajax
$.ajax({
    type:"POST",
    url: 'z-Ajax-ObMakeReport.php',
    data: $(this).serialize(), // get all form field value in serialize form
    success: function(response){
        if($.trim(response) == "success"){
                $("#report_content").load(location.href+" #report_content>*","");

                $("#validation_report").css({
                display: "flex",
                borderLeft: "10px solid #93C1F9",
                })
                //animation for edit profile
                $("#validation_report").animate({
                    right: "2.5%",
                },500)      
    
                $("#text_validationHeader").text('Success!');
                $("#text_validationHeader").css({color: "#93C1F9"})
                $("#close_validationReport").css({color: "#93C1F9"})
                $("#text_validationContent").text('This report is succesfully added!');
                $("#validationReport_img").attr("src","images/gif/succes.gif");
    
                setTimeout(function(){
                    //animation for edit profile
                    $("#validation_report").animate({
                        right: "-56%",
                    },500)    
                }, 5000);
        }
    }
});
});  
return false;
});

//close sweet alert
function close_alertReport(){
    $("#validation_report").animate({
        right: "-56%",
    },500)     
}

function removeValreport(key){
    document.getElementById(key).style.border = "1px solid rgb(206, 206, 206)";
}