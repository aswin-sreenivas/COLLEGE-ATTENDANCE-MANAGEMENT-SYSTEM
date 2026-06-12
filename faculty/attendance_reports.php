<?php
session_start();
include "../config/db.php";

$page_title="Attendance Reports";
include "layout/layout.php";

$faculty_id = 1;

$subject = $_GET['subject_id'] ?? "";
$from = $_GET['from_date'] ?? "";
$to = $_GET['to_date'] ?? "";

?>


<h2 class="text-2xl font-semibold mb-8">
Attendance Reports
</h2>


<!-- FILTER FORM -->

<div class="bg-white p-6 rounded-xl shadow card mb-8">

<form method="GET" class="grid grid-cols-4 gap-4">


<select name="subject_id" class="border p-2 rounded">

<option value="">All Subjects</option>

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


<input
type="date"
name="from_date"
class="border p-2 rounded"
placeholder="From Date"
>


<input
type="date"
name="to_date"
class="border p-2 rounded"
placeholder="To Date"
>


<button class="bg-indigo-600 text-white px-4 py-2 rounded">
Generate Report
</button>

</form>

</div>


<?php

$query="

SELECT
students.student_id,
students.name,

COUNT(attendance.attendance_id) AS total_classes,

SUM(CASE WHEN attendance.status='Present' THEN 1 ELSE 0 END) AS present_classes

FROM attendance

JOIN students
ON attendance.student_id = students.student_id

WHERE attendance.faculty_id='$faculty_id'

";


if($subject!=""){
$query.=" AND attendance.subject_id='$subject'";
}

if($from!=""){
$query.=" AND attendance.date >= '$from'";
}

if($to!=""){
$query.=" AND attendance.date <= '$to'";
}


$query.=" GROUP BY students.student_id ORDER BY students.name";


$result=mysqli_query($conn,$query);

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

<?php while($row=mysqli_fetch_assoc($result)){

$total=$row['total_classes'];
$present=$row['present_classes'];

$percentage=0;

if($total>0){
$percentage=round(($present/$total)*100,2);
}

?>

<tr class="border-b hover:bg-gray-50">

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

<?php if($percentage < 75){ ?>

<span class="text-red-500 font-semibold">
<?php echo $percentage; ?>%
</span>

<?php } else { ?>

<span class="text-green-600 font-semibold">
<?php echo $percentage; ?>%
</span>

<?php } ?>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>


<?php include "layout/footer.php"; ?>