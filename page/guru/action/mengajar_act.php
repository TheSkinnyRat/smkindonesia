<?php session_start();
include('../../../database/config.php');
if ($_SESSION && $_SESSION['login'] == 'guru') {
// <!-- WARNING START CONTENT ----------------------------------------------------------- -->
$des_mengajar = mysql_query("DESCRIBE mengajar");

if (isset($_POST['tambah'])){
  $id_kelas = $_POST['id_kelas'];
  $id_mapel = $_POST['id_mapel'];
  while ($data = mysql_fetch_assoc($des_mengajar)) {
    $values[] = "'".$_POST[$data['Field']]."'";
  }
  // CEK APAKAH ADA DUA GURU DALAM SATU KELAS DAN SATU MAPEL
  $q_cek = mysql_query("SELECT * FROM mengajar where id_kelas = $id_kelas and id_mapel = $id_mapel ");
  $cek = mysql_num_rows($q_cek);
  if ($cek != '0') {
    $_SESSION['notif'] = "<div style='float: right;' class='notif-danger-a'>✖ Guru sudah ada untuk kelas dan mapel tersebut</div>";
    header('location: ../mengajar.php');
  }else{
    $values = implode($values, ',');
    $query = mysql_query("INSERT INTO mengajar VALUES ($values) ");
    if ($query){
      $_SESSION['notif'] = "<div style='float: right;' class='notif-success-a'>✔ Tambah Data Berhasil</div>";
      header('location: ../mengajar.php');
    }else{
      $_SESSION['notif'] = "<div style='float: right;' class='notif-danger-a'>😢 ERROR</div>";
      header('location: ../mengajar.php');
    }
  }

}else if(isset($_POST['edit'])){
  $id_mengajar = $_POST['id_mengajar'];
  $id_kelas = $_POST['id_kelas'];
  $id_mapel = $_POST['id_mapel'];
  while ($data = mysql_fetch_assoc($des_mengajar)) {
    $values[] = $data['Field']. "= '" .$_POST[$data['Field']]. "'";
  }
  // CEK APAKAH ADA DUA GURU DALAM SATU KELAS DAN SATU MAPEL
  $q_cek = mysql_query("SELECT * FROM mengajar where id_kelas = $id_kelas and id_mapel = $id_mapel ");
  $cek = mysql_num_rows($q_cek);
  $d_cek = mysql_fetch_assoc($q_cek);
  if ($cek != '0' && $d_cek['id_mengajar'] != $id_mengajar) {
    $_SESSION['notif'] = "<div style='float: right;' class='notif-danger-a'>✖ Guru sudah ada untuk kelas dan mapel tersebut</div>";
    header('location: ../mengajar.php');
  }else{
    $values = implode($values, ',');
    $query = mysql_query("UPDATE mengajar SET $values where id_mengajar='$id_mengajar' ");
    if ($query){
      $_SESSION['notif'] = "<div style='float: right;' class='notif-success-a'>✎ Edit Data Berhasil</div>";
      header('location: ../mengajar.php');
    }else{
      $_SESSION['notif'] = "<div style='float: right;' class='notif-danger-a'>😢 ERROR</div>";
      header('location: ../mengajar.php');
    }
  }

}else if(isset($_POST['hapus'])){
  $id_mengajar = $_POST['id_mengajar'];

  $query = mysql_query("DELETE FROM mengajar WHERE id_mengajar='$id_mengajar' ");
  if ($query){
    $_SESSION['notif'] = "<div style='float: right;' class='notif-danger-a'>✖ Hapus Data Berhasil</div>";
    header('location: ../mengajar.php');
  }else{
    $_SESSION['notif'] = "<div style='float: right;' class='notif-danger-a'>😢 Data Tidak Dapat Dihapus Kerena Memiliki Relasi Ke Tabel Lain.</div>";
    header('location: ../mengajar.php');
  }

}else{
  $_SESSION['notif'] = "<div style='float: right;' class='notif-danger-a'>😢 ERROR -- NO ACTION FOUND</div>";
  header('location: ../mengajar.php');
}

// <!-- WARNING END CONTENT ----------------------------------------------------------- -->
} else {
        ?>
<script language="javascript">
	document.location = '../../../index.php'
</script>
<?php
    } ?>
