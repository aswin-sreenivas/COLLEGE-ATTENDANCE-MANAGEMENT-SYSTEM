<?php
session_start();
include "../config/db.php";


/* UPDATE SETTINGS */

if(isset($_POST['save'])){

$name = $_POST['system_name'];
$email = $_POST['admin_email'];
$min = $_POST['min_attendance'];

mysqli_query($conn,"
UPDATE system_settings 
SET system_name='$name',
admin_email='$email',
min_attendance='$min'
WHERE id=1
");

header("Location: settings.php");
exit;

}


/* FETCH SETTINGS */

$result = mysqli_query($conn,"SELECT * FROM system_settings WHERE id=1");

if($result && mysqli_num_rows($result) > 0){
$settings = mysqli_fetch_assoc($result);
}else{

$settings = [
'system_name' => 'CAMS',
'admin_email' => '',
'min_attendance' => 75
];

}

?>

<!DOCTYPE html>
<html>

<head>

<title>System Settings</title>

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

<?php include "layout/sidebar.php"; ?>

<div class="main">

<h2 class="text-2xl font-semibold mb-6">
System Settings
</h2>


<div class="bg-white p-6 rounded-xl shadow">

<form method="POST" class="grid grid-cols-2 gap-4">

<label>System Name</label>

<input
type="text"
name="system_name"
value="<?php echo $settings['system_name']; ?>"
class="border p-2 rounded"
>


<label>Admin Email</label>

<input
type="email"
name="admin_email"
value="<?php echo $settings['admin_email']; ?>"
class="border p-2 rounded"
>


<label>Minimum Attendance %</label>

<input
type="number"
name="min_attendance"
value="<?php echo $settings['min_attendance']; ?>"
class="border p-2 rounded"
>


<div></div>

<button
name="save"
class="bg-indigo-600 text-white px-6 py-2 rounded">
Save Settings
</button>

</form>

</div>

</div>

</body>
</html>