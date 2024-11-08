<?php
require_once('../function/mainfunction.php');
require_once('../function/connection.php');
session_start();
if ($_SESSION['state'] != "login") {
  header("location:../index.php?error=auth");
}
$nama = $_SESSION['nama'];
$user = $_SESSION['userid'];

$dataadmin = getUser("admin");
$nomor = 0;

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>MeyPhotoSpace User</title>
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
      <h1>Data Admin MeyPhotoSpace</h1>
      <nav style="display: flex; justify-content: flex-end;">
    <a href="addAdmin.php"><button class="btn btn-success">Tambah Admin</button></a>
  </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <!-- <h5 class="card-title">Table with stripped rows</h5> -->

            <!-- Table with stripped rows -->
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>User ID</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Nama Lengkap</th>
                  <th>Alamat</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($dataadmin as $user) : ?>
                  <?php $nomor++; ?>
                  <tr>
                    <td><?php echo "$nomor"; ?></td>
                    <td><?php echo "$user[userId]"; ?></td>
                    <td><?php echo "$user[username]"; ?></td>
                    <td><?php echo "$user[email]"; ?></td>
                    <td><?php echo "$user[namaLengkap]"; ?></td>
                    <td><?php echo "$user[alamat]"; ?></td>
                    <td>
                      <div class="form-button-action" style="display: flex; align-items: center;">
                        <!-- Edit Button -->
                        <a href="Admin_Edit.php?id=<?php echo $user['userId']; ?>" class="btn btn-warning" style="margin-right: 10px;">Edit</a>

                        <!-- Delete Button (Form) with Confirmation -->
                        <form action="../function/mainfunction.php?action=delete&table=user" method="post" enctype="multipart/form-data" onsubmit="return confirmDelete();">
                          <input type="hidden" name="id" value="<?php echo $user['userId']; ?>">
                          <button type="submit" class="btn btn-danger" data-toggle="tooltip" title="Remove">Hapus</button>
                        </form>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            <!-- End Table with stripped rows -->

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
  <script>
  function confirmDelete() {
    return confirm('Anda yakin akan menghapus admin?');
  }
</script>

</body>

</html>