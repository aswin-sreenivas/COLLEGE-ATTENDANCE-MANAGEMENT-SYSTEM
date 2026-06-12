<?php
session_start();
include "../config/db.php";

$page_title="Subject Attendance";
include "layout/layout.php";

$user_id = $_SESSION['user_id'];


/* GET STUDENT ID */

$student = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT student_id
FROM students
WHERE user_id='$user_id'
"));

$student_id = $student['student_id'];

/* SUBJECT ATTENDANCE QUERY */

$result = mysqli_query($conn,"
SELECT 

subjects.subject_name,

COUNT(attendance.attendance_id) AS total_classes,

SUM(CASE WHEN attendance.status='Present' THEN 1 ELSE 0 END) AS present_classes

FROM attendance

JOIN subjects 
ON attendance.subject_id = subjects.subject_id

WHERE attendance.student_id='$student_id'

GROUP BY attendance.subject_id
");

?>


<h2 class="text-2xl font-semibold mb-8">
Subject-wise Attendance
</h2>



<div class="bg-white p-6 rounded-xl shadow card">

<table class="w-full text-sm">

<thead class="border-b text-gray-500">

<tr>

<th class="py-2 text-left">Subject</th>
<th>Total Classes</th>
<th>Present</th>
<th>Attendance %</th>

</tr>

</thead>

<tbody>

<?php while($row = mysqli_fetch_assoc($result)){

$total = $row['total_classes'];
$present = $row['present_classes'];

$percentage = 0;

if($total > 0){
$percentage = round(($present/$total)*100,2);
}

?>

<tr class="border-b hover:bg-gray-50">

<td class="py-2">
<?php echo $row['subject_name']; ?>
</td>

<td>
<?php echo $total; ?>
</td>

<td>
<?php echo $present; ?>
</td>

<td>

<?php if($percentage < 75){ ?>

<span class="text-red-500 font-semibold">
<?php echo $percentage ?>%
</span>

<?php } else { ?>

<span class="text-green-600 font-semibold">
<?php echo $percentage ?>%
</span>

<?php } ?>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>


<?php include "layout/footer.php"; ?>