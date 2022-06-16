function viewPatient(valkey){
    xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () =>{
        if(xhr.readyState == 4 && xhr.status == 200){
           if(xhr.responseText == "success"){
               window.location.href = 'adminViewPatientInfo.php'
            }
        }
    };

    xhr.open("GET", "z-Ajax-AdminViewPatient.php?key=" +valkey, true);
    xhr.send();
}


function editPatient(valkey){
    xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () =>{
        if(xhr.readyState == 4 && xhr.status == 200){
           if(xhr.responseText == "success"){
               window.location.href = 'adminEditPatientInfo.php'
            }
        }
    };

    xhr.open("GET", "z-Ajax-AdminEditPatient.php?key=" +valkey, true);
    xhr.send();
}


//view Patient in doctors account
function viewPatient_doctorAcc(valkey){
    xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () =>{
        if(xhr.readyState == 4 && xhr.status == 200){
           if(xhr.responseText == "success"){
               window.location.href = 'doctorViewPatientInfo.php'
            }
        }
    };

    xhr.open("GET", "z-Ajax-AdminViewPatient.php?key=" +valkey, true);
    xhr.send();
}


//Make report in doctors account
function makeReport_doctorAcc(valkey){
    xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () =>{
        if(xhr.readyState == 4 && xhr.status == 200){
           if(xhr.responseText == "success"){
               window.location.href = 'doctorMakeReport.php'
            }
        }
    };

    xhr.open("GET", "z-Ajax-AdminViewPatient.php?key=" +valkey, true);
    xhr.send();
}

