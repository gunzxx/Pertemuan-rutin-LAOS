<?php

function dd(array|string $data){
    if (gettype($data) == "array") {
        die(json_encode($data));
    }
    if (gettype($data) == "string") {
        die($data);
    }
}

$con = mysqli_connect('localhost','root','','laos_shop');
$datas = [];

if(!$con){
    echo "Gagal menghubungkan ke database";
    die(mysqli_connect_error());
}
else{
    $result = mysqli_query($con,'SELECT * FROM produk');
    if(!$result){
        $datas = [];
    }
    else{
        while($data = mysqli_fetch_assoc($result)){
            $datas[] = $data;
        }
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

    <section class="jumbotron">
        <img src="./img/banner.jpg" alt="banner">
    </section>

    <section class="products">

        <?php foreach ($datas as $key => $data) : ?>
            <div class="card-container">
                <div class="card-body">
                    <div class="card-image">
                        <img src="<?php echo $data['gambar'] ?>" alt="">
                    </div>
                    <div class="card-content">
                        <h1><?php echo $data['nama'] ?></h1>
                        <p><?php echo $data['deskripsi'] ?></p>
                    </div>
                </div>
                <div class="card-footer">
                    <a class="btn btn-danger" href="./delete.php">Hapus</a>
                    <a class="btn btn-second" href="./edit.php?id=<?php echo $data['id'] ?>">Edit</a>
                    <a class="btn btn-main" href="./buy.php">Beli</a>
                </div>
            </div>
        <?php endforeach; ?>
    </section>
</body>

</html>