function add_medstock_input2(){
    var x = document.getElementsByClassName("var_totalmed_stock_act_med")[0].innerHTML
    x++;
    if(x<=50){
        document.getElementsByClassName("var_totalmed_stock_act_med")[0].innerHTML = x;
        document.getElementById("med_stock_act").value = x;
    }
}

function decrease_medstock_input2(){
    var x = document.getElementsByClassName("var_totalmed_stock_act_med")[0].innerHTML
    if(x>1){
        x--;
        document.getElementsByClassName("var_totalmed_stock_act_med")[0].innerHTML = x;
        document.getElementById("med_stock_act").value = x;
    }
}

function close_actMed_modal(){
    document.getElementById("Activemed_background").style.display="none"
}


//filter search
$(document).ready(function(){
     //filter search
     var verifyer_emp = 0;
     $("#search_medInfo").on("keyup", function() {
         var searchEmp_l = $("#search_medInfo").val();
         var value = $(this).val().toLowerCase();
         $(".table_med_search tr").filter(function() {
             $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
         });
 
         if($('.table_med_search tr:visible').length === 0) {
             verifyer_emp = 0;
         }
         else if($('.table_med_search tr:visible').length != 0){
             verifyer_emp = 1;
         }
 
 
         if(searchEmp_l.length === 0){
             document.getElementById("no_dataVerifyer").style.display = "none"
             document.querySelectorAll('.dropright').forEach(st => {
                st.style.display="flex";
              });
              document.querySelectorAll('.dropdown').forEach(st => {
                st.style.display="none";
              });
             document.querySelectorAll('.sub_tr').forEach(st => {
                st.style.display="none";
              });
         }
         else if(verifyer_emp === 0) {
             document.getElementById("no_dataVerifyer").style.display = "flex"
             document.getElementById("no_dataVerifyer").innerHTML ='<img src="images/icons/dashboard/no_data_found.png" alt=""> No data found' 
         }
         else if(verifyer_emp === 1){
             document.getElementById("no_dataVerifyer").style.display = "none"
         }

         console.log(verifyer_emp)
     });

});





function go_ActiveMed(){
    document.getElementsByClassName("export_active_excel")[0].style.display = "flex";
    document.getElementsByClassName("export_active_pdf")[0].style.display = "flex";
    document.getElementsByClassName("export_inactive_excel")[0].style.display = "none";
    document.getElementsByClassName("export_inactive_pdf")[0].style.display = "none";
    document.getElementsByClassName("export_critical_excel")[0].style.display = "none";
    document.getElementsByClassName("export_critical_pdf")[0].style.display = "none";
    document.getElementsByClassName("export_exp_excel")[0].style.display = "none";
    document.getElementsByClassName("export_exp_pdf")[0].style.display = "none";
    document.getElementsByClassName("export_history_excel")[0].style.display = "none";
    document.getElementsByClassName("export_history_pdf")[0].style.display = "none";

    document.getElementById("no_dataVerifyer").style.display = "none"
    $("#med_cont_tb").load(location.href+" #med_cont_tb>*","");
    document.getElementById("med_cont_tb").style.display = "block";
    document.getElementById("act_medDiv").style.boxShadow = "rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px";
    document.getElementById("act_medDiv").style.backgroundColor = "rgb(248, 248, 248)";

    $("#activeMed_Count_span").load(window.location + " #activeMed_Count_span");
    $("#deactiveMed_Count_span").load(window.location + " #deactiveMed_Count_span");
    $("#critMed_Count_span").load(window.location + " #critMed_Count_span");
    $("#expDate_Count_span").load(window.location + " #expDate_Count_span");

    document.getElementById("deactmed_cont_tb").style.display = "none";
    document.getElementById("deact_medDiv").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("deact_medDiv").style.backgroundColor = "transparent";
    document.getElementById("critstockmed_cont_tb").style.display = "none";
    document.getElementById("crit_medDiv").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("crit_medDiv").style.backgroundColor = "transparent";
    document.getElementById("expReport_cont_tb").style.display =  "none";
    document.getElementById("exp_medDiv").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("exp_medDiv").style.backgroundColor = "transparent";
    document.getElementById("preHistory_cont_tb").style.display = "none";
    document.getElementById("hist_medDiv").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("hist_medDiv").style.backgroundColor = "transparent";
    document.getElementById("edit_stocks_daysleft").innerHTML = "Stocks";
    document.getElementById("search_medInfo").value = ""

    document.getElementsByClassName("th2")[0].innerHTML = "Medicine Name";
    document.getElementsByClassName("th3")[0].innerHTML = "Medicine ID";
  //  document.getElementsByClassName("th4")[0].innerHTML = "Stocks";
    document.getElementsByClassName("th5")[0].innerHTML = "Category";
    document.getElementsByClassName("th6")[0].innerHTML = "Expiration Date";

    var table = document.getElementById("table_active_med");
    var totalRowCount = table.rows.length; 
    if(totalRowCount === 0){          
        document.getElementById("no_dataVerifyer").innerHTML ='<img src="images/icons/dashboard/no_data_found.png" alt=""> Record is empty'         
        document.getElementById("no_dataVerifyer").style.display = "flex"
    }
}

