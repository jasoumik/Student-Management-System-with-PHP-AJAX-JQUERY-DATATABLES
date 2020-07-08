$(document).ready(function(){

    var dataTable = $('#attendance_table').DataTable({
        "processing" : true,
        "serverSide" : true,
        "order":[],
        "ajax" : {
            url:"admin_attendance_back.php",
            type:"POST",
            data: {action:'fetch'}
        }
    });


     
  $(document).on('click','#report_button',function(){
    $('#reportModal').modal('show');
 
 });

 //date picker for report
 $('#from_date').datepicker({
  //  todayBtn: "linked",
   format:'yyyy-mm-dd',
   autoclose:true,
   container:'#formModal modal-body'
 
   });
  $('#to_date').datepicker({
    //  todayBtn: "linked",
     format:'yyyy-mm-dd',
     autoclose:true,
     container:'#formModal modal-body'
   
  });


 $('#create_report').click(function(){
  var grade_id = $('#grade_id').val();
  var from_date = $('#from_date').val();
  var to_date = $('#to_date').val();
  var error=0;
  if(grade_id==''){
    $('#error_grade_id').text('Grade is required');
    error++;
  }
  else{
    $('#errror_grade_id').text('');
  }
  if(from_date==''){
    $('#error_from_date').text('From date is required');
    error++;
  }
  else{
    $('#errror_from_date').text('');
  }
  if(to_date==''){
   $('#error_to_date').text('To date is required');
   error++;
 }
 else{
   $('#errror_to_date').text('');
 }

 if(error==0){
   $('#from_date').val('');
   $('#to_date').val('');
   $('#formModal').modal('hide');
   window.open("admin_report.php?action=attendance_report&grade_id="+grade_id+
   "&from_date="+from_date+"&to_date="+to_date);
 }
 });

 $('#chart_button').click(function(){
  $('#chart_grade_id').val('');
  $('#attendance_date').val('');
  $('#chartModal').modal('show');
});

$('#attendance_date').datepicker({
  //  todayBtn: "linked",
   format:'yyyy-mm-dd',
   autoclose:true,
   container:'#formModal modal-body'
 
   });

$('#create_chart').click(function(){
  var grade_id = $('#chart_grade_id').val();
  var attendance_date = $('#attendance_date').val();
  var error = 0;
  if(grade_id == '')
  {
    $('#error_chart_grade_id').text('Grade is Required');
    error++;
  }
  else
  {
    $('#error_chart_grade_id').text('');
  }
  if(attendance_date == '')
  {
    $('#error_attendance_date').text('Date is Required');
    $error++;
  }
  else
  {
    $('#error_attendance_date').text('');
  }

  if(error == 0)
  {
    $('#attendance_date').val('');
    $('#chart_grade_id').val('');
    $('#chartModal').modal('hide');
    window.open("chart1.php?action=attendance_report&grade_id="+grade_id+"&date="+attendance_date);
  }

});
});