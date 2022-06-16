function goActiveStaff(){
    document.querySelectorAll('#active_searchFor').forEach(st => {
        st.style.display = "block"
    }); 
    document.querySelectorAll('#inactive_searchFor').forEach(st => {
        st.style.display = "none"
    }); 

    $("#active_searchFor").load(location.href+" #active_searchFor>*","");
    document.getElementById("srch_input_emp_obPage").value = ""
    document.getElementById("srch_input_emp_obPage_Inactive").value = ""

    document.getElementById("no_dataVerifyer").style.display = "none"
    document.getElementsByClassName("search_act")[0].style.display = "flex"
    document.getElementsByClassName("search_inact")[0].style.display = "none"

    document.getElementById("staff_active").style.boxShadow = "rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px";
    document.getElementById("staff_active").style.backgroundColor = "rgb(248, 248, 248)";
    document.getElementById("staff_inactive").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("staff_inactive").style.backgroundColor = "transparent";
}

function goInactiveStaff(){
    document.querySelectorAll('#active_searchFor').forEach(st => {
        st.style.display = "none"
    }); 
    document.querySelectorAll('#inactive_searchFor').forEach(st => {
        st.style.display = "block"
    }); 

    $("#inactive_searchFor").load(location.href+" #inactive_searchFor>*","");
    document.getElementById("srch_input_emp_obPage").value = ""
    document.getElementById("srch_input_emp_obPage_Inactive").value = ""

    document.getElementById("no_dataVerifyer").style.display = "none"
    document.getElementsByClassName("search_act")[0].style.display = "none"
    document.getElementsByClassName("search_inact")[0].style.display = "flex"

    document.getElementById("staff_inactive").style.boxShadow = "rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px";
    document.getElementById("staff_inactive").style.backgroundColor = "rgb(248, 248, 248)";
    document.getElementById("staff_active").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("staff_active").style.backgroundColor = "transparent";
}




$(document).ready(function(){
    //clicking hamburger menu
    var ctrSrch = 0;
    $(".search_emp_obPage").click(function() {   
        ctrSrch++;
        if(ctrSrch % 2 == 0)
        {
            $('#srch_input_emp_obPage').val("");
            $("#search_img_obPage").attr("src","images/icons/search_gif.gif");
            $("#srch_input_emp_obPage").animate({
                width: "0%",
            },800)
        }
        else{
            $("#search_img_obPage").attr("src","images/icons/close.png");
            $("#srch_input_emp_obPage").animate({
                width: "85%",
            },800)
        }

    });

    var ctrSrch1 = 0;
    $(".search_img_obPage_Inactive").click(function() {   
        ctrSrch1++;
        if(ctrSrch1 % 2 == 0)
        {
            $('#srch_input_emp_obPage_Inactive').val("");
            $("#search_img_obPage_Inactive").attr("src","images/icons/search_gif.gif");
            $("#srch_input_emp_obPage_Inactive").animate({
                width: "0%",
            },800)
        }
        else{
            $("#search_img_obPage_Inactive").attr("src","images/icons/close.png");
            $("#srch_input_emp_obPage_Inactive").animate({
                width: "85%",
            },800)
        }

    });
    
    
    //filter search active
    var verifyer_emp = 0;
    $("#srch_input_emp_obPage").on("keyup", function() {
        var searchEmp_l = $("#srch_input_emp_obPage").val();
        var value = $(this).val().toLowerCase();
        $("#active_searchFor>*").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });

        if($('#active_searchFor>*:visible').length === 0) {
            verifyer_emp = 0;
        }
        else if($('#active_searchFor>*:visible').length != 0){
            verifyer_emp = 1;
        }


        if(searchEmp_l.length === 0){
            document.getElementById("no_dataVerifyer").style.display = "none"
        }
        else if(verifyer_emp === 0) {
            document.getElementById("no_dataVerifyer").style.display = "flex"
        }
        else if(verifyer_emp === 1){
            document.getElementById("no_dataVerifyer").style.display = "none"
        }
    });


        
    //filter search inactive
    var verifyer_emp1 = 0;
    $("#srch_input_emp_obPage_Inactive").on("keyup", function() {
        var searchEmp_l = $("#srch_input_emp_obPage_Inactive").val();
        var value = $(this).val().toLowerCase();
        $("#inactive_searchFor>*").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });

        if($('#inactive_searchFor>*:visible').length === 0) {
            verifyer_emp1 = 0;
        }
        else if($('#inactive_searchFor*:visible').length != 0){
            verifyer_emp1 = 1;
        }


        if(searchEmp_l.length === 0){
            document.getElementById("no_dataVerifyer").style.display = "none"
        }
        else if(verifyer_emp1 === 0) {
            document.getElementById("no_dataVerifyer").style.display = "flex"
        }
        else if(verifyer_emp1 === 1){
            document.getElementById("no_dataVerifyer").style.display = "none"
        }
    });


   

});


