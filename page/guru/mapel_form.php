<?php session_start();
if ($_SESSION && $_SESSION['login'] == 'guru') {
    ?>
<?php require_once('assets/header.php'); ?>
<!-- WARNING START CONTENT ----------------------------------------------------------- -->
<?php
if(isset($_POST['edit'])){
  $id_mapel = $_POST['id_mapel'];
  $query = mysql_query("SELECT * FROM mapel where id_mapel='$id_mapel' ");
  $data = mysql_fetch_assoc($query);
}
?>

<div class="menu-kanan">
	<div class="font">

    <div style="font-size: 25pt;">
      FORM DATA MAPEL
		</div><hr>
		<form action="action/mapel_act.php" method="post" enctype="multipart/form-data">
			<pre>
ID MAPEL      : <input type="text" value="AUTO" disabled><br>
NAMA MAPEL    : <input type="text" name="nama_mapel" value="<?php if(isset($_POST['edit'])) echo $data['nama_mapel']; ?>" required><br>
			</pre>
      <input type="hidden" name="id_mapel" value="<?php if(isset($_POST['edit'])) echo $data['id_mapel']; else echo '0'; ?>">
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
