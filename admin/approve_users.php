<?php
session_start();
include "../config/db.php";

/* APPROVE USER */

if(isset($_GET['approve'])){

$id = $_GET['approve'];

$data = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT * FROM registration_requests WHERE request_id='$id'
"));

if($data){

$name = $data['name'];
$email = $data['email'];
$password = $data['password'];
$role = $data['role'];

/* INSERT INTO USERS */

mysqli_query($conn,"
INSERT INTO users (name,email,password,role,status)
VALUES('$name','$email','$password','$role','active')
");

$user_id = mysqli_insert_id($conn);

/* ROLE BASED INSERT */

if($role == "student"){

mysqli_query($conn,"
INSERT INTO students (user_id,name,email,semester,department_id)
VALUES('$user_id','$name','$email','1','1')
");

}

elseif($role == "parent"){

mysqli_query($conn,"
INSERT INTO parents (user_id,name,email)
VALUES('$user_id','$name','$email')
");

}

elseif($role == "faculty"){

mysqli_query($conn,"
INSERT INTO faculty (user_id,name,email,department_id)
VALUES('$user_id','$name','$email','1')
");

}

/* UPDATE STATUS */

mysqli_query($conn,"
UPDATE registration_requests
SET status='Approved'
WHERE request_id='$id'
");

}

header("Location: approve_users.php");
exit;
}


/* REJECT */

if(isset($_GET['reject'])){

$id=$_GET['reject'];

mysqli_query($conn,"
UPDATE registration_requests
SET status='Rejected'
WHERE request_id='$id'
");

header("Location: approve_users.php");
exit;
}


/* FETCH */

$result = mysqli_query($conn,"
SELECT * FROM registration_requests
WHERE status='Pending'
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Approve Users</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-10">

<h2 class="text-2xl font-semibold mb-6">
Registration Requests
</h2>

<div class="bg-white p-6 rounded-xl shadow">

<table class="w-full text-sm">

<thead class="border-b text-gray-500">
<tr>
<th>Name</th>
<th>Email</th>
<th>Role</th>
<th>Action</th>
</tr>
</thead>

<tbody>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr class="border-b">
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['email']; ?></td>
<td><?php echo $row['role']; ?></td>

<td>
<a href="?approve=<?php echo $row['request_id']; ?>" class="text-green-600 mr-3">Approve</a>
<a href="?reject=<?php echo $row['request_id']; ?>" class="text-red-500">Reject</a>
</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</body>
</html>