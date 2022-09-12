<?php
include("koneksi.php");
if (isset($_POST['button'])) {
  $querylogin = mysqli_query($db, "SELECT * FROM login WHERE username = '$_POST[username]' AND password = '$_POST[password]'");
  if ($datalogin = mysqli_fetch_array($querylogin)) {
    session_start();
    $_SESSION['userlogin'] = $datalogin['username'] == 'admin';
    header("location:admin.php");
  } elseif ($datalogin = mysqli_fetch_array($querylogin)) {
    session_start();
    $_SESSION['userlogin'] = $datalogin['username'] == 'pusat';
    header("location:pusat.php");
  } else {
    header("location:login.php?pesan=Login Gagal");
  }
}
?>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Sistem Pendukung Keputusan (SPK) Metode MAUT (Multi Attribute Utility Theory)</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body align="center" bgcolor="#7A91FA">
  <span class="style1">Sistem Pendukung Keputusan (SPK) Metode MAUT (Multi Attribute Utility Theory)</span>
  <h2>Selamat Datang</h2>
  <H1>KOPERASI PERUM JASA TIRTA (PJT II) KARYA BHAKTI RAHARJA </H1>
  <img src="2.png" style="width: 150px; height: 150px;" />
  <br>
  <br>
  <br>
  <form id="form1" name="form1" method="post" action="">
    <table width="300" align="center" border="3" cellpadding="5" cellspacing="2" bgcolor="black">
      <tr>
        <td bgcolor="#FFFFFF">Username</td>
        <td bgcolor="#FFFFFF"><input type="text" name="username" id="username" /></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF">Password</td>
        <td bgcolor="#FFFFFF"><input type="password" name="password" id="password" /></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF">&nbsp;</td>
        <td bgcolor="#FFFFFF"><input type="submit" name="button" id="button" value="Login" /></td>
      </tr>
    </table>
  </form>
</body>

</html>