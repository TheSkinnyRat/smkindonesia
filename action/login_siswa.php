<?php session_start();
include "../database/config.php";

$nis= mysql_real_escape_string($_POST['nis']);
$password= mysql_real_escape_string($_POST['password']);
$query=mysql_query("SELECT * from siswa where nis='$nis' and password='$password'");
$cek=mysql_num_rows($query);

if ($cek) {
    $row = mysql_fetch_assoc($query);
    $_SESSION['nis']= $row['nis'];
    $_SESSION['password']= $row['password'];
    $_SESSION['nama_siswa']= $row['nama_siswa'];
    $_SESSION['alamat']= $row['alamat'];
    $_SESSION['id_kelas']= $row['id_kelas'];

    $_SESSION['login']= 'siswa';

    header("location: ../page/siswa/index.php");

} else {
  $_SESSION['notif'] = "<div class='notif-danger-a'>Nis/Password Salah</div>"
    ?>
<script language="javascript">
	document.location = '../index.php'
</script>
<?php
}
?>
