<?php
session_start();
date_default_timezone_set('Asia/Manila');
require_once "Z-connection.php";
$id = mysqli_real_escape_string($conn, $_POST['edit_delete_pres']);
$stock = mysqli_real_escape_string($conn, $_POST['inp_stck_subcont']);
$main_name =  mysqli_real_escape_string($conn, $_POST['main_name_pres']);

$pres_dateT = mysqli_real_escape_string($conn, $_POST['pres_dateT']);
$pres_Pname =  mysqli_real_escape_string($conn, $_POST['pres_Pname']);
$issuedBy =  mysqli_real_escape_string($conn, $_POST['issuedBy']);
$typeP =  mysqli_real_escape_string($conn, $_POST['type_pres']);
$medNameP =  mysqli_real_escape_string($conn, $_POST['main_nameP']);
$actual_Stock =  mysqli_real_escape_string($conn, $_POST['actual_Stock']);
$medNameP1 = $medNameP." (".$typeP.") - ".$actual_Stock."pcs";

$pres_Pname = strtolower($pres_Pname);
$issuedBy = strtolower($issuedBy);

$date_Today = date("Y-m-d");

$sql = "SELECT * FROM medicine_tb"; 
$search_pendingApp = filterTable($sql);
function filterTable($sql){  
    $con=mysqli_connect('localhost','root','','robles_db');
    $filter_pendingApp = mysqli_query($con, $sql);
return $filter_pendingApp; 
}

$sr = 0; 
while($row = mysqli_fetch_array($search_pendingApp)){
  $strSubname = $row['subname'];
  $strSubstock = $row['substock'];
  $strEditDelete = $row['edit_delete'];

  $arraySubname = explode(',', $strSubname );
  $arraySubstock= explode(',', $strSubstock );
  $arrayEditDelete = explode(',', $strEditDelete );

  $z = 0 ;
  while($z<count($arraySubname)){
      if($arrayEditDelete[$z] == $id){
          $arraySubstock[$z] = $stock;    
          $convertedSubstock = implode(",",$arraySubstock);    
    
              mysqli_query($conn, "UPDATE `medicine_tb` SET substock='$convertedSubstock' WHERE name='$main_name'");    
              
       }
      $z++;
  }    
$sr++;
}

$sql1 = "SELECT * FROM prescribemedhistory_tb"; 
$search_pendingApp1 = filterTable1($sql1);
function filterTable1($sql1){  
    $con1=mysqli_connect('localhost','root','','robles_db');
    $filter_pendingApp1 = mysqli_query($con1, $sql1);
return $filter_pendingApp1; 
}

$s_email = "SELECT * FROM `prescribemedhistory_tb` WHERE patient_name='$pres_Pname'";
$result_email = mysqli_query($conn, $s_email);
$num_email = mysqli_num_rows($result_email); 

if($num_email == 1){
  $sr1 = 0; 
  while($row1 = mysqli_fetch_array($search_pendingApp1)){
      $patientName = $row1['patient_name'];
      $dutyStaff = $row1['issuedby'];
      $strsubMedName = $row1['meds_name'].", ".$medNameP." (".$typeP.") - ".$actual_Stock."pcs";
      $strsubStaff = $row1['issuedby'].", ".$issuedBy;
  
        if($patientName == $pres_Pname && $date_Today == $pres_dateT && $issuedBy == $dutyStaff  ){
          mysqli_query($conn, "UPDATE `prescribemedhistory_tb` SET meds_name='$strsubMedName' WHERE patient_name='$patientName'");    
          
          $key_nameAudit =$_SESSION["auditname"];
          $dateTodayAudit = date("Y-m-d");
          $timeAudit = date("h:i A");
          $dateTimeAudit = $dateTodayAudit." ".$timeAudit;
          $descriptionAudit = $key_nameAudit." prescribed a medicine with the name ".$medNameP.".";
          
          mysqli_query($conn, "INSERT INTO audit_tb (date, name, description) VALUES('".$dateTimeAudit."', '".$key_nameAudit."', '".$descriptionAudit."')");
        }
        else if($patientName == $pres_Pname && $date_Today == $pres_dateT && $issuedBy != $dutyStaff  ){
          mysqli_query($conn, "UPDATE `prescribemedhistory_tb` SET meds_name='$strsubMedName', 	issuedby='$strsubStaff' WHERE patient_name='$patientName'");

          $key_nameAudit =$_SESSION["auditname"];
          $dateTodayAudit = date("Y-m-d");
          $timeAudit = date("h:i A");
          $dateTimeAudit = $dateTodayAudit." ".$timeAudit;
          $descriptionAudit =  $key_nameAudit." prescribed a medicine with the name ".$medNameP.".";
          
          mysqli_query($conn, "INSERT INTO audit_tb (date, name, description) VALUES('".$dateTimeAudit."', '".$key_nameAudit."', '".$descriptionAudit."')");
        }
    $sr1++;
  }
}
else{
  mysqli_query($conn, "INSERT INTO prescribemedhistory_tb (meds_name, issuedby, date, patient_name) VALUES('".$medNameP1."', '".$issuedBy."', '".$pres_dateT."', '".$pres_Pname."' )");

  $key_nameAudit =$_SESSION["auditname"];
  $dateTodayAudit = date("Y-m-d");
  $timeAudit = date("h:i A");
  $dateTimeAudit = $dateTodayAudit." ".$timeAudit;
  $descriptionAudit = $key_nameAudit." prescribed a medicine with the name ".$medNameP.".";
  
  mysqli_query($conn, "INSERT INTO audit_tb (date, name, description) VALUES('".$dateTimeAudit."', '".$key_nameAudit."', '".$descriptionAudit."')");
}


  $verifyer =  "success";

echo $verifyer;
mysqli_close($conn);


?>