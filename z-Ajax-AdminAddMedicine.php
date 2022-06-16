<?php
session_start();
date_default_timezone_set('Asia/Manila');
require_once "Z-connection.php";
$name = mysqli_real_escape_string($conn, $_POST['med_name']);
$type = mysqli_real_escape_string($conn, $_POST['med_type']);
$category = mysqli_real_escape_string($conn, $_POST['med_category']);
$desc = trim($_POST['med_description']);
$date = mysqli_real_escape_string($conn, $_POST['med_date']);
$mfg_date = mysqli_real_escape_string($conn, $_POST['man_date']);
$stock = mysqli_real_escape_string($conn, $_POST['med_stock']);
$status = "activated";
$dosage_key = mysqli_real_escape_string($conn, $_POST['dosage_key']);
$critStocks = mysqli_real_escape_string($conn, $_POST['crit_Stocks']);

$name = strtolower($name);
$nameWithdosage = $name." ".$dosage_key;
$id = "";


$sql = "SELECT * FROM medicine_tb Where name='$name'" ; 
$search_pendingApp = filterTable($sql);
function filterTable($sql){  
    $con=mysqli_connect('localhost','root','','robles_db');
    $filter_pendingApp = mysqli_query($con, $sql);
    return $filter_pendingApp; 
}
$sr = 0; 
$stock_val = 0;

$verifyer = "";


$s_user = "SELECT * FROM medicine_tb Where name='$name'";
$result_med = mysqli_query($conn, $s_user);
$num_med = mysqli_num_rows($result_med); 

