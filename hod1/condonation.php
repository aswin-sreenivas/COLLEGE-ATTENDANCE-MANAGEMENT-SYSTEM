<?php
session_start();
include "../config/db.php";

$user_id=$_SESSION['user_id'];

$hod = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT department_id FROM hod WHERE user_id='$user_id'
"));

if(!$hod){
die("HOD not assigned to any department");
}

$dept_id = $hod['department_id'];

/* ACTION */

if(isset($_GET['approve'])){
$id=$_GET['approve'];
mysqli_query($conn,"UPDATE condonation_requests SET status='Approved' WHERE request_id='$id'");
header("Location: condonation.php");
exit;
}

if(isset($_GET['reject'])){
$id=$_GET['reject'];
mysqli_query($conn,"UPDATE condonation_requests SET status='Rejected' WHERE request_id='$id'");
header("Location: condonation.php");
exit;
}

/* FETCH */

$result=mysqli_query($conn,"
SELECT c.*, s.name
FROM condonation_requests c
JOIN students s ON c.student_id=s.student_id
WHERE s.department_id='$dept_id'
ORDER BY c.request_id DESC
");
?>

<!DOCTYPE html>
<html>

<head>

<title>HOD - Condonation</title>

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
Condonation Requests
</h2>


<div class="bg-white p-6 rounded-xl shadow card">

<table class="w-full text-sm">

<thead class="border-b text-gray-500">

<tr>
<th class="py-2 text-left">Student</th>
<th>Attendance %</th>
<th>Status</th>
<th>Document</th>
<th>Action</th>
</tr>

</thead>

<tbody>

<?php if($result && mysqli_num_rows($result)>0){ ?>

<?php while($r=mysqli_fetch_assoc($result)){ ?>

<tr class="border-b hover:bg-gray-50">

<td class="py-2">
<?php echo $r['name']; ?>
</td>

<td>
<?php echo $r['attendance_percentage']; ?>%
</td>

<td>

<?php if($r['status']=="Pending"){ ?>
<span class="text-yellow-600 font-medium">Pending</span>
<?php } elseif($r['status']=="Approved"){ ?>
<span class="text-green-600 font-medium">Approved</span>
<?php } else { ?>
<span class="text-red-600 font-medium">Rejected</span>
<?php } ?>

</td>


<!-- DOCUMENT COLUMN -->

<td>

<?php if(!empty($r['document'])){ ?>

<a href="../student/doc/<?php echo $r['document']; ?>"
target="_blank"
class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs">
View
</a>

<?php } else { ?>

<span class="text-gray-400 text-sm">No File</span>

<?php } ?>

</td>


<td>

<?php if($r['status']=="Pending"){ ?>

<a href="?approve=<?php echo $r['request_id']; ?>"
class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded mr-2 text-xs">
Approve
</a>

<a href="?reject=<?php echo $r['request_id']; ?>"
class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs">
Reject
</a>

<?php } else { ?>

<span class="text-gray-400 text-sm">No Action</span>

<?php } ?>

</td>

</tr>

<?php } ?>

<?php } else { ?>

<tr>
<td colspan="5" class="text-center py-6 text-gray-400">
No requests found
</td>
</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</body>
</html>