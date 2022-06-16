$(document).ready(function(){

    //animation for page loader
    $("#ambulance_page_loader").animate({
        marginLeft: "105%",
    },1000)

    setTimeout(function(){
        $("#page_loader_container").animate({
            opacity: "0%",
        },1000)
    },1000)
    setTimeout(function(){
        $("#page_loader_container").css({
            display: "none",
        })
    },2000)

    

    var lastScrollTop = 0;
    $(window).scroll(function(event){            
    var st = $(this).scrollTop();

    if(st < lastScrollTop) {
        $("#scroll_cont").css({
            display: "none",
        }) 
    }
        if (st > lastScrollTop){
            $(".navbar_header").animate({
                backgroundColor: "black",
            },200) 
            $("#scroll_cont").css({
                display: "none",
            }) 
        }
        else if($(window).scrollTop() === 0) {  
            $("#scroll_cont").css({
                display: "flex",
                transform: "rotate(0deg)",
            })  
            $(".navbar_header").animate({
                backgroundColor: "transparent",
            },150)
            $(".navbar_header").css({
                boxShadow: "0 0px 0px 0px",
            })  
        }
        lastScrollTop = st;
    });
 
    


//animation for index page
$("#index_right_img").animate({
marginLeft: "10vh",
marginTop: "17%",
},1200); 
$(".left_content_index").animate({
 marginLeft: "0vh",
},1200);   

//animation for about page
$(".left_content_about").animate({
    opacity: "100%",
},1200); 


//animation for employee page
$("#empUp_right_img").animate({
marginLeft: "0",
marginTop: "20%",
},1200); 

//animation for employee page
$(".content_employee").animate({
    marginLeft: "5%",
},1200); 
$(".img_serv").animate({
    marginLeft: "3%",
},1200); 

  //animation for services page


     $(".left_content_service").animate({
            opacity: "100%",
    },1200); 

    $(".one_right_serv_img").animate({
        opacity: "100%",
    },1200); 
    
    //search animations
    $("#back_icon_btn").click(function() {   
      $("#search_input").val("");
      $("#recommended_container").css({
              display: "block",
      }); 
      $("#for_table_services").css({
              display: "none",
      });  
   });
    $("#search_input").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      if(value === ""){
          $("#back_icon_btn").css({
              visibility: "hidden",
          });  
          $("#for_table_services").css({
              display: "none",
          });  
          $("#recommended_container").css({
              display: "block",
          }); 
      }
      else{
          $("#table1_services td").filter(function() {
            $("#back_icon_btn").css({
                visibility: "visible",
            }); 
            $("#recommended_container").css({
                display: "none",
            });  
            $("#for_table_services").css({
                display: "flex",
            });  
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });

        var verifyer_service = $('#table1_services td:visible').length
            if(verifyer_service === 0){      
                $("#no_servFound").css({
                    display: "flex",
                }); 
            }
            else{
                $("#no_servFound").css({
                    display: "none",
                });  
            }

      }
    });

    //search animations minimize
    var ctr_for_minimize = 0;
    $("#minimize_img").click(function() {     
        ctr_for_minimize++;
        if(ctr_for_minimize % 2 == 0){
            $("#recommended_container").css({
                display: "block",
            });  
        }
        else{
            $("#recommended_container").css({
                display: "none",
            });  
        }
        
   
    });

    setTimeout(function(){
        $("#ambulance_gif").animate({
            marginLeft: "103vw",
        },40000)
        $("#ambulance_gif").animate({
            marginLeft: "-6vw",
        },0)
    },0)

    setInterval(function(){
        $("#ambulance_gif").animate({
            marginLeft: "103vw",
        },40000)
        $("#ambulance_gif").animate({
            marginLeft: "-6vw",
        },0)
    }, 40000);
    
    var screenHeight = $(window).height();
    $('#get_started_service').click(function () {
        $('body, html').animate({
            'scrollTop': screenHeight // <--- How far from the top of the screen?100?
        }, 300);// <---time = 1s
    });
  
});





