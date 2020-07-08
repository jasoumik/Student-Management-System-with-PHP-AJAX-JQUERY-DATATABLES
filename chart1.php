<?php
include('header.php');

$present_prcnt=0;
$absent_prcnt=0;
$total_present=0;
$total_absent=0;
$output="";

$query="SELECT * FROM attendance_table INNER JOIN student_table ON 
student_table.stdnt_id=attendance_table.stdnt_id
INNER JOIN grade_table ON grade_table.grade_id = student_table.stdnt_grade_id
WHERE student_table.stdnt_grade_id = '".$_GET['grade_id']."'
AND attendance_table.attendance_date = '".$_GET["date"]."' 
";

$statement = $connect->prepare($query);
$statement->execute();
$result= $statement->fetchAll();
$total_row = $statement->rowCount();
foreach($result as $row){
    $status ='';
    if($row["attendance_status"]=="Present"){
    $total_present++;
    $status ='<span class="badge badge-success">Present</span>';
    }
    if($row["attendance_status"]=="Absent"){
        $total_absent++;
        $status ='<span class="badge badge-danger">Absent</span>';
        }
        $output .= '<tr>
        <td>'.$row["stdnt_name"].'</td>
        <td>'.$status.'</td>
        </tr> ';
}

if ($total_row>0) {
    $present_prcnt = ($total_present/$total_row)*100;
    $absent_prcnt = ($total_absent/$total_row)*100;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
     <script type="text/javascript">
     <?php require_once 'admin_chart1.js';?></script>
</head>
<body>
    <div class="container" style="margin-top:30px;">
    <div class="card">
    <div class="card-header">
    <b>Attendance Chart</b>
    </div>
    <div class="card-body">
    <div class="table-responsive">
    <table class="table table-bordered table-striped">
    <tr>
    <th>Grade Name</th>
    <td><?php echo get_grade_name($connect,$_GET["grade_id"]);?></td>
    </tr>
    <tr>
    <th>Date</th>
    <td><?php echo $_GET["date"];?></td>
    </tr>
    </table>
    </div>
    <div id="attendance_pie_chart" style="width:100%;height:400px;"> 

    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <tr>
                <th>Student Name</th>
                <th>Attendance Status</th>
            </tr>
            <?php 
            echo $output;
            ?>
        </table>
    </div>

    </div>

    </div>
    </div>
</body>
</html>