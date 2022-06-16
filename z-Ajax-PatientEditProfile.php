<?php
session_start();
    //estalishing connection to database 
    require_once "Z-connection.php";


      //declaring variables and gettin the value of input
      $fname = mysqli_real_escape_string($conn, $_POST['fname']);
      $mname = mysqli_real_escape_string($conn, $_POST['mname']);
      $lname = mysqli_real_escape_string($conn, $_POST['lname']);
      $region =  mysqli_real_escape_string($conn, $_POST['reg']);
      $street = mysqli_real_escape_string($conn, $_POST['street']);
      $bar = mysqli_real_escape_string($conn, $_POST['bar']);
      $mun = mysqli_real_escape_string($conn, $_POST['mun']);
      $prov = mysqli_real_escape_string($conn, $_POST['prov']);
      $username = mysqli_real_escape_string($conn, $_POST['username']);
      $phone = mysqli_real_escape_string($conn, $_POST['phone']);
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $bday = mysqli_real_escape_string($conn, $_POST['birthday']);
      $age = mysqli_real_escape_string($conn, $_POST['age']);

      $id = mysqli_real_escape_string($conn, $_POST['secrect_id']);


    //checking if username already exist
    $s_user = "SELECT * FROM `patientinfo_db` WHERE username='$username' AND id!='$id'";
    $result_username = mysqli_query($conn, $s_user);
    $num_user = mysqli_num_rows($result_username); 

    //checking if email already exist
    $s_email = "SELECT * FROM `patientinfo_db` WHERE email='$email' AND id!='$id'";
    $result_email = mysqli_query($conn, $s_email);
    $num_email = mysqli_num_rows($result_email); 
      
        if($num_user == 1){
            echo "username already exist";
        }
        else if($num_email == 1){
            echo "email already exist";
        }
        else{
            //connection to server to update
            $sqli = "UPDATE `patientinfo_db` SET fname='$fname', mname='$mname', lname='$lname', region='$region', street='$street',barangay='$bar', municipality='$mun', province='$prov', username='$username' , contact='$phone', email='$email', bday='$bday', age='$age' WHERE id='$id'";
            $results=mysqli_query($conn, $sqli);


            if($results)
            {
                $_SESSION["patient_active"] = $username;
                echo "success";
            }
     
            else{
                echo "failed";
            }

        }
    mysqli_close($conn);

?>