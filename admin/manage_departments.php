<?php
session_start();
include "../config/db.php";

/* ADD DEPARTMENT */

if(isset($_POST['add_department'])){

$name = $_POST['name'];

mysqli_query($conn,"INSERT INTO departments (department_name)
VALUES('$name')");

header("Location: manage_departments.php");
exit;

}

/* DELETE */

if(isset($_GET['delete'])){

$id = $_GET['delete'];

mysqli_query($conn,"DELETE FROM departments WHERE department_id='$id'");

header("Location: manage_departments.php");
exit;

}

/* FETCH */

$result = mysqli_query($conn,"SELECT * FROM departments");

?>

<!DOCTYPE html>
<html>

<head>

<title>Manage Departments</title>

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
Manage Departments
</h2>


<!-- ADD DEPARTMENT -->

<div class="bg-white p-6 rounded-xl shadow mb-8 card">

<h3 class="font-semibold mb-4">
Add Department
</h3>

<form method="POST" class="flex gap-4">

<input
type="text"
name="name"
placeholder="Department Name"
class="border p-2 rounded w-full"
required
>

<button
name="add_department"
class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">
Add
</button>

</form>

</div>



<!-- DEPARTMENT TABLE -->

<div class="bg-white p-6 rounded-xl shadow">

<h3 class="font-semibold mb-4">
Department List
</h3>

<table class="w-full text-sm">

<thead class="border-b text-gray-500">

<tr>
<th class="py-2 text-left">ID</th>
<th>Name</th>
<th>Action</th>
</tr>

</thead>

<tbody>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<tr class="border-b hover:bg-gray-50">

<td class="py-2">
<?php echo $row['department_id']; ?>
</td>

<td>
<?php echo $row['department_name']; ?>
</td>

<td>

<a
href="?delete=<?php echo $row['department_id']; ?>"
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