//xml med id counter
$xml = new DOMDocument();
$xml->load("medIDCTR.xml");
$users = $xml->getElementsByTagName("user");
foreach($users as $user){
   $ctr = $user->getAttribute("username");
}
  
    if($num_med == 0){
        $arrayID_mfg=explode("-",$mfg_date);
        $arrayID_exp=explode("-",$date);
        $newstringMfg = substr($arrayID_mfg[0], -2);
        $newstringExp = substr($arrayID_exp[0], -2);
        $id = "R".$newstringMfg."-".$newstringExp.$arrayID_exp[1]."-".$ctr;

        $name = strtolower($name);
        $nameWithdosage = strtolower($nameWithdosage);
        $type = strtolower($type);
        $desc = strtolower($desc);

        $keyEditDelete = $nameWithdosage.$category.$type.$mfg_date.$date;

        if(mysqli_query($conn, "INSERT INTO medicine_tb (`edit_delete`, `main_id`, `name`, `subname` , `category`, `type`, `description`, `substock`, `mfg_date`, `expiration_date`, `status`, `main_stat` , `critStock`) VALUES('" . $keyEditDelete . "', '" . $id . "', '" . $name . "', '" . $nameWithdosage . "', '" . $category . "', '" . $type . "' , '" . $desc . "', '" . $stock  . "' , '" . $mfg_date . "', '" . $date . "',  '" . $status . "', '".$status."' , '".$critStocks."')")){

            $key_nameAudit =$_SESSION["auditname"];
            $dateTodayAudit = date("Y-m-d");
            $timeAudit = date("h:i A");
            $dateTimeAudit = $dateTodayAudit." ".$timeAudit;
            $descriptionAudit = $key_nameAudit." added a medicine with the name ".$nameWithdosage.".";
            
            mysqli_query($conn, "INSERT INTO audit_tb (date, name, description) VALUES('".$dateTimeAudit."', '".$key_nameAudit."', '".$descriptionAudit."')");

            $verifyer = "addToOneMed";   
        }
        $xml1 = new DOMDocument;
        $xml1 ->load("medIDCTR.xml");
        $xml1->formatOutput = true;
        $xml1->preserveWhiteSpace = false;
        $users1 = $xml->getElementsByTagName('user');
        $flag = 0;
        foreach($users1 as $user1){
           $username = $user1->getAttribute("username");  
       
                $u = $user1->getAttribute("username");  
                $u++;         
                $newNode = $xml->createElement('user');
                $newNode->setAttribute("username",$u);
                $oldnode=$user1;
                $xml->getElementsByTagName("users")->item(0)->replaceChild($newNode,$oldnode);
                $xml->save("medIDCTR.xml");
                break;             
        }
    }
    else{

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
                    if($arraySubname[$z] == $nameWithdosage && $arrayCategory[$z] == $category && strcasecmp($arrayBrand[$z],$type) == 0  && $arrayMfgdate[$z] == $mfg_date && $arrayExpdate[$z] == $date){
                        $arraySubstock[$z] = $arraySubstock[$z]+$stock;     
                        $arrayStatus[$z] = $status;
                        $convertedStockArray = implode(",",$arraySubstock);    
                        $convertedStatArray = implode(",",$arrayStatus);  
                    mysqli_query($conn, "UPDATE `medicine_tb` SET substock ='$convertedStockArray', `status`='$convertedStatArray',`main_stat`='$status' WHERE name='$name'");


                    $key_nameAudit =$_SESSION["auditname"];
                    $dateTodayAudit = date("Y-m-d");
                    $timeAudit = date("h:i A");
                    $dateTimeAudit = $dateTodayAudit." ".$timeAudit;
                    $descriptionAudit = $key_nameAudit." added a medicine with the name ".$arraySubname[$z].".";
                    
                    mysqli_query($conn, "INSERT INTO audit_tb (date, name, description) VALUES('".$dateTimeAudit."', '".$key_nameAudit."', '".$descriptionAudit."')");

                            $verifyer =  "addTosameMed";
                            $keyM = 1;
                     }
                    $z++;
                }

                while($z1<count($arraySubname) && $keyM != 1){
                     if($row['name'] == $name && $arraySubname[$z1] != $nameWithdosage || $arrayCategory[$z1] != $category || strcasecmp($arrayBrand[$z1],$type) != 0 || $arrayMfgdate[$z1] != $mfg_date || $arrayExpdate[$z1] != $date){
                        $updateArraySubname = $row['subname'].",".$nameWithdosage;
                        $updateArrayCategory = $row['category'].",".$category;
                        $updateArrayBrand = $row['type'].",".$type;
                        $updateArrayStock = $row['substock'].",".$stock;
                        $updateArrayExpDate = $row['expiration_date'].",".$date;
                        $updateArrayMfgDate = $row['mfg_date'].",".$mfg_date;
                        $updateArraySubname = strtolower($updateArraySubname);
                        $updateArrayBrand = strtolower($updateArrayBrand);
                        $updateArrayStatus = $row['status'].",".$status;
                        $updateArrayCritStocks = $row['critStock'].",".$critStocks;

                        
                        $keyEditDelete = $nameWithdosage.$category.$type.$mfg_date.$date;
                        $updateArrayEditDelete = $row['edit_delete'].",".$keyEditDelete;

                            mysqli_query($conn, "UPDATE `medicine_tb` SET edit_delete ='$updateArrayEditDelete', subname ='$updateArraySubname',category ='$updateArrayCategory',type='$updateArrayBrand',substock='$updateArrayStock', mfg_date='$updateArrayMfgDate', expiration_date='$updateArrayExpDate', status='$updateArrayStatus', main_stat ='$status' , critStock ='$updateArrayCritStocks' WHERE name='$name'");


                            $key_nameAudit =$_SESSION["auditname"];
                            $dateTodayAudit = date("Y-m-d");
                            $timeAudit = date("h:i A");
                            $dateTimeAudit = $dateTodayAudit." ".$timeAudit;
                            $descriptionAudit = $key_nameAudit." added a medicine with the name ".$updateArraySubname.".";
                            
                            mysqli_query($conn, "INSERT INTO audit_tb (date, name, description) VALUES('".$dateTimeAudit."', '".$key_nameAudit."', '".$descriptionAudit."')");

                            $verifyer =  "addTodiffMed";    
                    }
                    $z1++;
                }

        $sr++; }
        
    }

    echo $verifyer;


mysqli_close($conn);
?>

