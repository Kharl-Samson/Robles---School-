<?php
session_start();
require_once "Z-connection.php";
date_default_timezone_set('Asia/Manila');

$fname = mysqli_real_escape_string($conn, $_POST['fname']);
$mname = mysqli_real_escape_string($conn, $_POST['mname']);
$lname = mysqli_real_escape_string($conn, $_POST['lname']);
$reg = mysqli_real_escape_string($conn, $_POST['reg']);
$street = mysqli_real_escape_string($conn, $_POST['street']);
$bar = mysqli_real_escape_string($conn, $_POST['bar']);
$mun = mysqli_real_escape_string($conn, $_POST['mun']);
$prov = mysqli_real_escape_string($conn, $_POST['prov']);
$bday = mysqli_real_escape_string($conn, $_POST['bday']);
$age = mysqli_real_escape_string($conn, $_POST['age']);
$weight = mysqli_real_escape_string($conn, $_POST['weight']);
$religion = mysqli_real_escape_string($conn, $_POST['religion']);
$age = mysqli_real_escape_string($conn, $_POST['age']);
$civil = mysqli_real_escape_string($conn, $_POST['civil_status']);
$contact = mysqli_real_escape_string($conn, $_POST['contact']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$username = $email;
$pass = $contact;

$genderOB = mysqli_real_escape_string($conn, $_POST['gender_obHist1']);
$bdayOB = mysqli_real_escape_string($conn, $_POST['bday_obHist1']);
$bplaceOB = mysqli_real_escape_string($conn, $_POST['bplace_obHist1']);
$weightOB = mysqli_real_escape_string($conn, $_POST['weight_obHist1']);
$delOB = mysqli_real_escape_string($conn, $_POST['delivery_obHist1']);
$birthOB = mysqli_real_escape_string($conn, $_POST['type_obHist1']);

$dateToday = date("Y-m-d");

         $xml = new DOMDocument();
         $xml->load("patientCTR.xml");
         $users = $xml->getElementsByTagName("user");
         foreach($users as $user){
            $ctr = $user->getAttribute("username");
         }

//id
$year = date("Y");
$yeartoday2 = substr($year , -2);
$bday2digits = explode('-', $bday);
$year2Bday = substr($bday2digits[0] , -2);

$id = "RM".$yeartoday2."-".$bday2digits[1].$bday2digits[2]."-".$year2Bday."-".$ctr;

    //checking if email already exist
    $s_email = "SELECT * FROM `patientinfo_db` WHERE email='$email'";
    $result_email = mysqli_query($conn, $s_email);
    $num_email = mysqli_num_rows($result_email); 
  
    if($num_email == 1){
        echo "failed";
    }
    else{
        mysqli_query($conn, "INSERT INTO patientinfo_db (id, fname, mname, lname,  region, street, barangay, municipality, province, bday, age, weight, religion, civilstatus, contact, email, username, password, date_added, gender_ob, bday_ob, bplace_ob,weight_ob, delivery_ob, birth_ob) VALUES('".$id."', '".$fname."', '".$mname."', '".$lname."' , '".$reg."', '".$street."', '".$bar."', '".$mun."', '".$prov."', '" . $bday. "', '" . $age . "', '" . $weight . "', '" . $religion . "', '" . $civil . "', '" . $contact . "', '" . $email . "', '" . $email . "', '" . $contact. "', '" . $dateToday. "' , '" . $genderOB . "' , '" . $bdayOB . "', '" . $bplaceOB . "' , '" . $weightOB . "', '" . $delOB . "', '" . $birthOB . "'    )");

        $key_nameAudit = $_SESSION["auditname"];
        $dateTodayAudit = date("Y-m-d");
        $timeAudit = date("h:i A");
        $dateTimeAudit = $dateTodayAudit." ".$timeAudit;
        $descriptionAudit = $key_nameAudit." added a new patient.";
        
        mysqli_query($conn, "INSERT INTO audit_tb (date, name, description) VALUES('".$dateTimeAudit."', '".$key_nameAudit."', '".$descriptionAudit."')");
         
        $xml1 = new DOMDocument;
        $xml1 ->load("patientCTR.xml");
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
                $xml->save("patientCTR.xml");
                break;             
        }

        echo "success";
    }


mysqli_close($conn);
?>