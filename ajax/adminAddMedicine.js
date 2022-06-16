$(document).ready(function($){

    // on submit...
    $('#ajax-form_admin_addmed').submit(function(e){
    e.preventDefault();


    //name required
    var med_name = $("input#med_name").val();
    var med_type = $("input#med_type").val();
    var med_dosage = $("input#med_dosage").val();
    var med_description = $("textarea#med_description").val();
    var med_stock = $("input#med_stock").val();
    var med_date = $("input#med_date").val();
    var man_date = $("input#man_date").val();
    var crit_Stocks = $("input#crit_Stocks").val();

    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    today = yyyy + '-' + mm + '-' + dd;


    if(med_name == "" && med_type == "" && med_description  == "" && man_date == "" && med_date == "" && med_dosage == "" && crit_Stocks == ""){
        $(".for_verf_add").css({
            border: "1px solid red",
        })     
        $("#validation_medicine").css({
            display: "flex",
            borderLeft: "10px solid #DB6F3D",
        })
        $("#validation_medicine").animate({
            right: "2.5%",
        },500)      
        $("#text_validationHeader").text('Error!');
        $("#text_validationHeader").css({color: "red"})
        $("#close_validationmedicine").css({color: "red"})
        $("#text_validationContent").text('You must fill up all the fields to add a medicine!');
        $("#validationAppointment_img").attr("src","images/gif/error_validation.gif");

        setTimeout(function(){
            $("#validation_medicine").animate({
                right: "-56%",
            },500)    
        }, 5000);
        return false;
    }
    if(med_name == ""){
        $("#med_name").css({
            border: "1px solid red",
        })     
        $("#validation_medicine").css({
            display: "flex",
            borderLeft: "10px solid #DB6F3D",
        })
        $("#validation_medicine").animate({
            right: "2.5%",
        },500)      
        $("#text_validationHeader").text('Error!');
        $("#text_validationHeader").css({color: "red"})
        $("#close_validationmedicine").css({color: "red"})
        $("#text_validationContent").text('The medicine name is required!');
        $("#validationAppointment_img").attr("src","images/gif/error_validation.gif");

        setTimeout(function(){
            $("#validation_medicine").animate({
                right: "-56%",
            },500)    
        }, 5000);
        return false;
    }
    if(med_type == ""){
        $("#med_type").css({
            border: "1px solid red",
        })     
        $("#validation_medicine").css({
            display: "flex",
            borderLeft: "10px solid #DB6F3D",
        })
        $("#validation_medicine").animate({
            right: "2.5%",
        },500)      
        $("#text_validationHeader").text('Error!');
        $("#text_validationHeader").css({color: "red"})
        $("#close_validationmedicine").css({color: "red"})
        $("#text_validationContent").text('The medicine brand is required!');
        $("#validationAppointment_img").attr("src","images/gif/error_validation.gif");

        setTimeout(function(){
            $("#validation_medicine").animate({
                right: "-56%",
            },500)    
        }, 5000);
        return false;
    }
    if(crit_Stocks == "" ){
        $("#crit_Stocks").css({
            border: "1px solid red",
        })     
        $("#validation_medicine").css({
            display: "flex",
            borderLeft: "10px solid #DB6F3D",
        })
        $("#validation_medicine").animate({
            right: "2.5%",
        },500)      
        $("#text_validationHeader").text('Error!');
        $("#text_validationHeader").css({color: "red"})
        $("#close_validationmedicine").css({color: "red"})
        $("#text_validationContent").text('You must set the critical stocks for this medicine!');
        $("#validationAppointment_img").attr("src","images/gif/error_validation.gif");

        setTimeout(function(){
            $("#validation_medicine").animate({
                right: "-56%",
            },500)    
        }, 5000);
        return false;
    }
    if(med_dosage == ""){
        $("#med_dosage").css({
            border: "1px solid red",
        })     
        $("#validation_medicine").css({
            display: "flex",
            borderLeft: "10px solid #DB6F3D",
        })
        $("#validation_medicine").animate({
            right: "2.5%",
        },500)      
        $("#text_validationHeader").text('Error!');
        $("#text_validationHeader").css({color: "red"})
        $("#close_validationmedicine").css({color: "red"})
        $("#text_validationContent").text('The medicine dosage is required!');
        $("#validationAppointment_img").attr("src","images/gif/error_validation.gif");

        setTimeout(function(){
            $("#validation_medicine").animate({
                right: "-56%",
            },500)    
        }, 5000);
        return false;
    }
    if(med_description == ""){
        $("#med_description").css({
            border: "1px solid red",
        })     
        $("#validation_medicine").css({
            display: "flex",
            borderLeft: "10px solid #DB6F3D",
        })
        $("#validation_medicine").animate({
            right: "2.5%",
        },500)      
        $("#text_validationHeader").text('Error!');
        $("#text_validationHeader").css({color: "red"})
        $("#close_validationmedicine").css({color: "red"})
        $("#text_validationContent").text('The medicine description is required!');
        $("#validationAppointment_img").attr("src","images/gif/error_validation.gif");

        setTimeout(function(){
            $("#validation_medicine").animate({
                right: "-56%",
            },500)    
        }, 5000);
        return false;
    }
    if(man_date == ""){
        $("#man_date").css({
            border: "1px solid red",
        })     
        $("#validation_medicine").css({
            display: "flex",
            borderLeft: "10px solid #DB6F3D",
        })
        $("#validation_medicine").animate({
            right: "2.5%",
        },500)      
        $("#text_validationHeader").text('Error!');
        $("#text_validationHeader").css({color: "red"})
        $("#close_validationmedicine").css({color: "red"})
        $("#text_validationContent").text('The medicine manufacturing date is required!');
        $("#validationAppointment_img").attr("src","images/gif/error_validation.gif");

        setTimeout(function(){
            $("#validation_medicine").animate({
                right: "-56%",
            },500)    
        }, 5000);
        return false;
    }
    if(man_date > today){
        $("#man_date").css({
            border: "1px solid red",
        })     
        $("#validation_medicine").css({
            display: "flex",
            borderLeft: "10px solid #DB6F3D",
        })
        $("#validation_medicine").animate({
            right: "2.5%",
        },500)      
        $("#text_validationHeader").text('Error!');
        $("#text_validationHeader").css({color: "red"})
        $("#close_validationmedicine").css({color: "red"})
        $("#text_validationContent").text('Sorry you can\'t select from future date!');
        $("#validationAppointment_img").attr("src","images/gif/error_validation.gif");

        setTimeout(function(){
            $("#validation_medicine").animate({
                right: "-56%",
            },500)    
        }, 5000);
          return false;
    }
    if(med_date == ""){
        $("#med_date").css({
            border: "1px solid red",
        })     
        $("#validation_medicine").css({
            display: "flex",
            borderLeft: "10px solid #DB6F3D",
        })
        $("#validation_medicine").animate({
            right: "2.5%",
        },500)      
        $("#text_validationHeader").text('Error!');
        $("#text_validationHeader").css({color: "red"})
        $("#close_validationmedicine").css({color: "red"})
        $("#text_validationContent").text('The medicine expiration date is required!');
        $("#validationAppointment_img").attr("src","images/gif/error_validation.gif");

        setTimeout(function(){
            $("#validation_medicine").animate({
                right: "-56%",
            },500)    
        }, 5000);
        return false;
    }
    if(med_date < today){
        $("#med_date").css({
            border: "1px solid red",
        })     
        $("#validation_medicine").css({
            display: "flex",
            borderLeft: "10px solid #DB6F3D",
        })
        $("#validation_medicine").animate({
            right: "2.5%",
        },500)      
        $("#text_validationHeader").text('Error!');
        $("#text_validationHeader").css({color: "red"})
        $("#close_validationmedicine").css({color: "red"})
        $("#text_validationContent").text('Sorry you can\'t select from previous date!');
        $("#validationAppointment_img").attr("src","images/gif/error_validation.gif");

        setTimeout(function(){
            $("#validation_medicine").animate({
                right: "-56%",
            },500)    
        }, 5000);
        return false;
    }
    if(med_stock == "0"){
        $("#med_stock").css({
            border: "1px solid red",
        })     
        $("#validation_medicine").css({
            display: "flex",
            borderLeft: "10px solid #DB6F3D",
        })
        $("#validation_medicine").animate({
            right: "2.5%",
        },500)      
        $("#text_validationHeader").text('Error!');
        $("#text_validationHeader").css({color: "red"})
        $("#close_validationmedicine").css({color: "red"})
        $("#text_validationContent").text('Medicine stocks must be greater than 0!');
        $("#validationAppointment_img").attr("src","images/gif/error_validation.gif");

        setTimeout(function(){
            $("#validation_medicine").animate({
                right: "-56%",
            },500)    
        }, 5000);
        return false;
    }
    



// ajax
$.ajax({
    type:"POST",
    url: 'z-Ajax-AdminAddMedicine.php',
    data: $(this).serialize(), // get all form field value in serialize form
    success: function(response){
        if($.trim(response) === "addTosameMed"){
            $("#med_cont_tb").load(location.href+" #med_cont_tb>*","");
            $("#deactmed_cont_tb").load(location.href+" #deactmed_cont_tb>*","");
            $("#critstockmed_cont_tb").load(location.href+" #critstockmed_cont_tb>*","");
            $("#expReport_cont_tb").load(location.href+" #expReport_cont_tb>*","");
            
            $("#activeMed_Count_span").load(window.location + " #activeMed_Count_span");
            $("#deactiveMed_Count_span").load(window.location + " #deactiveMed_Count_span");
            $("#critMed_Count_span").load(window.location + " #critMed_Count_span");
            $("#expDate_Count_span").load(window.location + " #expDate_Count_span");
                $('#addmed_background').delay(500).queue(function (next) { 
                    $(this).css('display', 'none'); 
                    next(); 
                  });
                $(".addmed_class").animate({
                    marginRight: "-70vh",
                },500)

                $("#validation_medicine").css({
                display: "flex",
                borderLeft: "10px solid #93C1F9",
                })
                //animation for edit profile
                $("#validation_medicine").animate({
                    right: "2.5%",
                },500)      
    
                $("#text_validationHeader").text('Success!');
                $("#text_validationHeader").css({color: "#93C1F9"})
                $("#close_validationmedicine").css({color: "#93C1F9"})
                $("#text_validationContent").text('The medicine has been add to the inventory');
                $("#validationAppointment_img").attr("src","images/gif/succes.gif");
    
                setTimeout(function(){
                    //animation for edit profile
                    $("#validation_medicine").animate({
                        right: "-56%",
                    },500)    
                }, 5000);
        }
        else if($.trim(response) === "addTodiffMed" ){
            $("#med_cont_tb").load(location.href+" #med_cont_tb>*","");
            $("#deactmed_cont_tb").load(location.href+" #deactmed_cont_tb>*","");
            $("#critstockmed_cont_tb").load(location.href+" #critstockmed_cont_tb>*","");
            $("#expReport_cont_tb").load(location.href+" #expReport_cont_tb>*","");
            
            $("#activeMed_Count_span").load(window.location + " #activeMed_Count_span");
            $("#deactiveMed_Count_span").load(window.location + " #deactiveMed_Count_span");
            $("#critMed_Count_span").load(window.location + " #critMed_Count_span");
            $("#expDate_Count_span").load(window.location + " #expDate_Count_span");
                $('#addmed_background').delay(500).queue(function (next) { 
                $(this).css('display', 'none'); 
                next(); 
                });
                 $(".addmed_class").animate({
                marginRight: "-70vh",
                },500)

                $("#validation_medicine").css({
                display: "flex",
                borderLeft: "10px solid #93C1F9",
                })
                //animation for edit profile
                $("#validation_medicine").animate({
                    right: "2.5%",
                },500)      
    
                $("#text_validationHeader").text('Success!');
                $("#text_validationHeader").css({color: "#93C1F9"})
                $("#close_validationmedicine").css({color: "#93C1F9"})
                $("#text_validationContent").text('The medicine has been add to the inventory');
                $("#validationAppointment_img").attr("src","images/gif/succes.gif");
    
                setTimeout(function(){
                    //animation for edit profile
                    $("#validation_medicine").animate({
                        right: "-56%",
                    },500)    
                }, 5000);
        }
        else if($.trim(response) === "addToOneMed" ){
            $("#med_cont_tb").load(location.href+" #med_cont_tb>*","");
            $("#deactmed_cont_tb").load(location.href+" #deactmed_cont_tb>*","");
            $("#critstockmed_cont_tb").load(location.href+" #critstockmed_cont_tb>*","");
            $("#expReport_cont_tb").load(location.href+" #expReport_cont_tb>*","");
            
            $("#activeMed_Count_span").load(window.location + " #activeMed_Count_span");
            $("#deactiveMed_Count_span").load(window.location + " #deactiveMed_Count_span");
            $("#critMed_Count_span").load(window.location + " #critMed_Count_span");
            $("#expDate_Count_span").load(window.location + " #expDate_Count_span");
                $('#addmed_background').delay(500).queue(function (next) { 
                $(this).css('display', 'none'); 
                next(); 
                });
                 $(".addmed_class").animate({
                marginRight: "-70vh",
                },500)

                $("#validation_medicine").css({
                display: "flex",
                borderLeft: "10px solid #93C1F9",
                })
                //animation for edit profile
                $("#validation_medicine").animate({
                    right: "2.5%",
                },500)      
    
                $("#text_validationHeader").text('Success!');
                $("#text_validationHeader").css({color: "#93C1F9"})
                $("#close_validationmedicine").css({color: "#93C1F9"})
                $("#text_validationContent").text('The medicine has been add to the inventory');
                $("#validationAppointment_img").attr("src","images/gif/succes.gif");
    

                setTimeout(function(){
                    //animation for edit profile
                    $("#validation_medicine").animate({
                        right: "-56%",
                    },500)    
                }, 5000);
        }
    }
});
});  
return false;
});


function add_medstock_input(){
    var x = document.getElementsByClassName("var_totalmed_stock")[0].innerHTML
    x++;
    if(x<=50){
        document.getElementsByClassName("var_totalmed_stock")[0].innerHTML = x;
        document.getElementById("med_stock").value = x;
    }
}
function decrease_medstock_input(){
    var x = document.getElementsByClassName("var_totalmed_stock")[0].innerHTML
    if(x>1){
        x--;
        document.getElementsByClassName("var_totalmed_stock")[0].innerHTML = x;
        document.getElementById("med_stock").value = x;
    }
}


//remove validation error add medicine
function remove_validation_addmed(valInp){
    document.getElementById(valInp).style.border ="1px solid rgb(206, 206, 206)"
}

//close sweet alert
function close_alertAddmed(){
    $("#validation_medicine").animate({
        right: "-56%",
    },500)     
}