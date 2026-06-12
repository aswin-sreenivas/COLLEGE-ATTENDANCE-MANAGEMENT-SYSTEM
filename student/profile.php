<?php
session_start();
include "../config/db.php";

$page_title = "Profile Settings";
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

$message = "";

/* FETCH STUDENT DATA */

$student = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT * FROM students
WHERE student_id='$student_id'
"));


/* UPDATE PROFILE */

if(isset($_POST['update_profile'])){

$name = $_POST['name'];
$email = $_POST['email'];

mysqli_query($conn,"
UPDATE students
SET name='$name', email='$email'
WHERE student_id='$student_id'
");

$message = "Profile updated successfully";

$student = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT * FROM students
WHERE student_id='$student_id'
"));

}
?>


<h2 class="text-2xl font-semibold mb-8">
Profile Settings
</h2>


<?php if($message!=""){ ?>

<div class="bg-green-100 text-green-700 p-3 rounded mb-6">
<?php echo $message; ?>
</div>

<?php } ?>


<div class="bg-white p-6 rounded-xl shadow card max-w-lg">

<h3 class="font-semibold mb-4">
Update Profile
</h3>

<form method="POST" class="space-y-4">

<label class="block text-sm text-gray-600">
Name
</label>

<input
type="text"
name="name"
value="<?php echo $student['name']; ?>"
class="border p-2 rounded w-full"
required>


<label class="block text-sm text-gray-600">
Email
</label>

<input
type="email"
name="email"
value="<?php echo $student['email']; ?>"
class="border p-2 rounded w-full"
required>


<button
name="update_profile"
class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">

Update Profile

</button>

</form>

</div>


<?php include "layout/footer.php"; ?>