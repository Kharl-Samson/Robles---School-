function viewMed(id, name, category, brand, desc, mfg, exp, stock){
    document.getElementById("viewmed_background").style.display = "flex";
    $("#view_content").animate({
        marginRight: "0%",
    },500)  

    const monthNames = ["January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
    ];

    var d = new Date(mfg); 
    var date = d.getDate();
    var year = d.getFullYear();
    mfg =  monthNames[d.getMonth()]+" "+date+", "+year;

    var d1 = new Date(exp); 
    var date1 = d1.getDate();
    var year1 = d1.getFullYear();
    exp =  monthNames[d1.getMonth()]+" "+date1+", "+year1;

    document.getElementById("viewM_id").innerHTML = id;
    document.getElementById("viewM_name").innerHTML = name;
    document.getElementById("viewM_category").innerHTML =  category;
    document.getElementById("viewM_brand").innerHTML =  brand;
    document.getElementById("viewM_desc").innerHTML = desc;
    document.getElementById("viewM_mfg").innerHTML = mfg;
    document.getElementById("viewM_exp").innerHTML = exp;
    document.getElementById("viewM_stock").innerHTML = stock+" pcs.";
}


function closeMedicine(){
    $('#viewmed_background').delay(500).queue(function (next) { 
        $(this).css('display', 'none'); 
        next(); 
      });
    $("#view_content").animate({
        marginRight: "-50%",
    },500)  
}


var Edit_keyMed1 = "";
//show edit medicine
function editMedicine(mainId,id,name,brand,category,stock,desc,mfg,exp,subname,crit){
    document.getElementById("editmed_background").style.display = "flex";
    $("#editmed_content").animate({
        marginRight: "0%",
    },500)  

    var last2 = subname.slice(-2);
    Edit_keyMed1 = last2;
    var str = subname;
    var matches = str.match(/(\d+)/);  
    if (matches) {
        document.getElementById('med_dosage_edit').value = matches[0];
    }

    document.getElementById("mainId_edit").value = mainId;
    document.getElementById("key_edit_delete").value = id;
    document.getElementById("med_name_edit").value = name;
    document.getElementById("med_type_edit").value = brand;
    document.getElementById("dosage_edit").value = last2;
    document.querySelector(".med_category_edit").value = category;
    document.querySelector(".var_totalmed_stock_edit").innerHTML = stock;
    document.getElementById("med_stock_edit").value = stock;
    document.getElementById("med_description_edit").value = desc;
    document.getElementById("man_date_edit").value = mfg;
    document.getElementById("med_date_edit").value = exp;
    document.getElementById("crit_Stocks_edit").value = crit;
   
}

function add_medstock_input2(){
    var x = document.getElementsByClassName("var_totalmed_stock_edit")[0].innerHTML
    x++;
    if(x<=150){
        document.getElementsByClassName("var_totalmed_stock_edit")[0].innerHTML = x;
        document.getElementById("med_stock_edit").value = x;
    }
}

function decrease_medstock_input2(){
    var x = document.getElementsByClassName("var_totalmed_stock_edit")[0].innerHTML
    if(x>1){
        x--;
        document.getElementsByClassName("var_totalmed_stock_edit")[0].innerHTML = x;
        document.getElementById("med_stock_edit").value = x;
    }
}

function close_Editmed(){
    $('#editmed_background').delay(500).queue(function (next) { 
        $(this).css('display', 'none'); 
        next(); 
      });
    $("#editmed_content").animate({
        marginRight: "-50%",
    },500)  
}


//dosage med
function getTypeDosage1(){
    var selectD = document.getElementById("dosage_edit");
    var typeD = selectD.options[selectD.selectedIndex].text;
    Edit_keyMed1 = typeD;
}
function dosageMed1(){
    var numD = document.getElementById("med_dosage_edit").value
    document.getElementById("dosage_key_edit").value = numD+Edit_keyMed1;
}

setInterval(function(){ 
    dosageMed1();
}, 100);






