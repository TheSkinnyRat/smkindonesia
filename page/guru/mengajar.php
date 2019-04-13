<?php session_start();
if($_SESSION && $_SESSION['login'] == 'guru'){ ?>
<?php require_once('assets/header.php'); ?>
<!-- WARNING START CONTENT ----------------------------------------------------------- -->
<?php
$query = mysql_query("SELECT * FROM mengajar
											LEFT JOIN guru ON mengajar.nip = guru.nip
											LEFT JOIN kelas ON mengajar.id_kelas = kelas.id_kelas
											LEFT JOIN jurusan ON kelas.id_jurusan = jurusan.id_jurusan
											LEFT JOIN mapel ON mengajar.id_mapel = mapel.id_mapel");
?>

<div class="menu-kanan">
	<div class="font">

		<div style="font-size: 25pt;">
			<center>DATA MENGAJAR</center>
		</div><hr>
		-- Tidak boleh ada dua guru dalam satu kelas yang mengampu mapel yang sama -- <br>
		<a href="mengajar_form.php"><button class="button button1">+ Tambah</button></a>
		<?php if (isset($_SESSION['notif'])) echo $_SESSION['notif']; unset($_SESSION['notif']);?>
		<table style="text-align: center;" border="3" cellpadding="4" width="100%" height="auto">
			<tr>
				<th>ID MENGAJAR</th>
				<th>NAMA GURU</th>
				<th>KELAS - JURUSAN</th>
				<th>MAPEL</th>
				<th colspan="2">ACTION</th>
			</tr>
			<?php
while ($data = mysql_fetch_assoc($query)) {
?>
			<tr>
				<td>
					<?php echo $data['id_mengajar'];  ?>
				</td>
				<td>
					<?php echo $data['nama_guru'];  ?>
				</td>
				<td>
					<?php echo $data['nama_kelas'];  ?> - <?php echo $data['nama_jurusan'];  ?>
				</td>
				<td>
					<?php echo $data['nama_mapel'];  ?>
				</td>
				<td>
					<form action="mengajar_form.php" method="post">
						<input type="hidden" name="id_mengajar" value="<?php echo $data['id_mengajar']; ?>">
						<input type="submit" name="edit" class="button button-info" value="Edit">
					</form>
				</td>
				<td>
					<form action="action/mengajar_act.php" method="post">
						<input type="hidden" name="id_mengajar" value="<?php echo $data['id_mengajar']; ?>">
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
