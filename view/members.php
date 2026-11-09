<?php
$editId = isset($_GET['edit']) ? (int)$_GET['edit'] : 0;
$editMember = null;
if ($editId > 0) {
    $editMember = $member->getMemberById($editId);
}
?>

<div class="page-header">
    <h2>Manajemen Anggota Perpustakaan</h2>
</div>

<div class="card form-card">
    <h3><?= $editMember ? 'Ubah Data Anggota' : 'Tambah Anggota Baru' ?></h3>
    <form method="POST" action="index.php?page=members" class="grid-form">
        <?php if ($editMember): ?>
            <input type="hidden" name="id" value="<?= htmlspecialchars($editMember['id']) ?>">
        <?php endif; ?>

        <div class="form-group">
            <label for="name">Nama Lengkap *</label>
            <input type="text" id="name" name="name" required value="<?= $editMember ? htmlspecialchars($editMember['name']) : '' ?>" placeholder="Masukkan nama anggota">
        </div>

        <div class="form-group">
            <label for="email">Alamat Email *</label>
            <input type="email" id="email" name="email" required value="<?= $editMember ? htmlspecialchars($editMember['email']) : '' ?>" placeholder="contoh@domain.com">
        </div>

        <div class="form-group">
            <label for="phone">Nomor Telepon / WhatsApp</label>
            <input type="text" id="phone" name="phone" value="<?= $editMember ? htmlspecialchars($editMember['phone'] ?? '') : '' ?>" placeholder="Contoh: 08123456789">
        </div>

        <div class="form-actions">
            <?php if ($editMember): ?>
                <button type="submit" name="update_member" class="btn btn-primary">Simpan Perubahan</button>
                <a href="index.php?page=members" class="btn btn-secondary">Batal</a>
            <?php else: ?>
                <button type="submit" name="add_member" class="btn btn-primary">Tambah Anggota</button>
            <?php endif; ?>
        </div>
    </form>
</div>

<div class="card table-card">
    <h3>Daftar Anggota</h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th style="width: 50px;">ID</th>
                    <th>Nama Anggota</th>
                    <th>Email</th>
                    <th>Nomor Telepon</th>
                    <th style="width: 140px; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $membersList = $member->getAllMembers();
                if (empty($membersList)):
                ?>
                <tr>
                    <td colspan="5" class="text-center text-muted">Belum ada data anggota.</td>
                </tr>
                <?php else: ?>
                    <?php foreach ($membersList as $m): ?>
                    <tr>
                        <td><?= htmlspecialchars($m['id']) ?></td>
                        <td><strong><?= htmlspecialchars($m['name']) ?></strong></td>
                        <td><?= htmlspecialchars($m['email']) ?></td>
                        <td><?= htmlspecialchars($m['phone'] ?? '-') ?></td>
                        <td style="text-align: center;">
                            <a href="index.php?page=members&edit=<?= $m['id'] ?>" class="btn-sm btn-edit">Ubah</a>
                            <a href="index.php?page=members&action=delete&id=<?= $m['id'] ?>" class="btn-sm btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus anggota \'<?= htmlspecialchars(addslashes($m['name'])) ?>\'?');">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