//edit medicine backend
$(document).ready(function($){
    // on submit...
    $('#ajax-form_admin_Editmed').submit(function(e){
    e.preventDefault();

    //name required
    med_name_edit = $("input#med_name_edit").val();
    med_type_edit = $("input#med_type_edit").val();
    med_dosage_edit = $("input#med_dosage_edit").val();
    med_description_edit = $("textarea#med_description_edit").val();
    man_date_edit = $("input#man_date_edit").val();
    med_date_edit = $("input#med_date_edit").val();
    med_stock_edit = $("input#med_stock_edit").val();
    crit_Stocks_edit = $("input#crit_Stocks_edit").val();


    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    today = yyyy + '-' + mm + '-' + dd;


    if(med_name_edit == "" && med_type_edit == "" && med_description_edit  == ""  && man_date_edit == "" && med_date_edit == "" && med_dosage_edit == "" && crit_Stocks_edit == ""){
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
    if(med_name_edit == ""){
        $("#med_name_edit").css({
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
    if(med_type_edit == ""){
        $("#med_type_edit").css({
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
    if(med_dosage_edit == ""){
        $("#med_dosage_edit").css({
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
    if(crit_Stocks_edit == ""){
        $("#crit_Stocks_edit").css({
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
        $("#text_validationContent").text('You must set the medicine low stock status!');
        $("#validationAppointment_img").attr("src","images/gif/error_validation.gif");

        setTimeout(function(){
            $("#validation_medicine").animate({
                right: "-56%",
            },500)    
        }, 5000);
        return false;
    }
    if(med_description_edit == ""){
        $("#med_description_edit").css({
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
    if(man_date_edit == ""){
        $("#man_date_edit").css({
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
    if(man_date_edit > today){
        $("#man_date_edit").css({
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
    if(med_date_edit == ""){
        $("#med_date_edit").css({
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
    if(med_date_edit < today){
        $("#med_date_edit").css({
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
    if(med_stock_edit == "0"){
        $("#med_stock_edit").css({
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
    url: 'z-Ajax-AdminEditMedicineBackend.php',
    data: $(this).serialize(), // get all form field value in serialize form
    success: function(response){
        if($.trim(response) == "success"){
            $("#med_cont_tb").load(location.href+" #med_cont_tb>*","");
            $("#deactmed_cont_tb").load(location.href+" #deactmed_cont_tb>*","");
            $("#critstockmed_cont_tb").load(location.href+" #critstockmed_cont_tb>*","");
            $("#expReport_cont_tb").load(location.href+" #expReport_cont_tb>*","");
        
            $("#activeMed_Count_span").load(window.location + " #activeMed_Count_span");
            $("#deactiveMed_Count_span").load(window.location + " #deactiveMed_Count_span");
            $("#critMed_Count_span").load(window.location + " #critMed_Count_span");
            $("#expDate_Count_span").load(window.location + " #expDate_Count_span");

                $('#editmed_background').delay(500).queue(function (next) { 
                    $(this).css('display', 'none'); 
                    next(); 
                  });
                $("#editmed_content").animate({
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
                $("#text_validationContent").text('The medicine has edited succesfully!');
                $("#validationAppointment_img").attr("src","images/gif/succes.gif");
    
                setTimeout(function(){
                    //animation for edit profile
                    $("#validation_medicine").animate({
                        right: "-56%",
                    },500)    
                }, 5000);
        }
       // else{
         //   alert("failed");
        //}
    }
});
});  
return false;
});


//remove validation error edit medicine
function remove_validation_editmed(){
    document.getElementById("validation_editmedicine").style.visibility = "hidden"
    document.getElementById("validation_editmedicine_Text").innerHTML = "."
}

//close sweet alert edit med
function close_editmed_swal(){
    document.getElementById("sweetalert_container_edit").style.display = "none"
    $("#med_cont_tb").load(location.href+" #med_cont_tb>*","");
    $("#activeMed_Count_span").load(window.location + " #activeMed_Count_span");
    $("#deactiveMed_Count_span").load(window.location + " #deactiveMed_Count_span");
    $("#critMed_Count_span").load(window.location + " #critMed_Count_span");
    $("#expDate_Count_span").load(window.location + " #expDate_Count_span");
    
}


//deactivate medicne
function deactMedicine(deact_key,deact_key1){
    document.getElementById("deact_container").style.display = "flex";
    document.getElementById("key_medDeact").value = deact_key;
    document.getElementById("key_medDeactName").value = deact_key1;
}
function close_deactMedicine(){
    document.getElementById("deact_container").style.display = "none";
}



//deactivate medicine backend
$(document).ready(function($){
    // on submit...
    $('#ajax-form_admin_deactMedicine').submit(function(e){
    e.preventDefault();    
    var key_medDeact = $("input#key_medDeact").val();    
    if (key_medDeact == ""){
        alert("cant find medicine ID")
        return false;
    }    
    // ajax
    $.ajax({
        type:"POST",
        url: 'z-Ajax-AdminDeactivateMedicine.php',
        data: $(this).serialize(), // get all form field value in serialize form
        success: function(response){
            document.getElementById("deact_container").style.display = "none";
            $("#med_cont_tb").load(location.href+" #med_cont_tb>*","");
            $("#deactmed_cont_tb").load(location.href+" #deactmed_cont_tb>*","");
            $("#critstockmed_cont_tb").load(location.href+" #critstockmed_cont_tb>*","");
            $("#expReport_cont_tb").load(location.href+" #expReport_cont_tb>*","");

            $("#activeMed_Count_span").load(window.location + " #activeMed_Count_span");
            $("#deactiveMed_Count_span").load(window.location + " #deactiveMed_Count_span");
            $("#critMed_Count_span").load(window.location + " #critMed_Count_span");
            $("#expDate_Count_span").load(window.location + " #expDate_Count_span");
            $("#reloading_activeMed").load(window.location + " #reloading_activeMed");
        }
});
});  
return false;
});


//prescribe medicine
function prescribeMed(name, edit_delete, subname, substock, desc, cat){
    document.getElementById("prescribe_container").style.display = "flex";
    $("#prescribe_content").animate({
        marginRight: "0%",
    },600)  

    
    document.getElementById("main_nameP").value = subname;
    document.getElementById("type_pres").value = cat;
    
    arraySubname = subname.split(" ");
    document.getElementById("main_name_pres").value = name;
    document.getElementsByClassName("name_prescribe")[0].innerHTML = name;
    document.getElementsByClassName("dosage_prescribe")[0].innerHTML = arraySubname[arraySubname.length-1];
    document.getElementsByClassName("stock_prescribe")[0].innerHTML = substock+" pcs.";
    document.getElementsByClassName("desc_prescribe")[0].innerHTML = desc;
    document.getElementById("inp_stck_pres").value = substock;
    document.getElementById("inp_stck_subcont").value = substock;
    document.getElementById("edit_delete_pres").value = edit_delete;
}

var presc_count = 0;
function add_prescribe(){
    var pres_stck_count = document.getElementById("inp_stck_pres").value
    if(presc_count < pres_stck_count){
        presc_count++;
        document.getElementById("quant_box").innerHTML = presc_count;
        document.getElementById("actual_Stock").value = presc_count;
        document.getElementById("inp_stck_subcont").value = (pres_stck_count-presc_count);
        document.getElementsByClassName("stock_prescribe")[0].innerHTML = (pres_stck_count-presc_count)+" pcs.";
    }
}

function minus_prescribe(){
    var pres_stck_count = document.getElementById("inp_stck_pres").value
    if(presc_count > 0){
        presc_count--;
        document.getElementById("quant_box").innerHTML = presc_count;
        document.getElementById("actual_Stock").value = presc_count;
        document.getElementById("inp_stck_subcont").value = (pres_stck_count-presc_count);
        document.getElementsByClassName("stock_prescribe")[0].innerHTML = (pres_stck_count-presc_count)+" pcs.";
    }

}

function close_prescribeMed(){
    $('#prescribe_container').delay(500).queue(function (next) { 
        $(this).css('display', 'none'); 
        next(); 
      });
    $("#prescribe_content").animate({
        marginRight: "-50%",
    },500)  

    presc_count = 0
    document.getElementById("quant_box").innerHTML = 0;
}



function nextStepPrescribe(){
    stck= $("#quant_box").text();
    if(stck == 0){
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
        $("#text_validationContent").text('The medicine quantity must be greater than zero!');
        $("#validationAppointment_img").attr("src","images/gif/error_validation.gif");

        setTimeout(function(){
            $("#validation_medicine").animate({
                right: "-56%",
            },500)    
        }, 5000);
        return false;
    }
    else{
        document.getElementById("middle_content").style.display = "none";
        document.getElementById("next").style.display = "none";
        document.getElementById("close").style.display = "none";
        document.getElementById("middle_content1").style.display = "flex";
        document.getElementById("prescribe").style.display = "block";
        document.getElementById("back").style.display = "block";
    }
}
function backStepPrescribe(){
    document.getElementById("middle_content").style.display = "block";
    document.getElementById("next").style.display = "block";
    document.getElementById("close").style.display = "block";
    document.getElementById("middle_content1").style.display = "none";
    document.getElementById("prescribe").style.display = "none";
    document.getElementById("back").style.display = "none";
}

//prescribe medicine backend
$(document).ready(function($){
    // on submit...
    $('#ajax-form_admin_prescribeMedicine').submit(function(e){
    e.preventDefault();

    //name required
    stck= $("#quant_box").text();
    var pres_Pname = $("input#pres_Pname").val();    
    
 
    if(stck == 0){
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
        $("#text_validationContent").text('The medicine quantity must be greater than zero!');
        $("#validationAppointment_img").attr("src","images/gif/error_validation.gif");

        setTimeout(function(){
            $("#validation_medicine").animate({
                right: "-56%",
            },500)    
        }, 5000);
        return false;
    }
    else if(pres_Pname === ""){
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
        $("#text_validationContent").text('Patient name is required!');
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
    url: 'z-Ajax-AdminPrescribeMedicine.php',
    data: $(this).serialize(), // get all form field value in serialize form
    success: function(response){
        if($.trim(response) == "success"){
            presc_count = 0
            document.getElementById("quant_box").innerHTML = 0;
            $("#prescribe_container").load(location.href+" #prescribe_container>*","");

            $("#med_cont_tb").load(location.href+" #med_cont_tb>*","");
            $("#deactmed_cont_tb").load(location.href+" #deactmed_cont_tb>*","");
            $("#critstockmed_cont_tb").load(location.href+" #critstockmed_cont_tb>*","");
            $("#expReport_cont_tb").load(location.href+" #expReport_cont_tb>*","");
            
            $("#activeMed_Count_span").load(window.location + " #activeMed_Count_span");
            $("#deactiveMed_Count_span").load(window.location + " #deactiveMed_Count_span");
            $("#critMed_Count_span").load(window.location + " #critMed_Count_span");
            $("#expDate_Count_span").load(window.location + " #expDate_Count_span");
           
                $('#prescribe_container').delay(500).queue(function (next) { 
                    $(this).css('display', 'none'); 
                    next(); 
                  });
                $("#prescribe_content").animate({
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
                $("#text_validationContent").text('The medicine has been succesfully prescribed!');
                $("#validationAppointment_img").attr("src","images/gif/succes.gif");
    
                setTimeout(function(){
                    //animation for edit profile
                    $("#validation_medicine").animate({
                        right: "-56%",
                    },500)    
                }, 5000);
        }
        else{
            alert("failed");
        }
    }
});
});  
return false;
});


//activate medicine
function activateMedicine(deact_key,deact_key1){
    document.getElementById("activate_container").style.display = "flex";
    document.getElementById("key_medact").value = deact_key;
    document.getElementById("key_medactName").value = deact_key1;
}
function close_actMedicine(){
    document.getElementById("activate_container").style.display = "none";
}

//activate medicine backend
$(document).ready(function($){
    // on submit...
    $('#ajax-form_admin_activateMedicine').submit(function(e){
    e.preventDefault();    
    var key_medDeact = $("input#key_medact").val();    
    if (key_medDeact == ""){
        alert("cant find medicine ID")
        return false;
    }    
    // ajax
    $.ajax({
        type:"POST",
        url: 'z-Ajax-AdminActiveMedicineBackend.php',
        data: $(this).serialize(), // get all form field value in serialize form
        success: function(response){
            document.getElementById("activate_container").style.display = "none";
            $("#med_cont_tb").load(location.href+" #med_cont_tb>*","");
            $("#deactmed_cont_tb").load(location.href+" #deactmed_cont_tb>*","");
            $("#critstockmed_cont_tb").load(location.href+" #critstockmed_cont_tb>*","");
            $("#expReport_cont_tb").load(location.href+" #expReport_cont_tb>*","");
            
            $("#activeMed_Count_span").load(window.location + " #activeMed_Count_span");
            $("#deactiveMed_Count_span").load(window.location + " #deactiveMed_Count_span");
            $("#critMed_Count_span").load(window.location + " #critMed_Count_span");
            $("#expDate_Count_span").load(window.location + " #expDate_Count_span");
            $("#reloading_activeMed").load(window.location + " #reloading_activeMed");
        }
});
});  
return false;
});


//add stock medicine
function restockMed(name,subname,brand,category,mfg,exp,stock){
    document.getElementById("addstockmed_background").style.display = "flex";
    $("#addstock_content").animate({
        marginRight: "0%",
    },600)  

    arraySubname = subname.split(" ");
    document.getElementById("name_inp_ats").value = name;
    document.getElementById("subname_ats").value = subname;
    document.getElementById("name_ats").innerHTML = name;
    document.getElementById("dosage_ats").innerHTML = arraySubname[arraySubname.length-1];
    document.getElementById("brand_ats").value = brand;
    document.getElementById("category_ats").value = category;
    document.getElementById("mfg_ats").value = mfg;
    document.getElementById("exp_ats").value = exp;
    document.getElementById("ats_box_input").value = 40;
}

var ats_count = document.getElementsByClassName("ats_box")[0].innerHTML;
function add_ats(){
    if(ats_count < 50){
        ats_count++;
        document.getElementsByClassName("ats_box")[0].innerHTML = ats_count;
        document.getElementById("ats_box_input").value = ats_count;
    }
}

function minus_ats(){
    if(ats_count > 1){
        ats_count--;
        document.getElementsByClassName("ats_box")[0].innerHTML = ats_count;
        document.getElementById("ats_box_input").value = ats_count;
    }
}


function close_restockMed(){
    document.getElementById("ats_box_input").value = 40;
    document.getElementsByClassName("ats_box")[0].innerHTML = 40;
    $('#addstockmed_background').delay(500).queue(function (next) { 
        $(this).css('display', 'none'); 
        next(); 
      });
    $("#addstock_content").animate({
        marginRight: "-50%",
    },500)  
}

//add stock medicine backend
$(document).ready(function($){
    // on submit...
    $('#ajax-form_admin_addstockMed').submit(function(e){
    e.preventDefault();

    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    today = yyyy + '-' + mm + '-' + dd;


    var brand_ats = $("input#brand_ats").val();    
    var mfg_ats = $("input#mfg_ats").val();   
    var exp_ats = $("input#exp_ats").val();   

    if (brand_ats  == ""){
        $("#brand_ats").css({
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
    if (mfg_ats  == ""){
        $("#mfg_ats").css({
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
    if (exp_ats  == ""){
        $("#exp_ats").css({
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
    if(mfg_ats > today){
        $("#mfg_ats").css({
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
    if(exp_ats < today){
        $("#exp_ats").css({
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

// ajax
$.ajax({
    type:"POST",
    url: 'z-Ajax-AdminAddStockMedBackend.php',
    data: $(this).serialize(), // get all form field value in serialize form
    success: function(response){
        if($.trim(response) == "addTosameMed" || $.trim(response) == "addTodiffMed" ){
            $("#addstockmed_background").load(location.href+" #addstockmed_background>*","");
        
            $("#med_cont_tb").load(location.href+" #med_cont_tb>*","");
            $("#deactmed_cont_tb").load(location.href+" #deactmed_cont_tb>*","");
            $("#critstockmed_cont_tb").load(location.href+" #critstockmed_cont_tb>*","");
            $("#expReport_cont_tb").load(location.href+" #expReport_cont_tb>*","");
            
            $("#activeMed_Count_span").load(window.location + " #activeMed_Count_span");
            $("#deactiveMed_Count_span").load(window.location + " #deactiveMed_Count_span");
            $("#critMed_Count_span").load(window.location + " #critMed_Count_span");
            $("#expDate_Count_span").load(window.location + " #expDate_Count_span");

                $('#addstockmed_background').delay(500).queue(function (next) { 
                    $(this).css('display', 'none'); 
                    next(); 
                  });
                $("#addstock_content").animate({
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
                $("#text_validationContent").text('The medicine has been added succesfully!');
                $("#validationAppointment_img").attr("src","images/gif/succes.gif");
    
                setTimeout(function(){
                    //animation for edit profile
                    $("#validation_medicine").animate({
                        right: "-56%",
                    },500)    
                }, 5000);
        }
        else{
            alert("failed");
        }
    }
});
});  
return false;
});


function remove_validation_ats(key){
    document.getElementById(key).style.border = "1px solid rgb(206, 206, 206)"
}