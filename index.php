<?php
require_once('function/connection.php');
require_once('function/mainfunction.php');

session_start();
$_SESSION['state'] = "";
if ($_SESSION['state'] == "login") {
  header("location:index.php");
} else {
  if (isset($_POST['masuk'])) {
    $username = $_POST['username'];
    if (login($_POST['username'], $_POST['password'])) {
      $_SESSION['userId'] = $query['namaLengkap'];;
      $_SESSION['username'] = $username;
      // $_SESSION['role'] = $query['level'];
      $role = $_SESSION['role'];
      $_SESSION['state'] = "login";
      $_SESSION['nama'] = $query['namaLengkap'];
      if ($role == "admin") {
        header("location: admin/");
      } else {
        header("location:user/");
      }
    } else {
      header("location:index.php?error=auth");
    }
  }
}

$image = getAllPhotoData();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Welcome to MeyPhotoSpace </title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/frontend/img/favicon.png" rel="icon">
  <link href="assets/frontend/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/frontend/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/frontend/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/frontend/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/frontend/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/frontend/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/frontend/css/main.css" rel="stylesheet">
  <!-- <link rel="stylesheet" href="assets/css/style.css"> -->


  <!-- =======================================================
  * Template Name: Bootslander
  * Template URL: https://bootstrapmade.com/bootslander-free-bootstrap-landing-page-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">
  <!-- Header Section -->
  <?php include("layout/header.php"); ?>
  <!-- Header Section -->

  <main class="main">
    <!-- Hero Section -->
    <?php include("layout/section_hero.php"); ?>
    <!-- /Hero Section -->

    <!-- About Section -->
    <?php include("layout/section_about.php"); ?>
    <!-- /About Section -->


    <!-- Gallery Section -->
    <section id="gallery" class="gallery section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Gallery</h2>
        <div><span>Check Our</span> <span class="description-title">Gallery</span></div>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <?php
        $sql = "SELECT p.fotoID, p.judulFoto, p.deskripsiFoto, p.tanggalUnggah, p.lokasiFile, p.albumId, a.namaAlbum, COALESCE(l.likeCount, 0) as jumlahLike, COALESCE(c.commentarCount, 0) as jumlahKomentar FROM foto p LEFT JOIN album a ON p.albumId = a.albumId LEFT JOIN (SELECT FotoID, COUNT(*) as likeCount FROM likefoto GROUP BY FotoID) l ON p.fotoID = l.FotoID LEFT JOIN (SELECT FotoID, COUNT(*) as commentarCount FROM komentarfoto GROUP BY FotoID) c ON p.fotoID = c.FotoID;";
        // $sql = "SELECT p.fotoID, p.judulFoto, p.deskripsiFoto, p.tanggalUnggah, p.lokasiFile, p.albumId, a.namaAlbum, COALESCE(l.likeCount, 0) as jumlahLike, COALESCE(c.commentarCount, 0) as jumlahKomentar FROM foto p  JOIN user u on p.userId = u.userId LEFT JOIN album a ON p.albumId = a.albumId LEFT JOIN (SELECT FotoID, COUNT() as likeCount FROM likefoto GROUP BY FotoID) l ON p.fotoID = l.FotoID LEFT JOIN (SELECT FotoID, COUNT() as commentarCount FROM komentarfoto GROUP BY FotoID) c ON p.fotoID = c.FotoID";
        $result = mysqli_query($conn, $sql);
        $images = [];
        if ($result) {
          while ($row = mysqli_fetch_assoc($result)) {
            $images[] = $row;
          }
        }
        ?>
        <div class="row g-0">
          <?php if (!empty($images) && is_array($images)): ?>
            <?php foreach ($images as $image): ?>
              <?php
              $dateString = $image['tanggalUnggah'];
              $date = DateTime::createFromFormat('Y-m-d', $dateString);
              $tglIndonesia = $date->format('d-m-Y');

              $jumlahLike = $image['jumlahLike'] ?? 0;
              $jumlahKomentar = $image['jumlahKomentar'] ?? 0;


              ?>
              <div class="col-lg-3 col-md-4 mb-4">
                <div class="gallery-item position-relative">
                  <a href="user/photo/<?= $image['lokasiFile'] ?>" class="glightbox" data-gallery="images-gallery" data-description="<?= htmlspecialchars($image['deskripsiFoto']) ?>">
                    <?php if (file_exists("photo/" . $image['lokasiFile'])): ?>
                      <img src="user/photo/<?= $image['lokasiFile'] ?>" alt="<?= $image['deskripsiFoto'] ?>" class="img-fluid">
                      <?php echo "<p>" . $image['deskripsiFoto'];
                      "</p>" ?>
                    <?php else: ?>
                      <img src="user/photo/<?= $image['lokasiFile'] ?>" alt="Default Image" class="img-fluid">

                    <?php endif; ?>
                  </a>
                  <!-- Info jumlah like dan komentar -->
                  <div class="gallery-info p-2">
                    <div class="d-flex justify-content-between" style="font-size: 0.9em;">
                      <span>👍 <?= $jumlahLike ?> Likes</span>
                      <a href="" data-bs-toggle="modal" data-bs-target="#Modal<?php echo "$image[fotoID]"; ?>"><span>💬 <?= $jumlahKomentar ?> Komentar</span></a>
                    </div>
                  </div>
                  <div class="p-2">
                    <form action="user/like.php" method="post">
                      <input type="hidden" name="fotoID" value="<?= $image['fotoID'] ?>">

                      <!-- Tombol Like -->
                      <button type="submit" name="action" value="like" class="btn btn-sm btn-primary mb-2">👍 Like</button>
                    </form>
                    <form action="user/komentar.php" method="post">
                      <input type="hidden" name="fotoID" value="<?= $image['fotoID'] ?>">
                      <!-- Form Komentar -->
                      <div class="mb-2">
                        <textarea name="comment" class="form-control" placeholder="Tambahkan komentar..." rows="2"></textarea>
                      </div>
                      <button type="submit" name="action" value="comment" class="btn btn-sm btn-success">💬 Kirim Komentar</button>
                    </form>
                  </div>


                  <!-- komentar -->

                  <div class="modal fade" id="Modal<?php echo "$image[fotoID]"; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Komentar</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                          <?php
                          // Tambahkan query untuk mengambil komentar berdasarkan fotoID
                          $fotoID = $image['fotoID'];
                          $sql = "SELECT * FROM komentarfoto WHERE FotoID ='$fotoID'";
                          $Result = mysqli_query($conn, $sql);
                          $comments = [];
                          if ($Result) {
                            while ($commentRow = mysqli_fetch_assoc($Result)) {
                              $comments[] = $commentRow;
                            }
                          }
                          ?>
                          <?php if (!empty($comments)): ?>
                            <?php foreach ($comments as $comment): ?>
                              <div class="mb-2">
                                <strong><?= htmlspecialchars($comment['userID'] ?? 'Anonim') ?></strong>
                                <span style="font-size: 0.8em;">
                                  <?= isset($comment['TanggalKomentar']) ? htmlspecialchars($comment['TanggalKomentar']) : 'Tanggal tidak tersedia' ?>
                                </span>
                                <p><?= ($comment['IsiKomentar'] ?? 'Komentar tidak tersedia') ?></p>
                              </div>
                            <?php endforeach; ?>
                          <?php else: ?>
                            <p>Tidak ada komentar untuk foto ini.</p>
                          <?php endif; ?>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- komentar -->
                </div>
              </div><!-- End Gallery Item -->
            <?php endforeach; ?>
          <?php else: ?>
            <p class="text-center w-100">Tidak ada gambar yang tersedia.</p>
          <?php endif; ?>
        </div>


      </div>

    </section><!-- /Gallery Section -->

  </main>

  <!-- Modal Register -->
  <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="registerModalLabel" style="font-size: 1rem;">Pendaftaran Pengguna Baru</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="registerForm " action="function/mainfunction.php?action=insert&table=user" method="post" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="username" class="form-label" style="font-size: 0.9rem;">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="email" class="form-label" style="font-size: 0.9rem;">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
              </div>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label" style="font-size: 0.9rem;">Password</label>
              <input type="password" class="form-control" id="password" name="password" minlength="8" required>
            </div>
            <div class="mb-3">
              <label for="namaLengkap" class="form-label" style="font-size: 0.9rem;">Nama Lengkap</label>
              <input type="text" class="form-control" id="namaLengkap" name="namaLengkap" required>
            </div>
            <div class="mb-3">
              <label for="alamat" class="form-label" style="font-size: 0.9rem;">Alamat</label>
              <textarea class="form-control" id="alamat" name="alamat" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary" style="font-size: 0.9rem;">Daftar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Register -->

  <!-- Modal login -->
  <div id="loginModal" class="modal fade" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="registerModalLabel" style="font-size: 1rem;">Login Pengguna</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="" method="POST">
            <div class="row">
              <div class="col-md-12 mb-3">
                <label for="username" class="form-label" style="font-size: 0.9rem;">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
              </div>
            </div>
            <div class="col-md-12 mb-3">
              <label for="password" class="form-label" style="font-size: 0.9rem;">Password</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary" style="font-size: 0.9rem;" name="masuk">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  </div>

  <!-- Modal login -->


  <footer id="footer" class="footer dark-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">SMK BAKTI NUSANTARA 666</span>
          </a>
          <div class="footer-contact pt-3">
            <p>Jl. Percobaan No. 65 Cileunyi</p>
            <p>Kabupaten Bandung Jawa Barat</p>
            <p class="mt-3"><strong>Phone:</strong> <span>+62 5589 55488 55</span></p>
            <p><strong>Email:</strong> <span>MeyPhotoSpace@gmail.com</span></p>
          </div>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Terms of service</a></li>
            <li><a href="#">Privacy policy</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><a href="#">Web Design</a></li>
            <li><a href="#">Web Development</a></li>
            <li><a href="#">Product Management</a></li>
            <li><a href="#">Marketing</a></li>
            <li><a href="#">Graphic Design</a></li>
          </ul>
        </div>

        <div class="col-lg-4 col-md-12 footer-newsletter">
          <h4>Our Newsletter</h4>
          <p>Subscribe to our newsletter and receive the latest news about our products and services!</p>
          <form action="forms/newsletter.php" method="post" class="php-email-form">
            <div class="newsletter-form"><input type="email" name="email"><input type="submit" value="Subscribe"></div>
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Your subscription request has been sent. Thank you!</div>
          </form>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Bootslander</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/frontend/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/frontend/vendor/php-email-form/validate.js"></script>
  <script src="assets/frontend/vendor/aos/aos.js"></script>
  <script src="assets/frontend/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/frontend/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/frontend/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/frontend/js/main.js"></script>

</body>

</html>