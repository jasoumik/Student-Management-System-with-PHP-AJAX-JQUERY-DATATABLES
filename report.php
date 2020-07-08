<?php
//$msg='';
if(isset($_GET["action"])){
    include('database_connection.php');
    require_once'pdf.php';
    session_start();
    $output='';
    if($_GET["action"]=="attendance_report"){
        if(isset($_GET["from_date"],$_GET["to_date"])){
            $pdf=new Pdf();
            $query="SELECT attendance_date FROM attendance_table WHERE teacher_id = 
            '".$_SESSION["teacher_id"]."' AND (attendance_date BETWEEN '".$_GET["from_date"]."' AND
            '".$_GET["to_date"]."')
            GROUP BY attendance_date
            ORDER BY attendance_date ASC
            ";
            $statement=$connect->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $output .='
            <style>
            @page{margin:20px;}
            </style>
            <p>&nbsp;</p>
            <h3 align="center">Attendance Report</h3><br>
            ';
            foreach($result as $row){
               $output .= '<table width="100%" border="0" cellpadding="5" cellspacing="0">
               <tr>
               <td>
               <b>Date-'.$row["attendance_date"].'</b>
               </td>
               </tr>
               <tr>
                <td>
                <table width="100%" border="1" cellpadding="5" cellspacing="0">
                <tr>
                <td><b>Student Name</b></td>
                <td><b>Roll Number</b></td>
                <td><b>Grade</b></td>
                <td><b>Attendance Status</b></td>
                </tr>
                ';
                $sub_query="
                SELECT * FROM attendance_table 
       INNER JOIN student_table ON student_table.stdnt_id = attendance_table.stdnt_id
       INNER JOIN grade_table ON grade_table.grade_id = student_table.stdnt_grade_id 
       WHERE teacher_id = '".$_SESSION["teacher_id"]."' AND attendance_date='".$row
       ["attendance_date"]."'
                ";
                $statement=$connect->prepare($sub_query);
                $statement->execute();
                $sub_result= $statement->fetchAll();
                foreach($sub_result as $sub_row){
                    $output .= '<tr>
                    <td>'.$sub_row["stdnt_name"].'</td>
                    <td>'.$sub_row["roll_number"].'</td>
                    <td>'.$sub_row["grade_name"].'</td>

                    <td>'.$sub_row["attendance_status"].'</td>
                    </tr> ';
                }
               $output .=' 
                </table>
                </td>
               </tr>
               </table> <br>';
            }
            $file_name=md5(rand()).'.pdf';
            $html_code=$output;
            $pdf=new Pdf();
            $pdf->loadHtml($html_code);
            $pdf->render();
            $pdf->stream($file_name,array("Attachment"=>false));
            $file=$pdf->output();
            file_put_contents($file_name,$file);
           exit(0);
    
            $myquery ="SELECT * FROM teacher_table WHERE teacher_id = 
            ".$_SESSION["teacher_id"]."";
            $statement2= $connect->query($myquery);
            foreach($statement2 as $row){
             $newname = $row['teacher_name'];
             $newemail=$row['teacher_emailid'];
            }
        require 'PHPMailer/PHPMailerAutoload.php';
        $mail = new PHPMailer;
    
        $mail->Host='mail.jasoumik.com';
        $mail->Port= 465;
        $mail->SMTPAuth=true;
        $mail->SMTPSecure='ssl';
        $mail->Username='info@jasoumik.com';
        $mail->Password='Gp@16684803';
        
    
        $mail->setFrom($newemail,$newname);
        $mail->addAddress('info@jasoumik.com');
        $mail->addReplyTo($newemail,$newname);
      
        $mail->isHTML(true);
        $mail->AddAttachment($file_name);   
        $mail->Subject = 'Student Details(Date-wise)';
        $mail->Body = 'Please Find Students details in attached PDF File.';
    
        if($mail->send()){
            $msg = '<label class="text-success">Report has been sent successfully</label>';
        }
        unlink($file_name);
        
            // $file_name='Attendance_report.pdf';
            // $pdf->loadHtml($output);
            // $pdf->render();
            // $pdf->stream($file_name,array("Attachment"=>false));
            // exit(0);
        }
    }
    if($_GET["action"]=="student_report"){
        if(isset($_GET["student_id"],$_GET["from_date"],$_GET["to_date"])){
            $pdf = new Pdf();
            $query ="
            select * from student_table inner join grade_table on grade_table.grade_id
            =student_table.stdnt_grade_id where student_table.stdnt_id='".$_GET["student_id"]."'
            ";
            $statement =$connect->prepare($query);
            $statement->execute();
            $result= $statement->fetchAll();
            foreach($result as $row){
                $output .='
                <style>
                @page{margin:20px;}
                </style>
                <p>&nbsp;</p>
                <h3 align="center">Attendance Report</h3> <br> <br>
                <table width="100%" border="0" cellpadding="5" cellspacing="0">
                <tr>
                <td width="25%"><b>Student Name</b></td>
                <td width="75%">'.$row["stdnt_name"].'</td>
                </tr>
                <tr>
                <td width="25%"><b>Roll Number</b></td>
                <td width="75%">'.$row["roll_number"].'</td>
                </tr>
                <tr>
                <td width="25%"><b>Grade</b></td>
                <td width="75%">'.$row["grade_name"].'</td>
                </tr>
                <tr>
                <td colspan="2" height="5">
                <h3 align="center">Attendance Details</h3>
                </td>
                </tr>
                <tr>
                <td colspan="2">
                <table width="100%" border="1" cellpadding="5" cellspacing="0">
                <tr>
                <td><b>Attendance Date</b></td>
                <td><b>Attendance Status</b></td>
                </tr>
                ';
                $sub_query ="select * from attendance_table where stdnt_id
                ='".$_GET["student_id"]."' and (attendance_date between
                 '".$_GET["from_date"]."' and '".$_GET["to_date"]."')
                  order by attendance_date asc ";
                 $statement=$connect->prepare($sub_query);
                 $statement->execute();
                 $sub_result = $statement->fetchAll();
                 foreach($sub_result as $sub_row){
                     $output .='<tr>
                     <td>'.$sub_row["attendance_date"].'</td>
                     <td>'.$sub_row["attendance_status"].'</td>
                     </tr> ';
                 }
                 $output .='</table>
                 </td>
                 </tr>
                 </table>';
                 $file_name ='Attendance Report(student_wise)';
                 $pdf->loadHtml($output);
                 $pdf->render();
                 $pdf->stream($file_name,array("Attachment"=>false));
                 exit(0);
            }
        }
    }
}
?>