function removeEmp(key){
    document.getElementById("remove_container").style.display = "flex";
    document.getElementById("key_empRemove").value = key;
}

function close_removeEmp(){
    document.getElementById("remove_container").style.display = "none";
}





//add emp -------------------------------------------
function show_addemployee(){
    $(document).ready(function(){
        $("#addEmp_container").css({
            display: "flex",
        })
        $("#addEmp_content").animate({
            marginRight: "0vh",
        },500)
        $("#button_addemp").animate({
            marginRight: "0vh",
        },500)
    });
}

function close_addemployee(){
    $(document).ready(function(){         
        $("#progress_bar").load(location.href+" #progress_bar>*","");
        document.getElementById("validation").style.visibility = "hidden"
        document.querySelectorAll('.for_val_border').forEach(st => {
            st.style.border = "1px solid rgb(206, 206, 206)"
        }); 


        $('#addEmp_container').delay(500).queue(function (next) { 
            $(this).css('display', 'none'); 
            next(); 
        });
        $("#addEmp_content").animate({
            marginRight: "-150vh",
        },500)
        $("#button_addemp").animate({
            marginRight: "-150vh",
        },500)
    });
}




//dropdown add emp
var my_handlers = {

    fill_provinces:  function(){
    
        var region_code = $(this).val();
        $('#province').ph_locations('fetch_list', [{"region_code": region_code}]);
        
    },
    
    fill_cities: function(){
    
        var province_code = $(this).val();
        $('#city').ph_locations( 'fetch_list', [{"province_code": province_code}]);
    },
    
    
    fill_barangays: function(){
    
        var city_code = $(this).val();
        $('#barangay').ph_locations('fetch_list', [{"city_code": city_code}]);
    }
    };
    
    $(function(){
    $('#region').on('change', my_handlers.fill_provinces);
    $('#province').on('change', my_handlers.fill_cities);
    $('#city').on('change', my_handlers.fill_barangays);
    
    $('#region').ph_locations({'location_type': 'regions'});
    $('#province').ph_locations({'location_type': 'provinces'});
    $('#city').ph_locations({'location_type': 'cities'});
    $('#barangay').ph_locations({'location_type': 'barangays'});
    
    $('#region').ph_locations('fetch_list');
    });
    
    function getProv(){
       var reg = document.getElementById("region")
       var regFinal =reg.options[reg.selectedIndex].text;
    
       var prov = document.getElementById("province")
       var provFinal =prov.options[prov.selectedIndex].text;
    
       var city = document.getElementById("city")
       var cityFinal =city.options[city.selectedIndex].text;
    
       var bar = document.getElementById("barangay")
       var barFinal =bar.options[bar.selectedIndex].text;
    
       document.getElementById("reg").value=regFinal;
       document.getElementById("bar").value=barFinal;
       document.getElementById("prov").value=provFinal;
       document.getElementById("mun").value=cityFinal;
    }
    
    setInterval(function(){ 
        getProv();
    }, 300);



