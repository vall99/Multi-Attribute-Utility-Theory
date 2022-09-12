<a href="index.php">Kembali</a><br />
<link rel="stylesheet" href="styles.css">
</style>
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

$id_alternatif = array("1", "2", "3", "4", "5");
$nama_alternatif = array("Mey", "Junia", "Julio", "Agus", "Septi");

$id_kriteria = array("1", "2", "3", "4", "5");
$nama_kriteria = array("IPK", "Penghasilan Ortu", "Tanggungan Ortu", "Presensi", "Semester");
$bobot_kriteria = array(0.25, 0.3, 0.2, 0.15, 0.1);

$matriks_nilai =  array(
	array(3, 2, 3, 3, 4),
	array(3, 3, 4, 2, 3),
	array(4, 2, 3, 3, 2),
	array(1, 4, 2, 2, 2),
	array(2, 1, 2, 1, 1)
);

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
<br /><a href="index.php">Kembali</a>