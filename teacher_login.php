<?php
include('database_connection.php');
session_start();
if(isset($_SESSION["teacher_id"])){
    header('location:new_index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="bootstrap.css">
  <!-- <script src="bootstrap.js"></script> -->
  <!-- <script src="bootstrap.bundle.js"></script> -->
  <script src="teacher_login.js"></script>
    <title>Student Attendance System in PHP using AJAX</title>
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
<div class="card-header">Teacher Login</div>
<div class="card-body">
<form method="post" id="teacher_login_form">

<div class="form-group">
<label for="">Enter Email Address</label>
<input type="text" name="teacher_emailid" id="teacher_emailid" class="form-control">
<span id="error_teacher_emailid" class="text-danger"></span>
</div>

<div class="form-group">
<label for="">Enter Password</label>
<input type="text" name="teacher_password" id="teacher_password" class="form-control">
<span id="error_teacher_password" class="text-danger"></span>
</div>

<div class="form-group">
<input type="submit" name="teacher_login" id="teacher_login" class="btn btn-info" value="Login">
</div>

<!-- <div class="form-group">
<input type="button" name="reset" id="reset" class="btn btn-danger" value="Reset Password">
</div> -->

<div class="form-group">
<a href="new_reg.php" class="btn btn-danger"> New Teacher Registration</a>
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