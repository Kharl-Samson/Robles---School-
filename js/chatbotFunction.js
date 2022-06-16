//automatically scroll down
function scrollDown(){
  var chat_content = document.getElementById("chat_content");
  chat_content.scrollTop = chat_content.scrollHeight;
}

//opening chatbot
var countForChatS = localStorage.getItem("count") || 0; //holding cookie storage temporarily
function openChatbot(){
     

  localStorage.setItem("chat", countForChatS);

  if(localStorage.getItem('chat') == 0){//pag null ang value mag sshow
    countForChatS++;

    document.getElementById("chatbot_container").style.display="block";

    //text box1
    setTimeout(function() {
      document.getElementById("replying_efffect1").style.display="flex";
      document.getElementById("irob_1").style.display="flex";
    },0);

    function replyingFunction1() {
      setInterval(function(){ 
         document.getElementById("replying_efffect1").style.display="none";
         document.getElementById("message1").style.display="flex";
       }, 2000);
    }
    replyingFunction1();


    //text box2
    setTimeout(function() {
        document.getElementById("replying_efffect2").style.display="flex";
    },2000);

    function replyingFunction2() {
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
    replyingFunction2();

  }
  else{
    document.getElementById("chatbot_container").style.display="block";
  }

}



//sender name
function displayName(){
    var today = new Date();
    var time = today.toLocaleTimeString([], {timeStyle: 'short'});

      var name = document.getElementById("chat_name").value;
      if(name == ""){}
      else{
          document.getElementById("sender_name").innerHTML= name;
          String.prototype.capitalize = function() {
            return this.charAt(0).toUpperCase() + this.slice(1);
           }
           name = name.split(' ').join('');
          name = "Hi,&nbsp;"+name.capitalize()+"!";
          document.getElementById("sender_nameReceiver").innerHTML= name;
          document.getElementById("message3").style.display="flex";

          document.getElementById("input_name").style.display="none";
          document.getElementById("sender_indicator").style.display="block";

          setInterval(function(){ 
            document.getElementById("sender_indicator").style.display="none";
          }, 2000);
          setTimeout(function(){
            document.getElementById("time2").style.display="block";
            document.getElementById("time2").innerHTML=time;
            document.getElementById("replying_efffect4").style.display="flex";
            document.getElementById("irob_2").style.display="flex";
          },2000)


          function replyingFunction3() {
            var today = new Date();
            var time = today.toLocaleTimeString([], {timeStyle: 'short'});
            setTimeout(function(){
              document.getElementById("replying_efffect4").style.display="none";
              document.getElementById("message4").style.display="flex";
            },4000)
          }
          replyingFunction3();

          setTimeout(function() {
            document.getElementById("replying_efffect5").style.display="flex";
          },4000);

          function replyingFunction4() {
            var today = new Date();
            var time = today.toLocaleTimeString([], {timeStyle: 'short'});
            setTimeout(function(){
              document.getElementById("replying_efffect5").style.display="none";
              document.getElementById("message5").style.display="flex";
              document.querySelectorAll('.message6').forEach(st => {
                st.style.display="flex";
              });
              document.getElementById("time3").style.display="block";
              document.getElementById("time3").innerHTML=time;
              location.href = "#message5";
            },5000)
          }
          replyingFunction4();

  }

}


function appointmentChoice(){
  var today = new Date();
  var time = today.toLocaleTimeString([], {timeStyle: 'short'});

  document.getElementById("choice_todo").innerHTML= "Schedule an Appointment";
  document.getElementById("message7").style.display="flex";
  document.getElementById("time3").style.marginBottom="4%";
  document.querySelectorAll('.message6').forEach(st => {
    st.style.display="none";
  });
  document.getElementById("sender_indicator1").style.display="block";
  scrollDown();

  setInterval(function(){ 
    document.getElementById("sender_indicator1").style.display="none";
  }, 2000);

  setTimeout(function(){
      document.getElementById("time4").style.display="block";
      document.getElementById("time4").innerHTML=time;
      document.getElementById("irob_3").style.display="flex";
      document.getElementById("replying_efffect6").style.display="flex";
      scrollDown();
  },2000)

  function replyingFunction5() {
    var today = new Date();
    var time = today.toLocaleTimeString([], {timeStyle: 'short'});
    document.getElementById("time5").style.marginBottom="4%";
    setTimeout(function(){
      document.getElementById("replying_efffect6").style.display="none";
      document.getElementById("message8").style.display="flex";
      document.getElementById("replying_efffect7").style.display="flex";
      scrollDown();
    },4000)

    setTimeout(function(){
      document.getElementById("replying_efffect7").style.display="none";
      document.getElementById("message9").style.display="flex";
      document.querySelectorAll('.message10').forEach(st => {
        st.style.display="flex";
      });
      document.getElementById("time5").style.display="block";
      document.getElementById("time5").innerHTML=time;
      scrollDown();
    },5000)
  }
  replyingFunction5();
}


function aboutAppointment(){
  var today = new Date();
  var time = today.toLocaleTimeString([], {timeStyle: 'short'});

  document.getElementById("choice_pick").innerHTML= "About Online Appointment";
  document.getElementById("message11").style.display="flex";
  document.querySelectorAll('.message10').forEach(st => {
    st.style.display="none";
  });
  
  document.getElementById("sender_indicator2").style.display="block";

  setInterval(function(){ 
    document.getElementById("sender_indicator2").style.display="none";
  }, 2000);

  setTimeout(function(){
    document.getElementById("time6").style.display="block";
    document.getElementById("time6").innerHTML=time;
    document.getElementById("irob_4").style.display="flex";
    document.getElementById("replying_efffect8").style.display="flex";
    scrollDown();
  },2000)

  function replyingFunction6() {
    var today = new Date();
    var time = today.toLocaleTimeString([], {timeStyle: 'short'});
    setTimeout(function(){
      document.getElementById("replying_efffect8").style.display="none";
      document.getElementById("message12").style.display="flex";
      document.getElementById("message13").style.display="flex";
      document.getElementById("time7").style.display="block";
      document.getElementById("time7").innerHTML=time;
      location.href = "#message12";
    },4000)
  }
  replyingFunction6();
}


function doneReading(){
  document.getElementById("irob_4").style.display="none";
  document.getElementById("time6").style.display="none";
  document.getElementById("time7").style.display="none";
  document.getElementById("message11").style.display="none";
  document.getElementById("message12").style.display="none";
  document.getElementById("message13").style.display="none";
  document.querySelectorAll('.message10').forEach(st => {
    st.style.display="flex";
  });
}


function chooseService(){
  var today = new Date();
  var time = today.toLocaleTimeString([], {timeStyle: 'short'});
  
  document.getElementById("choice_pick").innerHTML= "Choose Available Services";
  document.getElementById("message11").style.display="flex";
  document.querySelectorAll('.message10').forEach(st => {
    st.style.display="none";
  });

  document.getElementById("sender_indicator2").style.display="block";

  setInterval(function(){ 
    document.getElementById("sender_indicator2").style.display="none";
  }, 2000);

  setTimeout(function(){
    document.getElementById("time6").style.display="block";
    document.getElementById("time6").innerHTML=time;
    document.getElementById("irob_5").style.display="flex";
    document.getElementById("replying_efffect9").style.display="flex";
    scrollDown();
  },2000)

  function replyingFunction7() {
    var today = new Date();
    var time = today.toLocaleTimeString([], {timeStyle: 'short'});
    setTimeout(function(){
      document.getElementById("time8").style.display="block";
      document.getElementById("time8").innerHTML=time;
      document.getElementById("replying_efffect9").style.display="none";
      document.getElementById("message14").style.display="flex";
      document.getElementById("message15").style.display="block";
      scrollDown();
    },4000)
  }
  replyingFunction7();
}

function clickIndivService(val){
  scrollDown();
  var today = new Date();
  var time = today.toLocaleTimeString([], {timeStyle: 'short'});

  document.getElementById("message15").style.display="none";
  document.getElementById("service_choosen").innerHTML=val;
  document.getElementById("message16").style.display="flex";
  document.getElementById("sender_indicator3").style.display="block";

  setTimeout(function(){ 
    document.getElementById("sender_indicator3").style.display="none";
    document.getElementById("time9").style.display="block";
    document.getElementById("time9").innerHTML=time;
    scrollDown();
  }, 2000);

  setTimeout(function(){ 
    document.getElementById("irob_6").style.display="flex";
    document.getElementById("replying_efffect10").style.display="flex";
    scrollDown();
  }, 2000);

  setTimeout(function(){ 
    document.getElementById("replying_efffect10").style.display="none";
    document.getElementById("message17").style.display="flex";
    document.getElementById("input_name_service").style.display="flex";
    scrollDown();
  }, 4000);
}

function sendFullname(){
  var today = new Date();
  var time = today.toLocaleTimeString([], {timeStyle: 'short'});
  var fname = document.getElementById("fname_f_service").value;
  var mname = document.getElementById("mname_f_service").value;
  var lname = document.getElementById("lname_f_service").value;

      if(fname !=="" && lname !==""){
        String.prototype.capitalize = function() {
          return this.charAt(0).toUpperCase() + this.slice(1);
         }
        var fullname = fname.capitalize()+" "+mname.capitalize()+" "+lname.capitalize();

        document.getElementById("input_name_service").style.display="none";
        document.getElementById("time10").style.display="block";
        document.getElementById("time10").innerHTML=time;
        document.getElementById("sender_indicator4").style.display="block";
        document.getElementById("fullname_service").innerHTML=fullname;
        document.getElementById("message18").style.display="flex";

        setTimeout(function(){ 
          var today = new Date();
          var time = today.toLocaleTimeString([], {timeStyle: 'short'});
          document.getElementById("sender_indicator4").style.display="none";
          document.getElementById("time11").style.display="block";
          document.getElementById("time11").innerHTML=time;

          document.getElementById("irob_7").style.display="flex";
          document.getElementById("replying_efffect11").style.display="flex";
          scrollDown();
        }, 2000);

        setTimeout(function(){ 
          document.getElementById("replying_efffect11").style.display="none";
          document.getElementById("message19").style.display="flex";
          document.getElementById("input_add_service").style.display="flex";
          scrollDown();
        }, 4000);
        
        

      }
      else if(fname ===""  && lname !== ""){
        document.getElementById("fname_f_service").style.borderBottomColor="red";
        document.getElementById("lname_f_service").style.borderBottomColor="#1AC8DB";
      }
      else if(fname !==""  && lname === ""){
        document.getElementById("lname_f_service").style.borderBottomColor="red";
        document.getElementById("fname_f_service").style.borderBottomColor="#1AC8DB";
      }
      else if(fname ===""  && lname === ""){
        document.getElementById("lname_f_service").style.borderBottomColor="red";
        document.getElementById("fname_f_service").style.borderBottomColor="red";
      }
  
}


function sendFulladd(){
  var today = new Date();
  var time = today.toLocaleTimeString([], {timeStyle: 'short'});

  var bar = document.getElementById("bar_4_service").value;
  var mun = document.getElementById("mun_4_service").value;
  var prov = document.getElementById("prov_4_service").value;

  if( bar !=="" && mun !=="" && prov !=="" ){
    String.prototype.capitalize = function() {
      return this.charAt(0).toUpperCase() + this.slice(1);
     }
    var fulladd = bar.capitalize()+", "+mun.capitalize()+", "+prov.capitalize();
    
    document.getElementById("input_add_service").style.display="none";
    document.getElementById("time12").style.display="block";
    document.getElementById("time12").innerHTML=time;
    document.getElementById("sender_indicator5").style.display="block";
    document.getElementById("fulladd_service").innerHTML=fulladd;
    document.getElementById("message20").style.display="flex";

    setTimeout(function(){ 
      var today = new Date();
      var time = today.toLocaleTimeString([], {timeStyle: 'short'});

      document.getElementById("sender_indicator5").style.display="none";
      document.getElementById("time13").style.display="block";
      document.getElementById("time13").innerHTML=time;

      document.getElementById("irob_8").style.display="flex";
      document.getElementById("replying_efffect12").style.display="flex";
      scrollDown();
    }, 2000);

    setTimeout(function(){ 
      var today = new Date();
      var time = today.toLocaleTimeString([], {timeStyle: 'short'});

      document.getElementById("replying_efffect12").style.display="none";
      document.getElementById("message21").style.display="flex";
      document.getElementById("calendar_chat").style.display="block";
      scrollDown();
    }, 4000);


  }
  else if(bar !==""  && mun === "" && prov === ""){
    document.getElementById("mun_4_service").style.borderBottomColor="red";
    document.getElementById("prov_4_service").style.borderBottomColor="red";
    document.getElementById("bar_4_service").style.borderBottomColor="#1AC8DB";
  }
  else if(bar ===""  && mun !== "" && prov === ""){
    document.getElementById("bar_4_service").style.borderBottomColor="red";
    document.getElementById("prov_4_service").style.borderBottomColor="red";
    document.getElementById("mun_4_service").style.borderBottomColor="#1AC8DB";
  }
  else if(bar ===""  && mun === "" && prov !== ""){
    document.getElementById("bar_4_service").style.borderBottomColor="red";
    document.getElementById("mun_4_service").style.borderBottomColor="red";
    document.getElementById("prov_4_service").style.borderBottomColor="#1AC8DB";
  }
  else if(bar ===""  && mun !== "" && prov !== ""){
    document.getElementById("bar_4_service").style.borderBottomColor="red";
    document.getElementById("mun_4_service").style.borderBottomColor="#1AC8DB";
    document.getElementById("prov_4_service").style.borderBottomColor="#1AC8DB";
  }
  else if(bar !==""  && mun === "" && prov !== ""){
    document.getElementById("mun_4_service").style.borderBottomColor="red";
    document.getElementById("bar_4_service").style.borderBottomColor="#1AC8DB";
    document.getElementById("prov_4_service").style.borderBottomColor="#1AC8DB";
  }
  else if(bar !==""  && mun !== "" && prov === ""){
    document.getElementById("prov_4_service").style.borderBottomColor="red";
    document.getElementById("bar_4_service").style.borderBottomColor="#1AC8DB";
    document.getElementById("mun_4_service").style.borderBottomColor="#1AC8DB";
  }
  else if(bar ===""  && mun === "" && prov === ""){
    document.getElementById("bar_4_service").style.borderBottomColor="red";
    document.getElementById("mun_4_service").style.borderBottomColor="red";
    document.getElementById("prov_4_service").style.borderBottomColor="red";
  }
  
}


//----------------------------------------------------------------------------------------------
function servicesOffered(){

  var today = new Date();
  var time = today.toLocaleTimeString([], {timeStyle: 'short'});

  document.getElementById("choice_todo").innerHTML= "Services Offered";
  document.getElementById("message7").style.display="flex";
  document.querySelectorAll('.message6').forEach(st => {
    st.style.display="none";
  });
  document.getElementById("sender_indicator1").style.display="block";
  scrollDown();

  setTimeout(function(){ 
    document.getElementById("sender_indicator1").style.display="none";
    document.getElementById("time4").style.display="block";
    document.getElementById("time4").innerHTML=time;
    document.getElementById("irob_9").style.display="flex";
    document.getElementById("replying_efffect13").style.display="flex";
    scrollDown();
  }, 2000);

  setTimeout(function(){ 
    document.getElementById("replying_efffect13").style.display="none";
    document.getElementById("message22").style.display="flex";
    document.getElementById("replying_efffect14").style.display="flex";
    scrollDown();
  }, 4000);

  setTimeout(function(){ 
    document.getElementById("replying_efffect14").style.display="none";
    document.getElementById("message23").style.display="flex";
    document.getElementById("message24").style.display="block";
    document.getElementById("message25").style.display="flex";
    scrollDown();
  }, 5000);
}

function doneReading1(){
  document.getElementById("irob_9").style.display="none";
  document.getElementById("time4").style.display="none";
  document.getElementById("message7").style.display="none";
  document.getElementById("message22").style.display="none";
  document.getElementById("message23").style.display="none";
  document.getElementById("message24").style.display="none";
  document.getElementById("message25").style.display="none";
  document.querySelectorAll('.message6').forEach(st => {
    st.style.display="flex";
  });
  location.href = "#message5";
}



//-------------------------------------------------------------------
function chooseOtherInquiries(){
  var today = new Date();
  var time = today.toLocaleTimeString([], {timeStyle: 'short'});

  document.getElementById("choice_todo").innerHTML= "Other Inquiries";
  document.getElementById("message7").style.display="flex";
  document.getElementById("time3").style.marginBottom="4%";
  document.querySelectorAll('.message6').forEach(st => {
    st.style.display="none";
  });
  document.getElementById("sender_indicator1").style.display="block";
  scrollDown();

  setTimeout(function(){ 
    document.getElementById("sender_indicator1").style.display="none";
    document.getElementById("time4").style.display="block";
    document.getElementById("time4").innerHTML=time;
    document.getElementById("irob_10").style.display="flex";
    document.getElementById("replying_efffect15").style.display="flex";
    scrollDown();
  }, 2000);

  setTimeout(function(){ 
    document.getElementById("replying_efffect15").style.display="none";
    document.getElementById("replying_efffect16").style.display="flex";
    document.getElementById("message26").style.display="flex";
    scrollDown();
  }, 4000);

  setTimeout(function(){ 
    var today = new Date();
    var time = today.toLocaleTimeString([], {timeStyle: 'short'});

    document.getElementById("replying_efffect16").style.display="none";
    document.getElementById("message27").style.display="flex";
    document.getElementById("time14").style.display="block";
    document.getElementById("time14").innerHTML=time;
    document.getElementById("input_name_for_otherInquiry").style.display="flex";
    scrollDown();
  }, 5000);
}

//display name on inqury
function displayNameonInquiry(){
    var name = document.getElementById("chat_name1").value;
    if(name == ""){}
    else{
        document.getElementById("name_onInquiry").innerHTML= name;
        document.getElementById("message28").style.display="flex";

        document.getElementById("input_name_for_otherInquiry").style.display="none";
        document.getElementById("sender_indicator6").style.display="block";

        setTimeout(function(){ 
          var today = new Date();
          var time = today.toLocaleTimeString([], {timeStyle: 'short'});
          document.getElementById("sender_indicator6").style.display="none";
          document.getElementById("time15").style.display="block";
          document.getElementById("time15").innerHTML=time;

          document.getElementById("irob_11").style.display="flex";
          document.getElementById("replying_efffect17").style.display="flex";
          scrollDown();
        }, 2000);

        setTimeout(function(){ 
          var today = new Date();
          var time = today.toLocaleTimeString([], {timeStyle: 'short'});

          document.getElementById("replying_efffect17").style.display="none";
          document.getElementById("message29").style.display="flex";
          document.getElementById("message31").style.display="flex";
          document.getElementById("time16").style.display="block";
          document.getElementById("time16").innerHTML=time;
          document.getElementById("input_email_for_otherInquiry").style.display="flex";
          scrollDown();
        }, 3000);
      }

}


//validate email on inquiry
function validateEmail(email) {
  const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}

//display email on inqury
function displayEmailonInquiry() {
  const email = $("#chat_email").val();

  var emailInput = document.getElementById("chat_email").value;
  if(emailInput == ""){}
  else{
      if (validateEmail(email)) {      
          document.getElementById("message31").style.display="none";
          document.getElementById("input_email_for_otherInquiry").style.display="none";
          document.getElementById("email_onInquiry").innerHTML= emailInput;
          document.getElementById("message30").style.display="flex";
          document.getElementById("sender_indicator7").style.display="block";

          setTimeout(function(){ 
            var today = new Date();
            var time = today.toLocaleTimeString([], {timeStyle: 'short'});

            document.getElementById("sender_indicator7").style.display="none";
            document.getElementById("time17").style.display="block";
            document.getElementById("time17").innerHTML=time;
          }, 2000);
      } else {
        $( "#message31" ).effect( "shake" );
        document.getElementById("message31").style.border="1px solid red";
     }
     return false;
  }
}