//drag and drop upload photo ob
const dropArea = document.querySelector(".drag-area"),
dragText = dropArea.querySelector("header"),
button = dropArea.querySelector("button"),
input = document.getElementById("testing");
let file; //this is a global variable and we'll use it inside multiple functions

button.onclick = ()=>{
  input.click(); //if user click on the button then the input also clicked
}

input.addEventListener("change", function(){
  //getting user select file and [0] this means if user select multiple files then we'll select only the first one
  file = this.files[0];
  dropArea.classList.add("active");
  
  showFile(); //calling function
});


//If user Drag File Over DropArea
dropArea.addEventListener("dragover", (event)=>{
  event.preventDefault(); //preventing from default behaviour
  dropArea.classList.add("active");
  dragText.textContent = "Release to Upload File";
});

//If user leave dragged File from DropArea
dropArea.addEventListener("dragleave", ()=>{
  dropArea.classList.remove("active");
  dragText.textContent = "Drag & Drop to Upload File";
});

//If user drop File on DropArea
dropArea.addEventListener("drop", (event)=>{
  event.preventDefault(); //preventing from default behaviour
  //getting user select file and [0] this means if user select multiple files then we'll select only the first one
  file = event.dataTransfer.files[0];
  showFile(); //calling function
});

function showFile(){
  let fileType = file.type; //getting selected file type
  let validExtensions = ["image/jpeg", "image/jpg", "image/png"]; //adding some valid image extensions in array
  if(validExtensions.includes(fileType)){ //if user selected file is an image file
    let fileReader = new FileReader(); //creating new FileReader object
    fileReader.onload = ()=>{
      let fileURL = fileReader.result; //passing user file source in fileURL variableattribute
      document.getElementById("profile_img1").src =fileURL;
    }
    fileReader.readAsDataURL(file);
    document.getElementById("pic_inpkey").value = file["name"];
    console.log(file["name"])
  }else{
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
        $("#text_validationContent").text('The image file is invalid!');
        $("#validationEmp_img").attr("src","images/gif/serror_validation.gif");

        setTimeout(function(){
            //animation for edit profile
            $("#validation_emp").animate({
                right: "-56%",
            },500)    
        }, 5000);
    dropArea.classList.remove("active");
    dragText.textContent = "Drag & Drop to Upload File";
  }
}

//next step button function
function validateEmail(email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test( email );
  }

