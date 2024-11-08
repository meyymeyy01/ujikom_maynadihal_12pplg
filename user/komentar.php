<?php
require_once('../function/connection.php');
require_once('../function/mainfunction.php');

$fotoID = $_POST['fotoID'];
$comment = $_POST['comment'];
mysqli_query($conn, "INSERT INTO komentarfoto VALUES(null,'$fotoID',null,'$comment', Now())");
header("location:index.php");
?>

<?php
$id = $_GET['id'];

    $query = mysqli_query($koneksi, "SELECT*FROM foto WHERE id_foto=$id");
    $data = mysqli_fetch_array($query);
?>

<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Galeri Foto</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>
            <a href="?page=galeri" class="btn btn-danger">Kembali</a>
            <br><br>
            <form method="post" enctype="multipart/form-data">
                <table class="table">
                    <tr>
                        <td width="150">Judul</td>
                        <td width="1">:</td>
                        <td><?php echo $data['judul'];  ?></td>
                    </tr>
                    <tr>
                        <td>Deskripsi</td>
                        <td>:</td>
                        <td><?php echo $data['deskripsi'];  ?></td>
                    </tr>
                    <tr>
                        <td>Album</td>
                        <td>:</td>
                        <td>
                            <select name="id_album" disabled class="form-select form-control">
                                <?php
                                    $al = mysqli_query ($koneksi, "SELECT*FROM album");
                                    while($album = mysqli_fetch_array($al)){
                                        ?>
                                        <option 
                                            <?php
                                                if($data['id_album'] == $album['id_album']) echo 'selected';
                                            ?>
                                        value="<?php echo $album['id_album']?>"><?php echo $album['nama_album']?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td>:</td>
                        <td><<?php echo $data['tanggal'];  ?></td>
                    </tr>
                    <tr>
                        <td>Gambar</td>
                        <td>:</td>
                        <td>
                            
                                 <a href="gambar/<?php echo $data['gambar'];?>" target="_blank">
                                 <img src="gambar/<?php echo $data ['gambar'];?>" width="200" alt="gambar">
                                 </a>
                    </td>
                    </tr>
                </table> mantap

            </form>
            <h1 class="h3 mb-0 text-gray-800">Komentar Foto</h1>
            <?php

 if(isset($_POST['komentar'])){
    $komentar = $_POST['komentar'];
    $tanggal = date("Y/m/d");
    $id_user = $_SESSION['user']['id_user'];

    $query = mysqli_query($koneksi, "INSERT INTO komentarfoto (id_foto,id_user,komentar,tanggal) values('$id','$id_user','$komentar','$tanggal')");



    if($query > 0) {
        echo '<script> alert("Komentar Telah Ditambahkan")</script>';
    }else{
        echo '<script> alert("Komentar Gagal Ditambahkan") </script>';
    }
}

                $query = mysqli_query($koneksi, "SELECT*FROM komentar left join user on user.id_user = komentar.id_user WHERE komentar.id_foto=$id");
                while($data=mysqli_fetch_array($query)){
                    ?>
                    <div class="card mb-2">
                        <div class="card-header bg-primary text-white"><?php echo $data['nama_lengkap'] . '(' .$data['tanggal'].')'; ?></div>
                        <div class="card-body"><?php echo $data['komentar']; ?></div>
                    </div>
                    <?php
                }
            ?>

<?php
$id = $_GET['id'];

    $query = mysqli_query($koneksi, "SELECT*FROM komentarfoto WHERE id_foto=$id");
    $data = mysqli_fetch_array($query);
?>

            <form method="post">
                <label>Masukan Komentar</label>
                <textarea name="komentar" rows="5" class="form-control"></textarea>
                <br>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
</div>