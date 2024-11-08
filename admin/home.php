<?php
	require_once('../function/mainfunction.php');
	require_once('../function/connection.php');
	session_start();
	if($_SESSION['log']!="login"){
		header("location:../index.php?error=auth");
    }else{
        echo"It's admin Page";
        echo"<a href='logout.php'>Logout</a>";
    }
?>

