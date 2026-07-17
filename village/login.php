<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "myvillage";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $user, $pass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $_SESSION['username'] = $user;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid username or password!";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
<title>Login - 🌿 e-GramSetu</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>

body{
    background-color:#f8f9fa;
}

/* HEADER */
header{
    background:#198754;
}

/* NAVBAR */
.custom-navbar{
    background:linear-gradient(45deg,#198754,#157347);
    margin-top:10px;
}

.custom-navbar .nav-link{
    color:#fff !important;
    margin:0 6px;
    padding:8px 14px;
    border-radius:20px;
    transition:0.3s;
    font-weight:500;
}

.custom-navbar .nav-link:hover{
    background-color:rgba(255,255,255,0.25);
    transform:translateY(-2px);
}

.custom-navbar .nav-link.active{
    background:#fff;
    color:#198754 !important;
    font-weight:600;
}

/* FOOTER FIX */
footer{
    background:#f8f9fa;
}

.footer-box{
    background:#198754;
    color:white;
    max-width:1100px;
    margin:auto;
    border-radius:10px;
}

.footer-box a{
    color:white;
    text-decoration:none;
}

.footer-box a:hover{
    text-decoration:underline;
}

</style>
</head>

<body>

<!-- HEADER -->
<header class="py-3">
<div class="container">
<a href="dashboard.php" class="text-white fw-bold fs-3 text-decoration-none">
🌿 E-GRAMSETU
</a>
</div>
</header>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark shadow custom-navbar">
<div class="container">

<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="mainNavbar">
<ul class="navbar-nav ms-auto align-items-lg-center">

<li class="nav-item">
<a class="nav-link" href="dashboard.php">
<i class="bi bi-house-door"></i> Home
</a>
</li>

<li class="nav-item">
<a class="nav-link active" href="login.php">
<i class="bi bi-box-arrow-in-right"></i> Login
</a>
</li>

<li class="nav-item">
<a class="nav-link" href="add_villager.php">
<i class="bi bi-person-plus"></i> Add Villagers
</a>
</li>

<li class="nav-item">
<a class="nav-link" href="display_villagers.php">
<i class="bi bi-people"></i> Show Villagers
</a>
</li>

<li class="nav-item">
<a class="nav-link" href="add_schemes.php">
<i class="bi bi-file-earmark-plus"></i> Add Schemes
</a>
</li>

<li class="nav-item">
<a class="nav-link" href="display_schemes.php">
<i class="bi bi-file-text"></i> Show Schemes
</a>
</li>

<li class="nav-item">
<a class="nav-link" href="display_complaints.php">
<i class="bi bi-chat-square-text"></i> Show Complaints
</a>
</li>

<li class="nav-item">
<a class="nav-link" href="registartion.php">
<i class="bi bi-person-badge"></i> Registration
</a>
</li>

</ul>
</div>
</div>
</nav>

<!-- LOGIN FORM -->
<div class="container mt-5">
<div class="row justify-content-center">
<div class="col-md-4">

<div class="card shadow p-4">

<h3 class="text-center mb-4">Login</h3>

<?php if(!empty($error)) : ?>
<div class="alert alert-danger">
<?php echo $error; ?>
</div>
<?php endif; ?>

<form method="POST">

<div class="mb-3">
<label class="form-label">Username</label>
<input type="text" name="username" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">Password</label>
<input type="password" name="password" class="form-control" required>
</div>

<button type="submit" class="btn btn-success w-100">
Login
</button>

</form>

</div>
</div>
</div>
</div>

<!-- FOOTER -->
<footer class="mt-5">

<div class="container footer-box py-4">

<div class="row text-center text-md-start">

<div class="col-md-4">
<h5>About e-GramSetu</h5>
<p>Digital platform for managing villagers, schemes and complaints efficiently.</p>
</div>

<div class="col-md-4">
<h5>Quick Links</h5>
<ul class="list-unstyled">
<li><a href="#">Home</a></li>
<li><a href="add_villager.php">Add Villagers</a></li>
<li><a href="add_scheme.php">Add Schemes</a></li>
<li><a href="add_complaints.php">Add Complaints</a></li>
<li><a href="registartion.php">Registration</a></li>
</ul>
</div>

<div class="col-md-4">
<h5>Contact</h5>
<p>
Gram Panchayat Office<br>
Talavda, India<br>
Email: info@egramsetu.in
</p>
</div>

</div>

<hr class="bg-light">

<div class="text-center">
© 2026 e-GramSetu | All Rights Reserved
</div>

</div>

</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>