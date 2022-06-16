<?php
session_start();
    //estalishing connection to database 
    require_once "Z-connection.php";

      //declaring variables and gettin the value of input
      $old = mysqli_real_escape_string($conn, $_POST['old_pass']);
      $new = mysqli_real_escape_string($conn, $_POST['new_pass']);

      $id = mysqli_real_escape_string($conn, $_POST['id']);

      $result = mysqli_query($conn, "SELECT * FROM staff_db WHERE id='$id'");
      $row = mysqli_fetch_array($result);

      if($row['password'] == $old){
            //connection to server to update
             $sqli = "UPDATE `staff_db` SET password ='$new' WHERE id='$id'";
            $results=mysqli_query($conn, $sqli);

            if($results)
            {
                echo "success";
            }
     
            else{
                echo "failed";
            }
      }
      else{
        echo "old pass wrong";
      }


    mysqli_close($conn);

?>