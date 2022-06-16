$(document).ready(function (e){
    $("#ajax-form_patient_editprofilephoto").on('submit',(function(e){ e.preventDefault();
        var name = document.getElementById("file-input").files[0].name;
        var ext = name.split('.').pop().toLowerCase();

        if( document.getElementById("file-input").files.length == 0 ){
            document.getElementById("sweetalert_container").style.display = "flex";
            document.querySelector(".success_btn_alert").style.display = "none";
            document.querySelector(".close_btn_alert").style.display = "block";
            $('#gif_alert').attr('src','images/gif/error_validation.gif');
            $('.header_text_validation_appointment').text("Error!")
            $('.message_alert').text("You must select a file.")

            $('.header_text_validation_appointment').css({
                color: "red",
            });
            $('#close_alert').css({
                backgroundColor: "black",
            });
        }
        else if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
            document.getElementById("sweetalert_container").style.display = "flex";
            document.querySelector(".success_btn_alert").style.display = "none";
            document.querySelector(".close_btn_alert").style.display = "block";
            $('#gif_alert').attr('src','images/gif/error_validation.gif');
            $('.header_text_validation_appointment').text("Error!")
            $('.message_alert').text("The image file is invalid!")

            $('.header_text_validation_appointment').css({
                color: "red",
            });
            $('#close_alert').css({
                backgroundColor: "black",
            });
        }
        else{
            $.ajax({
                url: "z-Ajax-PatientEditProfilePic.php",
                type: "POST",
                data: new FormData(this),
                contentType: false, cache: false, processData:false,
                success: function(data){
                    $(".reload_img_admin_editprofile").load(" .reload_img_admin_editprofile > *");
                    $(".reload_img_admin_editprofile1").load(" .reload_img_admin_editprofile1 > *");
                },
                error: function(){}
            });
        }
    }));
});