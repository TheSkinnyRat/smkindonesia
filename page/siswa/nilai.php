<?php session_start();
if($_SESSION && $_SESSION['login'] == 'siswa'){ ?>
<?php require_once('assets/header.php'); ?>
<!-- WARNING START CONTENT ----------------------------------------------------------- -->
<?php
$nis = $_SESSION['nis'];
$nama_siswa = $_SESSION['nama_siswa'];
$query = mysql_query("SELECT * FROM vnilai where nama_siswa = '$nama_siswa' ");

// OPSIONAL UNTUK MENAMPILKAN KET
$query_temp = mysql_query("SELECT * FROM vnilai where nama_siswa = '$nama_siswa' ");
$data_temp = mysql_fetch_assoc($query_temp);
?>

<div class="menu-kanan">
	<div class="font">

		<div style="font-size: 25pt;">
			<center>NILAI SISWA</center>
		</div><hr>

		<?php if (isset($_SESSION['notif'])) echo $_SESSION['notif']; unset($_SESSION['notif']);?>

			KET: Data Nilai Siswa, <font style="color: red; text-transform: uppercase;"><?php echo $data_temp['nama_siswa'] ?></font> Kelas <font style="color: blue; text-transform: uppercase;"><?php echo $data_temp['nama_kelas'] ?> - <?php echo $data_temp['nama_jurusan'] ?></font>
			<br><br>
			<table style="text-align: center;" border="3" cellpadding="4" width="100%" height="auto">
				<tr>
					<th>NAMA SISWA</th>
					<th>KELAS - JURUSAN</th>
					<th>MAPEL</th>
					<th>NILAI HARIAN</th>
					<th>NILAI UTS</th>
					<th>NILAI UAS</th>
					<th>NILAI AKHIR</th>
				</tr>
				<?php while ($data = mysql_fetch_assoc($query)) { ?>
				<tr>
						<td>
							<?php echo $data['nama_siswa'];  ?>
						</td>
						<td>
							<?php echo $data['nama_kelas'];  ?> - <?php echo $data['nama_jurusan'];  ?>
						</td>
						<td>
							<?php echo $data['nama_mapel'];  ?>
						</td>
						<td>
							<?php echo $data['uh'];  ?>
						</td>
						<td>
							<?php echo $data['uts'];  ?>
						</td>
						<td>
							<?php echo $data['uas'];  ?>
						</td>
						<td>
							<?php echo $data['na'];  ?>
						</td>
				</tr>
				<?php	}	?>
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
