<?php session_start();
if ($_SESSION && $_SESSION['login'] == 'guru') {
    ?>
<?php require_once('assets/header.php'); ?>
<!-- WARNING START CONTENT ----------------------------------------------------------- -->
<?php
$q_guru = mysql_query("SELECT * FROM guru");
$q_kelas = mysql_query("SELECT * FROM kelas LEFT JOIN jurusan ON kelas.id_jurusan = jurusan.id_jurusan");
$q_mapel = mysql_query("SELECT * FROM mapel");
if(isset($_POST['edit'])){
  $id_mengajar = $_POST['id_mengajar'];
  $query = mysql_query("SELECT * FROM mengajar where id_mengajar='$id_mengajar' ");
  $data = mysql_fetch_assoc($query);
}
?>

<div class="menu-kanan">
	<div class="font">

    <div style="font-size: 25pt;">
      FORM DATA MENGAJAR
		</div><hr>
		<form action="action/mengajar_act.php" method="post" enctype="multipart/form-data">
			<pre>
ID MENGAJAR     : <input type="text" value="AUTO" disabled><br>
NAMA GURU       : <select name="nip" required>
                  <?php while ($data_guru = mysql_fetch_assoc($q_guru)) { ?>
                    <option value="<?php echo $data_guru['nip']; ?>" <?php if(isset($_POST['edit']) && $data['nip'] == $data_guru['nip']) echo "selected"; ?>><?php echo $data_guru['nama_guru']; ?></option>
                  <?php } ?>
                  </select><br>
KELAS - JURUSAN : <select name="id_kelas" required>
                  <?php while ($data_kelas = mysql_fetch_assoc($q_kelas)) { ?>
                    <option value="<?php echo $data_kelas['id_kelas']; ?>" <?php if(isset($_POST['edit']) && $data['id_kelas'] == $data_kelas['id_kelas']) echo "selected"; ?>><?php echo $data_kelas['nama_kelas']; ?> - <?php echo $data_kelas['nama_jurusan']; ?></option>
                  <?php } ?>
                  </select><br>
NAMA MAPEL      : <select name="id_mapel" required>
                  <?php while ($data_mapel = mysql_fetch_assoc($q_mapel)) { ?>
                    <option value="<?php echo $data_mapel['id_mapel']; ?>" <?php if(isset($_POST['edit']) && $data['id_mapel'] == $data_mapel['id_mapel']) echo "selected"; ?>><?php echo $data_mapel['nama_mapel']; ?></option>
                  <?php } ?>
                  </select><br>
			</pre>
      <input type="hidden" name="id_mengajar" value="<?php if(isset($_POST['edit'])) echo $data['id_mengajar']; else echo '0'; ?>">
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
