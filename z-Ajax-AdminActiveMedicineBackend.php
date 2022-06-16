<?php
session_start();
    //estalishing connection to database 
    require_once "Z-connection.php";
    date_default_timezone_set('Asia/Manila');
      //declaring variables and gettin the value of input
      $id = mysqli_real_escape_string($conn, $_POST['key_medact']);
      $name_key= mysqli_real_escape_string($conn, $_POST['key_medactName']); 

    $sql = "SELECT * FROM medicine_tb"; 
    $search_pendingApp = filterTable($sql);
    function filterTable($sql){  
        $con=mysqli_connect('localhost','root','','robles_db');
        $filter_pendingApp = mysqli_query($con, $sql);
    return $filter_pendingApp; 
    }
    $sr = 0; 
    $key_stat= 0;
    $total_sub = 0;
    while($row = mysqli_fetch_array($search_pendingApp)){

        $strSubname = $row['subname'];
        $strEditDelete = $row['edit_delete'];
        $strStatus = $row['status'];

        $arraySubname = explode(',', $strSubname );
        $arrayEditDelete = explode(',', $strEditDelete );
        $arrayStatus = explode(',', $strStatus );

        $totalStock = 0;
        $name = strtolower($name);
        $z = 0 ;
            while($z<count($arraySubname)){
                if($arrayEditDelete[$z] == $id){
                    $arrayStatus[$z] = "activated";     
                    $convertedStatus = implode(",",$arrayStatus);    
                        mysqli_query($conn, "UPDATE `medicine_tb` SET status ='$convertedStatus' WHERE name  ='$name_key'");
                        $verifyer =  "success";

                        $key_nameAudit =$_SESSION["auditname"];
                        $dateTodayAudit = date("Y-m-d");
                        $timeAudit = date("h:i A");
                        $dateTimeAudit = $dateTodayAudit." ".$timeAudit;
                        $descriptionAudit = $key_nameAudit." activated a medicine with the name ".$arraySubname[$z].".";
                        
                        mysqli_query($conn, "INSERT INTO audit_tb (date, name, description) VALUES('".$dateTimeAudit."', '".$key_nameAudit."', '".$descriptionAudit."')");
                 }
                $z++;
            }                
    $sr++; }



    echo $verifyer;

    mysqli_close($conn);

?>

