<?php
include('header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <script src="student.js"></script>
</head>
<body>
    <div class="container" style="margin-top:30px">
    <div card="card">
    <div class="card-header">
    <div class="row">
    <div class="col-md-9">Student List</div>
    <div class="col-md-2" align="right">
    <button type="button" id="add_button" class="btn btn-info btn-sm">
    Add
    </button>
    </div>
    </div>
    </div>
    <div class="card-body">
    <div class="table-responsive">
    <span id="message_operation"></span>
     <table class="table table-striped table-bordered" id="student_table">
     <thead>
     <tr>
     <th>Student Name</th>
     <th>Roll No.</th>
     <th>Date of Birth</th>
     <th>Grade</th>
     <th>Edit</th>
     <th>Delete</th>
     </tr>
     </thead>
     <tbody>
     
     </tbody>
     </table>
    </div>
    </div>
    </div>
    </div>
    </div>

    <!-- add button modal -->

    <div class="modal" id="formModal">
    <div class="modal-dialog">
    <form method="post" id="student_form">
    <div class="modal-content">
    
    <!-- modal header -->
   <div class="modal-header">
   <h4 class="modal-title" id="modal_title"></h4>
   <button type="button" class="close" data-dismiss="modal">x</button>
   </div>
   <!-- modal body -->
   <div class="modal-body">
   <div class="form-group">
   <div class="row">
   <label for="" class="col-md-4 text-right">
   Student Name <span class="text-danger">*</span>
   </label>
   <div class="col-md-8">
   <input type="text" name="student_name" class="form-control" id="student_name">
   <span class="text-danger" id="error_student_name"></span>
   </div>
   </div></div>
   <div class="form-group">
   <div class="row">
   <label for="" class="col-md-4 text-right">
   Roll no. <span class="text-danger">*</span>
   </label>
   <div class="col-md-8">
   <input type="text" name="student_roll_number" class="form-control" id="student_roll_number">
   <span class="text-danger" id="error_student_roll_number"></span>
   </div>
   </div></div>
   <div class="form-group">
   <div class="row">
   <label for="" class="col-md-4 text-right">
   Date of Birth <span class="text-danger">*</span>
   </label>
   <div class="col-md-8">
   <input type="text" name="student_dob" class="form-control" id="student_dob">
   <span class="text-danger" id="error_student_dob"></span>
   </div>
   </div></div>
   <div class="form-group">
   <div class="row">
   <label for="" class="col-md-4 text-right">
   Grade Name <span class="text-danger">*</span>
   </label>
   <div class="col-md-8">
   <select name="student_grade_id" class="form-control" id="student_grade_id">
   <option value="">Select Grade</option>
   <?php
   echo load_grade_list($connect);
   ?>
   </select>
   <span class="text-danger" id="error_student_grade_id"></span>
   
   </div>
   </div></div>

   </div>
   <!-- modal-footer -->
   <div class="modal-footer">
   <input type="hidden" name="student_id" id="student_id">
   <input type="hidden" name="action" id="action" value="Add">
   <input type="submit" name="button_action" id="button_action" class="btn btn-success btn-sm" value="Add">
   <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
   </div>

    </div>
    </form>
    </div>
    </div>

    <!-- delete button modal -->
    <div class="modal" id="deleteModal">
    <div class="modal-dialog">
    <div class="modal-content">

    <!-- modal header -->
    <div class="modal-header">
    <h4 class="modal-title">Delete Confirmation</h4>
    <button type="button" class="close" data-dismiss="modal">x
    </button>
    </div>
    <!-- modal body -->
  <div class="modal-body">
  <h3 >Are you sure about deleting this?</h3>
  </div>

  <!-- modal footer -->
  <div align="center">
  <button type="button" name="ok_button" id="ok_button" class="btn btn-primary btn-sm">OK</button>
  <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
  </div>
    </div>
    </div>
    </div>
</body>
</html>
<style>
    .datepicker {
      z-index: 1600 !important; /* has to be larger than 1050 */
    }
</style>
<script type="text/javascript" src="https://www.eyecon.ro/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<link rel="stylesheet" href="https://www.eyecon.ro/bootstrap-datepicker/css/datepicker.css" />