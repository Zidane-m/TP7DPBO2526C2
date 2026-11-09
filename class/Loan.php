<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/Book.php';

class Loan {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function getAllLoans() {
        $stmt = $this->db->prepare(
            "SELECT loans.*, books.title, members.name 
             FROM loans 
             JOIN books ON loans.book_id = books.id 
             JOIN members ON loans.member_id = members.id 
             ORDER BY loans.id DESC"
        );
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getLoanById($id) {
        $stmt = $this->db->prepare("SELECT * FROM loans WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function borrowBook($book_id, $member_id) {
        $stmtCheck = $this->db->prepare("SELECT stock FROM books WHERE id = ?");
        $stmtCheck->execute([$book_id]);
        $bookData = $stmtCheck->fetch();

        if ($bookData && $bookData['stock'] > 0) {
            $book = new Book();
            $book->updateStock($book_id, $bookData['stock'] - 1);

            $stmt = $this->db->prepare("INSERT INTO loans (book_id, member_id, loan_date) VALUES (?, ?, CURDATE())");
            return $stmt->execute([$book_id, $member_id]);
        }
        return false;
    }

    public function returnBook($loan_id) {
        $stmtCheck = $this->db->prepare("SELECT book_id, return_date FROM loans WHERE id = ?");
        $stmtCheck->execute([$loan_id]);
        $loan = $stmtCheck->fetch();

        if ($loan && empty($loan['return_date'])) {
            $stmtUpdate = $this->db->prepare("UPDATE loans SET return_date = CURDATE() WHERE id = ?");
            $stmtUpdate->execute([$loan_id]);

            $stmtBook = $this->db->prepare("SELECT stock FROM books WHERE id = ?");
            $stmtBook->execute([$loan['book_id']]);
            $bookData = $stmtBook->fetch();

            if ($bookData) {
                $book = new Book();
                $book->updateStock($loan['book_id'], $bookData['stock'] + 1);
            }
            return true;
        }
        return false;
    }

    public function deleteLoan($loan_id) {
        $stmt = $this->db->prepare("DELETE FROM loans WHERE id = ?");
        return $stmt->execute([$loan_id]);
    }
}
?>
