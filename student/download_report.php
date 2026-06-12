<?php
session_start();
include "../config/db.php";

/* TEMP STUDENT LOGIN */
$user_id = $_SESSION['user_id'];


/* GET STUDENT ID */

$student = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT student_id
FROM students
WHERE user_id='$user_id'
"));

$student_id = $student['student_id'];

/* DOWNLOAD REPORT */

if(isset($_POST['download'])){

/* STUDENT INFO */

$student = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT students.*, departments.department_name
FROM students
LEFT JOIN departments
ON students.department_id = departments.department_id
WHERE student_id='$student_id'
"));


/* ATTENDANCE STATS */

$total = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM attendance
WHERE student_id='$student_id'
"));

$present = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) AS present
FROM attendance
WHERE student_id='$student_id'
AND status='Present'
"));

$total_classes = $total['total'];
$present_classes = $present['present'];
$absent_classes = $total_classes - $present_classes;

$percentage = 0;

if($total_classes>0){
$percentage = round(($present_classes/$total_classes)*100,2);
}


/* CSV DOWNLOAD */

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="attendance_report.csv"');

$output = fopen("php://output","w");


/* STUDENT INFO */

fputcsv($output,["STUDENT INFORMATION"]);
fputcsv($output,["Name",$student['name']]);
fputcsv($output,["Email",$student['email']]);
fputcsv($output,["Department",$student['department_name']]);
fputcsv($output,["Semester",$student['semester']]);
fputcsv($output,[]);


/* ATTENDANCE SUMMARY */

fputcsv($output,["ATTENDANCE SUMMARY"]);
fputcsv($output,["Total Classes",$total_classes]);
fputcsv($output,["Classes Attended",$present_classes]);
fputcsv($output,["Classes Missed",$absent_classes]);
fputcsv($output,["Attendance Percentage",$percentage."%"]);
fputcsv($output,[]);


/* ATTENDANCE RECORD HEADER */

fputcsv($output,["ATTENDANCE RECORD"]);
fputcsv($output,["Date","Subject","Period","Status"]);


/* FETCH RECORDS */

$result = mysqli_query($conn,"
SELECT attendance.date,subjects.subject_name,attendance.period,attendance.status
FROM attendance
JOIN subjects
ON attendance.subject_id = subjects.subject_id
WHERE attendance.student_id='$student_id'
ORDER BY attendance.date DESC
");

while($row=mysqli_fetch_assoc($result)){
fputcsv($output,$row);
}

fclose($output);
exit;

}

$page_title="Download Attendance Report";
include "layout/layout.php";
?>


<h2 class="text-2xl font-semibold mb-8">
Download Attendance Report
</h2>


<div class="bg-white p-6 rounded-xl shadow card">

<p class="text-gray-600 mb-6">
Download your full attendance report including student details and attendance summary.
</p>

<form method="POST">

<button
name="download"
class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700">

Download Full Report

</button>

</form>

</div>


<?php include "layout/footer.php"; ?>