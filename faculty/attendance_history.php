<?php
session_start();
include "../config/db.php";

$faculty_id = 1;

/* FILTER VALUES */

$subject_filter = $_GET['subject_id'] ?? "";
$date_filter = $_GET['date'] ?? "";


/* BASE QUERY */

$query = "
SELECT attendance.*, 
students.name AS student_name,
subjects.subject_name
FROM attendance

JOIN students 
ON attendance.student_id = students.student_id

JOIN subjects 
ON attendance.subject_id = subjects.subject_id

WHERE attendance.faculty_id='$faculty_id'
";


if($subject_filter!=""){
$query .= " AND attendance.subject_id='$subject_filter'";
}

if($date_filter!=""){
$query .= " AND attendance.date='$date_filter'";
}

$query .= " ORDER BY attendance.date DESC, attendance.period ASC";

$result = mysqli_query($conn,$query);

$page_title="Take Attendance";
include "layout/layout.php";

?>

<!DOCTYPE html>
<html>

<head>

<title>Attendance History</title>

<script src="https://cdn.tailwindcss.com"></script>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

<style>

body{
font-family:'Inter',sans-serif;
background:#f6f8fc;
}

.sidebar{
width:250px;
height:100vh;
background:#0f172a;
position:fixed;
color:white;
padding:25px;
}

.menu{
padding:10px;
border-radius:8px;
display:block;
color:#cbd5e1;
transition:0.25s;
}

.menu:hover{
background:#1e293b;
color:white;
transform:translateX(6px);
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






<div class="main">

<h2 class="text-2xl font-semibold mb-8">
Attendance History
</h2>


<!-- FILTERS -->

<div class="bg-white p-6 rounded-xl shadow mb-8 card">

<form method="GET" class="grid grid-cols-3 gap-4">

<select name="subject_id" class="border p-2 rounded">

<option value="">All Subjects</option>

<?php

$subjects = mysqli_query($conn,"
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


<input
type="date"
name="date"
class="border p-2 rounded"
>


<button class="bg-indigo-600 text-white px-4 py-2 rounded">
Filter
</button>

</form>

</div>



<!-- ATTENDANCE TABLE -->

<div class="bg-white p-6 rounded-xl shadow card">

<table class="w-full text-sm">

<thead class="border-b text-gray-500">

<tr>

<th class="py-2 text-left">Student</th>
<th>Subject</th>
<th>Date</th>
<th>Period</th>
<th>Status</th>

</tr>

</thead>

<tbody>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

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
Period <?php echo $row['period']; ?>
</td>

<td>

<?php if($row['status']=="Present"){ ?>

<span class="text-green-600 font-semibold">
Present
</span>

<?php }else{ ?>

<span class="text-red-500 font-semibold">
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