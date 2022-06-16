function goRecentAppointment(){
    document.getElementById("recentAppointmentTable").style.display = "block"
    document.getElementById("scheduleAppointmentTable").style.display = "none"
    document.getElementById("recentAppDiv").style.boxShadow = "rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px"
    document.getElementById("recentAppDiv").style.backgroundColor = "rgb(248, 248, 248)"
    document.getElementById("schedAppDiv").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px"
    document.getElementById("schedAppDiv").style.backgroundColor = "transparent"
}
function goMakeAppointment(){
    document.getElementById("recentAppointmentTable").style.display = "none"
    document.getElementById("scheduleAppointmentTable").style.display = "block"
    document.getElementById("schedAppDiv").style.boxShadow = "rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px"
    document.getElementById("schedAppDiv").style.backgroundColor = "rgb(248, 248, 248)"
    document.getElementById("recentAppDiv").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px"
    document.getElementById("recentAppDiv").style.backgroundColor = "transparent"
}


//for calendar in appointment
var dt = new Date();
function renderDate() {
    dt.setDate(1);
    var day = dt.getDay();
    var today = new Date();
    var endDate = new Date(
        dt.getFullYear(),
        dt.getMonth() + 1,
        0
    ).getDate();

    var prevDate = new Date(
        dt.getFullYear(),
        dt.getMonth(),
        0
    ).getDate();
    var months = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December"
    ]

    document.getElementById("month_appointment").innerHTML = months[dt.getMonth()];
    document.getElementById("date_str_appointment").innerHTML = dt.getFullYear();
    var cells = "";
    for (x = day; x > 0; x--) {
        cells += "<div class='prev_date_appointment'>" + (prevDate - x + 1) + "</div>";
    }

    for (i = 1; i <= endDate; i++) {
        if (i == today.getDate() && dt.getMonth() == today.getMonth()) cells += "<div class='today_appointment' onclick='getday(\"" + i + "\")' title='Select' id='day\"" + i + "\"'>" + i + "</div>";
        else
            cells += "<div id='day\"" + i + "\"' onclick='getday(\"" + i + "\")' title='Select' class='get_day_bg'>" + i + "</div>";
    }
    document.getElementsByClassName("days_appointment")[0].innerHTML = cells;    
}

//moving the month in appointment calendar
function moveDate_appointment(para) {
    if(para == "prev_appointment") {
        dt.setMonth(dt.getMonth() - 1);
    } else if(para == 'next_appointment') {
        dt.setMonth(dt.getMonth() + 1);
    }
    renderDate();
}



//close form content
function close_formContent(){
    var ele = document.getElementsByName("radioPatient");
    for(var i=0;i<ele.length;i++){
       ele[i].checked = false;
    }
    
    document.getElementById("time_appointment_input").value = "";
    document.getElementById("span_exactTimeApp").innerHTML = "00:00 - 00:00";
    $(document).ready(function(){
        $('#form_App').delay(500).queue(function (next) { 
            $(this).css('display', 'none'); 
            next(); 
          });
        //animation for edit profile
        $("#form_content").animate({
                marginRight: "-35%",
        },500)
            
    });
}

//close validation appointemt
function closeAppointValidation(){
    $(document).ready(function(){
        $("#validation_appointment").animate({
            right: "-56%",
      },500)    
    });
}

