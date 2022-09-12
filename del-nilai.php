<?php
	session_start();
	include("koneksi.php");
	if (@$_SESSION['userlogin'] == "")
	{
		header("location:login.php?pesan=Belum Login");
		exit;
	}
	mysqli_query($db, "DELETE FROM nilai WHERE id_nilai = '$_GET[id_nilai]'");
	header("location:nilai.php");
?>