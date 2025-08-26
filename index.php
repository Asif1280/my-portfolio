<?php

include("./auth.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard Admin</title>
  <meta content="" name="description">
  <meta content="" name="keywords">


  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <style>
    .dashboard-card {


      border-radius: 8px;
      padding: 20px;
      text-align: center;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
    }



    /* Add more cards as needed */
  </style>
</head>

<body>

  <!-- ======= Header ======= -->

  <?php
  include("./includes/header.php");
  ?>


  <!-- ======= Sidebar ======= -->

  <?php
  include("./includes/sidebar.php");

  ?>


  <main id="main" class="main">
    <h2 class="mb-4 mt-1 text-center dashboard-title">Admin Dashboard</h2>
    <div class="container mt-5">

      <div class="row">
        <div class="col-md-4 col-sm-6">
          <div class="dashboard-card card-response" style="background-color: #f8d7da;">
            <h4>View Profile</h4>
            <div class="text-center mt-4">
              <a href="profile.php" class="btn btn-primary btn-lg">
                <i class="bi bi-arrow-left"></i>
              </a>
            </div>
          </div>
        </div>

        <div class="col-md-4 col-sm-6">
          <div class="dashboard-card card-response" style="background-color: #d1ecf1;">
            <h4>Contact</h4>
            <div class="text-center mt-4">
              <a href="view-enquiries.php" class="btn btn-info btn-lg">
                <i class="bi bi-arrow-left"></i>
              </a>
            </div>
          </div>
        </div>

        <div class="col-md-4 col-sm-6">
          <div class="dashboard-card card-response" style="background-color: #d4edda;">
            <h4>Change Password</h4>
            <div class="text-center mt-4">
              <a href="change-password.php" class="btn btn-success btn-lg">
                <i class="bi bi-arrow-left"></i>
              </a>
            </div>
          </div>
        </div>
      </div>

    </div>



  </main><!-- End #main -->





  <!-- ======= Footer ======= -->
  <?php
  include("./includes/footer.php");
  ?>
  <!-- End Footer -->



  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>