<?php session_start();
if ($_SESSION && $_SESSION['login'] == 'guru') {
    ?>
<?php require_once('assets/header.php'); ?>
<!-- WARNING START CONTENT ----------------------------------------------------------- -->
<?php
$query_kelas = mysql_query("SELECT * FROM kelas LEFT JOIN jurusan ON kelas.id_jurusan = jurusan.id_jurusan");
if(isset($_POST['edit'])){
  $nis = $_POST['nis'];
  $query = mysql_query("SELECT * FROM siswa where nis='$nis' ");
  $data = mysql_fetch_assoc($query);
}
?>

<div class="menu-kanan">
	<div class="font">

    <div style="font-size: 25pt;">
      FORM DATA SISWA
		</div><hr>
		<form action="action/siswa_act.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="nis" value="<?php if(isset($_POST['edit'])) echo $data['nis']; else echo "0"; ?>" required>
			<pre>
NIS           : <input type="text" value="<?php if(isset($_POST['edit'])) echo $data['nis']; else echo "AUTO"; ?>" disabled><br>
PASSWORD      : <input type="password" name="password" value="<?php if(isset($_POST['edit'])) echo $data['password']; ?>" required><br>
NAMA SISWA    : <input type="text" name="nama_siswa" value="<?php if(isset($_POST['edit'])) echo $data['nama_siswa']; ?>" required><br>
ALAMAT        : <input type="text" name="alamat" value="<?php if(isset($_POST['edit'])) echo $data['alamat']; ?>" required><br>
KELAS         : <select name="id_kelas" required>
                  <?php while ($data_kelas = mysql_fetch_assoc($query_kelas)) { ?>
                    <option value="<?php echo $data_kelas['id_kelas']; ?>" <?php if(isset($_POST['edit']) && $data['id_kelas'] == $data_kelas['id_kelas']) echo "selected"; ?>><?php echo $data_kelas['nama_kelas']; ?> <?php echo $data_kelas['nama_jurusan']; ?></option>
                  <?php } ?>
                </select>
			</pre>
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
