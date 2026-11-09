<?php
require_once __DIR__ . '/class/Book.php';
require_once __DIR__ . '/class/Member.php';
require_once __DIR__ . '/class/Loan.php';

$book = new Book();
$member = new Member();
$loan = new Loan();

$page = $_GET['page'] ?? 'books';

// --- Penanganan Form POST (Create & Update) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Tambah Buku
    if (isset($_POST['add_book'])) {
        $title = trim($_POST['title'] ?? '');
        $author = trim($_POST['author'] ?? '');
        $isbn = trim($_POST['isbn'] ?? '');
        $stock = (int)($_POST['stock'] ?? 0);

        if ($title !== '' && $author !== '') {
            $book->addBook($title, $author, $isbn, $stock);
        }
        header("Location: index.php?page=books&msg=added");
        exit;
    }

    // 2. Ubah Buku
    if (isset($_POST['update_book'])) {
        $id = (int)$_POST['id'];
        $title = trim($_POST['title'] ?? '');
        $author = trim($_POST['author'] ?? '');
        $isbn = trim($_POST['isbn'] ?? '');
        $stock = (int)($_POST['stock'] ?? 0);

        if ($id > 0 && $title !== '' && $author !== '') {
            $book->updateBook($id, $title, $author, $isbn, $stock);
        }
        header("Location: index.php?page=books&msg=updated");
        exit;
    }

    // 3. Tambah Anggota
    if (isset($_POST['add_member'])) {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['phone'] ?? '');

        if ($name !== '' && $email !== '') {
            $member->addMember($name, $email, $phone);
        }
        header("Location: index.php?page=members&msg=added");
        exit;
    }

    // 4. Ubah Anggota
    if (isset($_POST['update_member'])) {
        $id = (int)$_POST['id'];
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['phone'] ?? '');

        if ($id > 0 && $name !== '' && $email !== '') {
            $member->updateMember($id, $name, $email, $phone);
        }
        header("Location: index.php?page=members&msg=updated");
        exit;
    }

    // 5. Pinjam Buku
    if (isset($_POST['borrow'])) {
        $book_id = (int)$_POST['book_id'];
        $member_id = (int)$_POST['member_id'];

        if ($book_id > 0 && $member_id > 0) {
            $success = $loan->borrowBook($book_id, $member_id);
            if ($success) {
                header("Location: index.php?page=loans&msg=borrowed");
            } else {
                header("Location: index.php?page=loans&msg=nostock");
            }
            exit;
        }
    }
}

// --- Penanganan Aksi GET (Delete & Return) ---
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $id = (int)($_GET['id'] ?? 0);

    // Hapus Buku
    if ($page === 'books' && $action === 'delete' && $id > 0) {
        $book->deleteBook($id);
        header("Location: index.php?page=books&msg=deleted");
        exit;
    }

    // Hapus Anggota
    if ($page === 'members' && $action === 'delete' && $id > 0) {
        $member->deleteMember($id);
        header("Location: index.php?page=members&msg=deleted");
        exit;
    }

    // Pengembalian Buku
    if ($page === 'loans' && $action === 'return' && $id > 0) {
        $loan->returnBook($id);
        header("Location: index.php?page=loans&msg=returned");
        exit;
    }

    // Hapus Riwayat Peminjaman
    if ($page === 'loans' && $action === 'delete' && $id > 0) {
        $loan->deleteLoan($id);
        header("Location: index.php?page=loans&msg=deleted");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Perpustakaan - TP7 DPBO</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include __DIR__ . '/view/header.php'; ?>

    <main class="container">
        <?php
        // Notifikasi sederhana berdasarkan parameter msg
        if (isset($_GET['msg'])) {
            $msg = $_GET['msg'];
            if ($msg === 'added') echo '<div class="alert alert-success">Data berhasil ditambahkan.</div>';
            elseif ($msg === 'updated') echo '<div class="alert alert-success">Data berhasil diperbarui.</div>';
            elseif ($msg === 'deleted') echo '<div class="alert alert-success">Data berhasil dihapus.</div>';
            elseif ($msg === 'returned') echo '<div class="alert alert-success">Buku berhasil dikembalikan. Stok telah diperbarui.</div>';
            elseif ($msg === 'nostock') echo '<div class="alert alert-danger">Peminjaman gagal: Stok buku habis!</div>';
        }

        // Routing halaman
        if ($page === 'members') {
            include __DIR__ . '/view/members.php';
        } elseif ($page === 'loans') {
            include __DIR__ . '/view/loans.php';
        } else {
            include __DIR__ . '/view/books.php';
        }
        ?>
    </main>

    <?php include __DIR__ . '/view/footer.php'; ?>
</body>
</html>
