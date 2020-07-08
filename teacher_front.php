<?php

include('header.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Management System</title>
    <link rel="stylesheet" href="bootstrap.css">
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script> -->
  <!-- datepicker css -->
<!-- <script type="text/javascript" src="js/datepicker.js"></script>
<link rel="stylesheet" href="css/datepicker.css" /> -->
<script type="text/javascript" src="https://www.eyecon.ro/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<link rel="stylesheet" href="https://www.eyecon.ro/bootstrap-datepicker/css/datepicker.css" />

</head>
<body>
<div class="container" style="margin-top:30px">
  <div class="card">
   <div class="card-header">
      <div class="row">
        <div class="col-md-9">Teacher List</div>
        <div class="col-md-3" align="right">
        <!-- creating add button -->
          <button type="button" id="add_button" class="btn btn-info btn-sm">Add</button>
        </div>
      </div>
    </div>
   <div class="card-body">
    <div class="table-responsive">
    <!-- success or fail message -->
        <span id="message_operation"></span>
     <table class="table table-striped table-bordered" id="teacher_table">
      <thead>
       <tr>
        <th>Image</th>
        <th>Teacher Name</th>
        <th>Email Address</th>
              <th>Grade</th>
        <th>View</th>
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

<style>
    .datepicker {
      z-index: 1600 !important; /* has to be larger than 1050 */
    }
</style>

<!-- ADD BUTTON MODAL -->
<div class="modal" id="formModal">
  <div class="modal-dialog">
    <form method="post" id="teacher_form" enctype="multipart/form-data">
      <div class="modal-content">
<!-- Modal Header -->
<div class="modal-header">
          <h4 class="modal-title" id="modal_title"></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-group">
            <div class="row">
              <label class="col-md-4 text-right">Teacher Name <span class="text-danger">*</span></label>
              <div class="col-md-8">
                <input type="text" name="teacher_name" id="teacher_name" class="form-control" />
                <span id="error_teacher_name" class="text-danger"></span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <label class="col-md-4 text-right">Address <span class="text-danger">*</span></label>
              <div class="col-md-8">
                <textarea name="teacher_address" id="teacher_address" class="form-control"></textarea>
                <span id="error_teacher_address" class="text-danger"></span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <label class="col-md-4 text-right">Email Address <span class="text-danger">*</span></label>
              <div class="col-md-8">
                <input type="text" name="teacher_emailid" id="teacher_emailid" class="form-control" />
                <span id="error_teacher_emailid" class="text-danger"></span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <label class="col-md-4 text-right">Password <span class="text-danger">*</span></label>
              <div class="col-md-8">
                <input type="password" name="teacher_password" id="teacher_password" class="form-control" />
                <span id="error_teacher_password" class="text-danger"></span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <label class="col-md-4 text-right">Qualification <span class="text-danger">*</span></label>
              <div class="col-md-8">
                <input type="text" name="teacher_qf" id="teacher_qf" class="form-control" />
                <span id="error_teacher_qf" class="text-danger"></span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <label class="col-md-4 text-right">Grade <span class="text-danger">*</span></label>
              <div class="col-md-8">
                <select name="teacher_grade_id" id="teacher_grade_id" class="form-control">
                  <option value="">Select Grade</option>
                   <?php
                  echo load_grade_list($connect);
                  ?> 
                </select>
                <span id="error_teacher_grade_id" class="text-danger"></span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <label class="col-md-4 text-right">Date of Joining <span class="text-danger">*</span></label>
              <div class="col-md-8">
                <input type="text" name="teacher_joindate" id="teacher_joindate" class="form-control" />
                <span id="error_teacher_joindate" class="text-danger"></span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <label class="col-md-4 text-right">Image <span class="text-danger">*</span></label>
              <div class="col-md-8">
                <input type="file" name="teacher_image" id="teacher_image" />
                <span class="text-muted">Only .jpg and .png allowed</span><br />
                <span id="error_teacher_image" class="text-danger"></span>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <input type="hidden" name="hidden_teacher_image" id="hidden_teacher_image" value="" />
          <input type="hidden" name="teacher_id" id="teacher_id" />
          <input type="hidden" name="action" id="action" value="Add" />
          <input type="submit" name="button_action" id="button_action" class="btn btn-success btn-sm" value="Add" />
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
        </div>

      </div>
    </form>
  </div>
</div>
<div class="modal" id="viewModal">
<div class="modal-dialog ">
<div class="modal-content">
<!-- modal header -->
<div class="modal-header">
<h4 class="modal-title">Teacher Details</h4>
<button type="button" class="close" data-dismiss="modal">&times;
</button>
</div>

<!-- modal body -->
<div class="modal-body" id="teacher_details">
<!-- <div class="row">
</div> -->
</div>
<!-- modal footer -->
<div class="modal-footer">
<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"> Close </button>
</div>

</div>
</div>
</div>
<!-- delete modal -->
<div class="modal" id="deleteModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Delete Confirmation</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <h3 align="center">Are you sure you want to remove this?</h3>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" name="ok_button" id="ok_button" class="btn btn-primary btn-sm">OK</button>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

</body>
</html>

<script src="teacher.js"> </script>