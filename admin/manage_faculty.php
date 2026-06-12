<?php
session_start();
include "../config/db.php";

/* ADD FACULTY */

if(isset($_POST['add_faculty'])){

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$department_id = $_POST['department_id'];

mysqli_query($conn,"
INSERT INTO users (name,email,password,role)
VALUES('$name','$email','$password','faculty')
");

$user_id = mysqli_insert_id($conn);

mysqli_query($conn,"INSERT INTO faculty (user_id,name,email,department_id)
VALUES('$user_id','$name','$email','$department_id')");

header("Location: manage_faculty.php");
exit;

}


/* DELETE FACULTY */

if(isset($_GET['delete'])){

$id = $_GET['delete'];

mysqli_query($conn,"DELETE FROM faculty WHERE faculty_id='$id'");

header("Location: manage_faculty.php");
exit;

}


/* FETCH FACULTY */

$result = mysqli_query($conn,"
SELECT faculty.*, departments.department_name
FROM faculty
LEFT JOIN departments
ON faculty.department_id = departments.department_id
");

?>

<!DOCTYPE html>
<html>

<head>

<title>Manage Faculty</title>

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
Manage Faculty
</h2>



<!-- ADD FACULTY -->

<div class="bg-white p-6 rounded-xl shadow mb-8 card">

<h3 class="font-semibold mb-4">
Add Faculty
</h3>

<form method="POST" class="grid grid-cols-4 gap-4">

<input
type="text"
name="name"
placeholder="Faculty Name"
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

<select name="department_id" class="border p-2 rounded">

<?php

$departments = mysqli_query($conn,"SELECT * FROM departments");

while($dept = mysqli_fetch_assoc($departments)){

echo "<option value='".$dept['department_id']."'>".$dept['department_name']."</option>";

}

?>

</select>

<button
name="add_faculty"
class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded col-span-3">
Add Faculty
</button>

</form>

</div>



<!-- FACULTY TABLE -->

<div class="bg-white p-6 rounded-xl shadow">

<h3 class="font-semibold mb-4">
Faculty List
</h3>

<table class="w-full text-sm">

<thead class="border-b text-gray-500">

<tr>

<th class="py-2 text-left">Name</th>
<th>Email</th>
<th>Department</th>
<th>Action</th>

</tr>

</thead>

<tbody>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

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

<a
href="?delete=<?php echo $row['faculty_id']; ?>"
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