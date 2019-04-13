<?php session_start();
include('../../../database/config.php');
if ($_SESSION && $_SESSION['login'] == 'guru') {
// <!-- WARNING START CONTENT ----------------------------------------------------------- -->
$des_nilai = mysql_query("DESCRIBE nilai");

if (isset($_POST['tambah'])){
  // HITUNG NILAI AKHIR
  $na = ($_POST['uh']+$_POST['uts']+$_POST['uas'])/3;
  $_POST['na'] = round($na, '2');

  while ($data = mysql_fetch_assoc($des_nilai)) {
    $values[] = "'".$_POST[$data['Field']]."'";
  }

  $values = implode($values, ',');
  $query = mysql_query("INSERT INTO nilai VALUES ($values) ");
  if ($query){
    $_SESSION['notif'] = "<div style='float: right;' class='notif-success-a'>✔ Input Nilai Berhasil</div>";
    header('location: ../input_nilai.php');
  }else{
    $_SESSION['notif'] = "<div style='float: right;' class='notif-danger-a'>😢 ERROR -- UNKNOWN</div>";
    header('location: ../input_nilai.php');
  }

}else if(isset($_POST['edit'])){
  // HITUNG NILAI AKHIR
  $na = ($_POST['uh']+$_POST['uts']+$_POST['uas'])/3;
  $_POST['na'] = round($na, '2');

  $id_nilai = $_POST['id_nilai'];
  while ($data = mysql_fetch_assoc($des_nilai)) {
    $values[] = $data['Field']. "= '" .$_POST[$data['Field']]. "'";
  }

  $values = implode($values, ',');
  $query = mysql_query("UPDATE nilai SET $values where id_nilai = $id_nilai ");
  if ($query){
    $_SESSION['notif'] = "<div style='float: right;' class='notif-warning-a'>✎ Edit Nilai Berhasil</div>";
    header('location: ../input_nilai.php');
  }else{
    $_SESSION['notif'] = "<div style='float: right;' class='notif-danger-a'>😢 ERROR</div>";
    header('location: ../input_nilai.php');
  }

}else if(isset($_POST['hapus'])){
  $id_nilai = $_POST['id_nilai'];
  $query = mysql_query("DELETE FROM nilai WHERE id_nilai = $id_nilai ");
  if ($query){
    $_SESSION['notif'] = "<div style='float: right;' class='notif-danger-a'>✖ Hapus Nilai Berhasil</div>";
    header('location: ../input_nilai.php');
  }else{
    $_SESSION['notif'] = "<div style='float: right;' class='notif-danger-a'>😢 Data Tidak Dapat Dihapus Kerena Memiliki Relasi Ke Tabel Lain.</div>";
    header('location: ../input_nilai.php');
  }

}else{
  $_SESSION['notif'] = "<div style='float: right;' class='notif-danger-a'>😢 ERROR -- NO ACTION FOUND</div>";
  header('location: ../input_nilai.php');
}

// <!-- WARNING END CONTENT ----------------------------------------------------------- -->
} else {
        ?>
<script language="javascript">
	document.location = '../../../index.php'
</script>
<?php
    } ?>
