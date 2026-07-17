<?php
include 'includes/header.php';
include 'config/db.php';

$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $scheme_id = $_POST['scheme_id'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];

    // File Upload Validation
    $file_name = $_FILES['document']['name'];
    $file_tmp = $_FILES['document']['tmp_name'];
    $file_type = $_FILES['document']['type'];
    $upload_folder = "uploads/";

    if ($file_type != "application/pdf") {
        echo "<div class='alert alert-danger'>Only PDF files are allowed!</div>";
    } else {

        if (!is_dir($upload_folder)) {
            mkdir($upload_folder, 0777, true);
        }

        $file_path = $upload_folder . time() . "_" . $file_name;
        move_uploaded_file($file_tmp, $file_path);

        $sql = "INSERT INTO scheme_registrations (scheme_id, full_name, email, mobile, document) 
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issss", $scheme_id, $full_name, $email, $mobile, $file_path);
        $stmt->execute();

        $success = "Registration Successful!";
    }
}
?>


<head>
  <title>Dashboard |         🌿 e-GramSetu</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->

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
          <a class="nav-link" href="display_villagers.php"><i class="bi bi-people"></i> Show Villagers</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="add_schemes.php"><i class="bi bi-file-earmark-plus"></i> Add Schemes</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="display_schemes.php"><i class="bi bi-file-text"></i> Show Schemes</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="add_complaint.php"><i class="bi bi-chat-dots"></i> Add Complaints</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="display_complaints.php"><i class="bi bi-chat-square-text"></i> Show Complaints</a>
        </li>

    

      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="card shadow-lg border-0">
                <div class="card-header bg-success text-white text-center">
                    <h4>Scheme Registration Form</h4>
                </div>

                <div class="card-body p-4">

                    <?php if($success != "") { ?>
                        <div class="alert alert-success text-center">
                            <?php echo $success; ?>
                        </div>
                    <?php } ?>

                    <form method="post" enctype="multipart/form-data">

                        <!-- Select Scheme -->
                        <div class="mb-3">
                            <label class="form-label">Select Scheme</label>
                            <select name="scheme_id" class="form-select" required>
                                <option value="">-- Select Scheme --</option>
                                <?php
                                $schemes = $conn->query("SELECT id, name FROM schemes");
                                while ($row = $schemes->fetch_assoc()) {
                                    echo "<option value='{$row['id']}'>{$row['name']}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Full Name -->
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="full_name" class="form-control" placeholder="Enter your full name" required>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                        </div>

                        <!-- Mobile -->
                        <div class="mb-3">
                            <label class="form-label">Mobile Number</label>
                            <input type="text" name="mobile" pattern="[0-9]{10}" class="form-control" placeholder="Enter 10-digit mobile number" required>
                        </div>

                        <!-- Document Upload -->
                        <div class="mb-4">
                            <label class="form-label">Upload Required Document (PDF Only)</label>
                            <input type="file" name="document" class="form-control" accept="application/pdf" required>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg">
                                Register Now
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
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

  