function go_DeactiveMed(){
    document.getElementsByClassName("export_active_excel")[0].style.display = "none";
    document.getElementsByClassName("export_active_pdf")[0].style.display = "none";
    document.getElementsByClassName("export_inactive_excel")[0].style.display = "flex";
    document.getElementsByClassName("export_inactive_pdf")[0].style.display = "flex";
    document.getElementsByClassName("export_critical_excel")[0].style.display = "none";
    document.getElementsByClassName("export_critical_pdf")[0].style.display = "none";
    document.getElementsByClassName("export_exp_excel")[0].style.display = "none";
    document.getElementsByClassName("export_exp_pdf")[0].style.display = "none";
    document.getElementsByClassName("export_history_excel")[0].style.display = "none";
    document.getElementsByClassName("export_history_pdf")[0].style.display = "none";

    document.getElementById("no_dataVerifyer").style.display = "none"
    $("#deactmed_cont_tb").load(location.href+" #deactmed_cont_tb>*","");
    document.getElementById("deactmed_cont_tb").style.display = "block";
    document.getElementById("deact_medDiv").style.boxShadow = "rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px";
    document.getElementById("deact_medDiv").style.backgroundColor = "rgb(248, 248, 248)";

    $("#activeMed_Count_span").load(window.location + " #activeMed_Count_span");
    $("#deactiveMed_Count_span").load(window.location + " #deactiveMed_Count_span");
    $("#critMed_Count_span").load(window.location + " #critMed_Count_span");
    $("#expDate_Count_span").load(window.location + " #expDate_Count_span");

    document.getElementById("med_cont_tb").style.display = "none";
    document.getElementById("act_medDiv").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_medDiv").style.backgroundColor = "transparent";
    document.getElementById("critstockmed_cont_tb").style.display = "none";
    document.getElementById("crit_medDiv").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("crit_medDiv").style.backgroundColor = "transparent";
    document.getElementById("expReport_cont_tb").style.display =  "none";
    document.getElementById("exp_medDiv").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("exp_medDiv").style.backgroundColor = "transparent";
    document.getElementById("preHistory_cont_tb").style.display = "none";
    document.getElementById("hist_medDiv").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("hist_medDiv").style.backgroundColor = "transparent";
    document.getElementById("edit_stocks_daysleft").innerHTML = "Stocks";
    document.getElementById("search_medInfo").value = ""

    document.getElementsByClassName("th2")[0].innerHTML = "Medicine Name";
    document.getElementsByClassName("th3")[0].innerHTML = "Medicine ID";
  //  document.getElementsByClassName("th4")[0].innerHTML = "Stocks";
    document.getElementsByClassName("th5")[0].innerHTML = "Category";
    document.getElementsByClassName("th6")[0].innerHTML = "Expiration Date";

    var table = document.getElementById("table_deactive_med");
    var totalRowCount = table.rows.length; 
    if(totalRowCount === 0){          
        document.getElementById("no_dataVerifyer").innerHTML ='<img src="images/icons/dashboard/no_data_found.png" alt=""> Record is empty'         
         document.getElementById("no_dataVerifyer").style.display = "flex"
    }
}

