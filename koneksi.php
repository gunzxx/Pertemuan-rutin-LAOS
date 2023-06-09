<?php
$host = "localhost";
$user = "root";
$pass = "";
$nama_db = "laos_shop"; 
$con = mysqli_connect($host, $user, $pass, $nama_db);

if (!$con) {
    die("Koneksi dengan database gagal: ". mysqli_connect_error());
}
