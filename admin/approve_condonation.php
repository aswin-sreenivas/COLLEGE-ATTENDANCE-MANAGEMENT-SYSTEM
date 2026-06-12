<?php
session_start();
include "../config/db.php";
?>

<!DOCTYPE html>
<html>

<head>

<title>Condonation Requests</title>

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
</style>

</head>

<body>


<!-- SIDEBAR -->
<?php include "layout/sidebar.php"; ?>


<!-- MAIN CONTENT -->
<div class="main">

<h2 class="text-2xl font-semibold mb-6">
Condonation Requests
</h2>


<?php

/* APPROVE */
if(isset($_GET['approve'])){
$id=$_GET['approve'];

mysqli_query($conn,"
UPDATE condonation_requests
SET status='Approved'
WHERE request_id='$id'
");

header("Location: approve_condonation.php");
exit;
}


/* REJECT */
if(isset($_GET['reject'])){
$id=$_GET['reject'];

mysqli_query($conn,"
UPDATE condonation_requests
SET status='Rejected'
WHERE request_id='$id'
");

header("Location: approve_condonation.php");
exit;
}


/* FETCH */
$result=mysqli_query($conn,"
SELECT c.*, s.name AS student_name
FROM condonation_requests c
JOIN students s ON c.student_id = s.student_id
ORDER BY c.request_id DESC
");
?>


<div class="bg-white p-6 rounded-xl shadow">

<table class="w-full text-sm">

<thead class="border-b text-gray-500">

<tr>
<th class="py-2 text-left">Student</th>
<th>Attendance %</th>
<th>Reason</th>
<th>Status</th>
<th>Document</th>
<th>Action</th>
</tr>

</thead>

<tbody>

<?php if($result && mysqli_num_rows($result)>0){ ?>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr class="border-b hover:bg-gray-50">

<td class="py-2">
<?php echo $row['student_name']; ?>
</td>

<td>
<?php echo $row['attendance_percentage']; ?>%
</td>

<td>
<?php echo $row['reason']; ?>
</td>

<td>

<?php if($row['status']=="Pending"){ ?>
<span class="text-yellow-600 font-medium">Pending</span>
<?php } elseif($row['status']=="Approved"){ ?>
<span class="text-green-600 font-medium">Approved</span>
<?php } else { ?>
<span class="text-red-600 font-medium">Rejected</span>
<?php } ?>

</td>


<!-- DOCUMENT COLUMN -->

<td>

<?php if(!empty($row['document'])){ ?>

<a href="../student/doc/<?php echo $row['document']; ?>" 
target="_blank"
class="text-blue-600 hover:underline">
View
</a>

<?php } else { ?>

<span class="text-gray-400">No File</span>

<?php } ?>

</td>


<td>

<?php if($row['status']=="Pending"){ ?>

<a href="?approve=<?php echo $row['request_id']; ?>"
class="text-green-600 hover:underline mr-3">
Approve
</a>

<a href="?reject=<?php echo $row['request_id']; ?>"
class="text-red-500 hover:underline">
Reject
</a>

<?php } else { ?>

<span class="text-gray-400">No Action</span>

<?php } ?>

</td>

</tr>

<?php } ?>

<?php } else { ?>

<tr>
<td colspan="6" class="text-center py-6 text-gray-400">
No condonation requests found
</td>
</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</body>
</html>