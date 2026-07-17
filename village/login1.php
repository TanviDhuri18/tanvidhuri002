<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "myvillage"; // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Start session
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // ✅ Define your SQL query
    $sql = "SELECT * FROM users WHERE username = ? AND password = ?";

    // Prepare and bind
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $user, $pass); // "ss" means both are strings
    $stmt->execute();

    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows === 1) {
        $_SESSION['username'] = $user;
        echo "Login successful!";
        header("Location: dashboard.php"); // uncomment this to redirect
    } else {
        echo "Invalid username or password.";
    }

    $stmt->close();
}

$conn->close();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Login - Village Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card p-4">
                <h3 class="text-center">Login</h3>
                <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
                <form method="post">
                    <div class="mb-3">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>



















<?php
include 'includes/header.php';
include 'config/db.php';

$sql = "SELECT c.id, v.name, c.complaint FROM complaints c JOIN villagers v ON c.villager_id = v.id";
$result = $conn->query($sql);

echo "<h2>Complaints</h2><table class='table'><tr><th>Villager</th><th>Complaint</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr><td>{$row['name']}</td><td>{$row['complaint']}</td></tr>";
}
echo "</table>";
include 'includes/footer.php';
?>

