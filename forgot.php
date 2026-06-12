<?php
include "config/db.php";

$message="";
$step=1;
$email="";

/* STEP 1 - CHECK EMAIL */
if(isset($_POST['check_email'])){

$email=$_POST['email'];

$user=mysqli_fetch_assoc(mysqli_query($conn,"
SELECT * FROM users WHERE email='$email'
"));

if($user){

$req=mysqli_fetch_assoc(mysqli_query($conn,"
SELECT * FROM registration_requests WHERE email='$email'
"));

if($req){
$step=2;
}else{
$message="Security questions not found!";
}

}else{
$message="Email not found!";
}

}


/* STEP 2 - VERIFY ANSWERS */
if(isset($_POST['verify_answers'])){

$email=$_POST['email'];
$a1=$_POST['a1'];
$a2=$_POST['a2'];

$req=mysqli_fetch_assoc(mysqli_query($conn,"
SELECT * FROM registration_requests WHERE email='$email'
"));

if($req){

if(
strtolower(trim($req['security_a1'])) == strtolower(trim($a1)) &&
strtolower(trim($req['security_a2'])) == strtolower(trim($a2))
){
$step=3;
}else{
$message="Wrong answers!";
$step=2;
}

}

}


/* STEP 3 - RESET PASSWORD */
if(isset($_POST['reset_password'])){

$email=$_POST['email'];
$newpass=$_POST['newpass'];

mysqli_query($conn,"
UPDATE users SET password='$newpass' WHERE email='$email'
");

$message="Password reset successful! Redirecting to login...";

/* REDIRECT AFTER 2 SEC */
echo "<script>
setTimeout(function(){
window.location.href='index.php';
},2000);
</script>";

$step=1;

}
?>

<!DOCTYPE html>
<html>
<head>
<title>Forgot Password</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-100">

<div class="bg-white p-8 rounded-xl shadow w-96">

<h2 class="text-xl font-semibold mb-4 text-center">
Forgot Password
</h2>

<?php if($message!=""){ ?>
<div class="bg-green-100 text-green-700 p-2 mb-3 text-center rounded">
<?php echo $message; ?>
</div>
<?php } ?>


<!-- STEP 1 -->
<?php if($step==1){ ?>
<form method="POST">
<input name="email" placeholder="Enter Email"
class="border p-2 w-full mb-3 rounded" required>

<button name="check_email"
class="bg-indigo-600 text-white w-full py-2 rounded hover:bg-indigo-700">
Next
</button>
</form>
<?php } ?>


<!-- STEP 2 -->
<?php if($step==2){ ?>
<form method="POST">

<input type="hidden" name="email" value="<?php echo $email; ?>">

<input name="a1" placeholder="Answer for Question 1"
class="border p-2 w-full mb-3 rounded" required>

<input name="a2" placeholder="Answer for Question 2"
class="border p-2 w-full mb-3 rounded" required>

<button name="verify_answers"
class="bg-green-600 text-white w-full py-2 rounded hover:bg-green-700">
Verify Answers
</button>

</form>
<?php } ?>


<!-- STEP 3 -->
<?php if($step==3){ ?>
<form method="POST">

<input type="hidden" name="email" value="<?php echo $email; ?>">

<input type="password" name="newpass"
placeholder="Enter New Password"
class="border p-2 w-full mb-3 rounded" required>

<button name="reset_password"
class="bg-blue-600 text-white w-full py-2 rounded hover:bg-blue-700">
Reset Password
</button>

</form>
<?php } ?>


</div>

</body>
</html>