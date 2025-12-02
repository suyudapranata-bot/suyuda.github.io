<?php
require_once __DIR__ . "/../src/ProductRepository.php";
$repo = new ProductRepository();
$data = $repo->getAllProducts();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Daftar Product</title>
</head>
<body>

<h2>Daftar Product</h2>
<a href="add.php">Tambah Product</a><br><br>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Harga</th>
        <th>Kategori</th>
        <th>Status</th>
        <th>Image</th>
    </tr>

    <?php if (!empty($data)): ?>
        <?php foreach ($data as $row): ?>
            <tr>
                <td><?= $row['id_product'] ?></td>
                <td><?= $row['nama'] ?></td>
                <td><?= number_format($row['harga']) ?></td>
                <td><?= $row['kategori'] ?></td>
                <td><?= $row['status'] ?></td>
                <td>
                    <?php if (!empty($row['image'])): ?>
                        <img src="../uploads/<?= $row['image'] ?>" width="70">
                    <?php else: ?>
                        Tidak ada gambar
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="6">Tidak ada data</td>
        </tr>
    <?php endif; ?>

</table>

</body>
</html>
