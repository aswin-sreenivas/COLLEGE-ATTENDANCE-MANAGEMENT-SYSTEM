<?php
session_start();

include("../config/db.php");

/* LOGIN CHECK */

if(
!isset($_SESSION['role']) ||
$_SESSION['role']!="hod"
){
header("Location: ../login.php");
exit();
}

/* SESSION */

$department_id = $_SESSION['department_id'] ?? 1;

$hod_name = $_SESSION['name'] ?? "HOD";

/* TOTAL STUDENTS */

$student_query = mysqli_query($conn,"
SELECT COUNT(*) as total
FROM students
WHERE department_id='$department_id'
");

$total_students = mysqli_fetch_assoc($student_query)['total'] ?? 0;

/* TOTAL FACULTY */

$faculty_query = mysqli_query($conn,"
SELECT COUNT(*) as total
FROM faculty
WHERE department_id='$department_id'
");

$total_faculty = mysqli_fetch_assoc($faculty_query)['total'] ?? 0;

/* TOTAL SUBJECTS */

$subject_query = mysqli_query($conn,"
SELECT COUNT(*) as total
FROM subjects
WHERE department_id='$department_id'
");

$total_subjects = mysqli_fetch_assoc($subject_query)['total'] ?? 0;

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>HOD Dashboard</title>

<script src="https://cdn.tailwindcss.com"></script>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

<style>

body{
font-family:'Inter',sans-serif;
background:#f6f8fc;
overflow-x:hidden;
}

/* SIDEBAR */

.sidebar{
width:250px;
height:100vh;
background:#0f172a;
position:fixed;
color:white;
padding:25px;
overflow-y:auto;
}

.menu{
padding:12px;
border-radius:8px;
display:block;
transition:0.25s;
color:#cbd5e1;
text-decoration:none;
margin-bottom:8px;
}

.menu:hover{
background:#1e293b;
color:white;
transform:translateX(6px);
}

.active{
background:#6366f1;
color:white;
}

/* MAIN */

.main{
margin-left:250px;
padding:30px;
}

/* CARDS */

.card{
transition:0.35s;
position:relative;
overflow:hidden;
}

.card:hover{
transform:translateY(-8px) scale(1.02);
box-shadow:0 20px 40px rgba(0,0,0,0.08);
}

/* animated shine */

.card:before{
content:'';
position:absolute;
width:100%;
height:100%;
background:linear-gradient(
120deg,
transparent,
rgba(255,255,255,0.4),
transparent
);
left:-100%;
top:0;
transition:0.6s;
}

.card:hover:before{
left:100%;
}

/* button */

.btn{
background:linear-gradient(135deg,#6366f1,#4f46e5);
color:white;
transition:0.3s;
}

.btn:hover{
transform:scale(1.05);
box-shadow:0 10px 25px rgba(99,102,241,0.4);
}

/* blur */

.bg-blob{
position:absolute;
width:400px;
height:400px;
background:#6366f1;
filter:blur(120px);
opacity:0.15;
top:-100px;
right:-100px;
}

</style>

</head>

<body>

<div class="bg-blob"></div>

<!-- SIDEBAR -->

<div class="sidebar">

<h1 class="text-2xl font-bold mb-8">
CAMS HOD
</h1>

<div class="space-y-2 text-sm">

<a href="dashboard.php" class="menu active">
Dashboard
</a>

<a href="manage_students.php" class="menu">
Manage Students
</a>

<a href="manage_staff.php" class="menu">
Manage Faculty
</a>

<a href="manage_subjects.php" class="menu">
Manage Subjects
</a>

<a href="assign_subjects.php" class="menu">
Assign Subjects
</a>

<a href="reports.php" class="menu">
Reports
</a>

<a href="../logout.php" class="menu text-red-400">
Logout
</a>

</div>

</div>

<!-- MAIN -->

<div class="main">

<div class="flex justify-between items-center mb-10">

<div>

<h2 class="text-3xl font-semibold">
Welcome,
<span class="text-indigo-600">
<?php echo $hod_name; ?>
</span>
</h2>

<p class="text-gray-500 mt-2">
Department Management Dashboard
</p>

</div>

<button class="btn px-5 py-2 rounded-lg">
HOD Panel
</button>

</div>

<!-- STATS -->

<div class="grid grid-cols-3 gap-6 mb-10">

<div class="bg-white p-6 rounded-xl shadow card">

<p class="text-gray-500 text-sm">
Total Students
</p>

<h2 class="text-4xl font-bold text-indigo-600 mt-2">
<?php echo $total_students ?>
</h2>

</div>

<div class="bg-white p-6 rounded-xl shadow card">

<p class="text-gray-500 text-sm">
Total Faculty
</p>

<h2 class="text-4xl font-bold text-green-600 mt-2">
<?php echo $total_faculty ?>
</h2>

</div>

<div class="bg-white p-6 rounded-xl shadow card">

<p class="text-gray-500 text-sm">
Total Subjects
</p>

<h2 class="text-4xl font-bold text-pink-600 mt-2">
<?php echo $total_subjects ?>
</h2>

</div>

</div>

<!-- QUICK ACTIONS -->

<h3 class="text-2xl font-semibold mb-6">
Quick Actions
</h3>

<div class="grid grid-cols-2 gap-6">

<a href="manage_students.php"
class="btn p-6 rounded-2xl text-center font-semibold">

Manage Students

</a>

<a href="manage_staff.php"
class="btn p-6 rounded-2xl text-center font-semibold">

Manage Faculty

</a>

<a href="manage_subjects.php"
class="btn p-6 rounded-2xl text-center font-semibold">

Manage Subjects

</a>

<a href="assign_subjects.php"
class="btn p-6 rounded-2xl text-center font-semibold">

Assign Subjects

</a>

</div>

</div>

</body>
</html>