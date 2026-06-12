<?php
session_start();

include("../config/db.php");

/* LOGIN CHECK */

if(
!isset($_SESSION['role']) ||
$_SESSION['role']!="hod"
){
header("Location: ../login.php");
exit();
}

/* SESSION */

$department_id = $_SESSION['department_id'] ?? 1;

$hod_name = $_SESSION['name'] ?? "HOD";

/* ADD STUDENT */

if(isset($_POST['add_student'])){

$name = mysqli_real_escape_string($conn,$_POST['name']);

$email = mysqli_real_escape_string($conn,$_POST['email']);

$password = mysqli_real_escape_string($conn,$_POST['password']);

$semester = mysqli_real_escape_string($conn,$_POST['semester']);

$admission_no = mysqli_real_escape_string($conn,$_POST['admission_no']);

/* INSERT USERS */

$user_insert = mysqli_query($conn,"
INSERT INTO users
(name,email,password,role,status)
VALUES
(
'$name',
'$email',
'$password',
'student',
'active'
)
");

/* INSERT STUDENTS */

$student_insert = mysqli_query($conn,"
INSERT INTO students
(admission_no,name,email,department_id,semester)
VALUES
(
'$admission_no',
'$name',
'$email',
'$department_id',
'$semester'
)
");

/* CHECK */

if($user_insert && $student_insert){

header("Location: manage_students.php?success=1");
exit();

}else{

$error = mysqli_error($conn);

}

}

/* DELETE */

if(isset($_GET['delete'])){

$id = intval($_GET['delete']);

/* GET EMAIL */

$get_query = mysqli_query($conn,"
SELECT email
FROM students
WHERE student_id='$id'
");

$get = mysqli_fetch_assoc($get_query);

$email = $get['email'] ?? '';

/* DELETE STUDENT */

mysqli_query($conn,"
DELETE FROM students
WHERE student_id='$id'
");

/* DELETE USER */

mysqli_query($conn,"
DELETE FROM users
WHERE email='$email'
AND role='student'
");

header("Location: manage_students.php");
exit();
}

/* LOAD STUDENTS */

$students = mysqli_query($conn,"
SELECT *
FROM students
WHERE department_id='$department_id'
ORDER BY admission_no DESC
");

/* ERROR CHECK */

if(!$students){

die(mysqli_error($conn));

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Manage Students</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Inter',sans-serif;
}

body{
background:
radial-gradient(circle at 20% 20%, #6366f140, transparent 40%),
radial-gradient(circle at 80% 80%, #3b82f640, transparent 40%),
#f6f8fc;
color:#111827;
display:flex;
min-height:100vh;
overflow-x:hidden;
}

/* SIDEBAR */

.sidebar{
width:250px;
height:100vh;
background:#0f172a;
padding:30px;
position:fixed;
overflow-y:auto;
}

.logo{
font-size:24px;
font-weight:700;
margin-bottom:40px;
color:#6366f1;
}

.sidebar a{
display:block;
padding:14px;
margin-bottom:12px;
border-radius:10px;
text-decoration:none;
color:#cbd5e1;
transition:0.3s;
}

.sidebar a:hover,
.sidebar a.active{
background:linear-gradient(135deg,#6366f1,#3b82f6);
color:white;
transform:translateX(5px);
}

/* MAIN */

.main{
margin-left:250px;
padding:40px;
width:100%;
}

/* TITLE */

.title{
font-size:32px;
font-weight:700;
margin-bottom:10px;
color:#111827;
}

.sub{
color:#6b7280;
margin-bottom:35px;
}

/* CARD */

.card{
background:white;
padding:30px;
border-radius:22px;
box-shadow:0 10px 30px rgba(0,0,0,0.08);
margin-bottom:30px;
}

/* FORM */

.form-grid{
display:grid;
grid-template-columns:repeat(2,1fr);
gap:20px;
}

input,select{
padding:14px;
border-radius:12px;
border:1px solid #dbeafe;
background:#fff;
color:#111827;
outline:none;
transition:0.3s;
}

input:focus,
select:focus{
border-color:#6366f1;
box-shadow:0 0 12px rgba(99,102,241,0.25);
}

/* BUTTON */

button{
padding:14px 22px;
border:none;
border-radius:12px;
background:linear-gradient(135deg,#6366f1,#3b82f6);
color:white;
cursor:pointer;
font-size:15px;
margin-top:20px;
transition:0.3s;
}

button:hover{
transform:scale(1.03);
box-shadow:0 10px 25px rgba(59,130,246,0.35);
}

/* TABLE */

table{
width:100%;
border-collapse:collapse;
margin-top:15px;
overflow:hidden;
border-radius:12px;
}

th,td{
padding:15px;
text-align:center;
}

th{
background:#eef2ff;
color:#4f46e5;
font-weight:600;
}

tr{
border-bottom:1px solid #e5e7eb;
}

tr:hover{
background:#f8fafc;
}

/* DELETE */

.delete{
color:#ef4444;
text-decoration:none;
font-weight:600;
}

/* SUCCESS */

.success{
background:#dcfce7;
color:#166534;
padding:14px;
border-radius:12px;
margin-bottom:20px;
font-weight:600;
}

/* ERROR */

.error{
background:#fee2e2;
color:#b91c1c;
padding:14px;
border-radius:12px;
margin-bottom:20px;
font-weight:600;
}

</style>

</head>

<body>

<!-- SIDEBAR -->

<div class="sidebar">

<div class="logo">
CAMS HOD
</div>

<a href="dashboard.php">
Dashboard
</a>

<a href="manage_students.php" class="active">
Manage Students
</a>

<a href="manage_staff.php">
Manage Faculty
</a>

<a href="manage_subjects.php">
Manage Subjects
</a>

<a href="assign_subjects.php">
Assign Subjects
</a>

<a href="../logout.php">
Logout
</a>

</div>

<!-- MAIN -->

<div class="main">

<div class="title">
Manage Students
</div>

<div class="sub">
Department Student Management Panel
</div>

<?php if(isset($_GET['success'])){ ?>

<div class="success">
Student Added Successfully
</div>

<?php } ?>

<?php if(isset($error)){ ?>

<div class="error">
<?php echo $error; ?>
</div>

<?php } ?>

<!-- ADD STUDENT -->

<div class="card">

<h2 style="margin-bottom:25px;">
Add Student
</h2>

<form method="POST">

<div class="form-grid">

<input
type="text"
name="name"
placeholder="Student Name"
required
>

<input
type="email"
name="email"
placeholder="Email"
required
>

<input
type="text"
name="admission_no"
placeholder="Admission Number"
required
>

<input
type="text"
name="password"
placeholder="Password"
required
>

<select
name="semester"
required
>

<option value="">
Select Semester
</option>

<?php
for($i=1;$i<=8;$i++){
?>

<option value="<?php echo $i; ?>">
Semester <?php echo $i; ?>
</option>

<?php } ?>

</select>

</div>

<button
type="submit"
name="add_student"
>
Add Student
</button>

</form>

</div>

<!-- STUDENT TABLE -->

<div class="card">

<h2 style="margin-bottom:25px;">
Department Students
</h2>

<table>

<tr>

<th>Admission No</th>
<th>Name</th>
<th>Email</th>
<th>Semester</th>
<th>Action</th>

</tr>

<?php while($row=mysqli_fetch_assoc($students)){ ?>

<tr>

<td>
<?php echo $row['admission_no']; ?>
</td>

<td>
<?php echo $row['name']; ?>
</td>

<td>
<?php echo $row['email']; ?>
</td>

<td>
Semester <?php echo $row['semester']; ?>
</td>

<td>

<a
class="delete"
href="?delete=<?php echo $row['student_id']; ?>"
onclick="return confirm('Delete Student?')"
>

Delete

</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</div>

</body>
</html>