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
      <h1>Unggah Photo Kamu disini</h1>
      <nav>
        <ol class="breadcrumb">
          <!-- <li class="breadcrumb-item active">Home</a></li> -->
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row align-items-top">
        <div class="row">
          <div class="col-lg-12">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title"></h5>
                <!-- General Form Elements -->
                <form method="POST" action="upload.php" enctype="multipart/form-data">
                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="judul" required>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" style="height: 100px" name="deskripsi"></textarea>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Album</label>
                    <div class="col-sm-10">

                      <select class="form-select" aria-label="Default select example" name="album">
                          <?php
                          $result = mysqli_query($conn, "SELECT * FROM album");
                          while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value =$row[albumId]>$row[namaAlbum]</option>";
                          }
                          ?>
                        </select>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                    <div class="col-sm-10">
                      <input class="form-control" type="file" id="formFile" name="gambar" required>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary">Unggah</button>
                    </div>
                  </div>
              </div>
              </form><!-- End General Form Elements -->
            </div>
          </div>
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
    </div>
  </footer>

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