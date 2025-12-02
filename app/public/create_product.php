<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../src/ProductRepository.php';

$repo = new ProductRepository();
$error = '';

if (isset($_POST['submit'])) {
    $data = [
        $_POST['name'] ?? '',
        $_POST['price'] ?? '',
        $_POST['category'] ?? '',
        $_POST['status'] ?? '',
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

        <button type="submit" name="submit">Tambah Product</button>
    </form>

    <div class="nav">
        <a href="index_product.php">Kembali ke Daftar Product</a>
    </div>
</div>
</body>
</html>
