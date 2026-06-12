<?php
session_start();
include "../config/db.php";

$page_title="Profile Settings";
include "layout/layout.php";

$faculty_id = 1;

$message="";


/* UPDATE PROFILE */

if(isset($_POST['update_profile'])){

$name=$_POST['name'];
$email=$_POST['email'];

mysqli_query($conn,"
UPDATE faculty
SET name='$name', email='$email'
WHERE faculty_id='$faculty_id'
");

$message="Profile Updated Successfully";

}


/* CHANGE PASSWORD */

if(isset($_POST['change_password'])){

$password=$_POST['password'];

mysqli_query($conn,"
UPDATE users
SET password='$password'
WHERE role='faculty'
AND email=(SELECT email FROM faculty WHERE faculty_id='$faculty_id')
");

$message="Password Updated Successfully";

}


/* FETCH PROFILE */

$faculty=mysqli_fetch_assoc(mysqli_query($conn,"
SELECT * FROM faculty
WHERE faculty_id='$faculty_id'
"));

?>


<h2 class="text-2xl font-semibold mb-8">
Profile Settings
</h2>


<?php if($message!=""){ ?>

<div class="bg-green-100 text-green-700 p-3 rounded mb-6">
<?php echo $message; ?>
</div>

<?php } ?>


<!-- PROFILE UPDATE -->

<div class="bg-white p-6 rounded-xl shadow card mb-8">

<h3 class="font-semibold mb-4">
Update Profile
</h3>

<form method="POST" class="space-y-4">

<input
type="text"
name="name"
value="<?php echo $faculty['name']; ?>"
class="border p-2 rounded w-full"
required
>

<input
type="email"
name="email"
value="<?php echo $faculty['email']; ?>"
class="border p-2 rounded w-full"
required
>

<button
name="update_profile"
class="bg-indigo-600 text-white px-6 py-2 rounded">
Update Profile
</button>

</form>

</div>


<!-- PASSWORD CHANGE -->

<div class="bg-white p-6 rounded-xl shadow card">

<h3 class="font-semibold mb-4">
Change Password
</h3>

<form method="POST" class="space-y-4">

<input
type="password"
name="password"
placeholder="New Password"
class="border p-2 rounded w-full"
required
>

<button
name="change_password"
class="bg-red-600 text-white px-6 py-2 rounded">
Change Password
</button>

</form>

</div>


<?php include "layout/footer.php"; ?>