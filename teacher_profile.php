<?php

include('new_header.php');
  $teacher_name = '';
  $teacher_address = '';
  $teacher_emailid = '';
  $teacher_password = '';
  $teacher_grade_id = '';
  $teacher_qf = '';
  $teacher_joindate = '';
  $teacher_image = '';
  $error_teacher_name = '';
  $error_teacher_address = '';
  $error_teacher_emailid = '';
  $error_teacher_password = '';
  $error_teacher_grade_id = '';
  $error_teacher_qf = '';
  $error_teacher_joindate = '';
  $error_teacher_image = '';
  $error=0;
  $success='';

  if(isset($_POST["button_action"])){
    $teacher_image = $_POST["hidden_teacher_image"];
  if($_FILES["teacher_image"]["name"] != '')
  {
    $file_name = $_FILES["teacher_image"]["name"];
    $tmp_name = $_FILES["teacher_image"]['tmp_name'];
    $extension_array = explode(".", $file_name);
    $extension = strtolower($extension_array[1]);
    $allowed_extension = array('jpg','png');
   //fast invalid image ?
   if(!in_array($extension, $allowed_extension))
   {
    $error_teacher_image = 'Invalid Image Format';
    $error++;
   }
     else {
       $teacher_image = uniqid().'.'.$extension;
       $upload_path = 'tchr_images/'.$teacher_image;
       move_uploaded_file($tmp_name,$upload_path);
     }
    }
    if(empty($_POST["teacher_name"])){
        $error_teacher_name="Teacher name is required";
        $error++;
    }
    else{
      $teacher_name= $_POST["teacher_name"];
    }
      if(empty($_POST["teacher_address"])){
            $error_teacher_address="Teacher address is required";
            $error++;
        }
      else{
          $teacher_address= $_POST["teacher_address"];
        }
      if(empty($_POST["teacher_emailid"])){
          $error_teacher_emailid="Teacher emailid is required";
          $error++;
      }
      else{
        if(!filter_var($_POST["teacher_emailid"],FILTER_VALIDATE_EMAIL)){
          $error_teacher_emailid="Invalid email Format";
          $error++;
        }
        else {
          $teacher_emailid= $_POST["teacher_emailid"];
        }
      }
      if(!empty($_POST["teacher_password"])){
      $teacher_password= $_POST["teacher_password"];
      }

      if(empty($_POST["teacher_qf"])){
        $error_teacher_qf="Teacher qualification is required";
        $error++;
      }
      else{
      $teacher_qf= $_POST["teacher_qf"];
      }
      if(empty($_POST["teacher_grade_id"])){
        $error_teacher_grade_id="Grade is required";
        $error++;
      }
      else{
      $teacher_grade_id= $_POST["teacher_grade_id"];
      }
      if(empty($_POST["teacher_joindate"])){
        $error_teacher_joindate="Date of Joinning is required";
        $error++;
      }
      else{
      $teacher_joindate= $_POST["teacher_joindate"];
      }

      if($error==0){
      if($teacher_password!=""){
        $data =array(
          ':teacher_name'=>$teacher_name,
          ':teacher_address'=>$teacher_address,
          ':teacher_emailid'=>$teacher_emailid,
          ':teacher_password'=>password_hash($teacher_password,PASSWORD_DEFAULT),
          ':teacher_qf'=>$teacher_qf,
          ':teacher_joindate'=>$teacher_joindate,
          ':teacher_image'=>$teacher_image,
          ':teacher_grade_id'=>$teacher_grade_id,
          ':teacher_id'=>$_POST["teacher_id"]
        );
        $query = "
        UPDATE teacher_table 
        SET teacher_name = :teacher_name,
        teacher_address = :teacher_address, 
        teacher_emailid=:teacher_emailid,
        teacher_grade_id = :teacher_grade_id, 
        teacher_password=:teacher_password,
        teacher_qf=:teacher_qf,
        teacher_joindate=:teacher_joindate,
        teacher_image=:teacher_image
        WHERE teacher_id=:teacher_id
        ";
      }
      else{
        $data =array(
          ':teacher_name'=>$teacher_name,
          ':teacher_address'=>$teacher_address,
          ':teacher_emailid'=>$teacher_emailid,
          ':teacher_qf'=>$teacher_qf,
          ':teacher_joindate'=>$teacher_joindate,
          ':teacher_image'=>$teacher_image,
          ':teacher_grade_id'=>$teacher_grade_id,
          ':teacher_id'=>$_POST["teacher_id"]
        );
        $query = "
        UPDATE teacher_table 
        SET teacher_name = :teacher_name,
        teacher_address = :teacher_address, 
        teacher_emailid= :teacher_emailid,
        teacher_grade_id = :teacher_grade_id, 
        teacher_qf= :teacher_qf,
        teacher_joindate= :teacher_joindate,
        teacher_image= :teacher_image
        WHERE teacher_id= :teacher_id
        ";
      }
      $statement=$connect->prepare($query);
      if($statement->execute($data)){
        $success ='<div class="alert alert-success">Profile Details Changed Successfully</div>';
      }
    }
  }

  $query = "
  SELECT * FROM teacher_table WHERE teacher_id='".$_SESSION["teacher_id"]."'
  ";
  $statement=$connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="text/javascript"><?php require_once 'teacher_profilejs.js';?></script>
    <!-- <script src="teacher_profilejs.php" type="text/javascript"></script> -->
    <script type="text/javascript" src="https://www.eyecon.ro/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <link rel="stylesheet" href="https://www.eyecon.ro/bootstrap-datepicker/css/datepicker.css" />
