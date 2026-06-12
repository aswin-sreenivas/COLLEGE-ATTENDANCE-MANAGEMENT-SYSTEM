<?php
session_start();
include "../config/db.php";

$page_title="Notifications";
include "layout/layout.php";

$message="";


/* SEND NOTIFICATION */

if(isset($_POST['send_notification'])){

$title=$_POST['title'];
$msg=$_POST['message'];

mysqli_query($conn,"
INSERT INTO notifications(title,message)
VALUES('$title','$msg')
");

$message="Notification Sent Successfully";

}

?>


<h2 class="text-2xl font-semibold mb-8">
Notifications
</h2>


<?php if($message!=""){ ?>

<div class="bg-green-100 text-green-700 p-3 rounded mb-6">
<?php echo $message; ?>
</div>

<?php } ?>


<!-- SEND NOTIFICATION -->

<div class="bg-white p-6 rounded-xl shadow card mb-8">

<h3 class="font-semibold mb-4">
Send Notification
</h3>

<form method="POST" class="space-y-4">

<input
type="text"
name="title"
placeholder="Notification Title"
class="border p-2 rounded w-full"
required
>

<textarea
name="message"
placeholder="Notification Message"
class="border p-2 rounded w-full"
rows="4"
required
></textarea>

<button
name="send_notification"
class="bg-indigo-600 text-white px-6 py-2 rounded">
Send Notification
</button>

</form>

</div>



<!-- NOTIFICATION LIST -->

<div class="bg-white p-6 rounded-xl shadow card">

<h3 class="font-semibold mb-4">
Notification History
</h3>

<table class="w-full text-sm">

<thead class="border-b text-gray-500">

<tr>

<th class="py-2 text-left">Title</th>
<th>Message</th>
<th>Date</th>

</tr>

</thead>

<tbody>

<?php

$notifications=mysqli_query($conn,"
SELECT * FROM notifications
ORDER BY created_at DESC
");

while($row=mysqli_fetch_assoc($notifications)){

?>

<tr class="border-b hover:bg-gray-50">

<td class="py-2">
<?php echo $row['title']; ?>
</td>

<td>
<?php echo $row['message']; ?>
</td>

<td>
<?php echo $row['created_at']; ?>
</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>


<?php include "layout/footer.php"; ?>