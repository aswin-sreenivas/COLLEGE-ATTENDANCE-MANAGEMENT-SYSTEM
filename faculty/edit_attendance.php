<?php
session_start();
include "../config/db.php";

$page_title="Edit Attendance";
include "layout/layout.php";

$faculty_id = 1;
$message="";


/* UPDATE ATTENDANCE */

if(isset($_POST['update_attendance'])){

if(!empty($_POST['attendance'])){

foreach($_POST['attendance'] as $attendance_id=>$status){

mysqli_query($conn,"
UPDATE attendance
SET status='$status'
WHERE attendance_id='$attendance_id'
");

}

$message="Attendance Updated Successfully";

}else{

$message="⚠ No data to update";

}

}
?>


<h2 class="text-2xl font-semibold mb-8">
Edit Attendance
</h2>


<?php if($message!=""){ ?>

<div class="p-3 rounded mb-6 
<?php echo strpos($message,'⚠')!==false ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-700'; ?>">
<?php echo $message; ?>
</div>

<?php } ?>


<!-- FILTER -->

<div class="bg-white p-6 rounded-xl shadow card mb-8">

<form method="GET" class="grid grid-cols-4 gap-4">


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


<select name="period" class="border p-2 rounded">

<option value="">Period</option>

<option value="1">Period 1</option>
<option value="2">Period 2</option>
<option value="3">Period 3</option>
<option value="4">Period 4</option>
<option value="5">Period 5</option>
<option value="6">Period 6</option>

</select>


<input type="date" name="date" class="border p-2 rounded">


<button class="bg-indigo-600 text-white px-4 py-2 rounded">
Load Attendance
</button>

</form>

</div>


<?php

if(isset($_GET['subject_id']) && $_GET['subject_id']!=""){

$subject_id=$_GET['subject_id'];
$date=$_GET['date'];
$period=$_GET['period'];

$records=mysqli_query($conn,"
SELECT attendance.*, students.name
FROM attendance
JOIN students
ON attendance.student_id = students.student_id
WHERE attendance.subject_id='$subject_id'
AND attendance.date='$date'
AND attendance.period='$period'
ORDER BY students.name
");

?>


<form method="POST">

<div class="bg-white p-6 rounded-xl shadow card">

<table class="w-full text-sm">

<thead class="border-b text-gray-500">

<tr>
<th class="py-2 text-left">Student</th>
<th class="text-green-600">Present</th>
<th class="text-yellow-600">Late</th>
<th class="text-red-600">Absent</th>
</tr>

</thead>

<tbody>

<?php while($row=mysqli_fetch_assoc($records)){ ?>

<tr class="border-b hover:bg-gray-50">

<td class="py-2">
<?php echo $row['name']; ?>
</td>

<td>
<input type="radio"
name="attendance[<?php echo $row['attendance_id']; ?>]"
value="Present"
<?php if($row['status']=="Present") echo "checked"; ?>>
</td>

<td>
<input type="radio"
name="attendance[<?php echo $row['attendance_id']; ?>]"
value="Late"
<?php if($row['status']=="Late") echo "checked"; ?>>
</td>

<td>
<input type="radio"
name="attendance[<?php echo $row['attendance_id']; ?>]"
value="Absent"
<?php if($row['status']=="Absent") echo "checked"; ?>>
</td>

</tr>

<?php } ?>

</tbody>

</table>


<button
name="update_attendance"
class="mt-6 bg-indigo-600 text-white px-6 py-2 rounded">
Update Attendance
</button>

</div>

</form>

<?php } ?>


<?php include "layout/footer.php"; ?>