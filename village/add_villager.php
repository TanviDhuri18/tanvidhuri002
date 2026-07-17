<?php
include 'config/db.php';
include 'includes/header.php';

$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get form data safely
    $name = $_POST['name'] ?? '';
    $village = $_POST['village_name'] ?? ''; // FIXED HERE
    $occupation = $_POST['occupation'] ?? '';
    $address = $_POST['address'] ?? '';

    // Insert into database
    $sql = "INSERT INTO villagers (name, village, occupation, address) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Check SQL error
    if ($stmt === false) {
        die("SQL Error: " . $conn->error);
    }

    $stmt->bind_param("ssss", $name, $village, $occupation, $address);
    $stmt->execute();

    $success = "Villager added successfully!";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Villager | 🌿 e-GramSetu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #f8f9fa, #e9f5ec);
            min-height: 100vh;
        }

        /* Card */
        .form-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .form-card .card-header {
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            font-size: 20px;
            font-weight: 600;
        }

        .form-control {
            border-radius: 12px;
            padding: 10px;
        }

        .btn-success {
            border-radius: 12px;
            padding: 10px;
            font-weight: 600;
        }

        .footer {
            background: #198754;
            color: white;
            text-align: center;
            padding: 15px;
            margin-top: 60px;
        }
        footer {
      background: #198754;
      color: white;
        }

    </style>
</head>

<body>

<style>
  .custom-navbar {
      background: linear-gradient(45deg, #198754, #157347);
  }

  .custom-navbar .nav-link {
      color: #ffffff !important;
      margin: 0 6px;
      padding: 8px 14px;
      border-radius: 20px;
      transition: 0.3s ease;
      font-weight: 500;
  }

  .custom-navbar .nav-link:hover {
      background-color: rgba(255, 255, 255, 0.25);
      transform: translateY(-2px);
  }

  .custom-navbar .nav-link.active {
      background-color: #ffffff;
      color: #198754 !important;
      font-weight: 600;
  }

  .navbar-brand {
      letter-spacing: 1px;
      font-size: 22px;
  }
</style>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark shadow sticky-top custom-navbar">
  <div class="container">

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNavbar">
      <ul class="navbar-nav ms-auto align-items-lg-center">

        <li class="nav-item">
          <a class="nav-link active" href="dashboard.php"><i class="bi bi-house-door"></i> Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="login.php"><i class="bi bi-box-arrow-in-right"></i> Login</a>
        </li>

        

        <li class="nav-item">
          <a class="nav-link" href="display_villagers.php"><i class="bi bi-people"></i> Show Villagers</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="add_scheme1.php"><i class="bi bi-file-earmark-plus"></i> Add Schemes</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="display_schemes.php"><i class="bi bi-file-text"></i> Show Schemes</a>
        </li>

        

        <li class="nav-item">
          <a class="nav-link" href="display_complaints.php"><i class="bi bi-chat-square-text"></i> Show Complaints</a>
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

<!-- Form Section -->
<div class="container d-flex justify-content-center align-items-center mt-5">
    <div class="col-md-6 col-lg-5">

        <div class="card form-card">
            <div class="card-header bg-success text-white text-center">
                Add New Villager
            </div>

            <div class="card-body p-4">

                <?php if(!empty($success)) { ?>
                    <div class="alert alert-success text-center">
                        <?php echo $success; ?>
                    </div>
                <?php } ?>

                <form method="post">

                    <div class="mb-3">
                        <input class="form-control" name="name" placeholder="Full Name" required>
                    </div>

                    <!-- Village Dropdown -->
                     <div class="mb-3">
                            <select name="village_name" class="form-select" required>                                <option value="">Select Village</option>
                                <option>Malewad</option>
                                <option>Banda</option>
                                <option>Redi</option>
                                <option>Asoli</option>
                                <option>Narur</option>
                            </select>
                        </div>

                    <div class="mb-3">
                        <input class="form-control" name="occupation" placeholder="Occupation" required>
                    </div>

                    <div class="mb-3">
                        <textarea class="form-control" name="address" rows="3" placeholder="Address" required></textarea>
                    </div>

                    <button class="btn btn-success w-100">
                        <i class="bi bi-check-circle"></i> Add Villager
                    </button>

                </form>
            </div>
        </div>

    </div>
</div>

<!-- Footer -->
<footer class="mt-5">
    <div class="container py-4">
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
            <li><a href="registartion.php">registration </a></li>

          </ul>
        </div>

        <div class="col-md-4">
          <h5>Contact</h5>
          <p>Gram Panchayat Office<br>Talavda, India<br>Email: info@egramsetu.in</p>
        </div>

      </div>

      <hr class="bg-light">

      <div class="text-center">
        © 2026 e-GramSetu | All Rights Reserved
      </div>
    </div>
  </footer>

  

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>