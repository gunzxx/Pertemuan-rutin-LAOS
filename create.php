<?php
include('koneksi.php');

if (isset($_POST['add-product'])) {
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $gambar = $_FILES['gambar']['name'];
    if ($gambar != "") {
        $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
        $x = explode('.', $gambar);
        $ekstensi = strtolower(end($x));
        $file_tmp = $_FILES['gambar']['tmp_name'];
        $angka_acak  = rand(1, 999);
        $nama_gambar_baru = 'img/' . $angka_acak . '-' . $gambar;

        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            move_uploaded_file($file_tmp,  $nama_gambar_baru);
            $query = "INSERT INTO produk (nama, deskripsi,  gambar) VALUES ('$nama', '$deskripsi','$nama_gambar_baru')";
            $result = mysqli_query($con, $query);
            if (!$result) {
                die("Query gagal dijalankan: " . mysqli_errno($con) .
                    " - " . mysqli_error($con));
            } else {
                echo "<script>alert('Data berhasil ditambah.');window.location='index.php';</script>";
            }
        } else {
            echo "<script>alert('Ekstensi gambar yang boleh hanya jpg, png dan jpeg');window.location='create.php';</script>";
        }
    } else {
        echo "<script>alert('Gambar harus di isi.');window.location='create.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAOS Shop</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <nav id="nav">
        <div class="nav-col">
            <img src="./img/logo.svg" alt="">
            <h1>LAOS Shop</h1>
        </div>
        <div class="nav-col col2">
            <a href="./index.php">Home</a>
            <a class="btn btn-main" href="./create.php">Add</a>
        </div>
    </nav>

    <section class="add-product">
        <h1 style="text-align: center; margin-top: 2rem;">Tambah Produk</h1>
        <form method="POST" enctype="multipart/form-data">
            <div>
                <label>Nama Produk</label>
                <input type="text" name="nama" required />
            </div>
            <div>
                <label>Deskripsi</label>
                <input type="text" name="deskripsi" required />
            </div>
            <div>
                <label>Gambar Produk</label>
                <input type="file" name="gambar" required />
            </div>
            <div>
                <button type="submit" name="add-product">Simpan Produk</button>
            </div>
        </form>
    </section>

</body>

</html>