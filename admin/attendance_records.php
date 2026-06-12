<?php
session_start();
include "../config/db.php";


/* DELETE RECORD */

if(isset($_GET['delete'])){

$id = $_GET['delete'];

mysqli_query($conn,"DELETE FROM attendance WHERE attendance_id='$id'");

header("Location: attendance_records.php");
exit;

}


/* FETCH ATTENDANCE */

$result = mysqli_query($conn,"
SELECT attendance.*, 
students.name AS student_name,
subjects.subject_name

FROM attendance

LEFT JOIN students 
ON attendance.student_id = students.student_id

LEFT JOIN subjects 
ON attendance.subject_id = subjects.subject_id

ORDER BY attendance.date DESC
");

?>

<!DOCTYPE html>
<html>

<head>

<title>Attendance Records</title>

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
Attendance Records
</h2>



<div class="bg-white p-6 rounded-xl shadow card">

<h3 class="font-semibold mb-4">
All Attendance Records
</h3>


<table class="w-full text-sm">

<thead class="border-b text-gray-500">

<tr>

<th class="py-2 text-left">Student</th>
<th>Subject</th>
<th>Date</th>
<th>Status</th>
<th>Action</th>

</tr>

</thead>

<tbody>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<tr class="border-b hover:bg-gray-50">

<td class="py-2">
<?php echo $row['student_name']; ?>
</td>

<td>
<?php echo $row['subject_name']; ?>
</td>

<td>
<?php echo $row['date']; ?>
</td>

<td>

<?php if(strtolower(trim($row['status']))=="present"){ ?>

<span class="text-green-600 font-medium">
Present
</span>

<?php } else { ?>

<span class="text-red-500 font-medium">
Absent
</span>

<?php } ?>

</td>

<td>

<a
href="?delete=<?php echo $row['attendance_id']; ?>"
class="text-red-500 hover:underline"
onclick="return confirm('Delete this record?')">
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