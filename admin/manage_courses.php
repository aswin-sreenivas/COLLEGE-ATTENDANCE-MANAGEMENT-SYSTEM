<?php
session_start();
include "../config/db.php";


/* ADD COURSE */

if(isset($_POST['add_course'])){

$name = $_POST['course_name'];
$department_id = $_POST['department_id'];

mysqli_query($conn,"INSERT INTO courses (course_name,department_id)
VALUES('$name','$department_id')");

header("Location: manage_courses.php");
exit;

}


/* DELETE COURSE */

if(isset($_GET['delete'])){

$id = $_GET['delete'];

mysqli_query($conn,"DELETE FROM courses WHERE course_id='$id'");

header("Location: manage_courses.php");
exit;

}


/* FETCH COURSES */

$result = mysqli_query($conn,"
SELECT courses.*, departments.department_name
FROM courses
LEFT JOIN departments
ON courses.department_id = departments.department_id
");

?>


<!DOCTYPE html>
<html>

<head>

<title>Manage Courses</title>

<script src="https://cdn.tailwindcss.com"></script>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

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
Manage Courses
</h2>



<!-- ADD COURSE -->

<div class="bg-white p-6 rounded-xl shadow mb-8 card">

<h3 class="font-semibold mb-4">
Add Course
</h3>

<form method="POST" class="grid grid-cols-2 gap-4">

<input
type="text"
name="course_name"
placeholder="Course Name"
class="border p-2 rounded"
required
>


<select name="department_id" class="border p-2 rounded">

<?php

$departments = mysqli_query($conn,"SELECT * FROM departments");

while($dept = mysqli_fetch_assoc($departments)){

echo "<option value='".$dept['department_id']."'>".$dept['department_name']."</option>";

}

?>

</select>


<button
name="add_course"
class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded col-span-2">
Add Course
</button>

</form>

</div>



<!-- COURSE TABLE -->

<div class="bg-white p-6 rounded-xl shadow">

<h3 class="font-semibold mb-4">
Course List
</h3>

<table class="w-full text-sm">

<thead class="border-b text-gray-500">

<tr>

<th class="py-2 text-left">Course</th>
<th>Department</th>
<th>Action</th>

</tr>

</thead>

<tbody>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<tr class="border-b hover:bg-gray-50">

<td class="py-2">
<?php echo $row['course_name']; ?>
</td>

<td>
<?php echo $row['department_name']; ?>
</td>

<td>

<a
href="?delete=<?php echo $row['course_id']; ?>"
class="text-red-500 hover:underline"
onclick="return confirm('Delete this course?')">
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