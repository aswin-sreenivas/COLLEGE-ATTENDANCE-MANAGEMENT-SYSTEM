<?php
session_start();
include "../config/db.php";

$page_title = "Parent Dashboard";
include "layout/layout.php";

/* TEMP LOGIN (replace with session later) */
$parent_id = 1;

/* GET STUDENT LINKED TO PARENT */

$student = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT students.*
FROM parents
JOIN students
ON parents.student_id = students.student_id
WHERE parents.parent_id='$parent_id'
"));

$student_id = $student['student_id'];


/* ATTENDANCE SUMMARY */

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

if($total_classes > 0){
$percentage = round(($present_classes/$total_classes)*100,2);
}
?>

<style>

/* SaaS cards */

.stat-card{
background:white;
border-radius:16px;
padding:24px;
box-shadow:0 10px 25px rgba(0,0,0,0.05);
transition:0.3s;
}

.stat-card:hover{
transform:translateY(-6px);
box-shadow:0 20px 40px rgba(0,0,0,0.08);
}

</style>


<h2 class="text-2xl font-semibold mb-8">
Parent Dashboard
</h2>


<!-- STUDENT INFO -->

<div class="bg-white p-6 rounded-xl shadow mb-8">

<p class="text-gray-500 text-sm">
Student Name
</p>

<h3 class="text-xl font-semibold">
<?php echo $student['name']; ?>
</h3>

</div>


<!-- STATS -->

<div class="grid grid-cols-4 gap-6 mb-10">


<div class="stat-card">

<p class="text-gray-500 text-sm">
Total Classes
</p>

<h2 class="text-3xl font-bold text-indigo-600">
<?php echo $total_classes ?>
</h2>

</div>


<div class="stat-card">

<p class="text-gray-500 text-sm">
Classes Attended
</p>

<h2 class="text-3xl font-bold text-green-600">
<?php echo $present_classes ?>
</h2>

</div>


<div class="stat-card">

<p class="text-gray-500 text-sm">
Classes Missed
</p>

<h2 class="text-3xl font-bold text-red-500">
<?php echo $absent_classes ?>
</h2>

</div>


<div class="stat-card">

<p class="text-gray-500 text-sm">
Attendance %
</p>

<h2 class="text-3xl font-bold text-orange-500">
<?php echo $percentage ?>%
</h2>

</div>


</div>



<!-- SaaS DONUT CHART -->

<div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition">

<h3 class="text-lg font-semibold mb-6 text-gray-700">
Attendance Overview
</h3>


<div class="flex justify-center">

<div class="relative w-64 h-64">

<canvas id="chart"></canvas>

<div class="absolute inset-0 flex items-center justify-center">

<div class="text-center">

<p class="text-gray-500 text-sm">
Attendance
</p>

<p class="text-4xl font-bold text-indigo-600">
<?php echo $percentage ?>%
</p>

</div>

</div>

</div>

</div>


<div class="flex justify-center gap-8 mt-6 text-sm">

<div class="flex items-center gap-2">
<span class="w-3 h-3 rounded-full bg-green-500"></span>
Present
</div>

<div class="flex items-center gap-2">
<span class="w-3 h-3 rounded-full bg-red-500"></span>
Absent
</div>

</div>


</div>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById("chart").getContext("2d");

/* gradients */

const gradientGreen = ctx.createLinearGradient(0,0,0,300);
gradientGreen.addColorStop(0,"#4ade80");
gradientGreen.addColorStop(1,"#22c55e");

const gradientRed = ctx.createLinearGradient(0,0,0,300);
gradientRed.addColorStop(0,"#fb7185");
gradientRed.addColorStop(1,"#ef4444");

new Chart(ctx,{

type:'doughnut',

data:{
labels:['Present','Absent'],
datasets:[{
data:[<?php echo $present_classes ?>,<?php echo $absent_classes ?>],
backgroundColor:[gradientGreen,gradientRed],
borderWidth:0
}]
},

options:{

cutout:'75%',

plugins:{
legend:{
display:false
}
},

animation:{
duration:1500,
easing:'easeOutQuart'
}

}

});

</script>


<?php include "layout/footer.php"; ?>