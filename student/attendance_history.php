<?php
session_start();
include "../config/db.php";

$page_title="Attendance History";
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

/* SUBJECT FILTER */
$subject_filter = "";

if(isset($_GET['subject_id']) && $_GET['subject_id']!=""){
$subject_id = $_GET['subject_id'];
$subject_filter = "AND attendance.subject_id='$subject_id'";
}

/* FETCH SUBJECT LIST */

$subjects = mysqli_query($conn,"
SELECT DISTINCT subjects.subject_id, subjects.subject_name
FROM attendance
JOIN subjects
ON attendance.subject_id = subjects.subject_id
WHERE attendance.student_id='$student_id'
");

/* FETCH ATTENDANCE */

$result = mysqli_query($conn,"
SELECT attendance.*, subjects.subject_name
FROM attendance
JOIN subjects
ON attendance.subject_id = subjects.subject_id
WHERE attendance.student_id='$student_id'
$subject_filter
ORDER BY attendance.date DESC
");

?>


<h2 class="text-2xl font-semibold mb-8">
Attendance History
</h2>


<!-- FILTER -->

<div class="bg-white p-6 rounded-xl shadow card mb-8">

<form method="GET" class="flex gap-4">

<select name="subject_id" class="border p-2 rounded">

<option value="">All Subjects</option>

<?php while($s=mysqli_fetch_assoc($subjects)){ ?>

<option value="<?php echo $s['subject_id']; ?>">
<?php echo $s['subject_name']; ?>
</option>

<?php } ?>

</select>

<button class="bg-indigo-600 text-white px-4 py-2 rounded">
Filter
</button>

</form>

</div>



<!-- ATTENDANCE TABLE -->

<div class="bg-white p-6 rounded-xl shadow card">

<table class="w-full text-sm">

<thead class="border-b text-gray-500">

<tr>

<th class="py-2 text-left">Date</th>
<th>Subject</th>
<th>Period</th>
<th>Status</th>

</tr>

</thead>

<tbody>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr class="border-b hover:bg-gray-50">

<td class="py-2">
<?php echo $row['date']; ?>
</td>

<td>
<?php echo $row['subject_name']; ?>
</td>

<td>

<?php if(strtolower(trim($row['status']))=="present"){ ?>

<span class="text-green-600 font-medium">
Present
</span>

<?php } else { ?>

<span class="text-red-500 font-medium">
Absent
</span>

<?php } ?>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>


<?php include "layout/footer.php"; ?>