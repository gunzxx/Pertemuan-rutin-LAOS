<?php
$host = "localhost";
$user = "root";
$pass = "";
$nama_db = "laos_shop"; //nama database
$con = mysqli_connect($host, $user, $pass, $nama_db); //pastikan urutan nya seperti ini, jangan tertukar

if (!$con) { //jika tidak terkoneksi maka akan tampil error
    die("Koneksi dengan database gagal: ". mysqli_connect_error());
}
