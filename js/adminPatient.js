//show sort container
function show_sort(){
  document.getElementById("sort").style.display = "block"
}

function check_sortPatient(val){
    document.querySelectorAll('.check_img').forEach(st => {
        st.style.display="none";
      });
      document.querySelectorAll('.check_img1').forEach(st => {
        st.style.display="none";
      });
    document.getElementById(val).style.display = "block";
    document.getElementById("sort_value").value = val;
}

function check_sortPatient1(val){
  document.querySelectorAll('.check_img1').forEach(st => {
      st.style.display="none";
    });
  document.getElementById("sort").style.display = "none"
  document.getElementById(val).style.display = "block";
}

function sortTableAsc() {

  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("table_patientInfo");

  if(document.getElementById("sort_value").value == "check_fname"){
        switching = true;
        while (switching) {
          switching = false;
          rows = table.rows;
          for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("TD")[2];
            y = rows[i + 1].getElementsByTagName("TD")[2];
            if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
              shouldSwitch = true;
              break;
            }
          }
          if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
          }
        }
  }
  else if(document.getElementById("sort_value").value == "check_id"){
        switching = true;
        while (switching) {
          switching = false;
          rows = table.rows;
          for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("TD")[0];
            y = rows[i + 1].getElementsByTagName("TD")[0];
            if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
              shouldSwitch = true;
              break;
            }
          }
          if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
          }
        }
  }
  else if(document.getElementById("sort_value").value == "check_lname"){
    switching = true;
    while (switching) {
      switching = false;
      rows = table.rows;
      for (i = 1; i < (rows.length - 1); i++) {
        shouldSwitch = false;
        x = rows[i].getElementsByTagName("TD")[1];
        y = rows[i + 1].getElementsByTagName("TD")[1];
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          shouldSwitch = true;
          break;
        }
      }
      if (shouldSwitch) {
        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
        switching = true;
      }
    }
  }
  else if(document.getElementById("sort_value").value == "check_address"){
    switching = true;
    while (switching) {
      switching = false;
      rows = table.rows;
      for (i = 1; i < (rows.length - 1); i++) {
        shouldSwitch = false;
        x = rows[i].getElementsByTagName("TD")[5];
        y = rows[i + 1].getElementsByTagName("TD")[5];
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          shouldSwitch = true;
          break;
        }
      }
      if (shouldSwitch) {
        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
        switching = true;
      }
    }
  }
  else if(document.getElementById("sort_value").value == "check_bday"){
    switching = true;
    while (switching) {
      switching = false;
      rows = table.rows;
      for (i = 1; i < (rows.length - 1); i++) {
        shouldSwitch = false;
        x = rows[i].getElementsByTagName("TD")[4];
        y = rows[i + 1].getElementsByTagName("TD")[4];
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          shouldSwitch = true;
          break;
        }
      }
      if (shouldSwitch) {
        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
        switching = true;
      }
    }
  }
}


function sortTableDesc() {

  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("table_patientInfo");

  if(document.getElementById("sort_value").value == "check_fname"){
        switching = true;
        while (switching) {
          switching = false;
          rows = table.rows;
          for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("TD")[2];
            y = rows[i + 1].getElementsByTagName("TD")[2];
            if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
              shouldSwitch = true;
              break;
            }
          }
          if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
          }
        }
  }
  else if(document.getElementById("sort_value").value == "check_id"){
        switching = true;
        while (switching) {
          switching = false;
          rows = table.rows;
          for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("TD")[0];
            y = rows[i + 1].getElementsByTagName("TD")[0];
            if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
              shouldSwitch = true;
              break;
            }
          }
          if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
          }
        }
  }
  else if(document.getElementById("sort_value").value == "check_lname"){
    switching = true;
    while (switching) {
      switching = false;
      rows = table.rows;
      for (i = 1; i < (rows.length - 1); i++) {
        shouldSwitch = false;
        x = rows[i].getElementsByTagName("TD")[1];
        y = rows[i + 1].getElementsByTagName("TD")[1];
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          shouldSwitch = true;
          break;
        }
      }
      if (shouldSwitch) {
        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
        switching = true;
      }
    }
  }
  else if(document.getElementById("sort_value").value == "check_address"){
    switching = true;
    while (switching) {
      switching = false;
      rows = table.rows;
      for (i = 1; i < (rows.length - 1); i++) {
        shouldSwitch = false;
        x = rows[i].getElementsByTagName("TD")[5];
        y = rows[i + 1].getElementsByTagName("TD")[5];
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          shouldSwitch = true;
          break;
        }
      }
      if (shouldSwitch) {
        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
        switching = true;
      }
    }
  }
  else if(document.getElementById("sort_value").value == "check_bday"){
    switching = true;
    while (switching) {
      switching = false;
      rows = table.rows;
      for (i = 1; i < (rows.length - 1); i++) {
        shouldSwitch = false;
        x = rows[i].getElementsByTagName("TD")[4];
        y = rows[i + 1].getElementsByTagName("TD")[4];
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          shouldSwitch = true;
          break;
        }
      }
      if (shouldSwitch) {
        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
        switching = true;
      }
    }
  }
}


//filter search
var verifyer_patient = 0;
$(document).ready(function(){
  $("#search_patientInfo").on("keyup", function() {

    var select_val = $("#filter_category option:selected" ).text();
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("search_patientInfo");
    filter = input.value.toUpperCase();
    table = document.getElementById("table_patientInfo");
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
          document.getElementById("table_patientInfo").style.opacity = "100%"
          document.getElementById("no_dataVerifyer").style.display = "none"
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }
  else if(select_val === "Patient ID"){
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[0];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          document.getElementById("table_patientInfo").style.opacity = "100%"
          document.getElementById("no_dataVerifyer").style.display = "none"
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }
  else if(select_val === "Last Name"){
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[1];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          document.getElementById("table_patientInfo").style.opacity = "100%"
          document.getElementById("no_dataVerifyer").style.display = "none"
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }
  else if(select_val === "First Name"){
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[2];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          document.getElementById("table_patientInfo").style.opacity = "100%"
          document.getElementById("no_dataVerifyer").style.display = "none"
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }
  else if(select_val === "Middle Name"){
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[3];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          document.getElementById("table_patientInfo").style.opacity = "100%"
          document.getElementById("no_dataVerifyer").style.display = "none"
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }
  else if(select_val === "Date Added"){
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[4];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          document.getElementById("table_patientInfo").style.opacity = "100%"
          document.getElementById("no_dataVerifyer").style.display = "none"
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }
  else if(select_val === "Address"){
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[5];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          document.getElementById("table_patientInfo").style.opacity = "100%"
          document.getElementById("no_dataVerifyer").style.display = "none"
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }
  
    var verifyer_patient = $('#table_patientInfo tr:visible').length
    var inplen = $("#search_patientInfo").val();

    if(verifyer_patient === 0) {
      document.getElementById("no_dataVerifyer").style.display = "flex"
      document.getElementById("table_patientInfo").style.opacity = "0%"
    }
    else if(inplen.length === 0){
      document.getElementById("table_patientInfo").style.opacity = "100%"
      document.getElementById("no_dataVerifyer").style.display = "none"
    }

});

$(".viewPatientContainer").animate({
    marginLeft: "0%",
  },800); 

});

//back btn in view patient
function goBackViewPatient(){
  window.history.back();
}






