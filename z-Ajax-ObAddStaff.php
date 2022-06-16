<?php
session_start();
require_once "Z-connection.php";
date_default_timezone_set('Asia/Manila');

$fname = mysqli_real_escape_string($conn, $_POST['fname_addEmp']);
$mname = mysqli_real_escape_string($conn, $_POST['mname_addEmp']);
$lname = mysqli_real_escape_string($conn, $_POST['lname_addEmp']);
$reg = mysqli_real_escape_string($conn, $_POST['reg']);
$street = mysqli_real_escape_string($conn, $_POST['street']);
$bar = mysqli_real_escape_string($conn, $_POST['bar']);
$mun = mysqli_real_escape_string($conn, $_POST['mun']);
$prov = mysqli_real_escape_string($conn, $_POST['prov']);
$religion = mysqli_real_escape_string($conn, $_POST['religion_addEmp']);
$bday = mysqli_real_escape_string($conn, $_POST['bday_addEmp']);
$age = mysqli_real_escape_string($conn, $_POST['age_addEmp']);
$civil = mysqli_real_escape_string($conn, $_POST['civil_addEmp']);
$contact = mysqli_real_escape_string($conn, $_POST['contact_addEmp']);
$email = mysqli_real_escape_string($conn, $_POST['email_addEmp']);
$sched = mysqli_real_escape_string($conn, $_POST['sched_input']);
$role = mysqli_real_escape_string($conn, $_POST['role_addEmp']);
$photo = mysqli_real_escape_string($conn, $_POST['pic_inpkey']);
$time1 = mysqli_real_escape_string($conn, $_POST['time1']);
$time2 = mysqli_real_escape_string($conn, $_POST['time2']);


$time1 = date("h:i a", strtotime($time1));
$time2 = date("h:i a", strtotime($time2));

$time = $time1." - ".$time2;
$stat = "Active";
$username = $email;
$pass = $contact;

$dateToday = date("Y-m-d");

$id = "";

$today2digits = explode('-', $dateToday);
$bday2digits = explode('-', $bday);
$year2digits = substr($bday2digits[2], -2);

$xml = new DOMDocument();
$xml->load("staff.xml");
$users = $xml->getElementsByTagName("user");
foreach($users as $user){
   $ctr = $user->getAttribute("username");
}


if($role == "Ob-Gyne"){
    $id = "OB-".$today2digits[2].$today2digits[1]."-".$year2digits."-".$ctr;
}
else{
    $id = "MW-".$today2digits[2].$today2digits[1]."-".$year2digits."-".$ctr;
}


    //checking if email already exist
    $s_email = "SELECT * FROM `staff_db` WHERE email='$email'";
    $result_email = mysqli_query($conn, $s_email);
    $num_email = mysqli_num_rows($result_email); 
  
    if($num_email == 1){
        echo "failed";
    }
    else{
        mysqli_query($conn, "INSERT INTO staff_db (id,fname, mname, lname,  reg, street, bar, mun, prov, civil_status, religion, phone, email, birthday, age, username, password, role, schedule, time, profile_photo, date_start, status) VALUES('" .$id."', '".$fname."', '".$mname."', '".$lname."' , '".$reg."', '".$street."', '".$bar."', '".$mun."', '".$prov."', '" .$civil. "', '" .$religion. "', '" .$contact. "', '" . $email . "', '" . $bday . "', '" . $age . "', '" . $username . "', '" . $pass . "', '" . $role. "', '" . $sched. "' , '" . $time. "' , '" . $photo. "' , '" . $dateToday. "' , '" . $stat. "' )");


        $xml1 = new DOMDocument;
        $xml1 ->load("staff.xml");
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
                $xml->save("staff.xml");
                break;             
        }

        echo "success";

$key_nameAudit = $_SESSION["auditname"];
$dateTodayAudit = date("Y-m-d");
$timeAudit = date("h:i A");
$dateTimeAudit = $dateTodayAudit." ".$timeAudit;
$descriptionAudit = $key_nameAudit." added a staff.";

mysqli_query($conn, "INSERT INTO audit_tb (date, name, description) VALUES('".$dateTimeAudit."', '".$key_nameAudit."', '".$descriptionAudit."')");
    }


mysqli_close($conn);
?>