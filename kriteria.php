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

<body align="center" bgcolor="#7A91FA">

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
  <h3 style="text-align: center;">Data Kriteria
    <h3 />
    <!-- tabel -->
    <table class="table-bordered" align="center" style="border-color:black" width="700">
      <thead>
        <tr>
          <th bgcolor=#0D6EFD><a style="color: white; font-size:15px">ID Kriteria</th>
          <th bgcolor=#0D6EFD><a style="color: white; font-size:15px">Nama Kriteria</th>
          <th bgcolor=#0D6EFD><a style="color: white; font-size:15px">Bobot Kriteria</th>
          <th bgcolor=#0D6EFD><a href=" add-kriteria.php" style="color: white; font-size:15px">Add</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $querykriteria = mysqli_query($db, "SELECT * FROM kriteria ORDER BY id_kriteria");
        while ($datakriteria = mysqli_fetch_array($querykriteria)) {
        ?>
          <tr>
            <td style="font-size:18px"><?php echo $datakriteria['id_kriteria']; ?> </td>
            <td style="font-size:18px"><?php echo $datakriteria['nama_kriteria']; ?></td>
            <td style="font-size:18px"><?php echo $datakriteria['bobot_kriteria']; ?></td>
            <td style="font-size:18px">
              <a href="edit-kriteria.php?id_kriteria=<?php echo $datakriteria['id_kriteria']; ?>">Edit</a>/ <a href="del-kriteria.php?id_kriteria=<?php echo $datakriteria['id_kriteria']; ?>">Del</a>
            </td>
          </tr>
        <?php
        }
        ?>

      </tbody>
    </table>
    <!-- Endtabel -->

</body>

</html>