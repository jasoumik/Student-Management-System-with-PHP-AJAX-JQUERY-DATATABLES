$(document).ready(function(){
  var dataTable = $('#attendance_table').DataTable({
   "processing" : true,
   "serverSide": true,
   "order" :[],
   "ajax" : {
     url:"attendance_back.php",
     method:"POST",
     data:{action:'fetch'}
   }

  });
  $('#attendance_date').datepicker({
   format:"yyyy-mm-dd",
   autoclose:true,
   container:'#formModal modal-body'

  });
  function clear_field(){
    $('#attendance_form')[0].reset();
    $('#error_attendance_date').text('');
  }
  $('#add_button').click(function(){
    $('#modal_title').text("Add Attendance");
   $('#formModal').modal('show');
  //  $('#button_action').val('Add');
  //  $('#action').val('Add');
   clear_field();
  });
  $('#attendance_form').on('submit',function(event){
  event.preventDefault();
  $.ajax({
    url:"attendance_back.php",
    method:"POST",
    data:$(this).serialize(),
    dataType:"json",
    beforeSend:function(){
      $('#button_action').val('Validate..');
      $('#button_action').attr('disabled','disabled');

    },
    success:function(data){
      $('#button_action').attr('disabled',false);
      $('#button_action').val();  

      if(data.success){
        $('#message_operation').html('<div class="alert alert-success">'+data.success+'</div>');
        clear_field();
        $('#formModal').modal('hide');
        dataTable.ajax.reload();
      }
      if(data.error){
        if(data.error_attendance_date!=''){
          $('#error_attendance_date').text(data.error_attendance_date);
        }
        else{
          $('#error_attendance_date').text('');
        }
      }
    }
  });

  });

  
  $(document).on('click','#report_button',function(){
     $('#reportModal').modal('show');
  
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


  $('#create_report').click(function(){
   var from_date =$('#from_date').val();
   var to_date =$('#to_date').val();
   var error=0;
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
    window.open("report.php?action=attendance_report&from_date="+from_date+"&to_date="+to_date);
  }
  });

  $('#create_admin_report').click(function(){
    var from_date =$('#from_date').val();
    var to_date =$('#to_date').val();
    var error=0;
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
 
  //  if(error==0){
  //    $('#from_date').val('');
  //    $('#to_date').val('');
  //    $('#formModal').modal('hide');
  //   //window.open("report.php?action=attendance_report&from_date="+from_date+"&to_date="+to_date);
  //  }
   });

});