<?php
include('../../database/config.php');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <link rel="stylesheet" type="text/css" href="assets/css/main.css">
  <link rel='shortcut icon' href='../../assets/icon/favicon.png'>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SMK</title>
</head>

<body bgcolor="#2bc831">

  <h1 class="judul">
    SMK INDONESIA
  </h1>
  <hr>

  <div class="menu">
    <a href="../../index.php"><button class="btnatas-warning">◀</button></a>
    <a href="index.php"><button class="btnatas-success">HOME</button></a>
    <a href="nilai.php"><button class="btnatas-success">LIHAT NILAI</button></a>
    <a href="action/logout.php"><button class="btnatas-danger" style="float: right;">LOGOUT</button></a>
  </div>

  <div class="menu-kiri-1">
    <div class="font" style="text-align: center;">
      <fieldset>
        <legend>PAGE SISWA -- ANDA LOGIN SEBAGAI</legend>
          <div class="notif-success">
            <?php echo $_SESSION['nama_siswa']; ?>
          </div>
      </fieldset>
    </div>
  </div>
