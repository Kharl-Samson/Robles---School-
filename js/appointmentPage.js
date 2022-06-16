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



//clicking day in calendar
function getday(val){
    document.getElementById("available_time").style.display = "block";
    document.getElementById("slc_time").style.display = "none";
    document.getElementById("slc_time").style.marginLeft="-100%";

        var month = document.getElementById("month_appointment").innerHTML;
        var monthInNumber = "";    
        var date_ctr = 0;

        var today = new Date();
        var dd1 = String(today.getDate()).padStart(2, '0');
        today1 = dd1
        var month1 = today.getMonth();

        document.getElementById("time_appoint_p").innerHTML="00:00 - 00:00"
        document.getElementById("time_appoint_p").style.color = "black"

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


        document.getElementById("date_appoint_p").innerHTML = val+"/"+monthInNumber+"/"+year;

        var GivenDate = year+"-"+monthInNumber+"-"+val;
        var CurrentDate = new Date();
        GivenDate = new Date(GivenDate);
        var weekends = GivenDate.getDay();
      


        let dateToday = new Date().toLocaleDateString("fr-FR");


        var d = new Date();
        var Hey = d.getFullYear();
        var aheadYear = Hey+1
        
        aheadYear = aheadYear.toString();
        if(year === aheadYear){
            document.querySelector(".calendar_appointment").style.border = "1px solid red"
            document.getElementById("warning_validation_appointment").style.visibility = "visible"
            document.getElementById("error_validation_text_app").innerHTML = "You can\'t select the date from next year!"
        
            document.getElementById("sweetalert_container").style.display = "flex";
            document.getElementById("gif_alert").src="images/gif/error_validation.gif";
            document.querySelector(".header_text_validation_appointment").innerHTML = "Error!"
            document.querySelector(".header_text_validation_appointment").style.color = "red"
            document.querySelector(".message_alert").innerHTML="Sorry, You can\'t select the date from next year!"
            document.getElementById("close_alert").style.backgroundColor = "black"
            document.getElementById("date_appoint_p").style.color = "red"
        }
        else if( dateToday === todayDate){
            document.querySelector(".calendar_appointment").style.border = "1px solid red"
            document.getElementById("warning_validation_appointment").style.visibility = "visible"
            document.getElementById("error_validation_text_app").innerHTML = "You can\'t select the date today!"

            document.getElementById("sweetalert_container").style.display = "flex";
            document.getElementById("gif_alert").src="images/gif/error_validation.gif";
            document.querySelector(".header_text_validation_appointment").innerHTML = "Error!"
            document.querySelector(".header_text_validation_appointment").style.color = "red"
            document.querySelector(".message_alert").innerHTML="Sorry, You can\'t select the date today!"
            document.getElementById("close_alert").style.backgroundColor = "black"
            document.getElementById("date_appoint_p").style.color = "red"
        }
        else if( GivenDate >= CurrentDate && weekends !== 0 ){
            document.querySelector(".calendar_appointment").style.border = "none"
            document.getElementById("warning_validation_appointment").style.visibility = "hidden"
            document.getElementById("error_validation_text_app").innerHTML = "."

            document.getElementById("date_appoint_p").style.color = "rgb(29, 29, 29)"
        }
        else if( GivenDate <= CurrentDate){
            document.querySelector(".calendar_appointment").style.border = "1px solid red"
            document.getElementById("warning_validation_appointment").style.visibility = "visible"
            document.getElementById("error_validation_text_app").innerHTML = "You can\'t select from previous date!"

            document.getElementById("sweetalert_container").style.display = "flex";
            document.getElementById("gif_alert").src="images/gif/error_validation.gif";
            document.querySelector(".header_text_validation_appointment").innerHTML = "Error!"
            document.querySelector(".header_text_validation_appointment").style.color = "red"
            document.querySelector(".message_alert").innerHTML="Sorry, but you can\'t select from our previous date!"
            document.getElementById("close_alert").style.backgroundColor = "black"
            document.getElementById("date_appoint_p").style.color = "red"
        }
        else if( weekends === 0  ){
            document.querySelector(".calendar_appointment").style.border = "1px solid red"
            document.getElementById("warning_validation_appointment").style.visibility = "visible"
            document.getElementById("error_validation_text_app").innerHTML = "We have no clinic hours during Sunday!"

            document.getElementById("sweetalert_container").style.display = "flex";
            document.getElementById("gif_alert").src="images/gif/error_validation.gif";
            document.querySelector(".header_text_validation_appointment").innerHTML = "Error!"
            document.querySelector(".header_text_validation_appointment").style.color = "red"
            document.querySelector(".message_alert").innerHTML="Sorry, but we have no clinic hours during Sunday!"
            document.getElementById("close_alert").style.backgroundColor = "black"
            document.getElementById("date_appoint_p").style.color = "red"
        }


        //pagkuha ng holiday
        var holiday = document.getElementById("hidden_holiday").value;
        const holidayArray = holiday.split("(|)");
        const comparison = year+"-"+monthInNumber+"-"+val;

        
        for (l = 0 ; l<holidayArray.length ; l++){
            if(holidayArray[l] === comparison ){
                holidayCTR = "true";
                document.getElementById("sweetalert_container").style.display = "flex";
                document.getElementById("gif_alert").src="images/gif/error_validation.gif";
                document.querySelector(".header_text_validation_appointment").innerHTML = "Error!"
                document.querySelector(".header_text_validation_appointment").style.color = "red"
                document.querySelector(".message_alert").innerHTML="Sorry, but we have no clinic hours during this day!"
                document.getElementById("close_alert").style.backgroundColor = "black"
                document.getElementById("date_appoint_p").style.color = "red"
                document.getElementById("warning_validation_appointment").style.visibility = "visible"
                document.getElementById("error_validation_text_app").innerHTML = "Sorry, but we have no clinic hours during this day!"
                break;
            }
        }
}

