<?php
session_start();
include "../config/db.php";

$user_id = $_SESSION['user_id'];

$hod = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT department_id FROM hod WHERE user_id='$user_id'
"));

if(!$hod){
die("HOD not assigned to any department");
}

$dept_id = $hod['department_id'];

/* GET FILTER */

$semester_filter = $_GET['semester'] ?? "";

/* BUILD QUERY */

$sql = "
SELECT * FROM students 
WHERE department_id='$dept_id'
";

if($semester_filter != ""){
$sql .= " AND semester='$semester_filter'";
}

$sql .= " ORDER BY semester ASC, name ASC";

$students = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html>

<head>

<title>HOD - Students</title>

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
Students & Attendance
</h2>


<!-- 🔥 FILTER -->

<div class="bg-white p-4 rounded-xl shadow mb-6 card">

<form method="GET" class="flex gap-4 items-center">

<select name="semester" class="border p-2 rounded">

<option value="">All Semesters</option>

<?php for($i=1;$i<=6;$i++){ ?>

<option value="<?php echo $i; ?>"
<?php if($semester_filter==$i) echo "selected"; ?>>

Semester <?php echo $i; ?>

</option>

<?php } ?>

</select>

<button class="bg-indigo-600 text-white px-4 py-2 rounded">
Filter
</button>

<a href="students.php" class="text-gray-500 text-sm">
Reset
</a>

</form>

</div>


<!-- TABLE -->

<div class="bg-white p-6 rounded-xl shadow card">

<table class="w-full text-sm">

<thead class="border-b text-gray-500">

<tr>
<th class="py-2 text-left">Name</th>
<th>Email</th>
<th>Semester</th>
<th>Attendance</th>
</tr>

</thead>

<tbody>

<?php if($students && mysqli_num_rows($students)>0){ ?>

<?php while($row=mysqli_fetch_assoc($students)){ 

$student_id = $row['student_id'];

/* ATTENDANCE */

$data = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT 
COUNT(*) as total,
SUM(CASE WHEN status='Present' THEN 1 ELSE 0 END) as present
FROM attendance
WHERE student_id='$student_id'
"));

$total = $data['total'];
$present = $data['present'];

$percent = ($total>0) ? round(($present/$total)*100,2) : 0;
?>

<tr class="border-b hover:bg-gray-50">

<td class="py-2 font-medium">
<?php echo $row['name']; ?>
</td>

<td>
<?php echo $row['email']; ?>
</td>

<td>
<span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-xs font-semibold">
Sem <?php echo $row['semester']; ?>
</span>
</td>

<td>

<?php if($percent < 75){ ?>
<span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs font-semibold">
<?php echo $percent; ?>%
</span>
<?php } else { ?>
<span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs font-semibold">
<?php echo $percent; ?>%
</span>
<?php } ?>

</td>

</tr>

<?php } ?>

<?php } else { ?>

<tr>
<td colspan="4" class="text-center py-6 text-gray-400">
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