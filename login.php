<?php

include('database_connection.php');
session_start();
if (isset($_SESSION["admin_id"])) {
    header('location:index1.php');
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
  <script src="login.js"></script>
  
    <title>Student Attendance System in PHP using Ajax </title>
</head>
<body>
   <div class="jumbotron text-center" style="margin-bottom:0">
   <h1>Student Attendance System</h1>
   </div> 
     <div class="container">
     <div class="row">
     <div class="col-md-4">
     
     </div>
     <div class="col-md-4" style="margin-top:20px;">
     <div class="card">
     <div class="card-header">Admin Login</div>
      <div class="card-body">
      <form method="post" id="admin_login_form">
      <div class="form-group">
      <label for="">Enter Username</label>
      <input type="text" name="admin_user_name" id="admin_user_name" class="form-control">
      <span id="error_admin_user_name" class="text-danger"></span>
      </div>
      <div class="form-group">
      <label for="">Enter Password</label>
      <input type="text" name="admin_password" id="admin_password" class="form-control">
      <span id="error_admin_password" class="text-danger"></span>
      </div>
      <div class="form-group">
      
      <input type="submit" name="admin_login" id="admin_login" class="btn btn-info" value="Login">
      
      </div>
      </form>
      </div>
     </div>
     </div>
     <div class="col-md-4"></div>
     </div>
     </div>

</body>
</html>

<!-- <script>

$(document).ready(function(){
    $('#admin_login_form').on('submit',function(event){
     event.preventDefault();
     console.log($(this).serialize());
     $.ajax({
         url:"check_admin_login.php",
         method: "POST",
         data:$(this).serialize(),
         dataType:"json",
         beforeSend:function(){
             $('#admin_login').val('validate...');
             $('#admin_login').attr('disabled','disabled');
         },
         success: function(data){
               if(data.success){
                   location.href="<?php echo $base_url; ?>"+ "teacherManagement" ;
               }
               if (data.error) {
                   $('#admin_login').val('Login');
                   $('#admin_login').attr('disabled',false);
                   if (data.error_admin_user_name!='') {
                       $('#error_admin_user_name').text(data.error_admin_user_name);
                   }
                   else{
                       $('#error_admin_user_name').text('');
                   }
                   if (data.error_admin_password!='') {
                       $('#error_admin_password').text(data.error_admin_password);
                       
                   } else {
                      $('#error_admin_password').text(''); 
                   }
   
               }
         }
   
     });
   
    });
});
</script> -->
