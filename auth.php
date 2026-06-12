<?php
session_start();

include "config/db.php";

error_reporting(E_ALL);
ini_set('display_errors',1);

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

$query = "
SELECT * FROM users
WHERE email='$email'
AND password='$password'
";

$result = mysqli_query($conn,$query);

if($result && mysqli_num_rows($result)==1){

$user = mysqli_fetch_assoc($result);

/* SESSION */

$_SESSION['user_id'] = $user['id'];

$_SESSION['role'] = strtolower($user['role']);

$_SESSION['name'] = $user['name'];

$_SESSION['department_id'] = $user['department_id'] ?? 0;


/* REDIRECT */

if($_SESSION['role']=="admin"){

header("Location: admin/dashboard.php");
exit;

}

elseif($_SESSION['role']=="faculty"){

header("Location: faculty/dashboard.php");
exit;

}

elseif($_SESSION['role']=="student"){

header("Location: student/dashboard.php");
exit;

}

elseif($_SESSION['role']=="parent"){

header("Location: parent/dashboard.php");
exit;

}

elseif($_SESSION['role']=="hod"){

header("Location: hod/dashboard.php");
exit;

}

else{

echo "Unknown role";

}

}

else{

echo "
<script>
alert('Invalid Login');
window.location='login.php';
</script>
";

}
?>