//jquery for closing sweet alert and appointment form
$(document).ready(function(){
    $("#close_alert").click(function() {   
        $(".allInp_appoint1").val("") 
        $(".allInp_appoint2").val("") 
        $(".allInp_appoint3").val("") 
        $(".allInp_appoint4").val("") 
        $(".allInp_appoint5").val("") 
        $(".allInp_appoint6").val("") 
        $("#sweetalert_container").css({
            display: "none",
        }); 
    });

        //to close appointment form
        $("#close_appointment").click(function() {  
            $(".allInp_appoint1").val("") 
            $(".allInp_appoint2").val("") 
            $(".allInp_appoint3").val("") 
            $(".allInp_appoint4").val("") 
            $(".allInp_appoint5").val("") 
            $(".allInp_appoint6").val("") 

            $("#form_appointment").css({
                display: "none",
            });  
        });
   
});


//closing calendar
var modal_calendar = document.getElementById("calendar_container");
window.onclick = function(event) {
    if (event.target == modal_calendar) {
      modal_calendar.style.display = "none";
    }
}

//closing time
function close_time_app() {
    document.getElementById("time_container").style.display = "none";
};

//Closing date
function close_date_app(){
    document.getElementById("calendar_container").style.display = "none";
}



//email verifyer
function validateEmail($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test( $email );
}

