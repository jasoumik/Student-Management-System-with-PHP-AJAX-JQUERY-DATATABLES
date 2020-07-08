<?php

//index.php

include('header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Attendance System</title>
    <script src="index.js"></script>
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
<div class="container" style="margin-top:30px">
    <div class="card">
    <div class="card-header">
    <div class="row">
    <div class="col-md-9">Overall Student Attendance Status</div>
    <div class="col-md-3" align="right">
    
    </div>
    </div>
    </div>

    <div class="card-body">
    <div class="table-responsive">
   
    <table class="table table-striped table-bordered" id="student_table">
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Roll Number</th>
                <th>Grade</th>
                <th>Teacher</th>
                <th>Attendance Percentage</th>
                <th>Report</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
    </div>
    </div>

    </div>
    </div>

    <div class="modal" id="formModal">
       <div class="modal-dialog">
           <div class="modal-content">

           <!-- modal header -->
           <div class="modal-header">
               <h4 class="modal-title">Create Report</h4>
               <button type="button" class="close" data-dismiss="modal">
            &times;
               </button>
           </div>
           <!-- modal body -->
           <div class="modal-body">
           <div class="form-group">
                <select name="report_action" id="report_action" class="form-control">
                <option value="pdf_report">PDF Report</option>
                  <option value="chart_report">Chart Report</option>
                 </select>
          </div>
               <div class="form-group">
                   <div class="input-daterange">
                       <input type="text" name="from_date" id="from_date" class="form-control"
                       placeholder="From Date" readonly>
                       <span id="error_from_date" class="text-danger"></span>
                       <br>
                       <input type="text" name="to_date" id="to_date" class="form-control"
                       placeholder="To Date" readonly>
                       <span id="error_to_date" class="text-danger"></span>
                       <br>
                   </div>
               </div>
           </div>
           <!-- modal footer -->
           <div class="modal-footer">
               <input type="hidden" name="student_id" id="student_id">
               <button type="button" name="create_report" id="create_report" 
               class="btn btn-success btn-sm">
                   Create Report</button>
               <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">
                   Close</button>

           </div>
           </div>
       </div>
   </div>
</body>
</html>
<!-- <script>
$(document).ready(function(){


});
</script> -->
