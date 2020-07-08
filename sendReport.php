<?php
include('new_header.php');





//if(isset($_POST["from_date"],$_POST["to_date"])){


   //function student_details($connect){
        $query1="SELECT attendance_date FROM attendance_table WHERE teacher_id = 
       '".$_SESSION["teacher_id"]."' AND (attendance_date BETWEEN '".$_POST["from_date"]."' AND
      '".$_POST["to_date"]."') 
        GROUP BY attendance_date
        ORDER BY attendance_date ASC
        ";
        $statement0=$connect->query($query1);
  
        $output .='
        <style>
        @page{margin:20px;}
        </style>
        <p>&nbsp;</p>
        <h3 align="center">Attendance Report</h3><br>
        ';
        foreach($statement0 as $row){
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
            $sub_query1="SELECT * FROM attendance_table 
   INNER JOIN student_table ON student_table.stdnt_id = attendance_table.stdnt_id
   INNER JOIN grade_table ON grade_table.grade_id = student_table.stdnt_grade_id 
   WHERE teacher_id = '".$_SESSION["teacher_id"]."' AND attendance_date='".$row
   ["attendance_date"]."'
            ";
            $statement1=$connect->query($sub_query1);
           
            foreach($statement1 as $sub_row){
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
           return $output;
        }
      // }

        $msg='';
        if(isset($_POST["create_admin_report"])){
        include('pdf.php');
   
        $file_name=md5(rand()).'.pdf';
        $html_code=$output;
        $pdf=new Pdf();
        $pdf->loadHtml($html_code);
        $pdf->render();
        $file=$pdf->output();
        file_put_contents($file_name,$file);
       
        $myquery ="SELECT * FROM teacher_table WHERE teacher_id = 
        '".$_SESSION["teacher_id"]."'";
        $statement2= $connect->query($myquery);
        foreach($statement2 as $row){
         $newname = $row['teacher_name'];
         $newemail=$row['teacher_emailid'];
        }
    
    require 'PHPMailer/class.phpmailer.php';
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
    }
//}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Report to Admin</title>
    <script src="sendReport.js"></script>
    <link rel="stylesheet" href="bootstrap.css">
    <script type="text/javascript" src="https://www.eyecon.ro/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <link rel="stylesheet" href="https://www.eyecon.ro/bootstrap-datepicker/css/datepicker.css" />
    <style>
    .datepicker
    {
      z-index: 1600 !important; /* has to be larger than 1050 */
    }
</style>
</head>
<body>

      <div class="jumbotron text-center" style="margin-bottom:0">
<h1>Student Attendance System</h1>
</div>

<div class="container" >
<div class="row">
<div class="col-md-4">
</div>
<div class="col-md-4" style="margin-top:20px;">
<div class="card">
<div class="card-header">Send Report to Admin</div>
<div class="card-body">
<form method="post" id="">
<!-- <h1 class="text-center text-success"><?php echo $msg;  ?></h1> -->
<div class="form-group">
<div id="input-daterange">
<input type="date" class="form_control" name="from_date" id="from_date" 
placeholder="From Date" readonly>
            <span id="error_from_date" class="text-danger"></span> <br>

<input type="date" class="form_control" name="to_date" id="to_date" 
placeholder="To Date" readonly>
            <span id="error_to_date" class="text-danger"></span> <br>
</div>
</div>

<div class="form-group">
<input type="submit" name="create_admin_report" id="create_admin_report" 
class="btn btn-danger btn-sm" value="Send">
<!-- <button type="submit" name="create_admin_report" id="create_admin_report" class="
            btn btn-danger btn-sm">Send Report to Admin</button> -->
</div>

<!-- <div class="form-group">
<input type="button" name="reset" id="reset" class="btn btn-danger" value="Reset Password">
</div> -->

<!-- <div class="form-group">
<a href="new_reg.php" class="btn btn-danger"> New Teacher Registration</a>
</div> -->


</form>
</div>
<a href="index.php" class="alert alert-success">Go Back to Home</a>
</div>
</div>
<div class="col-md-4">
</div>
</div>
</div>
</body>
</html>