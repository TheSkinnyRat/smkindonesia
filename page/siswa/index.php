<?php session_start();
if($_SESSION && $_SESSION['login'] == 'siswa'){ ?>
<?php require_once('assets/header.php'); ?>
<!-- -------------------------------------------------------------------------------------------------- -->

<div class="menu-kanan">
	<div class="font">
		<h1>Selamat Datang Siswa...</h1>
		<?php
	echo "<h2><strong><font color=blue>".$_SESSION['nama_siswa']."</h2></strong></font><p>";
		?>
		</center>
		</h1>
	</div>
</div>

<!-- -------------------------------------------------------------------------------------------------- -->
<?php require_once('assets/footer.php'); ?>
<?php }else{ ?>
<script language="javascript">
	document.location = '../../index.php'
</script>
<?php } ?>
