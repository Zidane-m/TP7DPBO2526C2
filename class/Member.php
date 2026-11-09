<?php
require_once __DIR__ . '/../config/db.php';

class Member {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function getAllMembers() {
        $stmt = $this->db->prepare("SELECT * FROM members ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getMemberById($id) {
        $stmt = $this->db->prepare("SELECT * FROM members WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function addMember($name, $email, $phone) {
        $stmt = $this->db->prepare("INSERT INTO members (name, email, phone) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $email, $phone]);
    }

    public function updateMember($id, $name, $email, $phone) {
        $stmt = $this->db->prepare("UPDATE members SET name = ?, email = ?, phone = ? WHERE id = ?");
        return $stmt->execute([$name, $email, $phone, $id]);
    }

    public function deleteMember($id) {
        $stmt = $this->db->prepare("DELETE FROM members WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
