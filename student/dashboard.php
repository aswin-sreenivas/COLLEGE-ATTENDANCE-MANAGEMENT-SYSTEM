<?php
session_start();
include "../config/db.php";

$page_title="Dashboard";
include "layout/layout.php";

/* SESSION USER */

$user_id = $_SESSION['user_id'];


/* GET STUDENT ID */

$student = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT student_id
FROM students
WHERE user_id='$user_id'
"));

$student_id = $student['student_id'];


/* TOTAL CLASSES */

$total_classes = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM attendance
WHERE student_id='$student_id'
"))['total'];


/* PRESENT */

$present = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM attendance
WHERE student_id='$student_id'
AND LOWER(TRIM(status))='present'
"))['total'];


/* ABSENT */

$absent = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM attendance
WHERE student_id='$student_id'
AND LOWER(TRIM(status))='absent'
"))['total'];


/* LATE */

$late = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM attendance
WHERE student_id='$student_id'
AND LOWER(TRIM(status))='late'
"))['total'];


/* CONVERT LATE → ABSENT */

$converted_absent = floor($late / 3);


/* FINAL ABSENT */

$total_absent = $absent + $converted_absent;


/* EFFECTIVE PRESENT */

$effective_present = $present - $converted_absent;

if($effective_present < 0){
$effective_present = 0;
}


/* ATTENDANCE % */

if($total_classes > 0){
$attendance_percentage = (($effective_present / $total_classes) * 100);
}else{
$attendance_percentage = 0;
}

?>


<h2 class="text-2xl font-semibold mb-8">

Student Dashboard
</h2>


<!-- CARDS -->

<div class="grid grid-cols-4 gap-6 mb-8">

<div class="bg-white p-6 rounded-xl shadow text-center">
<h3 class="text-gray-500 text-sm">Total Classes</h3>
<p class="text-2xl font-bold"><?php echo $total_classes; ?></p>
</div>

<div class="bg-green-100 p-6 rounded-xl text-center">
<h3 class="text-green-700 text-sm">Present</h3>
<p class="text-2xl font-bold text-green-700">
<?php echo $effective_present; ?>
</p>
</div>

<div class="bg-yellow-100 p-6 rounded-xl text-center">
<h3 class="text-yellow-700 text-sm">Late</h3>
<p class="text-2xl font-bold text-yellow-700">
<?php echo $late; ?>
</p>
</div>

<div class="bg-red-100 p-6 rounded-xl text-center">
<h3 class="text-red-700 text-sm">Absent</h3>
<p class="text-2xl font-bold text-red-700">
<?php echo $total_absent; ?>
</p>
</div>

</div>


<!-- DETAILS -->

<div class="bg-white p-6 rounded-xl shadow mb-8">

<h3 class="font-semibold mb-4">
Attendance Breakdown
</h3>

<div class="grid grid-cols-3 gap-6 text-center">

<div>
<p class="text-gray-500 text-sm">Actual Absent</p>
<p class="text-xl font-bold">
<?php echo $absent; ?>
</p>
</div>

<div>
<p class="text-gray-500 text-sm">Late → Absent</p>
<p class="text-xl font-bold">
<?php echo $converted_absent; ?>
</p>
</div>

<div>
<p class="text-gray-500 text-sm">Final Absent</p>
<p class="text-xl font-bold text-red-600">
<?php echo $total_absent; ?>
</p>
</div>

</div>

</div>


<!-- PERCENTAGE -->

<div class="bg-white p-6 rounded-xl shadow">

<h3 class="font-semibold mb-4">
Attendance Percentage
</h3>

<div class="w-full bg-gray-200 rounded-full h-4 mb-3">

<div
class="h-4 rounded-full 
<?php echo ($attendance_percentage < 75) ? 'bg-red-500' : 'bg-green-500'; ?>"
style="width:<?php echo $attendance_percentage; ?>%">
</div>

</div>

<p class="text-lg font-bold">
<?php echo round($attendance_percentage,2); ?>%
</p>


<?php if($attendance_percentage < 75){ ?>

<div class="mt-4 text-red-600 font-medium">
⚠ Attendance below 75% - Condonation required
</div>

<?php } ?>

</div>


<?php include "layout/footer.php"; ?>