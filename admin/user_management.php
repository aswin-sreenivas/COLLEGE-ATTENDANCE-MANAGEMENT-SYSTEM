<?php
session_start();
include "../config/db.php";


/* DELETE USER */

if(isset($_GET['delete'])){

$id = $_GET['delete'];

mysqli_query($conn,"DELETE FROM users WHERE id='$id'");

header("Location: user_management.php");
exit;

}


/* FETCH USERS */

$result = mysqli_query($conn,"
SELECT * FROM users
ORDER BY id DESC
");

?>


<!DOCTYPE html>
<html>

<head>

<title>User Management</title>

<script src="https://cdn.tailwindcss.com"></script>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

<style>

body{
font-family:'Inter',sans-serif;
background:#f6f8fc;
}

.main{
margin-left:250px;
padding:30px;
}

.card{
transition:0.3s;
}

.card:hover{
transform:translateY(-5px);
}

</style>

</head>

<body>


<!-- SIDEBAR -->

<?php include "layout/sidebar.php"; ?>


<!-- MAIN -->

<div class="main">

<h2 class="text-2xl font-semibold mb-6">
User Management
</h2>



<div class="bg-white p-6 rounded-xl shadow card">

<h3 class="font-semibold mb-4">
System Users
</h3>


<!-- SEARCH BAR -->

<div class="mb-4 relative">

<input 
type="text" 
id="search"
placeholder="Search by name or email..."
class="border p-2 rounded w-full"
autocomplete="off"
>

<div 
id="suggestions"
class="absolute bg-white border w-full rounded shadow mt-1 hidden max-h-60 overflow-y-auto z-50">
</div>

</div>


<table class="w-full text-sm">

<thead class="border-b text-gray-500">

<tr>

<th class="py-2 text-left">ID</th>
<th>Name</th>
<th>Email</th>
<th>Role</th>
<th>Action</th>

</tr>

</thead>

<tbody>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<tr class="border-b hover:bg-gray-50 user-row">

<td class="py-2">
<?php echo $row['id']; ?>
</td>

<td class="user-name">
<?php echo $row['name']; ?>
</td>

<td class="user-email">
<?php echo $row['email']; ?>
</td>

<td class="capitalize">
<?php echo $row['role']; ?>
</td>

<td>

<a
href="?delete=<?php echo $row['id']; ?>"
class="text-red-500 hover:underline"
onclick="return confirm('Delete this user?')">
Delete
</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>


</div>


<!-- SEARCH SCRIPT -->

<script>

const search = document.getElementById("search");
const rows = document.querySelectorAll(".user-row");
const suggestions = document.getElementById("suggestions");

search.addEventListener("keyup", function(){

let value = this.value.toLowerCase();

suggestions.innerHTML = "";

rows.forEach(row => {

let name = row.querySelector(".user-name").innerText.toLowerCase();
let email = row.querySelector(".user-email").innerText.toLowerCase();

if(name.includes(value) || email.includes(value)){

row.style.display = "";

if(value !== ""){

let div = document.createElement("div");

div.className = "p-2 hover:bg-gray-100 cursor-pointer";

div.innerText =
row.querySelector(".user-name").innerText
+ " (" +
row.querySelector(".user-email").innerText
+ ")";

div.onclick = function(){

search.value =
row.querySelector(".user-name").innerText;

suggestions.classList.add("hidden");

};

suggestions.appendChild(div);

}

}else{

row.style.display = "none";

}

});

if(value === ""){
suggestions.classList.add("hidden");

rows.forEach(row => {
row.style.display = "";
});

}else{

if(suggestions.innerHTML !== ""){
suggestions.classList.remove("hidden");
}else{
suggestions.classList.add("hidden");
}

}

});


document.addEventListener("click", function(e){

if(!search.contains(e.target) &&
!suggestions.contains(e.target)){

suggestions.classList.add("hidden");

}

});

</script>

</body>
</html>