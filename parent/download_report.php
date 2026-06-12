<?php
session_start();
include "../config/db.php";

$page_title="Download Attendance Report";
include "layout/layout.php";

/* TEMP LOGIN */
$parent_id = 1;

/* GET STUDENT */

$student = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT students.*
FROM parents
JOIN students
ON parents.student_id = students.student_id
WHERE parents.parent_id='$parent_id'
"));

$student_id = $student['student_id'];
$semester = $student['semester'];
$department = $student['department_id'];

/* TOTAL CLASSES */

$total = mysqli_num_rows(mysqli_query($conn,"
SELECT *
FROM attendance
WHERE student_id='$student_id'
"));

/* PRESENT */

$present = mysqli_num_rows(mysqli_query($conn,"
SELECT *
FROM attendance
WHERE student_id='$student_id'
AND status='Present'
"));

/* PERCENTAGE */

$percentage = $total > 0 ? round(($present/$total)*100,2) : 0;

?>

<h2 class="text-2xl font-semibold mb-8">
Attendance Report
</h2>


<div class="bg-white p-8 rounded-xl shadow max-w-3xl">

<h3 class="text-xl font-semibold mb-6">
Student Information
</h3>

<div class="grid grid-cols-2 gap-4 mb-6">

<p><strong>Name:</strong> <?php echo $student['name']; ?></p>

<p><strong>Email:</strong> <?php echo $student['email']; ?></p>

<p><strong>Semester:</strong> <?php echo $semester; ?></p>

<p><strong>Department:</strong> <?php echo $department; ?></p>

</div>


<hr class="my-6">


<h3 class="text-xl font-semibold mb-6">
Attendance Summary
</h3>

<div class="grid grid-cols-3 gap-6 text-center">

<div class="bg-gray-50 p-5 rounded">

<p class="text-gray-500 text-sm">Total Classes</p>

<h2 class="text-3xl font-bold">
<?php echo $total; ?>
</h2>

</div>


<div class="bg-green-50 p-5 rounded">

<p class="text-gray-500 text-sm">Classes Attended</p>

<h2 class="text-3xl font-bold text-green-600">
<?php echo $present; ?>
</h2>

</div>


<div class="bg-indigo-50 p-5 rounded">

<p class="text-gray-500 text-sm">Attendance %</p>

<h2 class="text-3xl font-bold text-indigo-600">
<?php echo $percentage; ?>%
</h2>

</div>

</div>


<div class="mt-8 flex gap-4">

<button
onclick="window.print()"
class="bg-indigo-600 text-white px-6 py-2 rounded">
Print Report
</button>

<a href="dashboard.php"
class="bg-gray-300 px-6 py-2 rounded">
Back
</a>

</div>

</div>


<?php include "layout/footer.php"; ?>