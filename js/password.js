function togglePassword1(){
    var x = document.getElementById("password_lA");
    if (x.type === "password") {
      document.getElementById("show_pass").style.display = "inline";
      document.getElementById("hide_pass").style.display = "none";
      x.type = "text";
    } else {
      document.getElementById("show_pass").style.display = "none";
      document.getElementById("hide_pass").style.display = "inline";
     x.type = "password";
     }
}

function togglePassword(){
  var x = document.getElementById("password_l");
  if (x.type === "password") {
    document.getElementById("show_pass").style.display = "inline";
    document.getElementById("hide_pass").style.display = "none";
    x.type = "text";
  } else {
    document.getElementById("show_pass").style.display = "none";
    document.getElementById("hide_pass").style.display = "inline";
   x.type = "password";
   }
}

//for mobile
function togglePasswordM(){
  var x = document.querySelector(".password_lm");
  if (x.type === "password") {
    document.getElementById("show_passM").style.display = "inline";
    document.getElementById("hide_passM").style.display = "none";
    x.type = "text";
  } else {
    document.getElementById("show_passM").style.display = "none";
    document.getElementById("hide_passM").style.display = "inline";
   x.type = "password";
   }
}



