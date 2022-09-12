<?php
session_start();
include("koneksi.php");
if (@$_SESSION['userlogin'] == "") {
	header("location:login.php?pesan=Belum Login");
	exit;
}
?>

<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sistem Pendukung Keputusan (SPK) Metode MAUT (Multi Attribute Utility Theory)</title>
	<link rel="stylesheet" href="style.css">
</head>
<!doctype html>
<html lang="en">

<body>

	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary x-4">
		<div class="container-fluid">
			<img src="2.png" widht="55" height="50">
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="pusat.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="konsultasi-maut-php-mysql-utama.php">Analisis</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="ganti-password.php">Ganti Password</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" aria-currient="page" href="logout.php">Logout</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- Endnavbar -->
	<?php
	function tampiltabel($arr)
	{
		echo '<table class="table-bordered" align="center" style="border-color:black" width="500">';
		for ($i = 0; $i < count($arr); $i++) {
			echo '<tr>';
			for ($j = 0; $j < count($arr[$i]); $j++) {
				echo '<td>' . $arr[$i][$j] . '</td>';
			}
			echo '</tr>';
		}
		echo '</table>';
	}

	function tampilbaris($arr)
	{
		echo '<table class="table-bordered" align="center" style="border-color:black" width="500">';
		echo '<tr>';
		for ($i = 0; $i < count($arr); $i++) {
			echo '<td>' . $arr[$i] . '</td>';
		}
		echo "</tr>";
		echo '</table>';
	}

	function tampilkolom($arr)
	{
		echo '<table class="table-bordered" align="center" style="border-color:black" width="500">';
		for ($i = 0; $i < count($arr); $i++) {
			echo '<tr>';
			echo '<td>' . $arr[$i] . '</td>';
			echo "</tr>";
		}
		echo '</table>';
	}

	if (!isset($_POST['button'])) {
	?>
		<form name="form1" method="post" action=""><br>
			<table class="table-bordered" align="center" style="border-color:black" width="400">
				<tr>
					<th bgcolor=#0D6EFD colspan="2"><a style="color: white; font-size:15px">
							<div align="center"><strong>
									<font size="2" face="Arial, Helvetica, sans-serif">
										<font size="2">BOBOT KRITERIA</font>
									</font>
								</strong></div>
					</th>
					<?php
					$q = mysqli_query($db, "select * from kriteria ORDER BY id_kriteria");
					while ($r = mysqli_fetch_array($q)) {
					?>
				<tr>
					<td width="200">
						<?php echo $r['nama_kriteria']; ?>
					</td>
					<td width="200">
						<input id="bobot_kriteria_<?php echo $r['id_kriteria']; ?>" name="bobot_kriteria_<?php echo $r['id_kriteria']; ?>" type="text" value="<?php echo $r['bobot_kriteria']; ?>">
					</td>
				</tr>
			<?php } ?>
			<tr>
				<td colspan="2">Input Bobot Kriteria Jika Ditotal Harus 1</td>
			</tr>
			</table>
			<br>

			<table class="table-bordered" align="center" style="border-color:black" width="400">
				<tr>
					<th bgcolor=#0D6EFD colspan="2"><a style="color: white; font-size:15px">
							<div align="center"><strong>
									<font size="2" face="Arial, Helvetica, sans-serif">
										<font size="2">PILIH ALTERNATIF</font>
									</font>
								</strong></div>
					</th>
					<?php
					$q = mysqli_query($db, "select * from alternatif ORDER BY id_alternatif");
					while ($r = mysqli_fetch_array($q)) {
					?>
				<tr>
					<td width="50">
						<input id="alternatif<?php echo $r['id_alternatif']; ?>" name="alternatif<?php echo $r['id_alternatif']; ?>" type="checkbox" value="true" checked>
					</td>
					<td width="350">
						<?php echo $r['nama_alternatif']; ?>
					</td>
				</tr>
			<?php } ?>
			<tr>
				<td colspan="2"><input type="submit" name="button" value="Proses"></td>
			</tr>
			</table>
			<br>
		</form>
	<?php
	} else {
	?>
		<!-- <div id="perhitungan" style="display:none;">
			<br />
			<?php
			$id_alternatif = array(); //"1", "2", "3", "4", "5");
			$nama_alternatif = array(); //"Mey", "Junia", "Julio", "Agus", "Septi");
			$queryalternatif = mysqli_query($db, "SELECT * FROM alternatif ORDER BY id_alternatif");
			$i = 0;
			while ($dataalternatif = mysqli_fetch_array($queryalternatif)) {
				if (@$_POST['alternatif' . $dataalternatif['id_alternatif']] == "true") {
					$id_alternatif[$i] = $dataalternatif['id_alternatif'];
					$nama_alternatif[$i] = $dataalternatif['nama_alternatif'];
					$i++;
				}
			}

			$id_kriteria = array(); //"1", "2", "3", "4", "5");
			$nama_kriteria = array(); //"IPK", "Penghasilan Ortu", "Tanggungan Ortu", "Presensi", "Semester");
			$bobot_kriteria = array(); //0.25, 0.3, 0.2, 0.15, 0.1);

			$querykriteria = mysqli_query($db, "SELECT * FROM kriteria ORDER BY id_kriteria");
			$i = 0;
			while ($datakriteria = mysqli_fetch_array($querykriteria)) {
				$id_kriteria[$i] = $datakriteria['id_kriteria'];
				$nama_kriteria[$i] = $datakriteria['nama_kriteria'];
				$bobot_kriteria[$i] = @$_POST['bobot_kriteria_' . $datakriteria['id_kriteria']]; //$datakriteria['bobot_kriteria'];
				$i++;
			}

			$matriks_nilai =  array(array()); /*
						array(3, 2, 3, 3, 4),
						array(3, 3, 4, 2, 3),
						array(4, 2, 3, 3, 2),
						array(1, 4, 2, 2, 2),
						array(2, 1, 2, 1, 1)
					  ); */

			$queryalternatif = mysqli_query($db, "SELECT * FROM alternatif ORDER BY id_alternatif");
			$i = 0;
			while ($dataalternatif = mysqli_fetch_array($queryalternatif)) {
				if (@$_POST['alternatif' . $dataalternatif['id_alternatif']] == "true") {
					$querykriteria = mysqli_query($db, "SELECT * FROM kriteria ORDER BY id_kriteria");
					$j = 0;
					while ($datakriteria = mysqli_fetch_array($querykriteria)) {
						$querynilai = mysqli_query($db, "SELECT * FROM nilai WHERE id_alternatif = '$dataalternatif[id_alternatif]' AND id_kriteria = '$datakriteria[id_kriteria]'");
						$datanilai = mysqli_fetch_array($querynilai);

						$matriks_nilai[$i][$j] = $datanilai['nilai'];
						$j++;
					}
					$i++;
				}
			}

			$nilai_max = array();
			$nilai_min = array();
			// $nilai_selisih = array();
			$matriks_normalisasi_nilai = array();
			$matriks_kriteria_bobot = array();
			$hasil_akhir = array();
			$id_alternatif_rangking = array();
			$nama_alternatif_rangking = array();
			$hasil_akhir_rangking = array();

			for ($i = 0; $i < count($nama_kriteria); $i++) {
				for ($j = 0; $j < count($nama_alternatif); $j++) {
					if (($j == 0) || ($nilai_max[$i] < $matriks_nilai[$j][$i])) {
						$nilai_max[$i] = $matriks_nilai[$j][$i];
					}
					if (($j == 0) || ($nilai_min[$i] > $matriks_nilai[$j][$i])) {
						$nilai_min[$i] = $matriks_nilai[$j][$i];
					}
				}
			}


			// for ($i = 0; $i < count($nama_kriteria); $i++) {
			// 	$nilai_selisih[$i] = $nilai_max[$i] - $nilai_min[$i];
			// }

			for ($i = 0; $i < count($nama_alternatif); $i++) {
				for ($j = 0; $j < count($nama_kriteria); $j++) {
					$matriks_normalisasi_nilai[$i][$j] = ($matriks_nilai[$i][$j] - $nilai_min[$j]) / ($nilai_max[$j] - $nilai_min[$j]);
				}
			}


			for ($i = 0; $i < count($nama_alternatif); $i++) {
				for ($j = 0; $j < count($nama_kriteria); $j++) {
					$matriks_kriteria_bobot[$i][$j] = $matriks_normalisasi_nilai[$i][$j] * $bobot_kriteria[$j];
				}
			}

			for ($i = 0; $i < count($nama_alternatif); $i++) {
				$hasil_akhir[$i] = 0;
				for ($j = 0; $j < count($nama_kriteria); $j++) {
					$hasil_akhir[$i] = $hasil_akhir[$i] + $matriks_kriteria_bobot[$i][$j];
				}
			}

			for ($i = 0; $i < count($nama_alternatif); $i++) {
				$id_alternatif_rangking[$i] = $id_alternatif[$i];
				$nama_alternatif_rangking[$i] = $nama_alternatif[$i];
				$hasil_akhir_rangking[$i] = $hasil_akhir[$i];
			}

			for ($i = 0; $i < count($nama_alternatif); $i++) {
				for ($j = $i + 1; $j < count($nama_alternatif); $j++) {
					if ($hasil_akhir_rangking[$i] < $hasil_akhir_rangking[$j]) {
						$tmp_id_alternatif = $id_alternatif_rangking[$i];
						$tmp_nama_alternatif = $nama_alternatif_rangking[$i];
						$tmp_hasil_akhir = $hasil_akhir_rangking[$i];

						$id_alternatif_rangking[$i] = $id_alternatif_rangking[$j];
						$nama_alternatif_rangking[$i] = $nama_alternatif_rangking[$j];
						$hasil_akhir_rangking[$i] = $hasil_akhir_rangking[$j];

						$id_alternatif_rangking[$j] = $tmp_id_alternatif;
						$nama_alternatif_rangking[$j] = $tmp_nama_alternatif;
						$hasil_akhir_rangking[$j] = $tmp_hasil_akhir;
					}
				}
			}

			?>
			<br />
			<p align="center">nama_alternatif =
				<?php tampilbaris($nama_alternatif); ?>
				<br />
				nama_kriteria =
				<?php tampilbaris($nama_kriteria); ?>
				<br />
				bobot_kriteria =
				<?php tampilbaris($bobot_kriteria); ?>
				<br />
				matriks_nilai =
				<?php tampiltabel($matriks_nilai); ?>
				<br />
				nilai_max =
				<?php tampilbaris($nilai_max); ?>
				<br />
				nilai_min =
				<?php tampilbaris($nilai_min); ?>
				<br>
				matriks_normalisasi_nilai=
				<?php tampiltabel($matriks_normalisasi_nilai); ?>
				<br />
				matriks_kriteria_bobot=
				<?php tampiltabel($matriks_kriteria_bobot); ?>
				<br />
				hasil_akhir=
				<?php tampilkolom($hasil_akhir); ?>
				<br />
				hasil_akhir_rangking=
				<?php tampilkolom($hasil_akhir_rangking); ?>
				<br />
				nama_alternatif_rangking=
				<?php tampilkolom($nama_alternatif_rangking); ?>
				<br />
				alternatif terpilih = <?php echo $nama_alternatif_rangking[0]; ?> dengan hasil nilai akhir terbesar = <?php echo '' . round($hasil_akhir_rangking[0], 2);
																														?>
		</div> -->
		<!-- <br />
		<p align="center"><input type="button" value="Perhitungan" onclick="document.getElementById('perhitungan').style.display='block';" />
		<p align="center">Hasil Analisa Menggunakan Sistem Pendukung Keputusan (SPK) Metode MAUT (Multi Attribute Utility Theory)<br />
			<br /> -->
		<br>
		<br>
		<table class="table-bordered" align="center" style="border-color:black" width="400">
			<tr>
				<th bgcolor=#0D6EFD><a style="color: white; font-size:15px">Rangking</th>
				<th bgcolor=#0D6EFD><a style="color: white; font-size:15px">Nama Alternatif</th>
				<th bgcolor=#0D6EFD><a style="color: white; font-size:15px">Nilai Akhir</th>
			</tr>
			<?php
			for ($i = 0; $i < count($nama_alternatif_rangking); $i++) {
			?>
				<tr>
					<td bgcolor="#FFFFFF"><?php echo ($i + 1); ?></td>
					<td bgcolor="#FFFFFF"><?php echo $nama_alternatif_rangking[$i]; ?></td>
					<td bgcolor="#FFFFFF"><?php echo '' . round($hasil_akhir_rangking[$i], 2); ?></td>
				</tr>
			<?php
			}
			?>
		</table>
		<br />
		<hr1>
			<p align="center">Hasilnya Alternatif Terpilih dengan Nama = <?php echo $nama_alternatif_rangking[0]; ?> dengan Nilai Akhir Terbesar = <?php echo '' . round($hasil_akhir_rangking[0], 2); ?>
				<br />
				<br>
				Verifikasi?<br>
			<div align="center" id="clean" onclick="myClean()">
				<a id="ya" onclick="myFunction1()"><label class="btn btn-primary" for="btn-check" id="demo">Ya</label>
					<a id="tidak" onclick="myFunction2()"><label class="btn btn-secondary" for="btn-check" id="demo">Tidak</label><br><br>.
			</div>
			</p>
		<?php
	}
		?>
		<br />
		</td>
		</tr>
		<tr>
			<script>
				function myFunction1() {
					document.getElementById("clean").innerHTML = "";
					document.getElementById("clean").innerHTML = "<button type='button' class='btn btn-success' disabled>Laporan Terverifikasi</button>";
				}

				function myFunction2() {
					document.getElementById("clean").innerHTML = "";
					document.getElementById("clean").innerHTML = "<button type='button' class='btn btn-danger' disabled>Laporan Ditolak</button>";
				}
			</script>
</body>

</html>