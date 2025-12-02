<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../Database.php';
require_once __DIR__ . '/../src/Product.php';
require_once __DIR__ . '/../src/ProductRepository.php';
$repo = new ProductRepository();
$error = '';

if (isset($_POST['submit'])) {
    $data = [
        $_POST['name'] ?? '',
        $_POST['price'] ?? '',
        $_POST['category'] ?? '',
        $_POST['status'] ?? '',
        $_POST['image_path'] ?? ''
    ];

    if (empty($data[0]) || empty($data[1]) || empty($data[2]) || empty($data[3])) {
        $error = "Nama, Harga, Kategori, dan Status harus diisi!";
    } else {
        if($repo->create($data)){
            header("Location: index_product.php");
            exit;
        } else {
            $error = "Gagal menambahkan product!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Product</title>
    <style>
        body { font-family: Arial; background:#f0f2f5; margin:20px; }
        .container { max-width:600px; margin:auto; background:white; padding:30px; border-radius:10px; box-shadow:0 4px 10px rgba(0,0,0,0.1);}
        h2 { text-align:center; }
        label { display:block; margin-top:15px; font-weight:bold; }
        input { width:100%; padding:10px; margin-top:5px; border-radius:5px; border:1px solid #ccc; }
        button { margin-top:20px; width:100%; padding:12px; background:#007BFF; color:white; border:none; border-radius:6px; cursor:pointer; }
        button:hover { background:#0056b3; }
        .error { color:red; text-align:center; }
        .nav { text-align:center; margin-top:15px; }
        .nav a { text-decoration:none; margin:0 10px; color:#007BFF; }
    </style>
</head>
<body>
<div class="container">
    <h2>Tambah Product</h2>

    <?php if($error): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Nama:</label>
        <input type="text" name="name" required>

        <label>Harga:</label>
        <input type="number" name="price" step="0.01" required>

        <label>Kategori:</label>
        <input type="text" name="category" required>

        <label>Status:</label>
        <input type="text" name="status" required>

        <label>Path Gambar:</label>
        <input type="text" name="image_path">

        <button type="submit" name="submit">Tambah Product</button>
    </form>

    <div class="nav">
        <a href="index_product.php">Kembali ke Daftar Product</a>
        <a href="index.php">Dashboard</a>
    </div>
</div>
</body>
</html>
