<?php
require_once('../function/mainfunction.php');
require_once('../function/connection.php');
session_start();
if ($_SESSION['state'] != "login") {
    header("location:../index.php?error=auth");
}

$nama       = $_SESSION['nama'];
$userId     = $_SESSION['userid'];
$judul      = $_POST['judul'];
$deskripsi  = $_POST['deskripsi'];
$album      = $_POST['album'];
$gambar     = $_FILES['gambar']['name'];

if ($gambar != "") {
    $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
    $x = explode('.', $gambar);
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['gambar']['tmp_name'];
    $angka_acak     = rand(1, 999);
    $nama_gambar_baru = $angka_acak . '-' . $gambar;
    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
        move_uploaded_file($file_tmp, 'photo/' . $nama_gambar_baru);
        $query = "INSERT INTO foto (judulFoto, deskripsiFoto, tanggalUnggah, lokasiFile, albumId, userId) VALUES ('$judul', '$deskripsi', now(), '$nama_gambar_baru', '$album', '$userId')";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            die("Query gagal dijalankan: " . mysqli_errno($conn) .
                " - " . mysqli_error($conn));
        } else {
            echo "<script>alert('Photo berhasil ditambah.');window.location='index.php';</script>";
        }
    } else {
        echo "<script>alert('Ekstensi photo yang boleh hanya jpg, jpeg atau png.');window.location='upload.php';</script>";
    }
} else {
    $query = "INSERT INTO foto (judulFoto, deskripsiFoto, tanggalUnggah, lokasiFile, albumId, userId) VALUES ('$judul', '$deskripsi', now(), '$nama_gambar_baru', '$album', '$userId')";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Query gagal dijalankan: " . mysqli_errno($conn) .
            " - " . mysqli_error($conn));
    } else {
        echo "<script>alert('Data berhasil ditambah.');window.location='index.php';</script>";
    }
}
