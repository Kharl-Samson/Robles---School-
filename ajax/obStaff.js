$(document).ready(function($){
    // on submit...
    $('#ajax-form_ob_removeStaff').submit(function(e){
    e.preventDefault();

    // ajax
    $.ajax({
    type:"POST",
    url: 'z-Ajax-ObRemoveStaff.php',
    data: $(this).serialize(), // get all form field value in serialize form
    success: function(response){
        if($.trim(response) == "success"){
            document.getElementById("remove_container").style.display = "none";
            $(".table_active_employee").load(location.href+" .table_active_employee>*","");
            $("#validation_emp").css({
                display: "flex",
                borderLeft: "10px solid #93C1F9",
                })
                //animation for edit profile
                $("#validation_emp").animate({
                    right: "2.5%",
                },500)      
    
                $("#text_validationHeader").text('Success!');
                $("#text_validationHeader").css({color: "#93C1F9"})
                $("#close_validationmedicine").css({color: "#93C1F9"})
                $("#text_validationContent").text('Employee has been removed in your record');
                $("#validationEmp_img").attr("src","images/gif/succes.gif");
    
                setTimeout(function(){
                    //animation for edit profile
                    $("#validation_emp").animate({
                        right: "-56%",
                    },500)    
                }, 5000);
        }
        else{
            alert("failed")
        }
        }
    });
    

});  
return false;
});


function close_swalEmp(){
    $(document).ready(function($){
        $("#validation_emp").animate({
            right: "-56%",
        },500)    
    });
}



function addStaf(url){
    var data = $("#ajax-form_admin_addStaff").serialize();
    var time1 = $("input#time1").val();
    var time2 = $("input#time2").val();
    
    if($('#cb_date1').is(":checked")== false && $('#cb_date2').is(":checked")== false && $('#cb_date3').is(":checked")== false && $('#cb_date4').is(":checked")== false && $('#cb_date5').is(":checked")== false && $('#cb_date6').is(":checked")== false){
        $(".step4").animate({
            backgroundColor: "#ea5e62" 
        },500)
        document.getElementById("validation").style.visibility = "visible"
        document.getElementById("validation_span").innerHTML = "You must choose atleast one schedule!"
        document.querySelectorAll('.for_val_border').forEach(st => {
            st.style.border = "1px solid red"
        }); 
    }
    else if(time1 ==  "" || time2 == ""){
        $(".step4").animate({
            backgroundColor: "#ea5e62" 
        },500)
        document.getElementById("validation").style.visibility = "visible"
        document.getElementById("validation_span").innerHTML = "Time schedule are required!"
        document.querySelectorAll('.time_val').forEach(st => {
            st.style.border = "1px solid red"
        }); 
    }
    else{
        $.ajax({
            type : 'POST',
            url  : url,
            data : data,
            success :  function(response){
                if($.trim(response) == "success"){
                    document.getElementById("addEmp_container").style.display = "none";
                    $("#addEmp_container").load(location.href+" #addEmp_container>*","");
                    $(".table_active_employee").load(location.href+" .table_active_employee>*","");
                    $("#validation_emp").css({
                        display: "flex",
                        borderLeft: "10px solid #93C1F9",
                        })
                        //animation for edit profile
                        $("#validation_emp").animate({
                            right: "2.5%",
                        },500)      
            
                        $("#text_validationHeader").text('Success!');
                        $("#text_validationHeader").css({color: "#93C1F9"})
                        $("#close_validationEmp").css({color: "#93C1F9"})
                        $("#text_validationContent").text('Employee has been succesfully added!');
                        $("#validationEmp_img").attr("src","images/gif/succes.gif");
            
                        setTimeout(function(){
                            //animation for edit profile
                            $("#validation_emp").animate({
                                right: "-56%",
                            },500)    
                        }, 5000);
                }
                else{
                    $("#validation_emp").css({
                        display: "flex",
                        borderLeft: "10px solid #DB6F3D",
                        })
                        //animation for edit profile
                        $("#validation_emp").animate({
                            right: "2.5%",
                        },500)      
            
                        $("#text_validationHeader").text('Error!');
                        $("#text_validationHeader").css({color: "red"})
                        $("#close_validationEmp").css({color: "red"})
                        $("#text_validationContent").text('The email you been using is already exist. Please try another one!');
                        $("#validationEmp_img").attr("src","images/gif/serror_validation.gif");
            
                        setTimeout(function(){
                            //animation for edit profile
                            $("#validation_emp").animate({
                                right: "-56%",
                            },500)    
                        }, 5000);
                }
            }
        });
    }
}


//remove error sched
function removeErroSched(){
    var array = []
    var checkboxes = document.querySelectorAll('input[type=checkbox]:checked')
    for (var i = 0; i < checkboxes.length; i++) {
      array.push(checkboxes[i].value)
    }
    array = array.toString();
    
    document.getElementById("sched_input").value = array;

    $(".step4").animate({
        backgroundColor: "#97C3F9",
    },500)
    document.getElementById("validation").style.visibility = "hidden"
    document.getElementById("validation_span").innerHTML = ""
}



//edit sched ob
$(document).ready(function($){
    // on submit...
    $('#ajax-form_ob_Editsched').submit(function(e){
    e.preventDefault();
    var inp = $("input#key_sched_edit").val();
    if (inp === ""){
        document.getElementById("validation1").style.visibility = "visible"
        document.getElementById("validation_span1").innerHTML = "You must choose atleast one schedule!"
        return false;
    }
   
   
    // ajax
    $.ajax({
    type:"POST",
    url: 'z-Ajax-ObEditStaffSched.php',
    data: $(this).serialize(), // get all form field value in serialize form
    success: function(response){
        if($.trim(response) == "success"){
            $(".table_active_employee").load(location.href+" .table_active_employee>*","");
            $("#edit_container").load(location.href+" #edit_container>*","");   
            $('#edit_schedule').delay(500).queue(function (next) { 
                $(this).css('display', 'none'); 
                next(); 
            });
            $("#edit_container").animate({
                marginRight: "-150vh",
            },500)
            
            $("#validation_emp").css({
                display: "flex",
                borderLeft: "10px solid #93C1F9",
                })
                //animation for edit profile
                $("#validation_emp").animate({
                    right: "2.5%",
                },500)      
    
                $("#text_validationHeader").text('Success!');
                $("#text_validationHeader").css({color: "#93C1F9"})
                $("#close_validationmedicine").css({color: "#93C1F9"})
                $("#text_validationContent").text('Employee has been succesfully edited');
                $("#validationEmp_img").attr("src","images/gif/succes.gif");
    
                setTimeout(function(){
                    //animation for edit profile
                    $("#validation_emp").animate({
                        right: "-56%",
                    },500)    
                }, 5000);
        }
        else{
            alert("failed")
        }
        }
    });
    

});  
return false;
});