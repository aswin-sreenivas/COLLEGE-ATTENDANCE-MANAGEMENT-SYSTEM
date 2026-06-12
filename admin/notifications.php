<?php
session_start();
include "../config/db.php";


/* ADD NOTIFICATION */

if(isset($_POST['send'])){

$title = $_POST['title'];
$msg = $_POST['message'];
$role = $_POST['target_role'] ?? 'all';

mysqli_query($conn,"
INSERT INTO notifications (title,message,target_role)
VALUES('$title','$msg','$role')
");

header("Location: notifications.php");
exit;
}


/* DELETE */

if(isset($_GET['delete'])){

$id = $_GET['delete'];

mysqli_query($conn,"
DELETE FROM notifications WHERE notification_id='$id'
");

header("Location: notifications.php");
exit;
}


/* FETCH */

$result = mysqli_query($conn,"
SELECT * FROM notifications ORDER BY created_at DESC
");
?>

<!DOCTYPE html>
<html>
<head>

<title>Notifications</title>

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

<?php include "layout/sidebar.php"; ?>

<div class="main">

<h2 class="text-2xl font-semibold mb-6">
Notifications
</h2>


<!-- SEND -->

<div class="bg-white p-6 rounded-xl shadow mb-8 card">

<h3 class="font-semibold mb-4">Send Notification</h3>

<form method="POST" class="grid grid-cols-2 gap-4">

<input type="text" name="title"
placeholder="Title"
class="border p-2 rounded" required>

<select name="target_role" class="border p-2 rounded">
<option value="all">All Users</option>
<option value="student">Students</option>
<option value="faculty">Faculty</option>
<option value="parent">Parents</option>
</select>

<textarea name="message"
placeholder="Message"
class="border p-2 rounded col-span-2"
required></textarea>

<button name="send"
class="bg-indigo-600 text-white py-2 rounded col-span-2">
Send Notification
</button>

</form>

</div>


<!-- LIST -->

<div class="bg-white p-6 rounded-xl shadow">

<h3 class="font-semibold mb-4">
Notification History
</h3>

<table class="w-full text-sm">

<thead class="border-b text-gray-500">
<tr>
<th>Title</th>
<th>Message</th>
<th>Target</th>
<th>Date</th>
<th>Action</th>
</tr>
</thead>

<tbody>

<?php if($result && mysqli_num_rows($result)>0){ ?>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr class="border-b hover:bg-gray-50">

<td><?php echo $row['title']; ?></td>

<td><?php echo $row['message']; ?></td>

<td class="capitalize">
<?php echo $row['target_role'] ?? 'All'; ?>
</td>

<td>
<?php echo $row['created_at']; ?>
</td>

<td>
<a href="?delete=<?php echo $row['notification_id']; ?>"
class="text-red-500 hover:underline"
onclick="return confirm('Delete notification?')">
Delete
</a>
</td>

</tr>

<?php } ?>

<?php } else { ?>

<tr>
<td colspan="5" class="text-center py-6 text-gray-400">
No notifications found
</td>
</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</body>
</html>