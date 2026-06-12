<?php
session_start();
include "../config/db.php";

$page_title = "Profile Settings";
include "layout/layout.php";

/* TEMP LOGIN */
$parent_id = 1;

$message = "";

/* UPDATE PROFILE */

if(isset($_POST['update'])){

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];

mysqli_query($conn,"
UPDATE parents
SET name='$name',
email='$email',
phone='$phone',
address='$address'
WHERE parent_id='$parent_id'
");

$message = "Profile updated successfully";

}

/* FETCH DATA */

$result = mysqli_query($conn,"
SELECT * FROM parents
WHERE parent_id='$parent_id'
");

$parent = mysqli_fetch_assoc($result);

?>

<h2 class="text-2xl font-semibold mb-8">
Profile Settings
</h2>


<?php if($message!=""){ ?>

<div class="bg-green-100 text-green-700 p-3 rounded mb-6">
<?php echo $message; ?>
</div>

<?php } ?>


<div class="bg-white p-6 rounded-xl shadow max-w-xl">

<form method="POST" class="space-y-4">

<div>

<label class="block text-sm text-gray-500 mb-1">
Name
</label>

<input
type="text"
name="name"
value="<?php echo $parent['name'] ?? ''; ?>"
class="border p-2 rounded w-full"
required>

</div>


<div>

<label class="block text-sm text-gray-500 mb-1">
Email
</label>

<input
type="email"
name="email"
value="<?php echo $parent['email'] ?? ''; ?>"
class="border p-2 rounded w-full"
required>

</div>


<div>

<label class="block text-sm text-gray-500 mb-1">
Phone
</label>

<input
type="text"
name="phone"
value="<?php echo $parent['phone'] ?? ''; ?>"
class="border p-2 rounded w-full">

</div>


<div>

<label class="block text-sm text-gray-500 mb-1">
Address
</label>

<textarea
name="address"
class="border p-2 rounded w-full"
rows="3"><?php echo $parent['address'] ?? ''; ?></textarea>

</div>


<button
name="update"
class="bg-indigo-600 text-white px-6 py-2 rounded">
Update Profile
</button>

</form>

</div>


<?php include "layout/footer.php"; ?>