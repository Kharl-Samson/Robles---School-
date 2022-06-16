//go to all message
function go_Allmessage(){
    document.getElementById("unarchive_all_btn").style.display = "none";
    document.getElementById("archive_all_btn").style.display = "flex";
    //to reload div and span
    $("#Inq_inbox_span").load(window.location + " #Inq_inbox_span");
    $("#Inq_unread_span").load(window.location + " #Inq_unread_span");
    $("#Inq_archive_span").load(window.location + " #Inq_archive_span");

    document.getElementById("Inq_inbox").style.backgroundColor = "rgb(248, 248, 248)"
    document.getElementById("Inq_inbox").style.boxShadow = "rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px"
    document.getElementById("Inq_unread").style.backgroundColor = "transparent"
    document.getElementById("Inq_unread").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px"
    document.getElementById("Inq_archive").style.backgroundColor = "transparent"
    document.getElementById("Inq_archive").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px"

    document.getElementById("all_forRead").style.display = "flex";
    document.getElementById("all_forUnread").style.display = "none";
    document.getElementById("all_forArchive").style.display = "none";
    document.getElementById("read_inquiry").style.display = "block"
    document.getElementById("unread_inquiry").style.display = "none"
    document.getElementById("archive_inquiry").style.display = "none"

    document.querySelectorAll('.checkbox_all_eachRead1').forEach(st => {
        st.checked = false;
    });
    document.querySelectorAll('.checkbox_all_eachUnread1').forEach(st => {
        st.checked = false
    });
    document.querySelectorAll('.checkbox_all_EachArchive1').forEach(st => {
        st.checked = false;
    });
    document.querySelectorAll('.each_message').forEach(st => {
        st.style.backgroundColor = "#ffff";
    });     

    document.getElementById("checkbox_allRead").checked = false;
    document.getElementById("checkbox_allUnread").checked = false;
    document.getElementById("checkbox_allArchive").checked = false;
}

//go to unread message
function go_Unreadmessage(){
    document.getElementById("unarchive_all_btn").style.display = "none";
    document.getElementById("archive_all_btn").style.display = "flex";
    //to reload div and span
    $("#Inq_inbox_span").load(window.location + " #Inq_inbox_span");
    $("#Inq_unread_span").load(window.location + " #Inq_unread_span");
    $("#Inq_archive_span").load(window.location + " #Inq_archive_span");

    document.getElementById("Inq_unread").style.backgroundColor = "rgb(248, 248, 248)"
    document.getElementById("Inq_unread").style.boxShadow = "rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px"
    document.getElementById("Inq_inbox").style.backgroundColor = "transparent"
    document.getElementById("Inq_inbox").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px"
    document.getElementById("Inq_archive").style.backgroundColor = "transparent"
    document.getElementById("Inq_archive").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px"

    document.getElementById("all_forRead").style.display = "none";
    document.getElementById("all_forUnread").style.display = "flex";
    document.getElementById("all_forArchive").style.display = "none"; 
    document.getElementById("read_inquiry").style.display = "none"
    document.getElementById("unread_inquiry").style.display = "block"
    document.getElementById("archive_inquiry").style.display = "none"

    document.querySelectorAll('.checkbox_all_eachRead1').forEach(st => {
        st.checked = false;
    });
    document.querySelectorAll('.checkbox_all_eachUnread1').forEach(st => {
        st.checked = false
    });
    document.querySelectorAll('.checkbox_all_EachArchive1').forEach(st => {
        st.checked = false;
    });
    document.querySelectorAll('.each_message').forEach(st => {
        st.style.backgroundColor = "#ffff";
    });   
    
    document.getElementById("checkbox_allRead").checked = false;
    document.getElementById("checkbox_allUnread").checked = false;
    document.getElementById("checkbox_allArchive").checked = false;
}

