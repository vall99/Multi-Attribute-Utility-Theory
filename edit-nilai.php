<?php
session_start();
include("koneksi.php");
if (@$_SESSION['userlogin'] == "") {
  header("location:login.php?pesan=Belum Login");
  exit;
}
if (isset($_POST['button'])) {
  //$querykriteria = mysqli_query($db, "SELECT * FROM kriteria WHERE id_kriteria = '$_POST[id_kriteria]'");
  //$datakriteria = mysqli_fetch_array($querykriteria);
  $querypilihankriteria = mysqli_query($db, "SELECT * FROM pilihan_kriteria WHERE id_SubKriteria = '$_POST[id_SubKriteria]'");
  $datapilihankriteria = mysqli_fetch_array($querypilihankriteria);
  mysqli_query($db, "UPDATE nilai SET id_alternatif='$_POST[id_alternatif]', id_SubKriteria='$_POST[id_SubKriteria]', id_kriteria='$datapilihankriteria[id_kriteria]', nilai='$datapilihankriteria[nilai_SubKriteria]' WHERE id_nilai = '$_POST[id_nilai]'");
  header("location:nilai.php");
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
    <table width="617" class="table-bordered" align="center" style="border-color:black">
      <thead>
        <tr>
          <th colspan="2" bgcolor=#0D6EFD style="text-align: center;"><a style="color: white;  font-size:15px;">Edit Data Nilai</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $querynilai = mysqli_query($db, "SELECT * FROM nilai WHERE id_nilai = '$_GET[id_nilai]'");
        $datanilai = mysqli_fetch_array($querynilai);
        ?>
        <form id="form1" name="form1" method="post" action="">
          <table width="450" align="center" border="1" cellpadding="5" cellspacing="1" bgcolor="black">
            <tr>
              <td bgcolor="#FFFFFF">ID Nilai</td>
              <td bgcolor="#FFFFFF"><input type="text" name="id_nilai" id="id_nilai" readonly value="<?php echo $datanilai['id_nilai']; ?>" /></td>
            </tr>
            <tr>
              <td width="175" bgcolor="#FFFFFF"> Alternatif</td>
              <td width="593" bgcolor="#FFFFFF"><select name="id_alternatif" id="id_alternatif">
                  <option value=""></option>
                  <?php
                  $queryalternatif = mysqli_query($db, "SELECT * FROM alternatif ORDER BY id_alternatif");
                  while ($dataalternatif = mysqli_fetch_array($queryalternatif)) {
                  ?>
                    <option value="<?php echo $dataalternatif['id_alternatif']; ?>" <?php if ($datanilai['id_alternatif'] == $dataalternatif['id_alternatif']) {
                                                                                      echo " selected";
                                                                                    } ?>><?php echo $dataalternatif['nama_alternatif']; ?></option>
                  <?php
                  }
                  ?>
                </select></td>
            </tr>
            <tr>
              <td bgcolor="#FFFFFF">Pilihan SubKriteria / Nilai</td>
              <td width="593" bgcolor="#FFFFFF"><select name="id_SubKriteria" id="id_SubKriteria">
                  <option value=""></option>
                  <?php
                  $querypilihankriteria = mysqli_query($db, "SELECT * FROM pilihan_kriteria ORDER BY id_kriteria, id_SubKriteria");
                  while ($datapilihankriteria = mysqli_fetch_array($querypilihankriteria)) {
                    $querykriteria = mysqli_query($db, "SELECT * FROM kriteria WHERE id_kriteria = '$datapilihankriteria[id_kriteria]'");
                    $datakriteria = mysqli_fetch_array($querykriteria);
                  ?>
                    <option value="<?php echo $datapilihankriteria['id_SubKriteria']; ?>" <?php if ($datanilai['id_SubKriteria'] == $datapilihankriteria['id_SubKriteria']) {
                                                                                            echo " selected";
                                                                                          } ?>><?php echo $datakriteria['nama_kriteria']; ?> - <?php echo $datapilihankriteria['nama_SubKriteria']; ?> - Nilai: <?php echo $datapilihankriteria['nilai_SubKriteria']; ?></option>
                  <?php
                  }
                  ?>
                </select></td>
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