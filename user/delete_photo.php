<?php
require_once('../function/mainfunction.php');
require_once('../function/connection.php');

    $id = $_POST['photo_id'];

    $query = mysqli_query($conn, "DELETE FROM foto WHERE fotoID=$id");
    if($query > 0) {
        echo '<script> alert("Hapus Data Berhasil"); location.href="photo.php"</script>';
    }else{
        echo '<script> alert("Hapus Data Gagal") </script>';
    }
?>

