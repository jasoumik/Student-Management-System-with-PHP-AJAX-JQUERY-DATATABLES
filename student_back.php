<?php
include('database_connection.php');
session_start();
$output='';
if(isset($_POST["action"])){
    if($_POST["action"] == 'fetch')
    {
      $query="SELECT * FROM student_table INNER JOIN grade_table ON 
      grade_table.grade_id=student_table.stdnt_grade_id ";
      if(isset($_POST["search"]["value"])){
          $query .='WHERE student_table.stdnt_name LIKE "%'.$_POST["search"]["value"].'%"
          OR student_table.roll_number LIKE "%'.$_POST["search"]["value"].'%"
          OR student_table.stdnt_dob LIKE "%'.$_POST["search"]["value"].'%"
          OR grade_table.grade_name LIKE "%'.$_POST["search"]["value"].'%"
          ';
      }
      //?
      if(isset($_POST["order"])){
          $query .='
          ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' 
          ';
      }
      else
      {
          $query .='
          ORDER BY student_table.stdnt_id DESC
          ';
      }
      //have to understand this if condition
      if(!isset($_POST["length"] )< 0)
      {
          $query .='LIMIT ' .$_POST['start'].', ' .$_POST['length']; //why limit space
      }
      $statement = $connect->prepare($query);
      $statement->execute();
      $result = $statement->fetchAll();
      $data = array();
      $filtered_rows = $statement->rowCount();
      foreach($result as $row){
          $sub_array = array();
          $sub_array[] = $row["stdnt_name"];
          $sub_array[] = $row["roll_number"];
          $sub_array[] = $row["stdnt_dob"];
          $sub_array[] = $row["grade_name"];
          $sub_array[] = '<button type = "button" name = "edit_student" class="btn btn-primary btn-sm edit_student" id="'.$row["stdnt_id"].'">Edit </button>';
          $sub_array[] = '<button type = "button" name = "delete_student" class="btn btn-danger btn-sm delete_student" id="'.$row["stdnt_id"].'">Delete</button>';
          $data[]=$sub_array;
      }
      $output = array(
          "draw"            => intval($_POST["draw"]),
          "recordsTotal"     => $filtered_rows,
          "recordsFiltered" => get_total_records($connect,'student_table'),
          "data"            => $data
      );
    //   print_r($output);
      echo json_encode($output);
    }
    if ($_POST["action"]=='Add'||$_POST["action"]=="Edit") {
        $student_name='';
        $student_roll_number='';
        $student_dob='';
        $student_grade_id='';
        $error_student_name='';
        $error_student_roll_number='';
        $error_student_dob='';
        $error_student_grade_id='';
        $error=0;
        if(empty($_POST["student_name"]))
        {
         $error_student_name ='Student name is required';
         $error++;
        }
        else{
           $student_name = $_POST["student_name"];
        }

        if(empty($_POST["student_roll_number"]))
        {
         $error_student_roll_number ='Roll no. is required';
         $error++;
        }
        else{
           $student_roll_number = $_POST["student_roll_number"];
        }

        if(empty($_POST["student_dob"]))
        {
         $error_student_dob ='Date of birth is required';
         $error++;
        }
        else{
           $student_dob = $_POST["student_dob"];
        }

        if(empty($_POST["student_grade_id"]))
        {
         $error_student_grade_id ='Grade name is required';
         $error++;
        }
        else{
           $student_grade_id = $_POST["student_grade_id"];
        }
        if($error>0){
            $output=array(
                'error'                      => true,
                'error_student_name'         =>$error_student_name,
                'error_student_roll_number'  => $error_student_roll_number,
                'error_student_dob'          =>  $error_student_dob,
                'error_student_grade_id'     =>   $error_student_grade_id
                
            );
        }
        else{
            if($_POST["action"]=='Add')
            {
               $data=array(
                   ':student_name' =>$student_name,
                   ':student_roll_number' =>$student_roll_number,
                   ':student_dob' =>$student_dob,
                   ':student_grade_id' =>$student_grade_id,
               ); 
               $query = "
               INSERT INTO student_table(stdnt_name,roll_number,stdnt_dob,stdnt_grade_id)
               VALUES(:student_name,:student_roll_number,:student_dob,:student_grade_id)
               ";
               $statement = $connect->prepare($query);
               if($statement->execute($data)){
                   $output = array(
                       'success' =>'Data Added Successfully'
                   );
               }
            }

            //edit execution
            if($_POST["action"]=="Edit"){
                $data=array(
                    ':student_name'         =>$student_name,
                    ':student_roll_number'  => $student_roll_number,
                    ':student_dob'          =>  $student_dob,
                    ':student_grade_id'     =>   $student_grade_id,
                    ':student_id'         =>$_POST["student_id"]
                );
                $query = "
                UPDATE student_table SET stdnt_name=:student_name,roll_number=:student_roll_number,stdnt_dob=:student_dob,stdnt_grade_id=:student_grade_id
                WHERE stdnt_id=:student_id
                ";
                $statement=$connect->prepare($query);
                if($statement->execute($data)){
                    $output=array(
                        'success' => 'Data edited Successfully',
                    );
                }
            }
        }
        echo json_encode($output);
    }
    
    if($_POST["action"]=='edit_fetch'){
      $query = "SELECT * FROM student_table WHERE stdnt_id = '".$_POST["student_id"]."'";
      $statement= $connect->prepare($query);
      if($statement->execute()){
          $result = $statement->fetchAll();
          $output=array();
          foreach($result as $row){
           $output['student_name']= $row["stdnt_name"];
           $output['student_roll_number']= $row["roll_number"];
           $output["student_dob"]= $row["stdnt_dob"];
           $output["student_grade_id"]= $row["stdnt_grade_id"];
           $output["student_id"]= $row["stdnt_id"];
          }
          echo json_encode($output);
      }
      
    }
      
    if($_POST["action"]=='delete'){
        $query="
        DELETE FROM student_table WHERE stdnt_id ='".$_POST["student_id"]."'
        ";
        $statement = $connect->prepare($query);
        if($statement->execute()){
            echo 'Data Deleted Successfully';
       }
     }
     
}
?>