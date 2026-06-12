<?php
if(!isset($page_title)){
$page_title="Faculty Panel";
}
?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title><?php echo $page_title; ?></title>

<script src="https://cdn.tailwindcss.com"></script>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

<style>

body{
font-family:'Inter',sans-serif;
background:#f6f8fc;
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

/* MENU */

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

/* MAIN */

.main{
margin-left:250px;
padding:30px;
}

/* CARD */

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


<p class="text-gray-400 text-xs mt-4 mb-1">ATTENDANCE</p>

<a href="take_attendance.php" class="menu">
Take Attendance
</a>

<a href="edit_attendance.php" class="menu">
Edit Attendance
</a>

<a href="attendance_history.php" class="menu">
Attendance History
</a>

<a href="attendance_reports.php" class="menu">
Attendance Reports
</a>


<p class="text-gray-400 text-xs mt-4 mb-1">ANALYTICS</p>

<a href="class_statistics.php" class="menu">
Class Statistics
</a>

<a href="subject_statistics.php" class="menu">
Subject Analytics
</a>


<p class="text-gray-400 text-xs mt-4 mb-1">STUDENTS</p>

<a href="student_list.php" class="menu">
View Students
</a>

<a href="low_attendance.php" class="menu">
Low Attendance Students
</a>


<p class="text-gray-400 text-xs mt-4 mb-1">NOTIFICATIONS</p>

<a href="notifications.php" class="menu">
Notifications
</a>


<p class="text-gray-400 text-xs mt-4 mb-1">ACCOUNT</p>

<a href="profile.php" class="menu">
Profile Settings
</a>

<a href="../logout.php" class="menu text-red-400">
Logout
</a>

</div>

</div>


<!-- MAIN CONTENT -->

<div class="main">