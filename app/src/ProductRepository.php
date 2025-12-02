<?php
require_once __DIR__ . "/Database.php";

class ProductRepository {

    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // Ambil semua produk
    public function getAllProducts() {
        $sql = "SELECT * FROM product";
        $result = $this->conn->query($sql);

        $data = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        return $data;
    }

    // Tambah produk baru
    public function addProduct($nama, $harga, $kategori, $status, $image) {

        $stmt = $this->conn->prepare("
            INSERT INTO product (nama, harga, kategori, status, image)
            VALUES (?, ?, ?, ?, ?)
        ");

        $stmt->bind_param("sisss", $nama, $harga, $kategori, $status, $image);

        return $stmt->execute();
    }
}
