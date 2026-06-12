<?php
session_start();
include "../config/db.php";

$page_title="Subject Attendance";
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


/* SUBJECT ATTENDANCE */

$result = mysqli_query($conn,"
SELECT 
subjects.subject_name,
COUNT(attendance.attendance_id) AS total,
SUM(CASE WHEN attendance.status='Present' THEN 1 ELSE 0 END) AS present
FROM attendance
JOIN subjects ON attendance.subject_id = subjects.subject_id
WHERE attendance.student_id='$student_id'
GROUP BY attendance.subject_id
");

?>


<style>

.subject-card{
background:white;
border-radius:14px;
padding:20px;
box-shadow:0 10px 25px rgba(0,0,0,0.05);
margin-bottom:18px;
transition:0.3s;
}

.subject-card:hover{
transform:translateY(-4px);
box-shadow:0 18px 35px rgba(0,0,0,0.08);
}

.progress-bar{
height:10px;
border-radius:10px;
background:#e5e7eb;
overflow:hidden;
margin-top:8px;
}

.progress-fill{
height:100%;
border-radius:10px;
}

</style>



<h2 class="text-2xl font-semibold mb-8">
Subject Attendance
</h2>


<!-- STUDENT INFO -->

<div class="bg-white p-6 rounded-xl shadow mb-8">

<h3 class="text-lg font-semibold">
<?php echo $student['name']; ?>
</h3>

<p class="text-gray-500">
<?php echo $student['department_name']; ?> • Semester <?php echo $student['semester']; ?>
</p>

</div>



<?php while($row=mysqli_fetch_assoc($result)){

$total=$row['total'];
$present=$row['present'];

$percent=0;

if($total>0){
$percent=round(($present/$total)*100,2);
}

/* COLOR */

$color="bg-green-500";

if($percent<75){
$color="bg-red-500";
}elseif($percent<85){
$color="bg-yellow-500";
}

?>


<div class="subject-card">

<div class="flex justify-between items-center">

<div>

<h4 class="font-semibold text-lg">
<?php echo $row['subject_name']; ?>
</h4>

<p class="text-sm text-gray-500">
<?php echo $present ?> / <?php echo $total ?> Classes
</p>

</div>

<div class="text-right">

<p class="text-lg font-bold">
<?php echo $percent ?>%
</p>

</div>

</div>


<div class="progress-bar">

<div class="progress-fill <?php echo $color ?>"
style="width:<?php echo $percent ?>%">
</div>

</div>

</div>


<?php } ?>


<?php include "layout/footer.php"; ?>