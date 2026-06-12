<?php
session_start();
include "../config/db.php";

$page_title = "Attendance Overview";
include "layout/layout.php";

/* TEMP LOGIN */
$parent_id = 1;

/* GET STUDENT */

$student = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT students.*, departments.department_name
FROM parents
JOIN students ON parents.student_id = students.student_id
LEFT JOIN departments ON students.department_id = departments.department_id
WHERE parents.parent_id='$parent_id'
"));

$student_id = $student['student_id'];


/* OVERALL ATTENDANCE */

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


/* MONTHLY DATA */

$data = mysqli_query($conn,"
SELECT 
MONTH(date) AS month,
COUNT(*) AS total,
SUM(CASE WHEN status='Present' THEN 1 ELSE 0 END) AS present
FROM attendance
WHERE student_id='$student_id'
GROUP BY MONTH(date)
ORDER BY MONTH(date)
");

$months=[];
$percentages=[];

while($row=mysqli_fetch_assoc($data)){

$total=$row['total'];
$present=$row['present'];

$percent=0;

if($total>0){
$percent=round(($present/$total)*100,2);
}

$months[]=$row['month'];
$percentages[]=$percent;

}

?>


<style>

.stat-card{
background:white;
border-radius:16px;
padding:22px;
box-shadow:0 10px 25px rgba(0,0,0,0.05);
transition:0.3s;
}

.stat-card:hover{
transform:translateY(-6px);
box-shadow:0 20px 40px rgba(0,0,0,0.08);
}

</style>



<h2 class="text-2xl font-semibold mb-8">
Child Attendance Overview
</h2>


<!-- STUDENT INFO -->

<div class="bg-white p-6 rounded-xl shadow mb-8">

<h3 class="text-lg font-semibold mb-2">
<?php echo $student['name']; ?>
</h3>

<p class="text-gray-500">
Department: <?php echo $student['department_name']; ?>
</p>

<p class="text-gray-500">
Semester: <?php echo $student['semester']; ?>
</p>

</div>



<!-- ATTENDANCE STATS -->

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



<!-- WARNING -->

<?php if($percentage < 75){ ?>

<div class="bg-red-100 text-red-700 p-4 rounded mb-8">

⚠ Attendance below 75%. Student may need **condonation approval**.

</div>

<?php } ?>



<!-- MONTHLY CHART -->

<div class="bg-white p-8 rounded-xl shadow">

<h3 class="font-semibold mb-6">
Monthly Attendance Trend
</h3>

<canvas id="attendanceChart"></canvas>

</div>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById("attendanceChart").getContext("2d");

const gradient = ctx.createLinearGradient(0,0,0,400);

gradient.addColorStop(0,"rgba(99,102,241,0.35)");
gradient.addColorStop(1,"rgba(99,102,241,0.05)");

new Chart(ctx,{

type:'line',

data:{
labels: <?php echo json_encode($months); ?>,

datasets:[{

data: <?php echo json_encode($percentages); ?>,

borderColor:'#6366f1',

backgroundColor:gradient,

fill:true,

tension:0.4,

borderWidth:3,

pointRadius:5

}]
},

options:{
plugins:{legend:{display:false}},
animation:{duration:1500},
scales:{
y:{min:0,max:100},
x:{grid:{display:false}}
}
}

});

</script>


<?php include "layout/footer.php"; ?>