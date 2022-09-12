<?php
	session_start();
	include("koneksi.php");
	if (@$_SESSION['userlogin'] == "")
	{
		header("location:login.php?pesan=Belum Login");
		exit;
	}
	mysqli_query($db, "DELETE FROM pilihan_kriteria WHERE id_SubKriteria = '$_GET[id_SubKriteria]'");
	header("location:pilihan-kriteria.php");
