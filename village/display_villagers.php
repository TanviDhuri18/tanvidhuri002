<?php
include 'config/db.php';
include 'includes/header.php';

?>

<!DOCTYPE html>
<html>
<head>
  <title>Dashboard | 🌿 e-GramSetu</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background-color: #f8f9fa;
    }

    /* Top Title */
    .top-title {
      background: #198754;
      color: white;
      padding: 15px;
      text-align: center;
      font-size: 24px;
      font-weight: bold;
    }

    /* Navbar */
    .custom-navbar {
      background: linear-gradient(45deg, #157347, #198754);
      margin-top: 8px; /* 👈 little gap below title */
    }

    .custom-navbar .nav-link {
      color: #fff !important;
      margin: 0 6px;
      padding: 8px 14px;
      border-radius: 20px;
      transition: 0.3s ease;
      font-weight: 500;
    }

    .custom-navbar .nav-link:hover {
      background-color: rgba(255, 255, 255, 0.25);
    }

    .custom-navbar .nav-link.active {
      background-color: #fff;
      color: #198754 !important;
      font-weight: 600;
    }

    .table-container {
      margin-top: 30px;
    }
  </style>
</head>

<body>

  <!-- Custom CSS -->
  <style>
    body {
      background-color: #f8f9fa;
    }

    /* Navbar Styling */
    .navbar {
      background: linear-gradient(90deg, #198754, #0d6efd);
    }

    .navbar-brand {
      font-size: 22px;
      letter-spacing: 1px;
    }

    .navbar-nav .nav-link {
      position: relative;
      transition: 0.3s;
      font-weight: 500;
    }

    .navbar-nav .nav-link:hover {
      color: #ffd700 !important;
    }

    .navbar-nav .nav-link::after {
      content: "";
      position: absolute;
      width: 0;
      height: 2px;
      background: #ffd700;
      left: 0;
      bottom: 0;
      transition: width 0.3s;
    }

    .navbar-nav .nav-link:hover::after {
      width: 100%;
    }

    /* Carousel */
    .carousel img {
      height: 400px;
      object-fit: cover;
      border-radius: 10px;
    }

    /* Footer */
    footer {
      background: #198754;
      color: white;
    }

    footer a {
      color: #ddd;
      text-decoration: none;
    }

    footer a:hover {
      color: #ffd700;
    }
  </style>
</head>

<body><!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

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

<!-- Attractive Navbar -->
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
          <a class="nav-link" href="add_villager.php"><i class="bi bi-person-plus"></i> Add Villagers</a>
        </li>


        <li class="nav-item">
          <a class="nav-link" href="add_scheme1.php"><i class="bi bi-file-earmark-plus"></i> Add Schemes</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="display_schemes.php"><i class="bi bi-file-text"></i> Show Schemes</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="add_complaint.php"><i class="bi bi-people"></i> Add complaints</a>
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
<!-- Page Content -->
<div class="container table-container">
  <h2 class="mb-4">Villagers List</h2>

  <table class="table table-bordered table-striped shadow-sm">
    <thead class="table-success">
      <tr>
        <th>Name</th>
        <th>Age</th>
        <th>Occupation</th>
        <th>Address</th>
      </tr>
    </thead>
    <tbody>

    <?php
    $result = $conn->query("SELECT * FROM villagers");
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['age']}</td>
                <td>{$row['occupation']}</td>
                <td>{$row['address']}</td>
              </tr>";
    }
    ?>

    </tbody>
  </table>
</div>

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

  
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>