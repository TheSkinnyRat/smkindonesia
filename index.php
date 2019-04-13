<?php session_start() ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <link rel="stylesheet" type="text/css" href="assets/css/main.css">
  <link rel='shortcut icon' href='assets/icon/favicon.png'>
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
    <a href="index.php"><button class="btnatas-success">HOME</button></a>
    <a href="#" target="_blank"><button class="btnatas-warning">SOURCE CODE / GITHUB</button></a>
  </div>

  <div class="menu-kiri-1">
    <div class="font">
      <fieldset>
        <legend><?php if(isset($_SESSION['login'])) echo "ANDA LOGIN SEBAGAI"; else echo "LOGIN"; ?></legend>
        <?php
        if (isset($_SESSION['login'])){ ?>
          <div class="notif-success">
            <?php echo $_SESSION['login']; ?>
          </div>
          <a href="page/<?php echo $_SESSION['login']; ?>/index.php"><button class="button button1">Beranda</button></a>
          <a href="action/logout.php"><button class="button button-danger">Logout</button></a>
        <?php }else{ ?>
          <button onclick="show_login_siswa()" class="button button1">Siswa</button>
          <button onclick="show_login_guru()" class="button button-danger">Guru</button>
          <hr>

          <div id="title_login">
            <?php
            if (isset($_SESSION['notif'])){
              echo $_SESSION['notif'];
              unset($_SESSION['notif']);
            }else{ ?>
              Pilih Menu Login Di Atas <hr>
              <div style="text-align: left">
                -- Login dengan Username: 1 , Password: 123 (guru/siswa) <br>
                -- Jangan Ganti Username / Password (guru/siswa)<hr>
                -- Laporkan Bug <a style="background-color: #4caf50; color: black;" target="_blank" href="https://api.whatsapp.com/send?phone=6281283854955&text=*WEB SMK INDONESIA*%0ALaporan%20Bug%3A%20">DISINI (Whatsapp)</a>
              </div>
            <?php } ?>
          </div>

          <div id="login_process" style="display: none;">
            <div class="notif-warning">
              MEMPROSES...
            </div>
          </div>

          <div id="login_siswa" style="display: none;">
            Login Siswa
            <form action="action/login_siswa.php" method="post" onsubmit="show_login_process()">
              <pre>
NIS      : <input type="number" name="nis" required>
Password : <input type="password" name="password" required>
<button class="button button-success" type="submit" name="button">LOGIN</button>
              </pre>
            </form>
          </div>

          <div id="login_guru" style="display: none;">
            Login Guru
            <form action="action/login_guru.php" method="post" onsubmit="show_login_process()">
              <pre>
NIP      : <input type="number" name="nip" value="" required>
Password : <input type="password" name="password" value="" required>
<button class="button button-success" type="submit" name="button">LOGIN</button>
              </pre>
            </form>
          </div>

        <?php } ?>

      </fieldset>
    </div>
  </div>

  <div class="menu-kanan">
    <img src="assets/img/home.jpg" width="100%" height="100%">
  </div>

  <div class="menu-kiri-2">
    <img src="assets/img/login.png" width="100%" height="100%">
  </div>

  <div class="footer">
    <div class="font">
      <?php echo base64_decode("JmNvcHk7IDIwMTkgLSBSIC8gQ3JlYXRlZCBBbmQgRGV2ZWxvcGVkIEJ5IDxhIHN0eWxlPSdjb2xvcjogIzMxZDU0NjsnIGhyZWY9J2h0dHBzOi8vaW5zdGFncmFtLmNvbS90aGUuc2tpbm55LnJhdCcgdGFyZ2V0PSdfYmxhbmsnPlI8L2E+IC8gU3VwcG9ydGluZyBXZWJzaXRlOiA8YSBzdHlsZT0nY29sb3I6ICMzMWQ1NDY7JyBocmVmPSdodHRwczovL3NraW5ueXJhdC50aycgdGFyZ2V0PSdfYmxhbmsnPlNraW5ueVJhdC50azwvYT4=") ?>
    </div>
  </div>

</body>

<script type="text/javascript">
  login_siswa = document.getElementById('login_siswa');
  login_guru = document.getElementById('login_guru');
  title_login = document.getElementById('title_login');

  function show_login_siswa(){
    login_siswa.style.display = 'block';
    login_guru.style.display = 'none';
    title_login.style.display = 'none';
  }

  function show_login_guru(){
    login_siswa.style.display = 'none';
    login_guru.style.display = 'block';
    title_login.style.display = 'none';
  }

  function show_login_process(){
    login_siswa.style.display = 'none';
    login_guru.style.display = 'none';
    title_login.style.display = 'none';
    login_process.style.display = "block";
  }

</script>

</html>
