<?php
require_once __DIR__ . '/../Database.php';
require_once __DIR__ . '/../src/Product.php';
require_once __DIR__ . '/../src/ProductRepository.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID product tidak ditemukan!");
}

$id = $_GET['id'];
$repo = new ProductRepository();
$product = $repo->find($id);

if (!$product) {
    die("Product dengan ID $id tidak ditemukan!");
}

if (isset($_POST['submit'])) {
    $data = [
        $_POST['name'],
        $_POST['price'],
        $_POST['category'],
        $_POST['status'],
        $_POST['image_path']
    ];
    $repo->update($id, $data);
    header("Location: index_product.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <style>
        body { font-family: Arial; background:#f0f2f5; margin:0; padding:20px; }
        .container { max-width:600px; margin:auto; background:white; padding:30px; border-radius:10px; box-shadow:0px 4px 12px rgba(0,0,0,0.1); }
        h2 { text-align:center; margin-bottom:20px; }
        label { display:block; margin-top:15px; font-weight:bold; }
        input[type="text"], input[type="number"] { width:100%; padding:10px; margin-top:5px; border-radius:5px; border:1px solid #ccc; }
        button { margin-top:20px; width:100%; padding:12px; background:#28a745; color:white; border:none; border-radius:6px; font-size:16px; cursor:pointer; }
        button:hover { background:#218838; }
        .nav { text-align:center; margin-top:15px; }
        .nav a { text-decoration:none; margin:0 10px; color:#007BFF; }
        .nav a:hover { text-decoration:underline; }
        img.preview { max-width:100px; margin-top:10px; border-radius:5px; }
    </style>
</head>
<body>
<div class="container">
    <h2>Edit Product</h2>
    <form method="POST">
        <label>Nama:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>

        <label>Harga:</label>
        <input type="number" name="price" step="0.01" value="<?= htmlspecialchars($product['price']) ?>" required>

        <label>Kategori:</label>
        <input type="text" name="category" value="<?= htmlspecialchars($product['category']) ?>" required>

        <label>Status:</label>
        <input type="text" name="status" value="<?= htmlspecialchars($product['status']) ?>" required>

        <label>Path Gambar:</label>
        <input type="text" name="image_path" value="<?= htmlspecialchars($product['image_path']) ?>">

        <?php if(!empty($product['image_path'])): ?>
            <img class="preview" src="<?= htmlspecialchars($product['image_path']) ?>" alt="Preview">
        <?php endif; ?>

        <button type="submit" name="submit">Simpan Perubahan</button>
    </form>

    <div class="nav">
        <a href="index_product.php">Kembali ke Daftar Product</a> |
        <a href="index_user.php">Kelola User</a> |
        <a href="index.php">Dashboard</a>
    </div>
</div>
</body>
</html>
