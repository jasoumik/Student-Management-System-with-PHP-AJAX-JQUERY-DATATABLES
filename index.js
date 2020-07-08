$(document).ready(function(){
    var dataTable = $('#student_table').DataTable({
        "processing": true,
        "serverSide":true,
        "order" :[],
        "ajax":{
            url:"admin_attendance_back.php",
            type:"POST",
            data:{action:'index_fetch'}
        }
    });
    //date picker for report
$('#from_date').datepicker({
    todayBtn: "linked",
    format:'yyyy-mm-dd',
    autoclose:true,
    container:'#formModal modal-body'
  
    });
    $('#to_date').datepicker({
      todayBtn: "linked",
      format:'yyyy-mm-dd',
      autoclose:true,
      container:'#formModal modal-body'
    
      });
      $(document).on('click','.report_button',function(){
          var student_id=$(this).attr('id');
          $('#student_id').val(student_id);
          $('#formModal').modal('show');

      });
      $('#create_report').click(function(){
       var student_id=$('#student_id').val();
       var from_date=$('#from_date').val();
       var to_date=$('#to_date').val();
       var error=0;
       var action=$('#report_action').val();
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
       if(action=='pdf_report'){
       window.open("admin_report.php?action=student_report&student_id="+student_id+
       "&from_date="+from_date+"&to_date="+to_date);
        }
        if(action=='chart_report'){
          location.href="chart.php?action=student_report&student_id="+student_id+
          "&from_date="+from_date+"&to_date="+to_date
        }
    }
     });
});