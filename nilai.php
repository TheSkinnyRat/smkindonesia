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
    SMK
  </h1>
  <hr>

  <div class="menu">
    <a href="index.php"><button class="btnatas-success">HOME</button></a>
    <a href="nilai.php"><button class="btnatas-success">NILAI SISWA</button></a>
    <a href="https://github.com/TheSkinnyRat/db_smk" target="_blank"><button class="btnatas-warning">SOURCE CODE / GITHUB</button></a>
    <a href="https://db-smk.000webhostapp.com/" target="_blank"><button class="btnatas-warning">ONLINE WEBSITE</button></a>
  </div>

  <div class="sidebar">
    <div class="font">
      <fieldset>
        <legend><?php if(isset($_SESSION['login'])) echo "ANDA LOGIN SEBAGAI"; else echo "LOGIN"; ?></legend>
        <?php
        if (isset($_SESSION['login'])){ ?>
          <div class="notif-success">
            <?php echo $_SESSION['nama']; ?>
          </div>
          <a href="page/<?php echo $_SESSION['login']; ?>/index.php"><button class="button button1">Beranda</button></a>
          <a href="action/logout.php"><button class="button button-danger">Logout</button></a>
        <?php }else{ ?>
          <button onclick="show_login_siswa()" class="button button1">Siswa</button>
          <button onclick="show_login_guru()" class="button button-info">Guru</button>
          <button onclick="show_login_admin()" class="button button-danger">Admin</button>
          <hr>

          <div id="title_login">
            <?php
            if (isset($_SESSION['notif'])){
              echo $_SESSION['notif'];
              unset($_SESSION['notif']);
            }else{ ?>
              Pilih Menu Login Di Atas
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

          <div id="login_admin" style="display: none;">
            Login Admin
            <form action="action/login_admin.php" method="post" onsubmit="show_login_process()">
              <pre>
Username : <input type="text" name="username" value="" required>
Password : <input type="password" name="password" value="" required>
<button class="button button-success" type="submit" name="button">LOGIN</button>
              </pre>
            </form>
          </div>
        <?php } ?>

      </fieldset>
    </div>
  </div>

  <div class="content">
    <div style="padding: 2%">

    <?php include('database/config.php'); ?>
    <!-- WARNING START CONTENT ----------------------------------------------------------- -->
    <?php
    $query_pengajar = mysql_query("SELECT * FROM tbl_pengajar LEFT JOIN tbl_mapel ON tbl_pengajar.id_mapel=tbl_mapel.id_mapel LEFT JOIN tbl_kelas ON tbl_pengajar.id_kelas=tbl_kelas.id_kelas ");
    if (isset($_POST['go'])) {
    	$id_pengajar = $_POST['id_pengajar'];
    	$query_kelas = mysql_query("SELECT * FROM tbl_pengajar where id_pengajar=$id_pengajar");
    	$data_kelas = mysql_fetch_assoc($query_kelas);
    	$id_kelas = $data_kelas['id_kelas'];

    	$query = mysql_query("SELECT * FROM tbl_siswa LEFT JOIN tbl_kelas ON tbl_siswa.id_kelas=tbl_kelas.id_kelas where tbl_siswa.id_kelas=$id_kelas");
    	$data_row = mysql_num_rows($query);
    	$query_temp = mysql_query("SELECT * FROM tbl_pengajar LEFT JOIN tbl_mapel ON tbl_pengajar.id_mapel=tbl_mapel.id_mapel LEFT JOIN tbl_kelas ON tbl_pengajar.id_kelas=tbl_kelas.id_kelas where tbl_pengajar.id_pengajar=$id_pengajar");
    	$data_temp = mysql_fetch_assoc($query_temp);
    }
    ?>

    <div style="font-size: 25pt;">
			<center>DATA NILAI</center>
		</div><hr>

		<form action="nilai.php" method="post" enctype="multipart/form-data">
MAPEL / KELAS   : <select name="id_pengajar" required>
              <?php while ($data_pengajar = mysql_fetch_assoc($query_pengajar)) { ?>
                <option value="<?php echo $data_pengajar['id_pengajar']; ?>" <?php if(isset($_POST['go']) && $data_pengajar['id_pengajar'] == $id_pengajar) echo "selected"; ?>>
									<?php echo $data_pengajar['nama_mapel']; ?> / <?php echo $data_pengajar['kelas'] ?>
								</option>
              <?php } ?>
              </select>
							<button class="button button1" type="submit" name="go">CARI</button>
		</form>

		<hr>

		<?php if(!isset($_POST['go']) or $data_temp['nama_mapel'] == NULL){ ?>
			-- Pilih Mapel / Kelas Pada Menu Diatas --
		<?php } else { ?>
			Menampilkan Data Nilai, Mata Pelajaran <font style="color: red; text-transform: uppercase;"><?php echo $data_temp['nama_mapel'] ?></font> Kelas <font style="color: blue; text-transform: uppercase;"><?php echo $data_temp['kelas'] ?></font>
			<?php if (isset($_SESSION['notif'])) echo $_SESSION['notif']; unset($_SESSION['notif']);?>
			<br><br>
			<table style="text-align: center;" border="3" cellpadding="4" width="100%" height="auto">
				<tr>
					<th>ID NILAI</th>
					<th>MAPEL</th>
					<th>NAMA SISWA</th>
					<th>KELAS</th>
					<th>NILAI HARIAN</th>
					<th>NILAI UTS</th>
					<th>NILAI UAS</th>
					<th>RATA-RATA</th>
				</tr>
				<?php if(!$data_row){ ?>
					<td colspan="8"><i>-- No Data Entry --</i></td>
				<?php } ?>
				<?php while ($data = mysql_fetch_assoc($query)) {
					$nis = $data['nis'];
					$query_nilai = mysql_query("SELECT * FROM tbl_nilai where id_pengajar=$id_pengajar and nis=$nis ");
					$data_nilai = mysql_fetch_assoc($query_nilai); ?>
				<tr>
						<td>
							<?php if($data_nilai) echo $data_nilai['id_nilai']; else echo "-"  ?>
						</td>
						<td>
							<?php echo $data_temp['nama_mapel'];  ?>
						</td>
						<td>
							<?php echo $data['nama'];  ?>
						</td>
						<td>
							<?php echo $data['kelas'];  ?>
						</td>
						<td>
							<?php if($data_nilai) echo $data_nilai['harian']; else echo "-" ?>
						</td>
						<td>
							<?php if($data_nilai) echo $data_nilai['uts']; else echo "-" ?>
						</td>
						<td>
							<?php if($data_nilai) echo $data_nilai['uas']; else echo "-" ?>
						</td>
						<td>
							<?php if($data_nilai) echo ($data_nilai['harian']+$data_nilai['uts']+$data_nilai['uas'])/3; else echo "-" ?>
						</td>
				</tr>
				<?php
	}
	?>
			</table>
		<?php } ?>
    </div>
  </div>

  <div class="sidebar-img">
    <img src="assets/img/login.png">
  </div>

  <div class="footer">
    <div class="font">
      <?php echo base64_decode("JmNvcHk7IDIwMTkgLSBAVGhlU2tpbm55UmF0IC8gQ3JlYXRlZCBBbmQgRGV2ZWxvcGVkIEJ5IDxhIHN0eWxlPSdjb2xvcjogIzMxNjRkNTsnIGhyZWY9J2h0dHBzOi8vaW5zdGFncmFtLmNvbS90aGUuc2tpbm55LnJhdCcgdGFyZ2V0PSdfYmxhbmsnPkBUaGUuU2tpbm55LlJhdDwvYT4gLyBTdXBwb3J0aW5nIFdlYnNpdGU6IDxhIHN0eWxlPSdjb2xvcjogIzMxNjRkNTsnIGhyZWY9J2h0dHBzOi8vc2Nob29sLW1hdGUudGsnIHRhcmdldD0nX2JsYW5rJz5TY2hvb2wtTWF0ZS50azwvYT4gLCA8YSBzdHlsZT0nY29sb3I6ICMzMTY0ZDU7JyBocmVmPSdodHRwczovL3NhcnByYXMudGsnIHRhcmdldD0nX2JsYW5rJz5TYXJwcmFzLnRrPC9hPg==") ?>
    </div>
  </div>

</body>

<script type="text/javascript">
  login_siswa = document.getElementById('login_siswa');
  login_guru = document.getElementById('login_guru');
  login_admin = document.getElementById('login_admin');
  title_login = document.getElementById('title_login');

  function show_login_siswa(){
    login_siswa.style.display = 'block';
    login_guru.style.display = 'none';
    login_admin.style.display = 'none';
    title_login.style.display = 'none';
  }

  function show_login_guru(){
    login_siswa.style.display = 'none';
    login_guru.style.display = 'block';
    login_admin.style.display = 'none';
    title_login.style.display = 'none';
  }

  function show_login_admin(){
    login_siswa.style.display = 'none';
    login_guru.style.display = 'none';
    login_admin.style.display = 'block';
    title_login.style.display = 'none';
  }

  function show_login_process(){
    login_siswa.style.display = 'none';
    login_guru.style.display = 'none';
    login_admin.style.display = 'none';
    title_login.style.display = 'none';
    login_process.style.display = "block";
  }

</script>

</html>
