<?php
session_start();
include "../config/db.php";

/* ADD STUDENT */

if(isset($_POST['add_student'])){

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$semester = $_POST['semester'];
$department_id = $_POST['department_id'];

/* INSERT INTO USERS */

mysqli_query($conn,"
INSERT INTO users (name,email,password,role,status)
VALUES('$name','$email','$password','student','active')
");

/* GET USER ID */

$user_id = mysqli_insert_id($conn);

/* INSERT INTO STUDENTS */

mysqli_query($conn,"
INSERT INTO students (user_id,name,email,semester,department_id)
VALUES('$user_id','$name','$email','$semester','$department_id')
");

header("Location: manage_students.php");
exit;
}


/* DELETE STUDENT */

if(isset($_GET['delete'])){

$id = $_GET['delete'];

/* GET USER ID */

$data = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT user_id FROM students WHERE student_id='$id'
"));

$user_id = $data['user_id'];

/* DELETE FROM STUDENTS */

mysqli_query($conn,"DELETE FROM students WHERE student_id='$id'");

/* DELETE FROM USERS */

if($user_id){
mysqli_query($conn,"DELETE FROM users WHERE id='$user_id'");
}

header("Location: manage_students.php");
exit;

}


/* FETCH STUDENTS */

$result = mysqli_query($conn,"
SELECT students.*, departments.department_name
FROM students
LEFT JOIN departments
ON students.department_id = departments.department_id
ORDER BY students.student_id DESC
");
?>

<!DOCTYPE html>
<html>

<head>

<title>Manage Students</title>

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


<div class="main">

<h2 class="text-2xl font-semibold mb-6">
Manage Students
</h2>


<!-- ADD STUDENT -->

<div class="bg-white p-6 rounded-xl shadow mb-8 card">

<h3 class="font-semibold mb-4">
Add Student
</h3>

<form method="POST" class="grid grid-cols-5 gap-4">

<input
type="text"
name="name"
placeholder="Student Name"
class="border p-2 rounded"
required
>

<input
type="email"
name="email"
placeholder="Email"
class="border p-2 rounded"
required
>

<input
type="password"
name="password"
placeholder="Password"
class="border p-2 rounded"
required
>

<select name="semester" class="border p-2 rounded">
<option value="1">Semester 1</option>
<option value="2">Semester 2</option>
<option value="3">Semester 3</option>
<option value="4">Semester 4</option>
<option value="5">Semester 5</option>
<option value="6">Semester 6</option>
</select>


<select name="department_id" class="border p-2 rounded">

<?php
$departments = mysqli_query($conn,"SELECT * FROM departments");
while($dept = mysqli_fetch_assoc($departments)){
echo "<option value='".$dept['department_id']."'>".$dept['department_name']."</option>";
}
?>

</select>

<button
name="add_student"
class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded col-span-5">
Add Student
</button>

</form>

</div>


<!-- STUDENT TABLE -->

<div class="bg-white p-6 rounded-xl shadow">

<h3 class="font-semibold mb-4">
Student List
</h3>

<table class="w-full text-sm">

<thead class="border-b text-gray-500">

<tr>
<th class="py-2 text-left">Name</th>
<th>Email</th>
<th>Semester</th>
<th>Department</th>
<th>Action</th>
</tr>

</thead>

<tbody>

<?php if($result && mysqli_num_rows($result)>0){ ?>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<tr class="border-b hover:bg-gray-50">

<td class="py-2"><?php echo $row['name']; ?></td>
<td><?php echo $row['email']; ?></td>
<td><?php echo $row['semester']; ?></td>
<td><?php echo $row['department_name']; ?></td>

<td>
<a href="?delete=<?php echo $row['student_id']; ?>"
class="text-red-500 hover:underline">
Delete
</a>
</td>

</tr>

<?php } ?>

<?php } else { ?>

<tr>
<td colspan="5" class="text-center py-6 text-gray-400">
No students found
</td>
</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</body>
</html>