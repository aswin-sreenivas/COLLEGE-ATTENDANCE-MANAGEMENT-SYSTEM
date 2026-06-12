<?php
session_start();
include "../config/db.php";


/* FILTER VALUES */

$student = $_GET['student'] ?? '';
$subject = $_GET['subject'] ?? '';
$date = $_GET['date'] ?? '';


/* BASE QUERY */

$query = "
SELECT attendance.*, 
students.name AS student_name,
subjects.subject_name

FROM attendance

LEFT JOIN students 
ON attendance.student_id = students.student_id

LEFT JOIN subjects 
ON attendance.subject_id = subjects.subject_id

WHERE 1
";


if($student != ''){
$query .= " AND attendance.student_id='$student'";
}

if($subject != ''){
$query .= " AND attendance.subject_id='$subject'";
}

if($date != ''){
$query .= " AND attendance.date='$date'";
}


$result = mysqli_query($conn,$query);

?>


<!DOCTYPE html>
<html>

<head>

<title>Attendance Reports</title>

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

@media print{

body{
background:white;
}

.main{
margin:0;
padding:0;
}

.sidebar{
display:none;
}

button{
display:none;
}

form{
display:none;
}

.card{
box-shadow:none;
border:none;
}

table{
width:100%;
border-collapse:collapse;
}

th, td{
border:1px solid #ccc;
padding:10px;
text-align:left;
}

h2{
margin-bottom:20px;
}

}
</style>

</head>

<body>


<!-- SIDEBAR -->

<div class="sidebar">
<?php include "layout/sidebar.php"; ?>
</div>


<div class="main">

<h2 class="text-2xl font-semibold mb-6">
Attendance Reports
</h2>


<!-- FILTER FORM -->

<div class="bg-white p-6 rounded-xl shadow mb-8 card">

<h3 class="font-semibold mb-4">
Filter Report
</h3>

<form method="GET" class="grid grid-cols-4 gap-4">


<select name="student" class="border p-2 rounded">

<option value="">All Students</option>

<?php

$students = mysqli_query($conn,"SELECT * FROM students");

while($s = mysqli_fetch_assoc($students)){

echo "<option value='".$s['student_id']."'>".$s['name']."</option>";

}

?>

</select>



<select name="subject" class="border p-2 rounded">

<option value="">All Subjects</option>

<?php

$subjects = mysqli_query($conn,"SELECT * FROM subjects");

while($s = mysqli_fetch_assoc($subjects)){

echo "<option value='".$s['subject_id']."'>".$s['subject_name']."</option>";

}

?>

</select>



<input
type="date"
name="date"
class="border p-2 rounded"
>


<button
class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">
Filter
</button>

</form>

</div>



<!-- REPORT TABLE -->

<div class="bg-white p-6 rounded-xl shadow card">

<div class="flex justify-between mb-4">

<h3 class="font-semibold">
Attendance Report
</h3>

<button
onclick="window.print()"
class="bg-green-600 text-white px-4 py-2 rounded">
Print
</button>

</div>


<table class="w-full text-sm">

<thead class="border-b text-gray-500">

<tr>

<th class="py-2 text-left">Student</th>
<th>Subject</th>
<th>Date</th>
<th>Status</th>

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
</tr>

<?php } ?>

</tbody>

</table>

</div>


</div>

</body>
</html>