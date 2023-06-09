<?php 
if(!isset($_GET['id'])){
    return header("Location: index.php");
}
else{
    require_once('koneksi.php');

    $id = $_GET['id'];

    mysqli_query($con, "DELETE FROM produk WHERE id = $id");

    $row = mysqli_affected_rows($con);
    
    if($row > 0){
        echo "<script>alert('Data berhasil dihapus.');window.location='index.php';</script>";
    }
    echo "<script>alert('Data gagal dihapus.');window.location='index.php';</script>";
}
?>

