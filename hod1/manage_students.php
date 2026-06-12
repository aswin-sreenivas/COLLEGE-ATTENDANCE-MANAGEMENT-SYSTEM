<?php
session_start();
include "../config/db.php";

$user_id = $_SESSION['user_id'] ?? 1;

$hod = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT * FROM hod WHERE user_id='$user_id'
"));

$dept_id = $hod['department_id'];

$students = mysqli_query($conn,"
SELECT * FROM students
WHERE department_id='$dept_id'
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Students</title>
<script src="https://cdn.tailwindcss.com"></script>

<style>
.main{margin-left:250px;padding:30px;background:#f6f8fc;}
</style>

</head>

<body>

<?php include "layout/sidebar.php"; ?>

<div class="main">

<h2 class="text-xl font-bold mb-6">Students</h2>

<div class="bg-white p-6 rounded-xl shadow">

<table class="w-full">

<tr class="border-b">
<th>Name</th>
<th>Email</th>
<th>Semester</th>
</tr>

<?php while($row=mysqli_fetch_assoc($students)){ ?>

<tr class="border-b">
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['email']; ?></td>
<td><?php echo $row['semester']; ?></td>
</tr>

<?php } ?>

</table>

</div>

</div>

</body>
</html>