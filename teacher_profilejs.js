


$(document).ready(function(){
    <?php
    foreach($result as $row)
    {
    ?>
    $('#teacher_name').val("<?php echo $row["teacher_name"]; ?>");
    $('#teacher_address').val("<?php echo $row["teacher_address"]; ?>");
    $('#teacher_emailid').val("<?php echo $row["teacher_emailid"]; ?>");
    $('#teacher_qf').val("<?php echo $row["teacher_qf"]; ?>");
    $('#teacher_grade_id').val("<?php echo $row["teacher_grade_id"]; ?>");
    $('#teacher_joindate').val("<?php echo $row["teacher_joindate"]; ?>");
    $('#error_teacher_image').html("<img src='tchr_images/<?php echo $row["teacher_image"]; ?>' class='img-thumbnail' width='100' >");
    $('#hidden_teacher_image').val("<?php echo $row["teacher_image"]; ?>");
    $('#teacher_id').val("<?php echo $row["teacher_id"]; ?>");
    <?php    
    }
    ?>
    $('#teacher_joindate').datepicker({
        format:"yyyy-mm-dd",
        autoclose:true
    });

});

