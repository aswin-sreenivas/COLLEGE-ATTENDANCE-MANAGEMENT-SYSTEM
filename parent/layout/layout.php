<?php
if(!isset($page_title)){
$page_title="Parent Panel";
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


<div class="sidebar">

<h1 class="text-xl font-bold mb-10">
Parent Panel
</h1>

<div class="space-y-2 text-sm">

<a href="dashboard.php" class="menu">
Dashboard
</a>


<p class="text-gray-400 text-xs mt-4 mb-1">ATTENDANCE</p>

<a href="attendance_overview.php" class="menu">
Child Attendance Overview
</a>

<a href="subject_attendance.php" class="menu">
Subject Attendance
</a>

<a href="attendance_history.php" class="menu">
Attendance History
</a>


<p class="text-gray-400 text-xs mt-4 mb-1">REPORTS</p>

<a href="download_report.php" class="menu">
Download Attendance Report
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

<div class="main">