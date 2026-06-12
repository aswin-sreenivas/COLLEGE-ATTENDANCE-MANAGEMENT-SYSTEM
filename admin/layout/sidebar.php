<style>

.sidebar{
width:250px;
height:100vh;
background:#0f172a;
position:fixed;
color:white;
padding:25px;
overflow-y:auto;
}

.menu{
padding:10px;
border-radius:8px;
display:block;
transition:0.25s;
color:#cbd5e1;
}

.menu:hover{
background:#1e293b;
color:white;
transform:translateX(6px);
}

</style>


<div class="sidebar">

<h1 class="text-xl font-bold mb-6">CAMS</h1>

<div class="space-y-2 text-sm">

<a href="dashboard.php" class="menu bg-indigo-600 text-white">
Dashboard
</a>


<!-- USER MANAGEMENT -->

<p class="text-gray-400 text-xs mt-4 mb-1">USER MANAGEMENT</p>

<a href="manage_students.php" class="menu">Manage Students</a>

<a href="manage_faculty.php" class="menu">Manage Faculty</a>

<a href="manage_parents.php" class="menu">Manage Parents</a>

<a href="user_management.php" class="menu">User Accounts</a>



<!-- ACADEMIC -->

<p class="text-gray-400 text-xs mt-4 mb-1">ACADEMIC</p>

<a href="manage_departments.php" class="menu">Departments</a>


<a href="manage_subjects.php" class="menu">Subjects</a>

<a href="assign_subjects.php" class="menu">Assign Subjects</a>

<a href="approve_condonation.php" class="block px-4 py-2 hover:bg-gray-100">
Condonation Requests
</a>



<!-- ATTENDANCE -->

<p class="text-gray-400 text-xs mt-4 mb-1">ATTENDANCE</p>

<a href="attendance_records.php" class="menu">Attendance Records</a>

<a href="attendance_reports.php" class="menu">Attendance Reports</a>


<!-- NOTIFICATIONS -->

<p class="text-gray-400 text-xs mt-4 mb-1">NOTIFICATIONS</p>

<a href="notifications.php" class="menu">Notifications</a>



<!-- SYSTEM -->

<p class="text-gray-400 text-xs mt-4 mb-1">SYSTEM</p>

<a href="settings.php" class="menu">System Settings</a>
<a href="approve_users.php" class="menu">Approve user</a>

<a href="../logout.php" class="menu text-red-400">Logout</a>

</div>

</div>