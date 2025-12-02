<?php
require_once __DIR__ . "/../src/ProductRepository.php";
$repo = new ProductRepository();

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $kategori = $_POST['kategori'];
    $status = $_POST['status'];

    // Upload image
    $image = "";
    if (!empty($_FILES['image']['name'])) {
        $image = time() . "_" . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/" . $image);
    }

    if ($repo->addProduct($nama, $harga, $kategori, $status, $image)) {
        $message = "Produk berhasil ditambahkan!";
    } else {
        $message = "Gagal menambah produk!";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Tambah Product</title>
</head>
<body>

<h2>Tambah Product</h2>
<a href="index.php">Kembali</a><br><br>

<p><?= $message ?></p>

<form action="" method="POST" enctype="multipart/form-data">
    Nama: <br>
    <input type="text" name="nama" required><br><br>

    Harga: <br>
    <input type="number" name="harga" required><br><br>

    Kategori: <br>
    <input type="text" name="kategori" required><br><br>

    Status: <br>
    <input type="text" name="status"><br><br>

    Gambar: <br>
    <input type="file" name="image"><br><br>

    <button type="submit">Simpan</button>
</form>

</body>
</html>
