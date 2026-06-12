<?php
include "config/db.php";

$message="";
$success=false;

if(isset($_POST['register'])){

$name=trim($_POST['name']);
$email=trim($_POST['email']);
$password=$_POST['password'];
$role=$_POST['role'];
$department=$_POST['department'];
$semester=$_POST['semester'];

$q1=$_POST['q1'];
$a1=trim($_POST['a1']);
$q2=$_POST['q2'];
$a2=trim($_POST['a2']);

// check empty questions
if($q1=="" || $q2==""){
$message="Please select both security questions.";
}
else if($q1==$q2){
$message="Please select two different security questions.";
}
else{

// check duplicate email
$check = mysqli_query($conn,"SELECT * FROM registration_requests WHERE email='$email'");
if(mysqli_num_rows($check)>0){
$message="Email already exists.";
}
else{

// hash password (important even for project)
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// insert query
$query = "INSERT INTO registration_requests
(name,email,password,role,department_id,semester,security_q1,security_a1,security_q2,security_a2,status)
VALUES
('$name','$email','$hashed_password','$role','$department','$semester','$q1','$a1','$q2','$a2','Pending')";

if(mysqli_query($conn,$query)){
$message="Registration submitted. Wait for admin approval. Redirecting to login...";
$success=true;
}else{
$message="Error: ".mysqli_error($conn);
}

}

}

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Register</title>

<script src="https://cdn.tailwindcss.com"></script>

<?php if($success){ ?>

<script>
setTimeout(function(){
window.location.href="index.php";
},3000);
</script>

<?php } ?>

</head>

<body class="flex items-center justify-center min-h-screen bg-gray-100">

<div class="bg-white p-8 rounded-xl shadow w-96">

<h2 class="text-xl font-semibold mb-6 text-center">Register</h2>

<?php if($message!=""){ ?>
<div class="p-2 mb-4 rounded text-center 
<?php echo $success ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'; ?>">
<?php echo $message; ?>
</div>
<?php } ?>

<form method="POST" class="space-y-4">

<input type="text" name="name" placeholder="Full Name"
class="border p-2 rounded w-full" required>

<input type="email" name="email" placeholder="Email"
class="border p-2 rounded w-full" required>

<input type="password" name="password" placeholder="Password"
class="border p-2 rounded w-full" required>

<select name="role" class="border p-2 rounded w-full">
<option value=""disabled selected>Role</option>
<option value="student">Student</option>
<option value="parent">Parent</option>

</select>
<select name="department" class="border p-2 rounded w-full" required>
<option value="" disabled selected>Select Department</option>
<option value="1">Computer Engineering</option>
<option value="2">Civil Engineering</option>
<option value="3">Mechanical Engineering</option>
</select>

<select name="semester" class="border p-2 rounded w-full" required>
<option value="" disabled selected>Select Semester</option>
<option value="1">S1</option>
<option value="2">S2</option>
<option value="3">S3</option>
<option value="4">S4</option>
<option value="5">S5</option>
<option value="6">S6</option>
</select>

<label class="text-sm text-gray-600">Security Question 1</label>
<select name="q1" class="border p-2 rounded w-full" required>
<option value=""disabled selected>Select a question</option>
<option value="What was the name of your first school?">What was the name of your first school?</option>
<option value="What city were you born in?">What city were you born in?</option>
<option value="What is your favorite food?">What is your favorite food?</option>
<option value="What is the name of your best friend?">What is the name of your best friend?</option>
</select>

<input type="text" name="a1" placeholder="Answer"
class="border p-2 rounded w-full" required>
<label class="text-sm text-gray-600">Security Question 2</label>
<select name="q2" class="border p-2 rounded w-full" required>
<option value=""disabled selected>Select another question</option>
<option value="What was the name of your first school?">What was the name of your first school?</option>
<option value="What city were you born in?">What city were you born in?</option>
<option value="What is your favorite food?">What is your favorite food?</option>
<option value="What is the name of your best friend?">What is the name of your best friend?</option>
</select>

<input type="text" name="a2" placeholder="Answer"
class="border p-2 rounded w-full" required>

<button name="register"
class="bg-indigo-600 text-white w-full py-2 rounded">
Register
</button>

</form>

</div>

</body>
</html>
