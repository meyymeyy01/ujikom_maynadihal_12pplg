<?php
require_once('../function/connection.php');

$userId = $_POST['userId'];
$username = $_POST['username'];
$email = $_POST['email'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];

$sql = "update user set username='$username', email='$email',namaLengkap='$nama', alamat='$alamat' where userId='$userId'";

if (mysqli_query($conn, $sql)) {
    header("location:admin.php");
} else {
    echo "Proses Update Admin Gagal" . mysqli_error($conn);
}
mysqli_close($conn);
