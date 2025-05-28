<!DOCTYPE html>
<html>
<body>
    <h1><?= isset($buku) ? 'Edit Buku' : 'Tambah Buku' ?></h1>
    <form method="post" action="?controller=buku&action=<?= isset($buku) ? 'update' : 'store' ?>">
        <?php if (isset($buku)): ?>
            <input type="hidden" name="id" value="<?= $buku->id ?>">
        <?php endif; ?>
        Judul: <input type="text" name="judul" value="<?= isset($buku) ? htmlspecialchars($buku->judul) : '' ?>" required><br>
        Pengarang: <input type="text" name="pengarang" value="<?= isset($buku) ? htmlspecialchars($buku->pengarang) : '' ?>" required><br>
        <button type="submit" class="btn-simpan-buku">Simpan</button>
    </form>
</body>
</html>