var step = 1;
function nextStep(){
    var phoneno = /^(09|\+639)\d{9}$/;

    var fname = document.getElementById("fname_addEmp").value;
    var lname = document.getElementById("lname_addEmp").value;
    var reg = document.getElementById("reg").value;
    var prov = document.getElementById("prov").value;
    var mun = document.getElementById("mun").value;
    var bar = document.getElementById("bar").value;
    var age = document.getElementById("age_addEmp").value
    var religion = document.getElementById("religion_addEmp").value;
    var bday = document.getElementById("bday_addEmp").value;
    var contact = document.getElementById("contact_addEmp").value;
    var email = document.getElementById("email_addEmp").value;
    var role = document.getElementById("role_addEmp").value;

    var q = new Date();
    var date = new Date(q.getFullYear(),q.getMonth(),q.getDate());
    var mydate = new Date(bday);

    
    if(fname =="" && lname =="" && prov =="Select region first" && mun =="Select province first" && bar =="Select municipality first"){
        $(".step1").animate({
            backgroundColor: "#ea5e62" 
        },500)
        document.getElementById("validation").style.visibility = "visible"
        document.getElementById("validation_span").innerHTML = "Fields with * are required!"
        document.querySelectorAll('.for_val_border').forEach(st => {
            st.style.border = "1px solid red"
        }); 
    }
    if(fname == ""){
        $(".step1").animate({
            backgroundColor: "#ea5e62"
        },500)
        document.getElementById("validation_span").innerHTML = "Fields with * are required!"
        document.getElementById("validation").style.visibility = "visible"
        document.querySelector('.fvb_fname').style.border = "1px solid red"
    }
    if(lname == ""){
        $(".step1").animate({
            backgroundColor: "#ea5e62"
        },500)
        document.getElementById("validation_span").innerHTML = "Fields with * are required!"
        document.getElementById("validation").style.visibility = "visible"
        document.querySelector('.fvb_lname').style.border = "1px solid red"
    }
    if(prov == "Select region first"){
        $(".step1").animate({
            backgroundColor: "#ea5e62"
        },500)
        document.getElementById("validation_span").innerHTML = "Fields with * are required!"
        document.getElementById("validation").style.visibility = "visible"
        document.querySelector('.fvb_province').style.border = "1px solid red"
    }
    if(mun == "Select province first"){
        $(".step1").animate({
            backgroundColor: "#ea5e62"
        },500)
        document.getElementById("validation_span").innerHTML = "Fields with * are required!"
        document.getElementById("validation").style.visibility = "visible"
        document.querySelector('.fvb_mun').style.border = "1px solid red"
    }
    if(bar == "Select municipality first"){
        $(".step1").animate({
            backgroundColor: "#ea5e62"
        },500)
        document.getElementById("validation_span").innerHTML = "Fields with * are required!"
        document.getElementById("validation").style.visibility = "visible"
        document.querySelector('.fvb_bar').style.border = "1px solid red"
    }
    if(fname !="" && lname !="" && prov !="Select region first" && mun !="Select province first" && bar !="Select municipality first"){
        if(step>=1 && step<3){
            if(step == 1){
                step++;
                $(document).ready(function(){
                    $("#next_step_button").css({
                        display: "block",
                    })
                    $("#cancel_step").css({
                        display: "none",
                    })
                    $("#prev_step").css({
                        display: "block",
                    })
                    $("#step1_input").css({
                        display: "none",
                    })
                    $("#step2_input").css({
                        display: "block",
                    })
                    $("#step2_input").animate({
                        marginLeft: "0vh",
                    },500)
                    $(".step2").animate({
                        backgroundColor: "#97C3F9",
                    },500)
                    $(".step1").animate({
                        backgroundColor: "#97C3F9",
                    },500)
                });
            }
            else if(religion =="" && bday =="" && contact =="" && email =="" && role =="" ){
                $(".step2").animate({
                    backgroundColor: "#ea5e62"
                },500)
                document.getElementById("validation_span").innerHTML = "Fields with * are required!"
                document.getElementById("validation").style.visibility = "visible"
                document.querySelectorAll('.for_val_border1').forEach(st => {
                    st.style.border = "1px solid red"
                }); 
            }
            else if(religion ==""){
                $(".step2").animate({
                    backgroundColor: "#ea5e62"
                },500)
                document.getElementById("validation_span").innerHTML = "Fields with * are required!"
                document.getElementById("validation").style.visibility = "visible"
                document.querySelector('.fvb_rel').style.border = "1px solid red"  
            }
            else if(bday ==""){
                $(".step2").animate({
                    backgroundColor: "#ea5e62"
                },500)
                document.getElementById("validation_span").innerHTML = "Fields with * are required!"
                document.getElementById("validation").style.visibility = "visible"
                document.querySelector('.fvb_bday').style.border = "1px solid red"  
            }
            else if(date <= mydate) {
                $(".step2").animate({
                    backgroundColor: "#ea5e62"
                },500)
                document.getElementById("validation_span").innerHTML = "Sorry, you can\'t input from future date!"
                document.getElementById("validation").style.visibility = "visible"
                document.querySelector('.fvb_bday').style.border = "1px solid red"  

                document.getElementById("age_addEmp").value= 0;
            }
            else if (age <= 15){
                document.getElementById("validation_span").innerHTML = "This staff is too young!"
                document.getElementById("validation").style.visibility = "visible"
            }
            else if (age >= 100){
                document.getElementById("validation_span").innerHTML = "This staff is too old!"
                document.getElementById("validation").style.visibility = "visible"
            }
            else if(contact ==""){
                $(".step2").animate({
                    backgroundColor: "#ea5e62"
                },500)
                document.getElementById("validation_span").innerHTML = "Fields with * are required!"
                document.getElementById("validation").style.visibility = "visible"
                document.querySelector('.fvb_contact').style.border = "1px solid red"  
            }        
            else if(!contact.match(phoneno)){
                $(".step2").animate({
                    backgroundColor: "#ea5e62"
                },500)
                document.getElementById("validation_span").innerHTML = "Sorry, The contact number is invalid!"
                document.getElementById("validation").style.visibility = "visible"
                document.querySelector('.fvb_contact').style.border = "1px solid red"  
            }
            else if(email ==""){
                $(".step2").animate({
                    backgroundColor: "#ea5e62"
                },500)
                document.getElementById("validation_span").innerHTML = "Fields with * are required!"
                document.getElementById("validation").style.visibility = "visible"
                document.querySelector('.fvb_email').style.border = "1px solid red"  
            }
            else if(!validateEmail(email)) {    
                $(".step2").animate({
                    backgroundColor: "#ea5e62"
                },500)
                document.getElementById("validation_span").innerHTML = "Sorry, The email is invalid!"
                document.getElementById("validation").style.visibility = "visible"
                document.querySelector('.fvb_email').style.border = "1px solid red"  
            }
            else if(role ==""){
                $(".step2").animate({
                    backgroundColor: "#ea5e62"
                },500)
                document.getElementById("validation_span").innerHTML = "Fields with * are required"
                document.getElementById("validation").style.visibility = "visible"
                document.querySelector('.fvb_role').style.border = "1px solid red"  
            }
            else if(religion !="" && bday !="" && contact !="" && email !="" && role !="" ){
                if(step == 2){
                    step++;
                    $(document).ready(function(){
                        $('.header_form_text').text('Add an account photo (Optional)')
                        $("#upload_step_button").css({
                            display: "block",
                        })
                        $("#next_step_button").css({
                            display: "none",
                        })      
                        $("#cancel_step").css({
                            display: "none",
                        })
                        $("#prev_step").css({
                            display: "block",
                        })
                        $("#step2_input").css({
                            display: "none",
                        })
                        $("#step3_input").css({
                            display: "flex",
                        })
                        $("#step3_input").animate({
                            marginLeft: "0vh",
                        },500)
                        $(".step3").animate({
                            backgroundColor: "#97C3F9",
                        },500)
                        $(".step2").animate({
                            backgroundColor: "#97C3F9",
                        },500)
                    });
                }

            }
        }
    }
}


