<?php

include('database_connection.php');
session_start();
if(isset($_POST["action"]))
{
 if($_POST["action"] == "fetch")
 {
  $query = "
  SELECT * FROM attendance_table 
  INNER JOIN student_table 
  ON student_table.stdnt_id = attendance_table.stdnt_id 
  INNER JOIN grade_table 
  ON grade_table.grade_id = student_table.stdnt_grade_id 
  INNER JOIN teacher_table 
  ON teacher_table.teacher_id = attendance_table.teacher_id 
  ";
  if(isset($_POST["search"]["value"]))
  {
   $query .= '
    WHERE student_table.stdnt_name LIKE "%'.$_POST["search"]["value"].'%" 
    OR student_table.roll_number LIKE "%'.$_POST["search"]["value"].'%" 
    OR attendance_table.attendance_status LIKE "%'.$_POST["search"]["value"].'%" 
    OR attendance_table.attendance_date LIKE "%'.$_POST["search"]["value"].'%" 
    OR teacher_table.teacher_name LIKE "%'.$_POST["search"]["value"].'%" 
   ';
  }
  if(isset($_POST["order"]))
  {
   $query .= '
   ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' 
   ';
  }
  else
  { 
   $query .= '
   ORDER BY attendance_table.attendance_id DESC 
   ';
  }

  if($_POST["length"] != -1)
  {
   $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
  }

  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  $data = array();
  $filtered_rows = $statement->rowCount();
  foreach($result as $row)
  {
   $sub_array = array();
   $status = '';
   if($row["attendance_status"] == "Present")
   {
    $status = '<label class="badge badge-success">Present</label>';
   }
   if($row["attendance_status"] == "Absent")
   {
    $status = '<label class="badge badge-danger">Absent</label>';
   }
   $sub_array[] = $row["stdnt_name"];
   $sub_array[] = $row["roll_number"];
   $sub_array[] = $row["grade_name"];
   $sub_array[] = $status;
   $sub_array[] = $row["attendance_date"];
   $sub_array[] = $row["teacher_name"];
   $data[] = $sub_array;
  }
  $output = array(
   "draw"    => intval($_POST["draw"]),
   "recordsTotal"  =>  $filtered_rows,
   "recordsFiltered" => get_total_records($connect, 'attendance_table'),
   "data"    => $data
  );

  echo json_encode($output);
 }

 if($_POST["action"] == "index_fetch")
 {
  $query = "
  SELECT * FROM student_table 
  INNER JOIN attendance_table 
  ON attendance_table.stdnt_id = student_table.stdnt_id 
  INNER JOIN grade_table 
  ON grade_table.grade_id = student_table.stdnt_grade_id 
  INNER JOIN teacher_table 
  ON teacher_table.teacher_grade_id = grade_table.grade_id  
  ";
  if(isset($_POST["search"]["value"]))
  {
   $query .= '
   WHERE student_table.stdnt_name LIKE "%'.$_POST["search"]["value"].'%" 
   OR student_table.roll_number LIKE "%'.$_POST["search"]["value"].'%" 
   OR grade_table.grade_name LIKE "%'.$_POST["search"]["value"].'%" 
   OR teacher_table.teacher_name LIKE "%'.$_POST["search"]["value"].'%" 
   ';
  }
  $query .= 'GROUP BY student_table.stdnt_id ';
  if(isset($_POST["order"]))
  {
   $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
  }
  else
  {
   $query .= 'ORDER BY student_table.stdnt_id ASC ';
  }

  if($_POST["length"] != -1)
  {
   $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
  }

  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  $data = array();
  $filtered_rows = $statement->rowCount();
  foreach($result as $row)
  {
   $sub_array = array();
   $sub_array[] = $row["stdnt_name"];
   $sub_array[] = $row["roll_number"];
   $sub_array[] = $row["grade_name"];
   $sub_array[] = $row["teacher_name"];
   $sub_array[] = get_attendance_percentage($connect, $row["stdnt_id"]);
   $sub_array[] = '<button type="button" name="report_button" id="'.$row["stdnt_id"].
   '" class="btn btn-info btn-sm report_button">Report</button>&nbsp;&nbsp;&nbsp;<button
   type="button" name="chart_button" id="'.$row["stdnt_id"].'" class="btn btn-danger btn-sm 
   report_button">Chart</button>
   ';
   $data[] = $sub_array;
  }

  $output = array(
   'draw'    => intval($_POST["draw"]),
   "recordsTotal"  =>  $filtered_rows,
   "recordsFiltered" => get_total_records($connect, 'student_table'),
   "data"    => $data
  );

  echo json_encode($output);
 }


}
?>
