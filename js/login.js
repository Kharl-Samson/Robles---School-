function showLogin(){
    document.getElementById("login_container").style.display="flex";
}

function closeLogin(){
    if (document.getElementById("keep_log").checked) {
    } else {
        document.getElementById("username_l").value = "";
        document.getElementById("password_l").value = "";
    }
document.getElementById("login_container").style.display="none";
document.querySelector('.validation_forPatientLogin').style.visibility="hidden";
document.querySelector('#password_l').style.border="1.5px solid #D1D1D1";
document.querySelector('#username_l').style.border="1.5px solid #D1D1D1";
}

function closeTerms(){
    document.getElementById("terms_privacy_container").style.display="none"; 
    document.getElementById("terms").style.marginTop="-100%"; 
}

function closePrivacy(){
    document.getElementById("privacy_policy_container").style.display="none"; 
    document.getElementById("privacy").style.marginTop="-100%"; 
}

function closeForgot(){
    document.getElementById("forgotPass_Container").style.display="none"; 
    document.getElementById("login_container").style.display="flex";
}

function showForgot(){
    document.getElementById("forgotPass_Container").style.display="flex"; 
    document.getElementById("login_container").style.display="none";
}

function closeForgotAdmin(){
    document.getElementById("forgotPass_Container").style.display="none"; 
}

function showForgotAdmin(){
    document.getElementById("forgotPass_Container").style.display="flex"; 
}



//var modal = document.getElementById("login_container");
//window.onclick = function(event) {
  //  if (event.target == modal) {
    //  modal.style.display = "none";
   // }
//}


//for mobile
function showLoginM(){
    document.getElementById("login_ContainerM").style.display="flex";
    document.getElementById("close_hamburger").style.display="none";
    document.getElementById("hamburger_menu").style.display="block";
    document.getElementById("hamburger").style.left="-70%";
    document.getElementById("for_opacity_burger").style.display="none";
}
function closeLoginM(){
    document.getElementById("login_ContainerM").style.display="none";
}

function closeTermsM(){
    document.getElementById("terms_containerM").style.display="none"; 
    document.getElementById("termsM").style.marginTop="-100%"; 
}

function closePrivacyM(){
    document.getElementById("privacy_containerM").style.display="none"; 
    document.getElementById("privacyM").style.marginTop="-100%"; 
}

function closeForgotM(){
    document.getElementById("forgotPass_ContainerM").style.display="none"; 
    document.getElementById("login_ContainerM").style.display="flex";
}

function showForgotM(){
    document.getElementById("forgotPass_ContainerM").style.display="flex"; 
    document.getElementById("login_ContainerM").style.display="none";
}


//cookie popup close
function closeCookiesM(){
    document.getElementById("cookie_containerM").style.display="none"; 
    document.getElementById("cookie_containerM").style.bottom="-100%"; 
}


//back admin login 
function goBackadminL(){
    window.location.replace("index.php");
}

function showForgotAdminM(){
    document.getElementById("forgotPass_ContainerM").style.display="flex"; 
    document.getElementById("login_form").style.display="none"; 
}
function closeForgotAdminM(){
    document.getElementById("forgotPass_ContainerM").style.display="none"; 
    document.getElementById("login_form").style.display="block"; 
}



$(function() {
    $(".input_auth").keyup(function () {
        var inp = document.querySelectorAll(".input_auth");
        var strInp = ""
        for(y=0 ; y<6; y++){
            strInp += inp[y].value;
        }
        document.getElementById("final_inp").value = strInp;
        document.querySelectorAll(".input_auth").type="password"
        
        if (this.value.length == this.maxLength) {
          $(this).next('.input_auth').focus();
        }
    });
});



//admin login authenticator
var auth_timer = document.getElementById("auth_timer").innerHTML;
var auth_ctr = 30;
var compDis = document.getElementById("comp_codeDis").value;
const interval = setInterval(() => {
    if(document.getElementById("final_inp").value !== compDis){
        auth_ctr--;
        document.getElementById("auth_timer").innerHTML = auth_ctr;
    }
    if(auth_ctr == "0"){
        window.close();
        clearInterval(interval);
    }
    if(document.getElementById("final_inp").value === compDis){
        $("#validation_forgotPass").css({
            display: "flex",
            borderLeft: "10px solid #93C1F9",
        })
        $("#validation_forgotPass").animate({
            right: "2.5%",
        },500)      

        $("#text_validationHeader").text('Success!');
        $("#text_validationHeader").css({color: "#93C1F9"})
        $("#close_validationPass").css({color: "#93C1F9"})
        $("#text_validationContent").text('The company code is correct!');
        $("#validationForgot_img").attr("src","images/gif/succes.gif");

        setTimeout(function(){
            //animation for edit profile
            $("#validation_forgotPass").animate({
                right: "-56%",
            },500)    
        }, 3000);

        document.getElementById("slider_Captcha").style.display = "flex";
        clearInterval(interval);
    }

    if(document.getElementById("final_inp").value !== compDis && document.getElementById("final_inp").value.length === 6){
        document.getElementById("final_inp").value = "";
        document.querySelector(".input_auth1").focus();
        document.querySelector(".input_auth1").value = "";
        document.querySelector(".input_auth2").value = "";
        document.querySelector(".input_auth3").value = "";
        document.querySelector(".input_auth4").value = "";
        document.querySelector(".input_auth5").value = "";
        document.querySelector(".input_auth6").value = "";

            $("#validation_forgotPass").css({
                display: "flex",
                borderLeft: "10px solid #DB6F3D",
            })
            //animation for edit profile
            $("#validation_forgotPass").animate({
                right: "2.5%",
            },500)      

            $("#text_validationHeader").text('Error!');
            $("#text_validationHeader").css({color: "red"})
            $("#close_validationPass").css({color: "red"})
            $("#text_validationContent").text('The company code is invalid!');
            $("#validationForgot_img").attr("src","images/gif/error_validation.gif");

            setTimeout(function(){
                //animation for edit profile
                $("#validation_forgotPass").animate({
                    right: "-56%",
                },500)    
            }, 3000);
    }
   
}, 1000);


function back_auth(){
    window.close();
}