function backStep(){
    if(step>=1 && step<=4){
        step--;
        if(step == 1){
            $(document).ready(function(){
                $('.header_form_text').text('Fill all form fields to go next step')
                $("#cancel_step").css({
                    display: "block",
                })
                $("#prev_step").css({
                    display: "none",
                })
                $("#step2_input").animate({
                    marginLeft: "150vh",
                },500)
                $('#step1_input').delay(500).queue(function (next) { 
                    $(this).css('display', 'block'); 
                    next(); 
                });
                $('#step2_input').delay(500).queue(function (next) { 
                    $(this).css('display', 'none'); 
                    next(); 
                });
                $(".step2").animate({
                    backgroundColor: "#C4C4C4",
                },500)
            });
        }
        else if(step == 2){
            $(document).ready(function(){
                $('.header_form_text').text('Fill all form fields to go next step')
                $("#upload_step_button").css({
                    display: "none",
                })
                $("#next_step_button").css({
                    display: "block",
                })
                $("#cancel_step").css({
                    display: "none",
                })
                $("#prev_step").css({
                    display: "block",
                })
                $("#step3_input").animate({
                    marginLeft: "150vh",
                },500)
                $('#step2_input').delay(500).queue(function (next) { 
                    $(this).css('display', 'block'); 
                    next(); 
                });
                $('#step3_input').delay(500).queue(function (next) { 
                    $(this).css('display', 'none'); 
                    next(); 
                });
                $(".step3").animate({
                    backgroundColor: "#C4C4C4",
                },500)
            });
        }
        else if (step == 3){
            $(document).ready(function(){
                $("#upload_step_button").css({
                    display: "block",
                })
                $("#next_step_button").css({
                    display: "none",
                })
                $("#submit_step_button").css({
                    display: "none",
                })
                $('.header_form_text').text('Add an account photo (Optional)')
                $("#cancel_step").css({
                    display: "none",
                })
                $("#prev_step").css({
                    display: "block",
                })
                $("#step4_input").animate({
                    marginLeft: "150vh",
                },500)
                $('#step3_input').delay(500).queue(function (next) { 
                    $(this).css('display', 'flex'); 
                    next(); 
                });
                $('#step4_input').delay(500).queue(function (next) { 
                    $(this).css('display', 'none'); 
                    next(); 
                });
                $(".step4").animate({
                    backgroundColor: "#C4C4C4",
                },500)
            });
        }
    }
}


