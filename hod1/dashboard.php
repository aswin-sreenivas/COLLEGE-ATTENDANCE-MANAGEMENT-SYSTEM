<?php
session_start();
include "../config/db.php";

$user_id = $_SESSION['user_id'] ?? 1;

/* GET HOD DEPT */

$hod = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT * FROM hod WHERE user_id='$user_id'
"));

if(!$hod){
die("HOD not assigned to any department");
}

$dept_id = $hod['department_id'];


/* COUNTS */

$students = mysqli_num_rows(mysqli_query($conn,"
SELECT * FROM students WHERE department_id='$dept_id'
"));

$faculty = mysqli_num_rows(mysqli_query($conn,"
SELECT * FROM faculty WHERE department_id='$dept_id'
"));

$subjects = mysqli_num_rows(mysqli_query($conn,"
SELECT * FROM subjects WHERE department_id='$dept_id'
"));

$condonation = mysqli_num_rows(mysqli_query($conn,"
SELECT c.*
FROM condonation_requests c
JOIN students s ON c.student_id=s.student_id
WHERE s.department_id='$dept_id' AND c.status='Pending'
"));


/* LOW ATTENDANCE */

$low_attendance = mysqli_num_rows(mysqli_query($conn,"
SELECT student_id FROM (
SELECT student_id,
( SUM(CASE WHEN status='Present' THEN 1 ELSE 0 END) / COUNT(*) ) * 100 AS percent
FROM attendance
GROUP BY student_id
) AS t
WHERE percent < 75
"));


/* AVERAGE ATTENDANCE */

$avg_data = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT 
ROUND(AVG(percent),2) as avg_percent
FROM (
SELECT 
( SUM(CASE WHEN status='Present' THEN 1 ELSE 0 END) / COUNT(*) ) * 100 AS percent
FROM attendance
GROUP BY student_id
) AS t
"));

$avg_attendance = $avg_data['avg_percent'] ?? 0;

?>

<!DOCTYPE html>
<html>

<head>

<title>HOD Dashboard</title>

<script src="https://cdn.tailwindcss.com"></script>

<style>
body{
font-family:Inter;
background:#f6f8fc;
}

.main{
margin-left:250px;
padding:30px;
min-height:100vh;
}

.card{
transition:0.3s;
}

.card:hover{
transform:translateY(-5px);
}
</style>

</head>

<body>

<!-- SIDEBAR -->
<?php include "layout/sidebar.php"; ?>


<div class="main">

<h2 class="text-2xl font-bold mb-6">
HOD Dashboard
</h2>


<div class="grid grid-cols-3 md:grid-cols-6 gap-6">

<!-- STUDENTS -->
<div class="bg-white p-6 rounded-xl shadow text-center card">
<p class="text-gray-500">Students</p>
<p class="text-2xl font-bold"><?php echo $students; ?></p>
</div>

<!-- FACULTY -->
<div class="bg-white p-6 rounded-xl shadow text-center card">
<p class="text-gray-500">Faculty</p>
<p class="text-2xl font-bold"><?php echo $faculty; ?></p>
</div>

<!-- SUBJECTS -->
<div class="bg-white p-6 rounded-xl shadow text-center card">
<p class="text-gray-500">Subjects</p>
<p class="text-2xl font-bold"><?php echo $subjects; ?></p>
</div>

<!-- PENDING -->
<div class="bg-red-100 p-6 rounded-xl shadow text-center card">
<p class="text-red-600">Pending Requests</p>
<p class="text-2xl font-bold text-red-600"><?php echo $condonation; ?></p>
</div>

<!-- LOW ATTENDANCE -->
<div class="bg-yellow-100 p-6 rounded-xl shadow text-center card">
<p class="text-yellow-600">Low Attendance</p>
<p class="text-2xl font-bold text-yellow-700">
<?php echo $low_attendance; ?>
</p>
</div>

<!-- AVG ATTENDANCE -->
<div class="bg-blue-100 p-6 rounded-xl shadow text-center card">
<p class="text-blue-600">Avg Attendance</p>
<p class="text-2xl font-bold text-blue-700">
<?php echo $avg_attendance; ?>%
</p>
</div>

</div>

</div>

</body>
</html>