<?php
session_start();
include "../config/db.php";

$page_title="Notifications";
include "layout/layout.php";

/* TEMP STUDENT LOGIN */
$user_id = $_SESSION['user_id'];


/* GET STUDENT ID */

$student = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT student_id
FROM students
WHERE user_id='$user_id'
"));

$student_id = $student['student_id'];

/* FETCH NOTIFICATIONS */

$query = "
SELECT * FROM notifications
WHERE user_id='$student_id'
AND user_role='student'
ORDER BY created_at DESC
";

$notifications = mysqli_query($conn,$query);

?>


<h2 class="text-2xl font-semibold mb-8">
Notifications
</h2>


<div class="bg-white p-6 rounded-xl shadow card">

<table class="w-full text-sm">

<thead class="border-b text-gray-500">

<tr>

<th class="py-2 text-left">Date</th>
<th>Title</th>
<th>Message</th>
<th>Status</th>

</tr>

</thead>

<tbody>

<?php if($notifications && mysqli_num_rows($notifications) > 0){ ?>

<?php while($row=mysqli_fetch_assoc($notifications)){ ?>

<tr class="border-b hover:bg-gray-50">

<td class="py-2">
<?php echo $row['created_at']; ?>
</td>

<td class="font-medium">
<?php echo $row['title']; ?>
</td>

<td>
<?php echo $row['message']; ?>
</td>

<td>

<?php if($row['status']=="unread"){ ?>

<span class="text-red-500 font-semibold">
Unread
</span>

<?php } else { ?>

<span class="text-green-600">
Read
</span>

<?php } ?>

</td>

</tr>

<?php } ?>

<?php } else { ?>

<tr>

<td colspan="4" class="text-center py-6 text-gray-400">
No notifications available
</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>


<?php include "layout/footer.php"; ?>