function removeBorderAddemp(className){
    document.querySelector('.'+className).style.border = "1px solid rgb(206, 206, 206)"
    document.getElementById("validation").style.visibility = "hidden"
}

function ageGenerator(){
    var d =  document.getElementById("bday_addEmp").value;
    var dob = new Date(d);  
    var month_diff = Date.now() - dob.getTime();  
    var age_dt = new Date(month_diff);      
    var year = age_dt.getUTCFullYear();   
    var age = Math.abs(year - 1970);  
    document.getElementById("age_addEmp").value=age;
}


$(document).ready(function (e){
    $("#ajax-form_admin_addStaff").on('submit',(function(e){ e.preventDefault();
        step = 4;
        $("#next_step_button").css({
            display: "none",
        })
        $("#submit_step_button").css({
            display: "block",
        })
        $("#upload_step_button").css({
            display: "none",
        })
    
        $('.header_form_text').text('Setup the Schedule')
        $("#cancel_step").css({
            display: "none",
        })
        $("#prev_step").css({
            display: "block",
        })
        $("#step3_input").css({
            display: "none",
        })
        $("#step4_input").css({
            display: "flex",
        })
        $("#step4_input").animate({
            marginLeft: "0vh",
        },500)
        $(".step4").animate({
            backgroundColor: "#97C3F9",
        },500)
    
            $.ajax({
                url: "z-Ajax-obAddStaffPic.php",
                type: "POST",
                data: new FormData(this),
                contentType: false, cache: false, processData:false,
                success: function(data){
                    
                },
                error: function(){}
            });
        
    }));
});


//para mapalitan text ng duty
function change_TextDuty(key){
    if(document.getElementById('cb_date'+key).checked){
        document.getElementsByClassName('duty'+key)[0].innerHTML = "Duty"
    }
    else{
        document.getElementsByClassName('duty'+key)[0].innerHTML = "Dayoff"
    }
    
}

