<?php session_start();
include('../../../database/config.php');
if ($_SESSION && $_SESSION['login'] == 'guru') {
// <!-- WARNING START CONTENT ----------------------------------------------------------- -->
$des_jurusan = mysql_query("DESCRIBE jurusan");

if (isset($_POST['tambah'])){
  while ($data = mysql_fetch_assoc($des_jurusan)) {
    $values[] = "'" .$_POST[$data['Field']]. "'";
  }
  $values = implode(',' , $values);
  $query = mysql_query("INSERT INTO jurusan VALUES ($values) ");
  if ($query){
    $_SESSION['notif'] = "<div style='float: right;' class='notif-success-a'>✔ Tambah Data Berhasil</div>";
    header('location: ../jurusan.php');
  }else{
    $_SESSION['notif'] = "<div style='float: right;' class='notif-danger-a'>😢 ERROR</div>";
    header('location: ../jurusan.php');
  }

}else if(isset($_POST['edit'])){
  $id_jurusan = $_POST['id_jurusan'];
  while ($data = mysql_fetch_assoc($des_jurusan)) {
    $values[] = $data['Field']. "= '" .$_POST[$data['Field']]. "'";
  }
  $values = implode($values, ',');

  $query = mysql_query("UPDATE jurusan SET $values where id_jurusan='$id_jurusan' ");
  if ($query){
    $_SESSION['notif'] = "<div style='float: right;' class='notif-warning-a'>✎ Edit Data Berhasil</div>";
    header('location: ../jurusan.php');
  }else{
    $_SESSION['notif'] = "<div style='float: right;' class='notif-danger-a'>😢 ERROR</div>";
    header('location: ../jurusan.php');
  }

}else if(isset($_POST['hapus'])){
  $id_jurusan = $_POST['id_jurusan'];

  $query = mysql_query("DELETE FROM jurusan WHERE id_jurusan='$id_jurusan' ");
  if ($query){
    $_SESSION['notif'] = "<div style='float: right;' class='notif-danger-a'>✖ Hapus Data Berhasil</div>";
    header('location: ../jurusan.php');
  }else{
    $_SESSION['notif'] = "<div style='float: right;' class='notif-danger-a'>😢 Data Tidak Dapat Dihapus Kerena Memiliki Relasi Ke Tabel Lain.</div>";
    header('location: ../jurusan.php');
  }

}else{
  $_SESSION['notif'] = "<div style='float: right;' class='notif-danger-a'>😢 ERROR -- NO ACTION FOUND</div>";
  header('location: ../jurusan.php');
}

// <!-- WARNING END CONTENT ----------------------------------------------------------- -->
} else {
        ?>
<script language="javascript">
	document.location = '../../../index.php'
</script>
<?php
    } ?>
