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


/* DELETE ASSIGNMENT */

if(isset($_GET['delete'])){

$id = $_GET['delete'];

mysqli_query($conn,"
DELETE FROM faculty_subjects
WHERE id='$id'
");

header("Location: assign_subject.php");
exit;

}


/* ASSIGN SUBJECT */

if(isset($_POST['assign'])){

$f=$_POST['faculty'];
$s=$_POST['subject'];

/* CHECK DUPLICATE */

$check=mysqli_query($conn,"
SELECT * FROM faculty_subjects
WHERE faculty_id='$f' AND subject_id='$s'
");

if(mysqli_num_rows($check)==0){

mysqli_query($conn,"
INSERT INTO faculty_subjects(faculty_id,subject_id)
VALUES('$f','$s')
");

$message="Subject Assigned Successfully";

}else{

$message="Already Assigned";

}

}


/* DATA */

$faculty=mysqli_query($conn,"
SELECT * FROM faculty WHERE department_id='$dept_id'
");

$subjects=mysqli_query($conn,"
SELECT * FROM subjects WHERE department_id='$dept_id'
");


/* ASSIGNED LIST */

$assigned=mysqli_query($conn,"
SELECT fs.id, f.name, s.subject_name
FROM faculty_subjects fs
JOIN faculty f ON fs.faculty_id=f.faculty_id
JOIN subjects s ON fs.subject_id=s.subject_id
WHERE s.department_id='$dept_id'
ORDER BY fs.id DESC
");
?>

<!DOCTYPE html>
<html>

<head>

<title>Assign Subject</title>

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
Assign Subjects
</h2>


<!-- MESSAGE -->

<?php if($message!=""){ ?>
<div class="bg-green-100 text-green-700 p-3 rounded mb-4">
<?php echo $message; ?>
</div>
<?php } ?>


<!-- ASSIGN FORM -->

<div class="bg-white p-6 rounded-xl shadow card mb-6">

<form method="POST" class="grid grid-cols-3 gap-4">

<select name="faculty" class="border p-2 rounded" required>
<option value="">Select Faculty</option>
<?php while($f=mysqli_fetch_assoc($faculty)){ ?>
<option value="<?php echo $f['faculty_id']; ?>">
<?php echo $f['name']; ?>
</option>
<?php } ?>
</select>

<select name="subject" class="border p-2 rounded" required>
<option value="">Select Subject</option>
<?php while($s=mysqli_fetch_assoc($subjects)){ ?>
<option value="<?php echo $s['subject_id']; ?>">
<?php echo $s['subject_name']; ?>
</option>
<?php } ?>
</select>

<button
name="assign"
class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">
Assign
</button>

</form>

</div>


<!-- ASSIGNED TABLE -->

<div class="bg-white p-6 rounded-xl shadow card">

<h3 class="font-semibold mb-4">
Assigned Subjects
</h3>

<table class="w-full text-sm">

<thead class="border-b text-gray-500">

<tr>
<th class="py-2 text-left">Faculty</th>
<th>Subject</th>
<th>Action</th>
</tr>

</thead>

<tbody>

<?php if(mysqli_num_rows($assigned)>0){ ?>

<?php while($row=mysqli_fetch_assoc($assigned)){ ?>

<tr class="border-b hover:bg-gray-50">

<td class="py-2">
<?php echo $row['name']; ?>
</td>

<td>
<?php echo $row['subject_name']; ?>
</td>

<td>

<a href="?delete=<?php echo $row['id']; ?>"
class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs">
Remove
</a>

</td>

</tr>

<?php } ?>

<?php } else { ?>

<tr>
<td colspan="3" class="text-center py-6 text-gray-400">
No assignments found
</td>
</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</body>
</html>