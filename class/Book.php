<?php
require_once __DIR__ . '/../config/db.php';

class Book {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function getAllBooks() {
        $stmt = $this->db->prepare("SELECT * FROM books ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getBookById($id) {
        $stmt = $this->db->prepare("SELECT * FROM books WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function addBook($title, $author, $isbn, $stock) {
        $stmt = $this->db->prepare("INSERT INTO books (title, author, isbn, stock) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$title, $author, $isbn, (int)$stock]);
    }

    public function updateBook($id, $title, $author, $isbn, $stock) {
        $stmt = $this->db->prepare("UPDATE books SET title = ?, author = ?, isbn = ?, stock = ? WHERE id = ?");
        return $stmt->execute([$title, $author, $isbn, (int)$stock, $id]);
    }

    public function deleteBook($id) {
        $stmt = $this->db->prepare("DELETE FROM books WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function updateStock($id, $stock) {
        $stmt = $this->db->prepare("UPDATE books SET stock = ? WHERE id = ?");
        return $stmt->execute([(int)$stock, $id]);
    }
}
?>
