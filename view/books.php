<?php
$editId = isset($_GET['edit']) ? (int)$_GET['edit'] : 0;
$editBook = null;
if ($editId > 0) {
    $editBook = $book->getBookById($editId);
}
?>

<div class="page-header">
    <h2>Manajemen Buku</h2>
</div>

<div class="card form-card">
    <h3><?= $editBook ? 'Ubah Data Buku' : 'Tambah Buku Baru' ?></h3>
    <form method="POST" action="index.php?page=books" class="grid-form">
        <?php if ($editBook): ?>
            <input type="hidden" name="id" value="<?= htmlspecialchars($editBook['id']) ?>">
        <?php endif; ?>

        <div class="form-group">
            <label for="title">Judul Buku *</label>
            <input type="text" id="title" name="title" required value="<?= $editBook ? htmlspecialchars($editBook['title']) : '' ?>" placeholder="Masukkan judul buku">
        </div>

        <div class="form-group">
            <label for="author">Penulis *</label>
            <input type="text" id="author" name="author" required value="<?= $editBook ? htmlspecialchars($editBook['author']) : '' ?>" placeholder="Masukkan nama penulis">
        </div>

        <div class="form-group">
            <label for="isbn">ISBN</label>
            <input type="text" id="isbn" name="isbn" value="<?= $editBook ? htmlspecialchars($editBook['isbn'] ?? '') : '' ?>" placeholder="Contoh: 9786020633071">
        </div>

        <div class="form-group">
            <label for="stock">Jumlah Stok *</label>
            <input type="number" id="stock" name="stock" required min="0" value="<?= $editBook ? htmlspecialchars($editBook['stock']) : '1' ?>">
        </div>

        <div class="form-actions">
            <?php if ($editBook): ?>
                <button type="submit" name="update_book" class="btn btn-primary">Simpan Perubahan</button>
                <a href="index.php?page=books" class="btn btn-secondary">Batal</a>
            <?php else: ?>
                <button type="submit" name="add_book" class="btn btn-primary">Tambah Buku</button>
            <?php endif; ?>
        </div>
    </form>
</div>

<div class="card table-card">
    <h3>Daftar Buku</h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th style="width: 50px;">ID</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>ISBN</th>
                    <th style="width: 80px; text-align: center;">Stok</th>
                    <th style="width: 140px; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $booksList = $book->getAllBooks();
                if (empty($booksList)):
                ?>
                <tr>
                    <td colspan="6" class="text-center text-muted">Belum ada data buku.</td>
                </tr>
                <?php else: ?>
                    <?php foreach ($booksList as $b): ?>
                    <tr>
                        <td><?= htmlspecialchars($b['id']) ?></td>
                        <td><strong><?= htmlspecialchars($b['title']) ?></strong></td>
                        <td><?= htmlspecialchars($b['author']) ?></td>
                        <td><?= htmlspecialchars($b['isbn'] ?? '-') ?></td>
                        <td style="text-align: center;">
                            <span class="badge <?= $b['stock'] > 0 ? 'badge-success' : 'badge-danger' ?>">
                                <?= htmlspecialchars($b['stock']) ?>
                            </span>
                        </td>
                        <td style="text-align: center;">
                            <a href="index.php?page=books&edit=<?= $b['id'] ?>" class="btn-sm btn-edit">Ubah</a>
                            <a href="index.php?page=books&action=delete&id=<?= $b['id'] ?>" class="btn-sm btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus buku \'<?= htmlspecialchars(addslashes($b['title'])) ?>\'?');">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
