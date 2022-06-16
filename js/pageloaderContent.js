window.addEventListener("DOMContentLoaded", event => {
    const audio = document.querySelector("audio");
    audio.volume = 0.2;
    audio.play();
});
  
function pageloaderContents(logo,fname,sname){
var content="";
content += '<div id="logo">'+
            '<img src="upload_img_generic/'+logo+'">  '+ 
            '<div>'+
                '<p class="a">'+fname+'</p>'+
                '<p class="b">'+sname+'</p>'+
            '</div>'+
            '</div>'+
            '<img src="images/gif/ambulance.gif" id="ambulance_page_loader">'+
            '<audio src="images/gif/loading.mp3"></audio>';
       
             document.getElementById("page_loader_container").innerHTML = content;
}


