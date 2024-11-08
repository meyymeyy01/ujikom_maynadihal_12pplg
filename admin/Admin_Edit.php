<?php
require_once('../function/mainfunction.php');
require_once('../function/connection.php');
session_start();
if ($_SESSION['state'] != "login") {
  header("location:../index.php?error=auth");
}
$nama = $_SESSION['nama'];
$user = $_SESSION['userid'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>MeyPhotoSpace Admin</title>
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
      <h1>Ubah Bio Admin MeyPhotoSpace</h1>
      <nav>
        <ol class="breadcrumb">
          <!-- <li class="breadcrumb-item active">Home</a></li> -->
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <br>
            <?php
            $userId = $_GET['id'];
            $data = mysqli_query($conn, "select * from user where userId='$userId'");
            while ($user = mysqli_fetch_array($data)) {
            ?>
              <form action="AdminUpdate.php" method="POST">
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Username</label>
                  <div class="col-sm-10">
                    <input type="hidden" name="userId" class="form-control" value="<?php echo $user['userId']; ?>" required>
                    <input type="text" name="username" class="form-control" value="<?php echo $user['username']; ?>" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="email" name="email" class="form-control" value="<?php echo $user['email']; ?>" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Nama Lengkap</label>
                  <div class="col-sm-10">
                    <input type="text" name="nama" class="form-control" value="<?php echo $user['namaLengkap']; ?>" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Alamat</label>
                  <div class="col-sm-10">
                    <input type="text" name="alamat" class="form-control" value="<?php echo $user['alamat']; ?>" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-warning">Simpan</button>
                    <button type ="button" onclick="history.back();" class="btn btn-primary">Batal</button>
                  </div>
                </div>
              </form>
            <?php
            }
            ?>
          </div>
        </div>

      </div>
    </section>

  </main><!-- End #main -->

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