<?php
include("koneksi.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Sistem Pendukung Keputusan (SPK) Metode MAUT (Multi Attribute Utility Theory)</title>
	<style type="text/css">
		<!--
		body,
		td,
		th {
			font-family: Georgia, Times New Roman, Times, serif;
			font-size: 13px;
			color: #333333;
		}

		.style1 {
			color: #000099;
			font-size: 24px;
		}

		a:link {
			text-decoration: none;
			color: #333333;
		}

		a:visited {
			text-decoration: none;
			color: #333333;
		}

		a:hover {
			text-decoration: underline;
			color: #FF0000;
		}

		a:active {
			text-decoration: none;
			color: #333333;
		}

		.style2 {
			font-weight: bold
		}
		-->
	</style>
</head>

<body>
	<table width="1350" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#000099">
		<tr>
			<td height="50" align="center" bgcolor="#FFFFFF"><span class="style1">Sistem Pendukung Keputusan (SPK) Metode MAUT (Multi Attribute Utility Theory)</span></td>
		</tr>
		<tr>
			<td height="35" align="center" bgcolor="#FFFFFF"><span class="style2"><a href="index.php">Home</a> | <a href="maut-php-mysql.php">Analisa SPK MAUT 1</a> | <a href="analisa-maut-php-mysql.php">Analisa SPK MAUT 2</a> | <a href="konsultasi-maut-php-mysql.php">Analisa SPK MAUT 3</a> | <a href="perhitungan-maut-php-mysql.php">Analisa SPK MAUT 4</a> | <a href="login.php">Login</a></span></td>
		</tr>
		<tr>
			<td align="center" valign="top" bgcolor="#FFFFFF"><br />
				<strong>Analisa Menggunakan Sistem Pendukung Keputusan (SPK) Metode MAUT (Multi Attribute Utility Theory)</strong><br />
				<br />
				<?php
				function tampiltabel($arr)
				{
					echo '<table width="500" border="1" cellspacing="0" cellpadding="3">';
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
					echo '<table width="500" border="1" cellspacing="0" cellpadding="3">';
					echo '<tr>';
					for ($i = 0; $i < count($arr); $i++) {
						echo '<td>' . $arr[$i] . '</td>';
					}
					echo "</tr>";
					echo '</table>';
				}

				function tampilkolom($arr)
				{
					echo '<table width="500" border="1" cellspacing="0" cellpadding="3">';
					for ($i = 0; $i < count($arr); $i++) {
						echo '<tr>';
						echo '<td>' . $arr[$i] . '</td>';
						echo "</tr>";
					}
					echo '</table>';
				}

				?>
				<div id="perhitungan" style="display:none;">
					<br />
					<?php
					$id_alternatif = array(); //"1", "2", "3", "4", "5");
					$nama_alternatif = array(); //"Mey", "Junia", "Julio", "Agus", "Septi");

					$queryalternatif = mysqli_query($db, "SELECT * FROM alternatif ORDER BY id_alternatif");
					$i = 0;
					while ($dataalternatif = mysqli_fetch_array($queryalternatif)) {
						$id_alternatif[$i] = $dataalternatif['id_alternatif'];
						$nama_alternatif[$i] = $dataalternatif['nama_alternatif'];
						$i++;
					}

					$id_kriteria = array(); //"1", "2", "3", "4", "5");
					$nama_kriteria = array(); //"IPK", "Penghasilan Ortu", "Tanggungan Ortu", "Presensi", "Semester");
					$bobot_kriteria = array(); //0.25, 0.3, 0.2, 0.15, 0.1);

					$querykriteria = mysqli_query($db, "SELECT * FROM kriteria ORDER BY id_kriteria");
					$i = 0;
					while ($datakriteria = mysqli_fetch_array($querykriteria)) {
						$id_kriteria[$i] = $datakriteria['id_kriteria'];
						$nama_kriteria[$i] = $datakriteria['nama_kriteria'];
						$bobot_kriteria[$i] = $datakriteria['bobot_kriteria'];
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

					$nilai_max = array();
					$nilai_min = array();
					$nilai_selisih = array();
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


					for ($i = 0; $i < count($nama_kriteria); $i++) {
						$nilai_selisih[$i] = $nilai_max[$i] - $nilai_min[$i];
					}

					for ($i = 0; $i < count($nama_alternatif); $i++) {
						for ($j = 0; $j < count($nama_kriteria); $j++) {
							$matriks_normalisasi_nilai[$i][$j] = ($matriks_nilai[$i][$j] - $nilai_min[$j]) / $nilai_selisih[$j];
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
					nama_alternatif =
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
					<?php tampilbaris($nilai_max); ?>
					<br />
					nilai_selisih =
					<?php tampilbaris($nilai_selisih); ?>
					<br />
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
					alternatif terpilih = <?php echo $nama_alternatif_rangking[0]; ?> dengan hasil nilai akhir terbesar = <?php echo $hasil_akhir_rangking[0];
																															?>
					<br />
				</div>
				<br />
				<input type="button" value="Perhitungan" onclick="document.getElementById('perhitungan').style.display='block';" />
				<br />
				<br />
				Hasil Analisa Menggunakan Sistem Pendukung Keputusan (SPK) Metode MAUT (Multi Attribute Utility Theory)<br />
				<br />
				<table width="500" border="0" cellspacing="1" cellpadding="3" bgcolor="#000099">
					<tr>
						<td bgcolor="#FFFFFF">Rangking</td>
						<td bgcolor="#FFFFFF">Nama Alternatif</td>
						<td bgcolor="#FFFFFF">Nilai Akhir</td>
					</tr>
					<?php
					for ($i = 0; $i < count($nama_alternatif_rangking); $i++) {
					?>
						<tr>
							<td bgcolor="#FFFFFF"><?php echo ($i + 1); ?></td>
							<td bgcolor="#FFFFFF"><?php echo $nama_alternatif_rangking[$i]; ?></td>
							<td bgcolor="#FFFFFF"><?php echo $hasil_akhir_rangking[$i]; ?></td>
						</tr>
					<?php
					}
					?>
				</table>
				<br />
				Hasilnya Alternatif Terpilih dengan Nama = <?php echo $nama_alternatif_rangking[0]; ?> dengan Nilai Akhir Terbesar = <?php echo $hasil_akhir_rangking[0]; ?>
				<br />
				<br />
			</td>
		</tr>
		<tr>
			<td bgcolor="#FFFFFF">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">

				</table>
			</td>
		</tr>
	</table>
</body>

</html>