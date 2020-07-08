google.charts.load('current',{'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart(){
    var data = google.visualization.arrayToDataTable([
        ['Attendance Status','Percentage'],
        ['Present',<?php echo $present_percnt; ?>],
        ['Absent',<?php echo $absent_percnt; ?>]
    ]);

    var options = {
        title : 'Overall Attendance Analytics',
        hAxis : {
            title :'Percentage',
            minValue:0,
            maxValue:100
        },
        vAxis :{
            title : 'Attendance Status'
        }
    };
    var chart = new google.visualization.PieChart(document.
        getElementById('attendance_pie_chart'));

        chart.draw(data,options);
}