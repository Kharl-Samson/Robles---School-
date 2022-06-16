<?php
session_start();
    //estalishing connection to database 
    require_once "Z-connection.php";
    date_default_timezone_set('Asia/Manila');

      //declaring variables and gettin the value of input
      $fname = mysqli_real_escape_string($conn, $_POST['fname']);
      $mname = mysqli_real_escape_string($conn, $_POST['mname']);
      $lname = mysqli_real_escape_string($conn, $_POST['lname']);
      $reg= mysqli_real_escape_string($conn, $_POST['reg']);
      $street= mysqli_real_escape_string($conn, $_POST['street']);
      $bar = mysqli_real_escape_string($conn, $_POST['bar']);
      $mun = mysqli_real_escape_string($conn, $_POST['mun']);
      $prov = mysqli_real_escape_string($conn, $_POST['prov']);
      $bday = mysqli_real_escape_string($conn, $_POST['birthday']);
      $age = mysqli_real_escape_string($conn, $_POST['age']);
      $weight = mysqli_real_escape_string($conn, $_POST['weight']);
      $religion = mysqli_real_escape_string($conn, $_POST['religion']);
      $civilstatus = mysqli_real_escape_string($conn, $_POST['civil_status']);
      $id = mysqli_real_escape_string($conn, $_POST['id_key']);
      
      
            //connection to server to update
            $sqli = "UPDATE `patientinfo_db` SET fname='$fname', mname='$mname', lname='$lname', region='$reg', street='$street',barangay='$bar', municipality='$mun', province='$prov', bday='$bday', age='$age', weight='$weight', religion='$religion', civilstatus='$civilstatus' Where id='$id'";

            $results=mysqli_query($conn, $sqli);


            if($results)
            {
                $key_nameAudit = $_SESSION['user_active'];
                $dateTodayAudit = date("Y-m-d");
                $timeAudit = date("h:i A");
                $dateTimeAudit = $dateTodayAudit." ".$timeAudit;
                $descriptionAudit = $key_nameAudit." edited a patient information.";
                
                mysqli_query($conn, "INSERT INTO audit_tb (date, name, description) VALUES('".$dateTimeAudit."', '".$key_nameAudit."', '".$descriptionAudit."')");
                echo "success";
            }
     
            else{
                echo "failed";
            }

    
    mysqli_close($conn);

?>