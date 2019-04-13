<?php
$server="localhost";
$user="root";
$pass="";

$db = 'smkindonesia';

    mysql_connect($server, $user, $pass)or die("Koneksi Gagal");
    mysql_select_db($db)or die("Database Tidak Ada");

?>
