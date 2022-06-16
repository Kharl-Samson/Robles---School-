<?php
session_start();
    //estalishing connection to database 
    require_once "Z-connection.php";
    date_default_timezone_set('Asia/Manila');

      //declaring variables and gettin the value of input
      $med_name_edit = mysqli_real_escape_string($conn, $_POST['med_name_edit']);
      $med_type_edit = mysqli_real_escape_string($conn, $_POST['med_type_edit']);
      $med_dosage_edit = mysqli_real_escape_string($conn, $_POST['med_dosage_edit']);
      $med_description_edit= trim($_POST['med_description_edit']);
      $man_date_edit = mysqli_real_escape_string($conn, $_POST['man_date_edit']);
      $med_date_edit = mysqli_real_escape_string($conn, $_POST['med_date_edit']);
      $med_stock_edit = mysqli_real_escape_string($conn, $_POST['med_stock_edit']);
      $med_category_edit = mysqli_real_escape_string($conn, $_POST['med_category_edit']);
      $crit_Stocks_edit = mysqli_real_escape_string($conn, $_POST['crit_Stocks_edit']);

      $id = mysqli_real_escape_string($conn, $_POST['key_edit_delete']);
      $mainId = mysqli_real_escape_string($conn, $_POST['mainId_edit']);
      $dosage_key_edit = mysqli_real_escape_string($conn, $_POST['dosage_key_edit']);




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
        $strCategory = $row['category'];
        $strType = $row['type'];
        $strSubstock = $row['substock'];
        $strMfg_date = $row['mfg_date'];
        $strExp_date = $row['expiration_date'];
        $strCritStock = $row['critStock'];

        $strEditDelete = $row['edit_delete'];

        $arraySubname = explode(',', $strSubname );
        $arrayCategory= explode(',', $strCategory );
        $arrayType= explode(',', $strType );
        $arraySubstock= explode(',', $strSubstock );
        $arrayMfg_date= explode(',', $strMfg_date );
        $arrayExp_date= explode(',', $strExp_date );
        $arrayCritStock= explode(',', $strCritStock );
        
        $arrayEditDelete = explode(',', $strEditDelete );
        $z = 0 ;

        while($z<count($arraySubname)){
            if($arrayEditDelete[$z] == $id){
                $arraySubname[$z] = $med_name_edit." ".$dosage_key_edit;  
                $arrayCategory[$z] = $med_category_edit;
                $arrayType[$z] = $med_type_edit;
                $arraySubstock[$z] = $med_stock_edit;
                $arrayMfg_date[$z] = $man_date_edit;
                $arrayExp_date[$z] = $med_date_edit;
                $arrayEditDelete[$z] = $med_name_edit.$dosage_key_edit.$med_category_edit.$med_type_edit.$man_date_edit.$med_date_edit;
                $arrayCritStock[$z] = $crit_Stocks_edit;

                $convertedSubname = implode(",",$arraySubname);    
                $convertedCategory = implode(",",$arrayCategory);    
                $convertedType = implode(",",$arrayType);    
                $convertedSubstock = implode(",",$arraySubstock);    
                $convertedMfg_date = implode(",",$arrayMfg_date);    
                $convertedExp_date = implode(",",$arrayExp_date);    
                $convertedEditDelete = implode(",",$arrayEditDelete);    
                $convertedCritStock = implode(",",$arrayCritStock);  

                    mysqli_query($conn, "UPDATE `medicine_tb` SET edit_delete='$convertedEditDelete', name='$med_name_edit', subname='$convertedSubname', category='$convertedCategory', type='$convertedType',description='$med_description_edit', substock='$convertedSubstock', mfg_date='$convertedMfg_date', expiration_date='$convertedExp_date' , critStock='$convertedCritStock' WHERE id='$mainId'");
                    $verifyer =  "success";

                    $key_nameAudit =$_SESSION["auditname"];
                    $dateTodayAudit = date("Y-m-d");
                    $timeAudit = date("h:i A");
                    $dateTimeAudit = $dateTodayAudit." ".$timeAudit;
                    $descriptionAudit = $key_nameAudit." edited a medicine with the name ".$arraySubname[$z].".";
                    
                    mysqli_query($conn, "INSERT INTO audit_tb (date, name, description) VALUES('".$dateTimeAudit."', '".$key_nameAudit."', '".$descriptionAudit."')");
             }
            $z++;
        }    
      $sr++;
      }


    echo $verifyer;
    mysqli_close($conn);

?>