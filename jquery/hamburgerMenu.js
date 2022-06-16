$(document).ready(function(){
    
    //navbar anim
    var lastScrollTop = 0;
    $(window).scroll(function(event){
    var st = $(this).scrollTop();
        if (st > lastScrollTop){
            $(".nav_bar_phone").animate({
                backgroundColor: "#00F3B9",
            },200) 
        } 
        else if($(window).scrollTop() === 0) {
            $(".nav_bar_phone").animate({
                backgroundColor: "transparent",
            },150)
        }
        lastScrollTop = st;
    });
 

    //clicking hamburger menu
    $("#hamburger_menu").click(function() {   

         $("#hamburger_menu").css({
              display: "none",
         }); 
         $("#close_hamburger").css({
              display: "block",
         });  
         $("#hamburger").animate({
              left: "0%",
         },100); 
         $('#for_opacity_burger').delay(100).queue(function (next) { 
              $(this).css('display', 'block'); 
              next(); 
         });
   });


   //closing hamburger menu
   $("#close_hamburger").click(function() {   

        $("#hamburger_menu").css({
            display: "block",
        }); 
        $("#close_hamburger").css({
            display: "none",
        });  
        $("#hamburger").animate({
            left: "-70%",
        },100); 
        $("#for_opacity_burger").css({
            display: "none",
        }); 

    });
  

    //footer mobile
    $("#plus_btn1").click(function() {  

        $("#plus_btn1").css({
            display: "none",
        });  
        $("#minus_btn1").css({
            display: "block",
        });  

        $(".f1_subtext").css({
            display: "block",
        }); 

        $(".f2_subtext").css({
            display: "none",
        }); 
        $("#plus_btn2").css({
            display: "block",
        });  
        $("#minus_btn2").css({
            display: "none",
        });  

    });
    $("#minus_btn1").click(function() {  

        $("#plus_btn1").css({
            display: "block",
        });  
        $("#minus_btn1").css({
            display: "none",
        });  

        $(".f1_subtext").css({
            display: "none",
        }); 

    });
  
    $("#plus_btn2").click(function() {  

        $("#plus_btn2").css({
            display: "none",
        });  
        $("#minus_btn2").css({
            display: "block",
        });  

        $(".f2_subtext").css({
            display: "block",
        }); 

        $(".f1_subtext").css({
            display: "none",
        }); 
        $("#plus_btn1").css({
            display: "block",
        });  
        $("#minus_btn1").css({
            display: "none",
        });  


    });
    $("#minus_btn2").click(function() {  

        $("#plus_btn2").css({
            display: "block",
        });  
        $("#minus_btn2").css({
            display: "none",
        });  

        $(".f2_subtext").css({
            display: "none",
        }); 

    });

});
  
  
  
  
  
  
  
  