//clicking get appointment button
function next_btn_appointment(){
    var date = document.getElementById("sched_appointment_input").value;
    var time = document.getElementById("time_appointment_input").value;


    var error_val = document.getElementById("error_validation_text_app").innerHTML;

    if(error_val === "You can\'t select from previous date!" ){
        document.getElementById("sweetalert_container").style.display = "flex";
        document.getElementById("gif_alert").src="images/gif/error_validation.gif";
        document.querySelector(".header_text_validation_appointment").innerHTML = "Error!"
        document.querySelector(".header_text_validation_appointment").style.color = "red"
        document.querySelector(".message_alert").innerHTML="Sorry, but you can\'t select from our previous date!"
        document.getElementById("close_alert").style.backgroundColor = "black"
        document.getElementById("date_appoint_p").style.color = "red"
    }
    else if(error_val === "Sorry, but we have no clinic hours during this day!"){
        document.getElementById("sweetalert_container").style.display = "flex";
        document.getElementById("gif_alert").src="images/gif/error_validation.gif";
        document.querySelector(".header_text_validation_appointment").innerHTML = "Error!"
        document.querySelector(".header_text_validation_appointment").style.color = "red"
        document.querySelector(".message_alert").innerHTML="Sorry, but we have no clinic hours during this day!"
        document.getElementById("close_alert").style.backgroundColor = "black"
        document.getElementById("date_appoint_p").style.color = "red"
        document.getElementById("warning_validation_appointment").style.visibility = "visible"
        document.getElementById("error_validation_text_app").innerHTML = "Sorry, but we have no clinic hours during this day!"
    }
    else if (error_val === "You can\'t select the date today!"){
        document.querySelector(".calendar_appointment").style.border = "1px solid red"
        document.getElementById("warning_validation_appointment").style.visibility = "visible"
        document.getElementById("error_validation_text_app").innerHTML = "You can\'t select the date today!"
    
        document.getElementById("sweetalert_container").style.display = "flex";
        document.getElementById("gif_alert").src="images/gif/error_validation.gif";
        document.querySelector(".header_text_validation_appointment").innerHTML = "Error!"
        document.querySelector(".header_text_validation_appointment").style.color = "red"
        document.querySelector(".message_alert").innerHTML="Sorry, You can\'t select the date today!"
        document.getElementById("close_alert").style.backgroundColor = "black"
        document.getElementById("date_appoint_p").style.color = "red"
    }
    else if (error_val === "We have no clinic hours during Sunday!"){
        document.getElementById("sweetalert_container").style.display = "flex";
        document.getElementById("gif_alert").src="images/gif/error_validation.gif";
        document.querySelector(".header_text_validation_appointment").innerHTML = "Error!"
        document.querySelector(".header_text_validation_appointment").style.color = "red"
        document.querySelector(".message_alert").innerHTML="Sorry, but we have no clinic hours during Sunday!"
        document.getElementById("close_alert").style.backgroundColor = "black"
        document.getElementById("date_appoint_p").style.color = "red"
    }
    else if (date === "" && time === ""){
        document.getElementById("sweetalert_container").style.display = "flex";
        document.getElementById("gif_alert").src="images/gif/error_validation.gif";
        document.querySelector(".header_text_validation_appointment").innerHTML = "Error!"
        document.querySelector(".header_text_validation_appointment").style.color = "red"
        document.querySelector(".message_alert").innerHTML="You must select a date and time!"
        document.getElementById("close_alert").style.backgroundColor = "black"

        document.getElementById("warning_validation_appointment").style.visibility = "visible"
        document.getElementById("error_validation_text_app").innerHTML = "You must select a date and time!"
        document.querySelectorAll('.td_time_app').forEach(st => {
            st.style.border="1px solid red";
        });
        document.querySelector(".calendar_appointment").style.border = "1px solid red"
        document.getElementById("date_appoint_p").style.color = "red"
        document.getElementById("time_appoint_p").style.color = "red"
    }
    else if (date === ""){
        document.getElementById("sweetalert_container").style.display = "flex";
        document.getElementById("gif_alert").src="images/gif/error_validation.gif";
        document.querySelector(".header_text_validation_appointment").innerHTML = "Error!"
        document.querySelector(".header_text_validation_appointment").style.color = "red"
        document.querySelector(".message_alert").innerHTML="You must select a date!"
        document.getElementById("close_alert").style.backgroundColor = "black"

        document.getElementById("warning_validation_appointment").style.visibility = "visible"
        document.getElementById("error_validation_text_app").innerHTML = "You must select a date!"
        document.querySelector(".calendar_appointment").style.border = "1px solid red"

        document.getElementById("date_appoint_p").style.color = "red"
    }
    else if (time=== ""){
        document.getElementById("sweetalert_container").style.display = "flex";
        document.getElementById("gif_alert").src="images/gif/error_validation.gif";
        document.querySelector(".header_text_validation_appointment").innerHTML = "Error!"
        document.querySelector(".header_text_validation_appointment").style.color = "red"
        document.querySelector(".message_alert").innerHTML="You must select a time!"
        document.getElementById("close_alert").style.backgroundColor = "black"

        document.getElementById("warning_validation_appointment").style.visibility = "visible"
        document.getElementById("error_validation_text_app").innerHTML = "You must select a time!"
        document.querySelectorAll('.td_time_app').forEach(st => {
            st.style.border="1px solid red";
        });

        document.getElementById("time_appoint_p").style.color = "red"
    }
    else if(document.getElementById("time_appoint_p").innerHTML === "00:00 - 00:00"){
        document.getElementById("sweetalert_container").style.display = "flex";
        document.getElementById("gif_alert").src="images/gif/error_validation.gif";
        document.querySelector(".header_text_validation_appointment").innerHTML = "Error!"
        document.querySelector(".header_text_validation_appointment").style.color = "red"
        document.querySelector(".message_alert").innerHTML="You must select a time!"
        document.getElementById("close_alert").style.backgroundColor = "black"

        document.getElementById("warning_validation_appointment").style.visibility = "visible"
        document.getElementById("error_validation_text_app").innerHTML = "You must select a time!"
        document.querySelectorAll('.td_time_app').forEach(st => {
            st.style.border="1px solid red";
        });

        document.getElementById("time_appoint_p").style.color = "red"
    }
    else{
        document.getElementById("form_appointment").style.display = "flex";
        document.getElementById("sched_appointment_input1").value = date;
        document.getElementById("time_appointment_input1").value = time;
        document.getElementById("form_date_span").innerHTML = date;
        document.getElementById("form_time_span").innerHTML = time;

    }
}

