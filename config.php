<?php
$host = "localhost";
$user = "root";
$password ="";
$db = "manajemen_masjid";

$koneksi = mysqli_connect($host, $user, $password, $db);
if(!$koneksi){
    die("tidak bisa terkoneksi ke database");
}

?>
