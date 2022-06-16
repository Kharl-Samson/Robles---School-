//for calendar in appointment
var dt = new Date();
function renderDate_mobile() {
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

    document.getElementById("month_appointment_mobile").innerHTML = months[dt.getMonth()];
    document.getElementById("date_str_appointment_mobile").innerHTML = dt.getFullYear();
    var cells = "";
    for (x = day; x > 0; x--) {
        cells += "<div class='prev_date_appointment_mobile'>" + (prevDate - x + 1) + "</div>";
    }
    
    for (i = 1; i <= endDate; i++) {
        if (i == today.getDate() && dt.getMonth() == today.getMonth()) cells += "<div class='today_appointment_mobile' onclick='getdayM(\"" + i + "\")' id='dayM\"" + i + "\"'>" + i + "</div>";
        else
            cells += "<div id='dayM\"" + i + "\"' onclick='getdayM(\"" + i + "\")'  class='get_day_bg'>" + i + "</div>";
    }
    document.getElementsByClassName("days_appointment_mobile")[0].innerHTML = cells;    
}

//moving the month in appointment calendar
function moveDate_appointment_mobile(para) {
    if(para == "prev_appointment") {
        dt.setMonth(dt.getMonth() - 1);
    } else if(para == 'next_appointment') {
        dt.setMonth(dt.getMonth() + 1);
    }
    renderDate_mobile();
}


//clicking day in calendar
function getdayM(val){
    var month = document.getElementById("month_appointment_mobile").innerHTML;
    var monthInNumber = "";    
    var date_ctr = 0;

    var today = new Date();
    var dd1 = String(today.getDate()).padStart(2, '0');
    today1 = dd1
    var month1 = today.getMonth();

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
       if(document.getElementById("dayM\"" + x + "\"") === document.getElementById("dayM\"" + val + "\"")){
           document.getElementById("dayM\"" + x + "\"").style.backgroundColor = "pink";
           document.getElementById("dayM\"" + x + "\"").style.borderRadius = "5px";
           document.getElementById("dayM\"" + x + "\"").style.color = "white";
       }
       else{  // if not equal to selected date
           document.getElementById("dayM\"" + x + "\"").style.backgroundColor = "transparent";
           document.getElementById("dayM\"" + x + "\"").style.color = "black";
       }  
       //date today
       if(document.getElementById("dayM\"" + x + "\"") === document.getElementById("day\"" + dd1 + "\"")
       && month_names[month1] === month){
           document.getElementById("dayM\"" + x + "\"").style.backgroundColor = "#aacdf8";
           document.getElementById("dayM\"" + x + "\"").style.color = "white";
       }
    }

    if(val<10){
        val = ('0' + val).slice(-2)  ;// '04'
     }

     var year = document.getElementById("date_str_appointment_mobile").innerHTML;
     document.getElementById("sched_appointment_inputM").value = val+"/"+monthInNumber+"/"+year;
     var todayDate = document.getElementById("sched_appointment_inputM").value;

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
            document.getElementById("sweetalert_container_Mobile").style.display = "flex";
            document.getElementById("gif_alertClass1").src="images/gif/error_validation.gif";
            document.querySelector(".header_text_validation_appointmentM1").innerHTML = "Error!"
            document.querySelector(".header_text_validation_appointmentM1").style.color = "red"
            document.querySelector("#message_alertM").innerHTML="Sorry, but we have no clinic hours during this day!"
            document.getElementById("close_alert_Mobile").style.backgroundColor = "black"
            break;
        }
    }


    if(dateToday === todayDate){
        document.getElementById("sweetalert_container_Mobile").style.display = "flex";
        document.getElementById("gif_alertClass1").src="images/gif/error_validation.gif";
        document.querySelector(".header_text_validation_appointmentM1").innerHTML = "Error!"
        document.querySelector(".header_text_validation_appointmentM1").style.color = "red"
        document.querySelector("#message_alertM").innerHTML="You can\'t select the date today!"
        document.getElementById("close_alert_Mobile").style.backgroundColor = "black"
    }
    else if( GivenDate >= CurrentDate && weekends !== 0 && holidayCTR === "false"){
        //tama date
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
            //document.getElementById("span_dateApp").innerHTML = dayFinal;
            //document.getElementById("span_exactDateApp").innerHTML = todayDate;           
    }
    else if( GivenDate <= CurrentDate){
        document.getElementById("sweetalert_container_Mobile").style.display = "flex";
        document.getElementById("gif_alertClass1").src="images/gif/error_validation.gif";
        document.querySelector(".header_text_validation_appointmentM1").innerHTML = "Error!"
        document.querySelector(".header_text_validation_appointmentM1").style.color = "red"
        document.querySelector("#message_alertM").innerHTML="You can\'t select from the previous date!"
        document.getElementById("close_alert_Mobile").style.backgroundColor = "black"
    }
    else if( weekends === 0  ){
        document.getElementById("sweetalert_container_Mobile").style.display = "flex";
        document.getElementById("gif_alertClass1").src="images/gif/error_validation.gif";
        document.querySelector(".header_text_validation_appointmentM1").innerHTML = "Error!"
        document.querySelector(".header_text_validation_appointmentM1").style.color = "red"
        document.querySelector("#message_alertM").innerHTML="We have no clinic hours during Sunday!"
        document.getElementById("close_alert_Mobile").style.backgroundColor = "black"
    }
}




function close_alert_Mobile(){
    document.getElementById("sweetalert_container_Mobile").style.display = "none";
}

//setting time in input
function getTimeM(val_app){
    var dates1 = document.getElementById("sched_appointment_inputM").value;

    xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () =>{
        if(xhr.readyState == 4 && xhr.status == 200){
           //alert();
           var ret = JSON.parse(xhr.responseText);
           console.log(ret)      
            if(ret.status === 0){
                document.getElementById("time_appointment_inputM").value = val_app;
            }   
            else{
                var ele = document.getElementsByName("radioM");
                for(var i=0;i<ele.length;i++){
                   ele[i].checked = false;
                }

                document.getElementById("sweetalert_container_Mobile").style.display = "flex";
                document.getElementById("gif_alertClass1").src="images/gif/error_validation.gif";
                document.querySelector(".header_text_validation_appointmentM1").innerHTML = "Error!"
                document.querySelector(".header_text_validation_appointmentM1").style.color = "red"
                document.querySelector("#message_alertM").innerHTML="This slot is already taken!"
                document.getElementById("close_alert_Mobile").style.backgroundColor = "black"
            }    
        }
    };

        xhr.open("GET", "z-Ajax-TimeSelectApp.php?time="+val_app+"&date="+dates1, true);
        xhr.send();
}

function removeborderM(){
    document.getElementById("validation_error_form_appMobile").style.visibility = "hidden"
}

$(function() {
    $(".inpCodem").keyup(function () {
        var inp = document.querySelectorAll(".inpCodem");
        var strInp = ""
        for(y=0 ; y<6; y++){
            strInp += inp[y].value;
        }
        document.getElementById("final_code").value = strInp;

        
        if (this.value.length == this.maxLength) {
          $(this).next('.inpCodem').focus();
        }
    });
});

function cancelVerifyerPhone(){
$(document).ready(function($){
    $("#email_verifyer").animate({
        left: "-100%",
    },500)   
    $('#email_verifyer').delay(700).queue(function (next) { 
        $(this).css('display', 'none'); 
        next(); 
    });
 
});
}
