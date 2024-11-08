<?php
require_once('../function/connection.php');

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];

$sql = "insert into user values(null,'$username',md5($password),'$email','$nama','$alamat','admin',null)";

if (mysqli_query($conn, $sql)) {
    header("location:admin.php");
} else {
    echo "Proses tambah Admin Gagal" . mysqli_error($conn);
}
mysqli_close($conn);
