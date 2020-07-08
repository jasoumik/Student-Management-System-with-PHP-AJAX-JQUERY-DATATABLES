$(document).ready(function(){
    var dataTable = $('#student_table').DataTable({
    "processing": true,
    "serverSide":true,
    "order":[],
    "ajax":{
        url:"student_back.php",
        method: "POST",
        data:{action:'fetch'},
    }

    });
    $('#student_dob').datepicker({
        format:"yyyy-mm-dd",
        autoclose:true,
        container:'#fromModal modal-body'
    });
    function clear_field(){
        $('#student_form')[0].reset();
        $('#error_student_name').text('');
        $('#error_student_roll_number').text('');
        $('#error_student_dob').text('');
        $('#error_student_grade_id').text('');

    };
    $('#add_button').click(function(){
        $('#modal_title').text('Add Student');
        $('#button_action').val('Add');
        $('#action').val('Add');
        $('#formModal').modal('show');
        clear_field();

    });

    $('#student_form').on('submit',function (event) {
        event.preventDefault();
        $.ajax({
            url:"student_back.php",
            method:"POST",
            data:$(this).serialize(),
            dataType: "json",
            beforeSend:function(){
                $('#button_action').val('Accessing...');
                $('#button_action').attr('disabled','disabled');
            },
            success : function(data){
                $('#button_action').attr('disabled',false);
                $('#button_action').val($('#action').val());
                if(data.success){
                    $('#message_operation').html('<div class="alert alert-success">'+ data.success+'</div>');
                    clear_field();
                    $('#formModal').modal('hide');
                    dataTable.ajax.reload();
                }
               if(data.error){
                   if(data.error_student_name!='')
                   {
                      $('#error_student_name').text(data.error_student_name);
                   }
                   else{
                     $('#error_student_name').text('');
                   }
                   if(data.error_student_roll_number!='')
                   {
                      $('#error_student_roll_number').text(data.error_student_roll_number);
                   }
                   else{
                     $('#error_student_roll_number').text('');
                   }
                   if(data.error_student_dob!='')
                   {
                      $('#error_student_dob').text(data.error_student_dob);
                   }
                   else{
                     $('#error_student_dob').text('');
                   }
                   if(data.error_student_grade_id!='')
                   {
                      $('#error_student_grade_id').text(data.error_student_grade_id);
                   }
                   else{
                     $('#error_student_grade_id').text('');
                   }
               }
            }
        });
        
    });

    var student_id='';
    $(document).on('click','.edit_student',function(){

        student_id = $(this).attr('id');
        clear_field();
        $.ajax({
            url: "student_back.php",
            method:"POST",
            data:{action:'edit_fetch',student_id:student_id},
            dataType:"json",
            success: function(data){
                $('#student_name').val(data.student_name);
                $('#student_roll_number').val(data.student_roll_number);
                $('#student_dob').val(data.student_dob);
                $('#student_grade_id').val(data.student_grade_id);
                $('#student_id').val(data.student_id);
                $('#modal_title').text('Edit Student Details');
                $('#button_action').val('Edit');
                $('#action').val('Edit');
                $('#formModal').modal('show');
            }
        });
    });

    $(document).on('click','.delete_student',function(){

        student_id=$(this).attr('id');
        $('#deleteModal').modal('show');
    });
    $('#ok_button').click(function(){
        $.ajax({
            url:"student_back.php",
            method:"POST",
            data:{student_id:student_id,action:"delete"},
            success:function(data){
                $('#message_operation').html('<div class="alert alert-success">'+ data +'</div>');
                $('#deleteModal').modal('hide');
                dataTable.ajax.reload();
            }
        })
    });

});