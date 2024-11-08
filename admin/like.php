<?php
require_once('../function/connection.php');
require_once('../function/mainfunction.php');

$fotoID = $_POST['fotoID']; 
mysqli_query($conn, "INSERT INTO likefoto VALUES(null,'$fotoID',null,Now())");
header("location:index.php");
?>