//go to archive message
function go_Archivemessage(){
    document.getElementById("unarchive_all_btn").style.display = "flex";
    document.getElementById("archive_all_btn").style.display = "none";
    //to reload div and span
    $("#Inq_inbox_span").load(window.location + " #Inq_inbox_span");
    $("#Inq_unread_span").load(window.location + " #Inq_unread_span");
    $("#Inq_archive_span").load(window.location + " #Inq_archive_span");

    document.getElementById("Inq_archive").style.backgroundColor = "rgb(248, 248, 248)"
    document.getElementById("Inq_archive").style.boxShadow = "rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px"
    document.getElementById("Inq_inbox").style.backgroundColor = "transparent"
    document.getElementById("Inq_inbox").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px"
    document.getElementById("Inq_unread").style.backgroundColor = "transparent"
    document.getElementById("Inq_unread").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px"

    document.getElementById("all_forRead").style.display = "none";
    document.getElementById("all_forUnread").style.display = "none";
    document.getElementById("all_forArchive").style.display = "flex";
    document.getElementById("read_inquiry").style.display = "none"
    document.getElementById("unread_inquiry").style.display = "none"
    document.getElementById("archive_inquiry").style.display = "block"
    document.querySelectorAll('.checkbox_all_eachRead1').forEach(st => {
        st.checked = false;
    });
    document.querySelectorAll('.checkbox_all_eachUnread1').forEach(st => {
        st.checked = false
    });
    document.querySelectorAll('.checkbox_all_EachArchive1').forEach(st => {
        st.checked = false;
    });
    document.querySelectorAll('.each_message').forEach(st => {
        st.style.backgroundColor = "#ffff";
    });    
    
    document.getElementById("checkbox_allRead").checked = false;
    document.getElementById("checkbox_allUnread").checked = false;
    document.getElementById("checkbox_allArchive").checked = false;
}

function validate_check_all_read() {
        if (document.getElementById('checkbox_allRead').checked === true) {
            document.querySelectorAll('.checkbox_all_eachRead1').forEach(st => {
                st.checked = true;
            });
            document.querySelectorAll('.em_read').forEach(st => {
                st.style.backgroundColor = "#c2dbff";
            });  
        } else {
            document.querySelectorAll('.checkbox_all_eachRead1').forEach(st => {
                st.checked = false;
             });
             document.querySelectorAll('.em_read').forEach(st => {
                st.style.backgroundColor = "#ffff";
            });     
        }
}

function validate_check_all_unread() {
    if (document.getElementById('checkbox_allUnread').checked === true) {
        document.querySelectorAll('.checkbox_all_eachUnread1').forEach(st => {
            st.checked = true;
        });
        document.querySelectorAll('.em_unread').forEach(st => {
            st.style.backgroundColor = "#c2dbff";
        });  
    } else {
        document.querySelectorAll('.checkbox_all_eachUnread1').forEach(st => {
            st.checked = false;
         });
         document.querySelectorAll('.em_unread').forEach(st => {
            st.style.backgroundColor = "#ffff";
        });     
    }
}

function validate_check_all_archive() {
    if (document.getElementById('checkbox_allArchive').checked === true) {
        document.querySelectorAll('.checkbox_all_EachArchive1').forEach(st => {
            st.checked = true;
        });
        document.querySelectorAll('.em_archive').forEach(st => {
            st.style.backgroundColor = "#c2dbff";
        });  
    } else {
        document.querySelectorAll('.checkbox_all_EachArchive1').forEach(st => {
            st.checked = false;
         });
         document.querySelectorAll('.em_archive').forEach(st => {
            st.style.backgroundColor = "#ffff";
        });     
    }
}




function hover_inq(key){
    document.querySelectorAll('.hoverinc'+key).forEach(st => {
        st.style.display= "flex"
    });
    document.querySelectorAll('.time_each'+key).forEach(st => {
        st.style.visibility="hidden"
    });
}
function hoverout_inq(key){
    document.querySelectorAll('.hoverinc'+key).forEach(st => {
        st.style.display= "none"
    });
    document.querySelectorAll('.time_each'+key).forEach(st => {
        st.style.visibility="visible"
    });
}
//for unread
function hover_inq1(key){
    document.querySelectorAll('.hoverinc1'+key).forEach(st => {
        st.style.display= "flex"
    });
    document.querySelectorAll('.time_each1'+key).forEach(st => {
        st.style.visibility="hidden"
    });
}
function hoverout_inq1(key){
    document.querySelectorAll('.hoverinc1'+key).forEach(st => {
        st.style.display= "none"
    });
    document.querySelectorAll('.time_each1'+key).forEach(st => {
        st.style.visibility="visible"
    });
}



