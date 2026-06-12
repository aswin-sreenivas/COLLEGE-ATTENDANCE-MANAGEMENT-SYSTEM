<?php
session_start();
include "../config/db.php";

$page_title="Request Condonation";
include "layout/layout.php";

$user_id = $_SESSION['user_id'];


/* GET STUDENT ID */

$student = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT student_id
FROM students
WHERE user_id='$user_id'
"));

$student_id = $student['student_id'];

$message = "";


/* ATTENDANCE CALCULATION */

$total = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM attendance
WHERE student_id='$student_id'
"));

$present = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) AS present
FROM attendance
WHERE student_id='$student_id'
AND status='Present'
"));

$total_classes = $total['total'];
$present_classes = $present['present'];

$percentage = 0;

if($total_classes > 0){
$percentage = round(($present_classes/$total_classes)*100,2);
}


/* CHECK PENDING */

$check = mysqli_num_rows(mysqli_query($conn,"
SELECT * FROM condonation_requests
WHERE student_id='$student_id'
AND status='Pending'
"));


/* FETCH LATEST REQUEST */

$latest_request = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT *
FROM condonation_requests
WHERE student_id='$student_id'
ORDER BY request_id DESC
LIMIT 1
"));

/* SUBMIT */

if(isset($_POST['request_condonation']) && $percentage < 75){

$reason = $_POST['reason'];
$type = $_POST['type'];

/* FILE UPLOAD */

$filename = "";

if(isset($_FILES['document']) && $_FILES['document']['name'] != ""){

$target_dir = "doc/";
$filename = time() . "_" . basename($_FILES["document"]["name"]);
$target_file = $target_dir . $filename;

/* MOVE FILE */

move_uploaded_file($_FILES["document"]["tmp_name"], $target_file);

}

/* INSERT */

mysqli_query($conn,"
INSERT INTO condonation_requests
(student_id,attendance_percentage,reason,type,document,status)
VALUES
('$student_id','$percentage','$reason','$type','$filename','Pending')
");

$message = "Condonation request submitted successfully";

}

?>


<h2 class="text-2xl font-semibold mb-8">
Condonation Request
</h2>


<!-- ATTENDANCE -->

<div class="bg-white p-6 rounded-xl shadow card mb-6">

<h3 class="font-semibold mb-4">
Overall Attendance
</h3>

<p class="text-lg">

Attendance Percentage:

<?php if($percentage < 75){ ?>
<span class="text-red-500 font-bold"><?php echo $percentage ?>%</span>
<?php } else { ?>
<span class="text-green-600 font-bold"><?php echo $percentage ?>%</span>
<?php } ?>

</p>

</div>


<?php if($percentage < 75){ ?>

<div class="bg-white p-6 rounded-xl shadow card">

<h3 class="font-semibold mb-4">
Request Condonation
</h3>


<?php if($message!=""){ ?>
<div class="bg-green-100 text-green-700 p-3 rounded mb-4">
<?php echo $message; ?>
</div>
<?php } ?>


<?php if($check == 0){ ?>

<?php if($latest_request && $latest_request['status']=="Approved"){ ?>

<div class="bg-green-100 text-green-700 p-4 rounded mb-4">
Your condonation request has been approved.
</div>

<?php } elseif($latest_request && $latest_request['status']=="Rejected"){ ?>

<div class="bg-red-100 text-red-700 p-4 rounded mb-4">
Your condonation request has been rejected.
</div>

<?php } ?>

<form method="POST" enctype="multipart/form-data">

<!-- TYPE -->

<select name="type" class="border p-2 rounded w-full mb-4" required>
<option value="">Select Reason Type</option>
<option value="Medical">Medical</option>
<option value="Personal">Personal</option>
<option value="Family Issue">Family Issue</option>
<option value="Other">Other</option>
</select>


<!-- TEXT -->

<textarea
name="reason"
placeholder="Enter detailed reason..."
class="border p-2 rounded w-full mb-4"
required></textarea>


<!-- FILE -->

<label class="block mb-2 text-sm font-medium">
Upload Supporting Document
</label>

<input
type="file"
name="document"
class="border p-2 rounded w-full mb-4"
accept=".pdf,.jpg,.png">


<button
name="request_condonation"
class="bg-indigo-600 text-white px-6 py-2 rounded">

Submit Request

</button>

</form>

<?php } else { ?>

<p class="text-yellow-600">
Your condonation request is already pending.
</p>

<?php } ?>

</div>

<?php } else { ?>

<div class="bg-green-100 text-green-700 p-4 rounded">
Your attendance is above 75%. Condonation not required.
</div>

<?php } ?>


<?php include "layout/footer.php"; ?>