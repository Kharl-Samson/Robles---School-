function clickIndivServices(valueServices,desc,img){
    document.getElementById("services_bg").style.display="flex";
      $("#services_container").animate({
        marginBottom: "0vh",
      },500); 

    document.getElementById("serv_name_img").innerHTML=valueServices;
    document.getElementById("description_content").innerHTML=desc;
    document.getElementById("img_ser_offered").src = "images/services/"+img;
    $("#img_ser_offered").on("error", function () {
      $(this).attr("src", "images/services/default.png");
  });
}

function close_indiv_services(){
     $("#services_container").animate({
        marginBottom: "-100vh",
      },500); 
      setTimeout(function(){
            document.getElementById("services_bg").style.display="none";
      }, 400);
}