//close message box inquiry
function close_messageInq(){
    document.getElementById("View_inq_content").style.display = "none";
}

//ajax view inquiry
function view_inq(valkey_inq){
    xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () =>{
        if(xhr.readyState == 4 && xhr.status == 200){
            var ret = JSON.parse(xhr.responseText);
           if(ret.status === 1){
              $("#View_inq_content").load(location.href+" #View_inq_content>*","");
              document.getElementById("View_inq_content").style.display="flex"

              document.getElementById("sweetalert_container_inq").style.display="none";
              $("#read_inquiry").load(location.href+" #read_inquiry>*","");
              $("#unread_inquiry").load(location.href+" #unread_inquiry>*","");
              $("#archive_inquiry").load(location.href+" #archive_inquiry>*","");              
              $("#Inq_inbox_span").load(window.location + " #Inq_inbox_span");
              $("#Inq_unread_span").load(window.location + " #Inq_unread_span");
              $("#Inq_archive_span").load(window.location + " #Inq_archive_span");

              document.getElementById('checkbox_allRead').checked = false;
              document.getElementById('checkbox_allUnread').checked = false;
              document.getElementById('checkbox_allArchive').checked = false;
            }
        }
    };

    xhr.open("GET", "z-Ajax-AdminViewInquiry.php?keyInq=" +valkey_inq, true);
    xhr.send();
}


//archive modal show
function show_archiveModal(){
    if ($('input[name="each_cb[]"]:checked').length>0) {
        document.getElementById("archive_container").style.display = "flex"
        return true;
    } else {
        //no checkbox is checked
        return false;
      }
}

//unarchive modal show
function show_unarchiveModal(){
    if ($('input[name="each_cb[]"]:checked').length>0) {
        document.getElementById("unarchive_container").style.display = "flex"
        return true;
    } else {
        //no checkbox is checked
        return false;
      }
}


//delete modal show
function show_deleteModal(){
    if ($('input[name="each_cb[]"]:checked').length>0) {
        document.getElementById("Delete_container").style.display = "flex"
        return true;
    } else {
        //no checkbox is checked
        return false;
      }
}



//archive modal close
function close_archiveModal(){
    document.getElementById("archive_container").style.display = "none"

    document.querySelectorAll('.checkbox_all_eachRead1').forEach(st => {
        st.checked = false;
    });
    document.querySelectorAll('.checkbox_all_eachUnread1').forEach(st => {
        st.checked = false;
    });
    document.querySelectorAll('.checkbox_all_EachArchive1').forEach(st => {
        st.checked = false;
    });
    document.querySelectorAll('.each_message').forEach(st => {
        st.style.backgroundColor = "#ffff";
    });  
    document.getElementById('checkbox_allRead').checked = false;
    document.getElementById('checkbox_allUnread').checked = false;
    document.getElementById('checkbox_allArchive').checked = false;
}

//unarchive modal close
function close_unarchiveModal(){
    document.getElementById("unarchive_container").style.display = "none"

    document.querySelectorAll('.checkbox_all_eachRead1').forEach(st => {
        st.checked = false;
    });
    document.querySelectorAll('.checkbox_all_eachUnread1').forEach(st => {
        st.checked = false;
    });
    document.querySelectorAll('.checkbox_all_EachArchive1').forEach(st => {
        st.checked = false;
    });
    document.querySelectorAll('.each_message').forEach(st => {
        st.style.backgroundColor = "#ffff";
    });  
    document.getElementById('checkbox_allRead').checked = false;
    document.getElementById('checkbox_allUnread').checked = false;
    document.getElementById('checkbox_allArchive').checked = false;
}


//delete modal close
function close_deleteModal(){
    document.getElementById("Delete_container").style.display = "none"

    document.querySelectorAll('.checkbox_all_eachRead1').forEach(st => {
        st.checked = false;
    });
    document.querySelectorAll('.checkbox_all_eachUnread1').forEach(st => {
        st.checked = false;
    });
    document.querySelectorAll('.checkbox_all_EachArchive1').forEach(st => {
        st.checked = false;
    });
    document.querySelectorAll('.each_message').forEach(st => {
        st.style.backgroundColor = "#ffff";
    });  
    document.getElementById('checkbox_allRead').checked = false;
    document.getElementById('checkbox_allUnread').checked = false;
    document.getElementById('checkbox_allArchive').checked = false;
}