//continuation for animation for employee page
setTimeout(function(){
document.querySelectorAll('#profile_loading').forEach(st => {
    st.style.display="none";
});
document.querySelectorAll('.skeleton_name').forEach(st => {
    st.style.display="none";
});
document.querySelectorAll('.skeleton_favQuote').forEach(st => {
    st.style.display="none";
});
document.querySelectorAll('.skeleton_quote').forEach(st => {
    st.style.display="none";
});
document.querySelectorAll('.skeleton_quotedby').forEach(st => {
    st.style.display="none";
});


document.querySelectorAll('#emp_img').forEach(st => {
    st.style.display="block";
});
document.querySelectorAll('#emp_name').forEach(st => {
    st.style.display="flex";
});
document.querySelectorAll('#quote').forEach(st => {
    st.style.display="block";
});
document.querySelectorAll('#quote_content').forEach(st => {
    st.style.display="block";
});
document.querySelectorAll('#quoted_by').forEach(st => {
    st.style.display="block";
});
},3000)


var screenHeight = $(window).height();
document.getElementById("learn_more_employee").onclick = function() {
$('body, html').animate({
    'scrollTop': screenHeight // <--- How far from the top of the screen?100?
}, 300);// <---time = 1s
    document.querySelectorAll('#profile_loading').forEach(st => {
        st.style.display="block";
    });
    document.querySelectorAll('.skeleton_name').forEach(st => {
        st.style.display="block";
    });
    document.querySelectorAll('.skeleton_favQuote').forEach(st => {
        st.style.display="block";
    });
    document.querySelectorAll('.skeleton_quote').forEach(st => {
        st.style.display="block";
    });
    document.querySelectorAll('.skeleton_quotedby').forEach(st => {
        st.style.display="block";
    });
    document.querySelectorAll('#emp_img').forEach(st => {
        st.style.display="none";
    });
    document.querySelectorAll('#emp_name').forEach(st => {
        st.style.display="none";
    });
    document.querySelectorAll('#quote').forEach(st => {
        st.style.display="none";
    });
    document.querySelectorAll('#quote_content').forEach(st => {
        st.style.display="none";
    });
    document.querySelectorAll('#quoted_by').forEach(st => {
        st.style.display="none";
    });

    setTimeout(function(){
        document.querySelectorAll('#profile_loading').forEach(st => {
            st.style.display="none";
        });
        document.querySelectorAll('.skeleton_name').forEach(st => {
            st.style.display="none";
        });
        document.querySelectorAll('.skeleton_favQuote').forEach(st => {
            st.style.display="none";
        });
        document.querySelectorAll('.skeleton_quote').forEach(st => {
            st.style.display="none";
        });
        document.querySelectorAll('.skeleton_quotedby').forEach(st => {
            st.style.display="none";
        });
    
    
        document.querySelectorAll('#emp_img').forEach(st => {
            st.style.display="block";
        });
        document.querySelectorAll('#emp_name').forEach(st => {
            st.style.display="flex";
        });
        document.querySelectorAll('#quote').forEach(st => {
            st.style.display="block";
        });
        document.querySelectorAll('#quote_content').forEach(st => {
            st.style.display="block";
        });
        document.querySelectorAll('#quoted_by').forEach(st => {
            st.style.display="block";
        });
    },3000)
};


document.getElementById("learn_more_employee_mobile").onclick = function() {
location.href = "#content_team_header";
};


setTimeout(function(){
$("#walking_gif").animate({
    marginLeft: "103vw",
},40000)
$("#walking_gif").animate({
    marginLeft: "-3vw",
},0)
},0)

setInterval(function(){
$("#walking_gif").animate({
    marginLeft: "103vw",
},40000)
$("#walking_gif").animate({
    marginLeft: "-3vw",
},0)
}, 40000);


