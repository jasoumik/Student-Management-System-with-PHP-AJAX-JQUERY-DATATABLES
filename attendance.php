<?php
include('new_header.php');


// $msg='';
   
// if(isset($_POST["create_admin_report"])){
//     if(isset($_POST["from_date"],$_POST["to_date"])){
       
//         $query="SELECT attendance_date FROM attendance_table WHERE teacher_id = 
//         '".$_SESSION["teacher_id"]."' AND (attendance_date BETWEEN '".$_POST["from_date"]."' AND
//         '".$_POST["to_date"]."')
//         GROUP BY attendance_date
//         ORDER BY attendance_date ASC
//         ";
//         $statement=$connect->prepare($query);
//         $statement->execute();
//         $result = $statement->fetchAll();
//         $output .='
//         <style>
//         @page{margin:20px;}
//         </style>
//         <p>&nbsp;</p>
//         <h3 align="center">Attendance Report</h3><br>
//         ';
//         foreach($result as $row){
//            $output .= '<table width="100%" border="0" cellpadding="5" cellspacing="0">
//            <tr>
//            <td>
//            <b>Date-'.$row["attendance_date"].'</b>
//            </td>
//            </tr>
//            <tr>
//             <td>
//             <table width="100%" border="1" cellpadding="5" cellspacing="0">
//             <tr>
//             <td><b>Student Name</b></td>
//             <td><b>Roll Number</b></td>
//             <td><b>Grade</b></td>
//             <td><b>Attendance Status</b></td>
//             </tr>
//             ';
//             $sub_query="
//             SELECT * FROM attendance_table 
//    INNER JOIN student_table ON student_table.stdnt_id = attendance_table.stdnt_id
//    INNER JOIN grade_table ON grade_table.grade_id = student_table.stdnt_grade_id 
//    WHERE teacher_id = '".$_SESSION["teacher_id"]."' AND attendance_date='".$row
//    ["attendance_date"]."'
//             ";
//             $statement=$connect->prepare($sub_query);
//             $statement->execute();
//             $sub_result= $statement->fetchAll();
//             foreach($sub_result as $sub_row){
//                 $output .= '<tr>
//                 <td>'.$sub_row["stdnt_name"].'</td>
//                 <td>'.$sub_row["roll_number"].'</td>
//                 <td>'.$sub_row["grade_name"].'</td>

//                 <td>'.$sub_row["attendance_status"].'</td>
//                 </tr> ';
//             }
//            $output .=' 
//             </table>
//             </td>
//            </tr>
//            </table> <br>';
//         }

       
     
//         include('pdf.php');
//         $pdf=new Pdf();
//         $file_name=md5(rand()).'.pdf';
//         $html_code=$output;
//         $pdf=new Pdf();
//         $pdf->loadHtml($html_code);
//         $pdf->render();
//         $file=$pdf->output();
//         file_put_contents($file_name,$file);

//         $myquery ="SELECT * FROM teacher_table WHERE teacher_id = 
//         ".$_SESSION["teacher_id"]."";
//         $statement2= $connect->query($myquery);
//         foreach($statement2 as $row){
//          $newname = $row['teacher_name'];
//          $newemail=$row['teacher_emailid'];
//         }
//     require 'PHPMailer/PHPMailerAutoload.php';
// 	$mail = new PHPMailer;

// 	$mail->Host='mail.jasoumik.com';
// 	$mail->Port= 465;
// 	$mail->SMTPAuth=true;
// 	$mail->SMTPSecure='ssl';
// 	$mail->Username='info@jasoumik.com';
//     $mail->Password='Gp@16684803';
    

// 	$mail->setFrom($newemail,$newname);
// 	$mail->addAddress('info@jasoumik.com');
// 	$mail->addReplyTo($newemail,$newname);
  
