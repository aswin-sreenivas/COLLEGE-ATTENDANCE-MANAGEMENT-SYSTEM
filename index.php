<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>CAMS - College Attendance Management System</title>

<script src="https://cdn.tailwindcss.com"></script>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css"/>

<style>

body{
font-family:'Inter',sans-serif;
background:#f4f7fb;
}

/* DARK BLUE THEME */

.primary{
background:linear-gradient(135deg,#0f2a44,#1e40af);
}

.text-primary{
color:#1e40af;
}

/* FLOATING IMAGE */

.float{
animation:float 4s ease-in-out infinite;
}

@keyframes float{

0%{transform:translateY(0px);}
50%{transform:translateY(-15px);}
100%{transform:translateY(0px);}

}

/* PARTICLE BACKGROUND */

#particles-js{
position:absolute;
width:100%;
height:100%;
top:0;
left:0;
z-index:-1;
}

/* CARD HOVER */

.card:hover{
transform:translateY(-10px);
box-shadow:0 15px 30px rgba(0,0,0,0.1);
}

/* SMOOTH SCROLL */

html{
scroll-behavior:smooth;
}

/* SOFT BACKGROUND ANIMATION */

.bg-animate{
position:fixed;
width:100%;
height:100%;
top:0;
left:0;
z-index:-2;
background:
radial-gradient(circle at 20% 30%,rgba(30,64,175,0.08),transparent 40%),
radial-gradient(circle at 80% 70%,rgba(15,42,68,0.08),transparent 40%);
animation:bgmove 12s infinite alternate ease-in-out;
}

@keyframes bgmove{
0%{transform:translate(0,0)}
100%{transform:translate(-60px,40px)}
}

</style>

</head>

<body>

<div class="bg-animate"></div>


<!-- NAVBAR -->

<nav class="flex justify-between items-center px-12 py-5 bg-white shadow-sm">

<div class="flex items-center space-x-3">

<div class="w-10 h-10 primary rounded-lg flex items-center justify-center text-white font-bold">
🎓
</div>

<h1 class="text-xl font-bold text-primary">CAMS</h1>

</div>

<div class="space-x-8 text-gray-600 font-medium hidden md:block">

<a href="#about" class="hover:text-primary">About</a>
<a href="#features" class="hover:text-primary">Features</a>
<a href="#contact" class="hover:text-primary">Contact</a>

</div>

<div class="space-x-4">

<a href="login.php" class="text-gray-700">Sign In</a>

<a href="register.php" class="primary text-white px-5 py-2 rounded-lg shadow hover:scale-105 transition">
Get Started
</a>

</div>

</nav>


<!-- HERO -->

<section class="relative text-center py-28 overflow-hidden">

<div id="particles-js"></div>

<p class="text-blue-600 font-semibold mb-4" data-aos="fade-down">
Government Polytechnic College Mananthavady
</p>

<h1 class="text-5xl md:text-6xl font-extrabold text-gray-900 leading-tight" data-aos="zoom-in">

College Attendance <br>

<span class="text-primary">
Management System
</span>

</h1>

<p class="mt-6 text-gray-600 text-lg max-w-xl mx-auto" data-aos="fade-up">

Developed as a <b>Major Academic Project</b> under the Computer Engineering
Department curriculum to digitize attendance management,
automate reports and provide real-time academic analytics.

</p>

<div class="mt-10 flex justify-center gap-6" data-aos="fade-up">

<a href="login.php" class="primary text-white px-8 py-4 rounded-xl shadow-lg hover:scale-105 transition">
Get Started Now →
</a>

<a href="#features" class="border px-8 py-4 rounded-xl hover:bg-gray-100">
View Features
</a>

</div>

</section>



<!-- ABOUT -->

<section id="about" class="grid md:grid-cols-2 gap-16 items-center px-12 py-24 bg-white">

<div data-aos="fade-right">

<h2 class="text-4xl font-bold mb-6">
Transforming Education with Digital Precision
</h2>

<p class="text-gray-600 mb-6">

CAMS was developed as a <b>Major Academic Project</b> by the Computer Engineering
Department of Government Polytechnic College Mananthavady as part of the
academic curriculum. The system demonstrates how digital technologies
can replace traditional attendance registers with automated attendance
tracking and real-time monitoring.

</p>

<ul class="space-y-4 text-gray-700">

<li>✔ 100% Paperless Attendance</li>
<li>✔ Instant Email Alerts to Parents</li>
<li>✔ Real-Time Attendance Reports</li>
<li>✔ Secure Role-Based Login</li>

</ul>

</div>


