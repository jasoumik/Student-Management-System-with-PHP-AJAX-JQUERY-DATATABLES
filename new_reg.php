
<?php
include('database_connection.php');
use Svg\Tag\Path;

// global $emailTo;
// global $name1;
$emailTo=$_POST['tcrmail'];
$name1=$_POST['tcrname'];

$result="";
if(isset($_POST['reqmail'])){
	require 'PHPMailer/PHPMailerAutoload.php';
	$mail = new PHPMailer;

	$mail->Host='mail.jasoumik.com';
	$mail->Port= 465;
	$mail->SMTPAuth=true;
	$mail->SMTPSecure='ssl';
	$mail->Username='info@jasoumik.com';
	$mail->Password='Gp@16684803';


	$mail->setFrom($_POST['tcrmail'],$_POST['tcrname']);
	$mail->addAddress('info@jasoumik.com');
	$mail->addReplyTo($_POST['tcrmail'],$_POST['tcrname']);
  
	$mail->isHTML(true);
	$mail->Body='<h1 align=center>Name: '.$_POST['tcrname'].'<br>Email: '
	.$_POST['tcrmail'].'</h1>';

	if(!$mail->send()){
		$result = "Something Wrong. Try again,Please.";
	}
	else{
		$result="Thanks ".$_POST['tcrname'].
		" for connecting with us. We have sent you an password link.";
		
    }
    
   
    $email = new PHPMailer();
    
    $code=uniqid(true);
    $query = "
               INSERT INTO reset_pass(code,email)
               VALUES(?,?)
               ";
               $statement= $connect->prepare($query);
               $statement->execute([$code,$emailTo]);
  $email->SetFrom('info@jasoumik.com', 'Jarif Ahmed Soumik'); 
$email->Subject   = 'Greetings!!!';
$url="https://project.jasoumik.com/reset_pass.php?code=$code";
$email->isHTML(true);
$email->Body      = "

    <p  align='center' style='color: brown;
            margin-top: 30px;
      padding: 5px 0;
    border: 8px solid rgb(22, 174, 235);
    text-align: center;
    font-size:xx-large;'>Thanks for your request <br>
        We have sent you <a href='$url'>password link</a> <br>
        
        <br>
        <br>
        For queries : info@jasoumik.com
    </p>";
$email->AddAddress($_POST['tcrmail'],$_POST['tcrname'] );



$email->AddAttachment( "welcm.jpg" );

 $email->Send();
	// $to=$_POST['email'];
	// $msg='Thank you. We have Received your mail. Stay Connected .'.$att.' ';
	// $text1="From: info@jasoumik.com ";
	// $att=$mail->AddAttachment("welcm.jpg");
	// mail($to,$text1,$att);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Teacher Registration</title>
    <link rel="stylesheet" href="bootstrap.css">
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
<div class="card-header">Teacher Password Request</div>
<div class="card-body">
  
<form method="post" id="teacher_login_form">
<h1 class="text-center text-success"><?php echo $result;  ?></h1>

<div class="form-group">
<br>
<label for="">Enter Your Name</label>
<input type="text" name="tcrname" id="tcrname" class="form-control">

</div>

<div class="form-group">
<br>
<label for="">Enter Your Email Address</label>
<input type="text" name="tcrmail" id="tcrmail" class="form-control">

</div>



<div class="form-group">
<input type="submit" name="reqmail" id="" class="btn btn-info" 
value="Password Request">
</div>



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