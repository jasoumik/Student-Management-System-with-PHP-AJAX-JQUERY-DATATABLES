$(document).ready(function(){
    var dataTable = $('#teacher_table').DataTable({
    "searching":true,
    "processing":true,
    "serverSide":true,
    "order":[],
    "ajax":{
    url:"teacher_back.php",
    type:"POST",
    data:{action:'fetch'}
    },
    "columnDefs":[
    {
        "targets":[0, 4, 5, 6],
        "orderable":false,
    },
    ],
    });

    $('#teacher_joindate').datepicker({
    format: "yyyy-mm-dd",
    autoclose: true,
    container: '#formModal modal-body'
});
function clear_field()
{
$('#teacher_form')[0].reset();
$('#error_teacher_name').text('');
$('#error_teacher_address').text('');
$('#error_teacher_emailid').text('');
$('#error_teacher_password').text('');
$('#error_teacher_qf').text('');
$('#error_teacher_joindate').text('');
$('#error_teacher_image').text('');
$('#error_teacher_grade_id').text('');
}

$('#add_button').click(function(){
$('#modal_title').text("Add Teacher");
$('#button_action').val('Add');
$('#action').val('Add');
$('#formModal').modal('show');
clear_field();
});

$('#teacher_form').on('submit', function(event){
event.preventDefault();
$.ajax({
  url:"teacher_back.php",
  method:"POST",
  data:new FormData(this), //questn
  dataType:"json",
  contentType:false,
  processData:false,
  beforeSend:function()
  {  
    $('#button_action').attr('disabled', 'disabled');   
    $('#button_action').val('Validate...');   
 },
  success:function(data){
    $('#button_action').attr('disabled', false);
    $('#button_action').val($('#action').val());
    if(data.success)
    {
      $('#message_operation').html('<div class="alert alert-success">'+data.success+'</div>');
      clear_field();
      $('#formModal').modal('hide');
      dataTable.ajax.reload();
    }
    if(data.error)
    { 
      if(data.error_teacher_name != '')
      {
        $('#error_teacher_name').text(data.error_teacher_name);
      }
      else
      {
        $('#error_teacher_name').text('');
      }
      if(data.error_teacher_address != '')
      {
        $('#error_teacher_address').text(data.error_teacher_address);
      }
      else
      {
        $('#error_teacher_address').text('');
      }
      if(data.error_teacher_emailid != '')
      {
        $('#error_teacher_emailid').text(data.error_teacher_emailid);
      }
      else
      {
        $('#error_teacher_emailid').text('');
      }
      if(data.error_teacher_password != '')
      {
        $('#error_teacher_password').text(data.error_teacher_password);
      }
      else
      {
        $('#error_teacher_password').text('');
      }
      if(data.error_teacher_grade_id != '')
      {
        $('#error_teacher_grade_id').text(data.error_teacher_grade_id);
      }
      else
      {
        $('#error_teacher_grade_id').text('');
      }
      if(data.error_teacher_qf != '')
      {
        $('#error_teacher_qf').text(data.error_teacher_qf);
      }
      else
      {
        $('#error_teacher_qf').text('');
      }
      if(data.error_teacher_joindate != '')
      {
        $('#error_teacher_joindate').text(data.error_teacher_joindate);
      }
      else
      {
        $('#error_teacher_joindate').text('');
      }
      if(data.error_teacher_image != '')
      {
        $('#error_teacher_image').text(data.error_teacher_image);
      }
      else
      {
        $('#error_teacher_image').text('');
      }
    }
  }
})
});

//view teachr

var teacher_id = '';
$(document).on('click', '.view_teacher', function(){
teacher_id = $(this).attr('id');
$.ajax({
url:"teacher_back.php",
method:"POST",
data:{action:'single_fetch', teacher_id:teacher_id},
success:function(data)
{
  $('#viewModal').modal('show');
  $('#teacher_details').html(data);
}
});
});
//edit
$(document).on('click', '.edit_teacher', function(){
teacher_id = $(this).attr('id');
clear_field();
$.ajax({
url:"teacher_back.php",
method:"POST",
data:{action:'edit_fetch', teacher_id:teacher_id},
dataType:"json",
success:function(data)
{
  $('#teacher_name').val(data.teacher_name);
  $('#teacher_address').val(data.teacher_address);
 $('#teacher_emailid').val(data.teacher_emailid);
  $('#teacher_grade_id').val(data.teacher_grade_id);
  $('#teacher_qf').val(data.teacher_qf);
  $('#teacher_joindate').val(data.teacher_joindate);
  $('#error_teacher_image').html('<img src="tchr_images/'+data.teacher_image+'" class="img-thumbnail" width="50" />');
  $('#hidden_teacher_image').val(data.teacher_image);
  $('#teacher_id').val(data.teacher_id);
  $('#modal_title').text("Edit Teacher");
  $('#button_action').val('Edit');
  $('#action').val('Edit');
  $('#formModal').modal('show');
}
});
});

//delete
$(document).on('click', '.delete_teacher', function(){
teacher_id = $(this).attr('id');
$('#deleteModal').modal('show');
});

$('#ok_button').click(function(){
$.ajax({
url:"teacher_back.php",
method:"POST",
data:{teacher_id:teacher_id, action:'delete'},
success:function(data)
{
  $('#message_operation').html('<div class="alert alert-success">'+data+'</div>');
  $('#deleteModal').modal('hide');
  dataTable.ajax.reload();
}
});
});

});