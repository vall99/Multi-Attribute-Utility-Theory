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
  <br>
  <br>
  <h3 style="text-align: center;"><b>Data Alternatif</b>
    <h3 />

    <!-- tabel -->
    <table class="table-bordered" align="center" style="border-color:black" width="428">
      <thead>
        <tr>
          <th bgcolor=#0D6EFD><a style="color: white; font-size:15px">ID</th>
          <th bgcolor=#0D6EFD><a style="color: white; font-size:15px">Nama Alternatif</th>
          <th bgcolor=#0D6EFD><a href=" add-alternatif.php" style="color: white; font-size:15px">Add</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $queryalternatif = mysqli_query($db, "SELECT * FROM alternatif ORDER BY id_alternatif");
        while ($dataalternatif = mysqli_fetch_array($queryalternatif)) {
        ?>
          <tr>
            <td style="font-size:18px"><?php echo $dataalternatif['id_alternatif']; ?> </td>
            <td style="font-size:18px"><?php echo $dataalternatif['nama_alternatif']; ?></td>
            <td style="font-size:18px">
              <a href=" edit-alternatif.php?id_alternatif=<?php echo $dataalternatif['id_alternatif']; ?>">Edit</a>/<a href="del-alternatif.php?id_alternatif=<?php echo $dataalternatif['id_alternatif']; ?> ">Del</a>
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