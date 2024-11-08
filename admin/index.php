<?php
	require_once('../function/mainfunction.php');
	require_once('../function/connection.php');
	session_start();
	if($_SESSION['state']!="login"){
		header("location:../index.php?error=auth");
  }

  $nama = $_SESSION['nama'];
  $userLogin = $_SESSION['userid'];

  // $PhotoGue= getCountPhotouser("foto",$userLogin);
  $hitungfoto=getCountPhotoSemua();
  $hitungAdmin=getCountUser('admin');
  $hitungUser=getCountUser('user');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>MeyPhotoSpace <?php echo $nama; ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/backend/img/favicon.png" rel="icon">
  <link href="../assets/backend/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/backend/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/backend/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/backend/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/backend/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/backend/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/backend/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/backend/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/backend/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
 <?php include('header.php'); ?>
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <?php include('sidebar.php'); ?>
  <!-- End Sidebar-->

  <main id="main" class="main">

<div class="pagetitle">
  <h1>Dashboard Admin MeyPhotoSpace</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
  <div class="row">

    <!-- Left side columns -->
    <div class="col-lg-12">
      <div class="row">

        <!-- Sales Card -->
        <div class="col-xxl-4 col-md-12">
          <div class="card info-card sales-card">

            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>
            

            <div class="card-body">
              <h5 class="card-title">Foto <span>| tersimpan</span></h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-camera"></i>
                </div>
                <div class="ps-3">
                  <h6>
                    <?= $hitungfoto. " Photo"; ?>
                  </h6>
                </div>
              </div>
            </div>

          </div>
        </div><!-- End Sales Card -->
         <!-- Sales Card -->
         <div class="col-xxl-4 col-md-12">
          <div class="card info-card sales-card">

            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>
            

            <div class="card-body">
              <h5 class="card-title">Admin <span>| tersimpan </span></h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-camera"></i>
                </div>
                <div class="ps-3">
                  <h6>
                    <?= $hitungAdmin. " Admin"; ?>
                  </h6>
                </div>
              </div>
            </div>

          </div>
        </div><!-- End Sales Card -->

                 <!-- Sales Card -->
                 <div class="col-xxl-4 col-md-12">
          <div class="card info-card sales-card">

            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>
            

            <div class="card-body">
              <h5 class="card-title">User <span>| tersimpan </span></h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-camera"></i>
                </div>
                <div class="ps-3">
                  <h6>
                    <?= $hitungUser. " Member"; ?>
                  </h6>
                </div>
              </div>
            </div>

          </div>
        </div><!-- End Sales Card -->

      </div>
    </div>
    <!-- End Left side columns -->
  </div>
</section>

</main>
  <!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>MeyPhotoSpace</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../assets/backend/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/backend/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/backend/vendor/chart.js/chart.umd.js"></script>
  <script src="../assets/backend/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/backend/vendor/quill/quill.js"></script>
  <script src="../assets/backend/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/backend/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/backend/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/backend/js/main.js"></script>

</body>
  
</html>