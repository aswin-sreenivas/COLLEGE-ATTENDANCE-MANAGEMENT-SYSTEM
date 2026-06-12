<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>CAMS Login</title>

<script src="https://cdn.tailwindcss.com"></script>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

body{
font-family:'Poppins',sans-serif;
background:#ffffff;
overflow:hidden;
}

/* animated background blobs */

.blob{
position:absolute;
border-radius:50%;
filter:blur(80px);
opacity:0.15;
animation:move 20s infinite alternate;
}

.blob1{
width:300px;
height:300px;
background:#6366f1;
top:-50px;
left:-50px;
}

.blob2{
width:350px;
height:350px;
background:#3b82f6;
bottom:-100px;
right:-100px;
animation-delay:5s;
}

@keyframes move{
0%{transform:translate(0,0)}
100%{transform:translate(100px,60px)}
}

/* animated grid */

.grid-bg{
background-image:
linear-gradient(rgba(0,0,0,0.05) 1px, transparent 1px),
linear-gradient(90deg, rgba(0,0,0,0.05) 1px, transparent 1px);
background-size:40px 40px;
position:absolute;
width:100%;
height:100%;
opacity:0.3;
}

/* glass card */

.card{
background:rgba(255,255,255,0.9);
backdrop-filter:blur(12px);
}

/* input focus */

input:focus{
outline:none;
border-color:#6366f1;
box-shadow:0 0 10px rgba(99,102,241,0.3);
}

/* button hover */

.btn-main{
background:linear-gradient(135deg,#6366f1,#4f46e5);
transition:0.3s;
}

.btn-main:hover{
transform:translateY(-2px);
box-shadow:0 6px 15px rgba(99,102,241,0.3);
}

/* demo buttons */

.demo{
transition:0.3s;
}

.demo:hover{
transform:translateY(-3px);
box-shadow:0 6px 12px rgba(0,0,0,0.15);
}

/* error */

.error{
background:#fee2e2;
color:#dc2626;
padding:12px;
border-radius:10px;
margin-bottom:15px;
text-align:center;
font-size:14px;
}

</style>

</head>

<body class="flex items-center justify-center min-h-screen relative">

<div class="grid-bg"></div>

<div class="blob blob1"></div>
<div class="blob blob2"></div>

<!-- LOGIN CARD -->

<div class="card p-10 rounded-xl shadow-xl w-[420px] relative z-10">

<!-- LOGO -->

<div class="flex items-center justify-center gap-3 mb-6">

<div class="bg-indigo-600 text-white w-10 h-10 flex items-center justify-center rounded-lg">
🎓
</div>

<h1 class="text-2xl font-bold text-indigo-600">CAMS</h1>

</div>

<h2 class="text-xl font-semibold text-center mb-2">
Welcome Back
</h2>

<p class="text-center text-gray-500 mb-6 text-sm">
Sign in to your account or use a demo login
</p>

<!-- ERROR MESSAGE -->

<?php if(isset($_SESSION['error'])){ ?>

<div class="error">
<?php 
echo $_SESSION['error']; 
unset($_SESSION['error']);
?>
</div>

<?php } ?>

<!-- LOGIN FORM -->

<form action="auth.php" method="POST" class="space-y-4">

<div>

<label class="text-sm font-medium">Email</label>

<input
type="email"
name="email"
placeholder="name@college.edu"
class="w-full p-3 border rounded-lg mt-1"
required
/>

</div>

<div>

<div class="flex justify-between text-sm">

<label class="font-medium">Password</label>

<a href="forgot.php" class="text-indigo-500 hover:underline">
Forgot password?
</a>

</div>

<input
type="password"
name="password"
placeholder="Enter password"
class="w-full p-3 border rounded-lg mt-1"
required
/>

</div>

<button class="btn-main w-full text-white py-3 rounded-lg mt-2 font-medium">
Sign In
</button>

</form>

<!-- DIVIDER -->

<div class="text-center text-gray-500 my-6 text-sm">
Or quick demo login
</div>

<!-- DEMO BUTTONS -->

<div class="grid grid-cols-2 gap-3">

<button
onclick="demoLogin('admin@gptc.com')"
class="demo border py-2 rounded-lg text-blue-600 font-medium">

Admin

</button>

<button
onclick="demoLogin('hod@gptc.com')"
class="demo border py-2 rounded-lg text-pink-600 font-medium">

HOD

</button>

<button
onclick="demoLogin('faculty@gptc.com')"
class="demo border py-2 rounded-lg text-green-600 font-medium">

Faculty

</button>

<button
onclick="demoLogin('student@gptc.com')"
class="demo border py-2 rounded-lg text-orange-600 font-medium">

Student

</button>

<button
onclick="demoLogin('parent@gptc.com')"
class="demo border py-2 rounded-lg text-purple-600 col-span-2 font-medium">

Parent

</button>

</div>

<p class="text-center text-gray-500 mt-6 text-sm">

Need an account?

<a href="register.php" class="text-indigo-600 hover:underline">
Register here
</a>

</p>

</div>

<script>

function demoLogin(email){

document.querySelector('input[name="email"]').value=email;

document.querySelector('input[name="password"]').value="1234";

}

</script>

</body>
</html>