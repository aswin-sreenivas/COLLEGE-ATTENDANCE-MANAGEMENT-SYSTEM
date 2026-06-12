<?php
session_start();
include "../config/db.php";

$students = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM students"));
$faculty = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM faculty"));
$parents = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM parents"));
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>CAMS Dashboard</title>

<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

<style>

body{
font-family:'Inter',sans-serif;
background:#f6f8fc;
overflow-x:hidden;
}

/* sidebar */

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
transition:0.25s;
color:#cbd5e1;
}

.menu:hover{
background:#1e293b;
color:white;
transform:translateX(6px);
}

/* main */

.main{
margin-left:250px;
padding:30px;
}

/* cards */

.card{
transition:0.35s;
position:relative;
overflow:hidden;
}

.card:hover{
transform:translateY(-8px) scale(1.02);
box-shadow:0 20px 40px rgba(0,0,0,0.08);
}

/* animated highlight */

.card:before{
content:'';
position:absolute;
width:100%;
height:100%;
background:linear-gradient(120deg,transparent,rgba(255,255,255,0.4),transparent);
left:-100%;
top:0;
transition:0.6s;
}

.card:hover:before{
left:100%;
}

/* fade animation */

.fade{
opacity:0;
transform:translateY(30px);
animation:fadeUp 0.8s forwards;
}

@keyframes fadeUp{
to{
opacity:1;
transform:translateY(0);
}
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

/* floating blur */

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

<h1 class="text-xl font-bold mb-6">CAMS</h1>

<div class="space-y-2 text-sm">

<a href="dashboard.php" class="menu bg-indigo-600 text-white">
Dashboard
</a>

<!-- USER MANAGEMENT -->

<p class="text-gray-400 text-xs mt-4 mb-1">USER MANAGEMENT</p>

<a href="manage_students.php" class="menu">Manage Students</a>

<a href="manage_faculty.php" class="menu">Manage Faculty</a>

<a href="manage_parents.php" class="menu">Manage Parents</a>

<a href="user_management.php" class="menu">User Accounts</a>

<a href="approve_users.php" class="menu">
Approve Registrations
</a>

<!-- ACADEMIC -->

<p class="text-gray-400 text-xs mt-4 mb-1">ACADEMIC</p>

<a href="manage_departments.php" class="menu">Departments</a>

<a href="manage_courses.php" class="menu">Courses</a>

<a href="manage_subjects.php" class="menu">Subjects</a>

<a href="assign_subjects.php" class="menu">Assign Subjects</a>


<!-- ATTENDANCE -->

<p class="text-gray-400 text-xs mt-4 mb-1">ATTENDANCE</p>

<a href="attendance_records.php" class="menu">Attendance Records</a>

<a href="attendance_reports.php" class="menu">Attendance Reports</a>



<!-- NOTIFICATIONS -->

<p class="text-gray-400 text-xs mt-4 mb-1">NOTIFICATIONS</p>

<a href="notifications.php" class="menu">Notifications</a>


<!-- SYSTEM -->

<p class="text-gray-400 text-xs mt-4 mb-1">SYSTEM</p>

<a href="settings.php" class="menu">System Settings</a>

<a href="../logout.php" class="menu text-red-400">Logout</a>


</div>

</div>



<!-- MAIN -->

<div class="main">

<div class="flex justify-between items-center mb-10 fade">

<h2 class="text-2xl font-semibold">
Admin Overview
</h2>

<button class="btn px-5 py-2 rounded-lg">
Export Report
</button>

</div>



<!-- STATS -->

<div class="grid grid-cols-4 gap-6 mb-10">

<div class="bg-white p-6 rounded-xl shadow card fade">

<p class="text-gray-500 text-sm">Total Students</p>

<h2 class="text-3xl font-bold text-indigo-600 counter">
<?php echo $students ?>
</h2>

</div>


<div class="bg-white p-6 rounded-xl shadow card fade">

<p class="text-gray-500 text-sm">Total Faculty</p>

<h2 class="text-3xl font-bold text-green-600 counter">
<?php echo $faculty ?>
</h2>

</div>


<div class="bg-white p-6 rounded-xl shadow card fade">

<p class="text-gray-500 text-sm">Total Parents</p>

<h2 class="text-3xl font-bold text-purple-600 counter">
<?php echo $parents ?>
</h2>

</div>


<div class="bg-white p-6 rounded-xl shadow card fade">

<p class="text-gray-500 text-sm">Attendance Rate</p>

<h2 class="text-3xl font-bold text-orange-500">
89.4%
</h2>

</div>

</div>



<!-- CHARTS -->

<div class="grid grid-cols-3 gap-6 fade">

<div class="col-span-2 bg-white p-6 rounded-xl shadow card">

<h3 class="font-semibold mb-4">
Monthly Attendance Trends
</h3>

<canvas id="attendanceChart"></canvas>

</div>


<div class="bg-white p-6 rounded-xl shadow card">

<h3 class="font-semibold mb-4">
Department Performance
</h3>

<canvas id="deptChart"></canvas>

</div>

</div>

</div>



<script>

/* animated counters */

const counters=document.querySelectorAll(".counter");

counters.forEach(counter=>{

let start=0;
const end=parseInt(counter.innerText);
const speed=20;

const update=()=>{

start += Math.ceil(end/50);

if(start<end){
counter.innerText=start;
setTimeout(update,speed);
}else{
counter.innerText=end;
}

};

update();

});


/* attendance chart */

const ctx=document.getElementById("attendanceChart").getContext("2d");

const gradient=ctx.createLinearGradient(0,0,0,400);

gradient.addColorStop(0,"rgba(99,102,241,0.35)");
gradient.addColorStop(1,"rgba(99,102,241,0.05)");

new Chart(ctx,{
type:'line',
data:{
labels:['Jan','Feb','Mar','Apr','May','Jun'],
datasets:[{
data:[85,88,92,90,95,89],
borderColor:'#6366f1',
backgroundColor:gradient,
fill:true,
tension:0.45,
borderWidth:3
}]
},
options:{
plugins:{legend:{display:false}},
animation:{duration:1500},
scales:{
y:{grid:{color:'#e5e7eb'}},
x:{grid:{display:false}}
}
}
});


/* department chart */

new Chart(document.getElementById("deptChart"),{
type:'bar',
data:{
labels:['Computer','Mechanical','Electrical','Civil','Business'],
datasets:[{
data:[92,85,88,83,90],
backgroundColor:'#6366f1',
borderRadius:6
}]
},
options:{
indexAxis:'y',
plugins:{legend:{display:false}},
animation:{duration:1200},
scales:{
x:{grid:{color:'#e5e7eb'}},
y:{grid:{display:false}}
}
}
});

</script>

</body>
</html>