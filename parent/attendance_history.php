<?php
session_start();
include "../config/db.php";

$page_title="Attendance History";
include "layout/layout.php";

/* TEMP LOGIN */
$parent_id = 1;

/* GET STUDENT */

$student = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT students.*, departments.department_name
FROM parents
JOIN students ON parents.student_id = students.student_id
LEFT JOIN departments ON students.department_id = departments.department_id
WHERE parents.parent_id='$parent_id'
"));

$student_id = $student['student_id'];


/* FILTERS */

$subject_filter = "";
$month_filter = "";

if(isset($_GET['subject_id']) && $_GET['subject_id']!=""){
$subject = $_GET['subject_id'];
$subject_filter = "AND attendance.subject_id='$subject'";
}

if(isset($_GET['month']) && $_GET['month']!=""){
$month = $_GET['month'];
$month_filter = "AND MONTH(attendance.date)='$month'";
}


/* SUBJECT LIST */

$subjects = mysqli_query($conn,"
SELECT DISTINCT subjects.subject_id, subjects.subject_name
FROM attendance
JOIN subjects ON attendance.subject_id = subjects.subject_id
WHERE attendance.student_id='$student_id'
");


/* FETCH RECORDS */

$result = mysqli_query($conn,"
SELECT attendance.*, subjects.subject_name
FROM attendance
JOIN subjects ON attendance.subject_id = subjects.subject_id
WHERE attendance.student_id='$student_id'
$subject_filter
$month_filter
ORDER BY attendance.date DESC
");

?>

<h2 class="text-2xl font-semibold mb-8">
Attendance History
</h2>


<!-- STUDENT INFO -->

<div class="bg-white p-6 rounded-xl shadow mb-8">

<h3 class="text-lg font-semibold">
<?php echo $student['name']; ?>
</h3>

<p class="text-gray-500">
<?php echo $student['department_name']; ?> • Semester <?php echo $student['semester']; ?>
</p>

</div>



<!-- FILTER -->

<div class="bg-white p-6 rounded-xl shadow mb-8">

<form method="GET" class="grid grid-cols-3 gap-4">

<select name="subject_id" class="border p-2 rounded">

<option value="">All Subjects</option>

<?php while($s=mysqli_fetch_assoc($subjects)){ ?>

<option value="<?php echo $s['subject_id']; ?>">
<?php echo $s['subject_name']; ?>
</option>

<?php } ?>

</select>


<select name="month" class="border p-2 rounded">

<option value="">All Months</option>

<option value="1">January</option>
<option value="2">February</option>
<option value="3">March</option>
<option value="4">April</option>
<option value="5">May</option>
<option value="6">June</option>
<option value="7">July</option>
<option value="8">August</option>
<option value="9">September</option>
<option value="10">October</option>
<option value="11">November</option>
<option value="12">December</option>

</select>


<button class="bg-indigo-600 text-white px-4 py-2 rounded">
Filter
</button>

</form>

</div>



<!-- TABLE -->

<div class="bg-white p-6 rounded-xl shadow">

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

<?php if(mysqli_num_rows($result)>0){ ?>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr class="border-b hover:bg-gray-50">

<td class="py-2">
<?php echo $row['date']; ?>
</td>

<td>
<?php echo $row['subject_name']; ?>
</td>

<td>
<?php echo $row['period']; ?>
</td>

<td>

<?php if($row['status']=="Present"){ ?>

<span class="text-green-600 font-semibold">
Present
</span>

<?php } else { ?>

<span class="text-red-500 font-semibold">
Absent
</span>

<?php } ?>

</td>

</tr>

<?php } ?>

<?php }else{ ?>

<tr>

<td colspan="4" class="text-center py-6 text-gray-400">
No attendance records found
</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>


<?php include "layout/footer.php"; ?>