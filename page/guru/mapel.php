<?php session_start();
if($_SESSION && $_SESSION['login'] == 'guru'){ ?>
<?php require_once('assets/header.php'); ?>
<!-- WARNING START CONTENT ----------------------------------------------------------- -->
<?php
$query = mysql_query("SELECT * from mapel");
?>

<div class="menu-kanan">
	<div class="font">

		<div style="font-size: 25pt;">
			<center>DATA MAPEL</center>
		</div><hr>
		<a href="mapel_form.php"><button class="button button1">+ Tambah</button></a>
		<?php if (isset($_SESSION['notif'])) echo $_SESSION['notif']; unset($_SESSION['notif']);?>
		<table style="text-align: center;" border="3" cellpadding="4" width="100%" height="auto">
			<tr>
				<th>ID MAPEL</th>
				<th>NAMA MAPEL</th>
				<th colspan="2">ACTION</th>
			</tr>
			<?php
while ($data = mysql_fetch_assoc($query)) {
?>
			<tr>
				<td>
					<?php echo $data['id_mapel'];  ?>
				</td>
				<td>
					<?php echo $data['nama_mapel'];  ?>
				</td>
				<td>
					<form action="mapel_form.php" method="post">
						<input type="hidden" name="id_mapel" value="<?php echo $data['id_mapel']; ?>">
						<input type="submit" name="edit" class="button button-info" value="Edit">
					</form>
				</td>
				<td>
					<form action="action/mapel_act.php" method="post">
						<input type="hidden" name="id_mapel" value="<?php echo $data['id_mapel']; ?>">
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