<!-- COLLEGE IMAGE -->

<img src="images/college.jpg"
class="rounded-xl shadow-xl float w-full object-cover h-[380px]"
data-aos="fade-left">


</section>



<!-- STATISTICS -->

<section class="primary text-white py-20">

<div class="grid md:grid-cols-4 text-center gap-10">

<div data-aos="zoom-in">
<h1 class="text-5xl font-bold counter" data-target="360">0</h1>
<p>Total Students</p>
</div>

<div data-aos="zoom-in">
<h1 class="text-5xl font-bold counter" data-target="24">0</h1>
<p>Faculty Members</p>
</div>

<div data-aos="zoom-in">
<h1 class="text-5xl font-bold counter" data-target="45000">0</h1>
<p>Attendance Records</p>
</div>

<div data-aos="zoom-in">
<h1 class="text-5xl font-bold counter" data-target="3">0</h1>
<p>Departments</p>
</div>

</div>

</section>



<!-- FEATURES -->

<section id="features" class="py-24 px-12">

<h2 class="text-4xl font-bold text-center mb-12">
Smart Features for Modern Colleges
</h2>

<div class="grid md:grid-cols-3 gap-10">


<div class="bg-white p-8 rounded-xl shadow-lg card transition" data-aos="fade-up">
<h3 class="font-semibold text-lg mb-3">Smart Attendance Tracking</h3>
<p class="text-gray-600">
Faculty can record attendance instantly using a simple digital interface.
</p>
</div>


<div class="bg-white p-8 rounded-xl shadow-lg card transition" data-aos="fade-up">
<h3 class="font-semibold text-lg mb-3">Automated Reports</h3>
<p class="text-gray-600">
Generate daily, weekly, and monthly attendance reports automatically.
</p>
</div>


<div class="bg-white p-8 rounded-xl shadow-lg card transition" data-aos="fade-up">
<h3 class="font-semibold text-lg mb-3">Student Dashboard</h3>
<p class="text-gray-600">
Students can monitor their attendance percentage and history.
</p>
</div>


<div class="bg-white p-8 rounded-xl shadow-lg card transition" data-aos="fade-up">
<h3 class="font-semibold text-lg mb-3">Parent Monitoring</h3>
<p class="text-gray-600">
Parents can track their child’s attendance and receive alerts.
</p>
</div>


<div class="bg-white p-8 rounded-xl shadow-lg card transition" data-aos="fade-up">
<h3 class="font-semibold text-lg mb-3">Faculty Tools</h3>
<p class="text-gray-600">
Manage subjects, classes, and attendance records efficiently.
</p>
</div>


<div class="bg-white p-8 rounded-xl shadow-lg card transition" data-aos="fade-up">
<h3 class="font-semibold text-lg mb-3">Real-Time Analytics</h3>
<p class="text-gray-600">
Interactive dashboards showing attendance trends and insights.
</p>
</div>

</div>

</section>



<!-- FOOTER -->

<footer class="bg-[#0f2a44] text-gray-300 py-16 px-12">

<div class="grid md:grid-cols-4 gap-10">

<div>

<h3 class="text-white text-xl font-bold mb-4">
CAMS
</h3>

<p class="text-gray-400">
CAMS is a Major Academic Project developed under the Computer Engineering
Department curriculum at Government Polytechnic College Mananthavady.
</p>

</div>

<div>
<h4 class="text-white font-semibold mb-4">Platform</h4>
<p>Admin Portal</p>
<p>Faculty Tools</p>
<p>Student Dashboard</p>
</div>

<div>
<h4 class="text-white font-semibold mb-4">Department</h4>
<p>Computer Engineering</p>
<p>Govt Polytechnic Mananthavady</p>
</div>

<div>
<h4 class="text-white font-semibold mb-4">Connect</h4>
<p>Email</p>
<p>Website</p>
</div>

</div>

</footer>



<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

<script>
AOS.init({
duration:1000,
once:true
});
</script>


<script src="https://cdn.jsdelivr.net/npm/particles.js"></script>

<script>

particlesJS("particles-js",{
particles:{
number:{value:60},
size:{value:3},
move:{speed:2},
line_linked:{enable:true}
}
});

</script>


<script>

/* COUNTER ANIMATION */

const counters=document.querySelectorAll(".counter")

counters.forEach(counter=>{

const update=()=>{

const target=+counter.getAttribute("data-target")
const count=+counter.innerText
const speed=target/200

if(count < target){

counter.innerText=Math.ceil(count+speed)
setTimeout(update,20)

}

else{

counter.innerText=target

}

}

update()

})

</script>

</body>
</html>