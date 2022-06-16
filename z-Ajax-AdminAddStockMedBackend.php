<?php
session_start();
//estalishing connection to database 
require_once "Z-connection.php";
date_default_timezone_set('Asia/Manila');
$name = mysqli_real_escape_string($conn, $_POST['name_inp_ats']);
$subname = mysqli_real_escape_string($conn, $_POST['subname_ats']);
$type = mysqli_real_escape_string($conn, $_POST['brand_ats']);
$category = mysqli_real_escape_string($conn, $_POST['category_ats']);
$mfg_date = mysqli_real_escape_string($conn, $_POST['mfg_ats']);
$date = mysqli_real_escape_string($conn, $_POST['exp_ats']);
$stock = mysqli_real_escape_string($conn, $_POST['ats_box_input']);
$status = "activated";

$name = strtolower($name);
$sql = "SELECT * FROM medicine_tb Where name='$name'" ; 
$search_pendingApp = filterTable($sql);
function filterTable($sql){  
    $con=mysqli_connect('localhost','root','','robles_db');
    $filter_pendingApp = mysqli_query($con, $sql);
    return $filter_pendingApp; 
}
$sr = 0; 

$verifyer = "";

while($row = mysqli_fetch_array($search_pendingApp)){

    $strSubname = $row['subname'];
    $strSubstock = $row['substock'];
    $strSubcategory = $row['category'];
    $strSubexpdate = $row['expiration_date'];
    $strSubmfgdate = $row['mfg_date'];
    $strSubbrand = $row['type'];
    $strSubStatus = $row['status'];

    $arraySubname = explode(',', $strSubname );
    $arraySubstock = explode(',', $strSubstock );
    $arrayCategory = explode(',', $strSubcategory );
    $arrayExpdate = explode(',', $strSubexpdate );
    $arrayMfgdate = explode(',', $strSubmfgdate);
    $arrayBrand = explode(',', $strSubbrand );
    $arrayStatus = explode(',', $strSubStatus );

    $totalStock = 0;
    $name = strtolower($name);
    $z = 0 ;
    $z1 = 0;
    $keyM = 0;

        while($z<count($arraySubname)){
            if($arraySubname[$z] == $subname && $arrayCategory[$z] == $category && strcasecmp($arrayBrand[$z],$type) == 0  && $arrayMfgdate[$z] == $mfg_date && $arrayExpdate[$z] == $date){
                
                $arraySubstock[$z] = $arraySubstock[$z]+$stock;     
                $arrayStatus[$z] = $status;
                $convertedStockArray = implode(",",$arraySubstock);    
                $convertedStatArray = implode(",",$arrayStatus);  
            mysqli_query($conn, "UPDATE `medicine_tb` SET substock ='$convertedStockArray', `status`='$convertedStatArray',`main_stat`='$status' WHERE name='$name'");
                    $verifyer =  "addTosameMed";

                    $key_nameAudit =$_SESSION["auditname"];
                    $dateTodayAudit = date("Y-m-d");
                    $timeAudit = date("h:i A");
                    $dateTimeAudit = $dateTodayAudit." ".$timeAudit;
                    $descriptionAudit = $key_nameAudit." added stocks to a medicine with the name ".$arraySubname[$z].".";
                    
                    mysqli_query($conn, "INSERT INTO audit_tb (date, name, description) VALUES('".$dateTimeAudit."', '".$key_nameAudit."', '".$descriptionAudit."')");
                    $keyM = 1;
             }
            $z++;
        }

        while($z1<count($arraySubname) && $keyM != 1){
             if($row['name'] == $name && $arraySubname[$z1] != $subname || $arrayCategory[$z1] != $category || strcasecmp($arrayBrand[$z1],$type) != 0 || $arrayMfgdate[$z1] != $mfg_date || $arrayExpdate[$z1] != $date){
                $updateArraySubname = $row['subname'].",".$subname;
                $updateArrayCategory = $row['category'].",".$category;
                $updateArrayBrand = $row['type'].",".$type;
                $updateArrayStock = $row['substock'].",".$stock;
                $updateArrayExpDate = $row['expiration_date'].",".$date;
                $updateArrayMfgDate = $row['mfg_date'].",".$mfg_date;
                $updateArraySubname = strtolower($updateArraySubname);
                $updateArrayBrand = strtolower($updateArrayBrand);
                $updateArrayStatus = $row['status'].",".$status;

                
                $keyEditDelete = $subname.$category.$type.$mfg_date.$date;
                $updateArrayEditDelete = $row['edit_delete'].",".$keyEditDelete;

                    mysqli_query($conn, "UPDATE `medicine_tb` SET edit_delete ='$updateArrayEditDelete', subname ='$updateArraySubname',category ='$updateArrayCategory',type='$updateArrayBrand',substock='$updateArrayStock', mfg_date='$updateArrayMfgDate', expiration_date='$updateArrayExpDate', status='$updateArrayStatus', main_stat ='$status' WHERE name='$name'");
                    $verifyer =  "addTodiffMed";    

                    $key_nameAudit =$_SESSION["auditname"];
                    $dateTodayAudit = date("Y-m-d");
                    $timeAudit = date("h:i A");
                    $dateTimeAudit = $dateTodayAudit." ".$timeAudit;
                    $descriptionAudit = $key_nameAudit." added stocks to a medicine with the name ".$updateArraySubname.".";
                    
                    mysqli_query($conn, "INSERT INTO audit_tb (date, name, description) VALUES('".$dateTimeAudit."', '".$key_nameAudit."', '".$descriptionAudit."')");
            }
            $z1++;
        }

$sr++; }

    echo $verifyer;
    mysqli_close($conn);

?>