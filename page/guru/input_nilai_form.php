<?php session_start();
if ($_SESSION && $_SESSION['login'] == 'guru') {
    ?>
<?php require_once('assets/header.php'); ?>
<!-- WARNING START CONTENT ----------------------------------------------------------- -->
<?php
$nis = $_POST['nis'];
$id_mengajar = $_POST['id_mengajar'];

// UNTUK AMBIL NAMA SISWA, KELAS, JURUSAN
$q_siswa = mysql_query("SELECT * FROM siswa
                        LEFT JOIN kelas ON siswa.id_kelas = kelas.id_kelas
                        LEFT JOIN jurusan ON kelas.id_jurusan = jurusan.id_jurusan
                        where siswa.nis='$nis' ");
$d_siswa = mysql_fetch_assoc($q_siswa);

// UNTUK AMBIL NAMA MAPEL
$q_mengajar = mysql_query("SELECT * FROM mengajar
                          LEFT JOIN mapel ON mengajar.id_mapel=mapel.id_mapel
                          where id_mengajar='$id_mengajar' ");
$d_mengajar = mysql_fetch_assoc($q_mengajar);

if(isset($_POST['edit'])){
  $query = mysql_query("SELECT * FROM nilai where nis='$nis' and id_mengajar='$id_mengajar' ");
  $data = mysql_fetch_assoc($query);
}
?>

<div class="menu-kanan">
	<div class="font">

    <div style="font-size: 25pt;">
      FORM INPUT NILAI
		</div><hr>
		<form action="action/input_nilai_act.php" method="post" enctype="multipart/form-data">
			<pre>
NIS SISWA     : <input type="text" value="<?php echo $d_siswa['nis']; ?>" disabled><br>
NAMA SISWA    : <input type="text" value="<?php echo $d_siswa['nama_siswa']; ?>" disabled><br>
MAPEL         : <input type="text" value="<?php echo $d_mengajar['nama_mapel']; ?>" disabled><br>
NILAI HARIAN  : <input type="number" name="uh" value="<?php if(isset($_POST['edit'])) echo $data['uh']; ?>" required><br>
NILAI UTS     : <input type="number" name="uts" value="<?php if(isset($_POST['edit'])) echo $data['uts']; ?>" required><br>
NIALI UAS     : <input type="number" name="uas" value="<?php if(isset($_POST['edit'])) echo $data['uas']; ?>" required><br>
			</pre>
      <input type="hidden" name="na" value="0">
      <input type="hidden" name="id_mengajar" value="<?php echo $id_mengajar ?>">
      <input type="hidden" name="nis" value="<?php echo $nis ?>">
      <input type="hidden" name="id_nilai" value="<?php if(isset($_POST['edit'])) echo $data['id_nilai']; else echo '0'; ?>">
			<button class="button button1" type="submit" name="<?php if(isset($_POST['edit'])) echo 'edit'; else echo 'tambah'; ?>">SIMPAN</button>
			<button class="button button-info" type="reset">RESET</button>
		</form>
	</div>
</div>

<!-- WARNING END CONTENT ----------------------------------------------------------- -->
<?php require_once('assets/footer.php'); ?>
<?php
} else {
        ?>
<script language="javascript">
	document.location = '../../index.php'
</script>
<?php
    } ?>
