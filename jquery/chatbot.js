$(document).ready(function(){

    //after 2 seconds tsaka mag show 
    setTimeout(
    function() 
    {
           $("#chat_text_container").css({
              display: "block",
           }); 
            $("#chat_text_container").animate({
              opacity: "100%",
            },2000); 

    }, 2000);

  //after 20 seconds mag hihide
  setTimeout(
  function() 
  {
            $("#chat_text_container").animate({
                opacity: "0%",
            },2000);  

            $('#chat_text_container').delay(2500).queue(function (next) { 
              $(this).css('display', 'none'); 
              next(); 
            });
  }, 20000);


  //every 8 second mag rereload yung text para sa animation
  setInterval(function(){
    $("#chatbot_helloText").load(" #chatbot_helloText > *");
  }, 8000);


  //mag shoshow every 1 minute
  setInterval(function(){

              $("#chat_text_container").css({
                 display: "block",
              }); 
              $("#chat_text_container").animate({
                 opacity: "100%",
              },2500); 


                $("#chat_text_container").delay(20000).animate({
                    opacity: "0%",
                },{duration:2000});
                $('#chat_text_container').delay(25000).queue(function (next) { 
                  $(this).css('display', 'none'); 
                  next(); 
                });
    }, 60000);
});