</head>
<body>
    <div class="container">
    <span><?php echo $success; ?></span>
    <div class="card">
    <form method="post" id="profile_form" enctype="multipart/form-data">
    <div class="card-header">
    <div class="row">
    <div class="col-md-9">Profile</div>
    <div class="col-md-3" align="right"></div>
    </div>
    </div>
    <div class="card-body">
    <div class="form-group">
    <div class="row">
    <label for="" class="col-md-4 text-right">Teacher Name <span class="text-danger">*</span></label>
    <div class="col-md-8">
    <input type="text" name="teacher_name" id="teacher_name" class="form-control">
    <span class="text-danger"><?php echo $error_teacher_name; ?></span>
    </div>
    </div>
    </div>

    <div class="form-group">
    <div class="row">
    <label for="" class="col-md-4 text-right">Address <span class="text-danger">*</span></label>
    <div class="col-md-8">
    <textarea name="teacher_address" id="teacher_address" class="form-control"></textarea>
    <span class="text-danger"><?php echo $error_teacher_address; ?></span>
    </div>
    </div>
    </div>

    <div class="form-group">
    <div class="row">
    <label for="" class="col-md-4 text-right">Email <span class="text-danger">*</span></label>
    <div class="col-md-8">
    <input type="text" name="teacher_emailid" id="teacher_emailid" class="form-control">
    <span class="text-danger"><?php echo $error_teacher_emailid; ?></span>
    </div>
    </div>
    </div>

    <div class="form-group">
    <div class="row">
    <label for="" class="col-md-4 text-right">Password<span class="text-danger">*</span></label>
    <div class="col-md-8">
    <input type="text" name="teacher_password" id="teacher_password" class="form-control" placeholder="Ignore if you don't want to change">
    <span class="text-danger"><?php echo $error_teacher_password; ?></span>
    </div>
    </div>
    </div>

    <div class="form-group">
    <div class="row">
    <label for="" class="col-md-4 text-right">Teacher qualification <span class="text-danger">*</span></label>
    <div class="col-md-8">
    <input type="text" name="teacher_qf" id="teacher_qf" class="form-control">
    <span class="text-danger"><?php echo $error_teacher_qf; ?></span>
    </div>
    </div>
    </div>

    <div class="form-group">
    <div class="row">
    <label for="" class="col-md-4 text-right">Grade <span class="text-danger">*</span></label>
    <div class="col-md-8">
    <select name="teacher_grade_id" id="teacher_grade_id" class="form-control">
    <option value="">Select Grade</option>
    <?php
    echo load_grade_list($connect);
    ?>
    </select>
    <span class="text-danger"><?php echo $error_teacher_grade_id; ?></span>
    </div>
    </div>
    </div>

    <div class="form-group">
    <div class="row">
    <label for="" class="col-md-4 text-right">Joinning Date <span class="text-danger">*</span></label>
    <div class="col-md-8">
    <input type="text" name="teacher_joindate" id="teacher_joindate" class="form-control" readonly>
    <span class="text-danger"><?php echo $error_teacher_joindate; ?></span>
    </div>
    </div>
    </div>

    <div class="form-group">
    <div class="row">
    <label for="" class="col-md-4 text-right">Image<span class="text-danger">*</span></label>
    <div class="col-md-8">
    <input type="file" name="teacher_image" id="teacher_image" >
    <span class="text-muted">Only .jpg and .png fromat</span>
    <span id="error_teacher_image" class="text-danger"><?php echo $error_teacher_image; ?></span>
    </div>
    </div>
    </div>

    </div>

    <div class="card-footer" align="center">
    <input type="hidden" name="hidden_teacher_image" id="hidden_teacher_image" class="form-control">
    <input type="hidden" name="teacher_id" id="teacher_id">
    <input type="submit" name="button_action" id="button_action" class="btn btn-success btn-sm" value="Save">
    </div>

    </form>
    </div>
    </div>
</body>
</html>

