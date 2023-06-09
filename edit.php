<?php
include('koneksi.php');
$id = $_GET['id'];
$datas = [];
$result = mysqli_query($con, "SELECT * FROM produk WHERE id='$id' ");
if (!$result) {
    $datas = [];
} else {
    while ($data = mysqli_fetch_assoc($result)) {
        $datas[] = $data;
    }
}

if (isset($_POST['update-product'])) {
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $gambar = $_FILES['gambar']['name'];

    if ($nama != "" && $deskripsi != "" && $gambar != "") {
        $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
        $x = explode('.', $gambar);
        $ekstensi = strtolower(end($x));
        $file_tmp = $_FILES['gambar']['tmp_name'];
        $angka_acak  = rand(1, 999);
        $nama_gambar_baru = 'img/' . $angka_acak . '-' . $gambar;

        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            move_uploaded_file($file_tmp,  $nama_gambar_baru);
            $query = "UPDATE produk SET nama='$nama', deskripsi='$deskripsi', gambar='$nama_gambar_baru' WHERE id='$id'";
            $result = mysqli_query($con, $query);
            if (!$result) {
                die("Query gagal dijalankan: " . mysqli_errno($con) .
                    " - " . mysqli_error($con));
            } else {
                echo "<script>alert('Data berhasil ditambah.');window.location='index.php';</script>";
            }
        } else {
            echo "<script>alert('Ekstensi gambar yang boleh hanya jpg, png dan jpeg');window.location='edit.php';</script>";
        }
    } elseif ($nama != "" && $deskripsi != "") {
        $query = "UPDATE produk SET nama='$nama', deskripsi='$deskripsi' WHERE id='$id'";
        $result = mysqli_query($con, $query);
        if (!$result) {
            die("Query gagal dijalankan: " . mysqli_errno($con) .
                " - " . mysqli_error($con));
        } else {
            echo "<script>alert('Data berhasil ditambah.');window.location='index.php';</script>";
        }
    } else {
        echo "<script>alert('Data harus di isi semua.');window.location='edit.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
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
            <?php foreach ($datas as $key => $data) : ?>
                <div>
                    <label>Nama Produk</label>
                    <input type="text" name="nama" required value="<?php echo $data['nama'] ?>" />
                </div>
                <div>
                    <label>Deskripsi</label>
                    <input type="text" name="deskripsi" required value="<?php echo $data['deskripsi'] ?>" />
                </div>
                <div>
                    <label>Gambar Produk</label>
                    <input type="file" name="gambar" />
                </div>
                <div>
                    <button type="submit" name="update-product">Update Produk</button>
                </div>
            <?php endforeach; ?>
        </form>
    </section>

</body>

</html>