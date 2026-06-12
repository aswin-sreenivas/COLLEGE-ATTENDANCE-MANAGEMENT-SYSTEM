<?php
session_start();
include "../config/db.php";

$page_title="Attendance Overview";
include "layout/layout.php";

/* TEMP STUDENT LOGIN */
$user_id = $_SESSION['user_id'];


/* GET STUDENT ID */

$student = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT student_id
FROM students
WHERE user_id='$user_id'
"));

$student_id = $student['student_id'];


/* GET STUDENT SEMESTER */

$student = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT semester FROM students
WHERE student_id='$student_id'
"));

$semester = $student['semester'];


/* TOTAL CLASSES */

$total = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM attendance
WHERE student_id='$student_id'
"));

$total_classes = $total['total'];


/* PRESENT */

$present = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) AS present
FROM attendance
WHERE student_id='$student_id'
AND status='Present'
"));

$present_classes = $present['present'];


/* ABSENT */

$absent_classes = $total_classes - $present_classes;


/* PERCENTAGE */

$percentage = 0;

if($total_classes > 0){
$percentage = round(($present_classes/$total_classes)*100,2);
}

?>


<h2 class="text-2xl font-semibold mb-8">
Attendance Overview (Semester <?php echo $semester ?>)
</h2>



<!-- CARDS -->

<div class="grid grid-cols-4 gap-6 mb-10">

<div class="bg-white p-6 rounded-xl shadow card">

<p class="text-gray-500 text-sm">Total Classes</p>

<h2 class="text-3xl font-bold text-indigo-600">
<?php echo $total_classes ?>
</h2>

</div>


<div class="bg-white p-6 rounded-xl shadow card">

<p class="text-gray-500 text-sm">Present</p>

<h2 class="text-3xl font-bold text-green-600">
<?php echo $present_classes ?>
</h2>

</div>


<div class="bg-white p-6 rounded-xl shadow card">

<p class="text-gray-500 text-sm">Absent</p>

<h2 class="text-3xl font-bold text-red-500">
<?php echo $absent_classes ?>
</h2>

</div>


<div class="bg-white p-6 rounded-xl shadow card">

<p class="text-gray-500 text-sm">Attendance %</p>

<h2 class="text-3xl font-bold text-orange-500">
<?php echo $percentage ?>%
</h2>

</div>

</div>



<!-- MONTHLY TABLE -->

<div class="bg-white p-6 rounded-xl shadow card">

<h3 class="font-semibold mb-4">
Monthly Attendance
</h3>

<table class="w-full text-sm">

<thead class="border-b text-gray-500">

<tr>

<th class="py-2 text-left">Month</th>
<th>Total Classes</th>
<th>Present</th>
<th>Attendance %</th>

</tr>

</thead>

<tbody>

<?php

$monthly = mysqli_query($conn,"
SELECT 

DATE_FORMAT(date,'%M') AS month,

COUNT(*) AS total,

SUM(CASE WHEN status='Present' THEN 1 ELSE 0 END) AS present

FROM attendance

WHERE student_id='$student_id'

GROUP BY MONTH(date)
");


while($row=mysqli_fetch_assoc($monthly)){

$total = $row['total'];
$present = $row['present'];

$percent = 0;

if($total>0){
$percent = round(($present/$total)*100,2);
}

?>

<tr class="border-b hover:bg-gray-50">

<td class="py-2">
<?php echo $row['month']; ?>
</td>

<td>
<?php echo $total; ?>
</td>

<td>
<?php echo $present; ?>
</td>

<td>

<?php if($percent < 75){ ?>

<span class="text-red-500 font-semibold">
<?php echo $percent ?>%
</span>

<?php } else { ?>

<span class="text-green-600 font-semibold">
<?php echo $percent ?>%
</span>

<?php } ?>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>


<?php include "layout/footer.php"; ?>