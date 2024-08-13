<?php 

$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "survey_db";

$conn= mysqli_connect($host, $user, $pass, $db);
if (!$conn) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}

?>

