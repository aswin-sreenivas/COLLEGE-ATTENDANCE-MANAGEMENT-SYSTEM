<?php
session_start();
include "../config/db.php";

$page_title="Class Statistics";
include "layout/layout.php";

$faculty_id = 1;

$subject = $_GET['subject_id'] ?? "";
?>


<h2 class="text-2xl font-semibold mb-8">
Class Attendance Statistics
</h2>


<!-- FILTER -->

<div class="bg-white p-6 rounded-xl shadow card mb-8">

<form method="GET" class="grid grid-cols-2 gap-4">

<select name="subject_id" class="border p-2 rounded">

<option value="">Select Subject</option>

<?php

$subjects=mysqli_query($conn,"
SELECT subjects.*
FROM subjects
JOIN faculty_subjects
ON subjects.subject_id = faculty_subjects.subject_id
WHERE faculty_subjects.faculty_id='$faculty_id'
");

while($s=mysqli_fetch_assoc($subjects)){

echo "<option value='".$s['subject_id']."'>".$s['subject_name']."</option>";

}

?>

</select>


<button class="bg-indigo-600 text-white px-4 py-2 rounded">
Load Statistics
</button>

</form>

</div>


<?php

$labels=[];
$data=[];

if($subject!=""){

$result=mysqli_query($conn,"
SELECT students.name,
COUNT(attendance.attendance_id) AS total,
SUM(CASE WHEN attendance.status='Present' THEN 1 ELSE 0 END) AS present
FROM attendance
JOIN students
ON attendance.student_id = students.student_id
WHERE attendance.subject_id='$subject'
GROUP BY students.student_id
");

?>

<div class="bg-white p-6 rounded-xl shadow card mb-8">

<table class="w-full text-sm">

<thead class="border-b text-gray-500">

<tr>

<th class="py-2 text-left">Student</th>
<th>Total Classes</th>
<th>Present</th>
<th>Attendance %</th>

</tr>

</thead>

<tbody>

<?php while($row=mysqli_fetch_assoc($result)){

$total=$row['total'];
$present=$row['present'];

$percentage=0;

if($total>0){
$percentage=round(($present/$total)*100,2);
}

$labels[]=$row['name'];
$data[]=$percentage;

?>

<tr class="border-b hover:bg-gray-50">

<td class="py-2">
<?php echo $row['name']; ?>
</td>

<td>
<?php echo $total; ?>
</td>

<td>
<?php echo $present; ?>
</td>

<td>

<?php if($percentage<75){ ?>

<span class="text-red-500 font-semibold">
<?php echo $percentage; ?>%
</span>

<?php } else { ?>

<span class="text-green-600 font-semibold">
<?php echo $percentage; ?>%
</span>

<?php } ?>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>


<!-- CHART -->

<div class="bg-white p-6 rounded-xl shadow card">

<h3 class="text-lg font-semibold mb-4">
Attendance Percentage Chart
</h3>

<canvas id="chart"></canvas>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx=document.getElementById("chart");

new Chart(ctx,{

type:'bar',

data:{

labels: <?php echo json_encode($labels); ?>,

datasets:[{

label:'Attendance %',

data: <?php echo json_encode($data); ?>,

backgroundColor:'#6366f1'

}]

},

options:{

scales:{
y:{
beginAtZero:true,
max:100
}
}

}

});

</script>

<?php } ?>


<?php include "layout/footer.php"; ?>