function go_CritStocKsMed(){
    document.getElementsByClassName("export_active_excel")[0].style.display = "none";
    document.getElementsByClassName("export_active_pdf")[0].style.display = "none";
    document.getElementsByClassName("export_inactive_excel")[0].style.display = "none";
    document.getElementsByClassName("export_inactive_pdf")[0].style.display = "none";
    document.getElementsByClassName("export_critical_excel")[0].style.display = "flex";
    document.getElementsByClassName("export_critical_pdf")[0].style.display = "flex";
    document.getElementsByClassName("export_exp_excel")[0].style.display = "none";
    document.getElementsByClassName("export_exp_pdf")[0].style.display = "none";
    document.getElementsByClassName("export_history_excel")[0].style.display = "none";
    document.getElementsByClassName("export_history_pdf")[0].style.display = "none";

    document.getElementById("no_dataVerifyer").style.display = "none"
    $("#critstockmed_cont_tb").load(location.href+" #critstockmed_cont_tb>*","");
    document.getElementById("critstockmed_cont_tb").style.display = "block";
    document.getElementById("crit_medDiv").style.boxShadow = "rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px";
    document.getElementById("crit_medDiv").style.backgroundColor = "rgb(248, 248, 248)";

    $("#activeMed_Count_span").load(window.location + " #activeMed_Count_span");
    $("#deactiveMed_Count_span").load(window.location + " #deactiveMed_Count_span");
    $("#critMed_Count_span").load(window.location + " #critMed_Count_span");
    $("#expDate_Count_span").load(window.location + " #expDate_Count_span");

    document.getElementById("med_cont_tb").style.display = "none";
    document.getElementById("act_medDiv").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_medDiv").style.backgroundColor = "transparent";
    document.getElementById("deactmed_cont_tb").style.display = "none";
    document.getElementById("deact_medDiv").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("deact_medDiv").style.backgroundColor = "transparent";
    document.getElementById("expReport_cont_tb").style.display =  "none";
    document.getElementById("exp_medDiv").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("exp_medDiv").style.backgroundColor = "transparent";
    document.getElementById("preHistory_cont_tb").style.display = "none";
    document.getElementById("hist_medDiv").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("hist_medDiv").style.backgroundColor = "transparent";
    document.getElementById("edit_stocks_daysleft").innerHTML = "Stocks";
    document.getElementById("search_medInfo").value = ""

    document.getElementsByClassName("th2")[0].innerHTML = "Medicine Name";
    document.getElementsByClassName("th3")[0].innerHTML = "Medicine ID";
  //  document.getElementsByClassName("th4")[0].innerHTML = "Stocks";
    document.getElementsByClassName("th5")[0].innerHTML = "Category";
    document.getElementsByClassName("th6")[0].innerHTML = "Expiration Date";


    var table = document.getElementById("table_crit_med");
    var totalRowCount = table.rows.length; 
    if(totalRowCount === 0){          
        document.getElementById("no_dataVerifyer").innerHTML ='<img src="images/icons/dashboard/no_data_found.png" alt=""> Record is empty'         
        document.getElementById("no_dataVerifyer").style.display = "flex"
    }
}

function go_expirationDate(){
    document.getElementsByClassName("export_active_excel")[0].style.display = "none";
    document.getElementsByClassName("export_active_pdf")[0].style.display = "none";
    document.getElementsByClassName("export_inactive_excel")[0].style.display = "none";
    document.getElementsByClassName("export_inactive_pdf")[0].style.display = "none";
    document.getElementsByClassName("export_critical_excel")[0].style.display = "none";
    document.getElementsByClassName("export_critical_pdf")[0].style.display = "none";
    document.getElementsByClassName("export_exp_excel")[0].style.display = "flex";
    document.getElementsByClassName("export_exp_pdf")[0].style.display = "flex";
    document.getElementsByClassName("export_history_excel")[0].style.display = "none";
    document.getElementsByClassName("export_history_pdf")[0].style.display = "none";

    document.getElementById("no_dataVerifyer").style.display = "none"
    $("#expReport_cont_tb").load(location.href+" #expReport_cont_tb>*","");
    document.getElementById("expReport_cont_tb").style.display = "block";
    document.getElementById("exp_medDiv").style.boxShadow = "rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px";
    document.getElementById("exp_medDiv").style.backgroundColor = "rgb(248, 248, 248)";

    $("#activeMed_Count_span").load(window.location + " #activeMed_Count_span");
    $("#deactiveMed_Count_span").load(window.location + " #deactiveMed_Count_span");
    $("#critMed_Count_span").load(window.location + " #critMed_Count_span");
    $("#expDate_Count_span").load(window.location + " #expDate_Count_span");

    document.getElementById("med_cont_tb").style.display = "none";
    document.getElementById("act_medDiv").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_medDiv").style.backgroundColor = "transparent";
    document.getElementById("critstockmed_cont_tb").style.display = "none";
    document.getElementById("crit_medDiv").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("crit_medDiv").style.backgroundColor = "transparent";
    document.getElementById("deactmed_cont_tb").style.display = "none";
    document.getElementById("deact_medDiv").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("deact_medDiv").style.backgroundColor = "transparent";
    document.getElementById("preHistory_cont_tb").style.display = "none";
    document.getElementById("hist_medDiv").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("hist_medDiv").style.backgroundColor = "transparent";
    document.getElementById("search_medInfo").value = ""

    document.getElementById("edit_stocks_daysleft").innerHTML = "Days Left";
    document.getElementsByClassName("th2")[0].innerHTML = "Medicine Name";
    document.getElementsByClassName("th3")[0].innerHTML = "Medicine ID";
  //  document.getElementsByClassName("th4")[0].innerHTML = "Stocks";
    document.getElementsByClassName("th5")[0].innerHTML = "Category";
    document.getElementsByClassName("th6")[0].innerHTML = "Expiration Date";

    var table = document.getElementById("table_exp_med");
    var totalRowCount = table.rows.length; 
    if(totalRowCount === 0){          
        document.getElementById("no_dataVerifyer").innerHTML ='<img src="images/icons/dashboard/no_data_found.png" alt=""> Record is empty'         
        document.getElementById("no_dataVerifyer").style.display = "flex"
    }
}

