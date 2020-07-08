
<?php
include('database_connection.php');

if(!isset($_GET["code"])){
    exit("Sorry!! Again go to your email account and click the link");
}

if(isset($_POST["newsubmit"])){

    $pass=$_POST["newpass"];
    $pass1=password_hash($pass, PASSWORD_DEFAULT);
    // $code=$_GET["code"];
    
    $myquery ="SELECT email FROM reset_pass WHERE code='".$_GET["code"]."'";
     $statement1= $connect->query($myquery);
     foreach($statement1 as $row){
      $newemail = $row['email'];
     }
     
    $query = "INSERT INTO teacher_table(teacher_emailid,teacher_password)
               VALUES(?,?)
               ";
               $statement= $connect->prepare($query);
              if( $statement->execute([$newemail,$pass1])){

               $result ="You have successfully created login account.Go back to Home";
               header('Location:teacher_login.php');
              }
              if($query){
                $query1 = "DELETE FROM reset_pass WHERE code='".$_GET["code"]."'
                ";
                $statement= $connect->prepare($query1);
                $statement->execute();
              }
              
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Password Confirmation</title>
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
<div class="card-header">Teacher Password Confirmation</div>
<div class="card-body">

<form method="post" >
<h1 class="text-center text-success"><?php echo $result;  ?></h1>


<div class="form-group">
<br>
<label for="">Enter New Password</label>
<input type="text" name="newpass" id="" class="form-control">

</div>



<div class="form-group">
<input type="submit" name="newsubmit" id="" class="btn btn-info"
value="Create New Password">
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