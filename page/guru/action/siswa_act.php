<?php session_start();
include('../../../database/config.php');
if ($_SESSION && $_SESSION['login'] == 'guru') {
// <!-- WARNING START CONTENT ----------------------------------------------------------- -->
$des_siswa = mysql_query("DESCRIBE siswa");

if (isset($_POST['tambah'])){
  while ($data = mysql_fetch_assoc($des_siswa)) {
    $values[] = "'" .$_POST[$data['Field']]. "'";
  }
  $values = implode($values, ',');

  $query = mysql_query("INSERT INTO siswa VALUES ($values) ");
  if ($query){
    $_SESSION['notif'] = "<div style='float: right;' class='notif-success-a'>✔ Tambah Data Berhasil</div>";
    header('location: ../siswa.php');
  }else{
    $_SESSION['notif'] = "<div style='float: right;' class='notif-danger-a'>😢 NIS SUDAH ADA</div>";
    header('location: ../siswa.php');
  }

}else if(isset($_POST['edit'])){
  $nis = $_POST['nis'];
  while ($data = mysql_fetch_assoc($des_siswa)) {
    $values[] = $data['Field']. "= '" .$_POST[$data['Field']]. "'";
  }
  $values = implode($values, ',');

  $query = mysql_query("UPDATE siswa SET $values where nis='$nis' ");
  if ($query){
    $_SESSION['notif'] = "<div style='float: right;' class='notif-warning-a'>✎ Edit Data Berhasil</div>";
    header('location: ../siswa.php');
  }else{
    $_SESSION['notif'] = "<div style='float: right;' class='notif-danger-a'>😢 NIS SUDAH ADA</div>";
    header('location: ../siswa.php');
  }

}else if(isset($_POST['hapus'])){
  $nis = $_POST['nis'];

  $query = mysql_query("DELETE FROM siswa WHERE nis='$nis' ");
  if ($query){
    $_SESSION['notif'] = "<div style='float: right;' class='notif-danger-a'>✖ Hapus Data Berhasil</div>";
    header('location: ../siswa.php');
  }else{
    $_SESSION['notif'] = "<div style='float: right;' class='notif-danger-a'>😢 Data Tidak Dapat Dihapus Kerena Memiliki Relasi Ke Tabel Lain.</div>";
    header('location: ../siswa.php');
  }

}else{
  $_SESSION['notif'] = "<div style='float: right;' class='notif-danger-a'>😢 ERROR -- NO ACTION FOUND</div>";
  header('location: ../siswa.php');
}

// <!-- WARNING END CONTENT ----------------------------------------------------------- -->
} else {
        ?>
<script language="javascript">
	document.location = '../../../index.php'
</script>
<?php
    } ?>
