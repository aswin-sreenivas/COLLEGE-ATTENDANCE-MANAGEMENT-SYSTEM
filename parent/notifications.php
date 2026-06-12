<?php
session_start();
include "../config/db.php";

$page_title="Notifications";
include "layout/layout.php";

/* GET PARENT USER ID FROM SESSION */

$parent_id = $_SESSION['user_id'] ?? 1;

/* FETCH NOTIFICATIONS */

$sql = "
SELECT *
FROM notifications
WHERE user_id='$parent_id'
ORDER BY created_at DESC
";

$result = mysqli_query($conn,$sql);

/* MARK ALL AS READ */

mysqli_query($conn,"UPDATE notifications SET status='read' WHERE user_id='$parent_id'");
?>

<h2 class="text-2xl font-semibold mb-8">
Notifications
</h2>

<div class="bg-white p-6 rounded-xl shadow">

<?php if($result && mysqli_num_rows($result)>0){ ?>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<div class="border-b py-4 flex gap-3">

<!-- notification dot -->
<div class="w-2 h-2 
<?php echo $row['status']=='unread' ? 'bg-red-500' : 'bg-indigo-500'; ?> 
mt-2 rounded-full">
</div>

<div class="flex-1">

<p class="text-gray-900 font-semibold">
<?php echo htmlspecialchars($row['title']); ?>
</p>

<p class="text-gray-700 text-sm mt-1">
<?php echo htmlspecialchars($row['message']); ?>
</p>

<p class="text-gray-400 text-xs mt-2">
<?php echo date("d M Y",strtotime($row['created_at'])); ?>
</p>

</div>

</div>

<?php } ?>

<?php } else { ?>

<div class="text-center text-gray-400 py-10">
No notifications available
</div>

<?php } ?>

</div>

<?php include "layout/footer.php"; ?>