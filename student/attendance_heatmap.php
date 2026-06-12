<?php
session_start();
include "../config/db.php";

$page_title="Attendance Heatmap";
include "layout/layout.php";

/* TEMP LOGIN */
$user_id = $_SESSION['user_id'];


/* GET STUDENT ID */

$student = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT student_id
FROM students
WHERE user_id='$user_id'
"));

$student_id = $student['student_id'];

/* GET ATTENDANCE */

$result = mysqli_query($conn,"
SELECT date,status
FROM attendance
WHERE student_id='$student_id'
ORDER BY date DESC
LIMIT 90
");

$data=[];

while($row=mysqli_fetch_assoc($result)){
$data[$row['date']]=$row['status'];
}

?>

<h2 class="text-2xl font-semibold mb-8">
Attendance Heatmap
</h2>

<div class="bg-white p-6 rounded-xl shadow">

<div class="grid grid-cols-15 gap-2">

<?php

for($i=0;$i<90;$i++){

$date=date("Y-m-d",strtotime("-$i days"));

$status=$data[$date] ?? "none";

if($status=="Present"){
$color="bg-green-500";
}
elseif($status=="Absent"){
$color="bg-red-500";
}
else{
$color="bg-gray-200";
}

echo "<div class='w-5 h-5 $color rounded'></div>";

}

?>

</div>

<div class="flex gap-4 mt-6 text-sm">

<div class="flex items-center gap-2">
<div class="w-4 h-4 bg-green-500 rounded"></div>
Present
</div>

<div class="flex items-center gap-2">
<div class="w-4 h-4 bg-red-500 rounded"></div>
Absent
</div>

<div class="flex items-center gap-2">
<div class="w-4 h-4 bg-gray-200 rounded"></div>
No Class
</div>

</div>

</div>

<?php include "layout/footer.php"; ?>