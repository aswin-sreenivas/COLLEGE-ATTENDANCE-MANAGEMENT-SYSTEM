<?php
session_start();
include "../config/db.php";

$faculty_id = 1;

/* FILTER */

$subject_filter = $_GET['subject_id'] ?? "";


/* SUBJECT LIST */

$subjects = mysqli_query($conn,"
SELECT subjects.*
FROM subjects
JOIN faculty_subjects
ON subjects.subject_id = faculty_subjects.subject_id
WHERE faculty_subjects.faculty_id='$faculty_id'
");


/* REPORT QUERY */

$query = "
SELECT 
students.student_id,
students.name AS student_name,
subjects.subject_name,
subjects.subject_id,

COUNT(attendance.attendance_id) AS total_classes,

SUM(CASE WHEN attendance.status='Present' THEN 1 ELSE 0 END) AS present_classes

FROM attendance

JOIN students
ON attendance.student_id = students.student_id

JOIN subjects
ON attendance.subject_id = subjects.subject_id

WHERE attendance.faculty_id='$faculty_id'
";

if($subject_filter!=""){
$query .= " AND attendance.subject_id='$subject_filter'";
}

$query .= "

GROUP BY students.student_id, attendance.subject_id
ORDER BY students.name
";

$result = mysqli_query($conn,$query);

?>

<!DOCTYPE html>
<html>

<head>

<title>Attendance Reports</title>

<script src="https://cdn.tailwindcss.com"></script>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

<style>

body{
font-family:'Inter',sans-serif;
background:#f6f8fc;
}

.sidebar{
width:250px;
height:100vh;
background:#0f172a;
position:fixed;
color:white;
padding:25px;
}

.menu{
padding:10px;
border-radius:8px;
display:block;
color:#cbd5e1;
transition:0.25s;
}

.menu:hover{
background:#1e293b;
color:white;
transform:translateX(6px);
}

.main{
margin-left:250px;
padding:30px;
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

<div class="sidebar">

<h1 class="text-xl font-bold mb-10">Faculty Panel</h1>

<div class="space-y-2 text-sm">

<a href="dashboard.php" class="menu">Dashboard</a>

<a href="take_attendance.php" class="menu">Take Attendance</a>

<a href="attendance_history.php" class="menu">Attendance History</a>

<a href="reports.php" class="menu bg-indigo-600 text-white">
Reports
</a>

<a href="../logout.php" class="menu text-red-400">Logout</a>

</div>

</div>



<div class="main">

<h2 class="text-2xl font-semibold mb-8">
Attendance Reports
</h2>



<!-- FILTER -->

<div class="bg-white p-6 rounded-xl shadow mb-8 card">

<form method="GET" class="grid grid-cols-3 gap-4">

<select name="subject_id" class="border p-2 rounded">

<option value="">All Subjects</option>

<?php while($s=mysqli_fetch_assoc($subjects)){ ?>

<option value="<?php echo $s['subject_id']; ?>">
<?php echo $s['subject_name']; ?>
</option>

<?php } ?>

</select>

<button class="bg-indigo-600 text-white px-4 py-2 rounded">
Generate Report
</button>

</form>

</div>



<!-- REPORT TABLE -->

<div class="bg-white p-6 rounded-xl shadow card">

<table class="w-full text-sm">

<thead class="border-b text-gray-500">

<tr>

<th class="py-2 text-left">Student</th>
<th>Subject</th>
<th>Total Classes</th>
<th>Present</th>
<th>Attendance %</th>

</tr>

</thead>

<tbody>

<?php while($row=mysqli_fetch_assoc($result)){ 

$total = $row['total_classes'];
$present = $row['present_classes'];

$percentage = 0;

if($total>0){
$percentage = round(($present/$total)*100,2);
}

?>

<tr class="border-b hover:bg-gray-50">

<td class="py-2">
<?php echo $row['student_name']; ?>
</td>

<td>
<?php echo $row['subject_name']; ?>
</td>

<td>
<?php echo $total; ?>
</td>

<td>
<?php echo $present; ?>
</td>

<td>

<?php if($percentage>=75){ ?>

<span class="text-green-600 font-semibold">
<?php echo $percentage; ?>%
</span>

<?php } else { ?>

<span class="text-red-500 font-semibold">
<?php echo $percentage; ?>%
</span>

<?php } ?>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>


</div>

</body>
</html>