//     $mail->isHTML(true);
//     $mail->AddAttachment($file_name);   
//     $mail->Subject = 'Student Details(Date-wise)';
//     $mail->Body = 'Please Find Students details in attached PDF File.';

// 	if($mail->send()){
// 		$msg = '<label class="text-success">Report has been sent successfully</label>';
// 	}
//     unlink($file_name);
//     }
// }
// // if(isset($_POST["create_admin_report"])){
// // if(isset($_POST["from_date"],$_POST["to_date"])){


// //    //function student_details($connect){
// //         $query1="SELECT attendance_date FROM attendance_table WHERE teacher_id = 
// //        '".$_SESSION["teacher_id"]."' AND (attendance_date BETWEEN '".$_POST["from_date"]."' AND
// //       '".$_POST["to_date"]."') 
// //         GROUP BY attendance_date
// //         ORDER BY attendance_date ASC
// //         ";
// //         $statement0=$connect->query($query1);
  
// //         $output .='
// //         <style>
// //         @page{margin:20px;}
// //         </style>
// //         <p>&nbsp;</p>
// //         <h3 align="center">Attendance Report</h3><br>
        
// //         ';
// //         foreach($statement0 as $row){
// //            $output .= '<table width="100%" border="0" cellpadding="5" cellspacing="0">
// //            <tr>
// //            <td>
// //            <b>Date-'.$row["attendance_date"].'</b>
// //            </td>
// //            </tr>
// //            <tr>
// //             <td>
// //             <table width="100%" border="1" cellpadding="5" cellspacing="0">
// //             <tr>
// //             <td><b>Student Name</b></td>
// //             <td><b>Roll Number</b></td>
// //             <td><b>Grade</b></td>
// //             <td><b>Attendance Status</b></td>
// //             </tr>
// //             ';
// //             $sub_query1="SELECT * FROM attendance_table 
// //    INNER JOIN student_table ON student_table.stdnt_id = attendance_table.stdnt_id
// //    INNER JOIN grade_table ON grade_table.grade_id = student_table.stdnt_grade_id 
// //    WHERE teacher_id = '".$_SESSION["teacher_id"]."' AND attendance_date='".$row
// //    ["attendance_date"]."'
// //             ";
// //             $statement1=$connect->query($sub_query1);
           
// //             foreach($statement1 as $sub_row){
// //                 $output .= '<tr>
// //                 <td>'.$sub_row["stdnt_name"].'</td>
// //                 <td>'.$sub_row["roll_number"].'</td>
// //                 <td>'.$sub_row["grade_name"].'</td>

// //                 <td>'.$sub_row["attendance_status"].'</td>
// //                 </tr> ';
// //             }
// //            $output .=' 
// //             </table>
// //             </td>
// //            </tr>
// //            </table> <br>';
// //            return $output;
// //         }
// //       // }

        
   
       
      
        
       
    
// //}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="attendance.js"></script>
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
<div class="container" style="margin-top: 30px">
<div class="card">
<div class="card-header">
<div class="row">
<div class="col-md-9">Attendance List</div>
<div class="col-md-3" align="right">

<button id="report_button" type="button" class="btn btn-danger btn-sm">Report</button>
    <button id="add_button" type="button" class="btn btn-info btn-sm">Add</button>
</div>
</div>
</div>

 <div class="card-body">
     <div class="table-responsive">
         <span id="message_operation"></span>
    <table id="attendance_table" class="table table-striped table-bordered" >
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Roll number</th>
                <th>Grade</th>
                <th>Attendance Status</th>
                <th>Attendance date</th>
            </tr>
        </thead>
        <tbody>
      
        </tbody>
    </table>
     </div>
 </div>

</div>
</div>

<?php

$query = "SELECT * FROM grade_table WHERE grade_id = (SELECT teacher_grade_id 
FROM teacher_table WHERE 
teacher_id ='".$_SESSION["teacher_id"]."')";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();

?>

