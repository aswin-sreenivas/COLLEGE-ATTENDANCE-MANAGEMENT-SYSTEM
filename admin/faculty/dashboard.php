<?php
session_start();
include "../config/db.php";


/* SAMPLE FACULTY ID (later use login session) */

$faculty_id = 1;


/* ASSIGNED SUBJECTS */

$subjects = mysqli_num_rows(mysqli_query($conn,"
SELECT * FROM faculty_subjects
WHERE faculty_id='$faculty_id'
"));


/* TOTAL STUDENTS */

$students = mysqli_num_rows(mysqli_query($conn,"
SELECT * FROM students
"));


/* TODAY ATTENDANCE */

$today = date("Y-m-d");

$today_att = mysqli_num_rows(mysqli_query($conn,"
SELECT * FROM attendance
WHERE date='$today'
"));


?>

<!DOCTYPE html>
<html>

<head>

<title>Faculty Dashboard</title>

<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
transition:0.25s;
color:#cbd5e1;
}

.menu:hover{
background:#1e293b;
color:white;
transform:translateX(5px);
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

<a href="dashboard.php" class="menu bg-indigo-600 text-white">
Dashboard
</a>

<a href="take_attendance.php" class="menu">
Take Attendance
</a>

<a href="attendance_history.php" class="menu">
Attendance History
</a>

<a href="reports.php" class="menu">
Reports
</a>

<a href="../logout.php" class="menu text-red-400">
Logout
</a>

</div>

</div>



<div class="main">

<h2 class="text-2xl font-semibold mb-8">
Faculty Dashboard
</h2>


<!-- STATS -->

<div class="grid grid-cols-4 gap-6 mb-10">

<div class="bg-white p-6 rounded-xl shadow card">

<p class="text-gray-500 text-sm">Assigned Subjects</p>

<h2 class="text-3xl font-bold text-indigo-600">
<?php echo $subjects ?>
</h2>

</div>


<div class="bg-white p-6 rounded-xl shadow card">

<p class="text-gray-500 text-sm">Total Students</p>

<h2 class="text-3xl font-bold text-green-600">
<?php echo $students ?>
</h2>

</div>


<div class="bg-white p-6 rounded-xl shadow card">

<p class="text-gray-500 text-sm">Attendance Taken Today</p>

<h2 class="text-3xl font-bold text-purple-600">
<?php echo $today_att ?>
</h2>

</div>


<div class="bg-white p-6 rounded-xl shadow card">

<p class="text-gray-500 text-sm">Pending Attendance</p>

<h2 class="text-3xl font-bold text-orange-500">
2
</h2>

</div>

</div>



<!-- CHART -->

<div class="bg-white p-6 rounded-xl shadow">

<h3 class="font-semibold mb-4">
Weekly Attendance
</h3>

<canvas id="chart"></canvas>

</div>


</div>


<script>

new Chart(document.getElementById("chart"),{

type:'line',

data:{
labels:['Mon','Tue','Wed','Thu','Fri'],
datasets:[{
data:[80,90,85,95,88],
borderColor:'#6366f1',
backgroundColor:'rgba(99,102,241,0.2)',
fill:true,
tension:0.4
}]
},

options:{
plugins:{legend:{display:false}}
}

});

</script>

</body>
</html>