//archive all check
function archiveForm(url){
    var data = $("#ajax-form_admin_archiveMessage").serialize();
    $.ajax({
        type : 'POST',
        url  : url,
        data : data,
        success :  function(response){
            if($.trim(response) === "success"){
                document.getElementById("sweetalert_container_inq").style.display="flex";
                document.querySelector(".message_alert").innerHTML = "Message has been move to archive."
            }
        }
    });
}

//unarchive all check
function unarchiveForm(url){
    var data = $("#ajax-form_admin_archiveMessage").serialize();
    $.ajax({
        type : 'POST',
        url  : url,
        data : data,
        success :  function(response){
            if($.trim(response) === "success"){
                document.getElementById("sweetalert_container_inq").style.display="flex";
                document.querySelector(".message_alert").innerHTML = "Message has been remove to archive."
            }
        }
    });
}

//delete all check
function deleteForm(url){
    var data = $("#ajax-form_admin_archiveMessage").serialize();
    $.ajax({
        type : 'POST',
        url  : url,
        data : data,
        success :  function(response){
            if($.trim(response) === "success"){
                document.getElementById("sweetalert_container_inq").style.display="flex";
                document.querySelector(".message_alert").innerHTML = "Message has been deleted."
            }
        }
    });
}

//replying inquiries
function replyFormInq(url){
    document.getElementById("View_inq_content").style.display = "none"
    var data = $("#ajax-form-replyingInquiries").serialize();
    $.ajax({
        type : 'POST',
        url  : url,
        data : data,
        beforeSend: function() {
            document.getElementById("loading_succes").style.display = "flex";
        },
        success :  function(response){
            if($.trim(response) === "Message sent!"){
                document.getElementById("loading_succes").style.display = "none";
                document.getElementById("sweetalert_container_inq").style.display="flex";
                document.querySelector(".message_alert").innerHTML = "Message has sent successfully."
            }
        }
    });
}



//delete check read
function delete_indivInqRead(key_indDel){
        document.getElementById("checkbox"+key_indDel).checked = true;
        document.getElementById("Delete_container").style.display = "flex"   
}
//archive check read
function archive_indivInqRead(key_indArc){
    document.getElementById("checkbox"+key_indArc).checked = true;
    document.getElementById("archive_container").style.display = "flex"   
}

//delete check unread
function delete_indivInqUnread(key_indDel){
    document.getElementById("checkboxU"+key_indDel).checked = true;
    document.getElementById("Delete_container").style.display = "flex"   
}
//archive check unread
function archive_indivInqUnread(key_indArc){
document.getElementById("checkboxU"+key_indArc).checked = true;
document.getElementById("archive_container").style.display = "flex"   
}

//delete check Archive
function delete_indivInqArchive(key_indDel){
    document.getElementById("checkboxA"+key_indDel).checked = true;
    document.getElementById("Delete_container").style.display = "flex"   
}
//archive check Archive
function archive_indivInqArchive(key_indArc){
    document.getElementById("checkboxA"+key_indArc).checked = true;
    document.getElementById("archive_container").style.display = "flex"   
}
//unarchive check Archive
function archive_indivInqUnarchive(key_indArc){
    document.getElementById("checkboxA"+key_indArc).checked = true;
    document.getElementById("unarchive_container").style.display = "flex"   
}

//close archive modal
function close_alert_archModal(){
    document.getElementById("sweetalert_container_inq").style.display="none";

    document.getElementById("Delete_container").style.display = "none"
    document.getElementById("archive_container").style.display = "none"
    document.getElementById("unarchive_container").style.display = "none"
    document.getElementById("View_inq_content").style.display = "none"
    
    $("#read_inquiry").load(location.href+" #read_inquiry>*","");
    $("#unread_inquiry").load(location.href+" #unread_inquiry>*","");
    $("#archive_inquiry").load(location.href+" #archive_inquiry>*","");

    $("#Inq_inbox_span").load(window.location + " #Inq_inbox_span");
    $("#Inq_unread_span").load(window.location + " #Inq_unread_span");
    $("#Inq_archive_span").load(window.location + " #Inq_archive_span");


    document.getElementById('checkbox_allRead').checked = false;
    document.getElementById('checkbox_allUnread').checked = false;
    document.getElementById('checkbox_allArchive').checked = false;
}

