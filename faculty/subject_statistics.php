<?php
session_start();
include "../config/db.php";

$page_title="Subject Statistics";
include "layout/layout.php";

$faculty_id = 1;

$subject = $_GET['subject_id'] ?? "";

?>

<h2 class="text-2xl font-semibold mb-8">
Subject Attendance Analytics
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
Load Analytics
</button>

</form>

</div>


<?php

$dates=[];
$attendance_percent=[];

if($subject!=""){

$result=mysqli_query($conn,"
SELECT date,
COUNT(attendance_id) AS total,
SUM(CASE WHEN status='Present' THEN 1 ELSE 0 END) AS present
FROM attendance
WHERE subject_id='$subject'
GROUP BY date
ORDER BY date
");

?>

<div class="bg-white p-6 rounded-xl shadow card mb-8">

<table class="w-full text-sm">

<thead class="border-b text-gray-500">

<tr>
<th class="py-2 text-left">Date</th>
<th>Total Records</th>
<th>Present</th>
<th>Attendance %</th>
</tr>

</thead>

<tbody>

<?php while($row=mysqli_fetch_assoc($result)){

$total=$row['total'];
$present=$row['present'];

$percent=0;

if($total>0){
$percent=round(($present/$total)*100,2);
}

$dates[]=$row['date'];
$attendance_percent[]=$percent;

?>

<tr class="border-b hover:bg-gray-50">

<td class="py-2">
<?php echo $row['date']; ?>
</td>

<td>
<?php echo $total; ?>
</td>

<td>
<?php echo $present; ?>
</td>

<td>

<?php if($percent<75){ ?>

<span class="text-red-500 font-semibold">
<?php echo $percent; ?>%
</span>

<?php } else { ?>

<span class="text-green-600 font-semibold">
<?php echo $percent; ?>%
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
Attendance Trend
</h3>

<canvas id="chart"></canvas>

</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx=document.getElementById("chart");

new Chart(ctx,{

type:'line',

data:{

labels: <?php echo json_encode($dates); ?>,

datasets:[{

label:'Attendance %',

data: <?php echo json_encode($attendance_percent); ?>,

borderColor:'#6366f1',
backgroundColor:'rgba(99,102,241,0.2)',
fill:true,
tension:0.4

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