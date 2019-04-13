<?php session_start();
if ($_SESSION && $_SESSION['login'] == 'guru') {
    ?>
<?php require_once('assets/header.php'); ?>
<!-- WARNING START CONTENT ----------------------------------------------------------- -->
<?php
if(isset($_POST['edit'])){
  $id_jurusan = $_POST['id_jurusan'];
  $query = mysql_query("SELECT * FROM jurusan where id_jurusan='$id_jurusan' ");
  $data = mysql_fetch_assoc($query);
}
?>

<div class="menu-kanan">
	<div class="font">

    <div style="font-size: 25pt;">
      FORM DATA JURUSAN
		</div><hr>
		<form action="action/jurusan_act.php" method="post" enctype="multipart/form-data">
			<pre>
ID JURUSAN      : <input type="text" value="AUTO" disabled><br>
NAMA JURUSAN    : <input type="text" name="nama_jurusan" value="<?php if(isset($_POST['edit'])) echo $data['nama_jurusan']; ?>" required><br>
			</pre>
      <input type="hidden" name="id_jurusan" value="<?php if(isset($_POST['edit'])) echo $data['id_jurusan']; else echo '0'; ?>">
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
