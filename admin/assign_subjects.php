<?php
session_start();
include "../config/db.php";

/* ASSIGN SUBJECT */

if(isset($_POST['assign'])){

$faculty_id = $_POST['faculty_id'];
$subject_id = $_POST['subject_id'];

mysqli_query($conn,"INSERT INTO faculty_subjects (faculty_id,subject_id)
VALUES('$faculty_id','$subject_id')");

header("Location: assign_subjects.php");
exit;

}


/* DELETE ASSIGNMENT */

if(isset($_GET['delete'])){

$id = $_GET['delete'];

mysqli_query($conn,"DELETE FROM faculty_subjects WHERE id='$id'");

header("Location: assign_subjects.php");
exit;

}


/* FETCH ASSIGNMENTS */

$result = mysqli_query($conn,"
SELECT faculty_subjects.*, 
faculty.name AS faculty_name,
subjects.subject_name

FROM faculty_subjects

LEFT JOIN faculty 
ON faculty_subjects.faculty_id = faculty.faculty_id

LEFT JOIN subjects 
ON faculty_subjects.subject_id = subjects.subject_id
");

?>


<!DOCTYPE html>
<html>

<head>

<title>Assign Subjects</title>

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
Assign Subjects to Faculty
</h2>


<!-- ASSIGN FORM -->

<div class="bg-white p-6 rounded-xl shadow mb-8 card">

<h3 class="font-semibold mb-4">
Assign Subject
</h3>

<form method="POST" class="grid grid-cols-2 gap-4">
<select name="faculty_id" class="border p-2 rounded" required>
<option value="" disabled selected>
Select Faculty
</option>

<?php
$faculty = mysqli_query($conn,"SELECT * FROM faculty");
while($f = mysqli_fetch_assoc($faculty)){
echo "<option value='".$f['faculty_id']."'>".$f['name']."</option>";
}
?>
</select>

<select name="subject_id" class="border p-2 rounded" required>
<option value="" disabled selected>
Select Subject
</option>

<?php
$subjects = mysqli_query($conn,"SELECT * FROM subjects");

while($s = mysqli_fetch_assoc($subjects)){

echo "<option value='".$s['subject_id']."'>".$s['subject_name']."</option>";

}

?>

</select>


<button
name="assign"
class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded col-span-2">
Assign Subject
</button>

</form>

</div>



<!-- ASSIGNMENT TABLE -->

<div class="bg-white p-6 rounded-xl shadow">

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

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<tr class="border-b hover:bg-gray-50">

<td class="py-2">
<?php echo $row['faculty_name']; ?>
</td>

<td>
<?php echo $row['subject_name']; ?>
</td>

<td>

<a
href="?delete=<?php echo $row['id']; ?>"
class="text-red-500 hover:underline"
onclick="return confirm('Delete this assignment?')">
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