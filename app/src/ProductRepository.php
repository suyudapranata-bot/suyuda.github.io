<?php
require_once __DIR__ . '/Database.php';

class ProductRepository {

    private $db;

    public function __construct() {
        $this->db = (new Database())->pdo;
    }

    // Ambil semua produk
    public function all() {
        $st = $this->db->query("SELECT * FROM products ORDER BY id DESC");
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    // Cari product berdasarkan ID
    public function find($id) {
        $st = $this->db->prepare("SELECT * FROM products WHERE id = ?");
        $st->execute([$id]);
        return $st->fetch(PDO::FETCH_ASSOC);
    }

    // Tambah produk baru (TANPA GAMBAR)
    public function create($data) {
        $sql = "INSERT INTO products (name, price, category, status) 
                VALUES (?, ?, ?, ?)";
        
        $st = $this->db->prepare($sql);
        return $st->execute([
            $data[0], // name
            $data[1], // price
            $data[2], // category
            $data[3]  // status
        ]);
    }

    // Update produk (TANPA GAMBAR)
    public function update($id, $data) {
        $sql = "UPDATE products 
                SET name = ?, 
                    price = ?, 
                    category = ?, 
                    status = ?
                WHERE id = ?";
        
        $st = $this->db->prepare($sql);
        return $st->execute([
            $data[0], // name
            $data[1], // price
            $data[2], // category
            $data[3], // status
            $id       // kondisi WHERE
        ]);
    }

    // Hapus produk
    public function delete($id) {
        $st = $this->db->prepare("DELETE FROM products WHERE id = ?");
        return $st->execute([$id]);
    }
}