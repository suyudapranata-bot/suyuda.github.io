<?php
require_once __DIR__ . '/../src/Database.php';
require_once __DIR__ . '/../src/ProductRepository.php';

$db = new Database();
$user = new User($db->pdo);
$repo = new ProductRepository();

$userCount = count($user->getAll());
$productCount = count($repo->all());
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body { font-family: Arial; background:#f0f2f5; margin:0; padding:0; }
        .container { max-width:900px; margin:auto; padding:20px; }
        h1 { text-align:center; margin-bottom:30px; }

        .cards { display:flex; justify-content:center; flex-wrap:wrap; gap:20px; }
        .card { 
            background:white; 
            padding:30px; 
            border-radius:10px; 
            border:4px solid #bbb; /* border lebih tebal */
            box-shadow:0 6px 15px rgba(0,0,0,0.1); 
            text-align:center; 
            width:250px; 
            transition: all 0.3s ease;
        }
        .card:hover {
            box-shadow:0 8px 25px rgba(0,0,0,0.2);
        }
        .card h2 { font-size:32px; margin:10px 0; }
        .card p { font-size:18px; margin:5px 0; }

        .card a { 
            display:inline-block; 
            margin-top:15px; 
            padding:10px 20px; 
            background:#007BFF; 
            color:white; 
            text-decoration:none; 
            border-radius:8px; 
            border:4px solid #0056b3; /* border tombol lebih tebal */
            box-shadow:0 4px 10px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
        }
        .card a:hover { 
            background:#0056b3; 
            box-shadow:0 6px 15px rgba(0,0,0,0.3);
        }

        .nav { text-align:center; margin-top:30px; }
        .nav a { 
            display:inline-block; 
            margin:0 15px; 
            padding:12px 25px; 
            background:white; 
            color:#007BFF; 
            border:4px solid #007BFF; /* border lebih tebal */
            border-radius:10px; 
            text-decoration:none; 
            font-weight:bold; 
            box-shadow:0 4px 12px rgba(0,0,0,0.15);
            transition: all 0.3s ease;
        }
        .nav a:hover { 
            background:#007BFF; 
            color:white; 
            box-shadow:0 6px 15px rgba(0,0,0,0.3);
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Dashboard</h1>

    <div class="cards">
        <div class="card">
            <h2><?= $userCount ?></h2>
            <p>Total User</p>
            <a href="index_user.php">Kelola User</a>
        </div>
        <div class="card">
            <h2><?= $productCount ?></h2>
            <p>Total Product</p>
            <a href="index_product.php">Kelola Product</a>
        </div>
    </div>

    <div class="nav">
        <a href="index_user.php">Kelola User</a>
        <a href="index_product.php">Kelola Product</a>
    </div>
</div>
</body>
</html>
