<?php
include("koneksi.php");
if (isset($_POST['button'])) {
  $querylogin = mysqli_query($db, "SELECT * FROM login WHERE username = '$_POST[username]' AND password = '$_POST[password]'");
  if ($datalogin = mysqli_fetch_array($querylogin)) {
    session_start();
    $_SESSION['userlogin'] = $datalogin['username'];
    header("location:admin.php");
  } else {
    header("location:login.php?pesan=Login Gagal");
  }
}
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
      <td height="35" bgcolor="#FFFFFF"><span class="style2"><a href="index.php">Home</a> | <a href="login.php">Login</a></span></td>
    </tr>
    <tr>
      <td align="center" valign="top" bgcolor="#FFFFFF"><br />
        <strong>Login</strong><br />
        <br />
        <form id="form1" name="form1" method="post" action="">
          <table width="300" border="0" cellpadding="5" cellspacing="1" bgcolor="#000099">
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