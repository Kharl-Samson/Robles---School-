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


     // $filename = $_FILES['Picture']['name'];
      //$filetmpname = $_FILES['Picture']['tmp_name'];

      //$folder = 'upload_img/';
      //move_uploaded_file($filetmpname, $folder.$filename);

    //checking if username already exist
    $s_user = "SELECT * FROM `staff_db` WHERE username='$username' AND id!='$id'";
    $result_username = mysqli_query($conn, $s_user);
    $num_user = mysqli_num_rows($result_username); 

    //checking if email already exist
    $s_email = "SELECT * FROM `staff_db` WHERE email='$email' AND id!='$id'";
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
            $sqli = "UPDATE `staff_db` SET fname='$fname', mname='$mname', lname='$lname', reg='$region', street='$street',bar='$bar', mun='$mun', prov='$prov', username='$username' , phone='$phone', email='$email', birthday='$bday', age='$age' WHERE id='$id'";
            $results=mysqli_query($conn, $sqli);


            if($results)
            {
                $_SESSION["user_active"] = $username;
                echo "success";
            }
     
            else{
                echo "SQL failed";
            }

        }
    mysqli_close($conn);

?>