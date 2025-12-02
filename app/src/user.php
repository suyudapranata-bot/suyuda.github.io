<?php
class User {
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function create($name, $email){
        $stmt = $this->pdo->prepare("INSERT INTO users (name,email) VALUES (?,?)");
        return $stmt->execute([$name,$email]);
    }

    public function getAll(){
        $stmt = $this->pdo->query("SELECT * FROM users ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id){
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id,$name,$email){
        $stmt = $this->pdo->prepare("UPDATE users SET name=?,email=? WHERE id=?");
        return $stmt->execute([$name,$email,$id]);
    }

    public function delete($id){
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id=?");
        return $stmt->execute([$id]);
    }
}
