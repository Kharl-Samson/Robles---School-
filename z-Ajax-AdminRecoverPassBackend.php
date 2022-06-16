<?php
session_start();
    //estalishing connection to database 
    require_once "Z-connection.php";

      //declaring variables and gettin the value of input
      $pass = mysqli_real_escape_string($conn, $_POST['password_l']);
      $email = mysqli_real_escape_string($conn, $_POST['hidden_email']);

      $sqli = "UPDATE `staff_db` SET password ='$pass' WHERE email='$email'";
      $results=mysqli_query($conn, $sqli);

            if($results)
            {
                echo "success";
            }
     
            else{
                echo "failed";
            }

    mysqli_close($conn);

?>