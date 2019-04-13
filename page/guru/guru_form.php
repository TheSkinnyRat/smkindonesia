<?php session_start();
if ($_SESSION && $_SESSION['login'] == 'guru') {
    ?>
<?php require_once('assets/header.php'); ?>
<!-- WARNING START CONTENT ----------------------------------------------------------- -->
<?php
if(isset($_POST['edit'])){
  $nip = $_POST['nip'];
  $query = mysql_query("SELECT * FROM guru where nip='$nip' ");
  $data = mysql_fetch_assoc($query);
}
?>

<div class="menu-kanan">
	<div class="font">

    <div style="font-size: 25pt;">
      FORM DATA GURU
		</div><hr>
		<form action="action/guru_act.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="nip" value="<?php if(isset($_POST['edit'])) echo $data['nip']; else echo "0"; ?>" required>
			<pre>
NIP           : <input type="text" value="<?php if(isset($_POST['edit'])) echo $data['nip']; else echo "AUTO"; ?>" disabled><br>
PASSWORD      : <input type="password" name="password" value="<?php if(isset($_POST['edit'])) echo $data['password']; ?>" required><br>
NAMA GURU     : <input type="text" name="nama_guru" value="<?php if(isset($_POST['edit'])) echo $data['nama_guru']; ?>" required><br>
ALAMAT        : <input type="text" name="alamat" value="<?php if(isset($_POST['edit'])) echo $data['alamat']; ?>" required><br>
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