function go_presHist(){
    document.getElementsByClassName("export_active_excel")[0].style.display = "none";
    document.getElementsByClassName("export_active_pdf")[0].style.display = "none";
    document.getElementsByClassName("export_inactive_excel")[0].style.display = "none";
    document.getElementsByClassName("export_inactive_pdf")[0].style.display = "none";
    document.getElementsByClassName("export_critical_excel")[0].style.display = "none";
    document.getElementsByClassName("export_critical_pdf")[0].style.display = "none";
    document.getElementsByClassName("export_exp_excel")[0].style.display = "none";
    document.getElementsByClassName("export_exp_pdf")[0].style.display = "none";
    document.getElementsByClassName("export_history_excel")[0].style.display = "flex";
    document.getElementsByClassName("export_history_pdf")[0].style.display = "flex";

    document.getElementById("no_dataVerifyer").style.display = "none"
    $("#preHistory_cont_tb").load(location.href+" #preHistory_cont_tb>*","");
    document.getElementById("preHistory_cont_tb").style.display = "block";
    document.getElementById("hist_medDiv").style.boxShadow = "rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px";
    document.getElementById("hist_medDiv").style.backgroundColor = "rgb(248, 248, 248)";

    $("#activeMed_Count_span").load(window.location + " #activeMed_Count_span");
    $("#deactiveMed_Count_span").load(window.location + " #deactiveMed_Count_span");
    $("#critMed_Count_span").load(window.location + " #critMed_Count_span");
    $("#expDate_Count_span").load(window.location + " #expDate_Count_span");

    document.getElementById("med_cont_tb").style.display = "none";
    document.getElementById("act_medDiv").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("act_medDiv").style.backgroundColor = "transparent";
    document.getElementById("critstockmed_cont_tb").style.display = "none";
    document.getElementById("crit_medDiv").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("crit_medDiv").style.backgroundColor = "transparent";
    document.getElementById("deactmed_cont_tb").style.display = "none";
    document.getElementById("deact_medDiv").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("deact_medDiv").style.backgroundColor = "transparent";
    document.getElementById("expReport_cont_tb").style.display =  "none";
    document.getElementById("exp_medDiv").style.boxShadow = "rgba(0, 0, 0, 0) 0px 0px 0px";
    document.getElementById("exp_medDiv").style.backgroundColor = "transparent";
    document.getElementById("search_medInfo").value = ""


    document.getElementsByClassName("th2")[0].innerHTML = "Patient Name";
    document.getElementsByClassName("th3")[0].innerHTML = "Issued By";
    document.getElementsByClassName("th4")[0].innerHTML = "Date Issued";
    document.getElementsByClassName("th5")[0].innerHTML = "Medicine Information";
    document.getElementsByClassName("th6")[0].innerHTML = "";

    var table = document.getElementById("table_hist_med");
    var totalRowCount = table.rows.length; 
    if(totalRowCount === 0){          
        document.getElementById("no_dataVerifyer").innerHTML ='<img src="images/icons/dashboard/no_data_found.png" alt=""> Record is empty'         
        document.getElementById("no_dataVerifyer").style.display = "flex"
    }
}

//dropdown medicine table
function seeMoremed_Act(val_see){
    document.querySelectorAll('#sub_tr'+val_see).forEach(st => {
       st.style.display="table-row";
     });

     document.querySelectorAll('#dropright'+val_see).forEach(st => {
       st.style.display="none";
     });
     document.querySelectorAll('#dropdown'+val_see).forEach(st => {
       st.style.display="block";
     });
}

//dropdown medicine table
function seeLessmed_Act(val_see1){
   document.querySelectorAll('#sub_tr'+val_see1).forEach(st => {
      st.style.display="none";
    });

    document.querySelectorAll('#dropright'+val_see1).forEach(st => {
      st.style.display="block";
    });
    document.querySelectorAll('#dropdown'+val_see1).forEach(st => {
      st.style.display="none";
    });
}


//dosage med
var dosageT = "mg"
function getTypeDosage(){
    var selectD = document.getElementById("dosage");
    var typeD = selectD.options[selectD.selectedIndex].text;
    dosageT = typeD;
}

function dosageMed(){
    var numD = document.getElementById("med_dosage").value
    document.getElementById("dosage_key").value = numD+dosageT;
}

setInterval(function(){ 
    dosageMed();
}, 100);


function generateReceipt(name,Issuedby,date,meds){
    document.getElementById("medicineslip_container").style.display = "flex";
    document.getElementById("name_receipt").innerHTML = name;
    document.getElementById("issued_receipt").innerHTML = Issuedby;
    document.getElementById("date_receipt").innerHTML = date;
    document.getElementById("listmed").innerHTML = meds;
}