//close modals
window.onclick = function(event) {
    if (event.target == document.getElementById("View_inq_content")) {
        document.getElementById("View_inq_content").style.display = "none";
    }
    else if (event.target == document.getElementById("archive_container")) {
        document.getElementById("archive_container").style.display = "none";

        document.querySelectorAll('.checkbox_all_eachRead1').forEach(st => {
            st.checked = false;
        });
        document.querySelectorAll('.checkbox_all_eachUnread1').forEach(st => {
            st.checked = false;
        });
        document.querySelectorAll('.checkbox_all_EachArchive1').forEach(st => {
            st.checked = false;
        });
        document.querySelectorAll('.each_message').forEach(st => {
            st.style.backgroundColor = "#ffff";
        });  
        document.getElementById('checkbox_allRead').checked = false;
        document.getElementById('checkbox_allUnread').checked = false;
        document.getElementById('checkbox_allArchive').checked = false;
    }
    else if (event.target == document.getElementById("unarchive_container")) {
        document.getElementById("unarchive_container").style.display = "none";

        document.querySelectorAll('.checkbox_all_eachRead1').forEach(st => {
            st.checked = false;
        });
        document.querySelectorAll('.checkbox_all_eachUnread1').forEach(st => {
            st.checked = false;
        });
        document.querySelectorAll('.checkbox_all_EachArchive1').forEach(st => {
            st.checked = false;
        });
        document.querySelectorAll('.each_message').forEach(st => {
            st.style.backgroundColor = "#ffff";
        });  
        document.getElementById('checkbox_allRead').checked = false;
        document.getElementById('checkbox_allUnread').checked = false;
        document.getElementById('checkbox_allArchive').checked = false;
    }
    else if (event.target == document.getElementById("Delete_container")) {
        document.getElementById("Delete_container").style.display = "none";

        document.querySelectorAll('.checkbox_all_eachRead1').forEach(st => {
            st.checked = false;
        });
        document.querySelectorAll('.checkbox_all_eachUnread1').forEach(st => {
            st.checked = false;
        });
        document.querySelectorAll('.checkbox_all_EachArchive1').forEach(st => {
            st.checked = false;
        });
        document.querySelectorAll('.each_message').forEach(st => {
            st.style.backgroundColor = "#ffff";
        });  
        document.getElementById('checkbox_allRead').checked = false;
        document.getElementById('checkbox_allUnread').checked = false;
        document.getElementById('checkbox_allArchive').checked = false;     
    }
}



//reload animation
$(document).ready(function(){
    //clicking hamburger menu
    $("#reload_inq_content").click(function() {  
        
        $("#read_inquiry").load(location.href+" #read_inquiry>*","");
        $("#unread_inquiry").load(location.href+" #unread_inquiry>*","");
        $("#archive_inquiry").load(location.href+" #archive_inquiry>*","");   
        $("#Inq_inbox_span").load(window.location + " #Inq_inbox_span");
        $("#Inq_unread_span").load(window.location + " #Inq_unread_span");
        $("#Inq_archive_span").load(window.location + " #Inq_archive_span");
        
        $("#inquiry_content").css({
            display: "none",
        })
        $("#reload_animation").css({
            display: "block",
        })
        $("#reload_animation").animate({
            marginTop: "1%",
        },800)

        setTimeout(
            function() 
            {
                $("#reload_animation").animate({
                    marginTop: "50%",
                },800)
                $('#inquiry_content').delay(900).queue(function (next) { 
                $(this).css('display', 'block'); 
                next(); 
                });
                $('#reload_animation').delay(800).queue(function (next) { 
                    $(this).css('display', 'none'); 
                    next(); 
                    });
            }, 2000);
          
    
    });
});