//remove the red validation border in form
function removeborder(val){
    document.getElementById(val).style.border = "1px solid rgb(206, 206, 206)";
    document.getElementById("validation_error_form_app").style.visibility = "hidden"
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
                document.getElementById("time_appointment_input").value = val_app;
                document.getElementById("time_appoint_p").innerHTML = val_app;
                document.getElementById("time_appoint_p").style.color = "black"
            
                document.getElementById("warning_validation_appointment").style.visibility = "hidden"
            
                document.getElementById("time_box").innerHTML = val_app;
                document.getElementById("available_time").style.display = "none"
                document.getElementById("slc_time").style.display = "block"
                $("#slc_time").animate({
                    marginLeft: "0%",
                },1000); 
            }   
            else{
                document.getElementById("sweetalert_container").style.display = "flex";
                document.getElementById("gif_alert").src="images/gif/error_validation.gif";
                document.querySelector(".header_text_validation_appointment").innerHTML = "Oops!"
                document.querySelector(".header_text_validation_appointment").style.color = "red"
                document.querySelector(".message_alert").innerHTML="This slot is already taken!"
                document.getElementById("close_alert").style.backgroundColor = "black"
        
                document.getElementById("warning_validation_appointment").style.visibility = "visible"
                document.getElementById("error_validation_text_app").innerHTML = "This slot is already taken!"
                document.getElementById("time_appoint_p").style.color = "red"
            }    
        }
    };

        xhr.open("GET", "z-Ajax-TimeSelectApp.php?time="+val_app+"&date="+date, true);
        xhr.send();
}

//close time
function close_boxTime(){
    document.getElementById("available_time").style.display = "block"
    document.getElementById("slc_time").style.display = "none"
    document.getElementById("slc_time").style.marginLeft="-100%"
}



//hover -> showing color legends
function hover_legends(){
    document.getElementById("color_legends").style.display = "block";
}
function mouseout_legends(){
    document.getElementById("color_legends").style.display = "none";
}