//clicking day in calendar
function getday(val){
        var month = document.getElementById("month_appointment").innerHTML;
        var monthInNumber = "";    
        var date_ctr = 0;

        var today = new Date();
        var dd1 = String(today.getDate()).padStart(2, '0');
        today1 = dd1
        var month1 = today.getMonth();

   //     document.getElementById("time_appoint_p").innerHTML="00:00 - 00:00"
     //   document.getElementById("time_appoint_p").style.color = "black"

        var month_names = ['January', 'February', 'March', 
               'April', 'May', 'June', 'July', 
               'August', 'September', 'October', 'November', 'December'];


            if(month === "January"){
                monthInNumber = "01";
                date_ctr = 31;
            }
            else if(month === "February"){
                monthInNumber = "02";
                date_ctr = 28;
            }
            else if(month === "March"){
                monthInNumber = "03";
                date_ctr = 31;
            }
            else if(month === "April"){
                monthInNumber = "04";
                date_ctr = 30;
            }
            else if(month === "May"){
                monthInNumber = "05";
                date_ctr = 31;
            }
            else if(month === "June"){
                monthInNumber = "06";
                date_ctr = 30;
            }
            else if(month === "July"){
                monthInNumber = "07";
                date_ctr = 31;
            }
            else if(month === "August"){
                monthInNumber = "08";
                date_ctr = 31;
            }
            else if(month === "September"){
                monthInNumber = "09";
                date_ctr = 30;
            }
            else if(month === "October"){
                monthInNumber = "10";
                date_ctr = 31;
            }
            else if(month === "November"){
                monthInNumber = "11";
                date_ctr = 30;
            }
            else if(month === "December"){
                monthInNumber = "12";
                date_ctr = 31;
            }
    
         for (x = 1 ; x<=date_ctr ; x++){
             //selected day
            if(document.getElementById("day\"" + x + "\"") === document.getElementById("day\"" + val + "\"")){
                document.getElementById("day\"" + x + "\"").style.backgroundColor = "pink";
                document.getElementById("day\"" + x + "\"").style.borderRadius = "5px";
                document.getElementById("day\"" + x + "\"").style.color = "white";
            }
            else{  // if not equal to selected date
                document.getElementById("day\"" + x + "\"").style.backgroundColor = "transparent";
                document.getElementById("day\"" + x + "\"").style.color = "black";
            }  
            //date today
            if(document.getElementById("day\"" + x + "\"") === document.getElementById("day\"" + dd1 + "\"")
            && month_names[month1] === month){
                document.getElementById("day\"" + x + "\"").style.backgroundColor = "#aacdf8";
                document.getElementById("day\"" + x + "\"").style.color = "white";
            }
         }
        

      
         if(val<10){
            val = ('0' + val).slice(-2)  ;// '04'
         }
        
        var year = document.getElementById("date_str_appointment").innerHTML;
        document.getElementById("sched_appointment_input").value = val+"/"+monthInNumber+"/"+year;
        var todayDate = document.getElementById("sched_appointment_input").value;


        //document.getElementById("date_appoint_p").innerHTML = val+"/"+monthInNumber+"/"+year;

        var GivenDate = year+"-"+monthInNumber+"-"+val;
        var CurrentDate = new Date();
        GivenDate = new Date(GivenDate);
        var weekends = GivenDate.getDay();
      


    let dateToday = new Date().toLocaleDateString("fr-FR");

        //pagkuha ng holiday
        var holiday = document.getElementById("hidden_holiday").value;
        const holidayArray = holiday.split("(|)");
        const comparison = year+"-"+monthInNumber+"-"+val;
        var holidayCTR = "false";                   

        for (l = 0 ; l<holidayArray.length ; l++){
            if(holidayArray[l] === comparison){
                holidayCTR = "true";
                $(document).ready(function(){
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
                    $("#text_validationContent").text('Sorry, but we have no clinic hours during this day!');
                    $("#validationAppointment_img").attr("src","images/gif/error_validation.gif");
        
                        
                    setTimeout(function(){
                            //animation for edit profile
                            $("#validation_appointment").animate({
                                right: "-56%",
                            },500)    
                    }, 5000);
                });
                break;
            }
        }


       if( dateToday === todayDate){
            $(document).ready(function(){
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
                $("#text_validationContent").text('Sorry, You can\'t select from the date today!');
                $("#validationAppointment_img").attr("src","images/gif/error_validation.gif");

                
                setTimeout(function(){
                        //animation for edit profile
                        $("#validation_appointment").animate({
                            right: "-56%",
                        },500)    
                }, 5000);
            });
        }
        else if( GivenDate >= CurrentDate && weekends !== 0 && holidayCTR === "false"){
            $(document).ready(function(){
                $("#form_App").css({
                    display: "block",
                })
                //animation for edit profile
                $("#form_content").animate({
                        marginRight: "0%",
                },500)    
                //animation for edit profile
                $("#validation_appointment").animate({
                        right: "-56%",
                },500)          
            });

            const d = new Date(month+" "+val+","+" "+year);
            let day_show = d.getDay()
           
            var dayFinal = ""
               if(day_show == "1"){
                   dayFinal = "Monday"
               }
               else if(day_show == "2"){
                    dayFinal = "Tuesday"
               }
               else if(day_show == "3"){
                    dayFinal = "Wednesday"
               }
               else if(day_show == "4"){
                    dayFinal = "Thursday"
               }
               else if(day_show == "5"){
                    dayFinal = "Friday"
               }
               else if(day_show == "6"){
                    dayFinal = "Saturday"
            }
                document.getElementById("span_dateApp").innerHTML = dayFinal;
                document.getElementById("span_exactDateApp").innerHTML = todayDate;
                

        }
        else if( GivenDate <= CurrentDate){
            $(document).ready(function(){
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
                $("#text_validationContent").text('Sorry, But you can\'t select from the previous date!');
                $("#validationAppointment_img").attr("src","images/gif/error_validation.gif");

                
                setTimeout(function(){
                        //animation for edit profile
                        $("#validation_appointment").animate({
                            right: "-56%",
                        },500)    
                }, 5000);
            });
        }
        else if( weekends === 0  ){
            $(document).ready(function(){
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
                $("#text_validationContent").text('Sorry, But we have no clinic hours during sunday!');
                $("#validationAppointment_img").attr("src","images/gif/error_validation.gif");

                
                setTimeout(function(){
                        //animation for edit profile
                        $("#validation_appointment").animate({
                            right: "-56%",
                        },500)    
                }, 5000);
            });
        }
}



//setting time in input
function getTime(val_app){
    var date = document.getElementById("sched_appointment_input").value;

    xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () =>{
        if(xhr.readyState == 4 && xhr.status == 200){
           //alert();
           var ret = JSON.parse(xhr.responseText);
           console.log(ret)      
            if(ret.status === 0){
                $(".td_time_app").css({
                    border: "0px solid red",
                })
                document.getElementById("time_appointment_input").value = val_app;
                document.getElementById("span_exactTimeApp").innerHTML = val_app;
            }   
            else{
                document.getElementById("time_appointment_input").value = "";
                document.getElementById("span_exactTimeApp").innerHTML = "00:00 - 00:00"; 
                var ele = document.getElementsByName("radioPatient");
                for(var i=0;i<ele.length;i++){
                   ele[i].checked = false;
                }
                
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
                    $("#text_validationContent").text('This slot is already taken!');
                    $("#validationAppointment_img").attr("src","images/gif/error_validation.gif");
               
                    setTimeout(function(){
                            //animation for edit profile
                            $("#validation_appointment").animate({
                                right: "-56%",
                            },500)    
                    }, 5000);
            }    
        }
    };

        xhr.open("GET", "z-Ajax-TimeSelectApp.php?time="+val_app+"&date="+date, true);
        xhr.send();
}



//open edit profile
function openInNewTabAppointment() {
    window.open('patientEditProfile.php', '_blank').focus();
}


setInterval(function(){
    $(".to_reloadInput").load(location.href+" .to_reloadInput>*","");
}, 100);