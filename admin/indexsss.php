<?php
	require('../function/mainfunction.php');
	require('../function/connection.php');
	session_start();
	if($_SESSION['state']!="login"){
		header("location:../index.php?error=auth");
	}else{
		header("location:../admin/.php");
	}
?>

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

<?php
// Include the necessary files for database connection
require_once '../ukk_galeri/koneksi.php';

// Check if delete action is requested
if (isset($_GET['delete'])) {
    $FotoID = $_GET['delete'];
    $deleteQuery = "DELETE FROM foto WHERE FotoID = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $FotoID);
    if ($stmt->execute()) {
        echo "<script>alert('Foto berhasil dihapus');</script>";
    } else {
        echo "<script>alert('Gagal menghapus foto');</script>";
    }
    $stmt->close();
    header("Location: index.php"); // Redirect to refresh the list
    exit();
}
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
      <h1>My Photo Collection</h1>
      <nav>
        <ol class="breadcrumb">
          <!-- <li class="breadcrumb-item active">Home</a></li> -->
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <?php
    $query = "SELECT foto.fotoID, foto.judulFoto, foto.deskripsiFoto, foto.tanggalUnggah, foto.lokasiFile, album.namaAlbum, foto.userId, user.username FROM foto INNER JOIN album ON foto.albumId = album.albumId INNER JOIN user ON foto.userId = user.userId  WHERE foto.userId = $user ORDER BY foto.tanggalUnggah DESC";

    $result = mysqli_query($conn, $query);
    $images = [];
    if ($result) {
      while ($row = mysqli_fetch_assoc($result)) {
        $images[] = $row;
      }
    }
    ?>

    <section class="section">
      <div class="row align-items-top">
        <?php foreach ($images as $image): ?>
          <?php
          $dateString = $image['tanggalUnggah'];
          $date = DateTime::createFromFormat('Y-m-d', $dateString);
          $tglIndonesia = $date->format('d-m-Y');
          ?>
          <div class="col-md-3 mb-4"> <!-- Added margin-bottom for spacing -->
            <div class="card">
              <?php if (file_exists("photo/" . $image['lokasiFile'])): ?>
                <img src="photo/<?= $image['lokasiFile'] ?>" class="card-img-top" alt="<?= $image['deskripsiFoto'] ?>">
              <?php else: ?>
                <img src="../assets/backend/img/default.jpg" class="card-img-top" alt="Default Image">
              <?php endif; ?>
              <div class="card-body">
                <h5 class="card-title"><?= $image['judulFoto'] ?></h5>
                <p style="font-size: small;"><?= $image['deskripsiFoto'] ?></p>
                <div style="font-size: small;">Tanggal : <?= $tglIndonesia; ?></div>
                <div style="font-size: small;">Album: <?= $image['namaAlbum'] ?></div>
              </div>
              <div class="card-footer">
            <form action="photo.php" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus foto ini?');">
                            <input type="hidden" name="photo_id" value="<?= $image['fotoID'] ?>">
                            <a href="../ukk_galeri/galeri_hapus.php?id=<?php echo $image['fotoID']; ?>" class="btn btn-danger">Hapus Foto</a>

                        </form>
                        <form method="post">
                          
                <label>Masukan Komentar</label>
                <textarea name="komentar" rows="5" class="form-control"></textarea>
                <br>
                <button type="submit" class="btn btn-primary">Simpan</button>

                  </div>
                  <!-- <div class="p-2">
                    <form action="user/like.php" method="post">
                      <input type="hidden" name="fotoID" value="<?= $image['fotoID'] ?>">

                      <!-- Tombol Like -->
                      <button type="submit" name="action" value="like" class="btn btn-sm btn-primary mb-2">👍 Like</button>
                    </form>
                    <form action="user/komentar.php" method="post">
                      <input type="hidden" name="fotoID" value="<?= $image['fotoID'] ?>">
            </form> -->
            </div> 
            </div>
          </div>
          
        <?php endforeach; ?>
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