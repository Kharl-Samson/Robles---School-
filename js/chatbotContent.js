var s1="Pregnancy Test";
var s2="Prenatal Checkup";
var s3="Postnatal Checkup";
var s4="Delivery";
var s5="Newborn Screening";
var s6="Hearing Test";
var s7="Pap Smear";
var s8="Family Planning";
var s9="Immunization";

var prev="prev";
var next="next";


function chatbotContents(){
    var content="";

    content += '<div id="chatbot_content">'+
            '<div id="chatbot_header">'+
                '<div id="left">'+
                    '<img src="images/icons/chatbot_white.png">'+
                    '<div>'+
                        '<p id="c1">iRob</p>'+
                        '<p id="c2">I&#39;m here to help</p>'+
                    '</div>'+
                '</div>'+

                '<div id="right">'+
                    '<img src="images/icons/reload.png" id="reload_btn" onclick="reloadChat()">'+
                    '<img src="images/icons/close.png" id="closechat_btn" onclick="closeChatbot()">'+
                '</div>'+
            '</div>'+ //End of chatbot_header div

            '<div class="loader" id="loader"></div><p id="wait_text">Please wait...</p>'+

            '<div id="chat_content">'+
                '<div id="receiver1" class="receiver" style="margin-top:5%;">'+
                     '<img src="images/icons/chat_Receiver.png" title="iRob" id="irob_1">'+

                    '<div id="message_box" class="message_box">'+

                        //typing animation
                        '<div class="typing-indicator" id="replying_efffect1"><span></span><span></span><span></span><span></span><span></span></div>'+

                        '<div id="message1" class="message">'+
                            '<img src="images/icons/hello.png" id="hello_img">'+
                            '<p>Hi, I’m iRob.</p>'+
                        '</div>'+

                        //typing animation
                        '<div class="typing-indicator" id="replying_efffect2"><span></span><span></span><span></span><span></span><span></span></div>'+

                        '<div id="message2" class="message">'+
                            '<p>What’s your name?</p>'+
                        '</div>'+
                        '<div class="chat_time" id="time1"></div>'+
                         
                        '<div id="input_name">'+
                            '<div id="for_name">'+
                              '<input type="text" id="chat_name" placeholder="First name only" maxlength="15">'+
                            '</div>'+
                            '<div id="for_send">'+'<img src="images/icons/send.png" title="Submit" onclick="displayName()">'+'</div>'+
                        '</div>'+ //End of inputs div

                         //typing animation
                        '<div class="typing-indicator" id="replying_efffect3"><span></span><span></span><span></span><span></span><span></span></div>'+

                        '<div id="message3" class="message_sender">'+
                            '<p id="sender_name"></p>'+
                        '</div>'+

                        //sending animation
                        '<div class="message-indicator" id="sender_indicator">Sending<div class="line"></div><div class="line"></div><div class="line"></div></div>'+

                        '<div class="chat_time chat_right" id="time2"></div>'+
                    
                    '</div>'+//End of message_box div
                   
                '</div>'+//End of receiver div  



          '<div id="receiver1" class="receiver" style="margin-top:5%;">'+
                '<img src="images/icons/chat_Receiver.png" title="iRob" id="irob_2">'+
               '<div id="message_box" class="message_box">'+

                    //typing animation
                    '<div class="typing-indicator" id="replying_efffect4"><span></span><span></span><span></span><span></span><span></span></div>'+
                    
                    '<div id="message4" class="message">'+
                        '<img src="images/icons/hello.png" id="hello_img">'+
                        '<p id="sender_nameReceiver"></p>'+
                    '</div>'+

                    //typing animation
                    '<div class="typing-indicator" id="replying_efffect5"><span></span><span></span><span></span><span></span><span></span></div>'+
                    
                    '<div id="message5" class="message">'+
                        '<p>How can I help you today?</p>'+
                    '</div>'+

                    '<div id="message6" class="message6" onclick="appointmentChoice()">'+
                        '<img src="images/icons/appointment.png" id="hello_img">'+
                        '<p>Schedule an Appointment</p>'+
                    '</div>'+

                    '<div id="message6" class="message6" onclick="servicesOffered()">'+
                        '<img src="images/icons/service.png" id="hello_img">'+
                        '<p>Services Offered</p>'+
                    '</div>'+

                    '<div id="message6" class="message6" onclick="chooseOtherInquiries()">'+
                        '<img src="images/icons/inquiry.png" id="hello_img">'+
                        '<p>Other Inquiries</p>'+
                    '</div>'+

                    
                    '<div id="message6" class="message6">'+
                        '<img src="images/icons/feedback.png" id="hello_img">'+
                        '<p>Give Feedback</p>'+
                    '</div>'+

                    '<div class="chat_time" id="time3"></div>'+



                    '<div id="message7" class="message_sender">'+
                        '<p id="choice_todo"></p>'+
                    '</div>'+

                    //sending animation
                     '<div class="message-indicator" id="sender_indicator1" style="margin-bottom:10%;">Sending<div class="line"></div><div class="line"></div><div class="line"></div></div>'+

                     '<div class="chat_time chat_right" id="time4"></div>'+

               '</div>'+//End of message_box div
              
           '</div>'+//End of receiver div  

        //if the patient choose appointment schedule--------------------------------------------------------------------------------------                  
        '<div id="receiver1" class="receiver" style="margin-top:5%;">'+

             '<img src="images/icons/chat_Receiver.png" title="iRob" id="irob_3" class="irob_toshow">'+

             '<div id="message_box" class="message_box">'+

                    //typing animation
                    '<div class="typing-indicator" id="replying_efffect6"><span></span><span></span><span></span><span></span><span></span></div>'+
                    '<div id="message8" class="message">'+
                        '<p>Welcome to <b>Robles Maternity Clinic</b>, Our clinic is open from Monday to Saturday at 11:00am - 4:00pm.</p>'+
                    '</div>'+
         
                    //typing animation
                    '<div class="typing-indicator" id="replying_efffect7"><span></span><span></span><span></span><span></span><span></span></div>'+
                    '<div id="message9" class="message">'+
                        '<p>What are you looking for today?</p>'+
                    '</div>'+
                
                    '<div id="message10" class="message10" onclick="aboutAppointment()">'+
                        '<img src="images/icons/about_appointment.png" id="hello_img">'+
                        '<p>About Online Appointment</p>'+
                    '</div>'+

                    '<div id="message10" class="message10" onclick="chooseService()">'+
                        '<img src="images/icons/avail_service.png" id="hello_img">'+
                        '<p>Choose Available Services</p>'+
                    '</div>'+

                    '<div class="chat_time" id="time5"  style="margin-top:4%;"></div>'+


                    //if the patient choose the about online appointment
                    '<div id="message11" class="message_sender">'+
                        '<p id="choice_pick"></p>'+
                    '</div>'+

                    //sending animation
                    '<div class="message-indicator" id="sender_indicator2" style="margin-bottom:10%;">Sending<div class="line"></div><div class="line"></div><div class="line"></div></div>'+
                    '<div class="chat_time chat_right" id="time6"></div>'+

             '</div>'+//End of message_box div

        '</div>'+//End of receiver div  

        //receiver
        '<div id="receiver1" class="receiver" style="margin-top:5%;">'+

             '<img src="images/icons/chat_Receiver.png" title="iRob" id="irob_4" class="irob_toshow">'+

             '<div id="message_box" class="message_box">'+

                    //typing animation
                    '<div class="typing-indicator" id="replying_efffect8"><span></span><span></span><span></span><span></span><span></span></div>'+
                    '<div id="message12" class="message">'+
                        '<b><p>How can a patient book an appointment online?</p></b><br>'+
                        '<p>Our online scheduling allows the patients to easily request appointments for their check-ups.</p><br>'+
                        '<p>To understand how our online appointment works you can read this instructions below or you can <b style="color:#1AC8DB;;">click here</b> to watch the video.</p><br>'+
                        
                        '<p><b>1)</b> Patient can book an appoinment online at</p>'+
                        '<p style="word-break: break-all;"><b style="color:#1AC8DB;;">roblesmaternityclinic.com/appointment</b> or they can</p>'+
                        '<p>use this chatbot to make an appointment, where they can search for the available services that they are looking for.</p><br>'+
                        '<p><b>2)</b> When the patient is done looking for the services they need, They can now fill up the forms that the clinic needs to make an appointment.</p><br>'+
                        '<p><b>3)</b> After they completed the fill up forms, they can choose the desired appointment slot from Monday to friday at 11:00am - 4:00pm. If some slots are unavailable, it means that the other patient taken the given slot already or the doctor has an emergency.</p><br>'+
                        '<p><b>4)</b> After they finishes all these steps,  The patient will be notified via email and sms whether their request has been confirmed or denied. If the patient does not receive an email or sms, we recommend they contact the clinic directly. The practice phone number is listed on the clinics website footer. </p>'+
                    '</div>'+

                    '<div class="chat_time" id="time7" style="margin-bottom:3%;"></div>'+

                    '<div id="message13" class="message13" onclick="doneReading()">'+
                        '<img src="images/icons/done_reading.png" id="hello_img">'+
                        '<p>Done Reading</p>'+
                    '</div>'+

             '</div>'+//End of message_box div

        '</div>'+//End of receiver div  

        //if she choose available services
         //receiver
         '<div id="receiver1" class="receiver">'+

            '<img src="images/icons/chat_Receiver.png" title="iRob" id="irob_5" class="irob_toshow">'+

            '<div id="message_box" class="message_box">'+
                //typing animation
                '<div class="typing-indicator" id="replying_efffect9"><span></span><span></span><span></span><span></span><span></span></div>'+
                '<div id="message14" class="message">'+
                    '<p>What service are you looking for today?</p>'+
                '</div>'+
                '<div class="chat_time" id="time8" style="margin-bottom:3%; margin-left:5%;"></div>'+

            '</div>'+//End of message_box div

        '</div>'+//End of receiver div  


        '<div id="receiver1" class="receiver">'+

        '<div id="message_box1" class="message_box">'+

        '<div id="message15" class="message" style="margin-bottom:3%;">'+
            '<div id="input_service">'+
                '<div id="for_name">'+
                    '<input type="text" id="service_name" placeholder="Select a service" onkeyup="filterService()">'+
                '</div>'+
                '<div id="for_send">'+'<img src="images/icons/search_gif.gif">'+'</div>'+
            '</div>'+ //End of inputs div
            '<p>Available Services</p>'+

            '<div id="for_table">'+
                '<table id="table_chat">'+
                    '<tr>'+
                        '<td>'+
                        '<div class="tilting_services">'+
                            '<img src="images/services/pt_test.png" style="margin-top:10%;">'+
                            '<p id="ser_name">Pregnancy Test</p>'+
                            '<button  onclick="return clickIndivService(s1)">Select</button>'+
                        '</div>'+
                        '</td>'+
                        '<td>'+
                        '<div class="tilting_services">'+
                            '<img src="images/services/prenatal.png" style="margin-top:10%;">'+
                            '<p id="ser_name">Prenatal Checkup</p>'+
                            '<button  onclick="return clickIndivService(s2)">Select</button>'+
                        '</div>'+
                        '</td>'+
                        '<td>'+
                        '<div class="tilting_services">'+
                            '<img src="images/services/postnatal.png" style="margin-top:10%;">'+
                            '<p id="ser_name">Postnatal Checkup</p>'+
                            '<button  onclick="return clickIndivService(s3)">Select</button>'+
                        '</div>'+
                        '</td>'+
                        '<td>'+
                        '<div class="tilting_services">'+
                            '<img src="images/services/delivery.png" style="margin-top:10%;">'+
                            '<p id="ser_name">Delivery</p>'+
                            '<button  onclick="return clickIndivService(s4)">Select</button>'+
                        '</div>'+
                        '</td>'+
                        '<td>'+
                        '<div class="tilting_services">'+
                            '<img src="images/services/newborn.png" style="margin-top:10%;">'+
                            '<p id="ser_name">Newborn Screening</p>'+
                            '<button  onclick="return clickIndivService(s5)">Select</button>'+
                        '</div>'+
                        '</td>'+
                        '<td>'+
                        '<div class="tilting_services">'+
                            '<img src="images/services/hearing.png" style="margin-top:10%;">'+
                            '<p id="ser_name">Hearing Test</p>'+
                            '<button  onclick="return clickIndivService(s6)">Select</button>'+
                        '</div>'+
                        '</td>'+
                        '<td>'+
                        '<div class="tilting_services">'+
                            '<img src="images/services/papsmear.png" style="margin-top:10%;">'+
                            '<p id="ser_name">Pap Smear</p>'+
                            '<button  onclick="return clickIndivService(s7)">Select</button>'+
                        '</div>'+
                        '</td>'+
                        '<td>'+
                        '<div class="tilting_services">'+
                            '<img src="images/services/familyplanning.png" style="margin-top:10%;">'+
                            '<p id="ser_name">Family Planning</p>'+
                            '<button  onclick="return clickIndivService(s8)">Select</button>'+
                        '</div>'+
                        '</td>'+
                        '<td>'+
                        '<div class="tilting_services">'+
                            '<img src="images/services/immun.png" style="margin-top:10%;">'+
                            '<p id="ser_name">Immunization</p>'+
                            '<button  onclick="return clickIndivService(s9)">Select</button>'+
                        '</div>'+
                        '</td>'+
                    '</tr>'+
                '</table>'+
            '</div>'+
        '</div>'+


        '</div>'+//End of message_box div

    '</div>'+//End of receiver div  

        //receiver
        '<div id="receiver1" class="receiver">'+
            '<div id="message_box" class="message_box">'+

                '<div id="message16" class="message_sender">'+
                    '<p id="service_choosen"></p>'+
                '</div>'+

                //sending animation
                '<div class="message-indicator" id="sender_indicator3" style="margin-top:-1%;margin-bottom:3%;">Sending<div class="line"></div><div class="line"></div><div class="line"></div></div>'+

               '<div class="chat_time chat_right" id="time9" style="margin-bottom:3%; margin-left:5%; margin-top:-1%;"></div>'+

            '</div>'+//End of message_box div
        '</div>'+//End of receiver div  


        //receiver
        '<div id="receiver1" class="receiver">'+

            '<img src="images/icons/chat_Receiver.png" title="iRob" id="irob_6" class="irob_toshow">'+

            '<div id="message_box" class="message_box">'+
                //typing animation
                '<div class="typing-indicator" id="replying_efffect10"><span></span><span></span><span></span><span></span><span></span></div>'+
                '<div id="message17" class="message">'+
                    '<p>What is the name of patient?</p>'+
                '</div>'+

                '<div class="chat_time" id="time10" style="margin-bottom:3%;"></div>'+

                '<div id="input_name_service">'+
                    '<input type="text" id="fname_f_service" placeholder="First Name">'+
                    '<input type="text" id="mname_f_service" placeholder="Middle Name (Optional)">'+
                    '<input type="text" id="lname_f_service" placeholder="Last Name">'+
                    '<button onclick="sendFullname()">Send <img src="images/icons/send.png"></button>'+
                '</div>'+ //End of inputs div
            
                '<div id="message18" class="message_sender">'+
                    '<p id="fullname_service"></p>'+
                '</div>'+

                //sending animation
                '<div class="message-indicator" id="sender_indicator4" style="margin-top:-1%;margin-bottom:3%;">Sending<div class="line"></div><div class="line"></div><div class="line"></div></div>'+

                '<div class="chat_time chat_right" id="time11" style="margin-bottom:3%; margin-left:5%; margin-top:-1%;"></div>'+

             '</div>'+//End of message_box div

        '</div>'+//End of receiver div  

                
        //receiver
        '<div id="receiver1" class="receiver">'+

                '<img src="images/icons/chat_Receiver.png" title="iRob" id="irob_7" class="irob_toshow">'+
    
                '<div id="message_box" class="message_box">'+
                    //typing animation
                    '<div class="typing-indicator" id="replying_efffect11"><span></span><span></span><span></span><span></span><span></span></div>'+
                    '<div id="message19" class="message">'+
                        '<p>What is the address of patient?</p>'+
                    '</div>'+
    
                    '<div class="chat_time" id="time12" style="margin-bottom:3%;"></div>'+
    
                    '<div id="input_add_service">'+
                        '<input type="text" id="bar_4_service" placeholder="Barangay">'+
                        '<input type="text" id="mun_4_service" placeholder="Municipality">'+
                        '<input type="text" id="prov_4_service" placeholder="Province">'+
                        '<button onclick="sendFulladd()">Send <img src="images/icons/send.png"></button>'+
                    '</div>'+ //End of inputs div
                
                    '<div id="message20" class="message_sender">'+
                        '<p id="fulladd_service"></p>'+
                    '</div>'+
    
                    //sending animation
                    '<div class="message-indicator" id="sender_indicator5" style="margin-top:-1%;margin-bottom:3%;">Sending<div class="line"></div><div class="line"></div><div class="line"></div></div>'+
    
                    '<div class="chat_time chat_right" id="time13" style="margin-bottom:3%; margin-left:5%; margin-top:-1%;"></div>'+
    
                 '</div>'+//End of message_box div
                 
        '</div>'+//End of receiver div  

        //receiver
        '<div id="receiver1" class="receiver">'+

            '<img src="images/icons/chat_Receiver.png" title="iRob" id="irob_8" class="irob_toshow">'+

            '<div id="message_box" class="message_box">'+
                    //typing animation
                    '<div class="typing-indicator" id="replying_efffect12"><span></span><span></span><span></span><span></span><span></span></div>'+
                    '<div id="message21" class="message">'+
                        '<p>Which <b>date</b> would you like to schedule your visit for?</p>'+
                    '</div>'+
    
            '</div>'+//End of message_box div
        '</div>'+//End of receiver div  

        //calendar
        '<div class="calendar" id="calendar_chat">'+
            '<div class="month">'+
                '<div class="prev" onclick="moveDate(prev)">'+
                    '<span>&#10094;</span>'+
                '</div>'+

                '<div>'+
                    '<h2 id="month"></h2>'+
            
                '</div>'+

                '<div class="next" onclick="moveDate(next)">'+
                    '<span>&#10095;</span>'+
                '</div>'+

            '</div>'+
            '<div class="weekdays">'+
            
                '<div>Mon</div>'+
                '<div>Tue</div>'+
                '<div>Wed</div>'+
                '<div>Thu</div>'+
                '<div>Fri</div>'+
                '<div>Sat</div>'+
                '<div>Sun</div>'+

            '</div>'+

            '<div class="days">'+
            '</div>'+

        '</div>'+//end of calendar div
    
        //-------------------------------------------------------------------------------------------------------

        //if the patient choose services offered                 
        '<div id="receiver1" class="receiver" style="margin-top:-6%;">'+

             '<img src="images/icons/chat_Receiver.png" title="iRob" id="irob_9" class="irob_toshow">'+

             '<div id="message_box" class="message_box">'+

                    //typing animation
                    '<div class="typing-indicator" id="replying_efffect13"><span></span><span></span><span></span><span></span><span></span></div>'+
                    '<div id="message22" class="message">'+
                        '<p>Welcome to <b>Robles Maternity Clinic</b>, to learn more about our available services you can directly<br> go to <b style="color:#1AC8DB;;">roblesmaternity<br>clinic.com/services</b> or you can use this chat provide our list of our services. </p>'+
                    '</div>'+
         
                    //typing animation
                    '<div class="typing-indicator" id="replying_efffect14"><span></span><span></span><span></span><span></span><span></span></div>'+
                    '<div id="message23" class="message">'+
                        '<p>Here are the services offered by Robles Maternity Clinic.</p>'+
                    '</div>'+
    

             '</div>'+//End of message_box div

        '</div>'+//End of receiver div  



        '<div id="receiver1" class="receiver">'+

        '<div id="message_box1" class="message_box">'+

        '<div id="message24" class="message" style="margin-bottom:3%;">'+
            '<div id="input_service">'+
                '<div id="for_name">'+
                    '<input type="text" id="service_name" class="service_name1" placeholder="Search for a service" onkeyup="filterService1()">'+
                '</div>'+
                '<div id="for_send">'+'<img src="images/icons/search_gif.gif">'+'</div>'+
            '</div>'+ //End of inputs div
            '<p>Available Services</p>'+

            '<div id="for_table">'+
                '<table id="table_chat1">'+
                    '<tr>'+
                        '<td>'+
                        '<div class="tilting_services">'+
                            '<img src="images/services/pt_test.png" style="margin-top:10%;">'+
                            '<p id="ser_name">Pregnancy Test</p>'+
                            '<button>Read More...</button>'+
                        '</div>'+
                        '</td>'+
                        '<td>'+
                        '<div class="tilting_services">'+
                            '<img src="images/services/prenatal.png" style="margin-top:10%;">'+
                            '<p id="ser_name">Prenatal Checkup</p>'+
                            '<button>Read More...</button>'+
                        '</div>'+
                        '</td>'+
                        '<td>'+
                        '<div class="tilting_services">'+
                            '<img src="images/services/postnatal.png" style="margin-top:10%;">'+
                            '<p id="ser_name">Postnatal Checkup</p>'+
                            '<button>Read More...</button>'+
                        '</div>'+
                        '</td>'+
                        '<td>'+
                        '<div class="tilting_services">'+
                            '<img src="images/services/delivery.png" style="margin-top:10%;">'+
                            '<p id="ser_name">Delivery</p>'+
                            '<button>Read More...</button>'+
                        '</div>'+
                        '</td>'+
                        '<td>'+
                        '<div class="tilting_services">'+
                            '<img src="images/services/newborn.png" style="margin-top:10%;">'+
                            '<p id="ser_name">Newborn Screening</p>'+
                            '<button>Read More...</button>'+
                        '</div>'+
                        '</td>'+
                        '<td>'+
                        '<div class="tilting_services">'+
                            '<img src="images/services/hearing.png" style="margin-top:10%;">'+
                            '<p id="ser_name">Hearing Test</p>'+
                            '<button>Read More...</button>'+
                        '</div>'+
                        '</td>'+
                        '<td>'+
                        '<div class="tilting_services">'+
                            '<img src="images/services/papsmear.png" style="margin-top:10%;">'+
                            '<p id="ser_name">Pap Smear</p>'+
                            '<button>Read More...</button>'+
                        '</div>'+
                        '</td>'+
                        '<td>'+
                        '<div class="tilting_services">'+
                            '<img src="images/services/familyplanning.png" style="margin-top:10%;">'+
                            '<p id="ser_name">Family Planning</p>'+
                            '<button>Read More...</button>'+
                        '</div>'+
                        '</td>'+
                        '<td>'+
                        '<div class="tilting_services">'+
                            '<img src="images/services/immun.png" style="margin-top:10%;">'+
                            '<p id="ser_name">Immunization</p>'+
                            '<button>Read More...</button>'+
                        '</div>'+
                        '</td>'+
                    '</tr>'+
                '</table>'+
            '</div>'+
        '</div>'+

        '<div id="message25" class="message25" onclick="doneReading1()">'+
            '<img src="images/icons/done_reading.png" id="hello_img">'+
            '<p>Done Reading</p>'+
        '</div>'+

        '</div>'+//End of message_box div
    '</div>'+//End of receiver div  

    //---------------------------------------------------------------------

     //if the patient choose other inquries           
     '<div id="receiver1" class="receiver">'+

     '<img src="images/icons/chat_Receiver.png" title="iRob" id="irob_10" class="irob_toshow">'+

     '<div id="message_box" class="message_box">'+

            //typing animation
            '<div class="typing-indicator" id="replying_efffect15"><span></span><span></span><span></span><span></span><span></span></div>'+
            '<div id="message26" class="message">'+
                '<p>Welcome to <b>Robles Maternity Clinic</b>, Please fill up the form to make your personal inquries. Thank you! </p>'+
            '</div>'+
 
            //typing animation
            '<div class="typing-indicator" id="replying_efffect16"><span></span><span></span><span></span><span></span><span></span></div>'+
            '<div id="message27" class="message">'+
                '<p>What’s your name?</p>'+
            '</div>'+
            '<div class="chat_time" id="time14"></div>'+
         
            '<div id="input_name_for_otherInquiry" style="margin-bottom:43%;">'+
                '<div id="for_name">'+
                    '<input type="text" id="chat_name1" placeholder="Your name here" maxlength="40" required>'+
                '</div>'+
                '<div id="for_send">'+'<img src="images/icons/send.png" title="Submit" onclick="displayNameonInquiry()">'+'</div>'+
            '</div>'+ //End of inputs div

            '<div id="message28" class="message_sender">'+
                '<p id="name_onInquiry"></p>'+
            '</div>'+

            //sending animation
            '<div class="message-indicator" id="sender_indicator6" style="margin-top:-1%;margin-bottom:3%;">Sending<div class="line"></div><div class="line"></div><div class="line"></div></div>'+

            '<div class="chat_time chat_right" id="time15" style="margin-bottom:3%; margin-left:5%; margin-top:-1%;"></div>'+

     '</div>'+//End of message_box div

     '</div>'+//End of receiver div  



     '<div id="receiver1" class="receiver">'+

     '<img src="images/icons/chat_Receiver.png" title="iRob" id="irob_11" class="irob_toshow">'+

     '<div id="message_box" class="message_box">'+
 
            //typing animation
            '<div class="typing-indicator" id="replying_efffect17"><span></span><span></span><span></span><span></span><span></span></div>'+
            '<div id="message29" class="message">'+
                '<p>and your email?</p>'+
            '</div>'+
            '<div id="message31" class="message">'+
                '<p>Please give a valid email. e.g.. Robles@gmail.com</p>'+
            '</div>'+
            '<div class="chat_time" id="time16"></div>'+

            '<div id="input_email_for_otherInquiry" style="margin-bottom:43%;">'+
                '<div id="for_name">'+
                    '<input type="email" id="chat_email" placeholder="Your email here" maxlength="40" required>'+
                '</div>'+
                '<div id="for_send">'+'<img src="images/icons/send.png" title="Submit" onclick="displayEmailonInquiry()">'+'</div>'+
            '</div>'+ //End of inputs div

            '<div id="message30" class="message_sender" style="margin-top:3%;">'+
                '<p id="email_onInquiry"></p>'+
            '</div>'+

            //sending animation
            '<div class="message-indicator" id="sender_indicator7" style="margin-top:-1%;margin-bottom:3%;">Sending<div class="line"></div><div class="line"></div><div class="line"></div></div>'+

            '<div class="chat_time chat_right" id="time17" style="margin-bottom:3%; margin-left:5%; margin-top:-1%;"></div>'+
            
     '</div>'+//End of message_box div

     '</div>'+//End of receiver div  




    

           ' </div>'+//End of chat_content div
        '</div>';//End of chatbot_content div

        document.getElementById("chatbot_container").innerHTML = content;
}

