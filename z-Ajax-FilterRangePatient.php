<?php  
 //filter.php  
 if(isset($_POST["from_date"], $_POST["to_date"]))  
 {  
    $servername='localhost';
    $username='root';
    $password='';
    $dbname = "robles_db";
    $connect=mysqli_connect($servername,$username,$password,"$dbname");
      $output = '';  
      $query = "SELECT * FROM patientinfo_db WHERE date_added BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."'";  
      $result = mysqli_query($connect, $query);  
      $output .= '  
            <table id="table_patientInfo">
                <thead>
                    <tr> 
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>     
                        <th></th>                             
                    </tr>
                </thead>
            ';  
      if(mysqli_num_rows($result) > 0)  
      {  
         $sr = 0; 
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '  
                <tr>  
                    <td>'.$row['id'].'&nbsp;&nbsp;</td>    
                    <td>'.$row['lname'].'&nbsp;&nbsp;</td>  
                    <td>'.$row['fname'].'&nbsp;&nbsp;</td>  
                    <td>'.$row['mname'].'&nbsp;&nbsp;</td>  
                    <td>'.$row['date_added'].'&nbsp;&nbsp;</td>  
                    <td>'.$row['barangay'].", ".$row['municipality'].", ".$row['province'].'</td>  
                    <td class="hover_table_pending" style="padding-left:10%;"> 
                        <button id="view_btn" title="View" onclick="viewPatient_doctorAcc1()"><img src="images/icons/dashboard/view_icon.png"/></button>
                        <button id="report_btn" title="Make Report" style="background-color:#5FB1F2;"><img src="images/icons/dashboard/report.png"/></button>
                    </td>    
                </tr>  
                <script type="text/javascript">
                function viewPatient_doctorAcc1(){
                    valkey ='.$row['id'].'
                    xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = () =>{
                        if(xhr.readyState == 4 && xhr.status == 200){
                           if(xhr.responseText == "success"){
                               window.location.href = "doctorViewPatientInfo.php"
                            }
                        }
                    };
                
                    xhr.open("GET", "z-Ajax-AdminViewPatient.php?key=" +valkey, true);
                    xhr.send();
                }
                
                </script>
                ';  
                $sr++;
           }  
      }  
      $output .= '</table>';  
      echo $output;  
 }  
 ?>




            