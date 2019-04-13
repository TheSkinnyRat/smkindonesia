<?php session_start();
if($_SESSION && $_SESSION['login'] == 'guru'){ ?>
<?php require_once('assets/header.php'); ?>
<!-- WARNING START CONTENT ----------------------------------------------------------- -->
<?php
$query = mysql_query("SELECT * from jurusan");
?>

<div class="menu-kanan">
	<div class="font">

		<div style="font-size: 25pt;">
			<center>DATA JURUSAN</center>
		</div><hr>
		<a href="jurusan_form.php"><button class="button button1">+ Tambah</button></a>
		<?php if (isset($_SESSION['notif'])) echo $_SESSION['notif']; unset($_SESSION['notif']);?>
		<table style="text-align: center;" border="3" cellpadding="4" width="100%" height="auto">
			<tr>
				<th>ID JURUSAN</th>
				<th>NAMA JURUSAN</th>
				<th colspan="2">ACTION</th>
			</tr>
			<?php
while ($data = mysql_fetch_assoc($query)) {
?>
			<tr>
				<td>
					<?php echo $data['id_jurusan'];  ?>
				</td>
				<td>
					<?php echo $data['nama_jurusan'];  ?>
				</td>
				<td>
					<form action="jurusan_form.php" method="post">
						<input type="hidden" name="id_jurusan" value="<?php echo $data['id_jurusan']; ?>">
						<input type="submit" name="edit" class="button button-info" value="Edit">
					</form>
				</td>
				<td>
					<form action="action/jurusan_act.php" method="post">
						<input type="hidden" name="id_jurusan" value="<?php echo $data['id_jurusan']; ?>">
						<input type="submit" name="hapus" class="button button-danger" value="Hapus">
					</form>
				</td>
			</tr>
			<?php
}
?>
		</table>

	</div>
</div>

<!-- WARNING END CONTENT ----------------------------------------------------------- -->
<?php require_once('assets/footer.php'); ?>
<?php }else{ ?>
<script language="javascript">
	document.location = '../../index.php'
</script>
<?php } ?>
