<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../Database.php';
require_once __DIR__ . '/../src/Product.php';
require_once __DIR__ . '/../src/ProductRepository.php';
$repo = new ProductRepository();
$products = $repo->all();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kelola Product</title>
    <style>
        body { font-family: Arial; background:#f0f2f5; margin:20px; }
        table { width:100%; border-collapse: collapse; background:white; box-shadow:0 4px 10px rgba(0,0,0,0.1);}
        th, td { border:1px solid #ccc; padding:10px; text-align:left; }
        th { background:#007BFF; color:white; }
        a.button { text-decoration:none; padding:5px 10px; border-radius:5px; color:white; }
        a.edit { background:#28a745; }
        a.delete { background:#dc3545; }
        a.add { background:#007BFF; display:inline-block; margin-bottom:10px; }
        img { max-width:50px; border-radius:5px; }
    </style>
</head>
<body>

<h2>Daftar Product</h2>
<a class="add" href="create_product.php">Tambah Product</a>

<table>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Harga</th>
        <th>Kategori</th>
        <th>Status</th>
        <th>Gambar</th>
        <th>Aksi</th>
    </tr>

    <?php if(!empty($products)): ?>
        <?php foreach($products as $p): ?>
        <tr>
            <td><?= $p['id'] ?></td>
            <td><?= htmlspecialchars($p['name']) ?></td>
            <td><?= htmlspecialchars($p['price']) ?></td>
            <td><?= htmlspecialchars($p['category']) ?></td>
            <td><?= htmlspecialchars($p['status']) ?></td>
            <td>
                <?php if(!empty($p['image_path'])): ?>
                    <img src="<?= htmlspecialchars($p['image_path']) ?>" alt="Gambar Product">
                <?php endif; ?>
            </td>
            <td>
                <a class="button edit" href="edit_product.php?id=<?= $p['id'] ?>">Edit</a>
                <a class="button delete" href="delete_product.php?id=<?= $p['id'] ?>" onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="7" style="text-align:center;">Belum ada product</td></tr>
    <?php endif; ?>
</table>

<div style="margin-top:20px;">
    <a href="index.php">Kembali ke Dashboard</a>
</div>

</body>
</html>
