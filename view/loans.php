<div class="page-header">
    <h2>Transaksi Peminjaman Buku</h2>
</div>

<div class="card form-card">
    <h3>Formulir Peminjaman Buku Baru</h3>
    <form method="POST" action="index.php?page=loans" class="grid-form">
        <div class="form-group">
            <label for="book_id">Pilih Buku *</label>
            <select id="book_id" name="book_id" required>
                <option value="">-- Pilih Buku yang Dipinjam --</option>
                <?php 
                $allBooks = $book->getAllBooks();
                foreach ($allBooks as $b): 
                    $outOfStock = $b['stock'] <= 0;
                ?>
                    <option value="<?= $b['id'] ?>" <?= $outOfStock ? 'disabled' : '' ?>>
                        <?= htmlspecialchars($b['title']) ?> (Stok: <?= $b['stock'] ?>) <?= $outOfStock ? '- [HABIS]' : '' ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="member_id">Pilih Anggota *</label>
            <select id="member_id" name="member_id" required>
                <option value="">-- Pilih Anggota Peminjam --</option>
                <?php foreach ($member->getAllMembers() as $m): ?>
                    <option value="<?= $m['id'] ?>">
                        <?= htmlspecialchars($m['name']) ?> (<?= htmlspecialchars($m['email']) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-actions">
            <button type="submit" name="borrow" class="btn btn-primary">Catat Peminjaman</button>
        </div>
    </form>
</div>

<div class="card table-card">
    <h3>Riwayat & Status Peminjaman</h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th style="width: 50px;">ID</th>
                    <th>Judul Buku</th>
                    <th>Nama Anggota</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th style="width: 120px; text-align: center;">Status</th>
                    <th style="width: 180px; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $loansList = $loan->getAllLoans();
                if (empty($loansList)):
                ?>
                <tr>
                    <td colspan="7" class="text-center text-muted">Belum ada data peminjaman buku.</td>
                </tr>
                <?php else: ?>
                    <?php foreach ($loansList as $l): ?>
                    <tr>
                        <td><?= htmlspecialchars($l['id']) ?></td>
                        <td><strong><?= htmlspecialchars($l['title']) ?></strong></td>
                        <td><?= htmlspecialchars($l['name']) ?></td>
                        <td><?= htmlspecialchars($l['loan_date']) ?></td>
                        <td><?= htmlspecialchars($l['return_date'] ?? '-') ?></td>
                        <td style="text-align: center;">
                            <?php if (!empty($l['return_date'])): ?>
                                <span class="badge badge-success">Dikembalikan</span>
                            <?php else: ?>
                                <span class="badge badge-warning">Sedang Dipinjam</span>
                            <?php endif; ?>
                        </td>
                        <td style="text-align: center;">
                            <?php if (empty($l['return_date'])): ?>
                                <a href="index.php?page=loans&action=return&id=<?= $l['id'] ?>" class="btn-sm btn-return" onclick="return confirm('Konfirmasi pengembalian buku \'<?= htmlspecialchars(addslashes($l['title'])) ?>\'?');">Kembalikan</a>
                            <?php endif; ?>
                            <a href="index.php?page=loans&action=delete&id=<?= $l['id'] ?>" class="btn-sm btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data transaksi peminjaman ini?');">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
