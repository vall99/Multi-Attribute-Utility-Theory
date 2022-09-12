<?php
session_start();
include("koneksi.php");
if (@$_SESSION['userlogin'] == "") {
  header("location:login.php?pesan=Belum Login");
  exit;
}
if (isset($_POST['button'])) {
  mysqli_query($db, "UPDATE pilihan_kriteria SET nama_SubKriteria='$_POST[nama_SubKriteria]', id_kriteria='$_POST[id_kriteria]', nilai_SubKriteria='$_POST[nilai_SubKriteria]' WHERE id_SubKriteria='$_POST[id_SubKriteria]'");
  header("location:pilihan-kriteria.php");
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
            <a class="nav-link active" aria-current="page" href="admin.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="alternatif.php">Alternatif</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="kriteria.php">Kriteria</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="pilihan-kriteria.php">SubKriteria</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="nilai.php">Nilai</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="konsultasi-maut-php-mysql.php">Analisis</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="ganti-password.php">Ganti Password</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="logout.php">Logout@ <?php echo $_SESSION['userlogin']; ?></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Endnavbar -->

  <br>
  <br>
  <form id="form1" name="form1" method="post" action="">
    <table width="450" class="table-bordered" align="center" style="border-color:black">
      <thead>
        <tr>
          <th colspan="2" bgcolor=#0D6EFD style="text-align: center;"><a style="color: white;  font-size:15px;">Edit Data SubKriteria</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $querypilihankriteria = mysqli_query($db, "SELECT * FROM pilihan_kriteria WHERE id_SubKriteria = '$_GET[id_SubKriteria]'");
        $datapilihankriteria = mysqli_fetch_array($querypilihankriteria);
        ?>
        <form id="form1" name="form1" method="post" action="">
          <table width="450" align="center" border="1" cellpadding="5" cellspacing="1" bgcolor="black">
            <tr>
              <td bgcolor="#FFFFFF">ID Pilihan SubKriteria</td>
              <td bgcolor="#FFFFFF"><input type="text" name="id_SubKriteria" id="id_SubKriteria" readonly value="<?php echo $datapilihankriteria['id_SubKriteria']; ?>" /></td>
            </tr>
            <tr>
              <td width="128" bgcolor="#FFFFFF">Nama Pilihan Kriteria</td>
              <td width="249" bgcolor="#FFFFFF"><input type="text" name="nama_SubKriteria" id="nama_SubKriteria" value="<?php echo $datapilihankriteria['nama_SubKriteria']; ?>" /></td>
            </tr>
            <tr>
              <td bgcolor="#FFFFFF">Kriteria</td>
              <td bgcolor="#FFFFFF"><select name="id_kriteria" id="id_kriteria">
                  <option value=""></option>
                  <?php
                  $querykriteria = mysqli_query($db, "SELECT * FROM kriteria ORDER BY id_kriteria");
                  while ($datakriteria = mysqli_fetch_array($querykriteria)) {
                  ?>
                    <option value="<?php echo $datakriteria['id_kriteria']; ?>" <?php if ($datapilihankriteria['id_kriteria'] == $datakriteria['id_kriteria']) {
                                                                                  echo " selected";
                                                                                } ?>><?php echo $datakriteria['nama_kriteria']; ?></option>
                  <?php
                  }
                  ?>
                </select></td>
            </tr>
            <tr>
              <td bgcolor="#FFFFFF">Nilai Pilihan SubKriteria</td>
              <td bgcolor="#FFFFFF"><input type="text" name="nilai_SubKriteria" id="nilai_SubKriteria" value="<?php echo $datapilihankriteria['nilai_SubKriteria']; ?>" /></td>
            </tr>
      </tbody>
      <tr>
        <td bgcolor="#FFFFFF">&nbsp;</td>
        <td bgcolor="#FFFFFF"><input type="submit" name="button" id="button" value="Simpan" /></td>
      </tr>
      <tbody>
    </table>
  </form>
</body>

</html>