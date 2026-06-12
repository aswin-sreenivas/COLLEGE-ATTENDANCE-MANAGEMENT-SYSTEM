<?php
session_start();
include "../config/db.php";

$page_title="Student List";
include "layout/layout.php";

$faculty_id = 1;

$subject = $_GET['subject_id'] ?? "";

?>

<h2 class="text-2xl font-semibold mb-8">
Student List
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
Load Students
</button>

</form>

</div>


<?php

if($subject!=""){

$subject_data=mysqli_fetch_assoc(mysqli_query($conn,"
SELECT * FROM subjects WHERE subject_id='$subject'
"));

$semester=$subject_data['semester'];
$department=$subject_data['department_id'];

$students=mysqli_query($conn,"
SELECT students.*, departments.department_name
FROM students
LEFT JOIN departments
ON students.department_id = departments.department_id
WHERE students.semester='$semester'
AND students.department_id='$department'
ORDER BY students.name
");

?>

<div class="bg-white p-6 rounded-xl shadow card">

<table class="w-full text-sm">

<thead class="border-b text-gray-500">

<tr>

<th class="py-2 text-left">Student Name</th>
<th>Email</th>
<th>Department</th>
<th>Semester</th>

</tr>

</thead>

<tbody>

<?php while($row=mysqli_fetch_assoc($students)){ ?>

<tr class="border-b hover:bg-gray-50">

<td class="py-2">
<?php echo $row['name']; ?>
</td>

<td>
<?php echo $row['email']; ?>
</td>

<td>
<?php echo $row['department_name']; ?>
</td>

<td>
Semester <?php echo $row['semester']; ?>
</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

<?php } ?>


<?php include "layout/footer.php"; ?>