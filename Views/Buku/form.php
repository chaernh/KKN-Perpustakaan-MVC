<?php
/**
 * View untuk form tambah/edit buku
 * 
 * Menampilkan form untuk menambah atau mengedit buku dengan:
 * - Input judul buku
 * - Input pengarang
 * - Tombol submit
 * 
 * Variabel yang digunakan:
 * @var Buku|null $buku Objek Buku jika dalam mode edit, null jika dalam mode tambah
 */
?>
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