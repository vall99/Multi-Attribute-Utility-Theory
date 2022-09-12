<?php
session_start();
include("koneksi.php");
if (@$_SESSION['userlogin'] == "") {
  header("location:login.php?pesan=Belum Login");
  exit;
}
if (isset($_POST['button'])) {
  $querylogin = mysqli_query($db, "SELECT * FROM login WHERE username = '$_POST[username]' AND password = '$_POST[lama]'");
  if ($datalogin = mysqli_fetch_array($querylogin)) {
    if ($_POST['baru'] == $_POST['konfirmasi']) {
      mysqli_query($db, "UPDATE login SET password = '$_POST[baru]' WHERE username = '$_POST[username]'");
      header("location:admin.php");
    } else {
      header("location:ganti-password.php?pesan=Password Baru Tidak Sama");
    }
  } else {
    header("location:ganti-password.php?pesan=Password Lama Salah");
  }
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
    <table class="table-bordered" align="center" style="border-color:black">
      <thead>
        <tr>
          <th colspan="2" bgcolor=#0D6EFD style="text-align: center;"><a style="color: white;  font-size:15px;">Ganti Password</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td width="147" bgcolor="#FFFFFF">Username</td>
          <td width="180" bgcolor="#FFFFFF"><input type="text" name="username" id="username" value="<?php echo $_SESSION['userlogin']; ?>" readonly /></td>
        </tr>
      </tbody>
      <tbody>
        <tr>
          <td bgcolor="#FFFFFF">Password Lama</td>
          <td bgcolor="#FFFFFF"><input type="password" name="lama" id="lama" /></td>
        </tr>
      </tbody>
      <tbody>
        <tr>
          <td bgcolor="#FFFFFF">Password Baru</td>
          <td bgcolor="#FFFFFF"><input type="password" name="baru" id="baru" /></td>
        </tr>
      </tbody>
      <tbody>
        <tr>
          <td bgcolor="#FFFFFF">Konfirmasi Password</td>
          <td bgcolor="#FFFFFF"><input type="password" name="konfirmasi" id="konfirmasi" /></td>
        </tr>
      </tbody>
      <tbody>
        <tr>
          <td bgcolor="#FFFFFF">&nbsp;</td>
          <td bgcolor="#FFFFFF"><input type="submit" name="button" id="button" value="Simpan" /></td>
        </tr>
      </tbody>
    </table>
  </form>
</body>

</html>