<!-- add button modal -->
<div class="modal" id="formModal">
    <div class="modal-dialog">
        <form id="attendance_form" method="post">
        <div class="modal-content">
<!-- modal header -->
<div class="modal-header">
    <h4 class="modal-title" id="modal_title"></h4>
    <button class="close" data-dismiss="modal" type="button">&times;</button>
</div>
<!-- modal body -->
<div class="modal-body">
<?php
foreach($result as $row){
    ?>
    <div class="form-group">
        <div class="row">
            <label for="" class="col-md-4 text-right">Grade <span class="text-danger">*
            </span></label>
            <div class="col-md-8">
                <?php
                echo '<label>'.$row["grade_name"].'</label>';
                ?>
            </div>
        </div>
    </div>
    <div class="form-group">
    <div class="row">
    <label class="col-md-4 text-right">Attendance date <span class="text-danger">*
    </span></label>
    <div class="col-md-8">
    <input type="text" name="attendance_date" id="attendance_date" class="form-control" readonly>
    <span id="error_attendance_date" class="text-danger"></span>
    </div>
    </div>
    </div>

    <div class="form-group" id="student_details">
    <div class="table-responsive">
    <table class="table table-striped table-bordered">
    <thead>
    <tr>
    <th>Roll No.</th>
    <th>Student name</th>
    <th>Present</th>
    <th>Absent</th>
    </tr>
    </thead>
    <?php
     $sub_query ="
     SELECT * FROM student_table WHERE stdnt_grade_id='".$row["grade_id"]."'
     ";
     $statement=$connect->prepare($sub_query);
     $statement->execute();
     $student_result= $statement->fetchAll();
     foreach($student_result as $student){
        ?> 
        <tr>
        <td><?php echo $student["roll_number"]?></td>
        <td>
            <?php echo $student["stdnt_name"]; ?>
            <input type="hidden" name="student_id[]" value="<?php echo $student["stdnt_id"]; ?>" >
        </td>
        <td align="center">
            <input type="radio" name="attendance_status<?php echo $student["stdnt_id"]; ?>" 
            value="Present" >
        </td>
        <td align="center">
            <input type="radio" name="attendance_status<?php echo $student["stdnt_id"]; ?>" 
            checked value="Absent"> 
        </td>
       </tr>

    <?php
     }
     ?>

    </table>
    </div>
    </div>
    
  <?php
  }
  ?>
</div>

<!-- modal footer -->
<div class="modal-footer">
    <input type="hidden" name="attendance_id" id="attendance_id" >
    <input type="hidden" name="action" id="action" value="Add">
    <input type="submit" name="button_action" id="button_action"
    class="btn btn-success btn-sm" value="Add">
    <button class="btn btn-danger btn-sm" type="button" data-dismiss="modal">Close</button>
</div>

       </div>
       </form>
    </div>
</div>


<!-- Report Modal -->
<div class="modal" id="reportModal">
  <div class="modal-dialog">
    <div class="modal-content">
        <!-- header -->
      <div class="modal-header">
        <h4 class="modal-title">Make Report</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
     
        <div class="form-group">
        <div id="input-daterange">
            <form method="post">
            <input type="text" class="form_control" name="from_date" id="from_date" placeholder="From Date" readonly>
            <span id="error_from_date" class="text-danger"></span> <br>
            <input type="text" class="form_control" name="to_date" id="to_date" placeholder="To Date" readonly>
            <span id="error_to_date" class="text-danger"></span> <br>
            </form>
        </div>
        </div>
      </div>
      
      <div class="modal-footer">
          <input type="hidden" name="student_id" id="student_id" >
          <!-- <form method="post">
          <button type="submit" name="create_admin_report" id="create_admin_report" class="
          btn btn-danger btn-sm">Send Report to Admin</button>
          </form> -->
          <button type="button" name="create_report" id="create_report" class="
          btn btn-success btn-sm">Create Report & Send Report to Admin</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</body>
</html>