//show edit sched modal 
function edit_sched(id,img, name, email, role, sched, time){

    $(document).ready(function(){
        $("#edit_schedule").css({
            display: "flex",
        })
        $("#edit_container").animate({
            marginRight: "0vh",
        },500)
    });
    
    document.getElementById("img_editSched").src = 'upload_img/'+img;
    document.getElementsByClassName("name_editSched")[0].innerHTML = name;
    document.getElementsByClassName("email_editSched")[0].innerHTML = email;
    document.getElementsByClassName("role_editSched")[0].innerHTML = role;
    document.getElementById("key_Id_Sc_edit").value = id;

    var arraySched = sched.split(",");
    var strSched = []

    for(x=0 ; x<arraySched.length; x++){
        if(document.querySelector('#cb_dateA').value === arraySched[x]){
            document.querySelector('#cb_dateA').checked = true 
            strSched.push(arraySched[x])
        }
        if(document.querySelector('#cb_dateB').value === arraySched[x]){
            document.querySelector('#cb_dateB').checked = true 
            strSched.push(arraySched[x])
        }
        if(document.querySelector('#cb_dateC').value === arraySched[x]){
            document.querySelector('#cb_dateC').checked = true 
            strSched.push(arraySched[x])
        }
        if(document.querySelector('#cb_dateD').value === arraySched[x]){
            document.querySelector('#cb_dateD').checked = true 
            strSched.push(arraySched[x])
        }
        if(document.querySelector('#cb_dateE').value === arraySched[x]){
            document.querySelector('#cb_dateE').checked = true 
            strSched.push(arraySched[x])
        }
        if(document.querySelector('#cb_dateF').value === arraySched[x]){
            document.querySelector('#cb_dateF').checked = true 
            strSched.push(arraySched[x])
        }
    }

    document.getElementById("key_sched_edit").value = strSched;
    var arrayTime = time.split(" - ");
    var time1 = arrayTime[0].slice(0, -3);
    var time2 = arrayTime[1].slice(0, -3);

    document.getElementById("time_E_1").value = time1;
    document.getElementById("time_E_2").value = time2;


}

function close_sched(){
    $(document).ready(function(){      
        $("#edit_container").load(location.href+" #edit_container>*","");   
        $('#edit_schedule').delay(500).queue(function (next) { 
            $(this).css('display', 'none'); 
            next(); 
        });
        $("#edit_container").animate({
            marginRight: "-150vh",
        },500)
    });
}


//for cb_box edit
function edit_cbboxStaff(){
    var array = []
    var checkboxes = document.querySelectorAll('.cb1_edit:checked')
    
    for (var i = 0; i < checkboxes.length; i++) {
      array.push(checkboxes[i].value)
    }
    let text = array.toString();
    document.getElementById("key_sched_edit").value = text;
}

//para mapalitan text ng duty
function change_TextDuty1(key){
   // if(document.getElementById('cb_date'+key).checked){
     //   document.getElementsByClassName('duty'+key)[0].innerHTML = "Duty"
    //}
    //else{
      //  document.getElementsByClassName('duty'+key)[0].innerHTML = "Dayoff"
    //}
}



//view staff -------------------------------------------
function show_staffProfile(img, id, name, role, bday, add, age, contact, email,hired, ended){
    $(document).ready(function(){
        $("#view_staff_container").css({
            display: "flex",
        })
        $("#view_staff_content").animate({
            marginRight: "0vh",
        },500)
    });

    document.getElementById("image_view").src = "upload_img/"+img;
    document.getElementById("name_view").innerHTML = name;
    document.getElementById("id_view").innerHTML = "Employee ID : "+id;
    document.getElementById("position_view").innerHTML = role;
    document.getElementById("bday_view").innerHTML = bday;
    document.getElementById("add_view").innerHTML = add;
    document.getElementById("age_view").innerHTML = age+" yrs old.";
    document.getElementById("contact_view").innerHTML = contact;
    document.getElementById("email_view").innerHTML = email;
    document.getElementById("hired_view").innerHTML = hired;
    document.getElementById("ended_view").innerHTML = ended;

    if(ended === ""){
        document.getElementById("ended_view").innerHTML = "This employee is still active.";
    }
    else{
        document.getElementById("ended_view").innerHTML = ended;
    }

}

function close_staffProfile(){
    $(document).ready(function(){         
        $('#view_staff_container').delay(500).queue(function (next) { 
            $(this).css('display', 'none'); 
            next(); 
        });
        $("#view_staff_content").animate({
            marginRight: "-150vh",
        },500)
    });
}
