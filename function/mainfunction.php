<?php
require_once('connection.php');

function login($username, $password)
{
    global $conn;
    $uname = $username;
    $upass = $password;
    $sql = mysqli_query($conn, "SELECT * FROM user WHERE username='$uname' AND password=md5('$upass')");
    $cek = mysqli_num_rows($sql);
    if ($cek > 0) {
        $query = mysqli_fetch_array($sql);
        $_SESSION['state'] = "login";
        $_SESSION['userid'] = $query['userId'];
        $_SESSION['username'] = $query['username'];
        $_SESSION['nama'] = $query['namaLengkap'];
        $_SESSION['role'] = $query['level'];
        return true;
    } else {
        return false;
    }
}

function getCountPhotouser($table_name, $userId)
{
    global $conn;
    $sql = "Select * from $table_name Where userId ='$userId'";
    if ($result = mysqli_query($conn, $sql)) {
        $rowcount = mysqli_num_rows($result);
        return $rowcount;
    }
}

function getCountPhotoSemua()
{
    global $conn;
    $sql = "SELECT COUNT(*) FROM foto INNER JOIN album ON foto.albumId = album.albumId INNER JOIN user ON foto.userId = user.userId;";
    if ($result = mysqli_query($conn, $sql)) {
        $rowcount = mysqli_num_rows($result);
        return $rowcount;
    }
}

function getCountUser($level)
{
    global $conn;
    $sql = "Select * from user Where level ='$level'";
    if ($result = mysqli_query($conn, $sql)) {
        $rowcount = mysqli_num_rows($result);
        return $rowcount;
    }
}

function getAllPhotoData()
{
    global $conn;
    $sql = "SELECT p.fotoID, p.judulFoto, p.deskripsiFoto, p.tanggalUnggah, p.lokasiFile, p.albumId, a.namaAlbum, COALESCE(l.likeCount,0) as jumlahLike, COALESCE(c.commentarCount,0) as jumlahKomentar FROM foto p LEFT JOIN album a on p.albumId = a.albumId LEFT JOIN (SELECT FotoID, COUNT(*) as likeCount FROM likefoto GROUP BY likefoto.LikeID) l ON p.fotoID = l.FotoID LEFT JOIN (SELECT FotoID, COUNT(*) as commentarCount FROM komentarfoto GROUP BY komentarfoto.FotoID) c ON p.fotoID = c.FotoID;";
    $result = mysqli_query($conn, $sql);
    $images = [];
    if ($result) {
      while ($row = mysqli_fetch_assoc($result)) {
        $images[] = $row;
      }
    }
}

function getUser($level)
{
    global $conn;
    $sql = mysqli_query($conn, "SELECT * FROM user where level = '$level'");
    $rows = [];
    while ($row = mysqli_fetch_assoc($sql)) {
        $rows[] = $row;
    }
    return $rows;
}

function getKomentar()
{
 global $conn;
 $sql="SELECT komentarfoto.KomentarID, komentarfoto.FotoID, foto.judulFoto, foto.userId, user.username,foto.lokasiFile, komentarfoto.IsiKomentar, komentarfoto.TanggalKomentar FROM komentarfoto INNER JOIN foto on komentarfoto.FotoID = foto.fotoID INNER JOIN user ON foto.userId = user.userId";
 $result = mysqli_query($conn, $sql);
    $koments = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $koments[] = $row;
        }
    }
    return $koments ?: null;  // Jika $koments kosong, kembalikan null
}

// Insert Data
if (isset($_GET['action']) && $_GET['action'] == 'insert') {
    if ($_GET['table'] == 'user') {
        // Post Values
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $namaLengkap = $_POST['namaLengkap'];
        $alamat = $_POST['alamat'];
        // Query (username, password, email, namaLengkap, alamat
        $sql = "INSERT INTO `user` (`username`, `password`, `email`,`namaLengkap`, `alamat`, `level`) VALUES ('$username', md5($password), '$email', '$namaLengkap','$alamat','user')";
        mysqli_query($conn, $sql);
        if ($sql) {
            // Redirect with clearing form values
            $_POST['username'] = '';
            $_POST['password'] = '';
            $_POST['email'] = '';
            $_POST['namaLengkap'] = '';
            $_POST['alamat'] = '';
            header("location:../index.php");
        }
    }
}

// Delete Data
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    if ($_GET['table'] == 'foto') {
        $id = $_POST['id'];
        $sql = "DELETE FROM `foto` WHERE `id` = '$id'";
        mysqli_query($conn, $sql);
        if ($sql) {
            header("location:../admin/barang.php");
        }
    }

    if ($_GET['table'] == 'user') {
        $id = $_POST['id'];
        $sql = "DELETE FROM `user` WHERE `userId` = '$id'";
        mysqli_query($conn, $sql);
        if ($sql) {
            header("location:../admin/");
        }

    }

}
