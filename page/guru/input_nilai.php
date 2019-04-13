<?php session_start();
if($_SESSION && $_SESSION['login'] == 'guru'){ ?>
<?php require_once('assets/header.php'); ?>
<!-- WARNING START CONTENT ----------------------------------------------------------- -->
<?php
$nip = $_SESSION['nip'];
$query_mengajar = mysql_query("SELECT * FROM mengajar
									LEFT JOIN kelas ON mengajar.id_kelas = kelas.id_kelas
									LEFT JOIN jurusan ON kelas.id_jurusan = jurusan.id_jurusan
									LEFT JOIN mapel ON mengajar.id_mapel=mapel.id_mapel
									where mengajar.nip = $nip ");
if (isset($_POST['go'])) {
	$id_mengajar = $_POST['id_mengajar'];

	$query_kelas = mysql_query("SELECT * FROM mengajar where id_mengajar=$id_mengajar");
	$data_kelas = mysql_fetch_assoc($query_kelas);
	$id_kelas = $data_kelas['id_kelas'];

	$query = mysql_query("SELECT * FROM siswa
												LEFT JOIN kelas ON siswa.id_kelas = kelas.id_kelas
												LEFT JOIN jurusan ON kelas.id_jurusan = jurusan.id_jurusan
												where kelas.id_kelas = $id_kelas");

	// OPTIONAL BUAT NAMPILIN KET
	$query_temp = mysql_query("SELECT * FROM mengajar
										LEFT JOIN kelas ON mengajar.id_kelas = kelas.id_kelas
										LEFT JOIN jurusan ON kelas.id_jurusan = jurusan.id_jurusan
										LEFT JOIN mapel ON mengajar.id_mapel=mapel.id_mapel
										where id_mengajar = $id_mengajar");
	$data_temp = mysql_fetch_assoc($query_temp);
}
?>

<div class="menu-kanan">
	<div class="font">

		<div style="font-size: 25pt;">
			<center>INPUT DATA NILAI</center>
		</div><hr>

		<form action="input_nilai.php" method="post" enctype="multipart/form-data">
KELAS - JURUSAN / MAPEL	: <select name="id_mengajar" required>
              						<?php while ($data_mengajar = mysql_fetch_assoc($query_mengajar)) { ?>
                						<option value="<?php echo $data_mengajar['id_mengajar']; ?>" <?php if(isset($_POST['go']) && $data_mengajar['id_mengajar'] == $id_mengajar) echo "selected"; ?>>
															<?php echo $data_mengajar['nama_kelas']; ?> - <?php echo $data_mengajar['nama_jurusan']; ?> / <?php echo $data_mengajar['nama_mapel']; ?>
														</option>
              						<?php } ?>
              						</select>
		<button class="button button1" type="submit" name="go">PILIH</button>
		</form>

		<hr>
		<?php if (isset($_SESSION['notif'])) echo $_SESSION['notif']; unset($_SESSION['notif']);?>

		<?php if(!isset($_POST['go'])){ ?>
			-- Pilih "Kelas - Jurusan / Mapel" Pada Menu Diatas --
		<?php } else { ?>
			KET: Data Nilai Siswa, Kelas <font style="color: blue; text-transform: uppercase;"><?php echo $data_temp['nama_kelas'] ?> - <?php echo $data_temp['nama_jurusan'] ?></font> Mata Pelajaran <font style="color: red; text-transform: uppercase;"><?php echo $data_temp['nama_mapel'] ?></font>
			<br><br>
			<table style="text-align: center;" border="3" cellpadding="4" width="100%" height="auto">
				<tr>
					<th>ID NILAI</th>
					<th>NAMA SISWA</th>
					<th>KELAS - JURUSAN</th>
					<th>NILAI HARIAN</th>
					<th>NILAI UTS</th>
					<th>NILAI UAS</th>
					<th>NILAI AKHIR</th>
					<th colspan="2">ACTION</th>
				</tr>
				<?php while ($data = mysql_fetch_assoc($query)) {
								$nis = $data['nis'];
								$query_nilai = mysql_query("SELECT * FROM nilai where id_mengajar=$id_mengajar and nis=$nis ");
								$cek_nilai = mysql_num_rows($query_nilai);
								$data_nilai = mysql_fetch_assoc($query_nilai); ?>
				<tr>
						<td>
							<?php if($cek_nilai) echo $data_nilai['id_nilai']; else echo "-"; ?>
						</td>
						<td>
							<?php echo $data['nama_siswa'];  ?>
						</td>
						<td>
							<?php echo $data['nama_kelas'];  ?> - <?php echo $data['nama_jurusan'];  ?>
						</td>
						<td>
							<?php if($cek_nilai) echo $data_nilai['uh']; else echo "-"; ?>
						</td>
						<td>
							<?php if($cek_nilai) echo $data_nilai['uts']; else echo "-"; ?>
						</td>
						<td>
							<?php if($cek_nilai) echo $data_nilai['uas']; else echo "-"; ?>
						</td>
						<td>
							<?php if($cek_nilai) echo $data_nilai['na']; else echo "-"; ?>
						</td>
						<?php if ($cek_nilai) { ?>
						<td>
								<form action="input_nilai_form.php" method="post">
									<input type="hidden" name="nis" value="<?php echo $data['nis']; ?>">
									<input type="hidden" name="id_mengajar" value="<?php echo $id_mengajar ?>">
									<input type="submit" name="edit" class="button button-info" value="EDIT">
								</form>
						</td>
						<td>
								<form action="action/input_nilai_act.php" method="post">
									<input type="hidden" name="id_nilai" value="<?php echo $data_nilai['id_nilai']; ?>">
									<input type="submit" name="hapus" class="button button-danger" value="HAPUS">
								</form>
						</td>
						<?php }else{ ?>
							<td colspan="2">
									<form action="input_nilai_form.php" method="post">
										<input type="hidden" name="nis" value="<?php echo $data['nis']; ?>">
										<input type="hidden" name="id_mengajar" value="<?php echo $id_mengajar ?>">
										<input type="submit" name="input" class="button button1" value="INPUT">
									</form>
							</td>
						<?php } ?>

				</tr>
				<?php
	}
	?>
			</table>
		<?php } ?>

	</div>
</div>

<!-- WARNING END CONTENT ----------------------------------------------------------- -->
<?php require_once('assets/footer.php'); ?>
<?php }else{ ?>
<script language="javascript">
	document.location = '../../index.php'
</script>
<?php } ?>
