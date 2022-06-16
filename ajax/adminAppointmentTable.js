//filter date accepted appointment table
function myFunctionAccept() {
  var table,tr, td, i, txtValue;
  var dateRangeVal = document.getElementById("span_edit_Accept").innerHTML;
  const myArray = dateRangeVal.split(" to ");

  var start = myArray[0]
  var end1 = myArray[1]


  table = document.getElementById("table_Accept");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[4];
    if (td) {
      txtValue = td.textContent || td.innerText;
      txtValue = txtValue.replace(/[/]/g,"-");
      test = txtValue.split("-")
      txtValue = test[2]+"-"+test[1]+"-"+test[0];
      if (txtValue >= start && txtValue <= end1) {
        tr[i].style.display = "";
        document.getElementById("no_dataVerifyer").style.display = "none"
      } else {
        tr[i].style.display = "none";
      }
    }       
  }

  var verifyer_patient = $('#table_Accept tr:visible').length
  if(verifyer_patient === 0) {
    document.getElementById("no_dataVerifyer").style.display = "flex"
  }
}

$(function() {

var start = moment().subtract(29, 'days');
var end = moment();

function cb(start, end) {
    $('.range_accept #span_edit_Accept').html(start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD')); 
}
        

$('.range_accept').daterangepicker({
    startDate: start,
    endDate: end,
    ranges: {
       'Today': [moment(), moment()],
       'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
       'Last 7 Days': [moment().subtract(6, 'days'), moment()],
       'Last 30 Days': [moment().subtract(29, 'days'), moment()],
       'This Month': [moment().startOf('month'), moment().endOf('month')],
       'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    }
}, cb);

$('.range_accept').on('apply.daterangepicker', (e, picker) => {
        myFunctionAccept();
});

});


//filter date pending appointment table
function myFunctionPending() {
    var table,tr, td, i, txtValue;
    var dateRangeVal = document.getElementById("span_edit_Pending").innerHTML;
    const myArray = dateRangeVal.split(" to ");  
    var start = myArray[0]
    var end1 = myArray[1]
  
    table = document.getElementById("table_pendingApp");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[4];
      if (td) {
        txtValue = td.textContent || td.innerText;
        txtValue = txtValue.replace(/[/]/g,"-");
        test = txtValue.split("-")     
        txtValue = test[2]+"-"+test[1]+"-"+test[0]; 
        if (txtValue >= start && txtValue <= end1) {
          tr[i].style.display = "";
          document.getElementById("no_dataVerifyer1").style.display = "none"
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  
    var verifyer_patient = $('#table_pendingApp tr:visible').length
    if(verifyer_patient === 0) {
      document.getElementById("no_dataVerifyer1").style.display = "flex"
    }
  }
  
  $(function() {
  
  var start = moment().subtract(29, 'days');
  var end = moment();
  
  function cb(start, end) {
      $('.range_pending #span_edit_Pending').html(start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD')); 
  }
          
  
  $('.range_pending').daterangepicker({
      startDate: start,
      endDate: end,
      ranges: {
         'Today': [moment(), moment()],
         'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
         'Last 7 Days': [moment().subtract(6, 'days'), moment()],
         'Last 30 Days': [moment().subtract(29, 'days'), moment()],
         'This Month': [moment().startOf('month'), moment().endOf('month')],
         'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      }
  }, cb);
  
  $('.range_pending').on('apply.daterangepicker', (e, picker) => {
          myFunctionPending();
  });
  
  });
  


//filter date history appointment table
function myFunctionHistory() {
    var table,tr, td, i, txtValue;
    var dateRangeVal = document.getElementById("span_edit_History").innerHTML;
    const myArray = dateRangeVal.split(" to ");  
    var start = myArray[0]
    var end1 = myArray[1]
  
    table = document.getElementById("table_History");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[4];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue >= start && txtValue <= end1) {
          tr[i].style.display = "";
          document.getElementById("no_dataVerifyer2").style.display = "none"
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  
    var verifyer_patient = $('#table_History tr:visible').length
    if(verifyer_patient === 0) {
      document.getElementById("no_dataVerifyer2").style.display = "flex"
    }
  }
  
  $(function() {
  
  var start = moment().subtract(29, 'days');
  var end = moment();
  
  function cb(start, end) {
      $('.range_history #span_edit_History').html(start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD')); 
  }
          
  
  $('.range_history').daterangepicker({
      startDate: start,
      endDate: end,
      ranges: {
         'Today': [moment(), moment()],
         'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
         'Last 7 Days': [moment().subtract(6, 'days'), moment()],
         'Last 30 Days': [moment().subtract(29, 'days'), moment()],
         'This Month': [moment().startOf('month'), moment().endOf('month')],
         'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      }
  }, cb);
  
  $('.range_history').on('apply.daterangepicker', (e, picker) => {
          myFunctionHistory();
  });
  
  });


  
//filter date archive appointment table
function myFunctionArchive() {
    var table,tr, td, i, txtValue;
    var dateRangeVal = document.getElementById("span_edit_Archive").innerHTML;
    const myArray = dateRangeVal.split(" to ");  
    var start = myArray[0]
    var end1 = myArray[1]
  
    table = document.getElementById("table_Archive");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[4];
      if (td) {
        txtValue = td.textContent || td.innerText;
        txtValue = txtValue.replace(/[/]/g,"-");
        test = txtValue.split("-")     
        txtValue = test[2]+"-"+test[1]+"-"+test[0]; 
        if (txtValue >= start && txtValue <= end1) {
          tr[i].style.display = "";
          document.getElementById("no_dataVerifyer3").style.display = "none"
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  
    var verifyer_patient = $('#table_Archive tr:visible').length
    if(verifyer_patient === 0) {
      document.getElementById("no_dataVerifyer3").style.display = "flex"
    }
  }
  
  $(function() {
  
  var start = moment().subtract(29, 'days');
  var end = moment();
  
  function cb(start, end) {
      $('.range_archive #span_edit_Archive').html(start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD')); 
  }
          
  
  $('.range_archive').daterangepicker({
      startDate: start,
      endDate: end,
      ranges: {
         'Today': [moment(), moment()],
         'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
         'Last 7 Days': [moment().subtract(6, 'days'), moment()],
         'Last 30 Days': [moment().subtract(29, 'days'), moment()],
         'This Month': [moment().startOf('month'), moment().endOf('month')],
         'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      }
  }, cb);
  
  $('.range_archive').on('apply.daterangepicker', (e, picker) => {
        myFunctionArchive();
  });
  
});
  
  

//filter search appointment list
var verifyer_patient = 0;
$(document).ready(function(){
  $("#search_table_Acceptedappointment").on("keyup", function() {

    var select_val = $("#filter_category option:selected" ).text();
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("search_table_Acceptedappointment");
    filter = input.value.toUpperCase();
    table = document.getElementById("table_Accept");
    tr = table.getElementsByTagName("tr");


  if(select_val === "All"){
    for (i = 0; i < tr.length; i++) {
      td0 = tr[i].getElementsByTagName("td")[0];
      td1 = tr[i].getElementsByTagName("td")[1];
      td2 = tr[i].getElementsByTagName("td")[2];
      td3 = tr[i].getElementsByTagName("td")[3];
      td4 = tr[i].getElementsByTagName("td")[4];
      td5 = tr[i].getElementsByTagName("td")[5];
      if (td0 || td1 || td2 || td3 || td4 || td5) {
        txtValue0 = td0.textContent || td0.innerText;
        txtValue1 = td1.textContent || td1.innerText;
        txtValue2 = td2.textContent || td2.innerText;
        txtValue3 = td3.textContent || td3.innerText;
        txtValue4 = td4.textContent || td4.innerText;
        txtValue5 = td5.textContent || td5.innerText;

        if (txtValue0.toUpperCase().indexOf(filter) > -1 || txtValue1.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1 || txtValue3.toUpperCase().indexOf(filter) > -1 || txtValue4.toUpperCase().indexOf(filter) > -1 || txtValue5.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          document.getElementById("no_dataVerifyer").style.display = "none"
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }
  else if(select_val === "Patient Name"){
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[0];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          document.getElementById("no_dataVerifyer").style.display = "none"
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }
  else if(select_val === "Address"){
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[1];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          document.getElementById("no_dataVerifyer").style.display = "none"
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }
  else if(select_val === "Email Address"){
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[2];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          document.getElementById("no_dataVerifyer").style.display = "none"
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }
  else if(select_val === "Phone Number"){
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[3];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          document.getElementById("no_dataVerifyer").style.display = "none"
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }
  else if(select_val === "Appointment Date"){
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[4];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          document.getElementById("no_dataVerifyer").style.display = "none"
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }
  else if(select_val === "Appointment Time"){
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[5];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          document.getElementById("no_dataVerifyer").style.display = "none"
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }
  
    var verifyer_patient = $('#table_Accept tr:visible').length
    var inplen = $("#search_table_Acceptedappointment").val();

    if(verifyer_patient === 0) {
      document.getElementById("no_dataVerifyer").style.display = "flex"
    }
    else if(inplen.length === 0){
      document.getElementById("no_dataVerifyer").style.display = "none"
    }
});
});


//filter search pending appointment
var verifyer_patient = 0;
$(document).ready(function(){
  $("#search_table_Pendingappointment").on("keyup", function() {

    var select_val = $("#filter_category option:selected" ).text();
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("search_table_Pendingappointment");
    filter = input.value.toUpperCase();
    table = document.getElementById("table_pendingApp");
    tr = table.getElementsByTagName("tr");


  if(select_val === "All"){
    for (i = 0; i < tr.length; i++) {
      td0 = tr[i].getElementsByTagName("td")[0];
      td1 = tr[i].getElementsByTagName("td")[1];
      td2 = tr[i].getElementsByTagName("td")[2];
      td3 = tr[i].getElementsByTagName("td")[3];
      td4 = tr[i].getElementsByTagName("td")[4];
      td5 = tr[i].getElementsByTagName("td")[5];
      if (td0 || td1 || td2 || td3 || td4 || td5) {
        txtValue0 = td0.textContent || td0.innerText;
        txtValue1 = td1.textContent || td1.innerText;
        txtValue2 = td2.textContent || td2.innerText;
        txtValue3 = td3.textContent || td3.innerText;
        txtValue4 = td4.textContent || td4.innerText;
        txtValue5 = td5.textContent || td5.innerText;

        if (txtValue0.toUpperCase().indexOf(filter) > -1 || txtValue1.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1 || txtValue3.toUpperCase().indexOf(filter) > -1 || txtValue4.toUpperCase().indexOf(filter) > -1 || txtValue5.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          document.getElementById("no_dataVerifyer1").style.display = "none"
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }
  else if(select_val === "Patient Name"){
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[0];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          document.getElementById("no_dataVerifyer1").style.display = "none"
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }
  else if(select_val === "Address"){
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[1];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          document.getElementById("no_dataVerifyer1").style.display = "none"
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }
  else if(select_val === "Email Address"){
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[2];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          document.getElementById("no_dataVerifyer1").style.display = "none"
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }
  else if(select_val === "Phone Number"){
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[3];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          document.getElementById("no_dataVerifyer1").style.display = "none"
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }
  else if(select_val === "Appointment Date"){
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[4];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          document.getElementById("no_dataVerifyer1").style.display = "none"
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }
  else if(select_val === "Appointment Time"){
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[5];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          document.getElementById("no_dataVerifyer1").style.display = "none"
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }
  
    var verifyer_patient = $('#table_pendingApp tr:visible').length
    var inplen = $("#search_table_Pendingappointment").val();

    if(verifyer_patient === 0) {
      document.getElementById("no_dataVerifyer1").style.display = "flex"
    }
    else if(inplen.length === 0){
      document.getElementById("no_dataVerifyer1").style.display = "none"
    }
});
});


//filter search history appointment
var verifyer_patient = 0;
$(document).ready(function(){
  $("#search_table_Historyappointment").on("keyup", function() {

    var select_val = $("#filter_category1 option:selected" ).text();
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("search_table_Historyappointment");
    filter = input.value.toUpperCase();
    table = document.getElementById("table_History");
    tr = table.getElementsByTagName("tr");


  if(select_val === "All"){
    for (i = 0; i < tr.length; i++) {
      td0 = tr[i].getElementsByTagName("td")[0];
      td1 = tr[i].getElementsByTagName("td")[1];
      td2 = tr[i].getElementsByTagName("td")[2];
      td3 = tr[i].getElementsByTagName("td")[3];
      td4 = tr[i].getElementsByTagName("td")[4];
      if (td0 || td1 || td2 || td3 || td4 ) {
        txtValue0 = td0.textContent || td0.innerText;
        txtValue1 = td1.textContent || td1.innerText;
        txtValue2 = td2.textContent || td2.innerText;
        txtValue3 = td3.textContent || td3.innerText;
        txtValue4 = td4.textContent || td4.innerText;

        if (txtValue0.toUpperCase().indexOf(filter) > -1 || txtValue1.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1 || txtValue3.toUpperCase().indexOf(filter) > -1 || txtValue4.toUpperCase().indexOf(filter) > -1 ) {
          tr[i].style.display = "";
          document.getElementById("no_dataVerifyer2").style.display = "none"
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }
  else if(select_val === "Appointment#"){
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[0];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          document.getElementById("no_dataVerifyer2").style.display = "none"
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }
  else if(select_val === "Patient Name"){
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[1];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          document.getElementById("no_dataVerifyer2").style.display = "none"
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }
  else if(select_val === "Doctors Duty"){
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[2];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          document.getElementById("no_dataVerifyer2").style.display = "none"
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }
  else if(select_val === "Midwifes Duty"){
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[3];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          document.getElementById("no_dataVerifyer2").style.display = "none"
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }
  else if(select_val === "Date"){
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[4];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          document.getElementById("no_dataVerifyer2").style.display = "none"
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }

  
    var verifyer_patient = $('#table_History tr:visible').length
    var inplen = $("#search_table_Historyappointment").val();

    if(verifyer_patient === 0) {
      document.getElementById("no_dataVerifyer2").style.display = "flex"
    }
    else if(inplen.length === 0){
      document.getElementById("no_dataVerifyer2").style.display = "none"
    }
});
});


//filter search archive appointment
var verifyer_patient = 0;
$(document).ready(function(){
  $("#search_table_Archiveappointment").on("keyup", function() {

    var select_val = $("#filter_category option:selected" ).text();
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("search_table_Archiveappointment");
    filter = input.value.toUpperCase();
    table = document.getElementById("table_Archive");
    tr = table.getElementsByTagName("tr");


  if(select_val === "All"){
    for (i = 0; i < tr.length; i++) {
      td0 = tr[i].getElementsByTagName("td")[0];
      td1 = tr[i].getElementsByTagName("td")[1];
      td2 = tr[i].getElementsByTagName("td")[2];
      td3 = tr[i].getElementsByTagName("td")[3];
      td4 = tr[i].getElementsByTagName("td")[4];
      td5 = tr[i].getElementsByTagName("td")[5];
      if (td0 || td1 || td2 || td3 || td4 || td5) {
        txtValue0 = td0.textContent || td0.innerText;
        txtValue1 = td1.textContent || td1.innerText;
        txtValue2 = td2.textContent || td2.innerText;
        txtValue3 = td3.textContent || td3.innerText;
        txtValue4 = td4.textContent || td4.innerText;
        txtValue5 = td5.textContent || td5.innerText;

        if (txtValue0.toUpperCase().indexOf(filter) > -1 || txtValue1.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1 || txtValue3.toUpperCase().indexOf(filter) > -1 || txtValue4.toUpperCase().indexOf(filter) > -1 || txtValue5.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          document.getElementById("no_dataVerifyer3").style.display = "none"
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }
  else if(select_val === "Patient Name"){
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[0];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          document.getElementById("no_dataVerifyer3").style.display = "none"
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }
  else if(select_val === "Address"){
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[1];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          document.getElementById("no_dataVerifyer3").style.display = "none"
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }
  else if(select_val === "Email Address"){
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[2];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          document.getElementById("no_dataVerifyer3").style.display = "none"
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }
  else if(select_val === "Phone Number"){
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[3];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          document.getElementById("no_dataVerifyer3").style.display = "none"
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }
  else if(select_val === "Appointment Date"){
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[4];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          document.getElementById("no_dataVerifyer3").style.display = "none"
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }
  else if(select_val === "Appointment Time"){
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[5];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          document.getElementById("no_dataVerifyer3").style.display = "none"
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }
  
    var verifyer_patient = $('#table_Archive tr:visible').length
    var inplen = $("#search_table_Archiveappointment").val();

    if(verifyer_patient === 0) {
      document.getElementById("no_dataVerifyer3").style.display = "flex"
    }
    else if(inplen.length === 0){
      document.getElementById("no_dataVerifyer3").style.display = "none"
    }
});
});



//showing reasons reject container
function reject_pendtingApp_tb(fullname, email, contact, dates, time,id){
      document.getElementById("reject_container").style.display = "flex";
      document.getElementById("reason_name").innerHTML = fullname;
      document.getElementById("reason_email").innerHTML = email;
      document.getElementById("reason_contact").innerHTML = contact;
      document.getElementById("reasons_reject").value = "Upon reviewing your scheduled appointment were sorry to inform you that your appointment has been rejected due to";


      
      var date = new Date();
      document.getElementById("reason_date").innerHTML = date.toLocaleDateString();
      document.getElementById("reason_time").innerHTML =date.toLocaleTimeString([], {timeStyle: 'short'});

      document.getElementById("reason_date_inp").value = dates;
      document.getElementById("reason_time_inp").value = time;
      document.getElementById("reason_email_inp").value = email;
      document.getElementById("reason_id_inp").value = id;
      document.getElementById("reason_name_inp").value = fullname;
}

//close reason reject container  function reject_pendtingApp_tb(fullname, email, contact, date, time){
function close_reject_pendtingApp_tb(){
        document.getElementById("reject_container").style.display = "none";
        document.getElementById("reasons_reject").value = "";
}




//ajax for rejecting in admin appointment pending table
$(document).ready(function($){
    // on submit...
    $('#ajax-form_admin_rejectAppoint').submit(function(e){
    e.preventDefault();
    
    var question = $("textarea#reasons_reject").val();
    
    if (question=== "" || question === "Upon reviewing your scheduled appointment were sorry to inform you that your appointment has been rejected due to"){
        document.getElementById("reason_validation").style.visibility = "visible";
        return false;
    }
        
    // ajax
    $.ajax({
        type:"POST",
        url: 'z-Ajax-AdminRejectAppointment.php',
        data: $(this).serialize(), // get all form field value in serialize form
        beforeSend: function() {
            document.getElementById("loading_succes").style.display = "flex";
        },
        success: function(response){
          document.getElementById("loading_succes").style.display = "none";
          $("#newvalidation_Appointment").css({
            display: "flex",
            borderLeft: "10px solid #93C1F9",
            })
            //animation for edit profile
            $("#newvalidation_Appointment").animate({
                right: "2.5%",
            },500)      

            $("#text_validationHeader").text('Success!');
            $("#text_validationHeader").css({color: "#93C1F9"})
            $("#newclose_validationAppoinment").css({color: "#93C1F9"})
            $("#text_validationContent").text('This appointment is succuesfully rejected!');
            $("#validationAppointment_img").attr("src","images/gif/succes.gif");

            setTimeout(function(){
                //animation for edit profile
                $("#newvalidation_Appointment").animate({
                    right: "-56%",
                },500)    
            }, 5000);

          $("#table_pendingApp").load(" #table_pendingApp > *");
          $("#table_Accept").load(" #table_Accept > *"); 
          $("#appointment_pending").load(" #appointment_pending");

          document.getElementById("reasons_reject").value = "";
          document.getElementById("appointment_pending").style.boxShadow = "rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px"
          document.getElementById("appointment_pending").style.backgroundColor = "rgb(248, 248, 248)"
          document.getElementById("appointment_accept").style.boxShadow = "0px 0px 0px 0px"
          document.getElementById("appointment_accept").style.backgroundColor = "transparent"
        }
});
});  
return false;
});

//remove reason validation
function remove_reasonVal(){
    document.getElementById("reason_validation").style.visibility = "hidden";
}




//showing accept appoint container
function accept_pendtingApp_tb(fname, mname, lname, address, email, contact, date, time, id,service){
    document.getElementById("accept_container").style.display = "flex";

    document.getElementById("accept_fname").value = fname;
    document.getElementById("accept_mname").value = mname;
    document.getElementById("accept_lname").value = lname;
    document.getElementById("accept_address").value = address;
    document.getElementById("accept_email").value = email;
    document.getElementById("accept_phone").value = contact;
    document.getElementById("accept_date").value = date;
    document.getElementById("accept_time").value = time;
    document.getElementById("accept_id").value = id;
    document.getElementById("accept_service").value = service;

}

//close accept appoint container
function close_accept_pendtingApp_tb(){
  document.getElementById("accept_container").style.display = "none";
}




//ajax for accepting in admin appointment pending table
$(document).ready(function($){
  // on submit...
  $('#ajax-form_admin_acceptAppoint').submit(function(e){
  e.preventDefault();
  
  // ajax
  $.ajax({
      type:"POST",
      url: 'z-Ajax-AdminAcceptAppointment.php',
      data: $(this).serialize(), // get all form field value in serialize form
      beforeSend: function() {
        document.getElementById("loading_succes").style.display = "flex";
      },
      success: function(){
        document.getElementById("loading_succes").style.display = "none";
        $("#newvalidation_Appointment").css({
          display: "flex",
          borderLeft: "10px solid #93C1F9",
          })
          //animation for edit profile
          $("#newvalidation_Appointment").animate({
              right: "2.5%",
          },500)      

          $("#text_validationHeader").text('Success!');
          $("#text_validationHeader").css({color: "#93C1F9"})
          $("#newclose_validationAppoinment").css({color: "#93C1F9"})
          $("#text_validationContent").text('This appointment is succuesfully accepted!');
          $("#validationAppointment_img").attr("src","images/gif/succes.gif");

          setTimeout(function(){
              //animation for edit profile
              $("#newvalidation_Appointment").animate({
                  right: "-56%",
              },500)    
          }, 5000);

          $("#table_pendingApp").load(" #table_pendingApp > *");
          $("#table_Accept").load(" #table_Accept > *"); 

          $("#appointment_pending").load(" #appointment_pending");
          $("#acceptAppoint_span").load(" #acceptAppoint_span");
          
      }
});
});  
return false;
});


function appointment_table_show(){
    document.querySelector('.range_accept').style.display = "flex";
    document.querySelector('.range_pending').style.display = "none";
    document.querySelector('.range_history').style.display = "none";
    document.querySelector('.range_archive').style.display = "none";
    document.getElementById("span_edit_Accept").innerHTML = "Click to filter by date range";
    document.getElementById("span_edit_Pending").innerHTML = "Click to filter by date range";
    document.getElementById("span_edit_History").innerHTML = "Click to filter by date range";
    document.getElementById("span_edit_Archive").innerHTML = "Click to filter by date range";
    document.querySelector('.export_pdf_Accept').style.display = "flex";
    document.querySelector('.export_pdf_Pending').style.display = "none";
    document.querySelector('.export_pdf_History').style.display = "none";
    document.querySelector('.export_pdf_Archive').style.display = "none";
    document.getElementById("filter_category").style.display = "block";
    document.getElementById("filter_category1").style.display = "none";
    
    $("#table_pendingApp").load(" #table_pendingApp > *");
    $("#table_Accept").load(" #table_Accept > *"); 
    $("#table_History").load(" #table_History > *"); 
    $("#table_Archive").load(" #table_Archive > *"); 
    $("#appointment_pending").load(" #appointment_pending");
    $("#acceptAppoint_span").load(" #acceptAppoint_span");
    document.getElementById("no_dataVerifyer").style.display = "none"
    document.getElementById("no_dataVerifyer1").style.display = "none"
    document.getElementById("no_dataVerifyer2").style.display = "none"
    document.getElementById("no_dataVerifyer3").style.display = "none"
    document.getElementById("search_table_Acceptedappointment").value = "";
    document.getElementById("search_table_Pendingappointment").value = "";
    document.getElementById("search_table_Historyappointment").value = "";
    document.getElementById("search_table_Archiveappointment").value = "";
    document.getElementById("table_accepted_appointment").style.display = "block"
    document.getElementById("table_pending_appointment").style.display = "none"
    document.getElementById("table_history_appointment").style.display = "none"
    document.getElementById("table_archive_appointment").style.display = "none"
    document.getElementById("appointment_accept").style.boxShadow = "rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px"
    document.getElementById("appointment_accept").style.backgroundColor = "rgb(248, 248, 248)"
    document.getElementById("appointment_pending").style.boxShadow = "0px 0px 0px 0px"
    document.getElementById("appointment_pending").style.backgroundColor = "transparent"
    document.getElementById("appointment_history").style.boxShadow = "0px 0px 0px 0px"
    document.getElementById("appointment_history").style.backgroundColor = "transparent"
    document.getElementById("appointment_archive").style.boxShadow = "0px 0px 0px 0px"
    document.getElementById("appointment_archive").style.backgroundColor = "transparent"
    document.querySelector(".downloadxlsx_history").style.display = "none";
    document.querySelector(".downloadxlsx_Accepted").style.display = "flex";
    document.querySelector(".downloadxlsx_Pending").style.display = "none";
    document.querySelector(".downloadxlsx_archive").style.display = "none";
    document.querySelector("#search_table_Pendingappointment").style.display = "none";
    document.querySelector("#search_table_Acceptedappointment").style.display = "block";
    document.querySelector("#search_table_Historyappointment").style.display = "none";
    document.querySelector("#search_table_Archiveappointment").style.display = "none";
    $("#left_top_dashboard_content").load(" #left_top_dashboard_content > *");

    var table = document.getElementById("table_Accept");
    var totalRowCount = table.rows.length; 
    if(totalRowCount === 1){          
        document.getElementById("no_dataVerifyer").innerHTML ='<img src="images/icons/dashboard/no_data_found.png" alt=""> Record is empty'         
        document.getElementById("no_dataVerifyer").style.display = "flex"
    }
}

function pending_table_show(){
    document.querySelector('.range_accept').style.display = "none";
    document.querySelector('.range_pending').style.display = "flex";
    document.querySelector('.range_history').style.display = "none";
    document.querySelector('.range_archive').style.display = "none";
    document.getElementById("span_edit_Accept").innerHTML = "Click to filter by date range";
    document.getElementById("span_edit_Pending").innerHTML = "Click to filter by date range";
    document.getElementById("span_edit_History").innerHTML = "Click to filter by date range";
    document.getElementById("span_edit_Archive").innerHTML = "Click to filter by date range";
    document.querySelector('.export_pdf_Pending').style.display = "flex";
    document.querySelector('.export_pdf_Accept').style.display = "none";
    document.querySelector('.export_pdf_History').style.display = "none";
    document.querySelector('.export_pdf_Archive').style.display = "none";
    document.getElementById("filter_category").style.display = "block";
    document.getElementById("filter_category1").style.display = "none";

    $("#table_pendingApp").load(" #table_pendingApp > *");
    $("#table_Accept").load(" #table_Accept > *"); 
    $("#table_History").load(" #table_History > *"); 
    $("#table_Archive").load(" #table_Archive > *"); 
    $("#appointment_pending").load(" #appointment_pending");
    $("#acceptAppoint_span").load(" #acceptAppoint_span");
    document.getElementById("no_dataVerifyer").style.display = "none"
    document.getElementById("no_dataVerifyer1").style.display = "none"
    document.getElementById("no_dataVerifyer2").style.display = "none"
    document.getElementById("no_dataVerifyer3").style.display = "none"
    document.getElementById("search_table_Acceptedappointment").value = "";
    document.getElementById("search_table_Pendingappointment").value = "";
    document.getElementById("search_table_Historyappointment").value = "";
    document.getElementById("search_table_Archiveappointment").value = "";
    document.getElementById("table_pending_appointment").style.display = "block"
    document.getElementById("table_accepted_appointment").style.display = "none"
    document.getElementById("table_history_appointment").style.display = "none"
    document.getElementById("table_archive_appointment").style.display = "none"
    document.getElementById("appointment_pending").style.boxShadow = "rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px"
    document.getElementById("appointment_pending").style.backgroundColor = "rgb(248, 248, 248)"
    document.getElementById("appointment_accept").style.boxShadow = "0px 0px 0px 0px"
    document.getElementById("appointment_accept").style.backgroundColor = "transparent"
    document.getElementById("appointment_history").style.boxShadow = "0px 0px 0px 0px"
    document.getElementById("appointment_history").style.backgroundColor = "transparent"
    document.getElementById("appointment_archive").style.boxShadow = "0px 0px 0px 0px"
    document.getElementById("appointment_archive").style.backgroundColor = "transparent"
    document.querySelector(".downloadxlsx_history").style.display = "none";
    document.querySelector(".downloadxlsx_Accepted").style.display = "none";
    document.querySelector(".downloadxlsx_Pending").style.display = "flex";
    document.querySelector(".downloadxlsx_archive").style.display = "none";
    document.querySelector("#search_table_Historyappointment").style.display = "none";
    document.querySelector("#search_table_Pendingappointment").style.display = "block";
    document.querySelector("#search_table_Acceptedappointment").style.display = "none";
    document.querySelector("#search_table_Archiveappointment").style.display = "none";
    var table = document.getElementById("table_pendingApp");
    var totalRowCount = table.rows.length; 
    if(totalRowCount === 1){          
        document.getElementById("no_dataVerifyer1").innerHTML ='<img src="images/icons/dashboard/no_data_found.png" alt=""> Record is empty'         
        document.getElementById("no_dataVerifyer1").style.display = "flex"
    }
}


function history_table_show(){
    document.querySelector('.range_history').style.display = "flex";
    document.querySelector('.range_accept').style.display = "none";
    document.querySelector('.range_pending').style.display = "none";
    document.querySelector('.range_archive').style.display = "none";
    document.getElementById("span_edit_Accept").innerHTML = "Click to filter by date range";
    document.getElementById("span_edit_Pending").innerHTML = "Click to filter by date range";
    document.getElementById("span_edit_History").innerHTML = "Click to filter by date range";
    document.getElementById("span_edit_Archive").innerHTML = "Click to filter by date range";
    document.querySelector('.export_pdf_Accept').style.display = "none";
    document.querySelector('.export_pdf_Pending').style.display = "none";
    document.querySelector('.export_pdf_History').style.display = "flex";
    document.querySelector('.export_pdf_Archive').style.display = "none";
    document.getElementById("filter_category").style.display = "none";
    document.getElementById("filter_category1").style.display = "block";

    $("#table_pendingApp").load(" #table_pendingApp > *");
    $("#table_Accept").load(" #table_Accept > *"); 
    $("#table_History").load(" #table_History > *");
    $("#table_Archive").load(" #table_Archive > *");  
    $("#appointment_pending").load(" #appointment_pending");
    $("#acceptAppoint_span").load(" #acceptAppoint_span");

    document.getElementById("no_dataVerifyer").style.display = "none"
    document.getElementById("no_dataVerifyer1").style.display = "none"
    document.getElementById("no_dataVerifyer2").style.display = "none"
    document.getElementById("no_dataVerifyer3").style.display = "none"
    document.getElementById("search_table_Acceptedappointment").value = "";
    document.getElementById("search_table_Pendingappointment").value = "";
    document.getElementById("search_table_Historyappointment").value = "";
    document.getElementById("search_table_Archiveappointment").value = "";
    document.getElementById("table_history_appointment").style.display = "block"
    document.getElementById("table_accepted_appointment").style.display = "none"
    document.getElementById("table_pending_appointment").style.display = "none"
    document.getElementById("table_archive_appointment").style.display = "none"
    document.getElementById("appointment_history").style.boxShadow = "rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px";
    document.getElementById("appointment_history").style.backgroundColor = "rgb(248, 248, 248)";
    document.getElementById("appointment_accept").style.boxShadow = "0px 0px 0px 0px"
    document.getElementById("appointment_accept").style.backgroundColor = "transparent"
    document.getElementById("appointment_pending").style.boxShadow = "0px 0px 0px 0px"
    document.getElementById("appointment_pending").style.backgroundColor = "transparent"
    document.getElementById("appointment_archive").style.boxShadow = "0px 0px 0px 0px"
    document.getElementById("appointment_archive").style.backgroundColor = "transparent"
    document.querySelector(".downloadxlsx_history").style.display = "flex";
    document.querySelector(".downloadxlsx_Accepted").style.display = "none";
    document.querySelector(".downloadxlsx_Pending").style.display = "none";
    document.querySelector(".downloadxlsx_archive").style.display = "none";
    document.querySelector("#search_table_Historyappointment").style.display = "block";
    document.querySelector("#search_table_Pendingappointment").style.display = "none";
    document.querySelector("#search_table_Acceptedappointment").style.display = "none";
    document.querySelector("#search_table_Archiveappointment").style.display = "none";
    var table = document.getElementById("table_History");
    var totalRowCount = table.rows.length; 
    if(totalRowCount === 1){          
        document.getElementById("no_dataVerifyer2").innerHTML ='<img src="images/icons/dashboard/no_data_found.png" alt=""> Record is empty'         
        document.getElementById("no_dataVerifyer2").style.display = "flex"
    }
}


function archive_table_show(){
    document.querySelector('.range_archive').style.display = "flex";
    document.querySelector('.range_accept').style.display = "none";
    document.querySelector('.range_pending').style.display = "none";
    document.querySelector('.range_history').style.display = "none";
    document.getElementById("span_edit_Accept").innerHTML = "Click to filter by date range";
    document.getElementById("span_edit_Pending").innerHTML = "Click to filter by date range";
    document.getElementById("span_edit_History").innerHTML = "Click to filter by date range";
    document.getElementById("span_edit_Archive").innerHTML = "Click to filter by date range";
    document.querySelector('.export_pdf_Archive').style.display = "flex";
    document.querySelector('.export_pdf_Accept').style.display = "none";
    document.querySelector('.export_pdf_Pending').style.display = "none";
    document.querySelector('.export_pdf_History').style.display = "none";
    document.getElementById("filter_category").style.display = "block";
    document.getElementById("filter_category1").style.display = "none";

    $("#table_pendingApp").load(" #table_pendingApp > *");
    $("#table_Accept").load(" #table_Accept > *"); 
    $("#table_History").load(" #table_History > *"); 
    $("#table_Archive").load(" #table_Archive > *"); 
    
    $("#appointment_pending").load(" #appointment_pending");
    $("#acceptAppoint_span").load(" #acceptAppoint_span");

    document.getElementById("no_dataVerifyer").style.display = "none"
    document.getElementById("no_dataVerifyer1").style.display = "none"
    document.getElementById("no_dataVerifyer2").style.display = "none"
    document.getElementById("no_dataVerifyer3").style.display = "none"
    document.getElementById("search_table_Acceptedappointment").value = "";
    document.getElementById("search_table_Pendingappointment").value = "";
    document.getElementById("search_table_Historyappointment").value = "";
    document.getElementById("search_table_Archiveappointment").value = "";
    document.getElementById("table_history_appointment").style.display = "none"
    document.getElementById("table_accepted_appointment").style.display = "none"
    document.getElementById("table_pending_appointment").style.display = "none"
    document.getElementById("table_archive_appointment").style.display = "block"

    document.getElementById("appointment_archive").style.boxShadow = "rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px";
    document.getElementById("appointment_archive").style.backgroundColor = "rgb(248, 248, 248)";
    document.getElementById("appointment_history").style.boxShadow = "0px 0px 0px 0px"
    document.getElementById("appointment_history").style.backgroundColor = "transparent"
    document.getElementById("appointment_accept").style.boxShadow = "0px 0px 0px 0px"
    document.getElementById("appointment_accept").style.backgroundColor = "transparent"
    document.getElementById("appointment_pending").style.boxShadow = "0px 0px 0px 0px"
     document.getElementById("appointment_pending").style.backgroundColor = "transparent"
    document.querySelector(".downloadxlsx_history").style.display = "none";
    document.querySelector(".downloadxlsx_Accepted").style.display = "none";
    document.querySelector(".downloadxlsx_Pending").style.display = "none";
    document.querySelector(".downloadxlsx_archive").style.display = "flex";
    document.querySelector("#search_table_Historyappointment").style.display = "none";
    document.querySelector("#search_table_Pendingappointment").style.display = "none";
    document.querySelector("#search_table_Acceptedappointment").style.display = "none";
    document.querySelector("#search_table_Archiveappointment").style.display = "block";
    var table = document.getElementById("table_Archive");
    var totalRowCount = table.rows.length; 
    if(totalRowCount === 1){          
        document.getElementById("no_dataVerifyer3").innerHTML ='<img src="images/icons/dashboard/no_data_found.png" alt=""> Record is empty'         
        document.getElementById("no_dataVerifyer3").style.display = "flex"
    }
}



//ajax for removing appointment in admin appointment accepted table
$(document).ready(function($){
    // on submit...
    $('#ajax-form_admin_RemoveAppoint').submit(function(e){
    e.preventDefault();
    
    // ajax
    $.ajax({
        type:"POST",
        url: 'z-Ajax-AdminRemoveAppointment.php',
        data: $(this).serialize(), // get all form field value in serialize form
        success: function(response){
            $("#table_pendingApp").load(" #table_pendingApp > *");
            $("#table_Accept").load(" #table_Accept > *"); 
  
            $("#appointment_pending").load(" #appointment_pending");
            $("#acceptAppoint_span").load(" #acceptAppoint_span");
            document.getElementById("remove_container").style.display = "none";
            document.getElementById("key_removeApp").value = ""
        }
});
});  
return false;
});


//close sweet alert
function close_alertAppoint(){
    $("#newvalidation_Appointment").animate({
        right: "-56%",
    },500)     
}