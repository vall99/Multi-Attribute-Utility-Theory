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
body,td,th {
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
.style2 {font-weight: bold}
-->
</style></head>

<body>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#000099">
  <tr>
    <td height="50" bgcolor="#FFFFFF"><span class="style1">Sistem Pendukung Keputusan (SPK) Metode MAUT (Multi Attribute Utility Theory)</span></td>
  </tr>
  <tr>
    <td height="35" bgcolor="#FFFFFF"><span class="style2"><a href="index.php">Home</a> | <a href="maut-php-mysql.php">Analisa SPK MAUT 1</a> | <a href="analisa-maut-php-mysql.php">Analisa SPK MAUT 2</a> | <a href="konsultasi-maut-php-mysql.php">Analisa SPK MAUT 3</a> | <a href="perhitungan-maut-php-mysql.php">Analisa SPK MAUT 4</a> | <a href="login.php">Login</a></span></td>
  </tr>
  <tr>
    <td align="center" valign="top" bgcolor="#FFFFFF"><br />
      <strong>Analisa Menggunakan Sistem Pendukung Keputusan (SPK) Metode MAUT (Multi Attribute Utility Theory)</strong><br />
      <br />
<?php	
	function tampiltabel($arr)
	{
		echo '<table width="500" border="1" cellspacing="0" cellpadding="3">';
		  for ($i=0;$i<count($arr);$i++)
		  {
		  echo '<tr>';
			  for ($j=0;$j<count($arr[$i]);$j++)
			  {
			    echo '<td>'.$arr[$i][$j].'</td>';
			  }
		  echo '</tr>';
		  }
		echo '</table>';
	}

	function tampilbaris($arr)
	{
		echo '<table width="500" border="1" cellspacing="0" cellpadding="3">';
		echo '<tr>';
			  for ($i=0;$i<count($arr);$i++)
			  {
			    echo '<td>'.$arr[$i].'</td>';
			  }
		echo "</tr>";
		echo '</table>';
	}

	function tampilkolom($arr)
	{
		echo '<table width="500" border="1" cellspacing="0" cellpadding="3">';
	  for ($i=0;$i<count($arr);$i++)
	  {
			echo '<tr>';
			    echo '<td>'.$arr[$i].'</td>';
			echo "</tr>";
	   }
		echo '</table>';
	}

if (!isset($_POST['button']))
{
?>	
<form name="form1" method="post" action=""><br>
  <table align="center" width="400" border="1" cellspacing="0" cellpadding="5">
  <tr>
  <td id="ignore" bgcolor="#DBEAF5" width="400" colspan="2"><div align="center"><strong><font size="2" face="Arial, Helvetica, sans-serif"><font size="2">BOBOT KRITERIA</font> </font></strong></div></td>
  <?php
    $q = mysqli_query($db, "select * from kriteria ORDER BY id_kriteria");
    while ($r = mysqli_fetch_array($q)) 
	{ 
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
  <table align="center" width="600" border="1" cellspacing="0" cellpadding="5">
  <tr>
  <td id="ignore" bgcolor="#DBEAF5" width="600" colspan="2"><div align="center"><strong><font size="2" face="Arial, Helvetica, sans-serif"><font size="2">PILIH ALTERNATIF DAN NILAI</font> </font></strong></div></td>
  <?php
    $q = mysqli_query($db, "select * from alternatif ORDER BY id_alternatif");
    while ($r = mysqli_fetch_array($q)) 
	{ 
	?>        
    <tr>
      <td width="50"> 
        <input id="alternatif<?php echo $r['id_alternatif']; ?>" name="alternatif<?php echo $r['id_alternatif']; ?>" type="checkbox" value="true" checked> <?php echo $r['nama_alternatif']; ?>
        </td>
	  <td width="350"> 
		<?php
		$querykriteria = mysqli_query($db, "select * from kriteria ORDER BY id_kriteria");
		while ($datakriteria = mysqli_fetch_array($querykriteria)) 
		{ 
			$querynilai = mysqli_query($db, "SELECT * FROM nilai WHERE id_alternatif = '$r[id_alternatif]' AND id_kriteria = '$datakriteria[id_kriteria]'");
			$datanilai = mysqli_fetch_array($querynilai);
		?>        		
		  - <?php echo $datakriteria['nama_kriteria']; ?> <select name="nilai_<?php echo $r['id_alternatif']; ?>_<?php echo $datakriteria['id_kriteria']; ?>" id="nilai_<?php echo $r['id_alternatif']; ?>_<?php echo $datakriteria['id_kriteria']; ?>">
			<option value=""></option>
			<?php
				$querypilihankriteria = mysqli_query($db, "SELECT * FROM pilihan_kriteria WHERE id_kriteria = '$datakriteria[id_kriteria]' ORDER BY id_kriteria, id_pilihan_kriteria");
				while ($datapilihankriteria = mysqli_fetch_array($querypilihankriteria))
				{
			?>
			<option value="<?php echo $datapilihankriteria['nilai_pilihan_kriteria']; ?>" <?php if ($datanilai['id_pilihan_kriteria'] == $datapilihankriteria['id_pilihan_kriteria']) { echo " selected"; } ?>><?php echo $datakriteria['nama_kriteria']; ?> - <?php echo $datapilihankriteria['nama_pilihan_kriteria']; ?> - Nilai: <?php echo $datapilihankriteria['nilai_pilihan_kriteria']; ?></option>
			<?php
				}
			?>
		  </select>
		  <br/>
		<?php
		}
		?>
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
}
else
{
?>
	<div id="perhitungan" style="display:none;">
		<br /> 
<?php
	$id_alternatif = array(); //"1", "2", "3", "4", "5");
	$nama_alternatif = array(); //"Mey", "Junia", "Julio", "Agus", "Septi");
	
	$queryalternatif = mysqli_query($db, "SELECT * FROM alternatif ORDER BY id_alternatif");
	$i=0;
	while ($dataalternatif = mysqli_fetch_array($queryalternatif))
	{
		if (@$_POST['alternatif'.$dataalternatif['id_alternatif']] == "true") {
			$id_alternatif[$i] = $dataalternatif['id_alternatif'];
			$nama_alternatif[$i] = $dataalternatif['nama_alternatif'];
			$i++;
		}
	}	
	
	$id_kriteria = array(); //"1", "2", "3", "4", "5");
	$nama_kriteria = array(); //"IPK", "Penghasilan Ortu", "Tanggungan Ortu", "Presensi", "Semester");
	$bobot_kriteria = array(); //0.25, 0.3, 0.2, 0.15, 0.1);

	$querykriteria = mysqli_query($db, "SELECT * FROM kriteria ORDER BY id_kriteria");
	$i=0;
	while ($datakriteria = mysqli_fetch_array($querykriteria))
	{
		$id_kriteria[$i] = $datakriteria['id_kriteria'];
		$nama_kriteria[$i] = $datakriteria['nama_kriteria'];
		$bobot_kriteria[$i] = @$_POST['bobot_kriteria_'.$datakriteria['id_kriteria']]; //$datakriteria['bobot_kriteria'];
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
	$i=0;
	while ($dataalternatif = mysqli_fetch_array($queryalternatif))
	{
		if (@$_POST['alternatif'.$dataalternatif['id_alternatif']] == "true") {
			$querykriteria = mysqli_query($db, "SELECT * FROM kriteria ORDER BY id_kriteria");
			$j=0;
			while ($datakriteria = mysqli_fetch_array($querykriteria))
			{
				//$querynilai = mysqli_query($db, "SELECT * FROM nilai WHERE id_alternatif = '$dataalternatif[id_alternatif]' AND id_kriteria = '$datakriteria[id_kriteria]'");
				//$datanilai = mysqli_fetch_array($querynilai);
				
				$matriks_nilai[$i][$j] = @$_POST['nilai_'.$dataalternatif['id_alternatif'].'_'.$datakriteria['id_kriteria']]; //$datanilai['nilai'];
				$j++;
			}
			$i++;
		}
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
	
	for($i=0;$i<count($nama_kriteria);$i++){
		for($j=0;$j<count($nama_alternatif);$j++){
			if (($j == 0) || ($nilai_max[$i] < $matriks_nilai[$j][$i])) {
				$nilai_max[$i] = $matriks_nilai[$j][$i];
			}
			if (($j == 0) || ($nilai_min[$i] > $matriks_nilai[$j][$i])) {
				$nilai_min[$i] = $matriks_nilai[$j][$i];
			}
		}
	}
	
	
	for($i=0;$i<count($nama_kriteria);$i++){
		$nilai_selisih[$i] = $nilai_max[$i] - $nilai_min[$i];
	}
	
	for($i=0;$i<count($nama_alternatif);$i++){
		for($j=0;$j<count($nama_kriteria);$j++){
			$matriks_normalisasi_nilai[$i][$j] = ($matriks_nilai[$i][$j] - $nilai_min[$j]) / $nilai_selisih[$j];
		}
	}
	
	for($i=0;$i<count($nama_alternatif);$i++){
		for($j=0;$j<count($nama_kriteria);$j++){
			$matriks_kriteria_bobot[$i][$j] = $matriks_normalisasi_nilai[$i][$j] * $bobot_kriteria[$j];
		}
	}
	
	for($i=0;$i<count($nama_alternatif);$i++){
		$hasil_akhir[$i] = 0;
		for($j=0;$j<count($nama_kriteria);$j++){
			$hasil_akhir[$i] = $hasil_akhir[$i] + $matriks_kriteria_bobot[$i][$j];
		}
	}
	
	for($i=0;$i<count($nama_alternatif);$i++){
		$id_alternatif_rangking[$i] = $id_alternatif[$i];
		$nama_alternatif_rangking[$i] = $nama_alternatif[$i];
		$hasil_akhir_rangking[$i] = $hasil_akhir[$i];
	}
	
	for($i=0;$i<count($nama_alternatif);$i++){
		for($j=$i+1;$j<count($nama_alternatif);$j++){
			if ($hasil_akhir_rangking[$i] < $hasil_akhir_rangking[$j]){
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
<input type="button" value="Perhitungan" onclick="document.getElementById('perhitungan').style.display='block';"/>
<br />
<br />
Hasil Analisa Menggunakan Sistem Pendukung Keputusan (SPK) Metode MAUT (Multi Attribute Utility Theory)<br/>
<br />
<table width="500" border="0" cellspacing="1" cellpadding="3" bgcolor="#000099">
	<tr>
    	<td bgcolor="#FFFFFF">Rangking</td>
    	<td bgcolor="#FFFFFF">Nama Alternatif</td>
    	<td bgcolor="#FFFFFF">Nilai Akhir</td>
    </tr>
<?php
	for ($i=0;$i<count($nama_alternatif_rangking);$i++)
	{	
?>
    <tr>
    	<td bgcolor="#FFFFFF"><?php echo ($i+1); ?></td>
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
<?php
}
?>
<br />
</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="47%" height="35" align="left"><strong>&copy; 2019 ContohProgram.com</strong></td>
        <td width="53%" height="35" align="right"><strong><a href="http://contohprogram.com" target="_blank">Kontak</a> | <a href="http://contohprogram.com/maut-php-mysql-source-code.php" target="_blank">About</a></strong></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>