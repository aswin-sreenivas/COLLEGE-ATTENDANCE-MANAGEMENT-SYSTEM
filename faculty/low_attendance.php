<?php
session_start();
include "../config/db.php";

$page_title="Low Attendance Students";
include "layout/layout.php";

$faculty_id = 1;

$subject = $_GET['subject_id'] ?? "";
?>

<h2 class="text-2xl font-semibold mb-8">
Low Attendance Students
</h2>


<!-- FILTER -->

<div class="bg-white p-6 rounded-xl shadow card mb-8">

<form method="GET" class="grid grid-cols-2 gap-4">

<select name="subject_id" class="border p-2 rounded">

<option value="">Select Subject</option>

<?php

$subjects=mysqli_query($conn,"
SELECT subjects.*
FROM subjects
JOIN faculty_subjects
ON subjects.subject_id = faculty_subjects.subject_id
WHERE faculty_subjects.faculty_id='$faculty_id'
");

while($s=mysqli_fetch_assoc($subjects)){
echo "<option value='".$s['subject_id']."'>".$s['subject_name']."</option>";
}

?>

</select>

<button class="bg-indigo-600 text-white px-4 py-2 rounded">
Check Low Attendance
</button>

</form>

</div>


<?php

if($subject!=""){

$result=mysqli_query($conn,"
SELECT students.name,
COUNT(attendance.attendance_id) AS total_classes,
SUM(CASE WHEN attendance.status='Present' THEN 1 ELSE 0 END) AS present_classes
FROM attendance
JOIN students
ON attendance.student_id = students.student_id
WHERE attendance.subject_id='$subject'
GROUP BY students.student_id
");

?>

<div class="bg-white p-6 rounded-xl shadow card">

<table class="w-full text-sm">

<thead class="border-b text-gray-500">

<tr>

<th class="py-2 text-left">Student</th>
<th>Total Classes</th>
<th>Present</th>
<th>Attendance %</th>

</tr>

</thead>

<tbody>

<?php

while($row=mysqli_fetch_assoc($result)){

$total=$row['total_classes'];
$present=$row['present_classes'];

$percentage=0;

if($total>0){
$percentage=round(($present/$total)*100,2);
}

if($percentage < 75){

?>

<tr class="border-b hover:bg-red-50">

<td class="py-2">
<?php echo $row['name']; ?>
</td>

<td>
<?php echo $total; ?>
</td>

<td>
<?php echo $present; ?>
</td>

<td>
<span class="text-red-500 font-semibold">
<?php echo $percentage; ?>%
</span>
</td>

</tr>

<?php } } ?>

</tbody>

</table>

</div>

<?php } ?>


<?php include "layout/footer.php"; ?>