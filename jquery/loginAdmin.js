$(document).ready(function(){
    $(document).keydown(function(e){
  
        if(e.which == "121"){
            var win = window.open('adminLogin.php', '_blank');
            if (win) {
                //Browser has allowed it to be opened
                win.focus();
            } 
        }
    })

})