<?php session_start();
if ($_SESSION && $_SESSION['login'] == 'guru') {
    ?>
<?php require_once('assets/header.php'); ?>
<!-- WARNING START CONTENT ----------------------------------------------------------- -->
<?php
$get_jurusan = mysql_query("SELECT * FROM jurusan");
if(isset($_POST['edit'])){
  $id_kelas = $_POST['id_kelas'];
  $query = mysql_query("SELECT * FROM kelas where id_kelas='$id_kelas' ");
  $data = mysql_fetch_assoc($query);
}
?>

<div class="menu-kanan">
	<div class="font">

    <div style="font-size: 25pt;">
      FORM DATA KELAS
		</div><hr>
		<form action="action/kelas_act.php" method="post" enctype="multipart/form-data">
			<pre>
ID KELAS      : <input type="text" value="AUTO" disabled><br>
NAMA KELAS    : <input type="text" name="nama_kelas" value="<?php if(isset($_POST['edit'])) echo $data['nama_kelas']; ?>" required><br>
JURUSAN       : <select class="" name="id_jurusan">
                  <?php while ($data_jurusan = mysql_fetch_assoc($get_jurusan)) { ?>
                    <option value="<?php echo $data_jurusan['id_jurusan'] ?>" <?php if(isset($_POST['edit']) && $data['id_jurusan'] == $data_jurusan['id_jurusan']) echo "selected"; ?> ><?php echo $data_jurusan['nama_jurusan'] ?></option>
                  <?php } ?>
                </select>
			</pre>
      <input type="hidden" name="id_kelas" value="<?php if(isset($_POST['edit'])) echo $data['id_kelas']; else echo '0'; ?>">
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
