<?php
session_start();
include "../config/db.php";

$user_id=$_SESSION['user_id'];

$hod=mysqli_fetch_assoc(mysqli_query($conn,"
SELECT department_id FROM hod WHERE user_id='$user_id'
"));

if(!$hod){
die("HOD not assigned to any department");
}

$dept_id=$hod['department_id'];

$message = "";


/* ADD FACULTY */

if(isset($_POST['add'])){

$name=$_POST['name'];
$email=$_POST['email'];

mysqli_query($conn,"
INSERT INTO faculty (name,email,department_id)
VALUES('$name','$email','$dept_id')
");

$message = "Faculty Added Successfully";
}


/* DELETE FACULTY */

if(isset($_GET['delete'])){

$id=$_GET['delete'];

mysqli_query($conn,"
DELETE FROM faculty WHERE faculty_id='$id'
");

header("Location: faculty.php");
exit;
}


/* FETCH */

$faculty=mysqli_query($conn,"
SELECT * FROM faculty WHERE department_id='$dept_id'
ORDER BY faculty_id DESC
");
?>

<!DOCTYPE html>
<html>

<head>

<title>HOD - Faculty</title>

<script src="https://cdn.tailwindcss.com"></script>

<style>
body{
font-family:Inter;
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
Faculty Management
</h2>


<!-- MESSAGE -->

<?php if($message!=""){ ?>
<div class="bg-green-100 text-green-700 p-3 rounded mb-4">
<?php echo $message; ?>
</div>
<?php } ?>


<!-- ADD FORM -->

<div class="bg-white p-6 rounded-xl shadow card mb-6">

<form method="POST" class="grid grid-cols-3 gap-4">

<input
name="name"
placeholder="Faculty Name"
class="border p-2 rounded"
required
>

<input
name="email"
placeholder="Email"
class="border p-2 rounded"
required
>

<button
name="add"
class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">
Add Faculty
</button>

</form>

</div>


<!-- TABLE -->

<div class="bg-white p-6 rounded-xl shadow card">

<h3 class="font-semibold mb-4">
Faculty List
</h3>

<table class="w-full text-sm">

<thead class="border-b text-gray-500">

<tr>
<th class="py-2 text-left">Name</th>
<th>Email</th>
<th>Action</th>
</tr>

</thead>

<tbody>

<?php if(mysqli_num_rows($faculty)>0){ ?>

<?php while($row=mysqli_fetch_assoc($faculty)){ ?>

<tr class="border-b hover:bg-gray-50">

<td class="py-2">
<?php echo $row['name']; ?>
</td>

<td>
<?php echo $row['email']; ?>
</td>

<td>

<a href="?delete=<?php echo $row['faculty_id']; ?>"
class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs">
Remove
</a>

</td>

</tr>

<?php } ?>

<?php } else { ?>

<tr>
<td colspan="3" class="text-center py-6 text-gray-400">
No faculty found
</td>
</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</body>
</html>