chatbotContents();


//calendar chatbot
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
    document.getElementById("month").innerHTML = months[dt.getMonth()];

    var cells = "";
    for (x = day; x > 0; x--) {
        cells += "<div class='prev_date'>" + (prevDate - x + 1) + "</div>";
    }
    console.log(day);
    for (i = 1; i <= endDate; i++) {
        if (i == today.getDate() && dt.getMonth() == today.getMonth()) cells += "<div class='today'>" + i + "</div>";
        else
            cells += "<div>" + i + "</div>";
    }
    document.getElementsByClassName("days")[0].innerHTML = cells;

}

function moveDate(para) {
    if(para == "prev") {
        var chat_content = document.getElementById("chat_content");
        chat_content.scrollTop = chat_content.scrollHeight;
        dt.setMonth(dt.getMonth() - 1);
    } else if(para == 'next') {
        var chat_content = document.getElementById("chat_content");
        chat_content.scrollTop = chat_content.scrollHeight;
        dt.setMonth(dt.getMonth() + 1);
    }
    renderDate();
}



//Reload current page
function reloadChat()
{ 
   document.getElementById("chat_content").style.display = "none";
   document.getElementById("reload_btn").style.display = "none";

    //loader starts for 5 seconds
    $("#loader").show().delay(7000).fadeOut();
    $("#wait_text").show().delay(7000).fadeOut();
    //after mareload ng 3 seconds mag sshow to
    setTimeout(function(){
    //text box1
    setTimeout(function() {
        document.getElementById("replying_efffect1").style.display="flex";
        document.getElementById("irob_1").style.display="flex";
      },0);
  
      function replyingFunction1s() {
        setInterval(function(){ 
           document.getElementById("replying_efffect1").style.display="none";
           document.getElementById("message1").style.display="flex";
         }, 2000);
      }
      replyingFunction1s();
  
  
      //text box2
      setTimeout(function() {
          document.getElementById("replying_efffect2").style.display="flex";
      },2000);
  
      function replyingFunction2s() {
          var today = new Date();
          var time = today.toLocaleTimeString([], {timeStyle: 'short'});
          setTimeout(function(){
              document.getElementById("replying_efffect2").style.display="none";
              document.getElementById("message2").style.display="flex";
              document.getElementById("input_name").style.display="flex";
              document.getElementById("time1").style.display="block";
              document.getElementById("time1").innerHTML=time;
          },3000)
      }
      replyingFunction2s();

     chatbotContents();
   },7000)
}

//close chatbot
function closeChatbot(){
    document.getElementById("chatbot_container").style.display="none";
}

//filter
function filterService() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("service_name");
    filter = input.value.toUpperCase();
    table = document.getElementById("table_chat");
    tr = table.getElementsByTagName("td");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("div")[0];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }

  function filterService1() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.querySelector('.service_name1');
    filter = input.value.toUpperCase();
    table = document.getElementById("table_chat1");
    tr = table.getElementsByTagName("td");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("div")[0];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }






