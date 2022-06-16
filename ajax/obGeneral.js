$(document).ready(function(){
    $(document).on('click', '#save_btn_light', function(){
     var name = document.getElementById("img_light_v").files[0].name;
     var form_data = new FormData();
     var ext = name.split('.').pop().toLowerCase();
     if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
     {
        $("#validation_general").css({
            display: "flex",
            borderLeft: "10px solid #DB6F3D",
        })
        $("#validation_general").animate({
            right: "2.5%",
        },500)      
        $("#text_validationHeader").text('Error!');
        $("#text_validationHeader").css({color: "red"})
        $("#close_general").css({color: "red"})
        $("#text_validationContent").text('The image file is invalid!');
        $("#validationGeneral_img").attr("src","images/gif/error_validation.gif");

        setTimeout(function(){
            $("#validation_general").animate({
                right: "-56%",
            },500)    
        }, 5000);
     }
     else{
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("img_light_v").files[0]);
        var f = document.getElementById("img_light_v").files[0];
        var fsize = f.size||f.fileSize;
   
         form_data.append("img_light_v", document.getElementById('img_light_v').files[0]);
         $.ajax({
          url:"z-Ajax-Generic.php",
          method:"POST",
          data: form_data,
          contentType: false,
          cache: false,
          processData: false,
          success:function(data)
          {
           document.getElementById('save_btn_light').style.visibility = "hidden";
           document.getElementById('delete_btn_light').style.visibility = "hidden"; 
             $(".img_containerL").load(location.href+" .img_containerL>*","");    
               $("#validation_general").css({
               display: "flex",
               borderLeft: "10px solid #93C1F9",
               })
               //animation for edit profile
               $("#validation_general").animate({
                   right: "2.5%",
               },500)      
   
               $("#text_validationHeader").text('Success!');
               $("#text_validationHeader").css({color: "#93C1F9"})
               $("#close_general").css({color: "#93C1F9"})
               $("#text_validationContent").text('The company logo has been updated!');
               $("#validationGeneral_img").attr("src","images/gif/succes.gif");
   
   
               setTimeout(function(){
                   //animation for edit profile
                   $("#validation_general").animate({
                       right: "-56%",
                   },500)    
               }, 5000);
          }
         });
     }

     
    });
//-----------------------------------------------------------------------------------------------------------
$(document).on('click', '#save_btn_dark', function(){
    var name = document.getElementById("img_dark_v").files[0].name;
    var form_data = new FormData();
    var ext = name.split('.').pop().toLowerCase();
    if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
    {
       $("#validation_general").css({
           display: "flex",
           borderLeft: "10px solid #DB6F3D",
       })
       $("#validation_general").animate({
           right: "2.5%",
       },500)      
       $("#text_validationHeader").text('Error!');
       $("#text_validationHeader").css({color: "red"})
       $("#close_general").css({color: "red"})
       $("#text_validationContent").text('The image file is invalid!');
       $("#validationGeneral_img").attr("src","images/gif/error_validation.gif");

       setTimeout(function(){
           $("#validation_general").animate({
               right: "-56%",
           },500)    
       }, 5000);
    }
    else{
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("img_dark_v").files[0]);
        var f = document.getElementById("img_dark_v").files[0];
        var fsize = f.size||f.fileSize;
         form_data.append("img_dark_v", document.getElementById('img_dark_v').files[0]);
         $.ajax({
          url:"z-Ajax-Generic.php",
          method:"POST",
          data: form_data,
          contentType: false,
          cache: false,
          processData: false,
          success:function(data)
          {
            $(".img_containerL").load(location.href+" .img_containerL>*","");  
            document.getElementById('save_btn_dark').style.visibility = "hidden";
            document.getElementById('delete_btn_dark').style.visibility = "hidden";      
               $("#validation_general").css({
               display: "flex",
               borderLeft: "10px solid #93C1F9",
               })
               //animation for edit profile
               $("#validation_general").animate({
                   right: "2.5%",
               },500)      
    
               $("#text_validationHeader").text('Success!');
               $("#text_validationHeader").css({color: "#93C1F9"})
               $("#close_general").css({color: "#93C1F9"})
               $("#text_validationContent").text('The company logo has been updated!');
               $("#validationGeneral_img").attr("src","images/gif/succes.gif");
    
    
               setTimeout(function(){
                   //animation for edit profile
                   $("#validation_general").animate({
                       right: "-56%",
                   },500)    
               }, 5000);
          }
         });
    }
  
   });

//-----------------------------------------------------------------------------------------------------------
$(document).on('click', '#save_btn_Ilay', function(){
    var name = document.getElementById("img_hLayout").files[0].name;
    var form_data = new FormData();
    var ext = name.split('.').pop().toLowerCase();
    if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
    {
       $("#validation_general").css({
           display: "flex",
           borderLeft: "10px solid #DB6F3D",
       })
       $("#validation_general").animate({
           right: "2.5%",
       },500)      
       $("#text_validationHeader").text('Error!');
       $("#text_validationHeader").css({color: "red"})
       $("#close_general").css({color: "red"})
       $("#text_validationContent").text('The image file is invalid!');
       $("#validationGeneral_img").attr("src","images/gif/error_validation.gif");

       setTimeout(function(){
           $("#validation_general").animate({
               right: "-56%",
           },500)    
       }, 5000);
    }
    else{
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("img_hLayout").files[0]);
        var f = document.getElementById("img_hLayout").files[0];
        var fsize = f.size||f.fileSize;
         form_data.append("img_hLayout", document.getElementById('img_hLayout').files[0]);
         $.ajax({
          url:"z-Ajax-Generic.php",
          method:"POST",
          data: form_data,
          contentType: false,
          cache: false,
          processData: false,
          success:function(data)
          {
            $(".img_containerI").load(location.href+" .img_containerI>*","");  
            document.getElementById('save_btn_Ilay').style.visibility = "hidden";
            document.getElementById('delete_btn_Ilay').style.visibility = "hidden"; 
               $("#validation_general").css({
               display: "flex",
               borderLeft: "10px solid #93C1F9",
               })
               //animation for edit profile
               $("#validation_general").animate({
                   right: "2.5%",
               },500)      
    
               $("#text_validationHeader").text('Success!');
               $("#text_validationHeader").css({color: "#93C1F9"})
               $("#close_general").css({color: "#93C1F9"})
               $("#text_validationContent").text('The layout image has been updated!');
               $("#validationGeneral_img").attr("src","images/gif/succes.gif");
    
    
               setTimeout(function(){
                   //animation for edit profile
                   $("#validation_general").animate({
                       right: "-56%",
                   },500)    
               }, 5000);
          }
         });
    }

   });

//-----------------------------------------------------------------------------------------------------------
$(document).on('click', '#save_btn_Isl1', function(){
    var name = document.getElementById("file-imgSl1").files[0].name;
    var form_data = new FormData();
    var ext = name.split('.').pop().toLowerCase();
    if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
    {
       $("#validation_general").css({
           display: "flex",
           borderLeft: "10px solid #DB6F3D",
       })
       $("#validation_general").animate({
           right: "2.5%",
       },500)      
       $("#text_validationHeader").text('Error!');
       $("#text_validationHeader").css({color: "red"})
       $("#close_general").css({color: "red"})
       $("#text_validationContent").text('The image file is invalid!');
       $("#validationGeneral_img").attr("src","images/gif/error_validation.gif");

       setTimeout(function(){
           $("#validation_general").animate({
               right: "-56%",
           },500)    
       }, 5000);
    }
    else{
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("file-imgSl1").files[0]);
        var f = document.getElementById("file-imgSl1").files[0];
        var fsize = f.size||f.fileSize;
         form_data.append("file-imgSl1", document.getElementById('file-imgSl1').files[0]);
         $.ajax({
          url:"z-Ajax-Generic.php",
          method:"POST",
          data: form_data,
          contentType: false,
          cache: false,
          processData: false,
          success:function(data)
          {
            $(".img_containerIsl1").load(location.href+" .img_containerIsl1>*","");  
            document.getElementById('save_btn_Isl1').style.visibility = "hidden";
            document.getElementById('delete_btn_Isl1').style.visibility = "hidden";       
               $("#validation_general").css({
               display: "flex",
               borderLeft: "10px solid #93C1F9",
               })
               //animation for edit profile
               $("#validation_general").animate({
                   right: "2.5%",
               },500)      
    
               $("#text_validationHeader").text('Success!');
               $("#text_validationHeader").css({color: "#93C1F9"})
               $("#close_general").css({color: "#93C1F9"})
               $("#text_validationContent").text('The layout image has been updated!');
               $("#validationGeneral_img").attr("src","images/gif/succes.gif");
    
    
               setTimeout(function(){
                   //animation for edit profile
                   $("#validation_general").animate({
                       right: "-56%",
                   },500)    
               }, 5000);
          }
         });
    }
    
   });

//-----------------------------------------------------------------------------------------------------------
$(document).on('click', '#save_btn_Isl2', function(){
    var name = document.getElementById("file-imgSl2").files[0].name;
    var form_data = new FormData();
    var ext = name.split('.').pop().toLowerCase();
    if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
    {
       $("#validation_general").css({
           display: "flex",
           borderLeft: "10px solid #DB6F3D",
       })
       $("#validation_general").animate({
           right: "2.5%",
       },500)      
       $("#text_validationHeader").text('Error!');
       $("#text_validationHeader").css({color: "red"})
       $("#close_general").css({color: "red"})
       $("#text_validationContent").text('The image file is invalid!');
       $("#validationGeneral_img").attr("src","images/gif/error_validation.gif");

       setTimeout(function(){
           $("#validation_general").animate({
               right: "-56%",
           },500)    
       }, 5000);
    }
    else{
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("file-imgSl2").files[0]);
        var f = document.getElementById("file-imgSl2").files[0];
        var fsize = f.size||f.fileSize;
         form_data.append("file-imgSl2", document.getElementById('file-imgSl2').files[0]);
         $.ajax({
          url:"z-Ajax-Generic.php",
          method:"POST",
          data: form_data,
          contentType: false,
          cache: false,
          processData: false,
          success:function(data)
          {
            $(".img_containerIsl2").load(location.href+" .img_containerIsl2>*","");  
            document.getElementById('save_btn_Isl2').style.visibility = "hidden";
            document.getElementById('delete_btn_Isl2').style.visibility = "hidden";      
               $("#validation_general").css({
               display: "flex",
               borderLeft: "10px solid #93C1F9",
               })
               //animation for edit profile
               $("#validation_general").animate({
                   right: "2.5%",
               },500)      
    
               $("#text_validationHeader").text('Success!');
               $("#text_validationHeader").css({color: "#93C1F9"})
               $("#close_general").css({color: "#93C1F9"})
               $("#text_validationContent").text('The layout image has been updated!');
               $("#validationGeneral_img").attr("src","images/gif/succes.gif");
    
    
               setTimeout(function(){
                   //animation for edit profile
                   $("#validation_general").animate({
                       right: "-56%",
                   },500)    
               }, 5000);
          }
        });
    }
  

   });


//-----------------------------------------------------------------------------------------------------------
$(document).on('click', '#save_btn_Isl3', function(){
    var name = document.getElementById("file-imgSl3").files[0].name;
    var form_data = new FormData();
    var ext = name.split('.').pop().toLowerCase();
    if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
    {
       $("#validation_general").css({
           display: "flex",
           borderLeft: "10px solid #DB6F3D",
       })
       $("#validation_general").animate({
           right: "2.5%",
       },500)      
       $("#text_validationHeader").text('Error!');
       $("#text_validationHeader").css({color: "red"})
       $("#close_general").css({color: "red"})
       $("#text_validationContent").text('The image file is invalid!');
       $("#validationGeneral_img").attr("src","images/gif/error_validation.gif");

       setTimeout(function(){
           $("#validation_general").animate({
               right: "-56%",
           },500)    
       }, 5000);
    }
    else{
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("file-imgSl3").files[0]);
        var f = document.getElementById("file-imgSl3").files[0];
        var fsize = f.size||f.fileSize;
         form_data.append("file-imgSl3", document.getElementById('file-imgSl3').files[0]);
         $.ajax({
          url:"z-Ajax-Generic.php",
          method:"POST",
          data: form_data,
          contentType: false,
          cache: false,
          processData: false,
          success:function(data)
          {
            $(".img_containerIsl3").load(location.href+" .img_containerIsl3>*","");  
            document.getElementById('save_btn_Isl3').style.visibility = "hidden";
            document.getElementById('delete_btn_Isl3').style.visibility = "hidden";        
               $("#validation_general").css({
               display: "flex",
               borderLeft: "10px solid #93C1F9",
               })
               //animation for edit profile
               $("#validation_general").animate({
                   right: "2.5%",
               },500)      
    
               $("#text_validationHeader").text('Success!');
               $("#text_validationHeader").css({color: "#93C1F9"})
               $("#close_general").css({color: "#93C1F9"})
               $("#text_validationContent").text('The layout image has been updated!');
               $("#validationGeneral_img").attr("src","images/gif/succes.gif");
    
    
               setTimeout(function(){
                   //animation for edit profile
                   $("#validation_general").animate({
                       right: "-56%",
                   },500)    
               }, 5000);
          }
         });
    }
   
   });


//-----------------------------------------------------------------------------------------------------------
$(document).on('click', '#save_btn_Iali', function(){
    var name = document.getElementById("file-imgAli").files[0].name;
    var form_data = new FormData();
    var ext = name.split('.').pop().toLowerCase();
    if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
    {
       $("#validation_general").css({
           display: "flex",
           borderLeft: "10px solid #DB6F3D",
       })
       $("#validation_general").animate({
           right: "2.5%",
       },500)      
       $("#text_validationHeader").text('Error!');
       $("#text_validationHeader").css({color: "red"})
       $("#close_general").css({color: "red"})
       $("#text_validationContent").text('The image file is invalid!');
       $("#validationGeneral_img").attr("src","images/gif/error_validation.gif");

       setTimeout(function(){
           $("#validation_general").animate({
               right: "-56%",
           },500)    
       }, 5000);
    }
    else{
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("file-imgAli").files[0]);
        var f = document.getElementById("file-imgAli").files[0];
        var fsize = f.size||f.fileSize;
         form_data.append("file-imgAli", document.getElementById('file-imgAli').files[0]);
         $.ajax({
          url:"z-Ajax-Generic.php",
          method:"POST",
          data: form_data,
          contentType: false,
          cache: false,
          processData: false,
          success:function(data)
          {
            $(".img_containerAl").load(location.href+" .img_containerAl>*","");  
            document.getElementById('save_btn_Iali').style.visibility = "hidden";
            document.getElementById('delete_btn_Iali').style.visibility = "hidden";      
               $("#validation_general").css({
               display: "flex",
               borderLeft: "10px solid #93C1F9",
               })
               //animation for edit profile
               $("#validation_general").animate({
                   right: "2.5%",
               },500)      
    
               $("#text_validationHeader").text('Success!');
               $("#text_validationHeader").css({color: "#93C1F9"})
               $("#close_general").css({color: "#93C1F9"})
               $("#text_validationContent").text('The layout image has been updated!');
               $("#validationGeneral_img").attr("src","images/gif/succes.gif");
    
    
               setTimeout(function(){
                   //animation for edit profile
                   $("#validation_general").animate({
                       right: "-56%",
                   },500)    
               }, 5000);
          }
         });
    }


}); 


});




//form submit changes
function saveChangesGeneral(url){
    var g_Sitename = $("input#g_Sitename").val();
    var g_Contact = $("input#g_Contact").val();
    var g_Location = $("input#g_Location").val();
    var g_Email = $("input#g_Email").val();
    var g_WorkingHours = $("input#g_WorkingHours").val();
    var g_vision = $("textarea#g_vision").val();

    var compCode = $("input#companyCode").val();
    var gMap = $("input#googlemap").val();


    if(g_Sitename == ""){
        $("#g_Sitename").css({
            border: "1px solid red",
        })
        $("#validation_general").css({
            display: "flex",
            borderLeft: "10px solid #DB6F3D",
        })
        $("#validation_general").animate({
            right: "2.5%",
        },500)      
        $("#text_validationHeader").text('Error!');
        $("#text_validationHeader").css({color: "red"})
        $("#close_general").css({color: "red"})
        $("#text_validationContent").text('You must input a site name to save changes!');
        $("#validationGeneral_img").attr("src","images/gif/error_validation.gif");

        setTimeout(function(){
            $("#validation_general").animate({
                right: "-56%",
            },500)    
        }, 5000);
    }
    else if(g_vision == ""){
        $("#g_vision").css({
            border: "1px solid red",
        })
        $("#validation_general").css({
            display: "flex",
            borderLeft: "10px solid #DB6F3D",
        })
        $("#validation_general").animate({
            right: "2.5%",
        },500)      
        $("#text_validationHeader").text('Error!');
        $("#text_validationHeader").css({color: "red"})
        $("#close_general").css({color: "red"})
        $("#text_validationContent").text('You must input a site vision to save changes!');
        $("#validationGeneral_img").attr("src","images/gif/error_validation.gif");

        setTimeout(function(){
            $("#validation_general").animate({
                right: "-56%",
            },500)    
        }, 5000);
    }
    else if(g_Contact == ""){
        $("#g_Contact").css({
            border: "1px solid red",
        })
        $("#validation_general").css({
            display: "flex",
            borderLeft: "10px solid #DB6F3D",
        })
        $("#validation_general").animate({
            right: "2.5%",
        },500)      
        $("#text_validationHeader").text('Error!');
        $("#text_validationHeader").css({color: "red"})
        $("#close_general").css({color: "red"})
        $("#text_validationContent").text('You must input a site contact # to save changes!');
        $("#validationGeneral_img").attr("src","images/gif/error_validation.gif");

        setTimeout(function(){
            $("#validation_general").animate({
                right: "-56%",
            },500)    
        }, 5000);
    }
    else if(g_Location == ""){
        $("#g_Location").css({
            border: "1px solid red",
        })
        $("#validation_general").css({
            display: "flex",
            borderLeft: "10px solid #DB6F3D",
        })
        $("#validation_general").animate({
            right: "2.5%",
        },500)      
        $("#text_validationHeader").text('Error!');
        $("#text_validationHeader").css({color: "red"})
        $("#close_general").css({color: "red"})
        $("#text_validationContent").text('You must input a site location to save changes!');
        $("#validationGeneral_img").attr("src","images/gif/error_validation.gif");

        setTimeout(function(){
            $("#validation_general").animate({
                right: "-56%",
            },500)    
        }, 5000);
    }
    else if(g_Email == ""){
        $("#g_Email").css({
            border: "1px solid red",
        })
        $("#validation_general").css({
            display: "flex",
            borderLeft: "10px solid #DB6F3D",
        })
        $("#validation_general").animate({
            right: "2.5%",
        },500)      
        $("#text_validationHeader").text('Error!');
        $("#text_validationHeader").css({color: "red"})
        $("#close_general").css({color: "red"})
        $("#text_validationContent").text('You must input a site email to save changes!');
        $("#validationGeneral_img").attr("src","images/gif/error_validation.gif");

        setTimeout(function(){
            $("#validation_general").animate({
                right: "-56%",
            },500)    
        }, 5000);
    }
    else if(g_WorkingHours == ""){
        $("#g_WorkingHours").css({
            border: "1px solid red",
        })
        $("#validation_general").css({
            display: "flex",
            borderLeft: "10px solid #DB6F3D",
        })
        $("#validation_general").animate({
            right: "2.5%",
        },500)      
        $("#text_validationHeader").text('Error!');
        $("#text_validationHeader").css({color: "red"})
        $("#close_general").css({color: "red"})
        $("#text_validationContent").text('You must input a working hours to save changes!');
        $("#validationGeneral_img").attr("src","images/gif/error_validation.gif");

        setTimeout(function(){
            $("#validation_general").animate({
                right: "-56%",
            },500)    
        }, 5000);
    }
    else if(compCode == ""){
        $("#companyCode").css({
            border: "1px solid red",
        })
        $("#validation_general").css({
            display: "flex",
            borderLeft: "10px solid #DB6F3D",
        })
        $("#validation_general").animate({
            right: "2.5%",
        },500)      
        $("#text_validationHeader").text('Error!');
        $("#text_validationHeader").css({color: "red"})
        $("#close_general").css({color: "red"})
        $("#text_validationContent").text('You must input a company code to save changes!');
        $("#validationGeneral_img").attr("src","images/gif/error_validation.gif");

        setTimeout(function(){
            $("#validation_general").animate({
                right: "-56%",
            },500)    
        }, 5000);
    }
    else if(compCode.length !== 6 ){
        $("#companyCode").css({
            border: "1px solid red",
        })
        $("#validation_general").css({
            display: "flex",
            borderLeft: "10px solid #DB6F3D",
        })
        $("#validation_general").animate({
            right: "2.5%",
        },500)      
        $("#text_validationHeader").text('Error!');
        $("#text_validationHeader").css({color: "red"})
        $("#close_general").css({color: "red"})
        $("#text_validationContent").text('You must input a 6 digit character!');
        $("#validationGeneral_img").attr("src","images/gif/error_validation.gif");

        setTimeout(function(){
            $("#validation_general").animate({
                right: "-56%",
            },500)    
        }, 5000);
    }
    else if(gMap == ""){
        $("#googlemap").css({
            border: "1px solid red",
        })
        $("#validation_general").css({
            display: "flex",
            borderLeft: "10px solid #DB6F3D",
        })
        $("#validation_general").animate({
            right: "2.5%",
        },500)      
        $("#text_validationHeader").text('Error!');
        $("#text_validationHeader").css({color: "red"})
        $("#close_general").css({color: "red"})
        $("#text_validationContent").text('You must input a google map link to save changes!');
        $("#validationGeneral_img").attr("src","images/gif/error_validation.gif");

        setTimeout(function(){
            $("#validation_general").animate({
                right: "-56%",
            },500)    
        }, 5000);
    }
    else if(g_Sitename !== "" || g_Contact !== "" || g_Location !== "" || g_Email !== "" || g_WorkingHours !== "" || g_vision !=="" || compCode!=="" || gMap!==""){
        var data = $("#ajax-form_admin_obGeneral").serialize();
        $.ajax({
            type : 'POST',
            url  : url,
            data : data,
            success :  function(data){
                    $("#validation_general").css({
                        display: "flex",
                        borderLeft: "10px solid #93C1F9",
                        })
                        //animation for edit profile
                        $("#validation_general").animate({
                            right: "2.5%",
                        },500)      
                    
                        $("#text_validationHeader").text('Success!');
                        $("#text_validationHeader").css({color: "#93C1F9"})
                        $("#close_general").css({color: "#93C1F9"})
                                $("#text_validationContent").text('The company setting has been updated!');
                                $("#validationGeneral_img").attr("src","images/gif/succes.gif");
                    
                
                        setTimeout(function(){
                            //animation for edit profile
                            $("#validation_general").animate({
                                right: "-56%",
                            },500)    
                        }, 5000);  
            }   
        });
    }
}




//form submit changes
function saveChangesHome(url){
    var h_Tagline = $("textarea#h_Tagline").val();


    if(h_Tagline == ""){
        $("#g_Sitename").css({
            border: "1px solid red",
        })
        $("#validation_general").css({
            display: "flex",
            borderLeft: "10px solid #DB6F3D",
        })
        $("#validation_general").animate({
            right: "2.5%",
        },500)      
        $("#text_validationHeader").text('Error!');
        $("#text_validationHeader").css({color: "red"})
        $("#close_general").css({color: "red"})
        $("#text_validationContent").text('You must input a site tagline to save changes!');
        $("#validationGeneral_img").attr("src","images/gif/error_validation.gif");

        setTimeout(function(){
            $("#validation_general").animate({
                right: "-56%",
            },500)    
        }, 5000);
    }
    else if(h_Tagline !==""){
        var data = $("#ajax-form_admin_obGeneral").serialize();
        $.ajax({
            type : 'POST',
            url  : url,
            data : data,
            success :  function(data){
                    $("#validation_general").css({
                        display: "flex",
                        borderLeft: "10px solid #93C1F9",
                        })
                        //animation for edit profile
                        $("#validation_general").animate({
                            right: "2.5%",
                        },500)      
                    
                        $("#text_validationHeader").text('Success!');
                        $("#text_validationHeader").css({color: "#93C1F9"})
                        $("#close_general").css({color: "#93C1F9"})
                        $("#text_validationContent").text('The company setting has been updated!');
                        $("#validationGeneral_img").attr("src","images/gif/succes.gif");
                
                        setTimeout(function(){
                            //animation for edit profile
                            $("#validation_general").animate({
                                right: "-56%",
                            },500)    
                        }, 5000);  
            }   
        });
    }
}


//form submit changes
function saveChangesAbout(url){
    var a_about = $("textarea#a_about").val();


    if(a_about == ""){
        $("#g_Sitename").css({
            border: "1px solid red",
        })
        $("#validation_general").css({
            display: "flex",
            borderLeft: "10px solid #DB6F3D",
        })
        $("#validation_general").animate({
            right: "2.5%",
        },500)      
        $("#text_validationHeader").text('Error!');
        $("#text_validationHeader").css({color: "red"})
        $("#close_general").css({color: "red"})
        $("#text_validationContent").text('You must input a site about content to save changes!');
        $("#validationGeneral_img").attr("src","images/gif/error_validation.gif");

        setTimeout(function(){
            $("#validation_general").animate({
                right: "-56%",
            },500)    
        }, 5000);
    }
    else if(a_about !==""){
        var data = $("#ajax-form_admin_obGeneral").serialize();
        $.ajax({
            type : 'POST',
            url  : url,
            data : data,
            success :  function(data){
                    $("#validation_general").css({
                        display: "flex",
                        borderLeft: "10px solid #93C1F9",
                        })
                        //animation for edit profile
                        $("#validation_general").animate({
                            right: "2.5%",
                        },500)      
                    
                        $("#text_validationHeader").text('Success!');
                        $("#text_validationHeader").css({color: "#93C1F9"})
                        $("#close_general").css({color: "#93C1F9"})
                        $("#text_validationContent").text('The company setting has been updated!');
                        $("#validationGeneral_img").attr("src","images/gif/succes.gif");
                
                        setTimeout(function(){
                            //animation for edit profile
                            $("#validation_general").animate({
                                right: "-56%",
                            },500)    
                        }, 5000);  
            }   
        });
    }
}


//form submit changes
function saveChangesEmpAll(url){
    var e_content = document.querySelector("#e_content").value;

    const inputFeilds = document.querySelectorAll("#e_Quote");
    const validInputs = Array.from(inputFeilds).filter( input => input.value === "");

    const inputFeilds1 = document.querySelectorAll("#e_QuotedBy");
    const validInputs1 = Array.from(inputFeilds1).filter( input => input.value === "");


    if(e_content == ""){
        $("#g_Sitename").css({
            border: "1px solid red",
        })
        $("#validation_general").css({
            display: "flex",
            borderLeft: "10px solid #DB6F3D",
        })
        $("#validation_general").animate({
            right: "2.5%",
        },500)      
        $("#text_validationHeader").text('Error!');
        $("#text_validationHeader").css({color: "red"})
        $("#close_general").css({color: "red"})
        $("#text_validationContent").text('You must input a site employee content to save changes!');
        $("#validationGeneral_img").attr("src","images/gif/error_validation.gif");

        setTimeout(function(){
            $("#validation_general").animate({
                right: "-56%",
            },500)    
        }, 5000);
    }
    else if(validInputs.length !== 0){
        $("#validation_general").css({
            display: "flex",
            borderLeft: "10px solid #DB6F3D",
        })
        $("#validation_general").animate({
            right: "2.5%",
        },500)      
        $("#text_validationHeader").text('Error!');
        $("#text_validationHeader").css({color: "red"})
        $("#close_general").css({color: "red"})
        $("#text_validationContent").text('You must input a employee quote to save changes!');
        $("#validationGeneral_img").attr("src","images/gif/error_validation.gif");

        setTimeout(function(){
            $("#validation_general").animate({
                right: "-56%",
            },500)    
        }, 5000);
    }
    else if(validInputs1.length !== 0){
        $("#validation_general").css({
            display: "flex",
            borderLeft: "10px solid #DB6F3D",
        })
        $("#validation_general").animate({
            right: "2.5%",
        },500)      
        $("#text_validationHeader").text('Error!');
        $("#text_validationHeader").css({color: "red"})
        $("#close_general").css({color: "red"})
        $("#text_validationContent").text('You must input a quote author to save changes!');
        $("#validationGeneral_img").attr("src","images/gif/error_validation.gif");

        setTimeout(function(){
            $("#validation_general").animate({
                right: "-56%",
            },500)    
        }, 5000);
    }
    else{
        var data = $("#ajax-form_admin_obGeneral").serialize();
        $.ajax({
            type : 'POST',
            url  : url,
            data : data,
            success :  function(data){
                    $("#validation_general").css({
                        display: "flex",
                        borderLeft: "10px solid #93C1F9",
                        })
                        //animation for edit profile
                        $("#validation_general").animate({
                            right: "2.5%",
                        },500)      
                    
                        $("#text_validationHeader").text('Success!');
                        $("#text_validationHeader").css({color: "#93C1F9"})
                        $("#close_general").css({color: "#93C1F9"})
                        $("#text_validationContent").text('The company setting has been updated!');
                        $("#validationGeneral_img").attr("src","images/gif/succes.gif");
                
                        setTimeout(function(){
                            //animation for edit profile
                            $("#validation_general").animate({
                                right: "-56%",
                            },500)    
                        }, 5000);  
            }   
        });
    }
}





//====================================================top linking
function go_General(){
    document.getElementById("general_setting").style.display = "block";
    document.getElementById("home_setting").style.display = "none";
    document.getElementById("about_setting").style.display = "none";
    document.getElementById("employee_setting").style.display = "none";
    document.getElementById("service_setting").style.display = "none";
    document.getElementById("appointment_setting").style.display = "none";
    document.getElementById("audit_setting").style.display = "none";

    document.getElementById("act_General").style.boxShadow = "rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px";
    document.getElementById("act_General").style.backgroundColor = "rgb(248, 248, 248)";

    document.getElementById("act_Home").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_Home").style.backgroundColor = "transparent";
    document.getElementById("act_About").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_About").style.backgroundColor = "transparent";
    document.getElementById("act_Employee").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_Employee").style.backgroundColor = "transparent";
    document.getElementById("act_Service").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_Service").style.backgroundColor = "transparent";
    document.getElementById("act_Appointment").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_Appointment").style.backgroundColor = "transparent";
    document.getElementById("act_Audit").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_Audit").style.backgroundColor = "transparent";
    document.getElementById("act_Backup").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_Backup").style.backgroundColor = "transparent"; 

    document.getElementById("save_setting").style.display = "flex";
    document.getElementById("save_setting1").style.display = "flex";
    document.getElementById("save_setting2").style.display = "none";
    document.getElementById("save_setting3").style.display = "none";
    document.getElementById("save_setting4").style.display = "none";
    document.getElementById("save_setting5").style.display = "none";
    document.getElementById("save_setting6").style.display = "none";

    document.getElementById("incre_decre_Service").style.display = "none";
}

function go_home_setting(){
    document.getElementById("home_setting").style.display = "block";
    document.getElementById("general_setting").style.display = "none";
    document.getElementById("about_setting").style.display = "none";
    document.getElementById("employee_setting").style.display = "none";
    document.getElementById("service_setting").style.display = "none";
    document.getElementById("appointment_setting").style.display = "none";
    document.getElementById("audit_setting").style.display = "none";
    document.getElementById("backup_setting").style.display = "none";

    document.getElementById("act_Home").style.boxShadow = "rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px";
    document.getElementById("act_Home").style.backgroundColor = "rgb(248, 248, 248)";

    document.getElementById("act_General").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_General").style.backgroundColor = "transparent";
    document.getElementById("act_About").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_About").style.backgroundColor = "transparent";
    document.getElementById("act_Employee").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_Employee").style.backgroundColor = "transparent";
    document.getElementById("act_Service").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_Service").style.backgroundColor = "transparent";
    document.getElementById("act_Appointment").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_Appointment").style.backgroundColor = "transparent";
    document.getElementById("act_Audit").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_Audit").style.backgroundColor = "transparent";
    document.getElementById("act_Backup").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_Backup").style.backgroundColor = "transparent"; 

    document.getElementById("save_setting").style.display = "none";
    document.getElementById("save_setting2").style.display = "flex";
    document.getElementById("save_setting1").style.display = "none";
    document.getElementById("save_setting3").style.display = "none";
    document.getElementById("save_setting4").style.display = "none";
    document.getElementById("save_setting5").style.display = "none";
    document.getElementById("save_setting6").style.display = "none";

    document.getElementById("incre_decre_Service").style.display = "none";
    document.getElementById("incre_decre_Service1").style.display = "none";
}

function go_about_setting(){
    document.getElementById("about_setting").style.display = "block";
    document.getElementById("home_setting").style.display = "none";
    document.getElementById("general_setting").style.display = "none";
    document.getElementById("employee_setting").style.display = "none";
    document.getElementById("service_setting").style.display = "none";
    document.getElementById("appointment_setting").style.display = "none";
    document.getElementById("audit_setting").style.display = "none";
    document.getElementById("backup_setting").style.display = "none";

    document.getElementById("act_About").style.boxShadow = "rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px";
    document.getElementById("act_About").style.backgroundColor = "rgb(248, 248, 248)";

    document.getElementById("act_General").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_General").style.backgroundColor = "transparent";
    document.getElementById("act_Home").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_Home").style.backgroundColor = "transparent";
    document.getElementById("act_Employee").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_Employee").style.backgroundColor = "transparent";
    document.getElementById("act_Service").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_Service").style.backgroundColor = "transparent";
    document.getElementById("act_Appointment").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_Appointment").style.backgroundColor = "transparent";
    document.getElementById("act_Audit").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_Audit").style.backgroundColor = "transparent";
    document.getElementById("act_Backup").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_Backup").style.backgroundColor = "transparent"; 

    document.getElementById("save_setting").style.display = "none";
    document.getElementById("save_setting3").style.display = "flex";
    document.getElementById("save_setting1").style.display = "none";
    document.getElementById("save_setting2").style.display = "none";
    document.getElementById("save_setting4").style.display = "none";
    document.getElementById("save_setting5").style.display = "none";
    document.getElementById("save_setting6").style.display = "none";

    document.getElementById("incre_decre_Service").style.display = "none";
    document.getElementById("incre_decre_Service1").style.display = "none";
}

function go_employee_setting(){
    document.getElementById("employee_setting").style.display = "block";
    document.getElementById("about_setting").style.display = "none";
    document.getElementById("home_setting").style.display = "none";
    document.getElementById("general_setting").style.display = "none";
    document.getElementById("service_setting").style.display = "none";
    document.getElementById("appointment_setting").style.display = "none";
    document.getElementById("audit_setting").style.display = "none";
    document.getElementById("backup_setting").style.display = "none";

    document.getElementById("act_Employee").style.boxShadow = "rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px";
    document.getElementById("act_Employee").style.backgroundColor = "rgb(248, 248, 248)";

    document.getElementById("act_General").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_General").style.backgroundColor = "transparent";
    document.getElementById("act_Home").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_Home").style.backgroundColor = "transparent";
    document.getElementById("act_About").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_About").style.backgroundColor = "transparent";
    document.getElementById("act_Service").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_Service").style.backgroundColor = "transparent";
    document.getElementById("act_Appointment").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_Appointment").style.backgroundColor = "transparent";
    document.getElementById("act_Audit").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_Audit").style.backgroundColor = "transparent";
    document.getElementById("act_Backup").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_Backup").style.backgroundColor = "transparent"; 

    document.getElementById("save_setting").style.display = "none";
    document.getElementById("save_setting3").style.display = "none";
    document.getElementById("save_setting1").style.display = "none";
    document.getElementById("save_setting2").style.display = "none";
    document.getElementById("save_setting4").style.display = "block";
    document.getElementById("save_setting5").style.display = "none";
    document.getElementById("save_setting6").style.display = "none";

    document.getElementById("incre_decre_Service").style.display = "none";
    document.getElementById("incre_decre_Service1").style.display = "none";
}

function go_service_setting(){
    document.getElementById("service_setting").style.display = "block";
    document.getElementById("employee_setting").style.display = "none";
    document.getElementById("about_setting").style.display = "none";
    document.getElementById("home_setting").style.display = "none";
    document.getElementById("general_setting").style.display = "none";
    document.getElementById("appointment_setting").style.display = "none";
    document.getElementById("audit_setting").style.display = "none";
    document.getElementById("backup_setting").style.display = "none";

    document.getElementById("act_Service").style.boxShadow = "rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px";
    document.getElementById("act_Service").style.backgroundColor ="rgb(248, 248, 248)";

    document.getElementById("act_Employee").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_Employee").style.backgroundColor = "transparent";
    document.getElementById("act_General").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_General").style.backgroundColor = "transparent";
    document.getElementById("act_Home").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_Home").style.backgroundColor = "transparent";
    document.getElementById("act_About").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_About").style.backgroundColor = "transparent";
    document.getElementById("act_Appointment").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_Appointment").style.backgroundColor = "transparent";
    document.getElementById("act_Audit").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_Audit").style.backgroundColor = "transparent";
    document.getElementById("act_Backup").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_Backup").style.backgroundColor = "transparent"; 

    document.getElementById("save_setting").style.display = "none";
    document.getElementById("save_setting3").style.display = "none";
    document.getElementById("save_setting1").style.display = "none";
    document.getElementById("save_setting2").style.display = "none";
    document.getElementById("save_setting4").style.display = "none";
    document.getElementById("save_setting5").style.display = "block";
    document.getElementById("save_setting6").style.display = "none";

    document.getElementById("incre_decre_Service").style.display = "flex";
    document.getElementById("incre_decre_Service1").style.display = "none";
}

function go_appointment_setting(){
    document.getElementById("service_setting").style.display = "none";
    document.getElementById("employee_setting").style.display = "none";
    document.getElementById("about_setting").style.display = "none";
    document.getElementById("home_setting").style.display = "none";
    document.getElementById("general_setting").style.display = "none";
    document.getElementById("appointment_setting").style.display = "block";
    document.getElementById("audit_setting").style.display = "none";
    document.getElementById("backup_setting").style.display = "none";

    document.getElementById("act_Appointment").style.boxShadow = "rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px";
    document.getElementById("act_Appointment").style.backgroundColor = "rgb(248, 248, 248)";

    document.getElementById("act_Employee").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_Employee").style.backgroundColor = "transparent";
    document.getElementById("act_General").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_General").style.backgroundColor = "transparent";
    document.getElementById("act_Home").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_Home").style.backgroundColor = "transparent";
    document.getElementById("act_About").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_About").style.backgroundColor = "transparent";
    document.getElementById("act_Service").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_Service").style.backgroundColor ="transparent";
    document.getElementById("act_Audit").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_Audit").style.backgroundColor = "transparent";
    document.getElementById("act_Backup").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_Backup").style.backgroundColor = "transparent"; 

    document.getElementById("save_setting").style.display = "none";
    document.getElementById("save_setting3").style.display = "none";
    document.getElementById("save_setting1").style.display = "none";
    document.getElementById("save_setting2").style.display = "none";
    document.getElementById("save_setting4").style.display = "none";
    document.getElementById("save_setting5").style.display = "none";
    document.getElementById("save_setting6").style.display = "block";

    document.getElementById("incre_decre_Service").style.display = "none";
    document.getElementById("incre_decre_Service1").style.display = "flex";
}


function go_audit_setting(){
    document.getElementById("service_setting").style.display = "none";
    document.getElementById("employee_setting").style.display = "none";
    document.getElementById("about_setting").style.display = "none";
    document.getElementById("home_setting").style.display = "none";
    document.getElementById("general_setting").style.display = "none";
    document.getElementById("appointment_setting").style.display = "none";
    document.getElementById("audit_setting").style.display = "block";
    document.getElementById("backup_setting").style.display = "none";

    document.getElementById("act_Audit").style.boxShadow = "rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px";
    document.getElementById("act_Audit").style.backgroundColor = "rgb(248, 248, 248)";

    document.getElementById("act_Employee").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_Employee").style.backgroundColor = "transparent";
    document.getElementById("act_General").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_General").style.backgroundColor = "transparent";
    document.getElementById("act_Home").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_Home").style.backgroundColor = "transparent";
    document.getElementById("act_About").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_About").style.backgroundColor = "transparent";
    document.getElementById("act_Service").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_Service").style.backgroundColor ="transparent";
    document.getElementById("act_Appointment").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_Appointment").style.backgroundColor = "transparent";
    document.getElementById("act_Backup").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_Backup").style.backgroundColor = "transparent"; 

    document.getElementById("save_setting").style.display = "none";
    document.getElementById("save_setting3").style.display = "none";
    document.getElementById("save_setting1").style.display = "none";
    document.getElementById("save_setting2").style.display = "none";
    document.getElementById("save_setting4").style.display = "none";
    document.getElementById("save_setting5").style.display = "none";
    document.getElementById("save_setting6").style.display = "none";

    document.getElementById("incre_decre_Service").style.display = "none";
    document.getElementById("incre_decre_Service1").style.display = "none";
}
function go_backup_setting(){
    document.getElementById("service_setting").style.display = "none";
    document.getElementById("employee_setting").style.display = "none";
    document.getElementById("about_setting").style.display = "none";
    document.getElementById("home_setting").style.display = "none";
    document.getElementById("general_setting").style.display = "none";
    document.getElementById("appointment_setting").style.display = "none";
    document.getElementById("audit_setting").style.display = "none";
    document.getElementById("backup_setting").style.display = "flex";

    document.getElementById("act_Backup").style.boxShadow = "rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px";
    document.getElementById("act_Backup").style.backgroundColor = "rgb(248, 248, 248)";

    document.getElementById("act_Employee").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_Employee").style.backgroundColor = "transparent";
    document.getElementById("act_General").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_General").style.backgroundColor = "transparent";
    document.getElementById("act_Home").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_Home").style.backgroundColor = "transparent";
    document.getElementById("act_About").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_About").style.backgroundColor = "transparent";
    document.getElementById("act_Service").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_Service").style.backgroundColor ="transparent";
    document.getElementById("act_Appointment").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_Appointment").style.backgroundColor = "transparent";
    document.getElementById("act_Audit").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_Audit").style.backgroundColor = "transparent"; 
    

    document.getElementById("save_setting").style.display = "none";
    document.getElementById("save_setting3").style.display = "none";
    document.getElementById("save_setting1").style.display = "none";
    document.getElementById("save_setting2").style.display = "none";
    document.getElementById("save_setting4").style.display = "none";
    document.getElementById("save_setting5").style.display = "none";
    document.getElementById("save_setting6").style.display = "none";

    document.getElementById("incre_decre_Service").style.display = "none";
    document.getElementById("incre_decre_Service1").style.display = "none";
}

//close sweet alert
function close_alertGeneral(){
    document.getElementById('save_btn_light').style.visibility = "hidden";
    document.getElementById('delete_btn_light').style.visibility = "hidden";
    document.getElementById('save_btn_dark').style.visibility = "hidden";
    document.getElementById('delete_btn_dark').style.visibility = "hidden";
    $("#validation_general").animate({
        right: "-56%",
    },500)     
}

function remove_val_general(key){
    document.getElementById(key).style.border = "1px solid white";
}


function toreloadPreview(){
    $("#for_reload1").load(" #for_reload1 > *");
}

function openFileLightimg(){
    document.getElementById('img_light_v').click();
    document.getElementById('save_btn_light').style.visibility = "visible";
    document.getElementById('delete_btn_light').style.visibility = "visible";
}
function loadfileLightLogo(event){
    var output=document.getElementById("image_lightVersion");
    output.src=URL.createObjectURL(event.target.files[0]);
};

function openFileDarkimg(){
    document.getElementById('img_dark_v').click()
    document.getElementById('save_btn_dark').style.visibility = "visible";
    document.getElementById('delete_btn_dark').style.visibility = "visible";           
}
function loadfileDarkLogo(event){
    var output=document.getElementById("image_DarkVersion");
    output.src=URL.createObjectURL(event.target.files[0]);
};

var len = document.getElementById("g_vision").value;
document.getElementById("char_ctr").innerHTML = len.length;
function getCharLength(){
      var spanCtr =  document.getElementById("char_ctr").innerHTML;
      var textLen =  document.getElementById("g_vision").value;
      document.getElementById("char_ctr").innerHTML = textLen.length;
}
var len1 = document.getElementById("h_Tagline").value;
document.getElementById("char_ctr1").innerHTML = len1.length;
function getCharLength1(){
      var spanCtr =  document.getElementById("char_ctr1").innerHTML;
      var textLen =  document.getElementById("h_Tagline").value;
      document.getElementById("char_ctr1").innerHTML = textLen.length;
}
function openFileLayoutimg(){
    document.getElementById('img_hLayout').click()
    document.getElementById('save_btn_Ilay').style.visibility = "visible";
    document.getElementById('delete_btn_Ilay').style.visibility = "visible";           
}
function loadfileIlayLogo(event){
    var output=document.getElementById("image_Ilay");
    output.src=URL.createObjectURL(event.target.files[0]);
};


function openFilesl1(){
    document.getElementById('file-imgSl1').click()
    document.getElementById('save_btn_Isl1').style.visibility = "visible";
    document.getElementById('delete_btn_Isl1').style.visibility = "visible";            
}
function loadfileIsl1(event){
    var output=document.getElementById("image_Sl1");
    output.src=URL.createObjectURL(event.target.files[0]);
};

function openFilesl2(){
    document.getElementById('file-imgSl2').click()
    document.getElementById('save_btn_Isl2').style.visibility = "visible";
    document.getElementById('delete_btn_Isl2').style.visibility = "visible";            
}
function loadfileIsl2(event){
    var output=document.getElementById("image_Sl2");
    output.src=URL.createObjectURL(event.target.files[0]);
};

function openFilesl3(){
    document.getElementById('file-imgSl3').click()
    document.getElementById('save_btn_Isl3').style.visibility = "visible";
    document.getElementById('delete_btn_Isl3').style.visibility = "visible";            
}
function loadfileIsl3(event){
    var output=document.getElementById("image_Sl3");
    output.src=URL.createObjectURL(event.target.files[0]);
};


function openFileal1(){
    document.getElementById('file-imgAl').click()
    document.getElementById('save_btn_aL').style.visibility = "visible";
    document.getElementById('delete_btn_aL').style.visibility = "visible";            
}
function loadfileal1(event){
    var output=document.getElementById("image_aL");
    output.src=URL.createObjectURL(event.target.files[0]);
};


var len2 = document.getElementById("a_about").value;
document.getElementById("char_ctr2").innerHTML = len2.length;
function getCharLength2(){
      var spanCtr =  document.getElementById("char_ctr2").innerHTML;
      var textLen =  document.getElementById("a_about").value;
      document.getElementById("char_ctr2").innerHTML = textLen.length;
}

function openFileal3(){
    document.getElementById('file-imgAli').click()
    document.getElementById('save_btn_Iali').style.visibility = "visible";
    document.getElementById('delete_btn_Iali').style.visibility = "visible";            
}
function loadfileali(event){
    var output=document.getElementById("image_aLI");
    output.src=URL.createObjectURL(event.target.files[0]);
};


var len3 = document.getElementById("e_content").value;
document.getElementById("char_ctr3").innerHTML = len3.length;
function getCharLength3(){
      var spanCtr =  document.getElementById("char_ctr3").innerHTML;
      var textLen =  document.getElementById("e_content").value;
      document.getElementById("char_ctr3").innerHTML = textLen.length;
}


function openFileEmp(fileID,save,del){
    document.getElementById(fileID).click()
    document.getElementById(save).style.visibility = "visible";
    document.getElementById(del).style.visibility = "visible";            
}
function loadfileEmp(event,imageId,fileImg,keyID){
    var output=document.getElementById(imageId);
    output.src=URL.createObjectURL(event.target.files[0]);

    fileN = document.getElementById(fileImg).value;
    document.getElementById(keyID).value = fileN;
};



function openFileEmp(fileID,save,del){
    document.getElementById(fileID).click()
    document.getElementById(save).style.visibility = "visible";
    document.getElementById(del).style.visibility = "visible";            
}
function loadfileServ(event,imageId,fileImg,keyID){
    var output=document.getElementById(imageId);
    output.src=URL.createObjectURL(event.target.files[0]);

    fileN = document.getElementById(fileImg).value;
    document.getElementById(keyID).value = fileN;
};


//preview img hover
function preview_Content(class1,src,IDimg){
    document.getElementById(IDimg).src = "images/preview_image/"+src;
    document.getElementsByClassName(class1)[0].style.display = "flex";
}
function mouseout_Preview(class1,src,IDimg){
    document.getElementById(IDimg).src = "";
    document.getElementsByClassName(class1)[0].style.display = "none";
}


//test---------------------
function emp1_upIMG(fileName1,save,del,cont){
    $(document).ready(function(){
        if(document.getElementById(fileName1).files.length == 0){
            document.getElementById(save).style.visibility = "hidden";
            document.getElementById(del).style.visibility = "hidden"; 
            $("#validation_general").css({
                display: "flex",
                borderLeft: "10px solid #DB6F3D",
            })
            $("#validation_general").animate({
                right: "2.5%",
            },500)      
            $("#text_validationHeader").text('Error!');
            $("#text_validationHeader").css({color: "red"})
            $("#close_general").css({color: "red"})
            $("#text_validationContent").text('Please select a file first!');
            $("#validationGeneral_img").attr("src","images/gif/error_validation.gif");
    
            setTimeout(function(){
                $("#validation_general").animate({
                    right: "-56%",
                },500)    
            }, 5000);
        }
        else{
            var name = document.getElementById(fileName1).files[0].name;
            var form_data = new FormData();
            var ext = name.split('.').pop().toLowerCase();
            if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
            {
               $("#validation_general").css({
                   display: "flex",
                   borderLeft: "10px solid #DB6F3D",
               })
               $("#validation_general").animate({
                   right: "2.5%",
               },500)      
               $("#text_validationHeader").text('Error!');
               $("#text_validationHeader").css({color: "red"})
               $("#close_general").css({color: "red"})
               $("#text_validationContent").text('The image file is invalid!');
               $("#validationGeneral_img").attr("src","images/gif/error_validation.gif");
       
               setTimeout(function(){
                   $("#validation_general").animate({
                       right: "-56%",
                   },500)    
               }, 5000);
            }
            else{
                var oFReader = new FileReader();
                oFReader.readAsDataURL(document.getElementById(fileName1).files[0]);
                var f = document.getElementById(fileName1).files[0];
                var fsize = f.size||f.fileSize;
           
                 form_data.append(fileName1, document.getElementById(fileName1).files[0]);
                 $.ajax({
                  url:"z-Ajax-GeneralEmployee.php",
                  method:"POST",
                  data: form_data,
                  contentType: false,
                  cache: false,
                  processData: false,
                  success:function(data)
                  {
                   document.getElementById(save).style.visibility = "hidden";
                   document.getElementById(del).style.visibility = "hidden"; 
                     $("."+cont).load(location.href+" ."+cont+">*","");    
                       $("#validation_general").css({
                       display: "flex",
                       borderLeft: "10px solid #93C1F9",
                       })
                       //animation for edit profile
                       $("#validation_general").animate({
                           right: "2.5%",
                       },500)      
           
                       $("#text_validationHeader").text('Success!');
                       $("#text_validationHeader").css({color: "#93C1F9"})
                       $("#close_general").css({color: "#93C1F9"})
                       $("#text_validationContent").text('The employee photo has been updated!');
                       $("#validationGeneral_img").attr("src","images/gif/succes.gif");
           
           
                       setTimeout(function(){
                           //animation for edit profile
                           $("#validation_general").animate({
                               right: "-56%",
                           },500)    
                       }, 5000);
                  }
                 });
            }
      
        }
    });
}

//form submit changes
function saveChangesEmp(url,fileName1){
    var name = document.getElementById(fileName1).files[0].name;
    var form_data = new FormData();
    var ext = name.split('.').pop().toLowerCase();
    if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
    {
       $("#validation_general").css({
           display: "flex",
           borderLeft: "10px solid #DB6F3D",
       })
       $("#validation_general").animate({
           right: "2.5%",
       },500)      
       $("#text_validationHeader").text('Error!');
       $("#text_validationHeader").css({color: "red"})
       $("#close_general").css({color: "red"})
       $("#text_validationContent").text('The image file is invalid!');
       $("#validationGeneral_img").attr("src","images/gif/error_validation.gif");

       setTimeout(function(){
           $("#validation_general").animate({
               right: "-56%",
           },500)    
       }, 5000);
    }
    else{
        var data = $("#ajax-form_admin_obGeneral").serialize();
        $.ajax({
            type : 'POST',
            url  : url,
            data : data,
            success :  function(data){
                //success
            }   
        });
    }
}



setInterval(function(){ 
   var key_allemp = document.getElementById("key_allemp")
   var key_allQuote = document.getElementById("key_allQuote")
   var key_allQuotedBy = document.getElementById("key_allQuotedBy")
   var images = document.querySelectorAll(".key_eachemp");

   var str = ""
    for(i=0 ; i<images.length ; i++) {
        str += images[i].value+" | ";
    }

    const myArray = str.split(" | ");
    for(x=0 ; x<myArray.length ; x++) {
        myArray[x] = myArray[x].split("\\").pop();
    }
    let text = myArray.toString();
    text = text.slice(0, -1) 
    key_allemp.value = text;

    var lenQuote = jQuery("textarea[id='e_Quote']").length
    var quotes = document.querySelectorAll("#e_Quote");

    var strquote = ""
    for(y=0 ; y<lenQuote ; y++){
        strquote += quotes[y].value +"|()|"
    }
    strquote = strquote.slice(0, -4) 
    key_allQuote.value = strquote;

    var quotedBy = document.querySelectorAll("#e_QuotedBy");
    var strquotedBy = ""
    for(z=0 ; z<lenQuote; z++){
        strquotedBy += quotedBy[z].value +"|()|"
    }
    strquotedBy = strquotedBy.slice(0, -4) 
    key_allQuotedBy.value = strquotedBy;

    //Services -----------
    var key_allservName = document.getElementById("key_allservName");
    var key_allservDesc = document.getElementById("key_allservDesc");
    var key_allservImage = document.getElementById("key_allservImage");

    var serviceName = document.querySelectorAll("#s_Sserv");
    var strserviceName = ""

    var lenServ = jQuery("textarea[id='s_Sdesc']").length
    document.getElementById("total_service").innerHTML = lenServ;
    for(a=0 ; a<lenServ; a++){
        strserviceName += serviceName[a].value +","
    }
    strserviceName = strserviceName.slice(0, -1) 
    key_allservName.value = strserviceName;

    var serviceDesc = document.querySelectorAll("#s_Sdesc");
    var strserviceDesc = ""
    for(b=0 ; b<lenServ; b++){
        strserviceDesc += serviceDesc[b].value +"|()|"
    }
    strserviceDesc = strserviceDesc.slice(0, -4) 
    key_allservDesc.value = strserviceDesc;


    var imagesServ = document.querySelectorAll(".key_eachServ");

    var strImage = ""
    for(c=0 ; c<imagesServ.length ; c++) {
        strImage += imagesServ[c].value+" | ";
    }
    const myArrayImageserv = strImage.split(" | ");
    for(d=0 ; d<myArrayImageserv.length ; d++) {
        myArrayImageserv[d] = myArrayImageserv[d].split("\\").pop();
    }
    let textImage = myArrayImageserv.toString();
    textImage = textImage.slice(0, -1) 
    key_allservImage.value = textImage;


    //holiday-------
    var key_allholidayName = document.getElementById("key_allholidayName");
    var key_allholidayDate = document.getElementById("key_allholidayDate");

    var holidayName = document.querySelectorAll("#holiday_name");
    var strholidayName = ""
    var lenHol = jQuery("input[id='holiday_name']").length
    document.getElementById("total_Holiday").innerHTML = lenHol;
    for(e=0 ; e<lenHol; e++){
        strholidayName += holidayName[e].value +"(|)"
    }
    strholidayName = strholidayName.slice(0, -3) 
    key_allholidayName.value = strholidayName;

    var holidayDate = document.querySelectorAll("#holiday_date");
    var strholidayDate = ""
    for(f=0 ; f<lenHol; f++){
        strholidayDate += holidayDate[f].value +"(|)"
    }
    strholidayDate = strholidayDate.slice(0, -3) 
    key_allholidayDate.value = strholidayDate;

}, 100);


function removeService(cnter){
    var myobj = document.getElementsByClassName(cnter)[0];
    myobj.remove();
}


//Adding services
var lenServ = jQuery("textarea[id='s_Sdesc']").length
var ser_ctr = lenServ;
function add_Services(){
    ser_ctr++;
    var div1 = document.createElement('div');

    file_img = "file-imgServ"+ser_ctr;
    savebtn = "save_btn_Serv"+ser_ctr;
    deletebtn = "delete_btn_Serv"+ser_ctr;
    service_count = "servicesCount"+ser_ctr;

    imageSERV = "image_Serv"+ser_ctr;
    key_eachServ = "key_eachServ"+ser_ctr;
    img_containerServ = "img_containerServ"+ser_ctr;
    preview_Serv = "preview_Serv"+ser_ctr;
    image_previeweServ = "image_previeweServ"+ser_ctr;

    div1.innerHTML = '<div id="site_title" style="align-items:flex-start;" class="servicesCount'+ser_ctr+'">'+
    '<div id="left">Services</div>'+
    '<div id="right">'+
        '<div id="img_container" class="img_containerServ'+ser_ctr+'">'+
            '<img src="images/services/default.png" style="background-color:#ffff; width:8.5vh;" id="image_Serv'+ser_ctr+'" class="emp_imgG" onerror=\'this.src="images/services/default.png"\'>'+
            '<div id="for_button">'+
                '<input type="file" id="file-imgServ'+ser_ctr+'" onchange=\'loadfileServ(event,"'+imageSERV+'","'+file_img+'" ,"'+key_eachServ+'")\'  name="file-imgServ'+ser_ctr+'" class="file_empClass" hidden>'+

                '<button style="color:#7D8790; visibility:hidden;" onclick=\'deleteServ1("'+savebtn+'","'+deletebtn+'","'+imageSERV+'")\' id="delete_btn_Serv'+ser_ctr+'" type="button">Cancel</button>'+

                '<button style="color:#35927B;"  type="button" id="update_btn_Serv'+ser_ctr+'" onclick=\'openFileEmp("'+file_img+'","'+savebtn+'" ,"'+deletebtn+'")\' >Update</button>'+

                '<button style="color:#215EE9; visibility:hidden;" id="save_btn_Serv'+ser_ctr+'" type="button" onclick=\'serv_upIMG1("'+file_img+'","'+savebtn+'" ,"'+deletebtn+'" ,"'+img_containerServ+'");saveChangesServ("z-Ajax-GeneralServicesImage.php","'+file_img+'")\'>Save</button>'+  
            '</div>'+
        '</div>'+
        '<div id="emp_edit_generic">'+
            '<p style="margin-top:5%;">Service Name</p>'+
            '<input type="text" placeholder="Service name here..." value="" style="text-transform:none;" name="s_Sserv" id="s_Sserv" onkeyup="">'+
            '<p style="margin-top:5%;">Service Description</p>'+
            '<textarea  id="s_Sdesc" placeholder="Service Description here..." onkeyup="getCharLength3();" maxlength="300" class="s_Sdesc" name="s_Sdesc" style="height:40vh;"></textarea>'+
        '</div>'+
    '</div>'+
    '<div id="preview_side1">'+
            '<input type="hidden" class="key_eachServ" id="key_eachServ'+ser_ctr+'" value="" style="text-transform:none;">'+
            '<div id="minimize" title="Remove" onclick=\'removeService("'+service_count+'")\'>&#215;</div>'+
            '<div id="preview_side" style="height:70vh;" >'+
                '<img src="images/icons/show.gif" title="Content to edit" onmouseover=\'preview_Content("'+preview_Serv+'","s_serv.png" ,"'+image_previeweServ+'")\' onmouseout=\'mouseout_Preview("'+preview_Serv+'","s_serv.png" ,"'+image_previeweServ+'")\'>'+
                '<div id="preview_img" class="preview_Serv'+ser_ctr+'">'+
                    '<img src="" id="image_previeweServ'+ser_ctr+'" style="margin-left:5%;">'+
                '</div>'+
            '</div>'+
    '</div>'+
'</div>';

    document.getElementById("service_setting").appendChild(div1);

}


function decrease_Service(){
    var x = document.getElementById("total_service").innerHTML;
    if(x>5){
        var select = document.getElementById('service_setting');
        select.removeChild(select.lastChild);
    }
    else{
        $("#validation_general").css({
            display: "flex",
            borderLeft: "10px solid #DB6F3D",
        })
        $("#validation_general").animate({
            right: "2.5%",
        },500)      
        $("#text_validationHeader").text('Error!');
        $("#text_validationHeader").css({color: "red"})
        $("#close_general").css({color: "red"})
        $("#text_validationContent").text('You have to input atleast 5 services!');
        $("#validationGeneral_img").attr("src","images/gif/error_validation.gif");
 
        setTimeout(function(){
            $("#validation_general").animate({
                right: "-56%",
            },500)    
        }, 5000);
    }
}



//test---------------------
function serv_upIMG(fileName1,save,del,cont){
    $(document).ready(function(){
        if(document.getElementById(fileName1).files.length == 0){
            document.getElementById(save).style.visibility = "hidden";
            document.getElementById(del).style.visibility = "hidden"; 
            $("#validation_general").css({
                display: "flex",
                borderLeft: "10px solid #DB6F3D",
            })
            $("#validation_general").animate({
                right: "2.5%",
            },500)      
            $("#text_validationHeader").text('Error!');
            $("#text_validationHeader").css({color: "red"})
            $("#close_general").css({color: "red"})
            $("#text_validationContent").text('Please select a file first!');
            $("#validationGeneral_img").attr("src","images/gif/error_validation.gif");
    
            setTimeout(function(){
                $("#validation_general").animate({
                    right: "-56%",
                },500)    
            }, 5000);
        }
        else{
            var name = document.getElementById(fileName1).files[0].name;
            var form_data = new FormData();
            var ext = name.split('.').pop().toLowerCase();
            if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
            {
               $("#validation_general").css({
                   display: "flex",
                   borderLeft: "10px solid #DB6F3D",
               })
               $("#validation_general").animate({
                   right: "2.5%",
               },500)      
               $("#text_validationHeader").text('Error!');
               $("#text_validationHeader").css({color: "red"})
               $("#close_general").css({color: "red"})
               $("#text_validationContent").text('The image file is invalid!');
               $("#validationGeneral_img").attr("src","images/gif/error_validation.gif");
       
               setTimeout(function(){
                   $("#validation_general").animate({
                       right: "-56%",
                   },500)    
               }, 5000);
            }
            else{
                var oFReader = new FileReader();
                oFReader.readAsDataURL(document.getElementById(fileName1).files[0]);
                var f = document.getElementById(fileName1).files[0];
                var fsize = f.size||f.fileSize;
           
                 form_data.append(fileName1, document.getElementById(fileName1).files[0]);
                 $.ajax({
                  url:"z-Ajax-GeneralService.php",
                  method:"POST",
                  data: form_data,
                  contentType: false,
                  cache: false,
                  processData: false,
                  success:function(data)
                  {
                   document.getElementById(save).style.visibility = "hidden";
                   document.getElementById(del).style.visibility = "hidden"; 
                     $("."+cont).load(location.href+" ."+cont+">*","");    
                       $("#validation_general").css({
                       display: "flex",
                       borderLeft: "10px solid #93C1F9",
                       })
                       $("#validation_general").animate({
                           right: "2.5%",
                       },500)      
           
                       $("#text_validationHeader").text('Success!');
                       $("#text_validationHeader").css({color: "#93C1F9"})
                       $("#close_general").css({color: "#93C1F9"})
                       $("#text_validationContent").text('The employee photo has been updated!');
                       $("#validationGeneral_img").attr("src","images/gif/succes.gif");
           
           
                       setTimeout(function(){
                           //animation for edit profile
                           $("#validation_general").animate({
                               right: "-56%",
                           },500)    
                       }, 5000);
                  }
                 });
            }
      
        }
    });
}


function serv_upIMG1(fileName1,save,del,cont){
    $(document).ready(function(){
        if(document.getElementById(fileName1).files.length == 0){
            document.getElementById(save).style.visibility = "hidden";
            document.getElementById(del).style.visibility = "hidden"; 
            $("#validation_general").css({
                display: "flex",
                borderLeft: "10px solid #DB6F3D",
            })
            $("#validation_general").animate({
                right: "2.5%",
            },500)      
            $("#text_validationHeader").text('Error!');
            $("#text_validationHeader").css({color: "red"})
            $("#close_general").css({color: "red"})
            $("#text_validationContent").text('Please select a file first!');
            $("#validationGeneral_img").attr("src","images/gif/error_validation.gif");
    
            setTimeout(function(){
                $("#validation_general").animate({
                    right: "-56%",
                },500)    
            }, 5000);
        }
        else{
            var name = document.getElementById(fileName1).files[0].name;
            var form_data = new FormData();
            var ext = name.split('.').pop().toLowerCase();
            if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
            {
               $("#validation_general").css({
                   display: "flex",
                   borderLeft: "10px solid #DB6F3D",
               })
               $("#validation_general").animate({
                   right: "2.5%",
               },500)      
               $("#text_validationHeader").text('Error!');
               $("#text_validationHeader").css({color: "red"})
               $("#close_general").css({color: "red"})
               $("#text_validationContent").text('The image file is invalid!');
               $("#validationGeneral_img").attr("src","images/gif/error_validation.gif");
       
               setTimeout(function(){
                   $("#validation_general").animate({
                       right: "-56%",
                   },500)    
               }, 5000);
            }
            else{
                var oFReader = new FileReader();
                oFReader.readAsDataURL(document.getElementById(fileName1).files[0]);
                var f = document.getElementById(fileName1).files[0];
                var fsize = f.size||f.fileSize;
           
                 form_data.append(fileName1, document.getElementById(fileName1).files[0]);
                 $.ajax({
                  url:"z-Ajax-GeneralService.php",
                  method:"POST",
                  data: form_data,
                  contentType: false,
                  cache: false,
                  processData: false,
                  success:function(data)
                  {
                   document.getElementById(save).style.visibility = "hidden";
                   document.getElementById(del).style.visibility = "hidden"; 
        
                       $("#validation_general").css({
                       display: "flex",
                       borderLeft: "10px solid #93C1F9",
                       })
                       $("#validation_general").animate({
                           right: "2.5%",
                       },500)      
           
                       $("#text_validationHeader").text('Success!');
                       $("#text_validationHeader").css({color: "#93C1F9"})
                       $("#close_general").css({color: "#93C1F9"})
                       $("#text_validationContent").text('The employee photo has been updated!');
                       $("#validationGeneral_img").attr("src","images/gif/succes.gif");
           
           
                       setTimeout(function(){
                           //animation for edit profile
                           $("#validation_general").animate({
                               right: "-56%",
                           },500)    
                       }, 5000);
                  }
                 });
            }
      
        }
    });
}


//form submit changes
function saveChangesServ(url,fileName1){
    var name = document.getElementById(fileName1).files[0].name;
    var form_data = new FormData();
    var ext = name.split('.').pop().toLowerCase();
    if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
    {
      
    }
    else{
        var data = $("#ajax-form_admin_obGeneral").serialize();
        $.ajax({
            type : 'POST',
            url  : url,
            data : data,
            success :  function(data){
                //success
            }   
        });
    }
}


//form submit changes
function saveChangesServAll(url){
    const inputFeilds = document.querySelectorAll("#s_Sserv");
    const validInputs = Array.from(inputFeilds).filter( input => input.value === "");

    const inputFeilds1 = document.querySelectorAll("#s_Sdesc");
    const validInputs1 = Array.from(inputFeilds1).filter( input => input.value === "");

    if(validInputs.length < 1 && validInputs1.length === 0){
        var data = $("#ajax-form_admin_obGeneral").serialize();
        $.ajax({
            type : 'POST',
            url  : url,
            data : data,
            success :  function(data){
                    $("#validation_general").css({
                        display: "flex",
                        borderLeft: "10px solid #93C1F9",
                        })
                        //animation for edit profile
                        $("#validation_general").animate({
                            right: "2.5%",
                        },500)      
                    
                        $("#text_validationHeader").text('Success!');
                        $("#text_validationHeader").css({color: "#93C1F9"})
                        $("#close_general").css({color: "#93C1F9"})
                        $("#text_validationContent").text('The company setting has been updated!');
                        $("#validationGeneral_img").attr("src","images/gif/succes.gif");
                
                        setTimeout(function(){
                            //animation for edit profile
                            $("#validation_general").animate({
                                right: "-56%",
                            },500)    
                        }, 5000);  
            }   
        });
    }
    else if(validInputs1.length != 0){
        $("#validation_general").css({
            display: "flex",
            borderLeft: "10px solid #DB6F3D",
        })
        $("#validation_general").animate({
            right: "2.5%",
        },500)      
        $("#text_validationHeader").text('Error!');
        $("#text_validationHeader").css({color: "red"})
        $("#close_general").css({color: "red"})
        $("#text_validationContent").text('You must input a service description to save changes');
        $("#validationGeneral_img").attr("src","images/gif/error_validation.gif");

        setTimeout(function(){
            $("#validation_general").animate({
                right: "-56%",
            },500)    
        }, 5000);
    }
    else{
        $("#validation_general").css({
            display: "flex",
            borderLeft: "10px solid #DB6F3D",
        })
        $("#validation_general").animate({
            right: "2.5%",
        },500)      
        $("#text_validationHeader").text('Error!');
        $("#text_validationHeader").css({color: "red"})
        $("#close_general").css({color: "red"})
        $("#text_validationContent").text('You must input a service name to save changes');
        $("#validationGeneral_img").attr("src","images/gif/error_validation.gif");

        setTimeout(function(){
            $("#validation_general").animate({
                right: "-56%",
            },500)    
        }, 5000);
    }

}


//office holiday
var lenHol = jQuery("input[id='holiday_name']").length
var hol_ctr = lenHol;
function add_Holiday(){
    hol_ctr++;
    var div1 = document.createElement('div');


    div1.innerHTML ='<div id="site_title" style="align-items:flex-start;" class="servicesCount'+hol_ctr+'">'+
        '<div id="left">Date</div>'+
        '<div id="right">'+
            '<div id="emp_edit_generic" style="margin-top:0%;">'+
                '<p>Notes</p>'+
                '<input type="text" placeholder="ex. Holiday" style="text-transform:Capitalize;" id="holiday_name">'+
                '<p style="margin-top:5%;">Date</p>'+
                '<input type="date"  style="text-transform:none; width:54%;" id="holiday_date">'+
            '</div>'+
        '</div>'+
        '<div id="preview_side1" style="height:auto;">'+
                '<div id="minimize" onclick=\'removeHoliday("servicesCount'+hol_ctr+'")\'>&#215;</div>'+
    '</div>';

    document.getElementById("appointment_setting").appendChild(div1);

}


function decrease_Holiday(){
    var x = document.getElementById("total_Holiday").innerHTML;
    if(x != 1){
       var select = document.getElementById('appointment_setting');
       select.removeChild(select.lastChild);
    }
}

function removeHoliday(cnter){
    var myobj = document.getElementsByClassName(cnter)[0];
    myobj.remove();
}


//form submit changes
function saveChangesholidayAll(url){
    const inputFeilds = document.querySelectorAll("#holiday_name");
    const validInputs = Array.from(inputFeilds).filter( input => input.value === "");

    const inputFeilds1 = document.querySelectorAll("#holiday_date");
    const validInputs1 = Array.from(inputFeilds1).filter( input => input.value === "");

    if(validInputs.length < 1 && validInputs1.length === 0){
        var data = $("#ajax-form_admin_obGeneral").serialize();
        $.ajax({
            type : 'POST',
            url  : url,
            data : data,
            success :  function(data){
                    $("#validation_general").css({
                        display: "flex",
                        borderLeft: "10px solid #93C1F9",
                        })
                        //animation for edit profile
                        $("#validation_general").animate({
                            right: "2.5%",
                        },500)      
                    
                        $("#text_validationHeader").text('Success!');
                        $("#text_validationHeader").css({color: "#93C1F9"})
                        $("#close_general").css({color: "#93C1F9"})
                        $("#text_validationContent").text('The company setting has been updated!');
                        $("#validationGeneral_img").attr("src","images/gif/succes.gif");
                
                        setTimeout(function(){
                            //animation for edit profile
                            $("#validation_general").animate({
                                right: "-56%",
                            },500)    
                        }, 5000);  
            }   
        });
    }
    else if(validInputs1.length != 0){
        $("#validation_general").css({
            display: "flex",
            borderLeft: "10px solid #DB6F3D",
        })
        $("#validation_general").animate({
            right: "2.5%",
        },500)      
        $("#text_validationHeader").text('Error!');
        $("#text_validationHeader").css({color: "red"})
        $("#close_general").css({color: "red"})
        $("#text_validationContent").text('You must input a holiday date to save changes');
        $("#validationGeneral_img").attr("src","images/gif/error_validation.gif");

        setTimeout(function(){
            $("#validation_general").animate({
                right: "-56%",
            },500)    
        }, 5000);
    }
    else{
        $("#validation_general").css({
            display: "flex",
            borderLeft: "10px solid #DB6F3D",
        })
        $("#validation_general").animate({
            right: "2.5%",
        },500)      
        $("#text_validationHeader").text('Error!');
        $("#text_validationHeader").css({color: "red"})
        $("#close_general").css({color: "red"})
        $("#text_validationContent").text('You must input a holiday name to save changes');
        $("#validationGeneral_img").attr("src","images/gif/error_validation.gif");

        setTimeout(function(){
            $("#validation_general").animate({
                right: "-56%",
            },500)    
        }, 5000);
    }

}


function showRestoreDefault(){
    document.getElementById("remove_container").style.display = "flex";
}

function closeRestore(){
    document.getElementById("remove_container").style.display = "none";
}


function restoreButton(url){
        var data = $("#ajax-form_ob_restore").serialize();
        $.ajax({
            type : 'POST',
            url  : url,
            data : data,
            success :  function(data){
                    location.reload();
            }   
        });
}


//backup db
function show_validBackup(){
    document.getElementById("validate_backup").style.display = "flex";
}
function close_validBackup(){
    document.getElementById("C_code").value = "";
    document.getElementById("validate_backup").style.display = "none";
}


function download_database(){
   var code =  document.getElementById("C_code").value
   var base =document.getElementById("baseCodeOnly").value

           if(code === ""){
            $("#validation_general").css({
                display: "flex",
                borderLeft: "10px solid #DB6F3D",
            })
            $("#validation_general").animate({
                right: "2.5%",
            },500)      
            $("#text_validationHeader").text('Error!');
            $("#text_validationHeader").css({color: "red"})
            $("#close_general").css({color: "red"})
            $("#text_validationContent").text('Company code is empty!');
            $("#validationGeneral_img").attr("src","images/gif/error_validation.gif");
    
            setTimeout(function(){
                $("#validation_general").animate({
                    right: "-56%",
                },500)    
            }, 5000);
        }
        else if(code !== base){
            $("#validation_general").css({
                display: "flex",
                borderLeft: "10px solid #DB6F3D",
            })
            $("#validation_general").animate({
                right: "2.5%",
            },500)      
            $("#text_validationHeader").text('Error!');
            $("#text_validationHeader").css({color: "red"})
            $("#close_general").css({color: "red"})
            $("#text_validationContent").text('Invalid Company code!');
            $("#validationGeneral_img").attr("src","images/gif/error_validation.gif");
    
            setTimeout(function(){
                $("#validation_general").animate({
                    right: "-56%",
                },500)    
            }, 5000);
        }
        else{
            window.location.href = "z-Ajax-DowloadBackup.php";
            document.getElementById("C_code").value = "";
            document.getElementById("validate_backup").style.display = "none";
        }
}

//import db
function show_validBackupImport(){
    document.getElementById("validate_backupImport").style.display = "flex";
}
function close_validBackupImport(){
    document.getElementById("C_code1").value = "";
    document.getElementById("validate_backupImport").style.display = "none";
}






$(document).on('click', '#import_backup', function(){
    var code = $("input#C_code1").val();
    var base = $("input#baseCodeOnly1").val();
    var file = document.getElementById("fileBackup");

    if(file.files.length == 0){
        $("#validation_general").css({
            display: "flex",
            borderLeft: "10px solid #DB6F3D",
        })
        $("#validation_general").animate({
            right: "2.5%",
        },500)      
        $("#text_validationHeader").text('Error!');
        $("#text_validationHeader").css({color: "red"})
        $("#close_general").css({color: "red"})
        $("#text_validationContent").text('You must input a file!');
        $("#validationGeneral_img").attr("src","images/gif/error_validation.gif");

        setTimeout(function(){
            $("#validation_general").animate({
                right: "-56%",
            },500)    
        }, 5000);
    }
    else if(code === ""){
        $("#validation_general").css({
            display: "flex",
            borderLeft: "10px solid #DB6F3D",
        })
        $("#validation_general").animate({
            right: "2.5%",
        },500)      
        $("#text_validationHeader").text('Error!');
        $("#text_validationHeader").css({color: "red"})
        $("#close_general").css({color: "red"})
        $("#text_validationContent").text('Company code is empty!');
        $("#validationGeneral_img").attr("src","images/gif/error_validation.gif");

        setTimeout(function(){
            $("#validation_general").animate({
                right: "-56%",
            },500)    
        }, 5000);

    }
    else if(code !== base){
        $("#validation_general").css({
            display: "flex",
            borderLeft: "10px solid #DB6F3D",
        })
        $("#validation_general").animate({
            right: "2.5%",
        },500)      
        $("#text_validationHeader").text('Error!');
        $("#text_validationHeader").css({color: "red"})
        $("#close_general").css({color: "red"})
        $("#text_validationContent").text('Invalid Company code!');
        $("#validationGeneral_img").attr("src","images/gif/error_validation.gif");

        setTimeout(function(){
            $("#validation_general").animate({
                right: "-56%",
            },500)    
        }, 5000);
    }
    else{
        var name = document.getElementById("fileBackup").files[0].name;
        var form_data = new FormData();
        var ext = name.split('.').pop().toLowerCase();    
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("fileBackup").files[0]);
            var f = document.getElementById("fileBackup").files[0];
            var fsize = f.size||f.fileSize;
             form_data.append("backup_file", document.getElementById('fileBackup').files[0]);
             $.ajax({
              url:"z-Ajax-AdminImportBackup.php",
              method:"POST",
              data: form_data,
              contentType: false,
              cache: false,
              processData: false,
              beforeSend: function() {
                document.getElementById("loading_succes").style.display = "flex";
              },
              success:function(data)
              {
                if ($.trim(data) === "success"){
                    document.getElementById("loading_succes").style.display = "none";
                    document.getElementById("C_code1").value = "";
                    document.getElementById("validate_backupImport").style.display = "none";

                    $("#validation_general").css({
                        display: "flex",
                        borderLeft: "10px solid #93C1F9",
                        })
                        //animation for edit profile
                        $("#validation_general").animate({
                            right: "2.5%",
                        },500)      
                    
                        $("#text_validationHeader").text('Success!');
                        $("#text_validationHeader").css({color: "#93C1F9"})
                        $("#close_general").css({color: "#93C1F9"})
                        $("#text_validationContent").text('The company database has been restored!');
                        $("#validationGeneral_img").attr("src","images/gif/succes.gif");
                
                        setTimeout(function(){
                            //animation for edit profile
                            $("#validation_general").animate({
                                right: "-56%",
                            },500)    
                        }, 5000);  
                }
              }
             });
        
    }
});

