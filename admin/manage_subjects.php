<?php
session_start();
include "../config/db.php";


/* ADD SUBJECT */

if(isset($_POST['add_subject'])){

$name = $_POST['name'];
$semester = $_POST['semester'];
$department_id = $_POST['department_id'];

mysqli_query($conn,"INSERT INTO subjects (subject_name,semester,department_id)
VALUES('$name','$semester','$department_id')");

header("Location: manage_subjects.php");
exit;

}


/* DELETE SUBJECT */

if(isset($_GET['delete'])){

$id = $_GET['delete'];

mysqli_query($conn,"DELETE FROM subjects WHERE subject_id='$id'");

header("Location: manage_subjects.php");
exit;

}


/* FETCH SUBJECTS */

$result = mysqli_query($conn,"
SELECT subjects.*, departments.department_name
FROM subjects
LEFT JOIN departments
ON subjects.department_id = departments.department_id
");

?>

<!DOCTYPE html>
<html>

<head>

<title>Manage Subjects</title>

<script src="https://cdn.tailwindcss.com"></script>

<style>

body{
font-family:'Inter',sans-serif;
background:#f6f8fc;
}

.main{
margin-left:250px;
padding:30px;
}

.card{
transition:0.3s;
}

.card:hover{
transform:translateY(-5px);
}

</style>

</head>

<body>


<!-- SIDEBAR -->
<?php include "layout/sidebar.php"; ?>


<!-- MAIN -->

<div class="main">

<h2 class="text-2xl font-semibold mb-6">
Manage Subjects
</h2>



<!-- ADD SUBJECT -->

<div class="bg-white p-6 rounded-xl shadow mb-8 card">

<h3 class="font-semibold mb-4">
Add Subject
</h3>

<form method="POST" class="grid grid-cols-3 gap-4">

<input
type="text"
name="name"
placeholder="Subject Name"
class="border p-2 rounded"
required
>


<select
name="semester"
class="border p-2 rounded" required>
<option value="" disabled selected>
Select Semester
</option>
<option value="1">Semester 1</option>
<option value="2">Semester 2</option>
<option value="3">Semester 3</option>
<option value="4">Semester 4</option>
<option value="5">Semester 5</option>
<option value="6">Semester 6</option>

</select>


<select
name="department_id"
class="border p-2 rounded" required>
<option value="" disabled selected>
Select Department
</option>
<?php

$departments = mysqli_query($conn,"SELECT * FROM departments");

while($dept = mysqli_fetch_assoc($departments)){

echo "<option value='".$dept['department_id']."'>".$dept['department_name']."</option>";

}

?>

</select>


<button
name="add_subject"
class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded col-span-3">
Add Subject
</button>

</form>

</div>



<!-- SUBJECT TABLE -->

<div class="bg-white p-6 rounded-xl shadow">

<h3 class="font-semibold mb-4">
Subject List
</h3>

<table class="w-full text-sm">

<thead class="border-b text-gray-500">

<tr>

<th class="py-2 text-left">Subject</th>
<th>Semester</th>
<th>Department</th>
<th>Action</th>

</tr>

</thead>

<tbody>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<tr class="border-b hover:bg-gray-50">

<td class="py-2">
<?php echo $row['subject_name']; ?>
</td>

<td>
Semester <?php echo $row['semester']; ?>
</td>

<td>
<?php echo $row['department_name']; ?>
</td>

<td>

<a
href="?delete=<?php echo $row['subject_id']; ?>"
class="text-red-500 hover:underline">
Delete
</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>


</div>

</body>
</html>