<?php
session_start();
include "../config/db.php";


/* ADD PARENT */

if(isset($_POST['add_parent'])){

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$student_id = $_POST['student_id'];

/* CHECK DUPLICATE EMAIL */

$check = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");

if(mysqli_num_rows($check) > 0){
echo "<script>alert('Email already exists');</script>";
}else{

/* INSERT INTO USERS */

mysqli_query($conn,"
INSERT INTO users (name,email,password,role,status)
VALUES('$name','$email','$password','parent','active')
");

$user_id = mysqli_insert_id($conn);

/* INSERT INTO PARENTS */

mysqli_query($conn,"
INSERT INTO parents (user_id,name,email,student_id)
VALUES('$user_id','$name','$email','$student_id')
");

header("Location: manage_parents.php");
exit;

}

}


/* DELETE */

if(isset($_GET['delete'])){

$id = $_GET['delete'];

/* GET USER ID */

$data = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT user_id FROM parents WHERE parent_id='$id'
"));

$user_id = $data['user_id'];

/* DELETE BOTH */

mysqli_query($conn,"DELETE FROM parents WHERE parent_id='$id'");
mysqli_query($conn,"DELETE FROM users WHERE user_id='$user_id'");

header("Location: manage_parents.php");
exit;

}


/* FETCH DATA */

$result = mysqli_query($conn,"
SELECT parents.*, students.name AS student_name
FROM parents
LEFT JOIN students
ON parents.student_id = students.student_id
");

?>

<!DOCTYPE html>
<html>

<head>

<title>Manage Parents</title>

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


<!-- MAIN -->

<div class="main">

<h2 class="text-2xl font-semibold mb-6">
Manage Parents
</h2>



<!-- ADD FORM -->

<div class="bg-white p-6 rounded-xl shadow mb-8 card">

<h3 class="font-semibold mb-4">
Add Parent
</h3>

<form method="POST" class="grid grid-cols-4 gap-4">

<input
type="text"
name="name"
placeholder="Parent Name"
class="border p-2 rounded"
required
>

<input
type="email"
name="email"
placeholder="Email (Username)"
class="border p-2 rounded"
required
>

<input
type="password"
name="password"
placeholder="Password"
class="border p-2 rounded"
required
>

<select name="student_id" class="border p-2 rounded">

<?php
$students = mysqli_query($conn,"SELECT * FROM students");

while($s = mysqli_fetch_assoc($students)){
echo "<option value='".$s['student_id']."'>".$s['name']."</option>";
}
?>

</select>

<button
name="add_parent"
class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded col-span-4">
Add Parent
</button>

</form>

</div>



<!-- TABLE -->

<div class="bg-white p-6 rounded-xl shadow">

<h3 class="font-semibold mb-4">
Parent List
</h3>

<table class="w-full text-sm">

<thead class="border-b text-gray-500">

<tr>
<th class="py-2 text-left">Name</th>
<th>Email</th>
<th>Student</th>
<th>Action</th>
</tr>

</thead>

<tbody>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<tr class="border-b hover:bg-gray-50">

<td class="py-2">
<?php echo $row['name']; ?>
</td>

<td>
<?php echo $row['email']; ?>
</td>

<td>
<?php echo $row['student_name']; ?>
</td>

<td>

<a
href="?delete=<?php echo $row['parent_id']; ?>"
class="text-red-500 hover:underline">
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