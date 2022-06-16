$(document).ready(function(){

     //clicking terms services
     $("#terms_button").click(function() {   
          $("#terms_privacy_container").css({
               display: "flex",
          }); 
          $("#terms").animate({
               marginTop: "0%",
          },200); 
    });
 
     //clicking privacy policy
     $("#privacy_button").click(function() {   
         $("#privacy_policy_container").css({
              display: "flex",
         }); 
         $("#privacy").animate({
              marginTop: "0%",
         },200); 
   });

  //clicking privacy policy
  $("#privacy_button1").click(function() {   
         $("#privacy_policy_container").css({
              display: "flex",
         }); 
         $("#privacy").animate({
              marginTop: "0%",
         },200); 
   });

     //clicking privacy policy in cookies
     $("#ck_privacyP").click(function() {   
          $("#privacy_policy_container").css({
               display: "flex",
          }); 
          $("#privacy").animate({
               marginTop: "0%",
          },200); 
    });

 
   var counts = localStorage.getItem("counts") || 0; //holding cookie storage temporarily
   //accepting cookie policy
   $('#accept_ck1').click(function(){  
     $("#cookie_container").css({
          display: "none",
     }); 
     $("#cookie_container").animate({
          bottom: "-100%",
     },0); 
     counts++;
     localStorage.setItem("cookie1", counts);
  });

  
    //accepting privacy policy{
     $('#btn_accept_privacy').click(function(){  
          $("#privacy_policy_container").css({
               display: "none",
          }); 
          $("#privacy").animate({
               marginTop: "-100%",
          },200); 
          $("#cookie_container").css({
               display: "none",
          }); 
          $("#cookie_container").animate({
               bottom: "-100%",
          },0); 
          counts++;
          localStorage.setItem("cookie1", counts);
     });


  if(localStorage.getItem('cookie1') == null){//pag null ang value mag sshow
     $("#cookie_container").animate({
          bottom: "0%",
     },1000); 
     $("#cookie_container").css({
          display: "flex",
     }); 
     }
     else{ // pag hindi null mag hhide
     $("#cookie_container").css({
          display: "none",
     }); 
     $("#cookie_container").animate({
          bottom: "-100%",
     },0); 
     }

   
//for mobile ------------------------------------------------------------------------
   
   //clicking terms services
   $('#terms_buttonM').bind('touchstart click', function(){
      $("#terms_containerM").css({
           display: "flex",
      }); 
      $("#termsM").animate({
           marginTop: "15%",
      },200);
  });
   
 
 
    //clicking terms services in login
   $('#terms_buttonM1').bind('touchstart click', function(){
      $("#terms_containerM").css({
           display: "flex",
      }); 
      $("#termsM").animate({
           marginTop: "15%",
      },200); 
   });

   //clicking Privacy Policy
   $("#privacy_buttonM").click(function() {   
      $("#privacy_containerM").css({
           display: "flex",
      }); 
      $("#privacyM").animate({
           marginTop: "15%",
      },200); 
   });
 
    //clicking Privacy Policy in login
    $('#privacy_buttonM1').bind('touchstart click', function(){
      $("#privacy_containerM").css({
           display: "flex",
      }); 
      $("#privacyM").animate({
           marginTop: "15%",
      },200); 
   });
 
    //clicking Privacy Policy in cookies popup
    $('#privacy_buttonM2').bind('touchstart click', function(){  
      $("#privacy_containerM").css({
           display: "flex",
      }); 
      $("#privacyM").animate({
           marginTop: "15%",
      },200); 
 
      $("#cookie_containerM").css({
           display: "none",
      }); 
      $("#cookie_containerM").animate({
           bottom: "-100%",
      },0); 
 
   });



   var count = localStorage.getItem("count") || 0; //holding cookie storage temporarily
   //accepting cookie policy
   $('#accept_ck').bind('touchstart click', function(){  
     $("#cookie_containerM").css({
          display: "none",
     }); 
     $("#cookie_containerM").animate({
          bottom: "-100%",
     },0); 
     count++;
     localStorage.setItem("cookie", count);
  });
 


     if(localStorage.getItem('cookie') == null){//pag null ang value mag sshow
          $("#cookie_containerM").animate({
               bottom: "0%",
          },500); 
          $("#cookie_containerM").css({
               display: "block",
          }); 
     }
     else{ // pag hindi null mag hhide
          $("#cookie_containerM").css({
               display: "none",
          }); 
          $("#cookie_containerM").animate({
               bottom: "-100%",
          },0); 
     }



     
 

 
 
 });
   
   
   
   
   
   
   
   