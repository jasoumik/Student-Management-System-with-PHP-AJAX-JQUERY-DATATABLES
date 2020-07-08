<?php

$connect = new PDO("mysql:host=localhost;dbname=attendance","root","root");
$base_url = "http://localhost/phpAttendanceSystem/";
function get_total_records($connect, $table_name)
{
 $query = "SELECT * FROM $table_name";
 $statement = $connect->prepare($query);
 $statement->execute();
 return $statement->rowCount();
}
function load_grade_list($connect)
{
 $query = "
 SELECT * FROM grade_table ORDER BY grade_name ASC
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $output = '';
 foreach($result as $row)
 {
  $output .= '<option value="'.$row["grade_id"].'">'.$row["grade_name"].'</option>';
 }
 return $output;
}
function get_attendance_percentage($connect,$student_id){
    $query = "
    SELECT ROUND((SELECT COUNT(*) FROM attendance_table 
    WHERE attendance_status='Present' AND stdnt_id='".$student_id."')*100/COUNT(*)) 
    AS percentage FROM attendance_table WHERE stdnt_id='".$student_id."'
    ";
    $statement=$connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach($result as $row){
        if($row["percentage"]>0){
            return $row["percentage"]. '%'; 
        }
        else{
            return 'N/A';
        }
    }
}
function get_student_name($connect,$student_id){
    $query="SELECT stdnt_name FROM student_table WHERE stdnt_id ='".$student_id."'
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result=$statement->fetchAll();
    foreach($result as $row){
    return $row["stdnt_name"];
    }

}
function get_student_grade_name($connect,$student_id){
    $query="SELECT grade_table.grade_name FROM student_table 
    INNER JOIN grade_table
    ON grade_table.grade_id=student_table.stdnt_grade_id
    WHERE student_table.stdnt_id ='".$student_id."'
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result=$statement->fetchAll();
    foreach($result as $row){
    return $row["grade_name"];
    }

}
function get_student_teacher_name($connect,$student_id){
    $query="SELECT teacher_table.teacher_name FROM student_table   
    INNER JOIN grade_table
    ON grade_table.grade_id=student_table.stdnt_grade_id
    INNER JOIN teacher_table
    ON teacher_table.teacher_grade_id=grade_table.grade_id
    WHERE student_table.stdnt_id ='".$student_id."'
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result=$statement->fetchAll();
    foreach($result as $row){
    return $row["teacher_name"];
    }

}

function get_grade_name($connect,$grade_id){
    $query = "
    SELECT grade_name FROM grade_table WHERE grade_id = '".$grade_id."'
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result=$statement->fetchAll();
    foreach($result as $row){
    return $row["grade_name"];
    }
}

?>
