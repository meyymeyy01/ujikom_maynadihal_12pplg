<?php
require_once('../function/mainfunction.php');
require_once('../function/connection.php');

    $idk = $_GET['idk'];
    $query = mysqli_query($conn, "DELETE FROM komentarfoto  WHERE komentarID=$idk");
    if($query > 0) {
        echo '<script> alert("Hapus Data Berhasil"); location.href="vkomentar.php"</script>';
    }else{
        echo '<script> alert("Hapus Data Gagal") </script>';
    }
?>

