<?php
session_start();
include "../config/db.php";

$page_title="Take Attendance";
include "layout/layout.php";

$faculty_id = 1;
$message="";


/* SAVE ATTENDANCE */

if(isset($_POST['save_attendance'])){

$subject_id=$_POST['subject_id'];
$date=$_POST['date'];

/* SAFE PERIOD HANDLING */
$periods = $_POST['periods'] ?? [];

if(empty($periods)){

$message="⚠ Please select at least one period";

}else{

foreach($periods as $period){

foreach($_POST['attendance'] as $student_id=>$status){

$check=mysqli_query($conn,"
SELECT * FROM attendance
WHERE student_id='$student_id'
AND subject_id='$subject_id'
AND period='$period'
AND date='$date'
");

if(mysqli_num_rows($check)==0){

mysqli_query($conn,"
INSERT INTO attendance(student_id,subject_id,faculty_id,date,period,status)
VALUES('$student_id','$subject_id','$faculty_id','$date','$period','$status')
");

}

}
}

/* CALCULATE LATE → ABSENT */

$students_list = mysqli_query($conn,"
SELECT DISTINCT student_id
FROM attendance
WHERE subject_id='$subject_id'
");

while($s = mysqli_fetch_assoc($students_list)){

$student_id = $s['student_id'];

$late_count = mysqli_num_rows(mysqli_query($conn,"
SELECT * FROM attendance
WHERE student_id='$student_id'
AND subject_id='$subject_id'
AND status='Late'
"));

$absent_count = mysqli_num_rows(mysqli_query($conn,"
SELECT * FROM attendance
WHERE student_id='$student_id'
AND subject_id='$subject_id'
AND status='Absent'
"));

$extra_absent = floor($late_count / 3);
$total_absent = $absent_count + $extra_absent;

/* (Optional: store/update summary here if needed) */

}

$message="Attendance Saved Successfully";

}

}
?>


<h2 class="text-2xl font-semibold mb-8">
Take Attendance
</h2>


<?php if($message!=""){ ?>

<div class="p-3 rounded mb-6 
<?php echo strpos($message,'⚠')!==false ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-700'; ?>">
<?php echo $message; ?>
</div>

<?php } ?>


<!-- SUBJECT + DATE -->

<div class="bg-white p-6 rounded-xl shadow card mb-8">

<form method="GET" class="grid grid-cols-3 gap-4">

<select name="subject_id" class="border p-2 rounded">

<option value="">Select Subject</option>

<?php
$subjects=mysqli_query($conn,"
SELECT subjects.*
FROM subjects
JOIN faculty_subjects
ON subjects.subject_id=faculty_subjects.subject_id
WHERE faculty_subjects.faculty_id='$faculty_id'
");

while($s=mysqli_fetch_assoc($subjects)){
echo "<option value='".$s['subject_id']."'>".$s['subject_name']."</option>";
}
?>

</select>

<input
type="date"
name="date"
value="<?php echo date('Y-m-d'); ?>"
class="border p-2 rounded"
>

<button class="bg-indigo-600 text-white px-4 py-2 rounded">
Load Students
</button>

</form>

</div>


<?php

if(isset($_GET['subject_id']) && $_GET['subject_id']!=""){

$subject_id=$_GET['subject_id'];

$subject=mysqli_fetch_assoc(mysqli_query($conn,"
SELECT * FROM subjects
WHERE subject_id='$subject_id'
"));

$semester=$subject['semester'];
$department=$subject['department_id'];

$students=mysqli_query($conn,"
SELECT * FROM students
WHERE semester='$semester'
AND department_id='$department'
ORDER BY name
");

?>


<form method="POST">

<input type="hidden" name="subject_id" value="<?php echo $subject_id; ?>">
<input type="hidden" name="date" value="<?php echo $_GET['date']; ?>">


<div class="bg-white p-6 rounded-xl shadow card">

<!-- PERIODS -->

<label class="block font-medium mb-3">
Select Periods
</label>

<div class="grid grid-cols-6 gap-3 mb-6">

<label><input type="checkbox" name="periods[]" value="1"> P1</label>
<label><input type="checkbox" name="periods[]" value="2"> P2</label>
<label><input type="checkbox" name="periods[]" value="3"> P3</label>
<label><input type="checkbox" name="periods[]" value="4"> P4</label>
<label><input type="checkbox" name="periods[]" value="5"> P5</label>
<label><input type="checkbox" name="periods[]" value="6"> P6</label>

</div>


<!-- TABLE -->

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

<?php while($row=mysqli_fetch_assoc($students)){ ?>

<tr class="border-b hover:bg-gray-50">

<td class="py-2">
<?php echo $row['name']; ?>
</td>

<td>
<input type="radio"
name="attendance[<?php echo $row['student_id']; ?>]"
value="Present"
checked>
</td>

<td>
<input type="radio"
name="attendance[<?php echo $row['student_id']; ?>]"
value="Late">
</td>

<td>
<input type="radio"
name="attendance[<?php echo $row['student_id']; ?>]"
value="Absent">
</td>

</tr>

<?php } ?>

</tbody>

</table>


<button
name="save_attendance"
class="mt-6 bg-indigo-600 text-white px-6 py-2 rounded">
Save Attendance
</button>

</div>

</form>

<?php } ?>


<?php include "layout/footer.php"; ?>