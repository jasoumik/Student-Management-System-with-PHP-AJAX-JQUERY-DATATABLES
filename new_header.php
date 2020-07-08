<?php

include('database_connection.php');
session_start();
if (!isset($_SESSION["teacher_id"])) {
    header('location:teacher_login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">-->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script> -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
  <link rel="stylesheet" href="bootstrap.css">
    <title>Student Attendance Management System </title>
</head>
<body>
   <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
   <a href="new_index.php" class="navbar-brand">Home</a>
   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
   <span class="navbar-toggler-icon"></span>
   </button>
   <div class="collapse navbar-collapse" id="collapsibleNavbar">
   <ul class="navbar-nav">
   <li class="nav-item">
   <a href="teacher_profile.php" class="nav-link">Profile</a>
   </li>
   <li class="nav-item">
   <a href="attendance.php" class="nav-link">Attendance</a>
   </li>
   <!-- <li class="nav-item">
   <a href="sendReport.php" class="nav-link">Send Report to Admin</a>
   </li> -->
   <li class="nav-item">
   <a href="teacher_logout.php" class="nav-link">Logout</a>
   </li>
   </ul>
   
   </div>
   
   </nav>
</body>
</html>